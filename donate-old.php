<?php
    $page_name = 'Donate';
    
    require_once('./inc/includes.php');

    require_once('header.php');
    require_once('navbar.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">


            <section class="my-4 pb-1">

                <h5>Surf Community's Donate</h5>
                <hr class="my-0">
                <div class="text-center mt-5">  
                    Thanks for your interest in donating! SurfCommunity team relies on your generosity to keep its sites and development running.<br>
                    By contributing you will help the operation of our servers.
                    
                    <form class="mb-3 mt-4" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="H9WKMAWES4EQS" />
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                        <img alt="" border="0" src="https://www.paypal.com/en_SK/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                    <small>
                    <strong>Fine Print (Terms of Agreement)</strong><br>
                    Donations are not refundable. Donations are not a service level agreement. While donations are greatly appreciated, there is no guarantee of service or service quality.<br>Any services, either expressed or implied, are provided as a gift only for your convenience.<br>Any services provided may be terminated or modified at any time by SurfCommunity, for any reason deemed appropriate, including (but not limited to) violation of rules associated with services.
                    </small>
                </div>

            </section>

        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
    $db_conn_web->close();
?>