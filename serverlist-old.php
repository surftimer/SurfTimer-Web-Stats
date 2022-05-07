<?php 

    require_once('inc/includes.php');
    require_once('inc/server_list/lgsl_class.php');

    $servergame['csgo'] = 'CS:GO';
    $servergame['garrysmod'] = 'Garrys Mod';
    $servergame['source'] = 'Source Engine';
    $servergame['tf'] = 'Team Fortress 2';
    $servergame['cstrike'] = 'CS 1.6';

    $server_list = lgsl_query_group();
    $server_list = lgsl_sort_servers($server_list);
    $server_list_total = lgsl_group_totals($server_list);

    if(isset($_POST['LgslShowServers'])) {
        $lgsl_show_servers = $_POST['LgslShowServers'];
    } elseif(empty($lgsl_show_servers))
        $lgsl_show_servers = 0;

?>

<?php
    if($lgsl_show_servers==1):
        
        $fields_show  = array("name", "time", "pid", "ping", "bot"); // ORDERED FIRST
        $fields_hide  = array("teamindex", "pbguid", "score", "kills", "deaths", "team"); // REMOVED
        $fields_other = TRUE; // FALSE TO ONLY SHOW FIELDS IN $fields_showv
?>
    <div class="my-0">
        <?php $serverlist_row = 1; ; foreach($server_list as $server):?>
            <?php $server = lgsl_query_cached($server['b']['type'], $server['b']['ip'], $server['b']['c_port'], $server['b']['q_port'], $server['b']['s_port'], "sep", ); ?>
            <div class="my-0">
                <?php if($serverlist_row!==1) echo'<hr class="mb-4 mt-5">'; ?>
                <?php if($server): ?>
                    <?php
                        $fields = lgsl_sort_fields($server, $fields_show, $fields_hide, $fields_other);
                        $server = lgsl_sort_players($server);
                        $server = lgsl_sort_extras($server);
                        $misc   = lgsl_server_misc($server);
                        $server = lgsl_server_html($server);
                    ?>
                    <h5 class="ml-md-2 mt-4"><i class="fas fa-server"></i> <?php echo $server['s']['name']; ?></h5>

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
                                                <?php if($server['s']['map']!=='teamspeak'): ?>
                                                    <th class="text-center align-middle"><i class="fas fa-stopwatch"></i> Connection Time</th>
                                                <?php endif; ?>
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
                                                
                                                <?php if(($server['s']['map']!=='teamspeak')&&($player_time !== $player_gotv_time)): ?>
                                                    <tr class=" <?php if(++$server_p_row!==1) echo 'border-top border-light';?>">
                                                        <td class="text-left pl-3 align-middle py-0"><?php echo $player_name; ?></td>
                                                        <td class="text-center align-middle  py-0"><?php echo $player_time; ?></td>
                                                    </tr>
                                                <?php elseif(($server['s']['map']==='teamspeak')&&(!str_contains($player_name, 'serveradmin'))&&(!str_contains($player_name, 'MusicBot'))): ?>
                                                    <tr class=" <?php if(++$server_p_row!==1) echo 'border-top border-light';?>">
                                                        <td class="text-left pl-3 align-middle py-0"><?php echo $player_name; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                

                                            <?php endforeach; ?>
                                        </tbody>                                   
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12 col-md-4">
                            <ul class="list-group list-group-flush text-center shadow-sm">
                                <li class="list-group-item border">
                                    <strong><i class="fas fa-info-circle"></i> Status</strong>
                                    <br>
                                    <?php echo $misc['text_badge_status']; ?>
                                </li>
                                <li class="list-group-item border">
                                    <strong><i class="fas fa-network-wired"></i> Server Adress</strong>
                                    <br>
                                    <div class="form-row mx-5">
                                        <div class="col">
                                            <input class="form-control form-control-sm text-center shadow-sm mt-2" type="text" value="<?php echo $server['b']['ip'].':'.$server['b']['c_port']; ?>" readonly>
                                        </div>
                                        <div class="col-auto">
                                            <a class="btn btn-outline-dark btn-sm mt-2 py-1 px-3 shadow-sm" title="Connect to server" href="<?php if($server['s']['map']==='teamspeak'): echo 'ts3server://'.$server['b']['ip'].'?port='.$server['b']['c_port']; else: echo 'steam://connect/'.$server['b']['ip'].':'.$server['b']['c_port']; endif;?>"><i class="fas fa-plug"></i> Connect</a>
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
                            </ul>
                        </div>

                    </div>
                <?php endif; ?>
            </div>
        <?php $serverlist_row++; endforeach; ?>
    </div>


<?php else: ?>

    <div class="table-responsive">
        <table class="table table-borderless border shadow-sm">
            <thead class="border">
                <tr>
                    <th class="text-center align-middle"></th>
                    <th class="text-left align-middle"><i class="fas fa-server"></i> Server</th>
                    <th class="text-center align-middle"><i class="fas fa-network-wired"></i> Server Adress</th>
                    <th class="text-center align-middle"><i class="fas fa-map"></i> Map</th>
                    <th class="text-center align-middle"><i class="fas fa-user-friends"></i> Players</th>
                    <th class="text-center align-middle"><?php if($lgsl_show_servers == false): ?><a class="btn btn-outline-info btn-sm py-1 shadow-sm" role="button" href="dashboard-servers.php"><i class="fas fa-info-circle"></i> More Info</a><?php endif; ?></th>
                </tr>
            </thead>
            <tbody class="">
                <?php 
                    foreach ($server_list as $server):
                        $misc   = lgsl_server_misc($server);
                        $server = lgsl_server_html($server);
                        $ServerIP = $server['b']['ip'].':'.$server['b']['c_port'];

                        if(($ServerIP==='kiepownica.pl:9987')||($ServerIP==='kiepownica.com:27015')||($ServerIP==='kiepownica.com:27016')||($ServerIP==='kiepownica.com:27017')):
                ?>
                    <tr>
                        <td class="text-center align-middle"><span class="server-list-status <?php echo $misc['icon_status_webkp']; ?> rounded shadow-sm" title="<?php echo $misc['text_status']; ?>"><img height="24" class="shadow rounded" src="<?php echo $misc['icon_game'];?>"></span></td>
                        <td class="text-left align-middle"><?php echo $server['s']['name']; ?></td>
                        <td class="text-center align-middle"><?php echo $ServerIP; ?></td>
                        <td class="text-center align-middle text-muted"><?php if($server['s']['map']==='teamspeak'): echo '<small class="text-muted">TeamSpeak</small>'; else: echo $server['s']['map'];; endif;?></td>
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
                            <a class="btn btn-outline-dark btn-sm py-1 shadow-sm" role="button" href="<?php if($server['s']['map']==='teamspeak'): echo 'ts3server://'.$server['b']['ip'].'?port='.$server['b']['c_port']; else: echo 'steam://connect/'.$ServerIP; endif;?>"><i class="fas fa-plug"></i> Connect</a>
                        </td>
                    </tr>
                <?php endif; endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>
