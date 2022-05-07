<script>
    $(document).ready(function(){
        load_data();
        function load_data(query){
            $.ajax({
                url:"./inc/pages/dashboard_player_search.php",
                method:"POST",
                data:{query:query},
                success:function(data){
                    $('#players_search_result').html(data);
                }
            });
        }$('#players_search').keyup(function(){
            var search = $(this).val();
            if(search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
    <?php if($page_name==='Home'||$page_name==='Servers - Dashboard'): ?>
        <?php if(!isset($lgsl_server_id)) $lgsl_server_id = 0; ?>
        <?php if(!isset($lgsl_show_all_servers)) $lgsl_show_all_servers = 1; ?>

        $(document).ready(function(){
            var LgslShowAllServers = '<?php echo $lgsl_show_all_servers; ?>';
            var LgslServerID = '<?php echo $lgsl_server_id ;?>';
            $('#server-list').load('serverlist.php', {
                LgslShowAllServers: LgslShowAllServers,
                LgslServerID: LgslServerID
                
            }),
            setInterval(function(){
                $('#server-list').load('serverlist.php',{
                    LgslShowAllServers: LgslShowAllServers,
                    LgslServerID: LgslServerID
                })
            }, 60000); 
        })
    <?php endif; ?>
    <?php if($page_name==='Most Active - Dashboard'): ?>
        $(document).ready(function(){
            $('#most-active-load').load('./inc/pages/dashboard_most_active.php')
        })
    <?php endif; ?>
    <?php if($page_name==='Top Players - Dashboard'): ?>
        $(document).ready(function(){
            $('#top-players-load').load('./inc/pages/dashboard_top_players.php')
        })
    <?php endif; ?>
    <?php if($page_name==='Recent Records - Dashboard'): ?>
        $(document).ready(function(){
            $('#recent-records-load').load('./inc/pages/dashboard_recent_records.php')
        })
    <?php endif; ?>
    <?php if($page_name==='Maps - Dashboard'): ?>
        $(document).ready(function(){
            var mapname = '<?php echo $mapname; ?>';
            $('#maps-load').load('./inc/pages/dashboard_maps.php', {
                mapname: mapname
            })
        })
    <?php endif; ?>
    <?php if($page_name==='Player Profile - Dashboard'): ?>
        $(document).ready(function(){
            var player_id = '<?php echo $player_id; ?>';
            $('#player-profile-load').load('./inc/pages/dashboard_player.php', {
                player_id: player_id
            })
        })
    <?php endif; ?>
</script>