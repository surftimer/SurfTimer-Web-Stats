<?php
    require ('steamauthOOP.class.php');  
    $steam = new steamauthOOP();
    if (isset($_GET["logout"])) {
        $steam->logout();
    };

    if($steam->loggedIn()):

        $user_communityid = $steam->steamid;
        $user_steamid = toSteamID($user_communityid);

        //Check if user profile Exists
        $sql_select_user_profile_exis = "SELECT * FROM `ck_playerrank` WHERE steamid='$user_steamid'";
        $results_select_user_profile_exis = $db_conn_surftimer->query($sql_select_user_profile_exis);
        if($results_select_user_profile_exis->num_rows != 0)
            $user_profile_exists = 1;
        else
            $user_profile_exists = 0;

        //Check if user settings Exists
        $sql_select_user_settings_exis = "SELECT * FROM `ck_playeroptions2` WHERE steamid='$user_steamid'";
        $results_select_user_settings_exis = $db_conn_surftimer->query($sql_select_user_settings_exis);
        if($results_select_user_settings_exis->num_rows != 0)
            $user_settings_exists = 1;
        else
            $user_settings_exists = 0;

    endif;