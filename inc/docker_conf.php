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
$settings_theme                 = $_ENV["S_THEME"] ?? $settings_theme;
$settings_link_color            = $_ENV["S_LINK_COLOR"] ?? $settings_link_color;
$settings_favicon               = $_ENV["S_FAVICON"] ?? $settings_favicon;
$settings_navbar_logo           = $_ENV["S_NAVBAR_LOGO"] ?? $settings_navbar_logo;
$settings_background_image      = $_ENV["S_BACKGROUND_IMAGE"] ?? $settings_background_image;
$settings_navbar_title          = $_ENV["S_NAVBAR_TITLE"] ?? $settings_navbar_title;
$settings_player_profile_icon   = $_ENV["S_PLAYER_PROFILE_ICON"] ?? $settings_player_profile_icon;
$settings_map_link_icon         = $_ENV["S_MAP_LINK_ICON"] ?? $settings_map_link_icon;
$settings_map_image_preview     = $_ENV["S_MAP_IMAGE_PREVIEW"] ?? $settings_map_image_preview;
$settings_map_mapper            = $_ENV["S_NAVBAR_TITLE"] ?? $settings_map_mapper;

$settings_custom_link_name          = $_ENV["S_CSTM_LINK_NAME"] ?? $settings_custom_link_name;
$settings_custom_link_adress        = $_ENV["S_CSTM_LINK_ADR"] ?? $settings_custom_link_adress;
$settings_custom_link_2_name        = $_ENV["S_CSTM_LINK2_NAME"] ?? $settings_custom_link_2_name;
$settings_custom_link_2_adress      = $_ENV["S_CSTM_LINK2_ADR"] ?? $settings_custom_link_2_adress;
$settings_custom_link_3_name        = $_ENV["S_CSTM_LINK3_NAME"] ?? $settings_custom_link_3_name;
$settings_custom_link_3_adress      = $_ENV["S_CSTM_LINK3_ADR"] ?? $settings_custom_link_3_adress;

$settings_language_enable       = $_ENV["S_LANGUAGES"] ?? $settings_language_enable;
$settings_language_default      = $_ENV["S_LANGUAGE_DEFAULT"] ?? $settings_language_default;
$settings_player_flags          = $_ENV["S_PLAYER_FLAGS"] ?? $settings_player_flags;
$settings_maps_download_url     = $_ENV["S_MAPS_DOWNLOAD_URL"] ?? $settings_maps_download_url;
