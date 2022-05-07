<?php 

    require_once('inc/includes.php');
    require_once('inc/server_list/lgsl_class.php');

    $servergame['csgo'] = 'Counter-Strike: Global Offensive';
    $servergame['ts3'] = 'TeamSpeak';
    $servergame['discord'] = 'Discord';
    
    $server_list = lgsl_query_group();
    $server_list = lgsl_sort_servers($server_list);
    $server_list_total = lgsl_group_totals($server_list);

    if(isset($_POST['LgslShowAllServers']))
        $lgsl_show_all_servers = $_POST['LgslShowAllServers'];
    if(isset($_POST['LgslServerID']))
        $lgsl_server_id = $_POST['LgslServerID'];

?>

<?php if($lgsl_show_all_servers==='0'): ?>

    <div class="table-responsive">
        <table class="table table-borderless table-hover border shadow-sm">
            <thead class="border">
                <tr>
                    <th class="text-center align-middle"></th>
                    <th class="text-left align-middle"><i class="fas fa-server"></i> Server</th>
                    <th class="text-center align-middle"><i class="fas fa-network-wired"></i> Server Adress</th>
                    <th class="text-center align-middle"><i class="fas fa-map"></i> Enviroment</th>
                    <th class="text-center align-middle"><i class="fas fa-user-friends"></i> Users</th>
                    <th class="text-center align-middle"><a class="btn btn-outline-info btn-sm py-1 shadow-sm" role="button" href="dashboard-servers.php"><i class="fas fa-server"></i> More Servers</a></th>
                </tr>
            </thead>
            <tbody class="">
                <?php 
                    foreach ($server_list as $server):
                        $misc   = lgsl_server_misc($server);
                        $server = lgsl_server_html($server);
                        $ServerIP = $server['b']['ip'].':'.$server['b']['c_port'];

                        if(($ServerIP==='ja9FSPTzam:1')||($ServerIP==='kiepownica.pl:9987')||($ServerIP==='kiepownica.com:27015')||($ServerIP==='kiepownica.com:27016')||($ServerIP==='kiepownica.com:27017')):
                ?>
                    <tr>
                        <td class="text-center align-middle"><span class="server-list-status <?php echo $misc['icon_status_webkp']; ?> rounded shadow-sm" title="<?php echo $misc['text_status']; ?>"><img height="24" class="shadow rounded" src="<?php echo $misc['icon_game'];?>"></span></td>
                        <td class="text-left align-middle"><?php echo $server['s']['name']; ?></td>
                        <td class="text-center align-middle"><?php if($ServerIP==='ja9FSPTzam:1') echo 'discord.surfcommunity.eu'; else echo $ServerIP; ?></td>
                        <td class="text-center align-middle">
                            <?php 
                                if($server['s']['map']==='teamspeak') echo '<small class="text-muted">TeamSpeak</small>'; 
                                elseif($server['s']['game']==='csgo') echo '<small class="">'.$server['s']['map'].'</small>'; 
                                elseif($server['s']['game']==='discord') echo '<small class="text-muted">Discord</small>'; 
                            ?>
                        </td>
                        <td class="text-center align-middle">
                            <?php echo $server['s']['players']."/".$server['s']['playersmax']; ?>
                            <br>
                            <div class="progress shadow-sm" style="height: 4px; width: 50%; margin: auto;" title='<?php echo number_format(($server['s']['players']/$server['s']['playersmax'])*100); ?>%'>
                                <?php
                                    if($server['s']['players']>=($server['s']['playersmax']-1))
                                        $server_players_bar_color = 'bg-danger';
                                    elseif(($server['s']['players']>=($server['s']['playersmax']/'1.4')))
                                        $server_players_bar_color = 'bg-warning';
                                    elseif(($server['s']['players']>=($server['s']['playersmax']/2)))
                                        $server_players_bar_color = 'bg-primary';
                                    elseif(($server['s']['players']>=($server['s']['playersmax']/4)))
                                        $server_players_bar_color = 'bg-info';
                                    else
                                        $server_players_bar_color = 'bg-secondary';
                                ?>
                                <div class="progress-bar progress-bar-striped <?php echo $server_players_bar_color; ?> rounded" role="progressbar" style="width: <?php echo ($server['s']['players']/$server['s']['playersmax'])*100; ?>%;" aria-valuenow="<?php echo $server['s']['players']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $server['s']['playersmax']; ?>"></div>
                            </div>
                        </td>
                        <td class="text-center align-middle">
                                <a class="btn btn-outline-info btn-sm py-1 px-2 mx-1 my-1 shadow-sm" role="button" href="dashboard-servers.php?sid=<?php echo $server['o']['id'];?>"><i class="fas fa-angle-double-right"></i> Info</a>
                                <a class="btn btn-outline-dark btn-sm py-1 shadow-sm my-1" role="button" href="
                                    <?php 
                                        if($server['s']['game']==='ts3') echo 'ts3server://'.$server['b']['ip'].'?port='.$server['b']['c_port']; 
                                        elseif($server['s']['game']==='csgo') echo 'steam://connect/'.$ServerIP; 
                                        elseif($server['s']['game']==='discord') echo 'https://discord.gg/'.$server['b']['ip'];
                                    ?>
                                ">
                                <?php 
                                    if($server['s']['map']==='teamspeak') echo '<i class="fab fa-teamspeak"></i>'; 
                                    elseif($server['s']['game']==='csgo') echo '<i class="fab fa-steam"></i>'; 
                                    elseif($server['s']['game']==='discord') echo '<i class="fab fa-discord"></i>'; 
                                ?>
                                Connect</a>
                            </td>
                    </tr>
                <?php endif; endforeach; ?>
            </tbody>
        </table>
    </div>

