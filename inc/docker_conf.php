<?php


    $db_host = $_ENV["DB_HOST"] ?? $db_host;
    $db_port = $_ENV["DB_PORT"] ?? $db_port;
    $db_username = $_ENV["DB_USER"] ?? $db_username;
    $db_password = $_ENV["DB_PASS"] ?? $db_password;
    $db_database = $_ENV["DB_NAME"] ?? $db_database;

    if (isset($_ENV["DB_PASS_FILE"])) {
        $file = fopen($_ENV["DB_PASS_FILE"], "r");

        if ($file) {
            $file_size = filesize($_ENV["DB_PASS_FILE"]);
            $file_text = fread($file, $file_size);

            fclose($file);

            $db_password = $file_text;
        }
    }
    $settings_theme         = $_ENV["SETTINGS_THEME"] ?? $settings_theme;
    $settings_favicon       = $_ENV["SETTINGS_FAVICON"] ?? $settings_favicon;
    $settings_navbar_logo   = $_ENV["NAVBAR_LOGO"] ?? $settings_navbar_logo;
    $settings_navbar_title  = $_ENV["NAVBAR_TITLE"] ?? $settings_navbar_title;
    $settings_custom_link_name     = $_ENV["CUSTOM_LINK_NAME"] ?? $settings_custom_link_name;
    $settings_custom_link_adress   = $_ENV["CUSTOM_LINK_ADDRESS"] ?? $settings_custom_link_adress;
    $settings_custom_link_2_name     = $_ENV["CUSTOM_LINK_NAME_2"] ?? $settings_custom_link_2_name;
    $settings_custom_link_2_adress   = $_ENV["CUSTOM_LINK_ADDRESS_2"] ?? $settings_custom_link_2_adress;
    $settings_custom_link_3_name     = $_ENV["CUSTOM_LINK_NAME_3"] ?? $settings_custom_link_3_name;
    $settings_custom_link_3_adress   = $_ENV["CUSTOM_LINK_ADDRESS_3"] ?? $settings_custom_link_3_adress;