<?php
    $page_name = 'Home - Dashboard';
    
    require_once('./inc/includes.php');
    require_once('./inc/pages/dashboard_home.php');

    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">

            <section class="my-4 pb-1">

                <h5>Surf Community's Dashboard</h5>
                <hr class="my-0">

                <div class="mt-4 mb-4"> <!-- Info Badges -->
                    <div class="row">
                        <div class="col-md col-12">
                            <div class="card card-body text-center shadow-sm my-2">
                                <i class="fas fa-users fa-2x"></i>
                                <span class="text-muted my-1">Total Players</span>
                                <hr>
                                <?php echo number_format($total_players); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body text-center shadow-sm my-2">
                                <i class="fas fa-map fa-2x"></i>
                                <span class="text-muted my-1">Total Maps</span>
                                <hr>
                                <?php echo number_format($total_maps); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body text-center shadow-sm my-2">
                                <i class="fas fa-bold fa-2x"></i>
                                <span class="text-muted my-1">Total Bonuses</span>
                                <hr>
                                <?php echo number_format($total_bonuses); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body text-center shadow-sm my-2">
                                <i class="fas fa-user-clock fa-2x"></i>
                                <span class="text-muted my-1">Total Completions</span>
                                <hr>
                                <?php echo number_format($count_player_times); ?>
                            </div>
                        </div>
                        <div class="col-md col-12">
                            <div class="card card-body text-center shadow-sm my-2">
                                <i class="fas fa-clock fa-2x"></i>
                                <span class="text-muted my-1">Hours Played</span>
                                <hr>
                                <?php echo number_format($hours_played); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12"> <!-- Recent Records -->
                        <div class="mt-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-6">
                                            Recent 10 Map Records
                                        </div>
                                        <div class="col col-md-6 text-right">
                                            <a href="dashboard-recent.php" class="badge btn-outline-dark py-1 px-2 shadow-sm border"><i class="fas fa-stopwatch"></i> Show More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-left px-3" scope="col">Username</th>
                                                <th class="text-center" scope="col">Map</th>
                                                <th class="text-center" scope="col">Time</th>
                                                <th class="text-center" scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($r10rs as $r10r): ?>
                                                <?php
                                                    $runtime_r10rs_data = $r10r['runtime'];    
                                                    $runtime_r10rs_microtime = substr($runtime_r10rs_data, strpos($runtime_r10rs_data, ".") + 1);    
                                                    $runtime_r10rs_timeFormat = gmdate("H:i:s", $runtime_r10rs_data).'<span class="text-muted">.'.$runtime_r10rs_microtime.'</span>';
                                                    $dateFormat_r10rs = date('Y/m/d  (H:i)', strtotime($r10r['date']));
                                                ?>
                                                <tr>
                                                    <td class="px-3"><?php echo $r10r['normal_name']; ?> <a href="dashboard-player.php?id=<?php echo $r10r['steamid64']; ?>" target="" title="<?php echo $r10r['name']; ?> - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/<?php echo $r10r['steamid64']; ?>" target="_blank" title="<?php echo $r10r['normal_name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a></td>
                                                    <td class="text-center"><a href="dashboard-maps.php?map=<?php echo $r10r['map']; ?>" class="text-muted text-decoration-none"><?php echo $r10r['map']; ?> <i class="fas fa-link"></i></a></td>
                                                    <td class="text-center"><?php echo $runtime_r10rs_timeFormat; ?></td>
                                                    <td class="text-center"><small><?php echo $dateFormat_r10rs; ?></small></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-12"> <!-- TOP players -->
                        <div class="my-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-6">
                                            Top 10 Players
                                        </div>
                                        <div class="col col-md-6 text-right">
                                            <a href="dashboard-players.php" class="badge btn-outline-dark py-1 px-2 shadow-sm border"><i class="fas fa-users"></i> Show More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col">Username</th>
                                                <th class="text-center" scope="col">Points</th>
                                                <th class="text-center" scope="col">Maps</th>
                                                <th class="text-center" scope="col">Bonuses</th>
                                                <th class="text-center" scope="col">Stages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10p_row_number = '0'; foreach($t10ps as $t10p): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10p_row_number; ?>.</td>
                                                    <td class="text-left"><?php echo $t10p['name']; ?>  <a href="dashboard-player.php?id=<?php echo $t10p['steamid64']; ?>" target="" title="<?php echo $t10p['name']; ?> - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/<?php echo $t10p['steamid64']; ?>" target="_blank" title="<?php echo $t10p['name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a></td>
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
                                    <div class="row">
                                        <div class="col col-md-6">
                                            Top 10 WR holders
                                        </div>
                                        <div class="col col-md-6 text-right">
                                            <a href="dashboard-players.php" class="badge btn-outline-dark py-1 px-2 shadow-sm border"><i class="fas fa-users"></i> Show More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col">Username</th>
                                                <th class="text-center" scope="col">WRs</th>
                                                <th class="text-center" scope="col">Finished Maps</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10wrh_row_number = '0'; foreach($t10wrhs as $t10wrh): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10wrh_row_number; ?>.</td>
                                                    <td class="text-left"><?php echo $t10wrh['name']; ?>  <a href="dashboard-player.php?id=<?php echo $t10wrh['steamid64']; ?>" target="" title="<?php echo $t10wrh['name']; ?> - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/<?php echo $t10wrh['steamid64']; ?>" target="_blank" title="<?php echo $t10wrh['name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a></td>
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
                                    <div class="row">
                                        <div class="col col-md-6">
                                            Tol 10 bonus WR Holders
                                        </div>
                                        <div class="col col-md-6 text-right">
                                            <a href="dashboard-players.php" class="badge btn-outline-dark py-1 px-2 shadow-sm border"><i class="fas fa-users"></i> Show More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col">Username</th>
                                                <th class="text-center" scope="col">WRs</th>
                                                <th class="text-center" scope="col">Finished Bonuses</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10bwrh_row_number = '0'; foreach($t10bwrhs as $t10bwrh): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10bwrh_row_number; ?>.</td>
                                                    <td class="text-left"><?php echo $t10bwrh['name']; ?>  <a href="dashboard-player.php?id=<?php echo $t10bwrh['steamid64']; ?>" target="" title="<?php echo $t10bwrh['name']; ?> - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/<?php echo $t10bwrh['steamid64']; ?>" target="_blank" title="<?php echo $t10bwrh['name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a></td>
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
                                    <div class="row">
                                        <div class="col col-md-6">
                                            Top 10 stage WR holders
                                        </div>
                                        <div class="col col-md-6 text-right">
                                            <a href="dashboard-players.php" class="badge btn-outline-dark py-1 px-2 shadow-sm border"><i class="fas fa-users"></i> Show More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-left" scope="col">Username</th>
                                                <th class="text-center" scope="col">WRs</th>
                                                <th class="text-center" scope="col">Finished Stages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $t10swrh_row_number = '0'; foreach($t10swrhs as $t10swrh): ?>
                                                <?php
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo ++$t10swrh_row_number; ?>.</td>
                                                    <td class="text-left"><?php echo $t10swrh['name']; ?>  <a href="dashboard-player.php?id=<?php echo $t10swrh['steamid64']; ?>" target="" title="<?php echo $t10swrh['name']; ?> - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/<?php echo $t10swrh['steamid64']; ?>" target="_blank" title="<?php echo $t10swrh['name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a></td>
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
                    
                    <div class="col-md-6 col-12"> <!-- TOP Stage WR holders -->
                        <div class="my-3">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col col-md-6">
                                            Recently added maps
                                        </div>
                                        <div class="col col-md-6 text-right">
                                            <a href="dashboard-maps.php" class="badge btn-outline-dark py-1 px-2 shadow-sm border"><i class="fas fa-map"></i> Show More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover shadow-sm card-body table-sm py-0 my-0">
                                        <thead>
                                            <tr class="">
                                                <th class="text-left pl-3" scope="col">Map</th>
                                                <th class="text-center" scope="col">Tier</th>
                                                <th class="text-center" scope="col">Type</th>
                                                <th class="text-center" scope="col">Bonus</th>
                                                <th class="text-center" scope="col">Added</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($rams as $ram): ?>
                                                <?php
                                                ?>
                                                <tr> 
                                                    <td class="text-left pl-3"><?php echo $ram[0]; ?></td>
                                                    <td class="text-center"><?php echo $ram[2]; ?></td>
                                                    <td class="text-center"><?php echo $ram[1]; ?></td>
                                                    <td class="text-center"><?php echo $ram[3]; ?></td>
                                                    <td class="text-center"><?php echo $ram[4]; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
?>