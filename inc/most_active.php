<?php
    if($settings_most_active_enable):
        $sql_most_active = "SELECT ck_playerrank.*, ck_playerrank.timealive+ck_playerrank.timespec as totaltime FROM ck_playerrank WHERE style='0' AND ck_playerrank.timealive+ck_playerrank.timespec>='7200' ORDER BY totaltime DESC";
        $results_most_active = mysqli_query($db_conn, $sql_most_active);
        $most_actives = array();
        if(mysqli_num_rows($results_most_active) > 0){
            while($row_most_active = mysqli_fetch_assoc($results_most_active))
                $most_actives[] = $row_most_active;
        };
    endif;