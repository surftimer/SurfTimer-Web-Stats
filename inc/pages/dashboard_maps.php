<?php

require_once('./../config.php');
require_once('./../languages.php');
require_once('./../database.php');
require_once('./../functions.php');

if(isset($_POST['mapname'])) {
    $mapname = $_POST['mapname'];
} elseif(empty($mapname))
$mapname = '';

if(($mapname!=='')):

    $sql_map = "SELECT * FROM `ck_maptier` LEFT JOIN ck_newmaps ON ck_maptier.mapname=ck_newmaps.mapname WHERE ck_maptier.mapname=?";
    $stmt_map = mysqli_stmt_init($db_conn_surftimer);

    if(mysqli_stmt_prepare($stmt_map, $sql_map)):

        mysqli_stmt_bind_param($stmt_map,"s", $mapname);
        mysqli_stmt_execute($stmt_map);
        $results_map = mysqli_stmt_get_result($stmt_map);
        
        if(mysqli_num_rows($results_map) > 0):
            
            $row_map = mysqli_fetch_assoc($results_map);

            if(isset($row_map['date'])):

                $map_name = $row_map['mapname'];
                $map_tier = $row_map['tier'];
                $map_dateadded = $row_map['date'];
                $map_maxvelocity = $row_map['maxvelocity'];

                $sql_map_stages = "SELECT COUNT(zonetype) as stages FROM `ck_zones` WHERE mapname='$map_name' AND zonetype='3';";
                $sql_map_bonuses = "SELECT zonegroup FROM `ck_zones` WHERE mapname='$map_name' ORDER BY `ck_zones`.`zonegroup` DESC LIMIT 1;";
                $results_map_stages = mysqli_query($db_conn_surftimer, $sql_map_stages);
                $results_map_bonuses = mysqli_query($db_conn_surftimer, $sql_map_bonuses);
                $row_map_stages = $results_map_stages->fetch_assoc();
                $row_map_bonuses = $results_map_bonuses->fetch_assoc();
                
                $map_stages = $row_map_stages['stages'] + 1;
                $map_bonuses = $row_map_bonuses['zonegroup'] ?? Null;

                if(($row_map['stages']!==$map_stages)||($row_map['bonuses']!==$map_bonuses)):
                    $sql_map_stages_bonuses_update = "UPDATE `ck_maptier` SET `stages` = '$map_stages', `bonuses` = '$map_bonuses' WHERE `ck_maptier`.`mapname` = '$map_name';";
                    $query_map_stages_bonuses_update = mysqli_query($db_conn_surftimer, $sql_map_stages_bonuses_update);
                endif;

                $map_stages_info = $map_stages;
                if($map_stages_info == '1')
                    $map_stages_info = TABLE_LINEAR;
                elseif($map_stages_info > '1')
                    $map_stages_info = TABLE_STAGED.' ('.$map_stages_info.')';
                else
                    $map_stages_info = '<span class="text-muted">'.TABLE_NULL.'</span>';
                
                $map_bonuses_info = $map_bonuses;
                if($map_bonuses_info == '0')
                    $map_bonuses_info = TABLE_NO_BONUS;
                elseif($map_bonuses_info == NULL)
                    $map_bonuses_info = '<span class="text-muted">'.TABLE_NULL.'</span>';
                
                $date_today = date('Y/m/d H:i');
                $date_today_day = date('Y/m/d');
                $date_today_c = date_create($date_today);

                $map_dateadded_edit = date('Y/m/d  H:i', strtotime($map_dateadded));
                $map_dateadded_edit_day = date('Y/m/d', strtotime($map_dateadded));
                $map_dateadded_edit_t = date('d. m. Y', strtotime($map_dateadded));
                $map_dateadded_edit_c = date_create($map_dateadded_edit);
                
                $map_dateadded_edit_diff = date_diff($date_today_c, $map_dateadded_edit_c);
                $map_dateadded_edit_diff = $map_dateadded_edit_diff->format("%a");
                
                if($date_today_day == $map_dateadded_edit_day)
                    $map_dateadded_edit_d = TABLE_TODAY;
                elseif($map_dateadded_edit_diff==1)
                    $map_dateadded_edit_d = TABLE_YESTERDAY;
                else
                    $map_dateadded_edit_d = "<b>".$map_dateadded_edit_diff."</b> ".TABLE_DAYS_AGO;

            
                $sql_map_total_completions_count = "SELECT COUNT(mapname) as count FROM `ck_playertimes` WHERE mapname='$map_name'";
                $sql_map_normal_completions_count = "SELECT COUNT(mapname) as count FROM `ck_playertimes` WHERE mapname='$map_name' AND style='0'";
                $sql_map_total_bonuses_completions_count = "SELECT COUNT(mapname) as count FROM `ck_bonus` WHERE mapname='$map_name'";
                $sql_map_normal_bonuses_completions_count = "SELECT COUNT(mapname) as count FROM `ck_bonus` WHERE mapname='$map_name' AND style='0'";

                $results_map_total_completions_count = mysqli_query($db_conn_surftimer, $sql_map_total_completions_count);
                $results_map_normal_completions_count = mysqli_query($db_conn_surftimer, $sql_map_normal_completions_count);
                $results_map_total_bonuses_completions_count = mysqli_query($db_conn_surftimer, $sql_map_total_bonuses_completions_count);
                $results_map_normal_bonuses_completions_count = mysqli_query($db_conn_surftimer, $sql_map_normal_bonuses_completions_count);

                $row_map_total_completions_count = mysqli_fetch_assoc($results_map_total_completions_count);
                $row_map_normal_completions_count = mysqli_fetch_assoc($results_map_normal_completions_count);
                $row_map_total_bonuses_completions_count = mysqli_fetch_assoc($results_map_total_bonuses_completions_count);
                $row_map_normal_bonuses_completions_count = mysqli_fetch_assoc($results_map_normal_bonuses_completions_count);

                $map_total_completions_count = $row_map_total_completions_count['count'];
                $map_normal_completions_count = $row_map_normal_completions_count['count'];
                $map_total_bonuses_completions_count = $row_map_total_bonuses_completions_count['count'];
                $map_normal_bonuses_completions_count = $row_map_normal_bonuses_completions_count['count'];

                if($sql_map_normal_completions_count != 0):

                    if($exists_UsrTableCountryCodeAndContinentCodeCheck)
                        $sql_map_completions = "SELECT ck_playertimes.*, ck_playerrank.name as goodname, ck_playerrank.country, ck_playerrank.countryCode, ck_playerrank.continentCode, ck_playerrank.steamid64 FROM `ck_playertimes` LEFT JOIN `ck_playerrank` ON ck_playerrank.steamid=ck_playertimes.steamid AND ck_playerrank.style=ck_playertimes.steamid WHERE mapname='$map_name' AND ck_playertimes.style='0'";
                    else
                        $sql_map_completions = "SELECT ck_playertimes.*, ck_playerrank.name as goodname, ck_playerrank.country, ck_playerrank.steamid64 FROM `ck_playertimes` LEFT JOIN `ck_playerrank` ON ck_playerrank.steamid=ck_playertimes.steamid AND ck_playerrank.style=ck_playertimes.steamid WHERE mapname='$map_name' AND ck_playertimes.style='0'";
                    $results_map_completions = mysqli_query($db_conn_surftimer, $sql_map_completions);
                    $map_completions = array();

                    while($row_map_completions = mysqli_fetch_assoc($results_map_completions))
                        $map_completions[] = $row_map_completions;


                endif;

                if($map_stages>'1'):

                    $map_top_stages = array();
                    $map_top_stages_while = 0; 
                    
                    while(++$map_top_stages_while <= $map_stages):
                        
                        $sql_map_total_stage_completions = "SELECT COUNT(steamid) as stage_completions FROM `ck_wrcps` WHERE mapname='$map_name' AND stage='$map_top_stages_while' AND style='0'";
                        $result_map_total_stage_completions = mysqli_query($db_conn_surftimer, $sql_map_total_stage_completions);
                        $row_map_total_stage_completions = $result_map_total_stage_completions->fetch_assoc();

                        if($exists_UsrTableCountryCodeAndContinentCodeCheck)
                            $sql_stage_top_time = "SELECT ck_wrcps.*, ck_playerrank.name as goodname, ck_playerrank.country, ck_playerrank.countryCode, ck_playerrank.continentCode, ck_playerrank.steamid64 FROM `ck_wrcps` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_wrcps.steamid AND ck_playerrank.style=ck_wrcps.style WHERE mapname='$map_name' AND stage='$map_top_stages_while' AND ck_wrcps.style='0' ORDER BY `ck_wrcps`.`runtimepro`  ASC LIMIT 1";
                        else
                            $sql_stage_top_time = "SELECT ck_wrcps.*, ck_playerrank.name as goodname, ck_playerrank.country, ck_playerrank.steamid64 FROM `ck_wrcps` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_wrcps.steamid AND ck_playerrank.style=ck_wrcps.style WHERE mapname='$map_name' AND stage='$map_top_stages_while' AND ck_wrcps.style='0' ORDER BY `ck_wrcps`.`runtimepro`  ASC LIMIT 1";
                        $result_stage_top_time = mysqli_query($db_conn_surftimer, $sql_stage_top_time);
                        $row_stage_top_time = $result_stage_top_time->fetch_assoc();

                        if((isset($row_stage_top_time['goodname']))&&(isset($row_stage_top_time['steamid64']))):
                            if($config_player_flags)
                                $stage_top_time_user = CountryFlag($row_stage_top_time['country'], $row_stage_top_time['countryCode'], $row_stage_top_time['continentCode']).' '.PlayerUsernameProfile($row_stage_top_time['steamid64'], $row_stage_top_time['name']);
                            else
                            $stage_top_time_user = PlayerUsernameProfile($row_stage_top_time['steamid64'], $row_stage_top_time['name']);
                        elseif(isset($row_stage_top_time['name'])):
                            $stage_top_time_user = $row_stage_top_time['name'];
                        else:
                            $stage_top_time_user = '<small class="text-muted">N/A</small>';
                        endif;

                        if(isset($row_stage_top_time['runtimepro'])):
                            $stage_top_time_runtime_microtime = substr($row_stage_top_time['runtimepro'], strpos($row_stage_top_time['runtimepro'], ".") + 1);    
                            $stage_top_time_runtime_timeformat = gmdate("i:s", $row_stage_top_time['runtimepro']) . "<span class=\"text-muted\">." . $stage_top_time_runtime_microtime . "</span>";
                        else:
                            $stage_top_time_runtime_timeformat = '<small class="text-muted">N/A</small>';
                        endif;

                        $map_top_stages[] = array($map_top_stages_while, $stage_top_time_user, $stage_top_time_runtime_timeformat, $row_map_total_stage_completions['stage_completions']);
                    
                    endwhile;

                endif;

                if($map_bonuses>'0'):

                    $map_bonuses_completions_counts = array();
                    $map_bonuses_completions_count_while = 0;

                    while(++$map_bonuses_completions_count_while <= $map_bonuses):

                        $sql_bonus_completions_count = "SELECT COUNT(steamid) as bonus_completions FROM `ck_bonus` WHERE mapname='$map_name' AND zonegroup='$map_bonuses_completions_count_while' AND style='0'";
                        $result_bonus_completions_count = mysqli_query($db_conn_surftimer, $sql_bonus_completions_count);
                        $row_bonus_completions_count = $result_bonus_completions_count->fetch_assoc();
                        $map_bonuses_completions_counts[] = $row_bonus_completions_count['bonus_completions'];

                    endwhile;


                    $map_bonuses_completions = array();
                    $map_bunuses_completions_while = 0;

                    while(++$map_bunuses_completions_while <= $map_bonuses):

                        if($exists_UsrTableCountryCodeAndContinentCodeCheck)
                            $sql_map_bonuses_completions = "SELECT ck_bonus.*, ck_playerrank.name as goodname, ck_playerrank.country, ck_playerrank.countryCode, ck_playerrank.continentCode, ck_playerrank.steamid64 FROM `ck_bonus` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_bonus.steamid AND ck_playerrank.style=ck_bonus.style WHERE mapname='$map_name' AND zonegroup='$map_bunuses_completions_while' AND ck_bonus.style='0' ORDER BY `ck_bonus`.`runtime` ASC";
                        else
                            $sql_map_bonuses_completions = "SELECT ck_bonus.*, ck_playerrank.name as goodname, ck_playerrank.country, ck_playerrank.steamid64 FROM `ck_bonus` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_bonus.steamid AND ck_playerrank.style=ck_bonus.style WHERE mapname='$map_name' AND zonegroup='$map_bunuses_completions_while' AND ck_bonus.style='0' ORDER BY `ck_bonus`.`runtime` ASC";    
                        $result_map_bonuses_completions = mysqli_query($db_conn_surftimer, $sql_map_bonuses_completions);

                        $map_bonuses_completions_rows = array();

                        if(mysqli_num_rows($result_map_bonuses_completions) > 0):
                            while($row_map_bonuses_completions = mysqli_fetch_assoc($result_map_bonuses_completions)):

                                if((isset($row_map_bonuses_completions['goodname']))&&(isset($row_map_bonuses_completions['steamid64']))):
                                    if($config_player_flags)
                                        $map_bonuses_completions_user = CountryFlag($row_map_bonuses_completions['country'], $row_map_bonuses_completions['countryCode'], $row_map_bonuses_completions['continentCode']).' '.PlayerUsernameProfile($row_map_bonuses_completions['steamid64'], $row_map_bonuses_completions['name']);
                                    else
                                        $map_bonuses_completions_user = PlayerUsernameProfile($row_map_bonuses_completions['steamid64'], $row_map_bonuses_completions['name']);
                                elseif(isset($row_map_bonuses_completions['name'])):
                                    $map_bonuses_completions_user = $row_map_bonuses_completions['name'];
                                else:
                                    $map_bonuses_completions_user = '<small class="text-muted">N/A</small>';
                                endif;

                                $map_bonuses_completions_runtime = $row_map_bonuses_completions['runtime'];
                                $map_bonuses_completions_runtime_microtime = substr($map_bonuses_completions_runtime, strpos($map_bonuses_completions_runtime, ".") + 1);    
                                $map_bonuses_completions_runtime_timeformat = gmdate("i:s", $row_map_bonuses_completions['runtime']).'<span class="text-muted">.'.$map_bonuses_completions_runtime_microtime.'</span>';

                                $map_bonuses_completions_date = $row_map_bonuses_completions['date'];
                                if($map_bonuses_completions_date>'2021-03-03 10:51:48') 
                                    $map_bonuses_completions_date =  '<small class="">'.date('Y/m/d  (H:i)', strtotime($row_map_bonuses_completions['date'])).'</small>';
                                else 
                                    $map_bonuses_completions_date = '<small class="text-muted">N/A</small>';

                                $map_bonuses_completions_rows[] = array($map_bonuses_completions_user, $map_bonuses_completions_runtime_timeformat, $map_bonuses_completions_date);

                            endwhile;
                        endif;

                        $map_bonuses_completions[] = $map_bonuses_completions_rows;

                    endwhile;

                endif;
            
            endif;

        endif;
        
    else:
        echo 'STMT Error';
    endif;

