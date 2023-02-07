<?php
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
/*  Surfing Stats Config */
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

/*  Database Config */

$db_host = 'your_database_host';            // DB Hostame
$db_port = 3306;                            // DB Port (Default: 3306)
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

    Link colors:
    link-primary, link-secondary, link-success, link-danger, link-warning, link-info, link-light, link-dark
*/
$settings_theme                 = "default";        // Options are upper
$settings_link_color            = "link-dark";      // Options are upper
$settings_favicon               = "logo.svg";
$settings_navbar_logo           = "logo.svg";
$settings_background_image      = "";               // EXAMPLE: surf-images/4old.jpg
$settings_navbar_title          = "Surf Stats";
$settings_player_profile_icon   = TRUE;            // TRUE or FALSE # FALSE will disable player profile icons
$settings_map_link_icon         = TRUE;            // TRUE or FALSE # FALSE will disable link icon after map name
$settings_map_image_preview     = TRUE;            // TRUE or FALSE # FALSE will disable map images preview // TRUE may have effect on page load
$settings_map_mapper            = TRUE;            // TRUE or FALSE # FALSE will disable map mapper name


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

$settings_language_enable       = TRUE;         // Default: TRUE - To disable language selector change to FALSE.
$settings_language_default      = "English";    // Croatian, Czech, Danish, English, French, German, Hindi, Hungarian, Korean, Portuguese, Slovak, Spanish Swedish, Turkish, Ukrainian
$settings_player_flags          = TRUE;         // Default: TRUE - To disable player flags change to FALSE
$settings_maps_download_url     = '';           // To disable remain empty EXAMPLE: http://example.com/maps/

/* End of General Settings */