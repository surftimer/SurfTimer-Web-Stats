<?php
    define('__ROOT__', dirname(dirname(__FILE__)));

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
            elseif($_GET['language'] == 'Portuguese')
                $_SESSION['language'] = "Portuguese";   
            elseif($_GET['language'] == 'Slovak')
                $_SESSION['language'] = "Slovak";
            elseif($_GET['language'] == 'French')
                $_SESSION['language'] = "French";
        }

        require_once(__ROOT__.'/inc/languages/'.$_SESSION['language'].'.php');
    
    elseif((!$settings_language_default==='')&&(!$settings_language_enable)):
        require_once(__ROOT__.'/inc/languages/'.$settings_language_default.'.php');
    else:
        require_once require_once(__ROOT__.'/inc/languages/English.php');
    endif;