else:

    $sql_maps = "SELECT *, (SELECT COUNT(*) FROM ck_playertimes WHERE mapname = ck_newmaps.mapname AND style='0') as map_completions FROM `ck_newmaps` INNER JOIN ck_maptier ON `ck_newmaps`.`mapname` = `ck_maptier`.`mapname`";
    $results_maps = mysqli_query($db_conn_surftimer, $sql_maps);
    $maps = array();
    if(mysqli_num_rows($results_maps) > 0){
        while($row_maps = mysqli_fetch_assoc($results_maps))
            $maps[] = $row_maps;
    }

endif;
?>

<script>
    <?php if((!isset($mapname))||($mapname==='')): ?>       
	    $('#maps').DataTable({
        language: {
            processing:     '<?php echo DATATABLES_processing; ?>',
            search:         '<?php echo DATATABLES_search; ?>',
            lengthMenu:     '<?php echo DATATABLES_lengthMenu; ?>',
            info:           '<?php echo DATATABLES_info; ?>',
            infoEmpty:      '<?php echo DATATABLES_infoEmpty; ?>',
            infoFiltered:   '<?php echo DATATABLES_infoFiltered; ?>',
            loadingRecords: '<?php echo DATATABLES_loadingRecords; ?>',
            zeroRecords:    '<?php echo DATATABLES_zeroRecords; ?>',
            emptyTable:     '<?php echo DATATABLES_emptyTable; ?>',
            paginate: {
                first:      '<?php echo DATATABLES_first; ?>',
                previous:   '<?php echo DATATABLES_previous; ?>',
                next:       '<?php echo DATATABLES_next; ?>',
                last:       '<?php echo DATATABLES_last; ?>'
            },
            aria: {
                sortAscending:  '<?php echo DATATABLES_sortAscending; ?>',
                sortDescending: '<?php echo DATATABLES_sortDescending; ?>'
            }
        },
		"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
		responsive: true,
		"processing": true,
		"columnDefs": [
		    { "className": "text-left pl-3 align-middle", "targets": [ 0 ] },
		    { "className": "text-center align-middle", "targets": [ 1 ] },
		    { "className": "text-center align-middle", "targets": [ 2 ] },
		    { "className": "text-center align-middle", "targets": [ 3 ] },
		    { "className": "text-center align-middle", "targets": [ 4] },
            { "className": "text-center align-middle", "targets": [ 5] },
		],
		"data": [
		    <?php
			$maps_date_today = date('Y/m/d');
			$maps_date_today_c = date_create($maps_date_today);
		    ?>
		    <?php foreach($maps as $map): ?>
			<?php
			    if($map['stages']===NULL)
				$map_stages = '<span class="text-muted">'.TABLE_NULL.'</span>';
			    elseif($map['stages']==='1')
				$map_stages = TABLE_LINEAR;
			    else
				$map_stages = TABLE_STAGED.' ('.$map['stages'].')';

			    if($map['bonuses']===NULL)
				$map_bonuses = '<span class="text-muted">'.TABLE_NULL.'</span>';
			    elseif($map['bonuses']!=='0')
				$map_bonuses = $map['bonuses'];
			    else
				$map_bonuses = TABLE_NO_BONUS;

			    $newmaps_added = date('Y/m/d', strtotime($map['date']));
			    $newmaps_added_c = date_create($newmaps_added);

			    $newmaps_diff = date_diff($maps_date_today_c, $newmaps_added_c);
			    $newmaps_diff = $newmaps_diff->format("%a");

			    if($maps_date_today == $newmaps_added||$newmaps_diff==0)
				$newmaps_added_d = TABLE_TODAY;
			    elseif($newmaps_diff==1)
				$newmaps_added_d = TABLE_YESTERDAY;
			    else

				$newmaps_added_d = $newmaps_diff." ".TABLE_DAYS_AGO;

        if($settings_map_link_icon)
            $map_link = $map['mapname'].'<a href="dashboard-maps.php?map='.$map['mapname'].'" title="'.$map['mapname'].' - Map Page" class="link-secondary text-decoration-none"><i class="fas fa-link"></i></a>';
        else
            $map_link = '<a href="dashboard-maps.php?map='.$map['mapname'].'" title="'.$map['mapname'].' - Map Page" class="'.$LinkColor.' text-decoration-none">'.$map['mapname'].'</a>';
			
      ?>
			[
			    '<?php echo $map_link;?>',
			    '<?php echo $map['tier']; ?>',
			    '<?php echo $map_stages; ?>',
			    '<?php echo $map_bonuses; ?>',
                '<?php echo number_format($map['map_completions']); ?>',
			    '<?php echo $newmaps_added.' <small class="text-muted">('.$newmaps_added_d.')</small>'; ?>'
			],
		    <?php endforeach; ?>
		]
	    });
    <?php endif; ?>
    <?php if((isset($mapname))&&($mapname!=='')&&(isset($row_map['date']))): ?>
			
				$('#map-completions').DataTable({
					"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					"processing": true,
					"columnDefs": [
						{ "className": "text-center align-middle", "targets": [ 0 ] },
						{ "className": "text-left align-middle", "targets": [ 1 ] },
						{ "className": "text-center align-middle", "targets": [ 2 ] },
                        { "className": "text-center align-middle", "targets": [ 3 ] }
					],
					responsive: true,
					"data": [
						<?php $map_completion_row = 0; foreach($map_completions as $map_completion): ?>

                            <?php 
                                if((isset($map_completion['goodname']))&&(isset($map_completion['steamid64']))):
                                    if($config_player_flags)
                                        $map_completion_user = CountryFlag($map_completion['country'], $map_completion['countryCode'], $map_completion['continentCode']).' '.PlayerUsernameProfile($map_completion['steamid64'], $map_completion['name']);
                                    else
                                        $map_completion_user = PlayerUsernameProfile($map_completion['steamid64'], $map_completion['name']);
                                elseif(isset($map_completion['name'])):
                                    $map_completion_user = $map_completion['name'];
                                else:
                                    $map_completion_user = '<small class="text-muted">N/A</small>';
                                endif;

								$map_completion_runtime = $map_completion['runtimepro'];
								$map_completion_runtime_microtime = substr($map_completion_runtime, strpos($map_completion_runtime, ".") + 1);    
								$map_completion_runtime_timeformat = gmdate("i:s", $map_completion['runtimepro']).'<span class="text-muted">.'.$map_completion_runtime_microtime.'</span>';
                                
                                $map_completion_date = $map_completion['date'];
                                if($map_completion_date>'2021-03-03 10:49:50') 
                                    $map_completion_date =  '<small class="">'.date('Y/m/d  (H:i)', strtotime($map_completion['date'])).'</small>';
                                else 
                                    $map_completion_date = '<small class="text-muted">N/A</small>';
							?>
							[
								'<?php echo ++$map_completion_row; ?>.',
								'<?php echo $map_completion_user; ?>',
								'<?php echo $map_completion_runtime_timeformat; ?>',
                                '<?php echo $map_completion_date; ?>'
							],
						<?php endforeach; ?> 
					]
				});
		<?php endif; ?>
        <?php if(((isset($mapname))&&($mapname!==''))&&(isset($row_map['date']))&&($map_bonuses>0)): ?>
			<?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions as $map_bonuses_completion): ?>
					$('#bonuses-completions-<?php echo ++$map_bonuses_completions_number; ?>').DataTable({
                        language: {
                            processing:     '<?php echo DATATABLES_processing; ?>',
                            search:         '<?php echo DATATABLES_search; ?>',
                            lengthMenu:     '<?php echo DATATABLES_lengthMenu; ?>',
                            info:           '<?php echo DATATABLES_info; ?>',
                            infoEmpty:      '<?php echo DATATABLES_infoEmpty; ?>',
                            infoFiltered:   '<?php echo DATATABLES_infoFiltered; ?>',
                            loadingRecords: '<?php echo DATATABLES_loadingRecords; ?>',
                            zeroRecords:    '<?php echo DATATABLES_zeroRecords; ?>',
                            emptyTable:     '<?php echo DATATABLES_emptyTable; ?>',
                            paginate: {
                                first:      '<?php echo DATATABLES_first; ?>',
                                previous:   '<?php echo DATATABLES_previous; ?>',
                                next:       '<?php echo DATATABLES_next; ?>',
                                last:       '<?php echo DATATABLES_last; ?>'
                            },
                            aria: {
                                sortAscending:  '<?php echo DATATABLES_sortAscending; ?>',
                                sortDescending: '<?php echo DATATABLES_sortDescending; ?>'
                            }
                        },
						"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
						"processing": true,
						"columnDefs": [
							{ "className": "text-center align-middle", "targets": [ 0 ] },
							{ "className": "text-left align-middle", "targets": [ 1 ] },
							{ "className": "text-center align-middle", "targets": [ 2 ] },
                            { "className": "text-center align-middle", "targets": [ 3 ] }
						],
						responsive: true
					});
			<?php endforeach; ?>
		<?php endif; ?>
