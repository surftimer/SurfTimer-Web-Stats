<?php

$sql_total_players = "SELECT COUNT(steamid) as count FROM `ck_playeroptions2`";
$result_total_players = mysqli_query($db_conn_surftimer, $sql_total_players);
$row_total_players = $result_total_players->fetch_assoc();
$total_players = $row_total_players['count'];

// Select Total timer Maps, Bonuses, Stages
$sql_total_maps = "SELECT COUNT(mapname) AS map_count, SUM(bonuses) AS map_bonuses_count, SUM(stages) AS map_stages_count FROM `ck_maptier`";
$result_total_maps = mysqli_query($db_conn_surftimer, $sql_total_maps);
$row_total_maps = $result_total_maps->fetch_assoc();
$total_maps     = $row_total_maps['map_count'];
$total_bonuses  = $row_total_maps['map_bonuses_count'];