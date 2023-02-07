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

        <?php 
            if($settings_favicon!='')
                echo '<link rel="icon" href="./images/'.$settings_favicon.'" type="image/gif">';
            else
                echo '<link rel="icon" href="./images/logo.svg" type="image/gif">';
        ?>

        <!-- Bootstrap core CSS -->
        <link href="./vendor/bootstrap/css/<?php if($settings_theme!=='') echo $settings_theme; else echo 'default'; ?>/bootstrap.min.css" rel="stylesheet">

        <!-- Custom core CSS -->
        <link href="./vendor/fontawesome-free-6.2.1-web/css/all.min.css" rel="stylesheet">
        <link href="./vendor/css/datatables.min.css" rel="stylesheet">
        <link href="./vendor/css/custom.css" rel="stylesheet">

        <!-- JavaScript Core -->
        <script src="./vendor/js/popperjs-2.11.6.min.js"></script>
        <script src="./vendor/js/jquery-3.6.3.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Datatables Core -->
        <script type="text/javascript" src="./vendor/js/datatables.min.js"></script>
        <?php require_once('./inc/scripts.php'); ?>

        <style>
            body{
                overflow-y: scroll;
                background-image: url('./images/<?php echo BackgroundImage(); ?>');
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        </style>

    </head>
    <body class="d-flex flex-column bg-black-kp">
