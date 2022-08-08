<?php

    require_once('./../config.php');
    require_once('./../database.php');
    require_once('./../functions.php');

    if(isset($_POST['player_id'])) {
        $player_id = $_POST['player_id'];
    } elseif(empty($player_id))
    $player_id = 'Unknown';


    if((!empty($player_id))&&($player_id!=="")&&($player_id!=='Unknown')):

        $stmt_status = 0;
        $sql_select_user_profile = "SELECT * FROM `ck_playerrank` WHERE steamid64=? AND style='0' LIMIT 1";   
        $stmt_profile = mysqli_stmt_init($db_conn_surftimer);

        if(mysqli_stmt_prepare($stmt_profile, $sql_select_user_profile)):
            $stmt_status = 1;

            mysqli_stmt_bind_param($stmt_profile,"s", $player_id);
            mysqli_stmt_execute($stmt_profile);
            $result_select_user_profile = mysqli_stmt_get_result($stmt_profile);

            $row_sup = $result_select_user_profile->fetch_assoc();

            if($result_select_user_profile->num_rows > 0):

                // Basic Info
                $usr_steamid        = $row_sup['steamid'];
                $usr_steamid64      = $row_sup['steamid64'];
                $usr_name           = $row_sup['name'];
                $usr_country        = $row_sup['country'];
                if($config_player_flags){
                    $usr_countryCode    = $row_sup['countryCode'];
                    $usr_continentCode  = $row_sup['continentCode'];
                }
                $usr_joined         = $row_sup['joined'];
                $usr_last_seen      = $row_sup['lastseen'];

                $usr_joined_time_date = new DateTime();
                $usr_joined_time_date->setTimestamp($usr_joined);
                $usr_joined_time_date = $usr_joined_time_date->format('Y/m/d');

                $usr_joined_time = new DateTime();
                $usr_joined_time->setTimestamp($usr_joined);
                $usr_joined_time = $usr_joined_time->format('(H:i)');

                $date_today = date('Y/m/d H:i');
                $date_today_day = date('Y/m/d');
                $date_today_c = date_create($date_today);


                $usr_last_seen_nounix = new DateTime();
                $usr_last_seen_nounix->setTimestamp($usr_last_seen);
                $usr_last_seen_nounix = $usr_last_seen_nounix->format('Y/m/d H:i');

                $usr_last_seen_edit = date('Y/m/d  H:i', strtotime($usr_last_seen_nounix));
                $usr_last_seen_edit_day = date('Y/m/d', strtotime($usr_last_seen_nounix));
                $usr_last_seen_edit_t = date('d. m. Y', strtotime($usr_last_seen_nounix));
                $usr_last_seen_edit_c = date_create($usr_last_seen_edit_day);
                
                $usr_last_seen_edit_diff = date_diff($date_today_c, $usr_last_seen_edit_c);
                $usr_last_seen_edit_diff = $usr_last_seen_edit_diff->format("%a");
                
                if($date_today_day == $usr_last_seen_edit_day)
                    $usr_last_seen_edit_d = "<b>Today</b>";
                elseif($usr_last_seen_edit_diff==1)
                    $usr_last_seen_edit_d = "<b>Yesterday</b>";
                else
                    $usr_last_seen_edit_d = "<b>".$usr_last_seen_edit_diff."</b> days ago";

                // User stats
                $usr_points             = $row_sup['points'];
                $usr_wrpoints           = $row_sup['wrpoints'];
                $usr_wrbpoints          = $row_sup['wrbpoints'];
                $usr_wrcppoints         = $row_sup['wrcppoints'];
                $usr_top10points        = $row_sup['top10points'];
                $usr_groupspoints       = $row_sup['groupspoints'];
                $usr_mappoints          = $row_sup['mappoints'];
                $usr_bonuspoints        = $row_sup['bonuspoints'];
                $usr_finishedmaps       = $row_sup['finishedmapspro'];
                $usr_finishedbonuses    = $row_sup['finishedbonuses'];
                $usr_finishedstages     = $row_sup['finishedstages'];
                $usr_wrs                = $row_sup['wrs'];
                $usr_wrbs               = $row_sup['wrbs'];
                $usr_wrcps              = $row_sup['wrcps'];
                $usr_top10s             = $row_sup['top10s'];
                $usr_groups             = $row_sup['groups'];
                $usr_timealive          = $row_sup['timealive'];
                $usr_timespec           = $row_sup['timespec'];
                $usr_conections         = $row_sup['connections'];

                $usr_timetotal = $usr_timealive+$usr_timespec;
                $usr_timetotal_hrs = (($usr_timetotal/60)/60);

                $usr_timealive_hrs = (($usr_timealive/60)/60);
                $usr_timespec_hrs  = (($usr_timespec/60)/60);

                if($usr_timetotal!=0):
                    $usr_timealive_hrs_percentuage = intval(($usr_timealive/$usr_timetotal)*100);
                    $usr_timespec_hrs_percentuage = intval(($usr_timespec/$usr_timetotal)*100);
                else:
                    $usr_timealive_hrs_percentuage = 100;
                    $usr_timespec_hrs_percentuage = 100;
                endif;

                // Select Total timer Maps, Bonuses, Stages
                $sql_total_maps = "SELECT COUNT(mapname) AS map_count, SUM(bonuses) AS map_bonuses_count, SUM(stages) AS map_stages_count FROM `ck_maptier`";
                $result_total_maps = mysqli_query($db_conn_surftimer, $sql_total_maps);
                $row_total_maps = $result_total_maps->fetch_assoc();
                $total_maps     = $row_total_maps['map_count'];
                $total_bonuses  = $row_total_maps['map_bonuses_count'];
                $total_stages  = $row_total_maps['map_stages_count'];

                // Select Total timer Players
                $sql_total_players = "SELECT COUNT(steamid) AS player_count FROM `ck_playeroptions2`";
                $result_total_players = mysqli_query($db_conn_surftimer, $sql_total_players);
                $row_total_players = $result_total_players->fetch_assoc();
                $total_players     = $row_total_players['player_count'];


                $total_timer_sum = $total_maps+$total_bonuses+$total_stages;
                    
                $usr_finished_sum = $usr_finishedmaps+$usr_finishedbonuses+$usr_finishedstages;
                $usr_finished_sum_percentuage = intval(($usr_finished_sum/max($total_timer_sum, 1))*100);

                $usr_finishedmaps_percentuage = intval(($usr_finishedmaps/max($total_bonuses, 1))*100);
                $usr_finishedbonuses_percentuage = intval(($usr_finishedbonuses/max($total_bonuses, 1))*100);
                $usr_finishedstages_percentuage = intval(($usr_finishedstages/max($total_stages, 1))*100);
                if($usr_finishedmaps!=0)
                    $usr_top10s_percentuage = intval(($usr_top10s/$usr_finishedmaps)*100);
                else
                    $usr_top10s_percentuage = '100';
                
                $sql_select_user_rank = "SELECT COUNT(steamid) as rank_position FROM ck_playerrank WHERE style = 0 AND points >= (SELECT points FROM ck_playerrank WHERE steamid = '$usr_steamid' AND style = 0) ORDER BY points";
                $result_select_user_rank = $db_conn_surftimer->query($sql_select_user_rank);
                $row_sur = $result_select_user_rank->fetch_assoc();

                $usr_position = $row_sur['rank_position'];

                $map_tier_completions = array();
                $map_tier=1; while($map_tier<=8):
                    $sql_select_map_tier_count = "SELECT COUNT(mapname) AS map_tier_count, SUM(bonuses) AS map_tier_bonuses_count, SUM(stages) AS map_tier_stages_count FROM `ck_maptier` WHERE tier='$map_tier'";
                    $result_select_map_tier_count = $db_conn_surftimer->query($sql_select_map_tier_count);
                    $row_smtc = $result_select_map_tier_count->fetch_assoc();
                    $map_tier_count = $row_smtc['map_tier_count'];
                    $map_tier_bonuses_count = $row_smtc['map_tier_bonuses_count'];

                    $sql_select_map_tier_stages = "SELECT  SUM(stages) AS map_tier_stages_count FROM `ck_maptier` WHERE stages!='1' AND tier='$map_tier'";
                    $result_select_map_tier_stages = $db_conn_surftimer->query($sql_select_map_tier_stages);
                    $row_smts = $result_select_map_tier_stages->fetch_assoc();
                    if(isset($row_smts['map_tier_stages_count']))
                        $map_tier_stages_count = $row_smts['map_tier_stages_count'];
                    else
                        $map_tier_stages_count = 0;

                    $sql_select_map_tier_finished_maps = "SELECT COUNT(ck_playertimes.mapname) AS map_tier_finished_maps FROM `ck_playertimes` LEFT JOIN ck_maptier ON ck_maptier.mapname=ck_playertimes.mapname WHERE ck_playertimes.steamid='$usr_steamid' AND ck_playertimes.style='0' AND ck_maptier.tier='$map_tier'";
                    $result_select_map_tier_finished_maps = $db_conn_surftimer->query($sql_select_map_tier_finished_maps);
                    $row_smtfm = $result_select_map_tier_finished_maps->fetch_assoc();
                    $map_tier_finished_maps = $row_smtfm['map_tier_finished_maps'];

                    $sql_select_map_tier_finished_bonuses = "SELECT COUNT(ck_bonus.mapname) AS map_tier_finished_bonuses FROM `ck_bonus` LEFT JOIN ck_maptier ON ck_bonus.mapname=ck_maptier.mapname WHERE ck_bonus.steamid='$usr_steamid' AND ck_bonus.style='0' AND ck_maptier.tier='$map_tier'";
                    $result_select_map_tier_finished_bonuses = $db_conn_surftimer->query($sql_select_map_tier_finished_bonuses);
                    $row_smtfb = $result_select_map_tier_finished_bonuses->fetch_assoc();
                    $map_tier_finished_bonuses = $row_smtfb['map_tier_finished_bonuses'];

                    $sql_select_map_tier_finished_stages = "SELECT COUNT(ck_wrcps.mapname) AS map_tier_finished_stages FROM `ck_wrcps` LEFT JOIN ck_maptier ON ck_wrcps.mapname=ck_maptier.mapname WHERE steamid='$usr_steamid' AND style='0' AND ck_maptier.tier='$map_tier'";
                    $result_select_map_tier_finished_stages = $db_conn_surftimer->query($sql_select_map_tier_finished_stages);
                    $row_smtfs = $result_select_map_tier_finished_stages->fetch_assoc();
                    $map_tier_finished_stages = $row_smtfs['map_tier_finished_stages'];

                    $map_tier_count_percentuage = intval(($map_tier_finished_maps/max($map_tier_count, 1))*100);
                    $map_tier_bonuses_count_percentuage = intval(($map_tier_finished_bonuses/max($map_tier_bonuses_count, 1))*100);
                    if(isset($row_smts['map_tier_stages_count']))
                        $map_tier_stages_count_percentuage = intval(($map_tier_finished_stages/max($map_tier_stages_count, 1))*100);
                    else
                    $map_tier_stages_count_percentuage = 0;
                    $map_tier_completions[] = array($map_tier, $map_tier_finished_maps, $map_tier_count, $map_tier_count_percentuage, $map_tier_finished_bonuses, $map_tier_bonuses_count, $map_tier_bonuses_count_percentuage, $map_tier_finished_stages, $map_tier_stages_count,  $map_tier_stages_count_percentuage);
                $map_tier++; endwhile;

                // MAP WRS BY Player
                    if($usr_finishedmaps>0):
                        $sql_select_player_wrs = "SELECT a.mapname, runtimepro, date, FIND_IN_SET(runtimepro, (SELECT GROUP_CONCAT(runtimepro order by runtimepro ASC) FROM ck_playertimes WHERE mapname = a.mapname AND style = 0)) as maprank, tier FROM ck_playertimes a INNER JOIN ck_maptier b on a.mapname = b.mapname WHERE steamid = '$usr_steamid' AND runtimepro > '0.0' and style= '0' ORDER BY `b`.`tier` DESC";
                        $result_select_player_wrs = $db_conn_surftimer->query($sql_select_player_wrs);
                        $player_wrs = array();
                        if(mysqli_num_rows($result_select_player_wrs) > 0){
                            while($row_select_player_wrs = mysqli_fetch_assoc($result_select_player_wrs))
                                $player_wrs[] = $row_select_player_wrs;
                        };
                    endif;
                
                // MAP WRBs BY Player
                    if($usr_finishedbonuses>0):
                        $sql_select_player_wrbs = "SELECT a.mapname, runtime, a.zonegroup, date, FIND_IN_SET(runtime, (SELECT GROUP_CONCAT(runtime order by runtime ASC) FROM ck_bonus WHERE mapname = a.mapname AND zonegroup = a.zonegroup AND style = 0)) as maprank, tier FROM ck_bonus a INNER JOIN ck_maptier b on a.mapname = b.mapname WHERE steamid = '$usr_steamid' AND runtime > '0.0' and style = '0' ORDER BY `maprank` ASC";
                        $result_select_player_wrbs = $db_conn_surftimer->query($sql_select_player_wrbs);
                        $player_wrbs = array();
                        if(mysqli_num_rows($result_select_player_wrbs) > 0){
                            while($row_select_player_wrbs = mysqli_fetch_assoc($result_select_player_wrbs))
                                $player_wrbs[] = $row_select_player_wrbs;
                        };
                    endif;
                
                // MAP WRCPs BY Player
                if($usr_finishedstages>0):
                    $sql_select_player_wrcps = "SELECT a.mapname, runtimepro, a.stage, date, FIND_IN_SET(runtimepro, (SELECT GROUP_CONCAT(runtimepro order by runtimepro ASC) FROM ck_wrcps WHERE mapname = a.mapname AND stage = a.stage AND style = 0)) as maprank, tier FROM ck_wrcps a INNER JOIN ck_maptier b on a.mapname = b.mapname WHERE steamid = '$usr_steamid' AND runtimepro > '0.0' and style = '0'";
                    $result_select_player_wrcps = $db_conn_surftimer->query($sql_select_player_wrcps);
                    $player_wrcps = array();
                    if(mysqli_num_rows($result_select_player_wrcps) > 0){
                        while($row_select_player_wrcps = mysqli_fetch_assoc($result_select_player_wrcps))
                            $player_wrcps[] = $row_select_player_wrcps;
                    };
                endif;
                    
            endif;
        endif;
    endif;
