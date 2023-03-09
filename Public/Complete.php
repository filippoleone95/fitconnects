<?php
include "Includer.php";
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
    <?php require "../View/Main_nav.php" ?>
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
                                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Completa la registrazione!</h4>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form autocomplete="off" method="POST" class="text-start">


                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Nome</label>
                                                <input type="text" id="nome" name="nome" class="form-control">
                                            </div>

                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Cognome</label>
                                                <input type="text" id="cognome" name="cognome" class="form-control" autocomplete="off">
                                            </div>

                                            <div class="input-group input-group-outline mb-3 is-filled">
                                                <label class="form-label">Data Nascita</label>
                                                <input type="date" id="data_n" name="data_n" min="1900-01-01" max="2006-01-01" class="form-control" autocomplete="off" placeholder="">
                                            </div>

                                            <div class="input-group input-group-outline mb-3">
                                                <label class="form-label">Indirizzo</label>
                                                <input type="text" id="ind" name="ind" class="form-control">
                                            </div>

                                            <div class="input-group input-group-outline my-3 is-filled">
                                                <label class="form-label">Sesso</label>
                                                <select class="form-select form-control" id="sesso" name="sesso">
                                                    <option value="M">Maschio</option>
                                                    <option value="F">Femmina</option>
                                                    <option value="T">Altro</option>
                                                </select>
                                            </div>

                                            <input type="hidden" id="user" name="user" value="complete" />


                                            <div class="row justify-content-around">
                                                <div class="col-md-auto">
                                                    <button type="button" onclick="sub()" class="btn btn-warning">
                                                        Accedi
                                                    </button>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="reset" class="btn btn-danger"></input>
                                                    <br />
                                                </div>
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
            $cognome = $("#cognome").val();
            $data_n = $("#data_n").val();
            $ind = $("#ind").val();
            $sesso = $("#sesso").val();
            $user = $("#user").val();

            $.ajax({
                type: "POST",
                url: "<?= $Controller->GetURL() ?>/User.php",
                data: {
                    nome: $nome,
                    cogn: $cognome,
                    data: $data_n,
                    ind: $ind,
                    sesso: $sesso,
                    user: $user,
                },
                dataType: "text",
                success: function(risposta) {
                    if (risposta == "true") {
                        window.location.href = "./DashBoard";
                    } else {
                        console.log(risposta);
                    }

                },
                error: function() {
                    allert("errore AJAX");
                }
            });
        }
    </script>
</body>

</html>