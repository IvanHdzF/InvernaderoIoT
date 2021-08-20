#if defined(ESP8266)
#include <ESP8266WiFi.h>
#else
#include <WiFi.h>
#endif

#include <WiFiManager.h>
#include <Separador.h>
#include <PubSubClient.h>
#include <WiFiClientSecure.h>
#include <WiFiUdp.h>
#include <NTPClient.h>



//*********************************
//*********** CONFIG **************
//*********************************

#define WIFI_PIN 17
#define LED 2 //On Board LED

//estos datos deben estar configurador también en las constantes de tu panel
// NO USES ESTOS DATOS PON LOS TUYOS!!!!
const String serial_number = "32";
const String insert_password = "121212";
const String get_data_password = "232323";
const char*  server = "arduinointerfaz.000webhostapp.com";


//MQTT
const char *mqtt_server = "ioticos.org";
const int mqtt_port = 8883;

//no completar, el dispositivo se encargará de averiguar qué usuario y qué contraseña mqtt debe usar.
char mqtt_user[20] = "";
char mqtt_pass[20] = "";

const int expected_topic_length = 26;

WiFiManager wifiManager;
WiFiClientSecure client;
PubSubClient mqttclient(client);
WiFiClientSecure client2;



Separador s;




//************************************
//***** DECLARACION FUNCIONES ********
//************************************
bool get_topic(int length);
void callback(char* topic, byte* payload, unsigned int length);
void reconnect();
void send_mqtt_data();
void send_to_database();
void regar();
void noRegar();
void subirDatos();


//*************************************
//********      GLOBALS         *******
//*************************************
bool topic_obteined = false;
char device_topic_subscribe [40];
char device_topic_subscribeData [40];
char device_topic_publish [40];
char device_topic_publishsw1 [40];
char device_topic_publishsw2 [40];
char device_topic_publishStatus [40];
char Mensaje_env [75];
char tempDeseada [5]="25";
char msg[25];
float temp = 0;
int hum = 0;
int lux=0;
long milliseconds = 0;
long mqttTimeout = 0;
byte sw1 = 0;
byte sw2 = 0;
byte slider = 25;
int estado=0; //Empieza en modo manual
bool riego=false;
String riegoEstado= "No regando";
const long utcOffsetInSeconds = -25200; //SERVIDOR NTP
char diasDeLaSemana[7][12] = {"Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"};
char modos[3][12] = {"Manual", "Automático", "Paro"};

WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", utcOffsetInSeconds);

void setup() {
  randomSeed(analogRead(0));
  client.setInsecure();
  client2.setInsecure();
  pinMode(LED,OUTPUT);
  pinMode(D0,OUTPUT);
  pinMode(D2,OUTPUT);

  digitalWrite(D0,HIGH);
  digitalWrite(D2,HIGH);

  Serial.begin(115200);


  pinMode(WIFI_PIN,INPUT_PULLUP);

  wifiManager.autoConnect("Invernadero IoT");
  Serial.println("Conexión a WiFi exitosa!");

  while(!topic_obteined){
    topic_obteined = get_topic(expected_topic_length);
    Serial.println(topic_obteined);
    delay(3000);
  }


  //set mqtt cert
  //client.setCACert(mqtt_cert);
  mqttclient.setServer(mqtt_server, mqtt_port);
  mqttclient.setCallback(callback);

  //Iniciar conexion a NTP
  timeClient.begin();


}

