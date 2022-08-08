<?php
    require_once('./../config.php');
    require_once('./../database.php');
    require_once('./../functions.php');

$output = '';

if(isset($_POST["query"])):

    $search = mysqli_real_escape_string($db_conn_surftimer, $_POST["query"]);
    $query = "SELECT * FROM `ck_playerrank` WHERE steamid64 LIKE '%".$search."%' OR name LIKE '%".$search."%' OR steamid LIKE '%".$search."%' ORDER BY `points` DESC LIMIT 5;";

    $result = mysqli_query($db_conn_surftimer, $query);
    if(mysqli_num_rows($result) > 0):
    $output .= '
    <table class="table border mt-3 table-hover table-hover table-sm shadow-sm py-0 my-0">
            <thead class="border-bottom">
            <tr>
                <th class="text-left pl-3">Username</th>
                <th class="text-center">Points</th>
                <th class="text-center">Maps</th>
                <th class="text-center">Bonuses</th>
                <th class="text-center">Stages</th>

            </tr>
        </thead>
        <tbody>
    ';
    while($row = mysqli_fetch_array($result)):
        if($row['style']==='0'):
            if($config_player_flags)
                $row_Country_flag = CountryFlag($row['country'], $row['countryCode'], $row['continentCode']);
            else
                $row_Country_flag = '';

            $output .= '
            
                <tr>
                    <td class="text-left pl-3">
                        '.$row_Country_flag.'
                        '.$row['name'].'
                        <a href="dashboard-player.php?id='.$row['steamid64'].'" target="" title="'.$row['name'].' - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a>
                        <a href="https://steamcommunity.com/profiles/'.$row['steamid64'].'" target="_blank" title="'.$row['name'].' - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a>
                    </td>
                    <td class="text-center">'.number_format($row['points']).'</td>
                    <td class="text-center">'.number_format($row['finishedmapspro']).'</td>
                    <td class="text-center">'.number_format($row['finishedbonuses']).'</td>
                    <td class="text-center">'.number_format($row['finishedstages']).'</td>                       
                </tr>
            ';
        endif;
    endwhile;
    $output .= '
        </tbody>
        </table>
    ';
    echo $output;
    else:
    echo '
        <h5 class="mt-3 pl-3"><i class="fas fa-info-circle"></i> No Results<h3>
    ';
    endif;

endif;