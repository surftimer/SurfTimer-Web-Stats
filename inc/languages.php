<?php
    define('__ROOT__', dirname(__FILE__, 2));

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
            elseif($_GET['language'] == 'Hindi')
                $_SESSION['language'] = "Hindi";
            elseif($_GET['language'] == 'Portuguese')
                $_SESSION['language'] = "Portuguese";   
            elseif($_GET['language'] == 'Slovak')
                $_SESSION['language'] = "Slovak";
            elseif($_GET['language'] == 'French')
                $_SESSION['language'] = "French";
            elseif($_GET['language'] == 'Turkish')
                $_SESSION['language'] = "Turkish";
            elseif($_GET['language'] == 'Danish')
                $_SESSION['language'] = "Danish";
            elseif($_GET['language'] == 'Korean')
                $_SESSION['language'] = "Korean";
            elseif($_GET['language'] == 'Spanish')
                $_SESSION['language'] = "Spanish";
		    elseif($_GET['language'] == 'Swedish')
                $_SESSION['language'] = "Swedish";
        }

        require_once(__ROOT__.'/inc/languages/'.$_SESSION['language'].'.php');

    elseif(false):
        require_once(__ROOT__.'/inc/languages/'.$settings_language_default.'.php');
    else:
        require_once require_once(__ROOT__.'/inc/languages/English.php');
    endif;

    function LanguageFlag(): string
    {
        if($_SESSION['language'] == 'Czech')
            return 'cz';
        elseif($_SESSION['language'] == 'English')
            return 'gb';
        elseif($_SESSION['language'] == 'German')
            return 'de';
        elseif($_SESSION['language'] == 'Hindi')
            return 'in';
        elseif($_SESSION['language'] == 'Slovak')
            return 'sk';
        elseif($_SESSION['language'] == 'Portuguese')
            return 'pt';
        elseif($_SESSION['language'] == 'French')
            return 'fr';
        elseif($_SESSION['language'] == 'Turkish')
            return 'tr';
        elseif($_SESSION['language'] == 'Danish')
            return 'dk';
        elseif($_SESSION['language'] == 'Korean')
            return 'kr';
        elseif($_SESSION['language'] == 'Spanish')
            return 'es';
        elseif($_SESSION['language'] == 'Swedish')
            return 'se';
        else
            return 'gb';
    }
