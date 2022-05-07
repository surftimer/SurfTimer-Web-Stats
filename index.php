<?php
    $page_name = 'Home';
    $lgsl_show_all_servers = 0;

    require_once('./inc/includes.php');

    require_once('./inc/pages/index_stats_badges.php');
    require_once('./inc/pages/team.php');

    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">
            <div class="jumbotron jumbotron-fluid text-center shadow-sm my-5">
                <div class="py-4">
                    <h1 class="display-4">Kiepownica & Surfcommunity<!--<small class="text-info">Beta</small>--></h1>
                    <p class="lead">
                        Kiepownica is a gaming community with CS:GO server group for 102.4 tick Surf mode.
                        <br>
                        Surfcommunity was established in the first quarter of 2020 and later merged with Kiepownica.
                    </p>
                </div>
            </div>
            
            <section class="my-5 pb-1">
                <!--
                <div class="alert alert-warning shadow-sm" role="alert">
                    <b>Warning:</b> Our Game Servers are currently having technical difficulties, please be patient.
                </div>
                -->

                <div class="" id="server-list">
                    <div class="text-center text-muted py-4">
                        <div class="spinner-grow text-dark my-2" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <h5>Loading Game Server List...<br><small>Please Wait...</small></h5>
                    </div>
                </div>

            </section>

            <section class="text-center my-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="my-3">
                                <i class="fas fa-map fa-3x text-dark"></i>
                            </div>
                            <h3><?php echo number_format($total_maps); ?></h3>
                            <p class="lead mb-0">Total Maps</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="my-3">
                                <i class="fas fa-users fa-3x text-dark"></i>
                            </div>
                            <h3><?php echo number_format($total_players); ?></h3>
                            <p class="lead mb-0">Total Players</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mx-auto mb-0 mb-lg-3">
                            <div class="my-3">
                                <i class="fas fa-bold fa-3x text-dark"></i>
                            </div>
                            <h3><?php echo number_format($total_bonuses); ?></h3>
                            <p class="lead mb-0">Total Bonuses</p>
                        </div>
                    </div>
                </div>
            </section>
        
            <hr>

            <section class="text-center my-5">
                <h3>About Surf Community & Kiepownica</h3>
                <p class="lead">
                    <strong>Surf Community</strong> is a Counter-Strike: Global Offensive community server group for <strong>102.4</strong> tick Surf mode.
                    <br>
                    The idea of creating a Counter-Strike: Global Offensive surf portal was created by <a href="https://github.com/KristianP26" class="text-dark">Kristián Partl</a> due to poor quality servers in our area.
                    <br>
                    Our servers are currently located just in Europe.
                    We were established in the first quarter of 2020.
                    <br>
                    <strong>Surf Community</strong> were merged with <strong>Kiepownica</strong> in first quarter of 2021. Our Game Servers are located in <strong>Poland, Warsaw</strong>.
                </p>
            </section>

            <hr>

            <section class="text-center my-5">
                <h3>Our Team</h3>
                <div class="table-responsive">
                    <table class="table table-borderless shadow-sm py-0 my-3">             
                        <tbody class="table-lg">
                            <?php foreach($team_users_position_less_20 as $team_user): ?>
                                <tr class="border">
                                    <td class="text-center align-middle py-4">
                                    <img class="bg-transparent border shadow-sm rounded my-0" title="<?php echo $team_user['country'];?>" height="28" src="<?php echo $team_user['country_flag'];?>"/>
                                    </td>
                                    <td class='text-left align-middle'>
                                        <span class="h4">
                                            <?php echo $team_user['name']; ?>
                                        </span> 
                                    </td>
                                    <td class='text-center align-middle'>
                                        <?php echo $team_user['roles']; ?>
                                    </td>
                                    <td class='text-center align-middle'>
                                        <div class="btn-group shadow-sm" role="group" aria-label="Social-Buttons">
                                            <a role="button" href="dashboard-player.php?id=<?php echo $team_user['steamid64']; ?>" class="btn btn-secondary"><i class="fas fa-user-circle fa-lg"></i></a>
                                            <a role="button" href="https://steamcommunity.com/profiles/<?php echo $team_user['steamid64'];?>/" target="_blank" class="btn btn-dark"><i class="fab fa-steam fa-lg"></i></a>
                                            <?php if($team_user['youtube_link']!=NULL): ?>
                                                <a role="button" href="<?php echo $team_user['youtube_link']; ?>" target="_blank" class="btn btn-danger"><i class="fab fa-youtube fa-lg"></i></a>
                                            <?php endif; ?>
                                            <?php if($team_user['twitch_link']!=NULL): ?>
                                                <a role="button" href="<?php echo $team_user['twitch_link']; ?>" target="_blank" class="btn bg-twitch text-white"><i class="fab fa-twitch fa-lg"></i></a>
                                            <?php endif; ?>
                                            <?php if($team_user['facebook_link']!=NULL): ?>
                                                <a role="button" href="<?php echo $team_user['facebook_link']; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-facebook fa-lg"></i></a>
                                            <?php endif; ?>
                                            <?php if($team_user['instagram_link']!=NULL): ?>
                                                <a role="button" href="<?php echo $team_user['instagram_link']; ?>" target="_blank" class="btn bg-instagram text-white"> <i class="fab fa-instagram fa-lg"></i></a>
                                            <?php endif; ?>
                                            <?php if($team_user['twitter_link']!=NULL): ?>
                                                <a role="button" href="<?php echo $team_user['twitter_link']; ?>" target="_blank" class="btn bg-twitter text-white"><i class="fab fa-twitter fa-lg"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-outline-info shadow-sm btn-block py-3 mt-3 mb-0" data-toggle="modal" data-target="#team-other"><i class="fas fa-users"></i> Show More Team Members</button>
                
                <div class="modal fade" id="team-other" tabindex="-1" aria-labelledby="team-otherLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="team-otherLabel">Team Members</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless shadow-sm py-0 my-0">             
                                        <tbody class="table-lg">
                                            <?php foreach($team_users_position_above_20 as $team_user): ?>
                                                <tr class="border">
                                                    <td class="text-center align-middle py-4">
                                                    <img class="bg-transparent border shadow-sm rounded my-0" title="<?php echo $team_user['country'];?>" height="22" src="<?php echo $team_user['country_flag'];?>"/>
                                                    </td>
                                                    <td class='text-left align-middle'>
                                                        <span class="h4">
                                                            <?php echo $team_user['name']; ?>
                                                        </span> 
                                                    </td>
                                                    <td class='text-center align-middle'>
                                                        <?php echo $team_user['roles']; ?>
                                                    </td>
                                                    <td class='text-center align-middle'>
                                                        <div class="btn-group shadow-sm" role="group" aria-label="Social-Buttons">
                                                            <a role="button" href="dashboard-player.php?id=<?php echo $team_user['steamid64']; ?>" class="btn btn-sm btn-secondary"><i class="fas fa-user-circle fa-lg"></i></a>
                                                            <a role="button" href="https://steamcommunity.com/profiles/<?php echo $team_user['steamid64'];?>/" target="_blank" class="btn btn-sm btn-dark"><i class="fab fa-steam fa-lg"></i></a>
                                                            <?php if($team_user['youtube_link']!=NULL): ?>
                                                                <a role="button" href="<?php echo $team_user['youtube_link']; ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fab fa-youtube fa-lg"></i></a>
                                                            <?php endif; ?>
                                                            <?php if($team_user['twitch_link']!=NULL): ?>
                                                                <a role="button" href="<?php echo $team_user['twitch_link']; ?>" target="_blank" class="btn btn-sm bg-twitch text-white"><i class="fab fa-twitch fa-lg"></i></a>
                                                            <?php endif; ?>
                                                            <?php if($team_user['facebook_link']!=NULL): ?>
                                                                <a role="button" href="<?php echo $team_user['facebook_link']; ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fab fa-facebook fa-lg"></i></a>
                                                            <?php endif; ?>
                                                            <?php if($team_user['instagram_link']!=NULL): ?>
                                                                <a role="button" href="<?php echo $team_user['instagram_link']; ?>" target="_blank" class="btn btn-sm bg-instagram text-white"> <i class="fab fa-instagram fa-lg"></i></a>
                                                            <?php endif; ?>
                                                            <?php if($team_user['twitter_link']!=NULL): ?>
                                                                <a role="button" href="<?php echo $team_user['twitter_link']; ?>" target="_blank" class="btn btn-sm bg-twitter text-white"><i class="fab fa-twitter fa-lg"></i></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
    $db_conn_web->close();
    
?>
