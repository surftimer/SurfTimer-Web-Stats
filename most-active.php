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
                            SurfStats's Most Active Players <small class="text-muted">| Showing players with more than two hours of playtime.</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover border shadow-sm py-0 my-0" id="most-active">
                                    <thead>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Username</th>
                                        <th class="text-center">Hours Played</th>
                                        <th class="text-center">Connections</th>
                                        <th class="text-center">Last Seen</th>
                                        <th class="text-center">Joined</th>
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

    <h4 class="text-center my-5">Most Active module is disabled.<br><small>For activation please contact administrator.</small></h4>

<?php endif; ?>
    
<?php
    require_once "footer.php";
    $db_conn->close();
?>