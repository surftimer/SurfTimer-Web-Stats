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
	<?php
		if ($darkMode)
		{
			echo "<link href=\"vendor/css/bootstrap.dark.min.css\" rel=\"stylesheet\">";
			echo "<link href=\"vendor/css/custom.dark.min.css\" rel=\"stylesheet\">";
		}
		else
		{
			echo "<link href=\"vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">";
			echo "<link href=\"vendor/css/custom.min.css\" rel=\"stylesheet\">";
		}
	?>

	<!-- Custom core CSS -->
	<link href="vendor/fontawesome/css/all.min.css" rel="stylesheet"> 
	<link href="vendor/css/datatables.min.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="vendor/js/datatables.min.js"></script>

	<?php require_once('./inc/datatables_scripts.php'); ?>

</head>

<body class="d-flex flex-column">
	<div id="page-content">