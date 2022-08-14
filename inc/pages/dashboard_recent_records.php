<?php
    require_once('./../config.php');
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
                    '<?php echo MapPageLink($recent_record['map']); ?>'
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
            <th class="text-left">Username</th>
            <th class="text-center">Map</th>
            <th class="text-center">Time</th>
            <th class="text-center">Date</th>
        </thead>
        <tbody class="">

        </tbody>
    </table>
</div>
