<?php
    $page_name = 'Maps - Dashboard';
    
    require_once('./inc/includes.php');

    if (isset($_GET['map']))
        $mapname = $_GET['map'];
    else
        $mapname = '';

    //require_once('./inc/pages/dashboard_maps.php');
    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">


            <section class="my-4 pb-1">
                <div class="" id="maps-load">
                    <?php if((isset($mapname))&&($mapname!=='')): ?>
                        <h5><a href="dashboard-maps.php" class="text-muted text-decoration-none">Surf Stat's <?php echo MAP_COLLECTION; ?></a>  / <?php echo $mapname;?></h5>
                        <hr class="mt-0 mb-3">                       
                        <div class="text-center text-muted py-4">
                            <div class="spinner-grow text-dark my-2" role="status">
                                <span class="sr-only"><?php echo LOADING; ?>...</span>
                            </div>
                            <h5><?php echo LOADING_MAP; ?>: <b><?php echo $mapname; ?></b> <?php echo DETAILS; ?>...<br><small><?php echo PLEASE_WAIT; ?>...</small></h5>
                        </div>
                    <?php else: ?>
                        <h5>Surf Stat's <?php echo MAP_COLLECTION; ?></h5>
                        <hr class="mt-0 mb-3">                       
                        <div class="text-center text-muted py-4">
                            <div class="spinner-grow text-dark my-2" role="status">
                                <span class="sr-only"><?php echo LOADING; ?>...</span>
                            </div>
                            <h5><?php echo LOADING_MAP_COLLECTION; ?>...<br><small><?php echo PLEASE_WAIT; ?>...</small></h5>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
?>