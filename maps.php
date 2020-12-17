<?php
    $page_name = "Maps";
    require_once "config.php";
    require_once "./inc/includes.php";

    require_once "./inc/maps.php";
    require_once "header.php";
    require_once "navbar.php";
?>

    <div class="container">
        <div class="mt-5">
            <div class="row">
            <div class="col-12">  
                    <div class="card shadow-sm my-2">
                        <div class="card-header">
                            SurfStats's Map Collection
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover border shadow-sm py-0 my-0" id="maps">
                                    <thead>
                                        <th class="text-left">Map Name</th>
                                        <th class="text-center">Tier</th>
                                        <th class="text-center">Max Velocity</th>
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