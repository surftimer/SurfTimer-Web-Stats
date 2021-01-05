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
        Logo must be located in 'images' folder
    */
    
        $settings_dark_mode = '0'; // Default 0 - Leave 1 to enable darkmode.
        $settings_navbar_logo   = "logo.svg";
        $settings_navbar_title  = "Surf Stats";

    /* End of Design Settings */

    /*
        Custom Link
        If you want disable link you must remain name empty
    */

        $settings_custom_link_name     = '<i class="fas fa-globe-europe"></i> Website'; // Example: <i class="fab fa-discord"></i> Discord or <i class="fas fa-globe-europe"></i> Website
        $settings_custom_link_adress   = 'https://surfcommunity.eu/'; // Exmaple: https://surfcommunity.eu/

     /* End of Custom Link */

    
    /* Other Settings */

        $settings_language              = 'english';    // english, slovak, czech, polish
        $settings_most_active_enable    = '1';          // Most Active Module - Default: 1 - To disable change to 0.
        $settings_top_players_count     = '250';        // Default: 250 - I don't recommend using a big number because higher the number you use, the longer it takes to load.
        $settings_timezone              = 'UTC+1';      // Timezone of your data (Use format from this site https://time.is/en/time_zones)
    
    /* End of Other Settings */
    