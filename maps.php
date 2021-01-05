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
                                <a href="maps.php" class="text-muted">SurfStats's <?php echo MAPS_COLLECTION;?></a> / <?php echo $mapname;?>
                            </div>
                            <?php if(mysqli_num_rows($results_map) > 0): ?>

                                <div class="card-body">
                                    <div class="mb-4">

                                        <div class="my-3">
                                            <h3 class="text-center"><?php echo $mapname; ?></h3>
                                            <div class="row justify-content-md-center">
                                                <div class="col-12 col-md-auto text-center">
                                                    <?php echo TYPE;?>: <b><?php echo $map_stages_info;?></b>
                                                </div>
                                                <div class="col-12 col-md-auto text-center">
                                                    <?php echo TIER;?>: <b><?php echo $map_tier;?></b>
                                                </div>
                                                <div class="col-12 col-md-auto text-center">
                                                    <?php echo BONUS;?>: <b><?php echo $map_bonuses_info;?></b>
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center">
                                                <div class="col-12 col-md-auto text-center">
                                                    <?php echo MAX_VELOCITY;?>: <b><?php echo number_format($map_maxvelocity); ?></b>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="text-center text-muted my-1">
                                            <?php echo TOTAL_COMPLETIONS;?>: <span class="text-body"><?php echo number_format($map_total_completions_count); ?></span>
                                        </h5>
                                        <h6 class="text-center text-muted my-1">
                                            <?php echo NSC;?>: <span class="text-body"><?php echo number_format($map_normal_completions_count); ?></span>
                                        </h6>

                                        <?php if($map_total_bonuses_completions_count!=='0'): ?>
                                            <h5 class="text-center text-muted my-1">
                                                <?php echo BTC;?>: <span class="text-body"><?php echo number_format($map_total_bonuses_completions_count); ?></span>
                                            </h5>
                                            <?php if($map_normal_bonuses_completions_count!=='0'): ?>
                                                <h6 class="text-center text-muted my-1">
                                                    <?php echo BNSC;?>: <span class="text-body"><?php echo number_format($map_normal_bonuses_completions_count); ?></span>
                                                </h6>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if($map_normal_completions_count!=='0'): ?>
                                        <hr>
                                        <h5 class="text-center"><?php echo NSMC;?></h5>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover border shadow-sm py-0 my-0" id="map-completions">
                                                <thead>
                                                    <th class="text-center">#</th>
                                                    <th class="text-left"><?php echo USERNAME;?></th>
                                                    <th class="text-center"><?php echo TIME;?></th>
                                                </thead>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if($map_stages>'1'): ?>
                                        <hr>
                                        <h5 class="text-center"><?php echo STCNS;?></h5>
                                        <div class="table-responsive shadow-sm mt-3">
                                            <table class="table table-sm table-hover border shadow-sm py-0 my-0">
                                                <thead>
                                                    <th class="text-center"><?php echo STAGES;?></th>
                                                    <th class="text-left"><?php echo TOP_PLAYER_NAME;?></th>
                                                    <th class="text-center"><?php echo TOP_TIME;?></th>
                                                    <th class="text-center"><?php echo TOTAL_STAGE_COMP;?></th>
                                                </thead>
                                                <tbody class="">
                                                    <?php foreach($map_top_stages as $map_top_stage): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo STAGE;?>: <strong><?php echo $map_top_stage['0']; ?></strong></td>
                                                            <td class="text-left"><?php echo $map_top_stage['1']; ?></td>
                                                            <td class="text-center"><?php echo $map_top_stage['2']; ?></td>
                                                            <td class="text-center"><?php echo COMPLETIONS;?> (N): <?php echo $map_top_stage['3']; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if($map_bonuses>'0'): ?>
                                        <hr>
                                        <h5 class="text-center"><?php echo NSBC;?></h5>
                                        
                                        <nav>
                                            <div class="nav nav-tabs nav-fill my-3" id="bonuses-tabs" role="tablist">
                                                <?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions_counts as $map_bonuses_completions_count): ?>
                                                    <a class="nav-item nav-link pb-3 <?php if(++$map_bonuses_completions_number=='1') echo 'active'; ?>" href="#bonuses-content-<?php echo $map_bonuses_completions_number; ?>" id="bonuses-content-<?php echo $map_bonuses_completions_number; ?>-tab" data-toggle="tab" role="tab" aria-controls="bonuses-content-<?php echo $map_bonuses_completions_number; ?>" aria-selected="true">
                                                        <b class="text-muted"><?php echo BONUS;?> <?php echo $map_bonuses_completions_number; ?></b>
                                                        <br>
                                                        <span class="text-body"><?php echo number_format($map_bonuses_completions_count); ?></span>
                                                    </a>
                                                <?php endforeach; ?>                                            
                                            </div>
                                        </nav>

                                        <div class="tab-content my-2" id="bonuses-tabsContent">       
                                            <?php $map_bonuses_completions_number = 0; foreach($map_bonuses_completions as $map_bonuses_completion): ++$map_bonuses_completions_number; ?>
                                                <div class="tab-pane fade<?php if($map_bonuses_completions_number=='1') echo ' show active'; ?>" id='bonuses-content-<?php echo $map_bonuses_completions_number; ?>' role="tabpanel" aria-labelledby="bonuses-content-<?php echo $map_bonuses_completions_number; ?>-tab">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover border table-sm shadow-sm py-0 my-0" id="bonuses-completions-<?php echo $map_bonuses_completions_number; ?>">
                                                            <thead>
                                                                <th class="text-center">#</th>
                                                                <th class="text-left"><?php echo USERNAME;?></th>
                                                                <th class="text-center"><?php echo TIME;?></th>
                                                            </thead>
                                                            <tbody>
                                                                <?php $map_bonuses_completion_r_row = 0; foreach($map_bonuses_completion as $map_bonuses_completion_r): ?>
                                                                    <tr>
                                                                        <td><?php echo ++$map_bonuses_completion_r_row; ?>.</td>
                                                                        <td><?php echo $map_bonuses_completion_r[0]; ?></td>
                                                                        <td><?php echo$map_bonuses_completion_r[1]; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
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
                                    <h5 class="text-center my-3"><i class="fas fa-info-circle"></i> <?php echo  MAP;?>: <strong><?php echo $mapname; ?></strong> <?php echo MAP_NOT_FOUND;?></h5>
                                </div>
                            <?php endif; ?>

                        <?php else: ?>

                            <div class="card-header">
                                SurfStats's <?php echo MAPS_COLLECTION;?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover border shadow-sm py-0 my-0" id="maps">
                                        <thead>
                                            <th class="text-left"><?php echo MAP_NAME;?></th>
                                            <th class="text-center"><?php echo TIER;?></th>
                                            <th class="text-center"><?php echo MAX_VELOCITY;?></th>
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