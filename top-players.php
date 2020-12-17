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
                            SurfStats's TOP <?php echo $settings_top_players_count;?> Players
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover border shadow-sm py-0 my-0" id="top-players">
                                    <thead>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Username</th>
                                        <th class="text-center">Points</th>
                                        <th class="text-center">Maps</th>
                                        <th class="text-center">Bonuses</th>
                                        <th class="text-center">Stages</th>
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