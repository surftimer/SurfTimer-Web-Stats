<?php

// Total Players
$sql_total_players = "SELECT COUNT(steamid) as count FROM `ck_playeroptions2`";
$result_total_players = mysqli_query($db_conn, $sql_total_players);
$row_total_players = $result_total_players->fetch_assoc();
$total_players = $row_total_players['count'];

// Select Total timer Maps
$sql_total_maps = "SELECT COUNT('mapname') as count FROM `ck_maptier`";
$result_total_maps = mysqli_query($db_conn, $sql_total_maps);
$row_total_maps = $result_total_maps->fetch_assoc();
$total_maps = $row_total_maps['count'];

$sql_total_bonuses = "SELECT COUNT(DISTINCT a.mapname,zonegroup) as count FROM ck_zones a RIGHT JOIN ck_maptier b ON a.mapname = b.mapname WHERE a.zonegroup > 0;";
$result_total_bonuses = mysqli_query($db_conn, $sql_total_bonuses);
$row_total_bonuses = $result_total_bonuses->fetch_assoc();
$total_bonuses = $row_total_bonuses['count'];

// Select Total count of player times
$sql_count_player_times = "SELECT COUNT(*) as count FROM `ck_playertimes` WHERE style='0'";
$result_count_player_times = mysqli_query($db_conn, $sql_count_player_times);
$row_count_player_times = $result_count_player_times->fetch_assoc();
$count_player_times = $row_count_player_times['count'];

// Recet 10 records
$sql_r10r = "SELECT ck_latestrecords.*, ck_playerrank.name as normal_name, ck_playerrank.* FROM `ck_latestrecords` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_latestrecords.steamid WHERE style='0' ORDER BY `ck_latestrecords`.`date` DESC LIMIT 10";
$results_r10r = mysqli_query($db_conn, $sql_r10r);
$r10rs = array();
if(mysqli_num_rows($results_r10r) > 0){
    while($row_r10r = mysqli_fetch_assoc($results_r10r))
        $r10rs[] = $row_r10r;
};

// Top 10 players
$sql_t10p = "SELECT ck_playerrank.* FROM ck_playerrank WHERE style='0' ORDER BY points DESC LIMIT 10";
$results_t10p = mysqli_query($db_conn, $sql_t10p);
$t10ps = array();
if(mysqli_num_rows($results_t10p) > 0){
    while($row_t10p = mysqli_fetch_assoc($results_t10p))
        $t10ps[] = $row_t10p;
};

// TOP 10 WR holders
$sql_t10wrh = "SELECT ck_playerrank.*FROM ck_playerrank WHERE style='0' ORDER BY ck_playerrank.wrs DESC LIMIT 10";
$results_t10wrh = mysqli_query($db_conn, $sql_t10wrh);
$t10wrhs = array();
if(mysqli_num_rows($results_t10wrh) > 0){
    while($row_t10wrh = mysqli_fetch_assoc($results_t10wrh))
        $t10wrhs[] = $row_t10wrh;
};

// TOP 10 Bonus WR holders
$sql_t10bwrh = "SELECT ck_playerrank.* FROM ck_playerrank WHERE style='0' ORDER BY ck_playerrank.wrbs DESC LIMIT 10";
$results_t10bwrh = mysqli_query($db_conn, $sql_t10bwrh);
$t10wbrhs = array();
if(mysqli_num_rows($results_t10bwrh) > 0){
    while($row_t10bwrh = mysqli_fetch_assoc($results_t10bwrh))
        $t10bwrhs[] = $row_t10bwrh;
};

// TOP 10 Stage WR holders
$sql_t10swrh = "SELECT ck_playerrank.* FROM ck_playerrank WHERE style='0' ORDER BY ck_playerrank.wrcps DESC LIMIT 10";
$results_t10swrh = mysqli_query($db_conn, $sql_t10swrh);
$t10swrhs = array();
if(mysqli_num_rows($results_t10swrh) > 0){
    while($row_t10swrh = mysqli_fetch_assoc($results_t10swrh))
        $t10swrhs[] = $row_t10swrh;
};
