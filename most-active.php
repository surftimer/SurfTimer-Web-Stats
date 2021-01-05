<?php
    $page_name = "Most Active";
    require_once "config.php";
    require_once "./inc/includes.php";

    require_once "./inc/most_active.php";
    require_once "header.php";
    require_once "navbar.php";
?>

<?php if($settings_most_active_enable): ?>

    <div class="container">
        <div class="mt-5">  
            <div class="row">
                <div class="col-12">  
                    <div class="card shadow-sm my-2">
                        <div class="card-header">
                            SurfStats's <?php echo MOST_ACTIVE;?> <small class="text-muted">| <?php echo MOST_ACTIVE_DESCRIPTION;?></small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover border shadow-sm py-0 my-0" id="most-active">
                                    <thead>
                                        <th class="text-center">#</th>
                                        <th class="text-left"><?php echo USERNAME;?></th>
                                        <th class="text-center"><?php echo HOURS_PLAYED;?></th>
                                        <th class="text-center"><?php echo CONNECTIONS;?></th>
                                        <th class="text-center"><?php echo LAST_SEEN;?></th>
                                        <th class="text-center"><?php echo JOINED;?></th>
                                    </thead>
                                    <tbody class="table-sm">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

    <h4 class="text-center my-5"><?php echo MOST_ACTIVE_DISABLED;?><br><small><?php echo MOST_ACTIVE_ACTIVATE;?></small></h4>

<?php endif; ?>
    
<?php
    require_once "footer.php";
    $db_conn->close();
?>