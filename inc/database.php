<?php

// Create connection
$db_conn_surftimer = new mysqli($db_host.':'.$db_port, $db_username, $db_password, $db_database_surftimer);

// Check connection
if ($db_conn_surftimer->connect_error) {
    die("<center><h2>Please contact site Administrator.</h2><br><h3>DB: Connection failed:<br>"
     . $db_conn_surftimer->connect_error . "</h3></center>");
} else {
    $db_conn_surftimer_status = 1;
};

// Create connection
$db_conn_web = new mysqli($db_host.':'.$db_port, $db_username, $db_password, $db_database_web);

// Check connection
if ($db_conn_web->connect_error) {
    die("<center><h2>Please contact site Administrator.</h2><br><h3>DB: Connection failed:<br>"
     . $db_conn_web->connect_error . "</h3></center>");
} else {
    $db_conn_web_status = 1;
};


$db_conn_surftimer -> set_charset("utf8mb4");
$db_conn_web -> set_charset("utf8mb4");

