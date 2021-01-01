<script>
		<?php if($page_name =='Top Players'): ?>
			$(document).ready(function() {
				$('#top-players').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: true,
					"processing": true,
					"columnDefs": [
						{ "className": "text-center", "targets": [ 0 ] },
						{ "className": "text-left", "targets": [ 1 ] },
						{ "className": "text-center", "targets": [ 2 ] },
						{ "className": "text-center", "targets": [ 3 ] },
						{ "className": "text-center", "targets": [ 4 ] },
						{ "className": "text-center", "targets": [ 5 ] }
					],
					"data": [
						<?php $top_player_row = 0; foreach($top_players as $top_player): ?>
							[
								'<?php echo ++$top_player_row; ?>.',
								'<?php echo $top_player["name"]; ?> <a href="https://steamcommunity.com/profiles/<?php echo $top_player['steamid64']; ?>" target="_blank" title="<?php echo $top_player['name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a>',
								'<?php echo number_format($top_player["points"]); ?>',
								'<?php echo number_format($top_player["finishedmapspro"]); ?>',
								'<?php echo number_format($top_player["finishedbonuses"]); ?>',
								'<?php echo number_format($top_player["finishedstages"]); ?>'
							],
						<?php endforeach; ?>
					]
				});
			} );
		<?php endif; ?>

		<?php if($settings_most_active_enable&&($page_name =='Most Active')): ?>
			$(document).ready(function() {
				$('#most-active').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: true,
					"processing": true,
					"columnDefs": [
						{ "className": "text-center", "targets": [ 0 ] },
						{ "className": "text-left", "targets": [ 1 ] },
						{ "className": "text-center", "targets": [ 2 ] },
						{ "className": "text-center", "targets": [ 3 ] },
						{ "className": "text-center", "targets": [ 4 ] },
						{ "className": "text-center", "targets": [ 5 ] }
					],
					"data": [
						<?php $most_active_row = 0; foreach($most_actives as $most_active): ?>
							<?php
								$most_active_lastseen = new DateTime();
								$most_active_lastseen->setTimestamp($most_active['lastseen']);
								$most_active_lastseen = $most_active_lastseen->format('d/m/Y (H:i)');

								$most_active_joined = new DateTime();
								$most_active_joined->setTimestamp($most_active['joined']);
								$most_active_joined = $most_active_joined->format('d/m/Y (H:i)');
							?>
							[
								'<?php echo ++$most_active_row; ?>.',
								'<?php echo $most_active["name"]; ?> <a href="https://steamcommunity.com/profiles/<?php echo $most_active['steamid64']; ?>" target="_blank" title="<?php echo $most_active['name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a>',
								'<?php echo  number_format(($most_active["totaltime"]/60)/60, 1); ?>',
								'<?php echo number_format($most_active["connections"]); ?>',
								'<?php echo $most_active_lastseen; ?>',
								'<?php echo $most_active_joined; ?>'
							],
						<?php endforeach; ?>
					]
				});
			} );
		<?php endif; ?>

		<?php if((!isset($mapname))&&($page_name =='Maps')): ?>
			$(document).ready(function() {
				$('#maps').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: true,
					"processing": true,
					"columnDefs": [
						{ "className": "text-left pl-3", "targets": [ 0 ] },
						{ "className": "text-center", "targets": [ 1 ] },
						{ "className": "text-center", "targets": [ 2 ] }
					],
					"data": [
						<?php foreach($maps as $map): ?>
							[
								'<?php echo $map['mapname']; ?> <a href="maps.php?map=<?php echo $map['mapname']; ?>" class="text-muted"><i class="fas fa-link"></i></a>',
								'<?php echo $map['tier']; ?>',
								'<?php echo number_format($map['maxvelocity']); ?>'
							],
						<?php endforeach; ?>
					]
				});
			} );
		<?php endif; ?>

		<?php if(($page_name =='Maps')&&(isset($mapname))): ?>
			$(document).ready(function() {
				$('#map-completions').DataTable({
					"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					"processing": true,
					"columnDefs": [
						{ "className": "text-center", "targets": [ 0 ] },
						{ "className": "text-left", "targets": [ 1 ] },
						{ "className": "text-center", "targets": [ 2 ] }
					],
					responsive: true,
					"data": [
						<?php $map_completion_row = 0; foreach($map_completions as $map_completion): ?>
							<?php
								if(isset($map_completion['goodname']))
									$map_completion_username = $map_completion['goodname'];
								elseif(isset($map_completion['name']))
									$map_completion_username = $map_completion['name'];
								else
									$map_completion_username = '<small class="text-muted">N/A</small>';

								if(isset($map_completion['steamid64']))
									$map_completion_steamprofile = ' <a href="https://steamcommunity.com/profiles/'.$map_completion['steamid64'].'" target="_blank" title="'.$map_completion_username.' - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a>';
								else
									$map_completion_steamprofile = '';

								$map_completion_runtime = $map_completion['runtimepro'];
								$map_completion_runtime_microtime = substr($map_completion_runtime, strpos($map_completion_runtime, ".") + 1);    
								$map_completion_runtime_timeformat = gmdate("i:s", $map_completion['runtimepro']).'<span class="text-muted">.'.$map_completion_runtime_microtime.'</span>';
							?>
							[
								'<?php echo ++$map_completion_row; ?>.',
								'<?php echo $map_completion_username.$map_completion_steamprofile; ?>',
								'<?php echo $map_completion_runtime_timeformat; ?>'
							],
						<?php endforeach; ?>
					]
				});
			} );
		<?php endif; ?>

		<?php if(($page_name =='Maps')&&((isset($mapname))&&($map_bonuses>0))): ?>
			<?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions as $map_bonuses_completion): ?>
				$(document).ready(function() {
					$('#bonuses-completions-<?php echo ++$map_bonuses_completions_number; ?>').DataTable({
						"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
						"processing": true,
						"columnDefs": [
							{ "className": "text-center", "targets": [ 0 ] },
							{ "className": "text-left", "targets": [ 1 ] },
							{ "className": "text-center", "targets": [ 2 ] }
						],
						responsive: true
					});
				} );
			<?php endforeach; ?>
		<?php endif; ?>
		
		
	</script>