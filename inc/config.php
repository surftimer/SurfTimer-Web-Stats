<?php
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
/*  Surfing Stats Config */
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

/*  Database Config */

    $db_host = 'your_database_host';            // DB Hostame
    $db_port = '3306';                          // DB Port (Default: 3306)
    $db_username = 'your_database_username';    // DB Username
    $db_password = 'your_database_password';    // DB Password
    $db_database = 'your_database_name';        // DB Database

/* End of  Database Config */

/* 
    Design Settings 
    If you want use title than logo must remain empty
    If you want to use background image you need to provide image name EXAMPLE: background.jpg
    You can also use background images located in /images/surf-images/
    Logo, favicon and background image must be located in 'images' folder
*/

    /*
        Theme options:
        default, cerulean, cosmo, cyborg, darkly, flatly, journal, litera, lumen, lux, materia, minty, morph, pulse, quartz, sandstone, simplex, slate, solar, spacelab, superhero, united, vapor, yeti, zephyr
        This is a beta function some of the themes will look like ... :)
    */
    $settings_theme                 = "default";        // Options are upper
    $settings_favicon               = "logo.svg";
    $settings_navbar_logo           = "logo.svg";
    $settings_background_image      = "";               // EXAMPLE: surf-images/4old.jpg
    $settings_navbar_title          = "Surf Stats";
    $settings_player_profile_icon   = FALSE;            // TRUE or FALSE # FALSE will disable player profile icons
    $settings_map_link_icon         = FALSE;            // TRUE or FALSE # FALSE will disable link icon after map name

/* End of Design Settings */

/*
    Custom Link
    If you want disable link you must remain name empty
*/

    $settings_custom_link_name          = '<i class="fas fa-globe-europe"></i> Website'; // Example: <i class="fab fa-discord"></i> Discord or <i class="fas fa-globe-europe"></i> Website
    $settings_custom_link_adress        = 'https://github.com/surftimer/SurfTimer-Web-Stats'; // Exmaple: https://github.com/KristianP26/Surftimer-Web-Stats
    $settings_custom_link_2_name        = '<i class="fab fa-discord"></i> Discord'; // Example: <i class="fab fa-discord"></i> Discord or <i class="fas fa-globe-europe"></i> Website
    $settings_custom_link_2_adress      = 'https://discord.surftimer.dev'; // Exmaple: https://discord.gg/HxhhypNa3Z
    $settings_custom_link_3_name        = ''; // Example: <i class="fab fa-discord"></i> Discord or <i class="fas fa-globe-europe"></i> Website
    $settings_custom_link_3_adress      = ''; // Exmaple: https://discord.gg/HxhhypNa3Z

 /* End of Custom Link */

 /* 
    General Settings 
*/
    $settings_player_flags  = TRUE; // TRUE or FALSE # False will disable players flags

/* End of General Settings */