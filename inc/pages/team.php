<?php

$sql_team_users_position_less_20 = "SELECT surfcommunity_surftimer.ck_playerrank.*, web_admins_list.* FROM web_admins_list LEFT JOIN surfcommunity_surftimer.ck_playerrank ON ck_playerrank.steamid=web_admins_list.steamid WHERE style='0' AND position<20 ORDER BY web_admins_list.position ASC";
$results_team_users_position_less_20 = mysqli_query($db_conn_web, $sql_team_users_position_less_20);
$team_users_position_less_20 = array();
if(mysqli_num_rows($results_team_users_position_less_20) > 0){
    while($row_team_users_position_less_20 = mysqli_fetch_assoc($results_team_users_position_less_20)){
        $team_users_position_less_20[] = $row_team_users_position_less_20;
    }
}

$sql_team_users_position_above_20 = "SELECT surfcommunity_surftimer.ck_playerrank.*, web_admins_list.* FROM web_admins_list LEFT JOIN surfcommunity_surftimer.ck_playerrank ON ck_playerrank.steamid=web_admins_list.steamid WHERE style='0' AND position>=20 ORDER BY web_admins_list.position ASC";
$results_team_users_position_above_20 = mysqli_query($db_conn_web, $sql_team_users_position_above_20);
$team_users_position_above_20 = array();
if(mysqli_num_rows($results_team_users_position_above_20) > 0){
    while($row_team_users_position_above_20 = mysqli_fetch_assoc($results_team_users_position_above_20)){
        $team_users_position_above_20[] = $row_team_users_position_above_20;
    }
}