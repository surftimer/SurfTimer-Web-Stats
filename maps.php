<?php
    $page_name = "Maps";
    require_once "config.php";
    require_once "./inc/includes.php";

    if (isset($_GET['map']))
        $mapname = $_GET['map'];

    require_once "./inc/maps.php";
    require_once "header.php";
    require_once "navbar.php";
?>

    <div class="container">
        <div class="mt-5">
            <div class="row">
            <div class="col-12">  
                    <div class="card shadow-sm my-2">
                        <?php if(isset($mapname)): ?>
                            
                            <div class="card-header">
                                <a href="maps.php" class="text-muted">SurfStats's Map Collection</a> / <?php echo $mapname;?>
                            </div>
                            <?php if(mysqli_num_rows($results_map) > 0): ?>

                                <div class="card-body">
                                    <div class="mb-4">

                                        <div class="my-3">
                                            <h3 class="text-center"><?php echo $mapname; ?></h3>
                                            <div class="row justify-content-md-center">
                                                <div class="col-12 col-md-auto text-center">
                                                    Type: <b><?php echo $map_stages_info;?></b>
                                                </div>
                                                <div class="col-12 col-md-auto text-center">
                                                    Tier: <b><?php echo $map_tier;?></b>
                                                </div>
                                                <div class="col-12 col-md-auto text-center">
                                                    Bonus: <b><?php echo $map_bonuses_info;?></b>
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center">
                                                <div class="col-12 col-md-auto text-center">
                                                    Max Velocity: <b><?php echo number_format($map_maxvelocity); ?></b>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="text-center text-muted my-1">
                                            Total Completions: <span class="text-body"><?php echo number_format($map_total_completions_count); ?></span>
                                        </h5>
                                        <h6 class="text-center text-muted my-1">
                                            Normal Style Completions: <span class="text-body"><?php echo number_format($map_normal_completions_count); ?></span>
                                        </h6>

                                        <?php if($map_total_bonuses_completions_count!=='0'): ?>
                                            <h5 class="text-center text-muted my-1">
                                                Bonuses Total Completions: <span class="text-body"><?php echo number_format($map_total_bonuses_completions_count); ?></span>
                                            </h5>
                                            <?php if($map_normal_bonuses_completions_count!=='0'): ?>
                                                <h6 class="text-center text-muted my-1">
                                                    Bonuses Normal Style Completions: <span class="text-body"><?php echo number_format($map_normal_bonuses_completions_count); ?></span>
                                                </h6>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if($map_normal_completions_count!=='0'): ?>
                                        <hr>
                                        <h5 class="text-center">Normal Style Map Completions</h5>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover border shadow-sm py-0 my-0" id="map-completions">
                                                <thead>
                                                    <th class="text-left">#</th>
                                                    <th class="text-center">Username</th>
                                                    <th class="text-center">Time</th>
                                                </thead>
                                                <tbody class="">
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if($map_stages>'1'): ?>
                                        <hr>
                                        <h5 class="text-center">Stage TOP completions Normal style</h5>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-sm table-hover border shadow-sm py-0 my-0">
                                                <thead>
                                                    <th class="text-center">Stages</th>
                                                    <th class="text-left">Top Player Name</th>
                                                    <th class="text-center">Top Time</th>
                                                    <th class="text-center">Total Stage Completions</th>
                                                </thead>
                                                <tbody class="">
                                                    <?php foreach($map_top_stages as $map_top_stage): ?>
                                                        <tr>
                                                            <td class="text-center">Stage: <?php echo $map_top_stage['0']; ?></td>
                                                            <td class="text-left"><?php echo $map_top_stage['1']; ?></td>
                                                            <td class="text-center"><?php echo $map_top_stage['2']; ?></td>
                                                            <td class="text-center">Completions (N): <?php echo $map_top_stage['3']; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if($map_bonuses>'0'): ?>
                                        <hr>
                                        <h5 class="text-center">Normal Style Bonuses Completions</h5>
                                        
                                        <nav>
                                            <div class="nav nav-tabs nav-fill my-3" id="bonuses-tabs" role="tablist">
                                                <?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions_counts as $map_bonuses_completions_count): ?>
                                                    <a class="nav-item nav-link pb-3 <?php if(++$map_bonuses_completions_number=='1') echo 'active'; ?>" href="#bonuses-content-<?php echo $map_bonuses_completions_number; ?>" id="bonuses-content-<?php echo $map_bonuses_completions_number; ?>-tab" data-toggle="tab" role="tab" aria-controls="bonuses-content-<?php echo $map_bonuses_completions_number; ?>" aria-selected="true">
                                                        <b class="text-muted">Bonus <?php echo $map_bonuses_completions_number; ?></b>
                                                        <br>
                                                        <span class="text-dark"><?php echo number_format($map_bonuses_completions_count); ?>
                                                    </a>
                                                <?php endforeach; ?>                                            
                                            </div>
                                        </nav>

                                        <div class="tab-content my-2" id="bonuses-content">       
                                            <?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions as $map_bonuses_completion):   ?>
                                                <div class="tab-pane fade <?php if(++$map_bonuses_completions_number=='1') echo 'show active'; ?>" id="bonuses-content-<?php echo $map_bonuses_completions_number; ?>" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover border shadow-sm py-0 my-0" id="bonuses-completions-<?php echo $map_bonuses_completions_number; ?>">
                                                            <thead>
                                                                <th class="text-center">#</th>
                                                                <th class="text-left">Username</th>
                                                                <th class="text-center">Time</th>
                                                            </thead>
                                                            <tbody class="table-sm">
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                    <?php endif; ?>

                                </div>

                            <?php else: ?>
                                <div class="card-body">
                                    <h5 class="text-center my-3"><i class="fas fa-info-circle"></i> Map: <strong><?php echo $mapname; ?></strong> were not found in our database.</h5>
                                </div>
                            <?php endif; ?>

                        <?php else: ?>

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

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once "footer.php";
    $db_conn->close();
?>