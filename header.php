<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title><?php echo $page_name; ?> - Surf Stats</title>

	<link rel="icon" href="./images/favicon.svg" type="image">

	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom core CSS -->
	<link href="vendor/fontawesome/css/all.min.css" rel="stylesheet"> 
	<link href="vendor/css/custom.min.css" rel="stylesheet">
	<link href="vendor/css/datatables.min.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="vendor/js/datatables.min.js"></script>

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
	</script>

</head>

<body class="d-flex flex-column">
	<div id="page-content">