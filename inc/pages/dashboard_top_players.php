<?php
    require_once('./../config.php');
    require_once('./../languages.php');
    require_once('./../database.php');
    require_once('./../functions.php');

    $sql_top_players = "SELECT ck_playerrank.* FROM ck_playerrank WHERE style='0' ORDER BY points DESC LIMIT 1000";
    $results_top_players = mysqli_query($db_conn_surftimer, $sql_top_players);
    $top_players = array();
    if(mysqli_num_rows($results_top_players) > 0){
        while($row_top_players = mysqli_fetch_assoc($results_top_players))
            $top_players[] = $row_top_players;
    };
?>

<script>
    $('#top-players').DataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
        responsive: true,
        "processing": true,
        "columnDefs": [
            { "className": "text-center align-middle", "targets": [ 0 ] },
            { "className": "text-left align-middle", "targets": [ 1 ] },
            { "className": "text-center align-middle", "targets": [ 2 ] },
            { "className": "text-center align-middle", "targets": [ 3 ] },
            { "className": "text-center align-middle", "targets": [ 4 ] },
            { "className": "text-center align-middle", "targets": [ 5 ] }
        ],
        "data": [
            <?php $top_player_row = 0; foreach($top_players as $top_player): ?>
                [
                    '<?php echo ++$top_player_row; ?>.',
                    '<?php if($config_player_flags) echo CountryFlag($top_player['country'], $top_player['countryCode'], $top_player['continentCode']); ?> <?php echo PlayerUsernameProfile($top_player['steamid64'], $top_player['name']); ?>',
                    '<?php echo number_format($top_player["points"]); ?>',
                    '<?php echo number_format($top_player["finishedmapspro"]); ?>',
                    '<?php echo number_format($top_player["finishedbonuses"]); ?>',
                    '<?php echo number_format($top_player["finishedstages"]); ?>'
                ],
            <?php endforeach; ?>
        ]
    });
</script>

<div class="table-responsive">
    <table class="table table-hover border shadow-sm py-0 my-2 nowrap" style="width:100%" id="top-players">
        <thead class="border">
            <th class="text-center">#</th>
            <th class="text-left">Username</th>
            <th class="text-center">Points</th>
            <th class="text-center">Maps</th>
            <th class="text-center">Bonuses</th>
            <th class="text-center">Stages</th>
        </thead>
        <tbody class="">
            
        </tbody>
    </table>
</div>