<?php

$sql_top_players = "SELECT ck_playerrank.* FROM ck_playerrank WHERE style='0' ORDER BY points DESC LIMIT 10";
$results_top_players = mysqli_query($db_conn, $sql_top_players);
$top_players = array();
if(mysqli_num_rows($results_top_players) > 0){
    while($row_top_players = mysqli_fetch_assoc($results_top_players)){
        $top_players[] = $row_top_players;
    }
}