?>

<script>
    <?php if(!empty($usr_finishedmaps)):?>
        $('#map-wrs-by-player').DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            responsive: true,
            "processing": true,
            "order": [[ 2, "asc" ]],
            "columnDefs": [
                { "className": "text-left pl-3 align-middle", "targets": [ 0 ] },
                { "className": "text-center align-middle", "targets": [ 1 ] },
                { "className": "text-center align-middle", "targets": [ 2 ] },
                { "className": "text-center align-middle", "targets": [ 3 ] },
                { "className": "text-center align-middle", "targets": [ 4 ] }
            ],
            "data": [
                <?php foreach($player_wrs as $player_wr): ?>
                    <?php
                        $player_wr_runtime = $player_wr['runtimepro'];
                        $player_wr_runtime_microtime = substr($player_wr_runtime, strpos($player_wr_runtime, ".") + 1);
                        $player_wr_runtime_timeformat = gmdate("i:s", $player_wr['runtimepro']).'<span class="text-muted">.'.$player_wr_runtime_microtime.'</span>';
                        $player_wr_date = $player_wr['date'];
                        if($player_wr_date>'2021-03-03 10:49:50') 
                            $player_wr_date =  '<small class="">'.date('Y/m/d  (H:i)', strtotime($player_wr['date'])).'</small>';
                        else 
                            $player_wr_date = '<small class="text-muted">N/A</small>';
                        
                    ?>
                    [
                        '<a href="dashboard-maps.php?map=<?php echo  $player_wr['mapname']; ?>" class="text-muted text-decoration-none"><?php echo $player_wr["mapname"]; ?> <i class="fas fa-link"></i></a>',
                        '<?php echo $player_wr["tier"]; ?>',
                        '<?php echo $player_wr["maprank"]; ?>',
                        '<?php echo $player_wr_runtime_timeformat; ?>',
                        '<?php echo $player_wr_date; ?>'
                    ],
                <?php endforeach; ?>
            ]
        });
    <?php endif; ?>
    <?php if(!empty($usr_finishedbonuses)):?>
        $('#map-wrbs-by-player').DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            responsive: true,
            "processing": true,
            "order": [[ 3, "asc" ]],
            "columnDefs": [
                { "className": "text-left pl-3 align-middle", "targets": [ 0 ] },
                { "className": "text-center align-middle", "targets": [ 1 ] },
                { "className": "text-center align-middle", "targets": [ 2 ] },
                { "className": "text-center align-middle", "targets": [ 3 ] },
                { "className": "text-center align-middle", "targets": [ 4 ] },
                { "className": "text-center align-middle", "targets": [ 5 ] }
            ],
            "data": [
                <?php foreach($player_wrbs as $player_wrb): ?>
                    <?php
                        $player_wrb_runtime = $player_wrb['runtime'];
                        $player_wrb_runtime_microtime = substr($player_wrb_runtime, strpos($player_wrb_runtime, ".") + 1);    
                        $player_wrb_runtime_timeformat = gmdate("i:s", $player_wrb['runtime']).'<span class="text-muted">.'.$player_wrb_runtime_microtime.'</span>';
                        $player_wrb_date = $player_wrb['date'];
                        if($player_wrb_date>'2021-03-03 10:51:48') 
                            $player_wrb_date =  '<small class="">'.date('Y/m/d  (H:i)', strtotime($player_wrb['date'])).'</small>';
                        else 
                            $player_wrb_date = '<small class="text-muted">N/A</small>';
                    ?>
                    [
                        '<a href="dashboard-maps.php?map=<?php echo  $player_wrb['mapname']; ?>" class="text-muted text-decoration-none"><?php echo $player_wrb["mapname"]; ?> <i class="fas fa-link"></i></a>',
                        '<?php echo $player_wrb["tier"]; ?>',
                        '<?php echo $player_wrb["zonegroup"]; ?>',
                        '<?php echo $player_wrb["maprank"]; ?>',
                        '<?php echo $player_wrb_runtime_timeformat; ?>',
                        '<?php echo $player_wrb_date; ?>'
                    ],
                <?php endforeach; ?>
            ]
        });
    <?php endif; ?>
    <?php if(!empty($usr_finishedstages)):?>
        $('#map-wrcps-by-player').DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            responsive: true,
            "processing": true,
            "order": [[ 3, "asc" ]],
            "columnDefs": [
                { "className": "text-left pl-3 align-middle", "targets": [ 0 ] },
                { "className": "text-center align-middle", "targets": [ 1 ] },
                { "className": "text-center align-middle", "targets": [ 2 ] },
                { "className": "text-center align-middle", "targets": [ 3 ] },
                { "className": "text-center align-middle", "targets": [ 4 ] },
                { "className": "text-center align-middle", "targets": [ 5 ] }
            ],
            "data": [
                <?php foreach($player_wrcps as $player_wrcp): ?>
                    <?php
                        $player_wrcp_runtime = $player_wrcp['runtimepro'];
                        $player_wrcp_runtime_microtime = substr($player_wrcp_runtime, strpos($player_wrcp_runtime, ".") + 1);    
                        $player_wrcp_runtime_timeformat = gmdate("i:s", $player_wrcp['runtimepro']).'<span class="text-muted">.'.$player_wrcp_runtime_microtime.'</span>';
                        $player_wrcp_date = $player_wrcp['date'];
                        if($player_wrcp_date>'2021-03-03 10:51:31') 
                            $player_wrcp_date =  '<small class="">'.date('Y/m/d  (H:i)', strtotime($player_wrcp['date'])).'</small>';
                        else 
                            $player_wrcp_date = '<small class="text-muted">N/A</small>';
                    ?>
                    [
                        '<a href="dashboard-maps.php?map=<?php echo  $player_wrcp['mapname']; ?>" class="text-muted text-decoration-none"><?php echo $player_wrcp["mapname"]; ?> <i class="fas fa-link"></i></a>',
                        '<?php echo $player_wrcp["tier"]; ?>',
                        '<?php echo $player_wrcp["stage"]; ?>',
                        '<?php echo $player_wrcp["maprank"]; ?>',
                        '<?php echo $player_wrcp_runtime_timeformat; ?>',
                        '<?php echo $player_wrcp_date; ?>'
                    ],
                <?php endforeach; ?>
            ]
        });
    <?php endif; ?>
