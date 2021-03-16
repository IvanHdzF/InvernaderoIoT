#if defined(ESP8266)
#include <ESP8266WiFi.h>
#else
#include <WiFi.h>
#endif

#include <MQUnifiedsensor.h>



#include <WiFiManager.h>
#include <Separador.h>
#include <PubSubClient.h>
#include <WiFiClientSecure.h>
#include "DHT.h"
#include <Wire.h>
#include <BH1750.h>
BH1750 lightMeter;



//*********************************
//*********** CONFIG **************
//*********************************
/************************Hardware Related Macros************************************/
#define         Board                   ("ESP-32") // Wemos ESP-32 or other board, whatever have ESP32 core.
/***********************Software Related Macros************************************/
#define         Type                    ("MQ-135") //MQ135 or other MQ Sensor, if change this verify your a and b values.
#define         Voltage_Resolution      (5) // 3V3 <- IMPORTANT. Source: https://randomnerdtutorials.com/esp32-adc-analog-read-arduino-ide/
#define         ADC_Bit_Resolution      (12) // ESP-32 bit resolution. Source: https://randomnerdtutorials.com/esp32-adc-analog-read-arduino-ide/
#define         RatioMQ135CleanAir        (3.6) // Ratio of your sensor, for this example an MQ-3
/*****************************Globals***********************************************/
#define WIFI_PIN 17
#define DHT_PIN 5
#define DHTTYPE DHT11
#define LED 2 //On Board LED
MQUnifiedsensor MQ135(Board, Voltage_Resolution, ADC_Bit_Resolution, 36, Type);




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



//*************************************
//********      GLOBALS         *******
//*************************************
bool topic_obteined = false;
char device_topic_subscribe [40];
char device_topic_publish [40];
char msg[30];
float temp = 0;
float hum = 0;
int lux = 0;
float co2=0;
float pH=7;
long milliseconds = 0;
byte sw1 = 0;
byte sw2 = 0;
byte slider = 25;

int m_4 = 3025;
int m_7 = 2595; //agua

DHT dht(DHT_PIN, DHTTYPE);

void setup() {
  //prandomSeed(analogRead(0));
  //client.setInsecure();
  //client2.setInsecure();
  pinMode(LED,OUTPUT);
  pinMode(35,INPUT);

  Serial.begin(115200);
  

  pinMode(WIFI_PIN,INPUT_PULLUP);
  dht.begin();
  Wire.begin();
  lightMeter.begin();
  MQ135.setRegressionMethod(1); //_PPM =  a*ratio^b
  MQ135.setA(110.47); MQ135.setB(-2.862); // Configurate the ecuation values to get CO2 concentration
  MQ135.init(); 
  Serial.print("Calibrating please wait.");
  float calcR0 = 0;
  for(int i = 1; i<=10; i ++)
  {
    MQ135.update(); // Update data, the arduino will be read the voltage on the analog pin
    calcR0 += MQ135.calibrate(RatioMQ135CleanAir);
    Serial.print(".");
  }
  MQ135.setR0(calcR0/10);
  Serial.println("  done!.");
  //MQ135.serialDebug(true);
  wifiManager.autoConnect("IoTicos Admin");
  Serial.println("Conexión a WiFi exitosa!");
  //client2.setCACert(web_cert);

  while(!topic_obteined){
    topic_obteined = get_topic(expected_topic_length);
    Serial.println(topic_obteined);
    delay(3000);
  }


  //set mqtt cert
  //client.setCACert(mqtt_cert);
  mqttclient.setServer(mqtt_server, mqtt_port);
  mqttclient.setCallback(callback);


}

