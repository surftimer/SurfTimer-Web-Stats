    <?php
        $nav_active_dropdown_dashboard  = array('Most Active - Dashboard', 'Top Players - Dashboard', 'Recent Records - Dashboard', 'Maps - Dashboard', 'Home - Dashboard', 'Servers - Dashboard');
        $nav_active_dropdown_other      = array('About', 'Terms of Service', 'Rules',  'Commands', 'Privacy Policy');
    ?>
    <!--
    <nav class="navbar navbar-expand-lg container navbar-light shadow-sm bg-secondary py-0">
        <a class="navbar-brand" href="https://kiepownica.com/"><small><i class="fab fa-kickstarter-k"></i> Kiepownica</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#KiepownicaNavBar" aria-controls="KiepownicaNavBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="KiepownicaNavBar">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="https://kiepownica.pl">kiepownica.pl</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://surfcommunity.eu">surfcommunity.eu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://surfcommunity.eu/dashboard-servers.php"><i class="fas fa-server"></i> Servers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://surfcommunity.eu/about.php"><i class="fas fa-info-circle"></i> About</a>
            </li>
        </div>
    </nav>
    -->

    <nav class="container navbar navbar-expand-lg navbar-light bg-light py-3 px-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href=""><i class="fab fa-kickstarter-k"></i> Kiepownica</a>
            <!--<a class="navbar-brand d-none d-md-block" href="https://surfcommunity.eu/"><img src="./images/logo_navbar.svg" height="40"></a>-->
            <!--<a class="navbar-brand d-md-none" href="https://surfcommunity.eu/"><img src="./images/logo_navbar_1.svg" height="40"></a>-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SurfCommunityNavBar" aria-controls="SurfCommunityNavBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="SurfCommunityNavBar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo nav_active('Home'); ?>">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if(in_array($page_name, $nav_active_dropdown_dashboard)) echo 'active'; ?>" href="#" id="Dashboard-Nav-Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="Dashboard-Na v-Dropdown">
                            <a class="dropdown-item <?php echo nav_active('Home - Dashboard'); ?>" href="dashboard-home.php"><i class="fas fa-home"></i> Home</a>
                            <a class="dropdown-item <?php echo nav_active('Servers - Dashboard'); ?>" href="dashboard-servers.php"><i class="fas fa-server"></i> Servers</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#SearchPlayers"><i class="fas fa-search"></i> Search Player</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo nav_active('Top Players - Dashboard'); ?>" href="dashboard-players.php"><i class="fas fa-users"></i> Top Players</a>
                            <a class="dropdown-item <?php echo nav_active('Maps - Dashboard'); ?>" href="dashboard-maps.php"><i class="fas fa-map"></i> Maps</a>
                            <a class="dropdown-item <?php echo nav_active('Most Active - Dashboard'); ?>" href="dashboard-mostactive.php"><i class="fas fa-user-clock"></i> Most Active</a>
                            <a class="dropdown-item <?php echo nav_active('Recent Records - Dashboard'); ?>" href="dashboard-recent.php"><i class="fas fa-stopwatch"></i> Recent Records</a>

                        </div>
                    </li>
                    <li class="nav-item <?php echo nav_active('Donate'); ?>">
                        <a class="nav-link" href="donate-old.php"><i class="fas fa-donate"></i> Donate</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if(in_array($page_name, $nav_active_dropdown_other)) echo 'active'; ?>" href="#" id="Other-Nav-Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i> Other
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="Other-Nav-Dropdown">
                            <a class="dropdown-item <?php echo nav_active('About'); ?>" href="about.php"><i class="fas fa-info-circle"></i> About</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="http://discord.surfcommunity.eu/" target="_blank"><i class="fab fa-discord"></i> Discord</a>
                            <a class="dropdown-item" href="http://steam.surfcommunity.eu/" target="_blank"><i class="fab fa-steam"></i> Steam Group</a>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">In Game</h6>
                            <a class="dropdown-item <?php echo nav_active('Rules'); ?>" href="rules.php"><i class="fas fa-list-ul"></i> Rules</a>
                            <a class="dropdown-item <?php echo nav_active('Commands'); ?>" href="commands.php"><i class="fas fa-keyboard"></i> Commands</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="http://status2.kristianpartl.eu/" target="_blank"><i class="fas fa-server"></i> Server Status</a>
                            <a class="dropdown-item" href="https://kiepownica.pl" target="_blank"><i class="fas fa-globe-europe"></i> Kiepownica</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo nav_active('Terms of Service'); ?>" href="terms-of-service.php"><i class="fas fa-info-circle"></i> Terms of Service</a>
                            <a class="dropdown-item <?php echo nav_active('Privacy Policy'); ?>" href="privacy-policy.php"><i class="fas fa-user-lock"></i> Privacy Policy</a>
                        </div>
                    </li>
                </ul>
                <?php if(!$steam->loggedIn()): ?>
                    <button type="button" class="btn btn-sm btn-outline-primary ml-3 shadow-sm" data-toggle="modal" data-target="#SteamLogin">
                        <i class="fas fa-sign-in-alt"></i> Sign in
                    </button>
                <?php else: ?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary ml-3 shadow-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> <?php echo $steam->personaname; ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm">
                            <a class="dropdown-item" href="dashboard-player.php?id=<?php echo $user_communityid; ?>"><i class="far fa-id-card"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?logout"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class=""></div>

    <div class="container bg-white shadow-lg">
        <div id="page-content">
    <?php if(!$steam->loggedIn()): ?>
        <!-- Login Modal -->
        <div class="modal shadow fade" id="SteamLogin" tabindex="-1" aria-labelledby="SteamLoginLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header shadow-sm">
                        <h5 class="modal-title" id="SteamLoginLabel"><i class="fas fa-sign-in-alt"></i> Sign in</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Please use the following button to sing in</p>
                        <a role="button" class="btn btn-dark btn-sm shadow-sm" href="<?php echo $steam->loginUrl(); ?>">Sign in through<br> <i class="fab fa-steam"></i> STEAM</a>
                    </div>
                    <div class="modal-footer shadow-sm">
                        <small class="text-muted">
                            <span class="text-dark">Surf Community</span> is a community website and is not affiliated with <a href="https://www.valvesoftware.com/" target="_blank" title="Valve Software">Valve</a> or <a href="https://steampowered.com/" target="_blank" title="Steam Powered">Steam</a>.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Search Modal -->
    <div class="modal shadow fade" id="SearchPlayers" tabindex="-1" aria-labelledby="SearchPlayersLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header shadow-sm">
                    <h5 class="modal-title" id="SearchPlayersLabel"><i class="fas fa-search"></i> Search Players</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="">
                        <input class="form-control form-control-lg shadow-sm" name="players_search" id="players_search" type="search" placeholder="Search players by Username, SteamID or SteamID64">
                    </form>
                    <div class="" id="players_search_result"></div>
                </div>
                <div class="modal-footer shadow-sm py-2">
                    <button type="button" class="btn btn-outline-secondary shadow-sm" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                </div>
            </div>
        </div>
    </div>