void loop() {
//Serial.println("Se esta ejecutando el loop");

  if (!client.connected()) {
    reconnect();
  }

//si el pulsador wifi esta en low, activamos el acces point de configuración
  if ( digitalRead(WIFI_PIN) == HIGH ) {
    WiFiManager wifiManager;
    wifiManager.startConfigPortal("Invernadero IoT");
    Serial.println("Conectados a WiFi!!! :)");
  }
  if (estado==1){//Checa si está en conexión
  //si estamos conectados a mqtt enviamos mensajes
  if (millis()-mqttTimeout<60000){//Define el timeout
  if (millis() - milliseconds > 3000){
    milliseconds = millis();


    if(mqttclient
    .connected()){
      if (temp>slider+5){
        Serial.println("Temperatura encima del rango"); //Checa la temperatura
      }
      else if (temp<slider-5){
        Serial.println("Temperatura bajo del rango"); //Checa la temperatura
      }
      else {
        Serial.println("Temperatura en rango");
      }
      if (hum>70){ //Checa la humedad si está fuera de rango
        Serial.println("Humedad fuera de rango");
        regar();
      }
      else { //Si la humedad está dentro de rago se ejecuta este código
        noRegar();
      }
      if (lux<30){ //Checa la luminosidad si está fuera de rango
        Serial.println("Luminosidad fuera de rango");
        digitalWrite(D2,LOW);
      }
      else { //Si la luminosidad está dentro de rago se ejecuta este código
        digitalWrite(D2,HIGH);
      }
    }
    timeClient.update(); //Mostrar fecha y hora

  }
  }
    else {
      estado=0; //Entra en modo manual y cierra todo
      noRegar();
    }
  }
  else if (estado==0){
       if (millis() - milliseconds > 3000){
          milliseconds = millis();
          Serial.println("Modo manual"); //Está en estado de desconexión
          digitalWrite(D2,HIGH);
          timeClient.update(); //Mostrar fecha y hora
     }
  }

  else {
       if (millis() - milliseconds > 3000){
          milliseconds = millis();
          Serial.println("Paro de emergencia"); //Está en estado de desconexión
          noRegar();
          digitalWrite(D2,HIGH);
     }
  }
    

  mqttclient.loop();

}



//************************************
//*********** FUNCIONES **************
//************************************

void callback(char* topic, byte* payload, unsigned int length) {
  mqttTimeout=millis();
  String incoming = "";
  Serial.print("Mensaje recibido desde tópico -> ");
  Serial.print(topic);
  Serial.println("");
  for (int i = 0; i < length; i++) {
    incoming += (char)payload[i];
  }
  incoming.trim();
  Serial.println("Mensaje -> " + incoming);

  String str_topic = String(topic);
  String command = s.separa(str_topic,'/',3);
  

  if(command=="sw1"){
    if (estado==0) {
      Serial.println("Sw1 pasa a estado " + incoming);
      sw1 = incoming.toInt();
      //mqttclient.publish(device_topic_publishsw1,"1");
      
      if (sw1==1){
        estado=0;
        regar();
      }
      else {
        noRegar();
      }
      
      subirDatos();
    }
  }

  else if(command=="sw2"){
    Serial.println("Sw2 pasa a estado " + incoming);
    sw2 = incoming.toInt();
    estado= (sw2==1) ? 2:0;
    noRegar();
    subirDatos();
  }

  else if(command=="slider"){
    Serial.println("Slider pasa a estado " + incoming);
    incoming.toCharArray(tempDeseada,5);
    slider = incoming.toInt();
    //mqttclient.publish(device_topic_publish,tempDeseada);
    subirDatos ();
  }
  else if(command=="info"){
    subirDatos();
  }

  else if(command=="modo"){
    if (estado!=2) {
      estado = incoming.toInt();
      subirDatos ();
    }
  }
  
  else {
    if (estado==1) {
      String tempStr=s.separa(incoming,',',0);
      String humStr=s.separa(incoming,',',1);
      String luxStr=s.separa(incoming,',',2);
      temp = tempStr.toInt();
      hum = humStr.toInt();
      lux=luxStr.toInt();
      estado=1;
      Serial.println(command);
      String completo=tempStr+","+humStr+","+luxStr;
    }
    
  }

}

