<?php

    if($settings_language_enable):
        session_start();

        if(!isset($_SESSION['language']))
            $_SESSION['language'] = $settings_language_default;
        elseif(isset($_GET['language']) && $_SESSION['language'] != $_GET['language'] && !empty($_GET['language'])){
            if($_GET['language'] == 'Czech')
                $_SESSION['language'] = "Czech";
            elseif($_GET['language'] == 'English')
                $_SESSION['language'] = "English";
            elseif($_GET['language'] == 'German')
                $_SESSION['language'] = "German";
            elseif($_GET['language'] == 'Slovak')
                $_SESSION['language'] = "Slovak";
        }

        require_once "./inc/languages/".$_SESSION['language'].".php";
    
    elseif((!$settings_language_default==='')&&(!$settings_language_enable)):
        require_once "./inc/languages/".$settings_language_default.".php";
    else:
        require_once "./inc/languages/English.php";
    endif;