<?php

if(isset($mapname)):

    $sql_map = "SELECT * FROM `ck_maptier` WHERE mapname=?";
    $stmt_map = mysqli_stmt_init($db_conn);

    if(mysqli_stmt_prepare($stmt_map, $sql_map)):

        mysqli_stmt_bind_param($stmt_map,"s", $mapname);
        mysqli_stmt_execute($stmt_map);
        $results_map = mysqli_stmt_get_result($stmt_map);
        
        if(mysqli_num_rows($results_map) > 0):
            
            $row_map = mysqli_fetch_assoc($results_map);

            $map_name = $row_map['mapname'];
            $map_tier = $row_map['tier'];
            $map_maxvelocity = $row_map['maxvelocity'];

            $sql_map_stages = "SELECT COUNT(zonetype) as stages FROM `ck_zones` WHERE mapname='$map_name' AND zonetype='3';";
            $sql_map_bonuses = "SELECT zonegroup FROM `ck_zones` WHERE mapname='$map_name' ORDER BY `ck_zones`.`zonegroup` DESC LIMIT 1;";
            $results_map_stages = mysqli_query($db_conn, $sql_map_stages);
            $results_map_bonuses = mysqli_query($db_conn, $sql_map_bonuses);
            $row_map_stages = $results_map_stages->fetch_assoc();
            $row_map_bonuses = $results_map_bonuses->fetch_assoc();
            
            $map_stages = $row_map_stages['stages'] + 1;
            $map_bonuses = $row_map_bonuses['zonegroup'];

            $map_stages_info = $map_stages;
            if($map_stages_info == '1')
                $map_stages_info = 'Linear';
            elseif($map_stages_info > '1')
                $map_stages_info = 'Staged ('.$map_stages_info.')';
            else
                $map_stages_info = '<span class="text-muted">Null</span>';
            
            $map_bonuses_info = $map_bonuses;
            if($map_bonuses_info == '0')
                $map_bonuses_info = 'No Bonus';
            elseif($map_bonuses_info == NULL)
                $map_bonuses_info = '<span class="text-muted">Null</span>';

        
            $sql_map_total_completions_count = "SELECT COUNT(mapname) as count FROM `ck_playertimes` WHERE mapname='$map_name'";
            $sql_map_normal_completions_count = "SELECT COUNT(mapname) as count FROM `ck_playertimes` WHERE mapname='$map_name' AND style='0'";
            $sql_map_total_bonuses_completions_count = "SELECT COUNT(mapname) as count FROM `ck_bonus` WHERE mapname='$map_name'";
            $sql_map_normal_bonuses_completions_count = "SELECT COUNT(mapname) as count FROM `ck_bonus` WHERE mapname='$map_name' AND style='0'";

            $results_map_total_completions_count = mysqli_query($db_conn, $sql_map_total_completions_count);
            $results_map_normal_completions_count = mysqli_query($db_conn, $sql_map_normal_completions_count);
            $results_map_total_bonuses_completions_count = mysqli_query($db_conn, $sql_map_total_bonuses_completions_count);
            $results_map_normal_bonuses_completions_count = mysqli_query($db_conn, $sql_map_normal_bonuses_completions_count);

            $row_map_total_completions_count = mysqli_fetch_assoc($results_map_total_completions_count);
            $row_map_normal_completions_count = mysqli_fetch_assoc($results_map_normal_completions_count);
            $row_map_total_bonuses_completions_count = mysqli_fetch_assoc($results_map_total_bonuses_completions_count);
            $row_map_normal_bonuses_completions_count = mysqli_fetch_assoc($results_map_normal_bonuses_completions_count);

            $map_total_completions_count = $row_map_total_completions_count['count'];
            $map_normal_completions_count = $row_map_normal_completions_count['count'];
            $map_total_bonuses_completions_count = $row_map_total_bonuses_completions_count['count'];
            $map_normal_bonuses_completions_count = $row_map_normal_bonuses_completions_count['count'];

            if($sql_map_normal_completions_count!==0):
                
                $sql_map_completions = "SELECT ck_playertimes.*, ck_playerrank.name as goodname, ck_playerrank.steamid64 FROM `ck_playertimes` LEFT JOIN `ck_playerrank` ON ck_playerrank.steamid=ck_playertimes.steamid AND ck_playerrank.style=ck_playertimes.steamid WHERE mapname='$map_name' AND ck_playertimes.style='0'";
                $results_map_completions = mysqli_query($db_conn, $sql_map_completions);
                $map_completions = array();
                
                while($row_map_completions = mysqli_fetch_assoc($results_map_completions)){
                    $map_completions[] = $row_map_completions;
                }

            endif;

            if($map_stages>'1'):

                $map_top_stages = array();
                $map_top_stages_while = 0; 
                
                while(++$map_top_stages_while <= $map_stages):
                    
                    $sql_map_total_stage_completions = "SELECT COUNT(steamid) as stage_completions FROM `ck_wrcps` WHERE mapname='$map_name' AND stage='$map_top_stages_while' AND style='0'";
                    $result_map_total_stage_completions = mysqli_query($db_conn, $sql_map_total_stage_completions);
                    $row_map_total_stage_completions = $result_map_total_stage_completions->fetch_assoc();

                    $sql_stage_top_time = "SELECT ck_wrcps.*, ck_playerrank.name as goodname, ck_playerrank.steamid64 FROM `ck_wrcps` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_wrcps.steamid AND ck_playerrank.style=ck_wrcps.style WHERE mapname='$map_name' AND stage='$map_top_stages_while' AND ck_wrcps.style='0' ORDER BY `ck_wrcps`.`runtimepro`  ASC LIMIT 1";
                    $result_stage_top_time = mysqli_query($db_conn, $sql_stage_top_time);
                    $row_stage_top_time = $result_stage_top_time->fetch_assoc();

                    if(isset($row_stage_top_time['goodname']))
                        $stage_top_time_username = $row_stage_top_time['goodname'];
                    elseif(isset($row_stage_top_time['name']))
                        $stage_top_time_username = $row_stage_top_time['name'];
                    else
                        $stage_top_time_username = '<small class="text-muted">N/A</small>';
                    
                    if(isset($row_stage_top_time['steamid64']))
                        $stage_top_time_steamprofile = ' <a href="https://steamcommunity.com/profiles/'.$row_stage_top_time['steamid64'].'" target="_blank" title="'.$stage_top_time_username.' - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a>';
                    else
                        $stage_top_time_steamprofile = '';

                    if(isset($row_stage_top_time['runtimepro'])):
                        $stage_top_time_runtime_microtime = substr($row_stage_top_time['runtimepro'], strpos($row_stage_top_time['runtimepro'], ".") + 1);    
                        $stage_top_time_runtime_timeformat = gmdate("i:s", $row_stage_top_time['runtimepro']).'<span class="text-muted">.'.$stage_top_time_runtime_microtime.'</span>';
                    else:
                        $stage_top_time_runtime_timeformat = '<small class="text-muted">N/A</small>';
                    endif;

                    $map_top_stages[] = array($map_top_stages_while, $stage_top_time_username.$stage_top_time_steamprofile, $stage_top_time_runtime_timeformat, $row_map_total_stage_completions['stage_completions']);
                
                endwhile;

            endif;

            if($map_bonuses>'0'):

                $map_bonuses_completions_counts = array();
                $map_bonuses_completions_count_while = 0;

                while(++$map_bonuses_completions_count_while <= $map_bonuses):

                    $sql_bonus_completions_count = "SELECT COUNT(steamid) as bonus_completions FROM `ck_bonus` WHERE mapname='$map_name' AND zonegroup='$map_bonuses_completions_count_while' AND style='0'";
                    $result_bonus_completions_count = mysqli_query($db_conn, $sql_bonus_completions_count);
                    $row_bonus_completions_count = $result_bonus_completions_count->fetch_assoc();
                    $map_bonuses_completions_counts[] = $row_bonus_completions_count['bonus_completions'];

                endwhile;


                $map_bonuses_completions = array();
                $map_bunuses_completions_while = 0;

                while(++$map_bunuses_completions_while <= $map_bonuses):

                    $sql_map_bonuses_completions = "SELECT ck_bonus.*, ck_playerrank.name as goodname, ck_playerrank.steamid64 FROM `ck_bonus` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_bonus.steamid AND ck_playerrank.style=ck_bonus.style WHERE mapname='$map_name' AND zonegroup='$map_bunuses_completions_while' AND ck_bonus.style='0' ORDER BY `ck_bonus`.`runtime` ASC";
                    $result_map_bonuses_completions = mysqli_query($db_conn, $sql_map_bonuses_completions);

                    $map_bonuses_completions_rows = array();

                    if(mysqli_num_rows($result_map_bonuses_completions) > 0){
                        while($row_map_bonuses_completions = mysqli_fetch_assoc($result_map_bonuses_completions)){
                            $map_bonuses_completions_rows[] = $row_map_bonuses_completions;
                        }
                    };

                    $map_bonuses_completions[] = $map_bonuses_completions_rows;

                endwhile;

            endif;

        endif;
        
    else:
        echo 'STMT Error';
    endif;

else:

    $sql_maps = "SELECT * FROM `ck_maptier`";
    $results_maps = mysqli_query($db_conn, $sql_maps);
    $maps = array();
    if(mysqli_num_rows($results_maps) > 0){
        while($row_maps = mysqli_fetch_assoc($results_maps)){
            $maps[] = $row_maps;
        }
    };

endif;