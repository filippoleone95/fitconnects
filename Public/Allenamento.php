<?php /*  */
if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/Dashbord.php");
require("../Controller/Allenamento.php");



if (isset($_GET["id"])) {
    $S =  $Scheda->getScheda($_GET["id"], $db);
    $id = $_GET["id"];
    $b = "f";
}
if (isset($_GET["idb"])) {
    $S =  $Scheda->getSchedaBase($_GET["idb"], $db);
    $id = $_GET["idb"];
    $b = "t";
}
include($View->getURL() . "/JS_Script.php");


$idu = $auth->getUserId();

if ($Allenamento->check($idu, $db)) {
    $Allenamento->del($idu, $db);
}

?>
<div class="container-fluid py-4">
    <h4 class="mb-1">Modalità allenamento</h4>
    <hr class="mb-4">
    <div class="row mt-4">
        <div class="col-lg-6 col-md-6 my-3">

            <div class="card mt-4" style="background-color: #80808094;">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-light text-center shadow-light border-radius-lg py-3 pe-1">
                        <div class="col-6 d-flex align-items-center mx-2">
                            <?php if (isset($_GET["id"])) {
                                echo "<h6 class=\"mb-0\">Scheda  " . $S['nome_scheda'] . "</h6>";
                            } else if (isset($_GET["idb"])) {
                                echo "<h6 class=\"mb-0\">Scheda  " . $S['nome'] . "</h6>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <?php
                    $n = 0;
                    foreach ($Gruppi->getGruppi($db) as $g) {
                    ?>
                        <div class="row">
                            <?php
                            if (isset($_GET["id"])) {
                                $Es = $Scheda->getEserciziInSchedaForGroup($id, $g['id_gruppo'], $db);
                            } else if (isset($_GET["idb"])) {
                                $Es = $Scheda->getEserciziInSchedaBForGroup($id, $g['id_gruppo'], $db);
                            }

                            if (!empty($Es))
                                echo "<h6 class=\"mb-0\"> " . $g["nome_gruppo"] . " </h6>";
                            foreach ($Es as $E) {
                                $es_scheda = $Esercizi->getInfoEsercizio($E['id_esercizio'], $db);
                                $n++;
                            ?>
                                <div class="col-auto mb-md-3 mb-3">
                                    <div class="card card-body border  border-radius-lg d-flex align-items-center flex-row mb-2" id="card<?= $E['id_esercizio'] ?>">
                                        <div class="col-2">
                                            <div>
                                                <i class="material-icons">fitness_center</i>
                                            </div>
                                        </div>
                                        <div class="col-8" style="cursor: pointer;" onclick="openInfo(<?= $E['id_esercizio'] ?>)">
                                            <h6 class="mb-0"><?= $es_scheda['nome'] ?></h6>
                                            <?php if($b == "f"){?><h6 class="mb-0">Serie <?= $E['serie']?> x <?= $E['ripetizioni']?></h6><?php }?>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" style="padding: 15px;">
                                                <i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i>
                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><button class="dropdown-item" onclick="storico(<?= $E['id_esercizio'] ?>)">Storico risultuati esercizio</button></li>
                                                <li><button class="dropdown-item" onclick="risultato(<?= $E['id_esercizio'] ?>)">Aggiungi nuovo risultuato</button></li>
                                                <li><button class="dropdown-item" onclick="set('fatto',<?= $E['id_esercizio'] ?>)">Setta come fatto</button></li>
                                                <li><button class="dropdown-item" onclick="set('ignorato',<?= $E['id_esercizio'] ?>)">Setta come ignorato</button></li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    if ($n == 0) {
                        echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessun esercizio per questa scheda</p>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 my-3">

            <div class="card mt-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-warning text-center shadow-light border-radius-lg py-3 pe-1">
                        <div class="col-6 d-flex align-items-center mx-2">
                            <h6 class="mb-0">Utilità</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">

                        <div class="col-md-6 col-sm-12 mb-md-3 mb-4">
                            <h6 class="mb-0">Countdown</h6>
                            <div class="card card-body border  border-radius-lg d-flex align-items-center flex-row mb-2">
                                <div class="col-1 mx-2">
                                    <div>
                                        <i class="fa-solid fa-play" style="cursor: pointer;" id="countIcon" onclick="countdown()"></i>
                                    </div>
                                </div>

                                <div class="col-1  mx-2">
                                    <div>
                                        <i class="fa-solid fa-pause" style="cursor: pointer;" id="countIcon" onclick="countdownPause()"></i>
                                    </div>
                                </div>

                                <div class="col-5 text-center" style="cursor: pointer;">
                                    <h6 class="mb-0" id="countdown"> 00 : 00</h6>
                                </div>

                                <div class="col-1  mx-3">
                                    <div>
                                        <i class="fa-solid  fa-trash" style="cursor: pointer;" id="countIcon" onclick="countdownDel()"></i>
                                    </div>
                                </div>

                                <div class="col-1 mx-2">
                                    <div>
                                        <i class="fa-solid  fa-clock-rotate-left" style="cursor: pointer;" id="countIcon" onclick="countdownReset()"></i>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 mb-md-3 mb-4">
                            <h6 class="mb-0">Cronometro</h6>
                            <div class="card card-body border  border-radius-lg d-flex align-items-center flex-row mb-2">
                                <div class="col-1 mx-2">
                                    <div>
                                        <i class="fa-solid fa-play" style="cursor: pointer;" id="countIcon" onclick="cronometro()"></i>
                                    </div>
                                </div>

                                <div class="col-1  mx-2">
                                    <div>
                                        <i class="fa-solid fa-pause" style="cursor: pointer;" id="countIcon" onclick="cronometroPause()"></i>
                                    </div>
                                </div>

                                <div class="col-5 text-center" style="cursor: pointer;">
                                    <h6 class="mb-0" id="cronometro"> 00 : 00</h6>
                                </div>

                                <div class="col-1  mx-3">
                                    <div>
                                        <i class="fa-solid  fa-trash" style="cursor: pointer;" id="countIcon" onclick="cronometroDel()"></i>
                                    </div>
                                </div>

                                <div class="col-1 mx-2">
                                    <div>
                                        <i class="fa-solid  fa-clock-rotate-left" style="cursor: pointer;" id="countIcon" onclick="cronometroReset()"></i>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-md-3 mb-4">
                            <h6 class="mb-0">Stepper</h6>
                            <div class="card card-body border  border-radius-lg d-flex align-items-center flex-row mb-2">
                                <div class="col-1 mx-3">
                                    <div>
                                        <i class="fa-solid  fa-clock-rotate-left fa-2x" style="cursor: pointer;" id="countIcon" onclick="counterReset()"></i>
                                    </div>
                                </div>
                                <div class="col-1 mx-2">
                                    <div>
                                        <i class="fa-solid fa-hand-pointer fa-2x" style="cursor: pointer;" id="countIcon" onclick="counter()"></i>
                                    </div>
                                </div>




                                <div class="col-9" style="cursor: pointer;" onclick="counter()">
                                    <h1 class="mb-0 text-center " id="contatore"> 0</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php

include($View->getURL() . "/Footer.php");
include($View->getURL() . "/Modal.php");

?>
<script src="<?= $Lib->getURL() ?>/timer/build/jquery.runner.js" type="text/javascript"></script>
<script>
    window.start = "0";

    window.onbeforeunload = function() {
        if (window.start != "0") return "Se lasci la pagina ,l 'allenamento andrà perso";
    };

    $(function() {

        $("#closeBtn").on('click', function() {
            if (window.start == "0") {
                window.location.replace("../Public/Dashbord");
            }
        });

    });

    function openInfo(id) {
        $.ajax({
            type: 'POST',
            url: '../Controller/Esercizi.php',
            data: {
                'idEs': id,
                'info': 'true'
            },
            success: function(data) {
                /* $("#main").animate({ scrollTop: 500 },1000); */
                $("#infoSpace").html(data);
                $('#modalInfoEs').modal('show');
            }
        });
    }

    <?php if (!$Allenamento->check($idu, $db)) { ?>
        $('#textModalAll').text("Iniziare l'allenamento?");
        $('#mod_foot_all').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="startBtn" onclick=\'startAllenamento()\'>Inizia</button>');
        var ModalR = new bootstrap.Modal(document.getElementById('modalAll'), {
            backdrop: 'static',
            keyboard: false
        });
        ModalR.show();
    <?php } else { ?>

    <?php  } ?>


    function set(set, ide) {

        $.ajax({
            type: 'POST',
            url: '../Controller/Allenamento.php',
            data: {
                'user': set,
                'ide': ide,
                'ida': window.ida
            },
            success: function(data) {
                console.log(data);
                if (set == "fatto") {
                    $('#card' + ide).css("background-color", "#8fff8fd6");
                } else {
                    $('#card' + ide).css("background-color", "#ff7c7cb8");
                }


            }
        });
    }
        //Risultati esercizio
    function risultato(ide) {
        var ModalR = new bootstrap.Modal(document.getElementById('modalRisultati'), options);
        ModalR.show();

        $('#ide').val(ide);


    }
    $(function() {
        $("#saveRis").on('click', function() {
            form = $("#form-data");

            $.ajax({
                type: 'POST',
                url: '../Controller/Risultati.php',
                data: form.serialize(), // serializes the form's elements.

                success: function(data) {
                    console.log(data);
                }
            });
        });
    });
    function storico(ide) {
        $.ajax({
            type: 'POST',
            url: '../Controller/Risultati.php',
            data: {
                'userR': 'storico',
                'ide': ide,
            }, // serializes the form's elements.

            success: function(data) {
                if ($('#startBtn').length) {
                    $('#startBtn').remove();
                }
                if ($('#endBtn').length) {
                    $('#endBtn').remove();
                }
                $("#textModalAll").html(data);
                $('#modalAll').modal('show');
            }
        });
    }

    function startAllenamento() {

        window.start = "1";
        $.ajax({
            type: 'POST',
            url: '../Controller/Allenamento.php',
            data: {
                'user': 'newAll',
                'ids': '<?= $id ?>'
            },
            success: function(data) {
                
                window.ida = data;
                $('#time').runner({
                    milliseconds: false,
                });
                $('#time').runner('start');
                $('#textModal').text('Buon lavoro!');
                $('#label').text('Allenamento iniziato');
                $('#modal').modal('show');
            }
        });
    }

    function endAll() {
        $('#label').text('Terminare l\'allenamento?');
        $('#textModal').text("Verrano salvate tutte le informazioni inserite durante l'allenamento");
        if ($('#startBtn').length) {
            $('#startBtn').remove();
        }
        if ($('#endBtn').length) {
            $('#endBtn').remove();
        }

        $('#mod_foot').append('<button type="button" class="btn btn-primary"  data-bs-dismiss="modal" id="endBtn" onclick=\'end()\'>Termina</button>');
        var ModalR = new bootstrap.Modal(document.getElementById('modal'), options);
        ModalR.show();
    }

    function end() {

        $('#time').runner('stop');

        $.ajax({
            type: 'POST',
            url: '../Controller/Allenamento.php',
            data: {
                'user': 'endAll',
                'ids': '<?= $id ?>',
                'base': '<?= $b ?>',
                'ida': window.ida
            },
            success: function(data) {


                window.start = "0";
                if ($('#startBtn').length) {
                    $('#startBtn').remove();
                }
                if ($('#endBtn').length) {
                    $('#endBtn').remove();
                }

                $("#textModalAll").html(data);
                var ModalR = new bootstrap.Modal(document.getElementById('modalAll'), {
                    backdrop: 'static',
                    keyboard: false
                });
                ModalR.show();



            }
        });
    }

    /* Utility */
    $('#countdown').runner('');
    $('#cronometro').runner('');
    $contatore = 0;

    function countdown() {
        if ($('#countdown').runner('info').settings.stopAt != 0) {
            $('#labelUt').text('Countdown');


            if ($('#btnStartC').length) {
                $('#btnStartC').remove();
            }
            $('#mod_foot_ut').append('<button type="button" class="btn btn-primary"  data-bs-dismiss="modal" id="btnStartC" onclick=\'startCountdown()\'>Start</button>');
            var ModalR = new bootstrap.Modal(document.getElementById('modalUt'), options);
            ModalR.show();
        } else {
            $('#countdown').runner('start');
        }

    }

    function startCountdown() {


        if ($('#min').val() > 99 || $('#sec').val() > 59) {
            alert('Rispettare i valori massimi ,valore Massimo per i minuti 99 e per i secondi 59 ');
            countdown();
            return;
        }
        r = Number($('#min').val() * 60) + Number($('#sec').val());

        $('#countdown').runner({
            milliseconds: false,
            countdown: true,
            startAt: r * 1000, // alternatively you could just write: 60*1000
            stopAt: 0
        });
        $('#countdown').runner('start');

    }

    function countdownPause() {

        $('#countdown').runner('stop');
    }

    function countdownReset() {

        $('#countdown').runner('reset');
    }

    function countdownDel() {
        $('#countdown').runner('info').settings.stopAt = null;
        $('#countdown').runner('info').settings.startAt = 0;
        $('#countdown').runner('stop');
        $('#countdown').html("00:00");

    }
    /* Cronometro */
    function cronometro() {

        $('#cronometro').runner('start');
    }

    function cronometroPause() {

        $('#cronometro').runner('stop');
    }

    function cronometroReset() {

        $('#cronometro').runner('reset');
    }

    function cronometroDel() {
        $('#cronometro').runner('reset');
        $('#cronometro').runner('stop');
        $('#cronometro').html("00:00");

    }

    /* Counter */
    function counter() {
        $contatore++;
        $('#contatore').text($contatore);
    }

    function counterReset() {
        $contatore = 0;
        $('#contatore').text($contatore);
    }
</script>