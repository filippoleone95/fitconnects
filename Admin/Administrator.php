<?php
include "Includer.php";

?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>
        Dashboard <?= COMP_NAME ?>
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../Lib/dash/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../Lib/dash/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/f3b5704387.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../Lib/dash/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>



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

    .input-group.input-group-outline.is-focused .form-label+.form-control, .input-group.input-group-outline.is-filled .form-label+.form-control {
        border-color: #fc930a !important;
        border-top-color: transparent !important;
        box-shadow: inset 1px 0 #fc940b, inset -1px 0 #fc9107, inset 0 -1px #fd9710;
    }
    input:-webkit-autofill {
    background-color: transparent !important;
    -webkit-box-shadow: 0 0 0 50px white inset;
}
</style>

<body id="page-top">
    <?php require "../View/Main_nav.php" ?>
    <!-- Masthead-->
    <header class="masthead" style="padding-top: 5rem;">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold"><?= COMP_NAME ?></h1>
                    <hr class="divider" />
                </div>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">

                            <div class="col-md-auto row justify-content-center">
                                <div class="card z-index-0 fadeIn3 fadeInBottom">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Amministrazione</h4>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" class="text-start">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Email</label>
                                                <input type="email"  id="email" name="email" class="form-control">
                                            </div>
                                            <div class="input-group input-group-outline mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password"  id="pass1" name="pass1" class="form-control">
                                            </div>
                                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                                <input type="hidden" id="user" name="user" value="admin" />
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2" onclick="sub()">Login</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" px-4 px-lg-5">
                <div class="small text-center text-muted">Copyright &copy; 2022 - <?= COMP_NAME ?></div>
            </div>
        </div>
        </div>

    </header>
    
    <?php 
        include($View->getURL() . "/Modal.php") ;
        include($View->getURL()."/JS_Script.php");
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
                    if (risposta == "") {
                        window.location.href = "./DashboardAdmin";
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