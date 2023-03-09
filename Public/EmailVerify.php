<?php

namespace FitCon\Pub\EmailVerify;
include "../Controller/EmailVerify.php";
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

    .btn {
        margin: 5px;
    }

    input.my-input:-internal-autofill-selected {
        background-color: rgb(255, 255, 255) !important;
        background-image: none !important;
        color: rgb(0, 0, 0) !important;
    }
</style>

<body id="page-top">
    <?php require $View->getURL()."/Main_nav.php" ?>
    <!-- Masthead-->
    <header class="masthead" style="padding-top: 5rem;">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold"><?= COMP_NAME ?></h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 justify-content-md-center">
                    <div class="card text-white" style="max-width: 100%;">
                        <div class="card-header"><h2>Attenzione!</h2></div>
                        <div class="card-body">
                            <h5 class="card-title"><?=$msg?></h5>
                        </div>
                        <a href="./Login" class="btn btn-warning">
                             Torna al login !
                        </a>
                    </div>
                </div>
                <div class=" px-4 px-lg-5">
                    <div class="small text-center text-muted">Copyright &copy; 2022 - <?= COMP_NAME ?></div>
                </div>
            </div>
        </div>

    </header>
    <?php include($View->getURL() . "/Modal.php") ?>
    <!-- Bootstrap core JS-->
    <script src="<?= $Vendor->getURL() ?>/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= $Lib->getURL() ?>/js/scripts.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    

</body>

</html>