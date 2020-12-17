<script>
		<?php if($page_name =='Top Players'): ?>
			$(document).ready(function() {
				$('#top-players').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: true,
					"processing": true,
					"columnDefs": [
						{ "className": "text-left", "targets": [ 1 ] },
						{ "className": "text-center", "targets": [ '_all' ] }
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
		<?php if($page_name =='Maps'): ?>
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
								'<?php echo $map['mapname']; ?>',
								'<?php echo $map['tier']; ?>',
								'<?php echo number_format($map['maxvelocity']); ?>'
							],
						<?php endforeach; ?>
					]
				});
			} );
		<?php endif; ?>
	</script>