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

								$map_completion_runtime = $map_completion['runtimepro'];
								$map_completion_runtime_microtime = substr($map_completion_runtime, strpos($map_completion_runtime, ".") + 1);    
								$map_completion_runtime_timeformat = gmdate("i:s", $map_completion['runtimepro']).'<span class="text-secondary">.'.$map_completion_runtime_microtime.'</span>';
							?>
							[
								'<?php echo ++$map_completion_row; ?>.',
								'<?php echo $map_completion_username; ?>',
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
						responsive: true,
						"data": [
							<?php $map_bonuses_completion_r_row = 0; foreach($map_bonuses_completion as $map_bonuses_completion_r): ?>
								<?php
									if(isset($map_bonuses_completion_r['goodname']))
										$map_bonuses_completion_r_username = $map_bonuses_completion_r['goodname'];
									elseif(isset($map_completion['name']))
										$map_bonuses_completion_r_username = $map_bonuses_completion_r['name'];
									else
										$map_bonuses_completion_r_username = '<small class="text-muted">N/A</small>';

									$map_bonuses_completion_r_runtime = $map_bonuses_completion_r['runtime'];
									$map_bonuses_completion_r_runtime_microtime = substr($map_bonuses_completion_r_runtime, strpos($map_bonuses_completion_r_runtime, ".") + 1);    
									$map_bonuses_completion_r_runtime_timeformat = gmdate("i:s", $map_bonuses_completion_r['runtime']).'<span class="text-secondary">.'.$map_bonuses_completion_r_runtime_microtime.'</span>';
								?>
								[
									'<?php echo ++$map_bonuses_completion_r_row; ?>.',
									'<?php echo $map_bonuses_completion_r_username; ?>',
									'<?php echo $map_bonuses_completion_r_runtime_timeformat; ?>'
								],
							<?php endforeach; ?>
						]
					});
				} );
			<?php endforeach; ?>
		<?php endif; ?>
		
		
	</script>