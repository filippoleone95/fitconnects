<?php

require_once __DIR__ . '/../log/LoggerUtil.php';
/* Inizializzo il logger */

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('PreSignup.php -> --- Richiamato file PreSignup.php ---');

$logger->info('PreSignup.php -> Richiamato file Includer.php');
include "Includer.php";

$logger->info('PreSignup.php -> Restituisco codice HTML');
?>


<style>
    header.masthead {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 4.5rem);
        background: linear-gradient(to bottom, rgb(0 0 0 / 98%) 0%, rgb(68 68 68 / 82%) 100%), url("../Assets/assets/img/signup.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: cover;
    }



    .input-group.input-group-outline.is-focused .form-label+.form-control,
    .input-group.input-group-outline.is-filled .form-label+.form-control {
        border-color: #fc930a !important;
        border-top-color: transparent !important;
        box-shadow: inset 1px 0 #fc940b, inset -1px 0 #fc9107, inset 0 -1px #fd9710;
    }
</style>

<body id="page-top">
    <?php
    $logger->info('Login.php -> Includo file View/Main_nav.php');
    require "../View/Main_nav.php"
    ?>
    <!-- Masthead-->
    <header class="masthead" style="padding-top: 5rem;">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold my-md-4 my-sm-4"><?= COMP_NAME ?></h1>
                    <hr class="divider" />
                </div>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12 mx-auto">

                            <div class="col-md-auto row justify-content-center">
                                <div class="card z-index-0 fadeIn3 fadeInBottom">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="bg-gradient-warning shadow-warning border-radius-lg py-3 pe-1">
                                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Come vuoi registrarti ?</h4>
                                            <div class="row mt-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-6 text-center ms-auto my-0">
                                                <div class="input-group input-group-outline my-3 justify-content-center">
                                                    <a type="button" class="btn btn-warning" href="./Signup">
                                                        <i class="material-icons opacity-10" style="font-size: 3rem;">fitness_center</i><br>
                                                        <p class="h6 text-bold text-light">Atleta</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-6 text-center ms-auto my-0">
                                                <div class="input-group input-group-outline my-3 justify-content-center">
                                                    <a type="button" class="btn btn-primary" href="./SignupAllenatore">
                                                        <i class="material-icons opacity-10" style="font-size: 3rem;">sports</i><br>
                                                        <p class="h6 text-bold text-light">Istruttore</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <h2>
                                                <a href="./Login" class="btn btn-link">
                                                    Già registrato ? Accedi !
                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" px-4 px-lg-5">
                <div class="small text-center text-muted my-md-4 my-sm-4">Copyright &copy; <script>document.write(/\d{4}/.exec(Date())[0])</script> - <?= COMP_NAME ?></div>
            </div>
        </div>
        </div>

    </header>

    <?php
    
    $logger->info('PreSignup.php -> Includo file /Modal.php');
    include($View->getURL() . "/Modal.php");
    $logger->info('PreSignup.php -> Includo file /JS_Script.php');
    include($View->getURL() . "/JS_Script.php");
    ?>

    <!-- Bootstrap core JS-->
    <script src="<?= $Vendor->getURL() ?>/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= $Lib->getURL() ?>/js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</body>
</html>
<?php $logger->info('PreSignup.php -> Fine file'); ?>