<?php

    require_once('./../config.php');
    require_once('./../database.php');
    require_once('./../functions.php');

    $sql_most_active = "SELECT ck_playerrank.*, ck_playerrank.timealive+ck_playerrank.timespec as totaltime FROM ck_playerrank WHERE style='0' AND ck_playerrank.timealive+ck_playerrank.timespec>='3600' ORDER BY totaltime DESC";
    $results_most_active = mysqli_query($db_conn_surftimer, $sql_most_active);
    $most_actives = array();
    if(mysqli_num_rows($results_most_active) > 0){
        while($row_most_active = mysqli_fetch_assoc($results_most_active))
            $most_actives[] = $row_most_active;
    };
?>

    <script>
        $('#most-active').DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            responsive: true,
            "processing": true,
            "order": [[ 1, "desc" ]],
            "columnDefs": [
                { "className": "text-left align-middle pl-3", "targets": [ 0 ] },
                { "className": "text-center align-middle", "targets": [ 1 ] },
                { "className": "text-center align-middle", "targets": [ 2 ] },
                { "className": "text-center align-middle", "targets": [ 3 ] },
                { "className": "text-center align-middle", "targets": [ 4 ] }
            ],
            "data": [
                <?php $most_active_row = 0; foreach($most_actives as $most_active): ?>
                    <?php
                        $most_active_lastseen = new DateTime();
                        $most_active_lastseen->setTimestamp($most_active['lastseen']);
                        $most_active_lastseen = $most_active_lastseen->format('Y/m/d (H:i)');

                        $most_active_joined = new DateTime();
                        $most_active_joined->setTimestamp($most_active['joined']);
                        $most_active_joined = $most_active_joined->format('Y/m/d');

                        $most_active_date_today = date('Y/m/d');
                        $most_active_date_today_c = date_create($most_active_date_today);

                        /////////////////////////////////////////////////////////////////////////
                        
                        $most_active_lastseen_date = new DateTime();
                        $most_active_lastseen_date->setTimestamp($most_active['lastseen']);
                        $most_active_lastseen_date = $most_active_lastseen_date->format('Y/m/d');
                        $most_active_lastseen_date_c = date_create($most_active_lastseen_date);
                        
                        $most_active_lastseen_diff = date_diff($most_active_date_today_c, $most_active_lastseen_date_c);
                        $most_active_lastseen_diff = $most_active_lastseen_diff->format("%a");
                        
                        if($most_active_date_today == $most_active_lastseen_date||$most_active_lastseen_diff==0)
                            $most_active_lastseen_date_d = "Today";
                        elseif($most_active_lastseen_diff==1)
                            $most_active_lastseen_date_d = "Yesterday";
                        else
                            $most_active_lastseen_date_d = $most_active_lastseen_diff." days ago";
                        
                        //////////////////////////////////////////////////////////////////////////
                        
                        $most_active_joined_date = new DateTime();
                        $most_active_joined_date->setTimestamp($most_active['joined']);
                        $most_active_joined_date = $most_active_joined_date->format('Y/m/d');
                        $most_active_joined_date_c = date_create($most_active_joined_date);

                        $most_active_joined_diff = date_diff($most_active_date_today_c, $most_active_joined_date_c);
                        $most_active_joined_diff = $most_active_joined_diff->format("%a");

                        if($most_active_date_today == $most_active_joined_date||$most_active_joined_diff==0)
                            $most_active_joined_date_d = "Today";
                        elseif($most_active_joined_diff==1)
                            $most_active_joined_date_d = "Yesterday";
                        else
                            $most_active_joined_date_d = $most_active_joined_diff." days ago";
                        
                    ?>
                    [
                        '<?php if($config_player_flags) echo CountryFlag($most_active['country'], $most_active['countryCode'], $most_active['continentCode']); ?> <?php echo $most_active["name"]; ?> <a href="dashboard-player.php?id=<?php echo $most_active['steamid64']; ?>" target="" title="<?php echo $most_active['name']; ?> - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/<?php echo $most_active['steamid64']; ?>" target="_blank" title="<?php echo $most_active['name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a>',
                        '<?php echo  number_format(($most_active["totaltime"]/60)/60, 1); ?>',
                        '<?php echo number_format($most_active["connections"]); ?>',
                        '<small><?php echo $most_active_lastseen; ?></small><br><?php echo $most_active_lastseen_date_d; ?>',
                        '<small><?php echo $most_active_joined; ?></small><br><?php echo $most_active_joined_date_d; ?>'
                    ],
                <?php endforeach; ?>
            ]
        });
    </script>

    <div class="table-responsive">
        <table class="table table-hover border shadow-sm py-0 my-2 nowrap" style="width:100%" id="most-active">
            <thead class="border">
                <th class="text-left pl-3">Username</th>
                <th class="text-center">Hours</th>
                <th class="text-center">Connections</th>
                <th class="text-center">Last Seen</th>
                <th class="text-center">Joined</th>
            </thead>
            <tbody class="">

            </tbody>
        </table>
    </div>
    