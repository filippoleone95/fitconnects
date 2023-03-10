<?php

require_once __DIR__ . '/../Log/LoggerUtil.php';
/* Inizializzo il logger */

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('Login.php -> --- Richiamato file Login.php ---');

$logger->info('Login.php -> Richiamato file Includer.php');
include "Includer.php";

$logger->info('Login.php -> Restituisco codice HTML');

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
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">

                            <div class="col-md-auto row justify-content-center">
                                <div class="card z-index-0 fadeIn3 fadeInBottom">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="bg-gradient-warning shadow-warning border-radius-lg py-3 pe-1">
                                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Accedi</h4>
                                            <div class="row mt-3">
                                                <div class="col-2 text-center ms-auto">
                                                    <a class="btn btn-link px-3" onclick="alert('L\'accesso tramite facebook non è ancora disponibile')">
                                                        <i class="fa fa-facebook text-white text-lg"></i>
                                                    </a>
                                                </div>
                                                <div class="col-2 text-center px-1">
                                                    <a class="btn btn-link px-3" onclick="alert('L\'accesso tramite github non è ancora disponibile')">
                                                        <i class="fa fa-github text-white text-lg"></i>
                                                    </a>
                                                </div>
                                                <div class="col-2 text-center me-auto">
                                                    <a class="btn btn-link px-3" onclick="alert('L\'accesso tramite google non è ancora disponibile')">
                                                        <i class="fa fa-google text-white text-lg"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" class="text-start">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control">
                                            </div>
                                            <div class="input-group input-group-outline mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" id="pass1" name="pass1" class="form-control">
                                            </div>
                                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                                <input type="hidden" id="user" name="user" value="login" />
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn bg-gradient-warning w-100 my-4 mb-2" onclick="sub()">Login</button>
                                            </div>
                                            <h2 class="mt-4 text-sm text-center">
                                                Non sei ancora registrato ?
                                                <a href="./PreSignup" class="text-warning text-gradient font-weight-bold"> Unisciti a noi !</a>
                                            </h2>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 align-items-center justify-content-center text-center">
                <div class="my-auto px-4 px-lg-5">
                    <div class="small text-center text-muted">Copyright &copy; <script>document.write(/\d{4}/.exec(Date())[0])</script> - <?= COMP_NAME ?></div>
                </div>
            </div>
        </div>
    </header>

    <?php
    $logger->info('Login.php -> Includo file /Modal.php');
    include($View->getURL() . "/Modal.php");
    $logger->info('Login.php -> Includo file /JS_Script.php');
    include($View->getURL() . "/JS_Script.php");
    ?>

    <script>
        $('form input').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });

        function sub() {
            $email = $("#email").val();
            $pass = $("#pass1").val();
            $user = $("#user").val();
            console.log("Login -> Controllo se l'utente ha completato la registrazione");

            $.ajax({
                type: "POST",
                url: "<?= $Controller->GetURL() ?>/User.php",
                data: {
                    email: $email,
                    pass1: $pass,
                    user: $user
                },
                dataType: "text",
                success: function(risposta) {
                    if (risposta == "Attendi") {
                        console.log("Login -> L'utente ha completato la registrazione");
                        window.location.href = "./Dashboard";
                    } else if (risposta == "Completa la registrazione") {
                        console.log("Login -> L'utente NON ha completato la registrazione");
                        window.location.href = "./Complete";
                    }
                    //show modal 
                    $('#textModal').text(risposta);
                    $('#modal').modal('show');
                },
                error: function() {
                    allert("errore AJAX");
                }
            });
        }
    </script>
</body>
</html>
<?php $logger->info('Login.php -> Fine file'); ?>