void loop() {
//Serial.println("Se esta ejecutando el loop");

  if (!client.connected()) {
    reconnect();
  }

//si el pulsador wifi esta en low, activamos el acces point de configuración
  if ( digitalRead(WIFI_PIN) == LOW ) {
    WiFiManager wifiManager;
    wifiManager.startConfigPortal("IoTicos Admin");
    Serial.println("Conectados a WiFi!!! :)");
  }

  //si estamos conectados a mqtt enviamos mensajes
  if (millis() - milliseconds > 3000){
    milliseconds = millis();


    if(mqttclient.connected()){
      //set mqtt cert
      temp = dht.readTemperature();
      hum = dht.readHumidity();
      lux = lightMeter.readLightLevel();
      MQ135.update(); // Update data, the arduino will be read the voltage on the analog pin
      co2=MQ135.readSensor()+400; // Sensor will read PPM concentration using the model and a and b values setted before or in the setup
    
      //MQ135.serialDebug(); // Will print the table on the serial port
      pH= 7.00 + ((analogRead(35) - m_7 ) * 4.00 / ( m_7 - m_4 ));
      String to_send = String(temp) + "," + String(hum) + "," + String(lux)+","+ String(co2)+ ","+String(pH)+","+ String(sw1);
      Serial.println(to_send);
      to_send.toCharArray(msg,30);
      mqttclient.publish(device_topic_publish,msg);
      send_to_database();

    }

  }

  mqttclient.loop();

}



//************************************
//*********** FUNCIONES **************
//************************************

void callback(char* topic, byte* payload, unsigned int length) {
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
  Serial.println(command);

  if(command=="sw1"){
    Serial.println("Sw1 pasa a estado " + incoming);
    sw1 = incoming.toInt();
  }

  if(command=="sw2"){
    Serial.println("Sw2 pasa a estado " + incoming);
    sw2 = incoming.toInt();
  }

  if(command=="slider"){
    Serial.println("Sw1 pasa a estado " + incoming);
    slider = incoming.toInt();
    //ledcWrite(ledChannel,slider);
  }

}

void reconnect() {

  while (!mqttclient.connected()) {
    Serial.print("Intentando conexión MQTT SSL");
    // we create client id
    String clientId = "esp32_ia_";
    clientId += String(random(0xffff), HEX);
    // Trying SSL MQTT connection
    if (mqttclient.connect(clientId.c_str(),mqtt_user,mqtt_pass)) {
      Serial.println("Connected!");
      // We subscribe to topic
      //mqttclient.publish(device_topic_publish,"20,50");
      mqttclient.subscribe(device_topic_subscribe);
      Serial.print("Suscrito a ");
      Serial.println(device_topic_publish);

    } else {
      Serial.print("falló :( con error -> ");
      Serial.print(mqttclient.state());
      Serial.println(" Intentamos de nuevo en 5 segundos");
      digitalWrite(LED,LOW);

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
    digitalWrite(LED,HIGH);

    if (temporal_topic.length()==length){
      Serial.println("El largo del tópico es el esperado: " + String(temporal_topic.length()));

      String temporal_topic_subscribe = temporal_topic + "/actions/#";
      temporal_topic_subscribe.toCharArray(device_topic_subscribe,40);
      Serial.println(device_topic_subscribe);
      String temporal_topic_publish = temporal_topic + "/data";
      temporal_topic_publish.toCharArray(device_topic_publish,40);
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


void send_to_database(){
  //mqttclient.disconnect();
  //client2.setInsecure();
  Serial.println("\nIniciando conexión segura para enviar a base de datos...");

  if (!client2.connect(server, 443)) {
    Serial.println("Falló conexión!");
    //cliente2.state();
  }else {
    Serial.println("Conectados a servidor para insertar en db - ok");
    // Make a HTTP request:
    //String data = "idp="+insert_password+"&sn="+serial_number+"&temp="+String(temp)+"&hum="+String(hum)+"\r\n";
    String data = "idp="+insert_password+"&sn="+serial_number+"&temp="+String(temp)+"&hum="+String(hum)+"&lux="+String(lux)+"&co2="+String(co2)+"&pH="+String(pH)+"\r\n";
    Serial.print(String("POST ") + "/app/getdata/gettopics" + " HTTP/1.1\r\n" +\
                 "Host: " + server + "\r\n" +\
                 "Content-Type: application/x-www-form-urlencoded"+ "\r\n" +\
                 "Content-Length: " + String (data.length()) + "\r\n\r\n" +\
                 data +\
                 "Connection: close\r\n\r\n");
    client2.print(String("POST ") + "/app/insertdata/insert" + " HTTP/1.1\r\n" +\
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
    client2.stop();

    }

  }
