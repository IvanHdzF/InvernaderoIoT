<header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
        <div class="mdl-layout-spacer"></div>
        <!-- Search-->
        <select id="device_select" onchange="change_device()" class="" name="" style="background:transparent;color:#d1d0cf">
          <option value="">Select Device</option>
          <?php foreach ($devices as $device ) { ?>
            <option value="<?php echo $device['device_id'] ?>" <?php if ($_SESSION['selected_device'] == $device['device_id']){echo "selected";} ?>><?php echo $device['device_alias']?></option>
          <?php } ?>
        </select>

        <!-- Notifications dropdown-->
        <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-shadow--2dp notifications-dropdown"
            for="notification">
            <li class="mdl-list__item">
                You have 23 new notifications!
            </li>
            <li class="mdl-menu__item mdl-list__item list__item--border-top">
                <span class="mdl-list__item-primary-content">
                    <span class="mdl-list__item-avatar background-color--primary">
                        <i class="material-icons">plus_one</i>
                    </span>
                    <span>You have 3 new orders.</span>
                </span>
                <span class="mdl-list__item-secondary-content">
                  <span class="label">just now</span>
                </span>
            </li>
            <li class="mdl-menu__item mdl-list__item list__item--border-top">
                <span class="mdl-list__item-primary-content">
                    <span class="mdl-list__item-avatar background-color--secondary">
                        <i class="material-icons">error_outline</i>
                    </span>
                  <span>Database error</span>
                </span>
                <span class="mdl-list__item-secondary-content">
                  <span class="label">1 min</span>
                </span>
            </li>
            <li class="mdl-menu__item mdl-list__item list__item--border-top">
                <span class="mdl-list__item-primary-content">
                    <span class="mdl-list__item-avatar background-color--primary">
                        <i class="material-icons">new_releases</i>
                    </span>
                  <span>The Death Star is built!</span>
                </span>
                <span class="mdl-list__item-secondary-content">
                  <span class="label">2 hours</span>
                </span>
            </li>
            <li class="mdl-menu__item mdl-list__item list__item--border-top">
                <span class="mdl-list__item-primary-content">
                    <span class="mdl-list__item-avatar background-color--primary">
                        <i class="material-icons">mail_outline</i>
                    </span>
                  <span>You have 4 new mails.</span>
                </span>
                <span class="mdl-list__item-secondary-content">
                  <span class="label">5 days</span>
                </span>
            </li>
            <li class="mdl-list__item list__item--border-top">
                <button href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">ALL NOTIFICATIONS</button>
            </li>
        </ul>



        <div class="avatar-dropdown" id="icon">
            <span><?php echo $_SESSION['user_name']; ?></span>
            <img src="<?php echo $_SESSION['user_image']; ?>">
        </div>
        <!--
        <ul class="mdl-menu mdl-list mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp account-dropdown"
            for="icon">
            <li class="mdl-list__item mdl-list__item--two-line">
                <span class="mdl-list__item-primary-content">
                    <span class="material-icons mdl-list__item-avatar"></span>
                    <span>Luke</span>
                    <span class="mdl-list__item-sub-title">Luke@skywalker.com</span>
                </span>
            </li>
            <li class="list__item--border-top"></li>
            <li class="mdl-menu__item mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">account_circle</i>
                    My account
                </span>
            </li>
            <li class="mdl-menu__item mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">check_box</i>
                    My tasks
                </span>
                <span class="mdl-list__item-secondary-content">
                  <span class="label background-color--primary">3 new</span>
                </span>
            </li>
            <li class="mdl-menu__item mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">perm_contact_calendar</i>
                    My events
                </span>
            </li>
            <li class="list__item--border-top"></li>
            <li class="mdl-menu__item mdl-list__item">
                <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">settings</i>
                    Settings
                </span>
            </li>
            <a href="login.html">
                <li class="mdl-menu__item mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-icon text-color--secondary">exit_to_app</i>
                        Log out
                    </span>
                </li>
            </a>
        </ul>
        Account dropdawn-->
        <button id="more"
                class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
        </button>

        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp settings-dropdown"
            for="more">
            <a class="mdl-menu__item" href="https://arduinointerfaz.000webhostapp.com/app/Logout">
                Logout
            </a>
            <a class="mdl-menu__item" href="https://github.com/CreativeIT/getmdl-dashboard/issues">
                Support
            </a>
            <li class="mdl-menu__item">
                F.A.Q.
            </li>
        </ul>
    </div>
</header>

<script type="text/javascript">
  function change_device(){

    var device_id = $("#device_select").val();
    console.log(device_id);
    $.post("<?php echo base_url('devices/change_device'); ?>", {device_id: device_id}, function(result){
      location.reload();
    });
  }
</script>
