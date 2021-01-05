<nav class="navbar navbar-expand-lg <?php if($settings_dark_mode) echo "navbar-dark bg-dark"; else echo "navbar-light bg-light"; ?> py-3 shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <?php 
                if($settings_navbar_logo!='')
                    echo '<img src="./images/'.$settings_navbar_logo.'" height="40">';
                else
                    echo $settings_navbar_title;
            ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MainNavBar" aria-controls="MainNavBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="MainNavBar">
            <ul class="navbar-nav ml-auto">
                <?php if($settings_custom_link_name!=''): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $settings_custom_link_adress;?>"><?php echo $settings_custom_link_name;?></a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link <?php echo nav_active('Dashboard'); ?>" href="index.php"><i class="fas fa-tachometer-alt"></i> <?php echo DASHBOARD;?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo nav_active('Top Players'); ?>" href="top-players.php"><i class="fas fa-users"></i> <?php echo TOP_PLAYERS;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo nav_active('Maps'); ?>" href="maps.php"><i class="fas fa-map"></i> <?php echo MAPS;?></a>
                </li>
                <?php if($settings_most_active_enable): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo nav_active('Most Active');?>" href="most-active.php"><i class="fas fa-user-clock"></i> <?php echo MOST_ACTIVE;?></a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <?php if($settings_language_enable): ?>
                <div class="dropdown ml-2">
                    <button class="btn btn-outline-<?php if($settings_dark_mode) echo "light"; else echo 'dark';?> dropdown-toggle" type="button" id="language-picker" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="./images/flags/<?php echo $_SESSION['language'];?>.svg" width="18,5" class="border align-middle"> <?php echo $_SESSION['language'];?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language-picker">
                        <!-- Order Alphabetic Please -->
                        <a class="dropdown-item <?php echo language('Czech'); ?>" href="?language=Czech"><img src="./images/flags/czech.svg" width="20" class="border align-middle"> Czech</a>
                        <a class="dropdown-item <?php echo language('English'); ?>" href="?language=English"><img src="./images/flags/english.svg" width="20" class="border align-middle"> English</a>
                        <a class="dropdown-item <?php echo language('German'); ?>" href="?language=German"><img src="./images/flags/german.svg" width="20" class="border align-middle"> German</a>
                        <a class="dropdown-item <?php echo language('Polish'); ?>" href="?language=Polish"><img src="./images/flags/polish.svg" width="20" class="border align-middle"> Polish</a>
                        <a class="dropdown-item <?php echo language('Slovak'); ?>" href="?language=Slovak"><img src="./images/flags/slovak.svg" width="20" class="border align-middle"> Slovak</a>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div> 
</nav>