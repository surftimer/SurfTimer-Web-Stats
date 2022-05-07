<?php
    $page_name = 'Rules';
    
    require_once('./inc/includes.php');

    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">


            <section class="my-4 pb-1">

                <h5>Surf Community & Kiepownica's Rules</h5>
                <hr class="my-0">
                

            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
    $db_conn_web->close();
?>