<?php
    require_once('./../config.php');
    require_once('./../database.php');

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
                    '<?php echo $recent_record['normal_name']; ?> <a href="dashboard-player.php?id=<?php echo $recent_record['steamid64']; ?>" target="" title="<?php echo $recent_record['name']; ?> - Surf Profile" class="text-muted"><i class="fas fa-user-circle"></i></a> <a href="https://steamcommunity.com/profiles/<?php echo $recent_record['steamid64']; ?>" target="_blank" title="<?php echo $recent_record['normal_name']; ?> - Steam Profile" class="text-muted"><i class="fab fa-steam"></i></a>',
                    '<a href="dashboard-maps.php?map=<?php echo $recent_record['map']; ?>" class="text-muted text-decoration-none"><?php echo $recent_record["map"]; ?> <i class="fas fa-link"></i></a>',
                    '<?php echo $runtime_recent_record_timeFormat; ?>',
                    '<small><?php echo $dateFormat_recent_record; ?></small>'
                ],
            <?php endforeach; ?>
        ]
    });
</script>

<div class="table-responsive">
    <table class="table table-hover border shadow-sm py-0 my-2" id="recent-records">
    <thead class="border">
        <th class="text-left">Username</th>
        <th class="text-center">Map</th>
        <th class="text-center">Time</th>
        <th class="text-center">Date</th>
    </thead>
    <tbody class="table-sm">
        
    </tbody>
</table>