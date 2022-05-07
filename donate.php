<?php
    $page_name = 'Donate';
    
    require_once('./inc/includes.php');

    require_once('header.php');
    require_once('navbar.php');
    require_once('./inc/pages/donate.php');
?>
    
    <div class="">
        <div class="col-lg-11 mx-auto pb-1">


            <section class="my-4 pb-0">
                

                <p class="lead text-center my-5">
                    <b>Thanks for your interest in donating!</b><br>
                    SurfCommunity team relies on your generosity to keep its sites and development running.<br>
                    We greatly appreciate those who choose to donate to support us!<br>
                    By donating, you will receive the benefits listed below.
                </p>
                <div class="row">
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h4 class="text-center my-2 py-0">Tier 1</h4>
                            </div>
                            <div class="card-header bg-transparent">
                                <h5 class="text-center my-4 py-0">2€/MONTH</h5>
                            </div>
                            <div class="card-body text-center">
                                [€] Chat Tag<br>
                                Bold Name on Website<br>
                                T1 Donator Discord Role<br>
                                <hr>
                                Reserved Slots<br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h4 class="text-center my-2 py-0">Tier 2</h4>
                            </div>
                            <div class="card-header bg-transparent">
                                <h5 class="text-center my-2 py-1">4€/MONTH<br><small>9€/3 MONTHS</small></h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="text-primary">
                                    [€€] Chat Tag<br>
                                    Blue and Bold Name on Website<br>
                                    T2 Donator Discord Role<br>
                                </div>
                                <hr>
                                <strong>All Tier 1 Perks</strong><br>
                                Vote Extend<br>
                                Nightvision<br>
                                Paint<br>
                                No Ads in Chat<br>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h4 class="text-center my-2 py-0">Tier 3</h4>
                            </div>
                            <div class="card-header bg-transparent">
                                <h5 class="text-center my-2 py-1">8€/MONTHM<br><small>18€/3 MONTHS</small></h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="text-success">
                                    Custom Chat Tag<br>
                                    Green and Bold Name on Website<br>
                                    T3 Donator Discord Role<br>
                                </div>
                                <hr>
                                <strong>All Tier 1 and 2 Perks</strong><br>
                                Custom Name color in game<br>
                                Custom in game text Color<br>
                                Custom join message<br>
                                Triggers<br>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h4 class="text-center my-2 py-0">Lifetime Tier</h4>
                            </div>
                            <div class="card-header bg-transparent">
                                <h5 class="text-center my-4 py-0">80€/ONE-TIME</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="text-warning">
                                    Custom Chat Tag<br>
                                    Gold and Bold Name on Website<br>
                                    Lifetime Donator Discord Role<br>
                                </div>
                                <hr>
                                <strong>All Tier 1, 2 and 3 Perks</strong><br>
                                Abilty to Reset Your Account<br>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(!$steam->loggedIn()): ?>
                    <div class="alert alert-info shadow-sm mt-4 mb-0 text-center" role="alert">
                        <i class="fas fa-info-circle"></i> Please <b>sign in</b> if you wish to donate.
                    </div>
                <?php else: ?>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-3">
                            <button type="button" class="btn btn-outline-success shadow-sm btn-block btn-lg mt-4 mb-0" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-donate"></i> Continue</button>
                        </div>  
                    </div>
                <?php endif; ?>

            </section>
            <hr class="<?php if($steam->loggedIn()) echo 'mt-4 my-0'; else echo'my-0'; ?>">
            <section class="my-4">
                    <h3 class="text-center pb-2">TIER 1 <small>AND UP</small></h3>
                    <div class="text-center">
                        <h5>Reserved Slots</h5>
                        <p>
                            Every server has a reserved slot for donors.<br>
                            If the server is already full then the last connected player will be kicked after donator join.
                        </p>
                        <i class="fas fa-user-plus fa-4x text-body mb-4"></i>
                    </div>
            </section>
            <hr>
            <section class="my-4">
                    <h3 class="text-center text-primary pb-2">TIER 2 <small>AND UP</small></h3>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">Vote Extend</h5>
                            <div class="text-center mb-5"> 
                                <span class="text-info font-weight-bold">!ve, !voteextend</span>
                                <p>Allows you to start vote extend of current map.</p>
                                <i class="far fa-clock fa-4x text-info"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">Nightvision</h5>
                            <div class="text-center mb-5"> 
                                <span class="text-info font-weight-bold">!nv, !nightvision, !nightvisionsettings, !nvs</span>
                                <p>Allows you too see in dark places of map.</p>
                                <i class="far fa-moon fa-4x text-info"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">Paint</h5>
                            <div class="text-center mb-5"> 
                                <span class="text-info font-weight-bold">+paint, !paintcolor, !paintsize</span>
                                <p>Allows you to highlight the edges of surf.</p>
                                <i class="fas fa-spray-can fa-4x text-info"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">No Ads in Chat</h5>
                            <div class="text-center mb-5"> 
                                <p class='mt-4'>You will not be spamed with community and helful messages in chat.</p>
                                <i class="fas fa-ad fa-4x text-info mt-3"></i>
                            </div>
                        </div>
                    </div>
            </section>
            <hr>
            <section class="my-4">
                    <h3 class="text-center text-success pb-2">TIER 3 <small>AND UP</small></h3>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">Custom Name color in game</h5>
                            <div class="text-center mb-5"> 
                                <span class="text-success font-weight-bold">!namecolour</span>
                                <p>You can set your own custom name color.</p>
                                <i class="fas fa-palette fa-4x text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">Custom in game text Color</h5>
                            <div class="text-center mb-5"> 
                                <span class="text-success font-weight-bold">!textcolour</span>
                                <p>Allows you too change messages text color.</p>
                                <i class="far fa-comment fa-4x text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">Custom join message</h5>
                            <div class="text-center mb-5"> 
                                <span class="text-success font-weight-bold">!joinmsg</span>
                                <p>You can set your own join message.</p>
                                <i class="fas fa-door-open fa-4x text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <h5 class="text-center mt-2">Triggers</h5>
                            <div class="text-center mb-5"> 
                                <span class="text-success font-weight-bold">!triggers</span>
                                <p>You can see all Triggers on map.</p>
                                <i class="fas fa-layer-group fa-4x text-success"></i>
                            </div>
                        </div>
                    </div>
            </section>
            <hr>
            <section class="my-4">
                    <h3 class="text-center text-warning pb-2">LIFETIME TIER</h3>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <h5 class="text-center mt-2">Abilty to Reset Your Account</h5>
                            <div class="text-center mb-4"> 
                                <p>Allows you too see in dark places of map.</p>
                                <i class="fas fa-eraser fa-4x text-warning"></i>
                            </div>
                        </div>
                    </div>
            </section>
            <hr>
            <section class="mt-4">
                    <h3 class="text-center text-danger">P<small>RIVATE</small> S<small>ERVERS</small></h3>
                    <div class="row justify-content-md-center mt-4">
                        <p class="text-center col-md-9 col-12">We offer private servers to users who pay a monthly fee. 
                            These are fully functional servers within our ranking system and require a password of your choosing in order to join. 
                            The server owner also has access to the !map command for instant map switching at any time while on their private server.
                        </p>
                        <p class="text-center col-md-9 col-12">
                            These servers have a base size of 1 player slot
                            You may pay an additional fee to add slots, and can invite anyone you choose by sharing the password with them.
                        </p>
                    </div>
                    <div class="text-center text-danger my-3">
                        Set-Up Fee: <strong>5€/one time payment</strong><br>
                        Base server 1 slot: <strong>13€/monthly</strong><br>
                        Additional slots: <strong>2.5€/month per slot</strong>
                    </div>
                    <h5 class="text-center mt-4">Contact <span class="text-danger">KristiánP</span> if youre interested.</h5>
            </section>
            
        </div>
    </div>
<?php
    require_once('footer.php');
    $db_conn_surftimer->close();
    $db_conn_web->close();
?>