</script>


<?php if((isset($mapname))&&($mapname!=='')): ?>
    <h5><a href="dashboard-maps.php" class="text-muted text-decoration-none">Surf Stat's <?php echo MAP_COLLECTION; ?></a>  / <?php echo $mapname;?><?php echo MapDownload($mapname);?></h5>
    <hr class="mt-0 mb-3">
    <?php if(mysqli_num_rows($results_map) > 0): ?>        
        <?php if(isset($row_map['date'])): ?>
            <div class="my-4">
                <h3 class="text-center"><?php echo $mapname; ?></h3>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-auto text-center">
                        <?php echo TABLE_TYPE; ?>: <b><?php echo $map_stages_info;?></b>
                    </div>
                    <div class="col-12 col-md-auto text-center">
                        <?php echo TABLE_TIER; ?>: <b><?php echo $map_tier;?></b>
                    </div>
                    <div class="col-12 col-md-auto text-center">
                        <?php echo TABLE_BONUS; ?>: <b><?php echo $map_bonuses_info;?></b>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-auto text-center">
                        <?php echo TABLE_ADDED; ?>: <b><?php echo $map_dateadded_edit;?> <small>(<?php echo $map_dateadded_edit_d;?>)</small></b>
                    </div>                            
                    <div class="col-12 col-md-auto text-center">
                        <?php echo MAPS_MAX_VELOCITY; ?>: <b><?php echo number_format($map_maxvelocity); ?></b>
                    </div>
                </div>
                <?php echo MapPreviewImage($mapname) ?>
            </div>
            <h5 class="text-center my-1"><?php echo MAPS_TOTAL_COMPLETIONS; ?></h5>
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-auto text-center">
                    <h6 class="text-center text-muted my-1">
                        <?php echo TABLE_MAP; ?>: <span class="text-body"><?php echo number_format($map_normal_completions_count); ?></span>
                    </h6>
                </div>
                <?php if($map_bonuses!=='0'): ?>
                    <div class="col-12 col-md-auto text-center">
                        <h6 class="text-center text-muted my-1">
                            <?php echo TABLE_BONUSES; ?>: <span class="text-body"><?php echo number_format($map_normal_bonuses_completions_count); ?></span>
                        </h6>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($map_normal_completions_count!=='0'): ?>
                <hr>
                <h5 class="text-center"><?php echo MAPS_MAP_COMPLETIONS; ?></h5>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped border shadow-sm py-0 my-0 nowrap" style="width:100%" id="map-completions">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-left"><?php echo TABLE_USERNAME; ?></th>
                            <th class="text-center"><?php echo TABLE_TIME; ?></th>
                            <th class="text-center"><?php echo TABLE_DATE; ?></th>
                        </thead>
                    </table>
                </div>
            <?php endif; ?>
            <?php if($map_stages>'1'): ?>
                <hr>
                <h5 class="text-center"><?php echo MAPS_STAGE_COMPLETIONS; ?></h5>
                <div class="table-responsive shadow-sm mt-3">
                    <table class="table table-sm table-hover table-striped border shadow-sm py-0 my-0">
                        <thead>
                            <th class="text-center"><?php echo TABLE_STAGES; ?></th>
                            <th class="text-left"><?php echo TABLE_TOP_PLAYER_NAME; ?></th>
                            <th class="text-center"><?php echo TABLE_TOP_TIME; ?></th>
                            <th class="text-center"><?php echo TABLE_TOTAL_STAGE_COMPLETIONS; ?></th>
                        </thead>
                        <tbody class="">
                            <?php foreach($map_top_stages as $map_top_stage): ?>
                                <tr>
                                    <td class="text-center"><?php echo TABLE_STAGE; ?>: <strong><?php echo $map_top_stage['0']; ?></strong></td>
                                    <td class="text-left"><?php echo $map_top_stage['1']; ?></td>
                                    <td class="text-center"><?php echo $map_top_stage['2']; ?></td>
                                    <td class="text-center"><?php echo TABLE_COMPLETIONS; ?>: <?php echo $map_top_stage['3']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if($map_bonuses>'0'): ?>
                <hr>
                <h5 class="text-center"><?php echo MAPS_BONUSES_COMPLETIONS; ?></h5>
                
                <nav>
                    <div class="nav nav-tabs nav-fill my-3" id="nav-tab" role="tablist">
                        <?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions_counts as $map_bonuses_completions_count): ?>
                            <button class="nav-link pb-3 <?php if((++$map_bonuses_completions_number=='1')&&($map_bonuses_completions_count!=='0')) echo 'active'; elseif($map_bonuses_completions_count==='0') echo 'disabled'; ?>" id="bonuses-content-<?php echo $map_bonuses_completions_number; ?>-tab" data-bs-toggle="tab" data-bs-target="#bonuses-content-<?php echo $map_bonuses_completions_number; ?>" type="button" role="tab" aria-controls="nav-bonuses-<?php echo $map_bonuses_completions_number; ?>" aria-selected="true">
                                <b class="text-muted"><?php echo TABLE_BONUS; ?> <?php echo $map_bonuses_completions_number; ?></b>
                                <br>
                                <span class="text-body"><?php echo number_format($map_bonuses_completions_count); ?></span>
                            </button>
                        <?php endforeach; ?>  
                    </div>
                </nav>

                <div class="tab-content my-2" id="bonuses-tabsContent">       
                    <?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions as $map_bonuses_completion): ++$map_bonuses_completions_number; ?>
                        <div class="tab-pane fade<?php if($map_bonuses_completions_number=='1') echo ' show active'; ?>" id='bonuses-content-<?php echo $map_bonuses_completions_number; ?>' role="tabpanel" aria-labelledby="bonuses-content-<?php echo $map_bonuses_completions_number; ?>-tab" tabindex="0">
                            <?php if(!empty($map_bonuses_completion)): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped  border table-sm shadow-sm py-0 my-0 nowrap" style="width:100%" id="bonuses-completions-<?php echo $map_bonuses_completions_number; ?>">
                                        <thead>
                                            <th class="text-center">#</th>
                                            <th class="text-left"><?php echo TABLE_USERNAME; ?></th>
                                            <th class="text-center"><?php echo TABLE_TIME; ?></th>
                                            <th class="text-center"><?php echo TABLE_DATE; ?></th>
                                        </thead>
                                        <tbody>
                                            <?php $map_bonuses_completion_r_row = 0; foreach($map_bonuses_completion as $map_bonuses_completion_r): ?>
                                                <tr>
                                                    <td><?php echo ++$map_bonuses_completion_r_row; ?>.</td>
                                                    <td><?php echo $map_bonuses_completion_r[0]; ?></td>
                                                    <td><?php echo$map_bonuses_completion_r[1]; ?></td>
                                                    <td><?php echo$map_bonuses_completion_r[2]; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h5 class="text-center mt-5 mb-0">
                <i class="fas fa-info-circle"></i> <?php echo TABLE_MAP; ?>: <strong><?php echo $mapname; ?></strong> <?php echo MAP_NOT_ADDED_PROPERLY; ?>.
                <br>
                <a role="button" class="btn btn-outline-secondary px-5 py-1 mt-4" href="dashboard-maps.php"><i class="fas fa-map"></i> Surf Stat's <?php echo MAP_COLLECTION; ?> </a>
            </h5>
        <?php endif; ?>
    <?php else: ?>
        <h5 class="text-center mt-5 mb-0">
            <i class="fas fa-info-circle"></i> <?php echo TABLE_MAP; ?>: <strong><?php echo $mapname; ?></strong> <?php echo NOT_FOUND_IN_DB; ?>.
            <br>
            <a role="button" class="btn btn-outline-secondary px-5 py-1 mt-4" href="dashboard-maps.php"><i class="fas fa-map"></i> Surf Stat's <?php echo MAP_COLLECTION; ?> </a>
        </h5>
    <?php endif; ?>
<?php else: ?>
    <h5>Surf Stat's <?php echo MAP_COLLECTION; ?></h5>
    <hr class="mt-0 mb-3">
    <div class="table-responsive">
        <table class="table table-hover border shadow-sm py-0 my-2 nowrap" style="width:100%" id="maps">
            <thead class="border">
                <th class="text-left"><?php echo TABLE_MAP_NAME; ?></th>
                <th class="text-center"><?php echo TABLE_TIER; ?></th>
                <th class="text-center"><?php echo TABLE_TYPE; ?></th>
                <th class="text-center"><?php echo TABLE_BONUS; ?></th>
                <th class="text-center"><?php echo TABLE_COMPLETIONS; ?></th>
                <th class="text-center"><?php echo TABLE_ADDED; ?></th>
            </thead>
            <tbody class="table-sm">
            </tbody>
        </table>
    </div>
<?php endif; ?>