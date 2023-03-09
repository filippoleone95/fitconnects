<?php

if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/DashBoard.php");

?>
<div class="container-fluid py-4">
    <?php
    if ($Amministratore) {
        header("Location:" . $Admin->getURL() . "/DashBoardAdmin");
    }
    if (!$Istruttore) { 
    ?>
      
        <h4 class="mb-1">Funzioni Rapide</h4>
        <hr class="mb-4">
        <div class="row mt-4">
            <div class="col-xl-3 col-sm-6  mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-person-running"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Modalità allenamento </p>
                            <h4>Scegli scheda</h4>

                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="row justify-content-between">
                            <div class="col-10">
                                <p class="mb-0"> Data ultimo allenamento <span class="text-success text-sm font-weight-bolder">
                                        <?php $d = $Allenamento->getLastAllenamento($auth->getUserId(), $db);
                                        if ($d != false) {
                                            echo date("d/m/Y H:i", strtotime($d['ORA_FINE']));
                                        } else {
                                            echo "Nessun allenamento effettuato!";
                                        };
                                        ?>
                                    </span></p>
                            </div>
                            <div class="col-2  p-1">
                                <button class="btn btn-warning btn-circle btn-lg" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" style="zoom: 1.5; margin:0;">
                                    <i class="fa fa-play"></i>
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <?php
                                    $p = $Profilo->getProfilo($db);
                                    $age = $Profilo->getAge($p['DATA_NASCITA']);
                                    $sex = $p['SESSO'];
                                    $schede = $Scheda->getSchede($db);
                                    foreach ($schede as $row) {
                                    ?>
                                        <li> <a class="dropdown-item"  href="./Allenamento?id=<?= $row['ID_SCHEDA'] ?>"> <?= $row['NOME_SCHEDA'] ?> </a></li>
                                    <?php }
                                    foreach ($Scheda->getSchedeBase($db) as $row) {
                                        if (($row['SESSO_C'] == $sex || $row['SESSO_C'] == 'T')
                                            && (($row['ANNI_MIN'] <= $age) && ($age <= $row['ANNI_MAX']))
                                        ) {
                                            ?>
                                            <hr>
                                            <li> <a  class="dropdown-item" href="./Allenamento?idb=<?= $row['ID_SCHEDA_B'] ?>"> <?= $row['NOME'] ?> </a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($Allenamento->getAllenamenti($auth->getUserId(), $db) != false) { ?>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">playlist_add_check</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Storico allenamenti</p>
                                <h4 class="mb-0"><?= count($Allenamento->getAllenamenti($auth->getUserId(), $db)) ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="row justify-content-between">
                                <div class="col-10">
                                    <a class="mb-0" href="./Archivio">Clicca per accedere allo storico</a>
                                </div>
                                <div class="col-2  p-1">
                                    <a type="button" href="./Archivio" class="btn btn-info btn-circle btn-lg" style="zoom: 1.5; margin:0;"><i class="fa-solid fa-box-archive"></i> </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">fitness_center</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Esercizi</p>
                            <h4 class="mb-0"><?= count($Esercizi->getEsercizi($db)) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="row justify-content-between">
                            <div class="col-10">
                                <a class="mb-0" href="./Esercizi">Clicca per accedere a tutti gli esercizi</a>
                            </div>
                            <div class="col-2  p-1">
                                <a type="button" href="./Esercizi" class="btn btn-danger btn-circle btn-lg" style="zoom: 1.5; margin:0;"><i class="fa fa-dumbbell"></i> </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Contatta istruttori</p>
                            <h4 class="mb-0"><?= count($Istruttori) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="row justify-content-between">
                            <div class="col-10">
                                <a class="mb-0" href="./Contatti">Clicca per accedere ai contatti</a>
                            </div>
                            <div class="col-2  p-1">
                                <a type="button" href="./Contatti" class="btn btn-success btn-circle btn-lg" style="zoom: 1.5; margin:0;"><i class="fa fa-message"></i> </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <h4 class="mb-1">Grafici e statistiche</h4>
        <hr class="mb-4">
       
        <div class="row mt-4">
        <?php if ($Allenamento->getAllenamenti($auth->getUserId(), $db) != false) { ?>
            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Allenamenti mensili</h6>
                        <p class="text-sm "></p>
                        <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm"> Aggiornato <?=  date("d/m/Y", strtotime($Allenamento->getLastAllenamento($auth->getUserId(),$db)['ORA_FINE']))?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } if ($Prog) { ?>
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> Andamento peso </h6>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <?php $Peso = $Progressi->getPeso($db); ?>
                                <p class="mb-0 text-sm"> Ultimo aggiornato: <?= date("d/m/Y", strtotime($Peso[count($Peso) - 1]["DATA_PESO"])); ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <h4 class="mb-1">News</h4>
        <hr class="mb-4">
        <div class="row mt-4">
            <div class="col-lg-12 col-md-12 mt-4 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary text-center shadow-primary border-radius-lg py-3 pe-1">
                            <h3 class="text-light mx-3"><i class="fa-solid fa-newspaper"></i></i>&nbsp;&nbsp; Ultime news</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php $i = 0;
                                foreach ($Notizie->getNotizie($db) as $n) {
                                    $i++; ?>
                                    <div class="carousel-item <?php if ($i == 1) echo "active"; ?>">

                                        <div class="container d-block w-100" style="background-image: linear-gradient(rgb(255 255 255 / 82%), rgb(255 255 255 / 78%)), url(../Assets/assets/img/news.jpg); background-size: cover; min-height:300px;">
                                            <div class="container d-block w-100" style="height: 300px; overflow-y: auto;">

                                                <h2 class="text-dark text-center my-3"><?= $n['TITOLO'] ?></h2>
                                                <p class="text-dark text-center "><strong><?= $n['CORPO'] ?></strong></p>

                                            </div>
                                            <div class="row justify-content-end">

                                            </div>
                                        </div>
                                    </div>
                                <?php   }
                                if ($i == 0) echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessuna notizia</p>';

                                ?>

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" style="background-image: none;">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <h4 class="mb-1">Funzioni Rapide</h4>
        <hr class="mb-4">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Richieste non viste</p>

                            <h5 class="mb-0"> <?= $Richieste->countNewRichieste($db) ?> personali </h5>
                            <h5 class="mb-0"> <?= $Richieste->countNewRichiesteGen($db) ?> generiche </h5>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a class="mb-0" href="./Richieste.php">Clicca per accedere alle richieste</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Schede scadute</p>
                            <?php $scad = $Scheda->getSchedeScadute($db) ?>
                            <h4 class="mb-0"> <?= count($scad) ?></h4><!-- TODO vedere ultimo esercizio svolto -->
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a class="mb-0" href="./Scheda.php">Clicca per accedere alle schede</a>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="mt-3">News</h4>
        <hr class="mb-4">
        <div class="row mt-4">
            <div class="col-lg-12 col-md-12 mt-4 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary text-center shadow-primary border-radius-lg py-3 pe-1">


                            <h3 class="text-light mx-3"><i class="fa-solid fa-newspaper"></i>&nbsp;&nbsp; Ultime notizie</h3>

                            <div class="row justify-content-end">
                                <div class="col-auto mx-3 ">
                                    <button type='button' class="btn btn-white" style="z-index: 3000;" onclick='addNews()'>
                                        Nuova notizia &nbsp;&nbsp;<i class="fa-solid fa-newspaper"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php $i = 0;
                                foreach ($Notizie->getNotizie($db) as $n) {
                                    $i++; ?>
                                    <div class="carousel-item <?php if ($i == 1) echo "active"; ?>">

                                        <div class="container d-block w-100" style="background-image: linear-gradient(rgb(255 255 255 / 82%), rgb(255 255 255 / 78%)), url(../Assets/assets/img/news.jpg); background-size: cover; min-height:300px;">
                                            <div class="container d-block w-100" style="height: 300px; overflow-y: auto;">

                                                <h2 class="text-dark text-center my-3"><?= $n['TITOLO'] ?></h2>
                                                <p class="text-dark text-center "><strong><?= $n['CORPO'] ?></strong></p>

                                            </div>
                                            <div class="row justify-content-end">
                                                <div class="col-auto mx-3 ">
                                                    <button type='button' class="btn btn-danger" style="z-index: 3000;" onclick='delNews(<?= $n["ID_NOTIZIA"] ?>)'>
                                                        Elimina notizia&nbsp;&nbsp;<i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="col-auto mx-3 ">
                                                    <button type='button' class="btn btn-warning" style="z-index: 3000;" onclick="editNews(<?= $n['ID_NOTIZIA'] ?>,'<?= $n['TITOLO'] ?>','<?= $n['CORPO'] ?>')">
                                                        Modifica notizia&nbsp;&nbsp;<i class="fa-solid fa-pen"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php   }
                                if ($i == 0) echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessuna notizia</p>';

                                ?>

                            </div>
                            <button class="carousel-control-prev  my-8" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next  my-8" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" style="background-image: none;">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    include($View->getURL() . "/Footer.php");
    include($View->getURL() . "/Modal.php");
    include($View->getURL() . "/JS_Script.php");
    if ($Istruttore) {
    ?>
        <script>
            <?php if ($Richieste->checkRichiestaIstr("new", $db)) { ?>
                $('#textModal').text("Sono disponibili nuove richieste per te!");
                $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick=\'window.location.replace("../Public/Richieste")\'>Visualizza</button>');
                var ModalR = new bootstrap.Modal(document.getElementById('modal'), options);
                ModalR.show();
            <?php } else { ?>

            <?php  } ?>

            function addNews() {
                $('#labelNews').text("Nuova notizia");
                var ModalR = new bootstrap.Modal(document.getElementById('modalNews'), options);
                ModalR.show();
            }

            function editNews(id, title, corpo) {
                $("#user").val('updateNews');
                $("#title").val(title);
                $("#corpo").val(corpo);
                $("#idn").val(id);
                $('#labelNews').text("Modifica notizia");
                var ModalR = new bootstrap.Modal(document.getElementById('modalNews'), options);
                ModalR.show();
            }

            function saveNews() {
                user = $("user").val();
                title = $("title").val();
                corpo = $("corpo").val();
                idn = $("idn").val();
                form = $("#form-data-news");
                $.ajax({
                    type: 'POST',
                    url: '../Controller/Notizie.php',
                    data: form.serialize(), // serializes the form's elements.

                    success: function(data) {
                        
                        alert('News aggiunta/aggiornata');
                        location.reload();
                    }
                });
            }

            function delNews(id) {
                $('#textModal').text('Vuoi eliminare la notizia ? ');
                $('#modal').modal('show');
                if (!$('#conf').length) {
                    if ($('#confc').length) {
                        $('#confc').remove();
                    }
                    $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="conf">Conferma</button>');
                }
                $("#conf").click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '../Controller/Notizie.php',
                        dataType: 'text',
                        data: {

                            'user': 'delNews',
                            'id': id
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });
                });
            }
        </script>
    <?php
    } else {
    ?>
        <script>
            <?php if ($Richieste->checkRichiestaUser("complete", $db)) { ?>
                $('#textModal').text("Attenzione una richiesta è stata completata! Controlla le schede di allenamento!");
                $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick=\'cancelReq(<?= $Richieste->getRichiestaUser("complete", $db)['id_richiesta'] ?>)\'>Visualizza</button>');
                var ModalR = new bootstrap.Modal(document.getElementById('modal'), options);
                ModalR.show();

            <?php } else { ?>

            <?php  } ?>
        </script>
    <?php
    }
    ?>


</div>
</main>

</body>

</html>