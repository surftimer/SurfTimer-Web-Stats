<?php
    $page_name = 'Servers - Dashboard';
    if(isset($_GET["sid"]))
        $lgsl_server_id = $_GET["sid"];
    
    require_once('./inc/includes.php');

    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">


            <section class="my-4 pb-1">
                <h5>Surf Community's Servers</h5>
                <hr class="my-0">
                <div class="" id="server-list">
                    <div class="text-center text-muted py-4 mt-5">
                        <div class="spinner-grow text-dark my-2" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <h5>Loading Game Server List...<br><small>Please Wait...</small></h5>
                    </div>
                </div>
            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
    $db_conn_web->close();
?>