void reconnect() {

  while (!mqttclient.connected()) {
    estado=0;
    Serial.print("Intentando conexión MQTT SSL");
    // we create client id
    String clientId = "esp8266_ia_";
    clientId += String(random(0xffff), HEX);
    // Trying SSL MQTT connection
    if (mqttclient.connect(clientId.c_str(),mqtt_user,mqtt_pass)) {
      Serial.println("Connected!");
      // We subscribe to topic
      mqttclient.subscribe(device_topic_subscribe);
      mqttclient.subscribe(device_topic_subscribeData);
      //mqttclient.subscribe("SCl0PwQZyTXBKu0/yNsJEN5Kde/data");
      Serial.print("Suscrito a ");
      Serial.println(device_topic_subscribe);

    } else {
      Serial.print("falló :( con error -> ");
      Serial.print(mqttclient.state());
      Serial.println(" Intentamos de nuevo en 5 segundos");

      delay(5000);
    }
  }
}

//función para obtener el tópico perteneciente a este dispositivo
bool get_topic(int length){

  Serial.println("\nIniciando conexión segura para obtener tópico raíz...");

  if (!client2.connect(server, 443)) {
    Serial.println("Falló conexión!");
  }else {
    Serial.println("Conectados a servidor para obtener tópico - ok");
    // Make a HTTP request:
    String data = "gdp="+get_data_password+"&sn="+serial_number+"\r\n";

    client2.print(String("POST ") + "/app/getdata/gettopics" + " HTTP/1.1\r\n" +\
                 "Host: " + server + "\r\n" +\
                 "Content-Type: application/x-www-form-urlencoded"+ "\r\n" +\
                 "Content-Length: " + String (data.length()) + "\r\n\r\n" +\
                 data +\
                 "Connection: close\r\n\r\n");

                 

    Serial.println("Solicitud enviada - ok");

    while (client2.connected()) {
      String line = client2.readStringUntil('\n');
      if (line == "\r") {
        Serial.println("Headers recibidos - ok");
        break;
      }
    }

    String line;
    while(client2.available()){
      line += client2.readStringUntil('\n');
    }
    Serial.println(line);
    String temporal_topic = s.separa(line,'#',1);
    String temporal_user = s.separa(line,'#',2);
    String temporal_password = s.separa(line,'#',3);



    Serial.println("El tópico es: " + temporal_topic);
    Serial.println("El user MQTT es: " + temporal_user);
    Serial.println("La pass MQTT es: " + temporal_password);
    Serial.println("La cuenta del tópico obtenido es: " + String(temporal_topic.length()));

    if (temporal_topic.length()==length){
      Serial.println("El largo del tópico es el esperado: " + String(temporal_topic.length()));

      String temporal_topic_subscribe = temporal_topic + "/actions/#";
      temporal_topic_subscribe.toCharArray(device_topic_subscribe,40);
      String temporal_topic_subscribeData = temporal_topic + "/data/#";
      temporal_topic_subscribeData.toCharArray(device_topic_subscribeData,40);
      Serial.println(device_topic_subscribe);
      String temporal_topic_publish = temporal_topic + "/estado";
      temporal_topic_publish.toCharArray(device_topic_publish,40);
      temporal_topic_publish = temporal_topic + "/estado/sw1";
      temporal_topic_publish.toCharArray(device_topic_publishsw1,40);//sw1
      temporal_topic_publish = temporal_topic + "/estado/sw2";
      temporal_topic_publish.toCharArray(device_topic_publishsw2,40);//sw2
      temporal_topic_publish = temporal_topic + "/estado/info";
      temporal_topic_publish.toCharArray(device_topic_publishStatus,40);//Estado del esp8266
      temporal_user.toCharArray(mqtt_user,20);
      temporal_password.toCharArray(mqtt_pass,20);

      client2.stop();
      return true;
    }else{
      client2.stop();
      return false;
    }

  }
}


void regar() {
  digitalWrite(D0,LOW);
  riego=true;
  riegoEstado="Regando";
  Serial.println("Se riega");
}

void noRegar() {
  digitalWrite(D0,HIGH);
  riego=false;
  riegoEstado="No regando";
  Serial.println("No se riega");
}


void subirDatos () {
  String msj=riegoEstado+", temperatura deseada= "+slider+" ,modo= "+modos[estado] +", hora = "+timeClient.getFormattedTime();
  msj.toCharArray(Mensaje_env,75);
  mqttclient.publish(device_topic_publishStatus,Mensaje_env);
}
