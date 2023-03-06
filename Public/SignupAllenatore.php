<?php
include "Includer.php";
?>

<style>
    header.masthead {
        padding-top: 8rem;
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
    <?php require "../View/Main_nav.php" ?>
    <!-- Masthead-->
    <header class="masthead" style="padding-top: 5rem;">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold my-md-4 my-sm-4">Fit Connects</h1>
                    <hr class="divider" />
                </div>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">

                            <div class="col-md-auto row justify-content-center">
                                <div class="card z-index-0 fadeIn3 fadeInBottom">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="bg-gradient-danger shadow-danger border-radius-lg py-3 pe-1">
                                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Registrazione Istruttori!</h4>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form autocomplete="off" method="POST" class="text-start">
                                            <div class="row align-items-center">
                                                <div class="col-10">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label class="form-label">Codice allenatore</label>
                                                        <input type="text" id="code" name="code" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <button style="margin:0px; " type="button" class="btn btn-secondary"  onclick="alert('Codice consegnato dall\' amministratore')">?</button>
                                                </div>
                                            </div>

                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Nome</label>
                                                <input type="text" id="nome" name="nome" class="form-control">
                                            </div>

                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" autocomplete="off">
                                            </div>

                                            <div class="input-group input-group-outline mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" id="pass1" name="pass1" class="form-control" autocomplete="off">
                                            </div>

                                            <div class="input-group input-group-outline mb-3">
                                                <label class="form-label">Ripeti Password</label>
                                                <input type="password" id="pass2" name="pass2" class="form-control">
                                            </div>

                                            <input type="hidden" id="user" name="user" value="istruttore" />


                                            <div class="row justify-content-around">
                                                <div class="col-md-auto">
                                                    <button type="button" onclick="sub()" class="btn btn-warning">
                                                        Registrati
                                                    </button>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="reset" class="btn btn-danger"></input>
                                                    <br />
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <a href="./Login" class="btn btn-link">
                                                    Già registrato ? Accedi !
                                                </a>
                                            </div>
                                            <div class="row justify-content-center">
                                                <a href="./Login" class="btn btn-link text-dark">
                                                    Non sei un allenatore ? Passa all'area clienti !
                                                </a>
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
                <div class="small text-center text-muted my-md-4 my-sm-4">Copyright &copy; 2022 - <?= COMP_NAME ?></div>
            </div>
        </div>
        </div>

    </header>

    <?php
    include($View->getURL() . "/Modal.php");
    include($View->getURL() . "/JS_Script.php");
    ?>


    <!-- Bootstrap core JS-->
    <script src="<?= $Vendor->getURL() ?>/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= $Lib->getURL() ?>/js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $('form input').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });

        function sub() {

            $nome = $("#nome").val();
            $email = $("#email").val();
            $pass = $("#pass1").val();
            $pass2 = $("#pass2").val();
            $user = $("#user").val();
            $code = $("#code").val();

            $.ajax({
                type: "POST",
                url: "<?= $Controller->GetURL() ?>/User.php",
                data: {
                    code: $code,
                    email: $email,
                    pass1: $pass,
                    pass2: $pass2,
                    nome: $nome,
                    user: $user,
                },
                dataType: "text",
                success: function(risposta) {
                    console.log(risposta);
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