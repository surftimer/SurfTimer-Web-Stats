<?php
    $page_name = 'Top Players - Dashboard';
    $lgsl_show_servers = 0;
    
    require_once('./inc/includes.php');

    //require_once('./inc/pages/dashboard_top_players.php');
    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">


            <section class="my-4 pb-1">

                <h5>Surf Stat's Top 1,000 Players</h5>
                <hr class="mt-0 mb-3">
                    <div class="" id="top-players-load">
                        <div class="text-center text-muted py-4">
                            <div class="spinner-grow text-dark my-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h5>Loading Top Players List...<br><small>Please Wait...</small></h5>
                        </div>
                    </div>
            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
?>