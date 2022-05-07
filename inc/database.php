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



$sql_mtcheck = "SHOW COLUMNS FROM `ck_maptier` LIKE 'stages'";
$sql_mtcheck_add = "ALTER TABLE `ck_maptier` ADD `stages` INT NULL DEFAULT NULL AFTER `ranked`, ADD `bonuses` INT NULL DEFAULT NULL AFTER `stages`;";

$result_mtcheck = $db_conn_surftimer->query($sql_mtcheck);
$exists_mtcheck = (mysqli_num_rows($result_mtcheck))?TRUE:FALSE;
if(!$exists_mtcheck) {
    $db_conn_surftimer->query($sql_mtcheck_add);
}

$db_conn_surftimer -> set_charset("utf8mb4");

