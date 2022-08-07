<?php
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
/*  Surfing Stats Config */
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

/*  Database Config */

    $db_host = $_ENV["DB_HOST"] ?? 'your_database_host';            // DB Hostame
    $db_port = $_ENV["DB_PORT"] ?? '3306';                          // DB Port (Default: 3306)
    $db_username = $_ENV["DB_USER"] ?? 'your_database_username';    // DB Username
    $db_password = $_ENV["DB_PASS"] ?? 'your_database_password';    // DB Password
    $db_database = $_ENV["DB_NAME"] ?? 'your_database_name';        // DB Database

    if (isset($_ENV["DB_PASS_FILE"])) {
        $file = fopen($_ENV["DB_PASS_FILE"], "r");

        if ($file) {
            $file_size = filesize($_ENV["DB_PASS_FILE"]);
            $file_text = fread($file, $file_size);

            fclose($file);

            $db_password = $file_text;
        }
    }

/* End of  Database Config */

/* 
    Design Settings 
    If you want use title than logo must remain empty
    Logo must be located in 'images' folder
*/

    /*
        Theme options:
        default, cerulean, cosmo, cyborg, darkly, flatly, journal, litera, lumen, lux, materia, minty, morph, pulse, quartz, sandstone, simplex, slate, solar, spacelab, superhero, united, vapor, yeti, zephyr
        This is a beta function some of the themes will look like ... :)
    */
    $settings_theme         = $_ENV["SETTINGS_THEME"] ?? "default"; // Options are upper
    $settings_favicon       = $_ENV["SETTINGS_FAVICON"] ?? "logo.svg";
    $settings_navbar_logo   = $_ENV["NAVBAR_LOGO"] ?? "logo.svg";
    $settings_navbar_title  = $_ENV["NAVBAR_TITLE"] ?? "Surf Stats";

/* End of Design Settings */

/*
    Custom Link
    If you want disable link you must remain name empty
*/

    $settings_custom_link_name     = $_ENV["CUSTOM_LINK_NAME"] ?? '<i class="fas fa-globe-europe"></i> Website'; // Example: <i class="fab fa-discord"></i> Discord or <i class="fas fa-globe-europe"></i> Website
    $settings_custom_link_adress   = $_ENV["CUSTOM_LINK_ADDRESS"] ?? 'https://github.com/surftimer/SurfTimer-Web-Stats'; // Exmaple: https://github.com/KristianP26/Surftimer-Web-Stats
    $settings_custom_link_2_name     = $_ENV["CUSTOM_LINK_NAME_2"] ?? '<i class="fab fa-discord"></i> Discord'; // Example: <i class="fab fa-discord"></i> Discord or <i class="fas fa-globe-europe"></i> Website
    $settings_custom_link_2_adress   = $_ENV["CUSTOM_LINK_ADDRESS_2"] ?? 'https://discord.surftimer.dev'; // Exmaple: https://discord.gg/HxhhypNa3Z

 /* End of Custom Link */
