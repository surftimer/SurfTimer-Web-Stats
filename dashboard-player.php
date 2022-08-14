<?php
    $page_name = 'Player Profile - Dashboard';
    
    require_once('./inc/includes.php');

    if (isset($_GET['id']))
        $player_id = $_GET['id'];
    else
        $player_id = 'Unknown';


    //require_once('./inc/pages/dashboard_top_players.php');
    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">


            <section class="my-4 pb-1">
                <div class="" id="player-profile-load">
                    <h5><a href="dashboard-players.php" class="text-muted text-decoration-none">Surf Stat's <?php echo PROFILE_PLAYER_PROFILE;?></a> / <?php echo $player_id; ?>  <a href="https://steamcommunity.com/profiles/<?php echo $player_id; ?>" target="_blank" title="<?php echo $player_id; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a></h5>
                    <hr class="mt-0 mb-3">
                    <div class="text-center text-muted py-4">
                        <div class="spinner-grow text-dark my-2" role="status">
                            <span class="sr-only"><?php echo LOADING; ?>...</span>
                        </div>
                        <h5><?php echo LOADING_PLAYER_PROFILE; ?>...<br><small><?php echo PLEASE_WAIT; ?>...</small></h5>
                    </div>
                </div>
            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
?>