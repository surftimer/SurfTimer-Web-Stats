<!DOCTYPE html>
<!-- Coded & Designed with ❤ by Kristián Partl.  --->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Surf Stats">
        <meta name="keywords" content="SurfStats,CSGO,surftimer,Surf,Surf Servers">
        <meta name="author" content="Kristián Partl">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php if($page_name === 'Player Profile - Dashboard'): ?>
            <title><?php echo $player_id; ?> - Player Profile - Dashboard - Surf Stats</title>
        <?php else: ?>
            <title><?php echo $page_name; ?> - Surf Stats</title>
        <?php endif; ?>

        <link rel="icon" href="./images/logo_navbar_1.svg" type="image/gif">

        <!-- Bootstrap core CSS -->
        <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom core CSS -->
        <link href="./vendor/fontawesome/css/all.min.css" rel="stylesheet">
        <link href="./vendor/css/datatables.min.css" rel="stylesheet">
        <link href="./vendor/css/custom.css" rel="stylesheet">

        <!-- JavaScript Core -->
        <script src="./vendor/js/popper.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Datatables Core -->
        <script type="text/javascript" src="./vendor/js/datatables.min.js"></script>
        <?php require_once('./inc/scripts.php'); ?>

        <style>
            body{
                overflow-y: scroll;
                background-image: url('./images/surf-images/<?php echo date('N', strtotime(date('l')));?>.jpg');
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        </style>

    </head>
    <body class="d-flex flex-column bg-black-kp">
