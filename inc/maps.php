<?php

$sql_maps = "SELECT * FROM `ck_maptier`";
$results_maps = mysqli_query($db_conn, $sql_maps);
$maps = array();
if(mysqli_num_rows($results_maps) > 0){
    while($row_maps = mysqli_fetch_assoc($results_maps)){
        $maps[] = $row_maps;
    }
};
