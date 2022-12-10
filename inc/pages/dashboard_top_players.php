<?php
    require_once('./../config.php');
    require_once('./../docker_conf.php');
    require_once('./../languages.php');
    require_once('./../database.php');
    require_once('./../functions.php');

    $sql_top_players = "SELECT ck_playerrank.* FROM ck_playerrank WHERE style='0' ORDER BY points DESC LIMIT 1000";
    $results_top_players = mysqli_query($db_conn_surftimer, $sql_top_players);
    $top_players = array();
    if(mysqli_num_rows($results_top_players) > 0){
        while($row_top_players = mysqli_fetch_assoc($results_top_players))
            $top_players[] = $row_top_players;
    }
    
?>

<script>
    $('#top-players').DataTable({
        language: {
            processing:     '<?php echo DATATABLES_processing; ?>',
            search:         '<?php echo DATATABLES_search; ?>',
            lengthMenu:     '<?php echo DATATABLES_lengthMenu; ?>',
            info:           '<?php echo DATATABLES_info; ?>',
            infoEmpty:      '<?php echo DATATABLES_infoEmpty; ?>',
            infoFiltered:   '<?php echo DATATABLES_infoFiltered; ?>',
            loadingRecords: '<?php echo DATATABLES_loadingRecords; ?>',
            zeroRecords:    '<?php echo DATATABLES_zeroRecords; ?>',
            emptyTable:     '<?php echo DATATABLES_emptyTable; ?>',
            paginate: {
                first:      '<?php echo DATATABLES_first; ?>',
                previous:   '<?php echo DATATABLES_previous; ?>',
                next:       '<?php echo DATATABLES_next; ?>',
                last:       '<?php echo DATATABLES_last; ?>'
            },
            aria: {
                sortAscending:  '<?php echo DATATABLES_sortAscending; ?>',
                sortDescending: '<?php echo DATATABLES_sortDescending; ?>'
            }
        },
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
            <th class="text-left"><?php echo TABLE_USERNAME;?></th>
            <th class="text-center"><?php echo TABLE_POINTS;?></th>
            <th class="text-center"><?php echo TABLE_MAPS;?></th>
            <th class="text-center"><?php echo TABLE_BONUSES;?></th>
            <th class="text-center"><?php echo TABLE_STAGES;?></th>
        </thead>
        <tbody class="">
            
        </tbody>
    </table>
</div>