</script>


<?php
    if((!empty($player_id))&&($player_id!=="")&&($player_id!=='Unknown')&&($stmt_status===1)):
?>
    <h5><a href="dashboard-players.php" class="text-muted text-decoration-none">Surf Stat's Player Profile</a> / <?php echo $usr_steamid64; ?> <a href="https://steamcommunity.com/profiles/<?php echo $usr_steamid64; ?>" target="_blank" title="<?php echo $usr_name; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a></h5>
    <hr class="mt-0 mb-3">
    <div class="pt-3 pb-2">
        <h3 class="text-center"><?php echo $usr_name; ?></h3>
        <h4 class="text-center text-muted mb-2"><?php if($config_player_flags) {echo CountryFlagProfile($usr_countryCode, $usr_continentCode).' ';}; echo $usr_country; ?></h4>
        <div class="row justify-content-md-center mb-2">
            <div class="col-12 col-md-auto text-center">
                <span class="mr-1">Last seen:</span> <?php echo $usr_last_seen_edit_d; ?>
                <?php echo '<small class="text-muted">('.$usr_last_seen_nounix.')</small>'; ?>
            </div>
            <div class="col-12 col-md-auto text-center">
                <span class="mr-1">Joined:</span> <strong><?php echo $usr_joined_time_date; ?></strong> <small class="text-muted"><?php echo $usr_joined_time; ?></small>
            </div>
        </div>

        <div class="text-center">
            <?php
                // RANK badges
                if($usr_position=="1")
                    echo '<span class="badge shadow-sm bg-success">TOP 1</span>';
                elseif($usr_position=="2")
                    echo '<span class="badge shadow-sm bg-danger">TOP 2</span>';
                elseif($usr_position=="3")
                    echo '<span class="badge shadow-sm bg-warning">TOP 3</span>';
                elseif($usr_position<="10")
                    echo '<span class="badge shadow-sm bg-info">TOP 10</span>';
                elseif($usr_position<="25")
                    echo '<span class="badge shadow-sm bg-primary">TOP 25</span>';
                elseif($usr_position<="50")
                    echo '<span class="badge shadow-sm bg-secondary">TOP 50</span>';
                elseif($usr_position<="100")
                    echo '<span class="badge shadow-sm bg-secondary">TOP 100</span>';
                elseif($usr_position<="250")
                    echo '<span class="badge shadow-sm bg-secondary">TOP 250</span>';
                elseif($usr_position<="500")
                    echo '<span class="badge shadow-sm bg-secondary">TOP 500</span>';
            ?>
        </div>

        <hr class="mt-4 mb-2">
        <!-- Progress Bar -->
        <div class="text-center my-2">
            <h5 class="my-0">User Total Completion Progress</h5>
            <small class="text-muted my-0">(<?php echo number_format($usr_finished_sum); ?> / <?php echo number_format($total_timer_sum); ?>)</small>
        </div>
        <div class="progress mb-3 shadow-sm">
            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" aria-valuenow="<?php echo $usr_finished_sum; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_timer_sum; ?>" style="width: <?php echo $usr_finished_sum_percentuage; ?>%">
                <?php if($usr_finished_sum_percentuage>=15) echo $usr_finished_sum_percentuage.'%'; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-borderless table-striped table-sm my-0">
                    <tbody>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Overall Rank</strong><td>
                            <td class='align-middle text-center'><strong><?php echo number_format($usr_position); ?></strong> / <?php echo number_format($total_players); ?><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Total Playtime</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_timetotal_hrs, 1); ?> hrs<td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Surfing Time</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_timealive_hrs, 1); ?> hrs <span class='text-muted'>(<?php echo $usr_timealive_hrs_percentuage; ?>%)</span><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Map Completions</strong><td>
                            <td class='align-middle text-center'><strong><?php echo number_format($usr_finishedmaps); ?></strong> / <?php echo number_format($total_maps); ?> <span class='text-muted'>(<?php echo $usr_finishedmaps_percentuage; ?>%)</span><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Bonus Completions</strong><td>
                            <td class='align-middle text-center'><strong><?php echo number_format($usr_finishedbonuses); ?></strong> / <?php echo number_format($total_bonuses); ?> <span class='text-muted'>(<?php echo $usr_finishedbonuses_percentuage; ?>%)</span><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Stage Completions</strong><td>
                            <td class='align-middle text-center'><strong><?php echo number_format($usr_finishedstages); ?></strong> / <?php echo number_format($total_stages); ?> <span class='text-muted'>(<?php echo $usr_finishedstages_percentuage; ?>%)</span><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Map Top 10s</strong><td>
                            <td class='align-middle text-center'><strong><?php echo number_format($usr_top10s); ?></strong> / <?php echo number_format($usr_finishedmaps); ?> <span class='text-muted'>(<?php echo $usr_top10s_percentuage; ?>%)</span><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Bonus WR Points</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_wrbpoints); ?><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Map Top 10s Points</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_top10points); ?><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Map Points</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_mappoints); ?><td>
                        </tr>
                    </tbody>    
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-borderless table-striped table-sm my-0">
                    <tbody>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Total Points</strong><td>
                            <td class='align-middle text-center'><strong><?php echo number_format($usr_points); ?></strong><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Total Connections</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_conections); ?><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Spectate Time</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_timespec_hrs, 1); ?> hrs <span class='text-muted'>(<?php echo $usr_timespec_hrs_percentuage; ?>%)</span><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Map Records</strong><td>
                            <td class='align-middle text-center'><strong class="text-success"><?php echo number_format($usr_wrs); ?></strong><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Bonus Records</strong><td>
                            <td class='align-middle text-center'><strong class="text-info"><?php echo number_format($usr_wrbs); ?></strong><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Stage Records</strong><td>
                            <td class='align-middle text-center'><strong class="text-warning"><?php echo number_format($usr_wrcps); ?></strong><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Map WR Points</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_wrpoints); ?><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Stage WR Points</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_wrcppoints); ?><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Group Points</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_groupspoints); ?><td>
                        </tr>
                        <tr>
                            <td class='align-middle'><strong class="pl-4">Bonus Points</strong><td>
                            <td class='align-middle text-center'><?php echo number_format($usr_bonuspoints); ?><td>
                        </tr>
                    </tbody>    
                </table> 
            </div>
        </div>
        <hr>
        <div class="text-center mt-4 mb-0">
            <h5 class="my-0">Player Completions by Map Tier</h5>
        </div>
        <div class="row">
            <?php foreach($map_tier_completions as $map_tier_completion): ?>
                <div class="col-12 col-md">
                    <div class="bg-stripped-color py-2 my-3 text-center rounded shadow-sm">
                        <h5 class='my-2'>Tier <strong><?php echo $map_tier_completion[0];?></strong></h5>
                        <h5 class="my-1"><small><i class="fas fa-map"></i> Maps</small><br><strong><?php echo $map_tier_completion[1]; ?></strong> / <?php echo $map_tier_completion[2]; ?> <small class="text-muted">(<?php echo $map_tier_completion[3]; ?>%)</small></h5>
                        <h6 class="my-1"><small><i class="fas fa-bold"></i> Bonuses</small><br><strong><?php echo $map_tier_completion[4]; ?></strong> / <?php echo $map_tier_completion[5]; ?> <small class="text-muted">(<?php echo $map_tier_completion[6]; ?>%)</small></h6>
                        <h6 class="my-1"><small><i class="fas fa-route"></i> Stages</small><br><strong><?php echo $map_tier_completion[7]; ?></strong> / <?php echo $map_tier_completion[8]; ?> <small class="text-muted">(<?php echo $map_tier_completion[9]; ?>%)</small></h6>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if(!empty($usr_finishedmaps)):?>
            <hr>
            <div class="text-center mt-4 mb-0">
                <h5 class="my-0">Player Finished Maps</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped border shadow-sm py-0 my-2 nowrap" style="width:100%" id="map-wrs-by-player">
                    <thead class="border">
                        <th class="text-left pl-3">Mapname</th>
                        <th class="text-center">Tier</th>
                        <th class="text-center">Rank</th>
                        <th class="text-center">Runtime</th>
                        <th class="text-center">Date</th>
                    </thead>
                    <tbody class="table-sm">
                        
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <?php if(!empty($usr_finishedbonuses)):?>
            <hr>
            <div class="text-center mt-4 mb-0">
                <h5 class="my-0">Player Finished Bonuses</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped border shadow-sm py-0 my-2 nowrap" style="width:100%" id="map-wrbs-by-player">
                    <thead class="border">
                        <th class="text-left pl-3">Mapname</th>
                        <th class="text-center">Tier</th>
                        <th class="text-center">Bonus</th>
                        <th class="text-center">Bonus Rank</th>
                        <th class="text-center">Runtime</th>
                        <th class="text-center">Date</th>
                    </thead>
                    <tbody class="table-sm">
                        
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <?php if(!empty($usr_finishedstages)):?>
            <hr>
            <div class="text-center mt-4 mb-0">
                <h5 class="my-0">Player Finished Stages</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped border shadow-sm py-0 my-2 nowrap" style="width:100%" id="map-wrcps-by-player">
                    <thead class="border">
                        <th class="text-left pl-3">Mapname</th>
                        <th class="text-center">Tier</th>
                        <th class="text-center">Stage</th>
                        <th class="text-center">Stage Rank</th>
                        <th class="text-center">Runtime</th>
                        <th class="text-center">Date</th>
                    </thead>
                    <tbody class="table-sm">
                        
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php
    endif;
?>
