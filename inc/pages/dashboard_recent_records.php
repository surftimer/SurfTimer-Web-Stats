<?php
    require_once('./../config.php');
    require_once('./../languages.php');
    require_once('./../database.php');
    require_once('./../functions.php');

    $sql_recent_records = "SELECT ck_latestrecords.*, ck_playerrank.name as normal_name, ck_playerrank.* FROM `ck_latestrecords` LEFT JOIN ck_playerrank ON ck_playerrank.steamid=ck_latestrecords.steamid WHERE style='0' ORDER BY `ck_latestrecords`.`date` DESC LIMIT 100";
    $results_recent_records = mysqli_query($db_conn_surftimer, $sql_recent_records);
    $recent_records = array();
    if(mysqli_num_rows($results_recent_records) > 0){
        while($row_recent_records = mysqli_fetch_assoc($results_recent_records))
            $recent_records[] = $row_recent_records;
    };
?>

<script>
    $('#recent-records').DataTable({
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
            { "className": "text-left align-middle pl-3", "targets": [ 0 ] },
            { "className": "text-center align-middle", "targets": [ 1 ] },
            { "className": "text-center align-middle", "targets": [ 2 ] },
            { "className": "text-center align-middle", "targets": [ 3 ] }
        ],
        "order": [[ 3, "desc" ]],
        "data": [
            <?php foreach($recent_records as $recent_record): ?>
                <?php
                    $runtime_recent_record_data = $recent_record['runtime'];    
                    $runtime_recent_record_microtime = substr($runtime_recent_record_data, strpos($runtime_recent_record_data, ".") + 1);    
                    $runtime_recent_record_timeFormat = gmdate("H:i:s", $runtime_recent_record_data).'<span class="text-muted">.'.$runtime_recent_record_microtime.'</span>';
                    $dateFormat_recent_record = date('Y/m/d  (H:i)', strtotime($recent_record['date']));
                ?>
                [
                    '<?php if($config_player_flags) echo CountryFlag($recent_record['country'], $recent_record['countryCode'], $recent_record['continentCode']); ?> <?php echo PlayerUsernameProfile($recent_record['steamid64'], $recent_record['name']); ?>',
                    '<?php echo MapPageLink($recent_record['map']); ?>',
                    '<?php echo $runtime_recent_record_timeFormat; ?>',
                    '<small><?php echo $dateFormat_recent_record; ?></small>'
                ],
            <?php endforeach; ?>
        ]
    });
</script>

<div class="table-responsive">
    <table class="table table-hover border shadow-sm py-0 my-2 nowrap" style="width:100%" id="recent-records">
        <thead class="border">
            <th class="text-left"><?php echo TABLE_USERNAME;?></th>
            <th class="text-center"><?php echo TABLE_MAP;?></th>
            <th class="text-center"><?php echo TABLE_TIME;?></th>
            <th class="text-center"><?php echo TABLE_DATE;?></th>
        </thead>
        <tbody class="">

        </tbody>
    </table>
</div>