<?php else: ?>
    <?php if($lgsl_server_id==='0'): ?>
        <?php $lgsl_total = lgsl_group_totals($server_list); ?>
        <div class="text-center border shadow-sm mt-4 py-2">
            <div class="row">
                <div class="col-12 col-md">
                    <strong><i class="fas fa-server"></i> Total Servers:</strong> <?php echo $lgsl_total['servers']; ?>
                </div>
                <div class="col-12 col-md">
                    <strong><i class="fas fa-user-friends"></i> Online Users:</strong> <?php echo $lgsl_total['players']; ?>
                </div>
                <div class="col-12 col-md">
                    <strong><i class="fas fa-users"></i> Max Users:</strong> <?php echo $lgsl_total['playersmax']; ?>
                </div>
                <div class="col-12 col-md">
                    <strong><i class="fas fa-user-friends"></i> Record Users:</strong> <?php echo online_users_peak(); ?>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-4 mb-0">
            <table class="table table-borderless table-hover border shadow-sm">
                <thead class="border">
                    <tr>
                        <th class="text-center align-middle"></th>
                        <th class="text-left align-middle"><i class="fas fa-server"></i> Server</th>
                        <th class="text-center align-middle"><i class="fas fa-network-wired"></i> Server Adress</th>
                        <th class="text-center align-middle"><i class="fas fa-map"></i> Enviroment</th>
                        <th class="text-center align-middle"><i class="fas fa-user-friends"></i> Users</th>
                        <th class="text-center align-middle"></th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php 
                        foreach ($server_list as $server):
                            $misc   = lgsl_server_misc($server);
                            $server = lgsl_server_html($server);
                            $ServerIP = $server['b']['ip'].':'.$server['b']['c_port'];
                    ?>
                        <tr>
                            <td class="text-center align-middle"><span class="server-list-status <?php echo $misc['icon_status_webkp']; ?> rounded shadow-sm" title="<?php echo $misc['text_status']; ?>"><img height="24" class="shadow rounded" src="<?php echo $misc['icon_game'];?>"></span></td>
                            <td class="text-left align-middle py-3"><?php echo $server['s']['name']; ?></td>
                            <td class="text-center align-middle"><?php if($ServerIP==='ja9FSPTzam:1') echo 'discord.surfcommunity.eu'; else echo $ServerIP; ?></td>
                            <td class="text-center align-middle">
                                <?php 
                                    if($server['s']['map']==='teamspeak') echo '<small class="text-muted">TeamSpeak</small>'; 
                                    elseif($server['s']['game']==='csgo') echo '<small class="">'.$server['s']['map'].'</small>'; 
                                    elseif($server['s']['game']==='discord') echo '<small class="text-muted">Discord</small>'; 
                                ?>
                            </td>
                            <td class="text-center align-middle">
                                <?php echo $server['s']['players']."/".$server['s']['playersmax']; ?>
                                <br>
                                <div class="progress shadow-sm" style="height: 4px; width: 50%; margin: auto;" title='<?php echo number_format(($server['s']['players']/$server['s']['playersmax'])*100); ?>%'>
                                    <?php
                                        if($server['s']['players']>=($server['s']['playersmax']-1))
                                            $server_players_bar_color = 'bg-danger';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/'1.4')))
                                            $server_players_bar_color = 'bg-warning';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/2)))
                                            $server_players_bar_color = 'bg-primary';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/4)))
                                            $server_players_bar_color = 'bg-info';
                                        else
                                            $server_players_bar_color = 'bg-secondary';
                                    ?>
                                    <div class="progress-bar progress-bar-striped <?php echo $server_players_bar_color; ?> rounded" role="progressbar" style="width: <?php echo ($server['s']['players']/$server['s']['playersmax'])*100; ?>%;" aria-valuenow="<?php echo $server['s']['players']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $server['s']['playersmax']; ?>"></div>
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <a class="btn btn-outline-info btn-sm py-1 px-2 mx-1 my-1 shadow-sm" role="button" href="dashboard-servers.php?sid=<?php echo $server['o']['id'];?>"><i class="fas fa-angle-double-right"></i> Info</a>
                                <a class="btn btn-outline-dark btn-sm py-1 shadow-sm my-1" role="button" href="
                                    <?php 
                                        if($server['s']['game']==='ts3') echo 'ts3server://'.$server['b']['ip'].'?port='.$server['b']['c_port']; 
                                        elseif($server['s']['game']==='csgo') echo 'steam://connect/'.$ServerIP; 
                                        elseif($server['s']['game']==='discord') echo 'https://discord.gg/'.$server['b']['ip'];
                                    ?>
                                ">
                                <?php 
                                    if($server['s']['map']==='teamspeak') echo '<i class="fab fa-teamspeak"></i>'; 
                                    elseif($server['s']['game']==='csgo') echo '<i class="fab fa-steam"></i>'; 
                                    elseif($server['s']['game']==='discord') echo '<i class="fab fa-discord"></i>'; 
                                ?>
                                Connect</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="pt-4 mt-4 border shadow-sm" style="height: 450px;">
            <div id="chartContainer"></div>

            <?php
                $dataPoints = array();
                //Best practice is to create a separate file for handling connection to database
                try{
                    // Creating a new connection.
                    // Replace your-hostname, your-db, your-username, your-password according to your database
                    $link = new \PDO(   'mysql:host='.$db_host.';dbname='.$db_database_web.';charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                                        $db_username, //'root',
                                        $db_password, //'',
                                        array(
                                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                            \PDO::ATTR_PERSISTENT => false
                                        )
                                    );
                
                    $handle = $link->prepare('SELECT * FROM `web_lgsl_total_history` WHERE time >= now() - interval 7 day'); 
                    $handle->execute(); 
                    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
                    
                    foreach($result as $row){
                        $row_x = strtotime($row->time)*1000;
                        array_push($dataPoints, array("x"=> $row_x, "y"=> $row->online_users));
                    }
                $link = null;
                }
                catch(\PDOException $ex){
                    print($ex->getMessage());
                }
            ?>

            <script type="text/javascript">

                $(function () {
                    var chart = new CanvasJS.Chart("chartContainer", {
                        title: {
                            text: "Online Users past 7 Days"
                        },
                        zoomEnabled: true,
                        exportEnabled: true,
                        axisY: {
                            title: "Online Users",
                            valueFormatString: "",
                            suffix: ""
                        },
                        data: [
                        {
                            toolTipContent: "{y} Users Online",
                            type: "stepArea",
                            markerSize: 5,
                            color: "rgba(0, 130, 255, 1)",
                                        xValueType: "dateTime",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }
                        ]
                    });

                    chart.render();
                });
            </script>
        </div>

    <?php else: ?>

        <?php
            $fields_show  = array("name", "time", "pid", "ping", "bot"); // ORDERED FIRST
            $fields_hide  = array("teamindex", "pbguid", "score", "kills", "deaths", "team"); // REMOVED
            $fields_other = TRUE; // FALSE TO ONLY SHOW FIELDS IN $fields_showv

            $server = lgsl_query_cached("", "", "", "", "", "sep", $lgsl_server_id);
        ?>
        
        <?php if(!$server): ?>
            <h4 class="text-center mt-5"><i class="fas fa-exclamation-circle"></i> Error: Invalid Server ID</h4>
            <p class="text-center text-muted">Make sure you opened correct server.</p>
        <?php else: ?>
            <?php
                $fields = lgsl_sort_fields($server, $fields_show, $fields_hide, $fields_other);
                $server = lgsl_sort_players($server);
                $server = lgsl_sort_extras($server);
                $misc   = lgsl_server_misc($server);
                $server = lgsl_server_html($server);
            ?>

            <?php if($server['s']['game']==='csgo'): ?>
                
                <?php $lgsl_total = lgsl_group_totals($server_list); ?>
                <div class="text-center border shadow-sm mt-4 mb-2 py-2">
                    <div class="row">
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-server"></i> Total Servers:</strong> <?php echo $lgsl_total['servers']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-user-friends"></i> Online Users:</strong> <?php echo $lgsl_total['players']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-users"></i> Max Users:</strong> <?php echo $lgsl_total['playersmax']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-user-friends"></i> Record Users:</strong> <?php echo online_users_peak(); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <h4 class="my-3 mx-3">
                            <i class="fas fa-server"></i>
                            <?php echo $server['s']['name'];?>
                        </h4>
                    </div>
                    <div class="col-12 col-md-4 text-right">
                        <a role="button" class="btn btn-outline-info shadow-sm my-3 py-1 mx-3" href="dashboard-servers.php">
                            <i class="fas fa-undo"></i> Back to Serverlist
                        </a>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-12 col-md-8">
                        <?php if(empty($server['p'])): ?>
                            
                            <h6 class="border shadow-sm px-3 py-2"><i class="fas fa-info-circle"></i> Server is Empty.</h6>
                        
                        <?php elseif(!is_array($server['p'])): ?>

                            <h6 class="border shadow-sm px-3 py-2"><i class="fas fa-info-circle"></i> Error in getting data. <small>Refreshing in 30 seconds.</small></h6>

                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless border shadow-sm">
                                    <thead class="border">
                                        <tr>
                                            <th class="text-left pl-3 align-middle"><i class="fas fa-user"></i> Username</th>
                                            <th class="text-center align-middle"><i class="fas fa-stopwatch"></i> Connection Time</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php 
                                            $server_p_row = 0; foreach ($server['p'] as $player_key => $player):
                                                $player_name = $player['name'];
                                                if($server['s']['map']!=='teamspeak')
                                                    $player_time = $player['time'];

                                                if($player_name === 'GOTV')
                                                    $player_gotv_time = $player_time;
                                                else
                                                    $player_gotv_time = FALSE;
                                                
                                                if($player_name === '')
                                                    $player_name = '<small class="text-muted">Unknown Username</small>';
                                        ?>
                                            <?php //if(($player_name!=="GOTV")&&((!stripos($player_name, '('))&&(!str_ends_with($player_name, ')')))&&($player_time >= '')): ?>
                                            <tr class=" <?php if(++$server_p_row!==1) echo 'border-top border-light';?>">
                                                <td class="text-left pl-3 align-middle py-0"><?php echo $player_name; ?></td>
                                                <td class="text-center align-middle  py-0"><?php echo $player_time; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>                                   
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-4">
                        <ul class="list-group list-group-flush text-center shadow-sm">
                            <li class="list-group-item border">
                                <h5 class='my-0'>
                                    <img height="28" class="shadow rounded-circle border" src="<?php echo $misc['icon_game'];?>" title="<?php echo $servergame[$server['s']['game']];?>">
                                    <span class="align-middle"><?php echo $servergame[$server['s']['game']];?></span>
                                </h5>
                            </li>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-info-circle"></i> Status</strong>
                                <br>
                                <?php echo $misc['text_badge_status']; ?>
                            </li>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-network-wired"></i> Server Adress</strong>
                                <br>
                                <div class="form-row mx-3">
                                    <div class="col">
                                        <input class="form-control form-control-sm text-center shadow-sm mt-2" type="text" value="<?php echo $server['b']['ip'].':'.$server['b']['c_port']; ?>" readonly>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-outline-dark btn-sm mt-2 py-1 px-3 shadow-sm" title="Connect to server" href="steam://connect/<?php echo $server['b']['ip'].':'.$server['b']['c_port']; ?>"><i class="fab fa-steam"></i> Connect</a>
                                    </div>
                                </div>
                            </li>
                            <?php if($server['s']['map']!=='teamspeak'): ?>
                                <li class="list-group-item border">
                                    <strong><i class="fas fa-map"></i> Map</strong>
                                    <br>
                                    <?php echo $server['s']['map']; ?>
                                </li>
                            <?php endif; ?>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-user-friends"></i> Players</strong>
                                <br>
                                <?php echo $server['s']['players']."/".$server['s']['playersmax']; ?>
                                <br>
                                <div class="progress shadow-sm mt-1" style="height: 6px; width: 40%; margin: auto;" title='<?php echo number_format(($server['s']['players']/$server['s']['playersmax'])*100); ?>%'>
                                    <?php
                                        if($server['s']['players']>=($server['s']['playersmax']-1))
                                            $server_players_bar_color = 'bg-danger';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/'1.4')))
                                            $server_players_bar_color = 'bg-warning';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/2)))
                                            $server_players_bar_color = 'bg-primary';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/4)))
                                            $server_players_bar_color = 'bg-info';
                                        else
                                            $server_players_bar_color = 'bg-secondary';
                                    ?>
                                    <div class="progress-bar progress-bar-striped <?php echo $server_players_bar_color; ?> rounded" role="progressbar" style="width: <?php echo ($server['s']['players']/$server['s']['playersmax'])*100; ?>%;" aria-valuenow="<?php echo $server['s']['players']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $server['s']['playersmax']; ?>"></div>
                                </div>
                            </li>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-code-branch"></i> Server Version:</strong>
                                <br>
                                <?php echo $server['e']['version'];?>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="pt-4 mt-4 border shadow-sm" style="height: 450px;">
                        <div id="chartContainer"></div>

                        <?php
                            $dataPoints = array();
                            $charServerID = $server['o']['id'];
                            //Best practice is to create a separate file for handling connection to database
                            try{
                                // Creating a new connection.
                                // Replace your-hostname, your-db, your-username, your-password according to your database
                                $link = new \PDO(   'mysql:host='.$db_host.';dbname='.$db_database_web.';charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                                                    $db_username, //'root',
                                                    $db_password, //'',
                                                    array(
                                                        \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                        \PDO::ATTR_PERSISTENT => false
                                                    )
                                                );
                            
                                $handle = $link->prepare('SELECT * FROM `web_lgsl_servers_history` WHERE sid='.$charServerID.' AND time >= now() - interval 7 day'); 
                                $handle->execute(); 
                                $result = $handle->fetchAll(\PDO::FETCH_OBJ);
                                
                                foreach($result as $row){
                                    $row_x = strtotime($row->time)*1000;
                                    array_push($dataPoints, array("x"=> $row_x, "y"=> $row->online_users));
                                }
                            $link = null;
                            }
                            catch(\PDOException $ex){
                                print($ex->getMessage());
                            }
                        ?>

                        <script type="text/javascript">

                            $(function () {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    title: {
                                        text: "Online Users past 7 Days",
                                    },
                                    subtitles: [{
                                        text: "<?php echo $servergame[$server['s']['game']];?>",
                                    }],
                                    zoomEnabled: true,
                                    exportEnabled: true,
                                    axisY: {
                                        title: "Online Users",
                                        valueFormatString: "",
                                        suffix: ""
                                    },
                                    data: [
                                    {
                                        toolTipContent: "{y} Users Online",
                                        type: "stepArea",
                                        markerSize: 5,
                                        color: "rgba(0, 130, 255, 1)",
                                                    xValueType: "dateTime",
                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                    }
                                    ]
                                });

                                chart.render();
                            });
                        </script>
                    </div>

            <?php elseif($server['s']['game']==='ts3'): ?>

                <?php $lgsl_total = lgsl_group_totals($server_list); ?>
                <div class="text-center border shadow-sm mt-4 mb-2 py-2">
                    <div class="row">
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-server"></i> Total Servers:</strong> <?php echo $lgsl_total['servers']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-user-friends"></i> Online Users:</strong> <?php echo $lgsl_total['players']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-users"></i> Max Users:</strong> <?php echo $lgsl_total['playersmax']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-user-friends"></i> Record Users:</strong> <?php echo online_users_peak(); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <h4 class="my-3 mx-3">
                            <i class="fas fa-server"></i>
                            <?php echo $server['s']['name'];?>
                        </h4>
                    </div>
                    <div class="col-12 col-md-4 text-right">
                        <a role="button" class="btn btn-outline-info shadow-sm my-3 py-1 mx-3" href="dashboard-servers.php">
                            <i class="fas fa-undo"></i> Back to Serverlist
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <?php if(empty($server['p'])): ?>
                            
                            <h6 class="border shadow-sm px-3 py-2"><i class="fas fa-info-circle"></i> Server is Empty.</h6>
                        
                        <?php elseif(!is_array($server['p'])): ?>

                            <h6 class="border shadow-sm px-3 py-2"><i class="fas fa-info-circle"></i> Error in getting data. <small>Refreshing in 30 seconds.</small></h6>

                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless border shadow-sm">
                                    <thead class="border">
                                        <tr>
                                            <th class="text-left pl-3 align-middle"><i class="fas fa-user"></i> Username</th>
                                            <th class="text-center align-middle"><i class="fas fa-map-marked-alt"></i> Location</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php 
                                            $server_p_row = 0; foreach ($server['p'] as $player_key => $player):
                                                $player_name        = $player['name'];
                                                $player_location    = $player['country'];

                                                if($player_name === 'GOTV')
                                                    $player_gotv_time = $player_time;
                                                else
                                                    $player_gotv_time = FALSE;
                                                
                                                if($player_location === '')
                                                    $player_name = '<small class="text-muted">'.$player_name.'</small>';
                                        ?>
                                            <?php //if(($player_name!=="GOTV")&&((!stripos($player_name, '('))&&(!str_ends_with($player_name, ')')))&&($player_time >= '')): ?>
                                            <tr class=" <?php if(++$server_p_row!==1) echo 'border-top border-light';?>">
                                                <td class="text-left pl-3 align-middle py-0"><?php echo $player_name; ?></td>
                                                <td class="text-center align-middle  py-0"><?php echo $player_location; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>                                   
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-4">
                        <ul class="list-group list-group-flush text-center shadow-sm">
                            <li class="list-group-item border">
                                <h5 class='my-0'>
                                    <img height="28" class="shadow rounded-circle border" src="<?php echo $misc['icon_game'];?>" title="<?php echo $servergame[$server['s']['game']];?>">
                                    <span class="align-middle"><?php echo $servergame[$server['s']['game']];?></span>
                                </h5>
                            </li>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-info-circle"></i> Status</strong>
                                <br>
                                <?php echo $misc['text_badge_status']; ?>
                            </li>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-network-wired"></i> Server Adress</strong>
                                <br>
                                <div class="form-row mx-3">
                                    <div class="col">
                                        <input class="form-control form-control-sm text-center shadow-sm mt-2" type="text" value="<?php echo $server['b']['ip'].':'.$server['b']['c_port']; ?>" readonly>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-outline-dark btn-sm mt-2 py-1 px-3 shadow-sm" title="Connect to server" href="<?php echo 'ts3server://'.$server['b']['ip'].'?port='.$server['b']['c_port']; ?>"><i class="fab fa-teamspeak"></i> Connect</a>
                                    </div>
                                </div>
                            </li>
                            <?php if($server['s']['map']!=='teamspeak'): ?>
                                <li class="list-group-item border">
                                    <strong><i class="fas fa-map"></i> Map</strong>
                                    <br>
                                    <?php echo $server['s']['map']; ?>
                                </li>
                            <?php endif; ?>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-user-friends"></i> Users</strong>
                                <br>
                                <?php echo $server['s']['players']."/".$server['s']['playersmax']; ?>
                                <br>
                                <div class="progress shadow-sm mt-1" style="height: 6px; width: 40%; margin: auto;" title='<?php echo number_format(($server['s']['players']/$server['s']['playersmax'])*100); ?>%'>
                                    <?php
                                        if($server['s']['players']>=($server['s']['playersmax']-1))
                                            $server_players_bar_color = 'bg-danger';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/'1.4')))
                                            $server_players_bar_color = 'bg-warning';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/2)))
                                            $server_players_bar_color = 'bg-primary';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/4)))
                                            $server_players_bar_color = 'bg-info';
                                        else
                                            $server_players_bar_color = 'bg-secondary';
                                    ?>
                                    <div class="progress-bar progress-bar-striped <?php echo $server_players_bar_color; ?> rounded" role="progressbar" style="width: <?php echo ($server['s']['players']/$server['s']['playersmax'])*100; ?>%;" aria-valuenow="<?php echo $server['s']['players']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $server['s']['playersmax']; ?>"></div>
                                </div>
                            </li>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-info-circle"></i> Server Uptime:</strong>
                                <br>
                                <?php echo $server['e']['uptime'];?>
                            </li>
                            <li class="list-group-item border">
                                <strong><i class="fas fa-code-branch"></i> Server Version:</strong>
                                <br>
                                <?php echo $server['e']['version'];?>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="pt-4 mt-4 border shadow-sm" style="height: 450px;">
                        <div id="chartContainer"></div>

                        <?php
                            $dataPoints = array();
                            $charServerID = $server['o']['id'];
                            //Best practice is to create a separate file for handling connection to database
                            try{
                                // Creating a new connection.
                                // Replace your-hostname, your-db, your-username, your-password according to your database
                                $link = new \PDO(   'mysql:host='.$db_host.';dbname='.$db_database_web.';charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                                                    $db_username, //'root',
                                                    $db_password, //'',
                                                    array(
                                                        \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                        \PDO::ATTR_PERSISTENT => false
                                                    )
                                                );
                            
                                $handle = $link->prepare('SELECT * FROM `web_lgsl_servers_history` WHERE sid='.$charServerID.' AND time >= now() - interval 7 day'); 
                                $handle->execute(); 
                                $result = $handle->fetchAll(\PDO::FETCH_OBJ);
                                
                                foreach($result as $row){
                                    $row_x = strtotime($row->time)*1000;
                                    array_push($dataPoints, array("x"=> $row_x, "y"=> $row->online_users));
                                }
                            $link = null;
                            }
                            catch(\PDOException $ex){
                                print($ex->getMessage());
                            }
                        ?>

                        <script type="text/javascript">

                            $(function () {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    title: {
                                        text: "Online Users past 7 Days",
                                    },
                                    subtitles: [{
                                        text: "<?php echo $servergame[$server['s']['game']];?>",
                                    }],
                                    zoomEnabled: true,
                                    exportEnabled: true,
                                    axisY: {
                                        title: "Online Users",
                                        valueFormatString: "",
                                        suffix: ""
                                    },
                                    data: [
                                    {
                                        toolTipContent: "{y} Users Online",
                                        type: "stepArea",
                                        markerSize: 5,
                                        color: "rgba(0, 130, 255, 1)",
                                                    xValueType: "dateTime",
                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                    }
                                    ]
                                });

                                chart.render();
                            });
                        </script>
                    </div>

            <?php elseif($server['s']['game']==='discord'): ?>
                <?php $lgsl_total = lgsl_group_totals($server_list); ?>
                <div class="text-center border shadow-sm mt-4 mb-2 py-2">
                    <div class="row">
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-server"></i> Total Servers:</strong> <?php echo $lgsl_total['servers']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-user-friends"></i> Online Users:</strong> <?php echo $lgsl_total['players']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-users"></i> Max Users:</strong> <?php echo $lgsl_total['playersmax']; ?>
                        </div>
                        <div class="col-12 col-md">
                            <strong><i class="fas fa-user-friends"></i> Record Users:</strong> <?php echo online_users_peak(); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <h4 class="my-3 mx-3">
                            <i class="fas fa-server"></i>
                            <?php echo $server['s']['name'];?>
                        </h4>
                    </div>
                    <div class="col-12 col-md-4 text-right">
                        <a role="button" class="btn btn-outline-info shadow-sm my-3 py-1 mx-3" href="dashboard-servers.php">
                            <i class="fas fa-undo"></i> Back to Serverlist
                        </a>
                    </div>
                </div>

                <div class="col-12 text-center shadow-sm">
                        <div class="row border">
                            <div class="col-6 py-3 border-bottom border-right">
                                <h3 class='my-0 align-middle'>
                                    <img height="32" class="shadow rounded-circle border" src="<?php echo $misc['icon_game'];?>" title="<?php echo $servergame[$server['s']['game']];?>">
                                    <span class="align-middle"><?php echo $servergame[$server['s']['game']];?></span>
                                </h3>
                            </div>

                            <div class="col-6 py-3 border-bottom">
                                <strong><i class="fas fa-info-circle"></i> Status</strong>
                                <br>
                                <?php echo $misc['text_badge_status']; ?>
                            </div>

                            <div class="col-6 py-3 border-right">
                                <strong><i class="fas fa-network-wired"></i> Server Invite</strong>
                                <br>
                                <div class="form-row mx-3">
                                    <div class="col">
                                        <input class="form-control form-control-sm text-center shadow-sm mt-2" type="text" value="discord.surfcommunity.eu" readonly>
                                    </div>
                                    <div class="col-auto">
                                        <a class="btn btn-outline-dark btn-sm mt-2 py-1 px-3 shadow-sm" title="Connect to server" href="<?php echo 'https://discord.gg/'.$server['b']['ip'];?>"><i class="fab fa-discord"></i> Connect</a>
                                    </div>
                                </div>
                            </div>                           

                            <div class="col-6 py-3">
                                <strong><i class="fas fa-user-friends"></i> Users</strong>
                                <br>
                                <?php echo $server['s']['players']."/".$server['s']['playersmax']; ?>
                                <br>
                                <div class="progress shadow-sm mt-1" style="height: 6px; width: 40%; margin: auto;" title='<?php echo number_format(($server['s']['players']/$server['s']['playersmax'])*100); ?>%'>
                                    <?php
                                        if($server['s']['players']>=($server['s']['playersmax']-1))
                                            $server_players_bar_color = 'bg-danger';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/'1.4')))
                                            $server_players_bar_color = 'bg-warning';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/2)))
                                            $server_players_bar_color = 'bg-primary';
                                        elseif(($server['s']['players']>=($server['s']['playersmax']/4)))
                                            $server_players_bar_color = 'bg-info';
                                        else
                                            $server_players_bar_color = 'bg-secondary';
                                    ?>
                                    <div class="progress-bar progress-bar-striped <?php echo $server_players_bar_color; ?> rounded" role="progressbar" style="width: <?php echo ($server['s']['players']/$server['s']['playersmax'])*100; ?>%;" aria-valuenow="<?php echo $server['s']['players']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $server['s']['playersmax']; ?>"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                
                    <div class="pt-4 mt-4 border shadow-sm" style="height: 450px;">
                        <div id="chartContainer"></div>

                        <?php
                            $dataPoints = array();
                            $charServerID = $server['o']['id'];
                            //Best practice is to create a separate file for handling connection to database
                            try{
                                // Creating a new connection.
                                // Replace your-hostname, your-db, your-username, your-password according to your database
                                $link = new \PDO(   'mysql:host='.$db_host.';dbname='.$db_database_web.';charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                                                    $db_username, //'root',
                                                    $db_password, //'',
                                                    array(
                                                        \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                        \PDO::ATTR_PERSISTENT => false
                                                    )
                                                );
                            
                                $handle = $link->prepare('SELECT * FROM `web_lgsl_servers_history` WHERE sid='.$charServerID.' AND time >= now() - interval 7 day'); 
                                $handle->execute(); 
                                $result = $handle->fetchAll(\PDO::FETCH_OBJ);
                                
                                foreach($result as $row){
                                    $row_x = strtotime($row->time)*1000;
                                    array_push($dataPoints, array("x"=> $row_x, "y"=> $row->online_users));
                                }
                            $link = null;
                            }
                            catch(\PDOException $ex){
                                print($ex->getMessage());
                            }
                        ?>

                        <script type="text/javascript">

                            $(function () {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    title: {
                                        text: "Online Users past 7 Days",
                                    },
                                    subtitles: [{
                                        text: "<?php echo $servergame[$server['s']['game']];;?>",
                                    }],
                                    zoomEnabled: true,
                                    exportEnabled: true,
                                    axisY: {
                                        title: "Online Users",
                                        valueFormatString: "",
                                        suffix: ""
                                    },
                                    data: [
                                    {
                                        toolTipContent: "{y} Users Online",
                                        type: "stepArea",
                                        markerSize: 5,
                                        color: "rgba(0, 130, 255, 1)",
                                                    xValueType: "dateTime",
                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                    }
                                    ]
                                });

                                chart.render();
                            });
                        </script>
                    </div>

            <?php endif; ?>
        
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
