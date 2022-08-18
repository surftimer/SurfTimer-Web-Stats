    <?php
        $nav_active_dropdown_dashboard  = array('Most Active - Dashboard', 'Top Players - Dashboard', 'Recent Records - Dashboard', 'Maps - Dashboard', 'Home - Dashboard', 'Servers - Dashboard');
    ?>
    
    <!-- Coded & Designed with ❤ by Kristián Partl.  --->

    <nav class="container navbar navbar-expand-lg navbar-light bg-light py-3 px-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
            <?php 
                if($settings_navbar_logo!='')
                    echo '<img src="./images/'.$settings_navbar_logo.'" height="40">';
                else
                    echo $settings_navbar_title;
            ?>
            </a>
            <!-- If you have 2 sizes of logo for mobile version and normal use this bellow :) -->
            <!--<a class="navbar-brand d-none d-md-block" href="https://surfcommunity.eu/"><img src="./images/logo_navbar.svg" height="40"></a>-->
            <!--<a class="navbar-brand d-md-none" href="https://surfcommunity.eu/"><img src="./images/logo_navbar_1.svg" height="40"></a>-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SurfStatsNavbar" aria-controls="SurfStatsNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="SurfStatsNavbar">
                <ul class="navbar-nav ms-auto">
                    <?php if($settings_custom_link_name!=''): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $settings_custom_link_adress;?>"><?php echo $settings_custom_link_name;?></a>
                        </li>
                    <?php endif; ?>
                    <?php if($settings_custom_link_2_name!=''): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $settings_custom_link_2_adress;?>"><?php echo $settings_custom_link_2_name;?></a>
                        </li>
                    <?php endif; ?>
                    <?php if($settings_custom_link_3_name!=''): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $settings_custom_link_3_adress;?>"><?php echo $settings_custom_link_3_name;?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if(in_array($page_name, $nav_active_dropdown_dashboard)) echo 'active'; ?>" href="#" id="Dashboard-Nav-Dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-tachometer-alt"></i> <?php echo NAVBAR_DASHBOARD;?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="Dashboard-Na v-Dropdown">
                            <a class="dropdown-item <?php echo nav_active('Home - Dashboard'); ?>" href="index.php"><i class="fas fa-home"></i> <?php echo NAVBAR_HOME;?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?php echo nav_active('Top Players - Dashboard'); ?>" href="dashboard-players.php"><i class="fas fa-users"></i> <?php echo NAVBAR_TOP_PLAYERS;?></a>
                            <a class="dropdown-item <?php echo nav_active('Maps - Dashboard'); ?>" href="dashboard-maps.php"><i class="fas fa-map"></i> <?php echo NAVBAR_MAPS;?></a>
                            <a class="dropdown-item <?php echo nav_active('Most Active - Dashboard'); ?>" href="dashboard-mostactive.php"><i class="fas fa-user-clock"></i> <?php echo NAVBAR_MOST_ACTIVE;?></a>
                            <a class="dropdown-item <?php echo nav_active('Recent Records - Dashboard'); ?>" href="dashboard-recent.php"><i class="fas fa-stopwatch"></i> <?php echo NAVBAR_RECENT_RECORDS;?></a>

                        </div>
                    </li>
                    <?php if($settings_language_enable): ?>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle active bg-white border rounded py-0 my-2 ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="./images/flags/<?php echo LanguageFlag();?>.svg" width="18,5" class="border align-middle"> <?php echo $_SESSION['language'];?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item <?php echo LanguageActive('Czech'); ?>" href="<?php echo LanguageURL('Czech');?>"><img src="./images/flags/cz.svg" width="20" class="border align-middle"> Czech</a></li>
                                <li><a class="dropdown-item <?php echo LanguageActive('English'); ?>" href="<?php echo LanguageURL('English');?>"><img src="./images/flags/gb.svg" width="20" class="border align-middle"> English</a></li>
                                <li><a class="dropdown-item <?php echo LanguageActive('French'); ?>" href="<?php echo LanguageURL('French');?>"><img src="./images/flags/fr.svg" width="20" class="border align-middle"> French</a></li>
                                <li><a class="dropdown-item <?php echo LanguageActive('German'); ?>" href="<?php echo LanguageURL('German');?>"><img src="./images/flags/de.svg" width="20" class="border align-middle"> German</a></li>
                                <li><a class="dropdown-item <?php echo LanguageActive('Portuguese'); ?>" href="<?php echo LanguageURL('Portuguese');?>"><img src="./images/flags/pt.svg" width="20" class="border align-middle"> Portuguese</a></li>
                                <li><a class="dropdown-item <?php echo LanguageActive('Slovak'); ?>" href="<?php echo LanguageURL('Slovak');?>"><img src="./images/flags/sk.svg" width="20" class="border align-middle"> Slovak</a></li>
                            </ul>
                        </div>
                    <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link active bg-white border rounded py-0 my-2 ms-2" href="#" data-bs-toggle="modal" data-bs-target="#SearchPlayers"><i class="fas fa-search"></i> <?php echo NAVBAR_SEARCH_PLAYER;?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class=""></div>

    <div class="container bg-white shadow-lg">
        <div id="page-content">

    <!-- Search Modal -->
    <div class="modal shadow fade" id="SearchPlayers" tabindex="-1" aria-labelledby="SearchPlayersLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header shadow-sm">
                    <h5 class="modal-title" id="SearchPlayersLabel"><i class="fas fa-search"></i> <?php echo SEARCH_SEARCH_PLAYERS;?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="">
                        <input class="form-control form-control-lg shadow-sm" name="players_search" id="players_search" type="search" placeholder="<?php echo SEARCH_INPUT;?>">
                    </form>
                    <div class="" id="players_search_result"></div>
                </div>
                <div class="modal-footer shadow-sm py-2">
                    <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> <?php echo SEARCH_CLOSE;?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Coded & Designed with ❤ by Kristián Partl.  --->
