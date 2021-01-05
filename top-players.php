<?php
    $page_name = "Top Players";
    require_once "config.php";
    require_once "./inc/includes.php";

    require_once "./inc/top_players.php";
    require_once "header.php";
    require_once "navbar.php";
?>

    <div class="container">
        <div class="mt-5">  
            <div class="row">
                <div class="col-12">  
                    <div class="card shadow-sm my-2">
                        <div class="card-header">
                            SurfStats's <?php echo TOP;?> <?php echo $settings_top_players_count;?> <?php echo PLAYERS;?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover border shadow-sm py-0 my-0" id="top-players">
                                    <thead>
                                        <th class="text-center">#</th>
                                        <th class="text-left"><?php echo USERNAME;?></th>
                                        <th class="text-center"><?php echo POINTS;?></th>
                                        <th class="text-center"><?php echo MAPS;?></th>
                                        <th class="text-center"><?php echo BONUSES;?></th>
                                        <th class="text-center"><?php echo STAGES;?></th>
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

<?php
    require_once "footer.php";
    $db_conn->close();
?>