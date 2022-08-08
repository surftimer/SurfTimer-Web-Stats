<?php

// Create connection
$db_conn_surftimer = new mysqli($db_host.':'.$db_port, $db_username, $db_password, $db_database);

// Check connection
if ($db_conn_surftimer->connect_error) {
    die("<center><h2>Please contact site Administrator.</h2><br><h3>DB: Connection failed:<br>"
     . $db_conn_surftimer->connect_error . "</h3></center>");
} else {
    $db_conn_surftimer_status = 1;
};


// Create not existing database columns
$sql_mtcheck = "SHOW COLUMNS FROM `ck_maptier` LIKE 'stages'";
$sql_mtcheck_add = "ALTER TABLE `ck_maptier` ADD `stages` INT NULL DEFAULT NULL AFTER `ranked`, ADD `bonuses` INT NULL DEFAULT NULL AFTER `stages`;";

$result_mtcheck = $db_conn_surftimer->query($sql_mtcheck);
$exists_mtcheck = (mysqli_num_rows($result_mtcheck))?TRUE:FALSE;
if(!$exists_mtcheck) {
    $db_conn_surftimer->query($sql_mtcheck_add);
}

$sql_ptcheck = "SHOW COLUMNS FROM `ck_playertimes` LIKE 'date'";
$sql_ptcheck_add = "ALTER TABLE `ck_playertimes` ADD `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `style`;";

$result_ptcheck = $db_conn_surftimer->query($sql_ptcheck);
$exists_ptcheck = (mysqli_num_rows($result_ptcheck))?TRUE:FALSE;
if(!$exists_ptcheck) {
    $db_conn_surftimer->query($sql_ptcheck_add);
}

$sql_bonuscheck = "SHOW COLUMNS FROM `ck_bonus` LIKE 'date'";
$sql_bonuscheck_add = "ALTER TABLE `ck_bonus` ADD `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `style`;";

$result_ptcheck = $db_conn_surftimer->query($sql_bonuscheck);
$exists_ptcheck = (mysqli_num_rows($result_ptcheck))?TRUE:FALSE;
if(!$exists_ptcheck) {
    $db_conn_surftimer->query($sql_bonuscheck_add);
}

$sql_wrcpcheck = "SHOW COLUMNS FROM `ck_wrcps` LIKE 'date'";
$sql_wrcpcheck_add = "ALTER TABLE `ck_wrcps` ADD `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `style`;";

$result_ptcheck = $db_conn_surftimer->query($sql_wrcpcheck);
$exists_ptcheck = (mysqli_num_rows($result_ptcheck))?TRUE:FALSE;
if(!$exists_ptcheck) {
    $db_conn_surftimer->query($sql_wrcpcheck_add);
}
// End of "Create not existing database columns"

if($settings_player_flags){
    $sql_UsrTableCountryCodeAndContinentCodeCheck = "SHOW COLUMNS FROM `ck_wrcps` LIKE 'countryCode'";
    $result_UsrTableCountryCodeAndContinentCodeCheck = $db_conn_surftimer->query($sql_UsrTableCountryCodeAndContinentCodeCheck);
    $exists_UsrTableCountryCodeAndContinentCodeCheck = (mysqli_num_rows($result_UsrTableCountryCodeAndContinentCodeCheck))?TRUE:FALSE;
    $config_player_flags = $exists_UsrTableCountryCodeAndContinentCodeCheck;
} else {
    $config_player_flags = FALSE;
}

$sql_select_timezone = "SELECT IF(@@session.time_zone = 'SYSTEM', @@system_time_zone, @@session.time_zone) as timezone;";
$results_select_timezone = mysqli_query($db_conn_surftimer, $sql_select_timezone);
$row_select_timezone = mysqli_fetch_assoc($results_select_timezone);
$mysql_server_timezone = $row_select_timezone['timezone'];

$db_conn_surftimer -> set_charset("utf8mb4");
