<?php
    $page_name = "Dashboard";
    
    require_once "config.php";
    require_once "./inc/includes.php";

    require_once "./inc/index_stats.php";
    require_once "header.php";
    require_once "navbar.php";
?>

    <div class="container">

        <div class="mt-5 mb-2"> <!-- Info Badges -->
            <div class="row">
                <div class="col-md col-12">
                    <div class="card card-body text-center shadow-sm my-2">
                        <i class="fas fa-users fa-2x"></i>
                        <span class="text-muted my-1"><?php echo TOTAL_PLAYERS;?></span>
                        <hr>
                        <?php echo number_format($total_players); ?>
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="card card-body text-center shadow-sm my-2">
                        <i class="fas fa-map fa-2x"></i>
                        <span class="text-muted my-1"><?php echo TOTAL_MAPS;?></span>
                        <hr>
                        <?php echo number_format($total_maps); ?>
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="card card-body text-center shadow-sm my-2">
                        <i class="fas fa-bold fa-2x"></i>
                        <span class="text-muted my-1"><?php echo TOTAL_BONUSES;?></span>
                        <hr>
                        <?php echo number_format($total_bonuses); ?>
                    </div>
                </div>
                <div class="col-md col-12">
                    <div class="card card-body text-center shadow-sm my-2">
                        <i class="fas fa-user-clock fa-2x"></i>
                        <span class="text-muted my-1"><?php echo TOTAL_COPT;?></span>
                        <hr>
                        <?php echo number_format($count_player_times); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12"> <!-- Recent Records -->
                <div class="mt-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <?php echo RECENT_10_RECORDS;?> <small class="text-muted">| <?php echo ANY_STYlE;?></small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover shadow card-body table-sm py-0 my-0">
                                <thead>
                                    <tr class="">
                                        <th class="text-left px-3" scope="col"><?php echo USERNAME;?></th>
                                        <th class="text-center" scope="col"><?php echo MAP_NAME;?></th>
                                        <th class="text-center" scope="col"><?php echo TIME;?></th>
                                        <th class="text-center" scope="col"><?php echo DATE;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($r10rs as $r10r): ?>
                                        <?php
                                            $runtime_r10rs_data = $r10r['runtime'];    
                                            $runtime_r10rs_microtime = substr($runtime_r10rs_data, strpos($runtime_r10rs_data, ".") + 1);    
                                            $runtime_r10rs_timeFormat = gmdate("H:i:s", $runtime_r10rs_data).'<span class="text-muted">.'.$runtime_r10rs_microtime.'</span>';
                                            $dateFormat_r10rs = date('d/m/Y  H:i', strtotime($r10r['date']));
                                        ?>
                                        <tr>
                                            <td class="px-3"><?php echo $r10r['normal_name']; ?> <a href="https://steamcommunity.com/profiles/<?php echo $r10r['steamid64']; ?>" target="_blank" title="<?php echo $r10r['normal_name']; ?> - <?php echo STEAM_PROFILE;?>" class="text-muted"><i class="fab fa-steam"></i></a></td>
                                            <td class="text-center"><?php echo $r10r['map']; ?> <a href="maps.php?map=<?php echo $r10r['map']; ?>" class="text-muted"><i class="fas fa-link"></i></a></td>
                                            <td class="text-center"><?php echo $runtime_r10rs_timeFormat; ?></td>
                                            <td class="text-center"><?php echo $dateFormat_r10rs; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12"> <!-- TOP players -->
                <div class="my-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <?php echo TOP10P;?> <small class="text-muted">| <?php echo NORMAL_STYLE;?></small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover shadow card-body table-sm py-0 my-0">
                                <thead>
                                    <tr class="">
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-left" scope="col"><?php echo USERNAME;?></th>
                                        <th class="text-center" scope="col"><?php echo POINTS;?></th>
                                        <th class="text-center" scope="col"><?php echo MAPS;?></th>
                                        <th class="text-center" scope="col"><?php echo BONUSES;?></th>
                                        <th class="text-center" scope="col"><?php echo STAGES;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $t10p_row_number = '0'; foreach($t10ps as $t10p): ?>
                                        <?php
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$t10p_row_number; ?>.</td>
                                            <td class="text-left"><?php echo $t10p['name']; ?> <a href="https://steamcommunity.com/profiles/<?php echo $t10p['steamid64']; ?>" target="_blank" title="<?php echo $t10p['name']; ?> - <?php echo STEAM_PROFILE;?>" class="text-muted"><i class="fab fa-steam"></i></a></td>
                                            <td class="text-center"><?php echo number_format($t10p['points']); ?></td>
                                            <td class="text-center"><?php echo number_format($t10p['finishedmapspro']); ?></td>
                                            <td class="text-center"><?php echo number_format($t10p['finishedbonuses']); ?></td>
                                            <td class="text-center"><?php echo number_format($t10p['finishedstages']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12"> <!-- TOP WR holders -->
                <div class="my-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <?php echo TOP10WRH;?> <small class="text-muted">| <?php echo NORMAL_STYLE;?></small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover shadow card-body table-sm py-0 my-0">
                                <thead>
                                    <tr class="">
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-left" scope="col"><?php echo USERNAME;?></th>
                                        <th class="text-center" scope="col"><?php echo WRS;?></th>
                                        <th class="text-center" scope="col"><?php echo FINISHED_MAPS;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $t10wrh_row_number = '0'; foreach($t10wrhs as $t10wrh): ?>
                                        <?php
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$t10wrh_row_number; ?>.</td>
                                            <td class="text-left"><?php echo $t10wrh['name']; ?> <a href="https://steamcommunity.com/profiles/<?php echo $t10wrh['steamid64']; ?>" target="_blank" title="<?php echo $t10wrh['name']; ?> - <?php echo STEAM_PROFILE;?>" class="text-muted"><i class="fab fa-steam"></i></a></td>
                                            <td class="text-center"><?php echo number_format($t10wrh['wrs']); ?></td>
                                            <td class="text-center"><?php echo number_format($t10wrh['finishedmapspro']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-12"> <!-- TOP bonus WR holders -->
                <div class="my-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <?php echo TOP10BWRH;?> <small class="text-muted">| <?php echo NORMAL_STYLE;?></small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover shadow card-body table-sm py-0 my-0">
                                <thead>
                                    <tr class="">
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-left" scope="col"><?php echo USERNAME;?></th>
                                        <th class="text-center" scope="col"><?php echo WRS;?></th>
                                        <th class="text-center" scope="col"><?php echo FINISHED_BONUSES;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $t10bwrh_row_number = '0'; foreach($t10bwrhs as $t10bwrh): ?>
                                        <?php
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$t10bwrh_row_number; ?>.</td>
                                            <td class="text-left"><?php echo $t10bwrh['name']; ?>  <a href="https://steamcommunity.com/profiles/<?php echo $t10bwrh['steamid64']; ?>" target="_blank" title="<?php echo $t10bwrh['name']; ?> - <?php echo STEAM_PROFILE;?>" class="text-muted"><i class="fab fa-steam"></i></a></td>
                                            <td class="text-center"><?php echo number_format($t10bwrh['wrbs']); ?></td>
                                            <td class="text-center"><?php echo number_format($t10bwrh['finishedbonuses']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12"> <!-- TOP Stage WR holders -->
                <div class="my-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <?php echo TOP10SWRH;?> <small class="text-muted">| <?php echo NORMAL_STYLE;?></small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover shadow card-body table-sm py-0 my-0">
                                <thead>
                                    <tr class="">
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-left" scope="col"><?php echo USERNAME;?></th>
                                        <th class="text-center" scope="col"><?php echo WRS;?></th>
                                        <th class="text-center" scope="col"><?php echo FINISHED_STAGES;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $t10swrh_row_number = '0'; foreach($t10swrhs as $t10swrh): ?>
                                        <?php
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$t10swrh_row_number; ?>.</td>
                                            <td class="text-left"><?php echo $t10swrh['name']; ?> <a href="https://steamcommunity.com/profiles/<?php echo $t10swrh['steamid64']; ?>" target="_blank" title="<?php echo $t10swrh['name']; ?> - <?php echo STEAM_PROFILE;?>" class="text-muted"><i class="fab fa-steam"></i></a></td>
                                            <td class="text-center"><?php echo number_format($t10swrh['wrcps']); ?></td>
                                            <td class="text-center"><?php echo number_format($t10swrh['finishedstages']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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