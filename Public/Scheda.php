<?php
if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/Dashboard.php");

?>

<div class="container-fluid py-4" id="pagecont">
    <div class="row">
        <?php

        if (!$Istruttore) {
            $schede = $Scheda->getSchede($db);
            if (empty($schede)) {
        ?>
                <p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>La tua scheda personale è in elaborazione , puoi nel frattempo utilizzare una scheda standard per iniziare ad allenarti</p>
            <?php  } ?>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3 ">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <h6 class="text-white text-capitalize ps-3" id="title_c">Schede</h6>
                                </div>
                                <div class="col-auto row">
                                    <div class="col-auto">
                                        <button type="button" class="btn bg-gradient-danger mb-2 mx-3" onclick="schedePers()"> Schede Personali &nbsp;&nbsp;<i class="fa-solid fa-person-running"></i></button>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn bg-gradient-info mb-2 mx-3" onclick="schedeB()" id="btnSwitch"><span id="txtbtnSwitch">Schede base</span> &nbsp;&nbsp;<i class="fa-solid fa-layer-group"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="row " id="switcher">

                            </div>
                        </div>
                    </div>
                </div>

            <?php } else {  // Schede ISTUTTORE 
            ?>

                <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3 ">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <h6 class="text-white text-capitalize ps-3" id="title_c">Scegli atleta</h6>
                                    </div>
                                    <div class="col-auto row">
                                        <div class="col-auto">
                                            <button type="button" class="btn bg-gradient-info mb-2 mx-3" onclick="schedeBase()" id="btnSwitch"><span id="txtbtnSwitch">Schede base</span> &nbsp;&nbsp;<i class="fa-solid fa-layer-group"></i></button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn bg-gradient-danger mb-2 mx-3" onclick="schedeScad()"> Schede scadute &nbsp;&nbsp;<i class="fa-solid fa-bell"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body px-0 pb-2">

                            <div class="row justify-content-center">
                                <div class="col-11">
                                    <h3 class="" >Scegliere un atleta dall' elenco sottostante</h3>
                                    <form autocomplete="off" method="POST" class="text-start" id="s_space">
                                        <div class="input-group input-group-outline my-3 is-filled">

                                            <label class="form-label" for="atleta">Atleti</label>

                                            <select class="form-select form-control" id="atleta" name="atleta">
                                                <option value="">Clicca per scegliere un atleta</option>
                                                <?php
                                                foreach ($Atleti as $row) {
                                                    $p = $Profilo->getProfiloFromId($row["id"], $db);
                                                    if ($Profilo::checkProfilo($row["id"],$db)){
                                                        echo "<option value=\"" . $row["id"] . "\">" . $p["nome"]." ". $p["cognome"] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="container-fluid py-4" style="z-index: 1000;">
                                            <div class="row">
                                                <div class="col-xl-12 table-responsive" id='cardSpace'>

                                                    <!--  Table in controller -->
                                                </div>
                                            </div>
                                            <div class="row justify-content-end">

                                                <div class="col-auto">
                                                    <button type="button" class="btn bg-gradient-warning mt-2" id="btnAddSch" onclick="addScheda()" >
                                                    Aggiungi nuova scheda &nbsp;&nbsp;<i class="material-icons text-sm">add</i></button>
                                                </div>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
        }
            ?>
            <div class="col-md-12 mb-lg-0 mb-4" id="schedaSpace">
                <!--  Card esercizi in scheda -->
            </div>


            <?php
            include($View->getURL() . "/Modal.php");
            include($View->getURL() . "/Footer.php");
            include($View->getURL() . "/JS_Script.php");
            ?>

            <script>
                <?php if (!$Istruttore) {
                    if (empty($schede)) { ?>
                        schedeB();
                    <?php } else { ?>
                        schedePers();
                    <?php } ?>

                    /*Schede lato User  */
                    function schedeB() {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/Scheda.php',
                            data: {

                                'user': 'switchBase'
                            },
                            success: function(data) {
                                $("#schedaSpace").html("");
                                $('#title_c').text('Schede base');
                                $("#switcher").html(data);

                            }
                        });

                    }

                    function schedePers() {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/Scheda.php',
                            data: {

                                'user': 'switchPers'
                            },
                            success: function(data) {
                                $("#schedaSpace").html("");
                                $('#title_c').text('Schede personali');
                                $("#switcher").html(data);

                            }
                        });

                    }

                    function modReq(ids, idi) {
                        $('#idS').val(ids);
                        $('#idi').val(idi);
                        $('#labelReq').text('Invia nuova richiesta');
                        $('#modalModReq').modal('show');
                    }

                    function sendReq() {

                        n = $('#note').val();
                        i = $('#istruttore').val();
                        ids =  $('#idS').val();
                        if (i == '') {
                            i = $('#idi').val();
                        }
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/Richieste.php',
                            data: {
                                'ids': ids,
                                'note': n,
                                'istr': i,
                                'user': 'editReq'
                            },
                            success: function(data) {
                                console.log(data);
                                $('#label').text('Richiesta inviata correttamente');
                                $('#modalDialog').css( "display", "block" );
                                $('#modal').modal('show');
                            }
                        });

                    }
                    //Funzionalità per i risultati
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
                                'userR': 'storicoEdit',
                                'ide': ide,
                            }, // serializes the form's elements.

                            success: function(data) {
                                if (!$('#confdel').length) {
                                    $('#confdel').remove();
                                }
                                 
                                $("#textModal").html(data);
                                
                                $('#modal').modal('show');
                            }
                        });
                    }

                    function delRis(id) {
                        $('#textModal').text('Sicuro di voler eliminare il risultato?');
                        $('#modalDialog').css( "display", "block" );
                        $('#modal').modal('show');
                        if (!$('#confdel').length) {
                            $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confdel">Conferma</button>');
                        }
                        $("#confdel").click(function() {
                            $.ajax({
                                type: 'POST',
                                url: '../Controller/Risultato.php',
                                data: {
                                    'userR': 'deleteRis',
                                    'id_del': id
                                },
                                success: function(data) {
                                    getSch();

                                }
                            });
                        });
                    }

                <?php } ?> //Scheda lato Istruttore
                /*Schede Base  */
                function schedeBase() {
                    $.ajax({
                        type: 'POST',
                        url: '../Controller/Scheda.php',
                        data: {

                            'base': 'true'
                        },
                        success: function(data) {
                            $('.fa-layer-group').addClass('fa-person-running').removeClass('fa-layer-group');
                            $('#txtbtnSwitch').text('Schede atleti');
                            $("#btnSwitch").attr("onclick", "location.reload()");
                            $('#title_c').text('Schede base');
                            $("#s_space").html(data);
                            $("#schedaSpace").html("");
                        }
                    });

                }

                function addSchedaB() {

                    $('#labelSchedaB').text('Inserisci nuova scheda');
                    $('#modalSchedaB').modal('show');
                }

                function delSchB(id) {
                    $('#textModal').text('Sicuro di voler eliminare la scheda selezionata?');
                    
                    $('#modal').modal('show');
                    if (!$('#confdel').length) {
                        $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confdel">Conferma</button>');
                    }
                    $("#confdel").click(function() {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/Scheda.php',
                            data: {
                                'user': 'deleteSchB',
                                'id_del': id
                            },
                            success: function(data) {
                                console.log(data);
                                schedeBase();

                            }
                        });
                    });
                }

                function editSchB(id, nome, amin, amax, sex) {
                    $("#nome_b").val(nome);
                    $("#amin").val(amin);
                    $("#amax").val(amax);

                    $("#sex").val(sex);
                    $("#userB").val("updateSchB");
                    $("#idS").val(id);
                    $('#labelSchedaB').text('Modifica info scheda');
                    $('#modalSchedaB').modal('show');
                }

                function saveSchedaB() {
                    val = $("#nome_b").val();
                    val2 = $("#amin").val();
                    val3 = $("#amax").val();
                    val4 = $("#sex").val();
                    val5 = $("#userB").val();


                    id = $("#idS").val();
                    if (val == "" || val2 == "" || val3 == "") {

                        alert("Nessun campo può essere lasciato vuoto")
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/Scheda.php',
                            data: {
                                'idS': id,

                                'user': val5,
                                'nome': val,
                                'amin': val2,
                                'amax': val3,
                                'sex': val4,

                            },
                            success: function(data) {
                                console.log(data);
                                schedeBase();
                            }
                        });
                    }
                }

                function openEsB(id) {

                    $.ajax({
                        type: 'POST',
                        url: '../Controller/EserciziScheda.php',
                        data: {

                            'idb': id
                        },
                        success: function(data) {

                            $("#schedaSpace").html(data);

                            $("#main").animate({
                                scrollTop: 500
                            }, 1000);

                        }
                    });
                }

                function addEsInSchedaB(id) {
                    $("#idScheda").val(id);
                    $('#labelEsInScheda').text('Inserisci esercizio nella scheda');
                    $("#btnAddEs").attr("onclick", "saveEsB()");
                    $('#modalEsScheda').modal('show');
                }

                function saveEsB() {

                    val = $("#es").val();
                    val2 = $("#idScheda").val();

                    $.ajax({
                        type: 'POST',
                        url: '../Controller/EserciziScheda.php',
                        data: {
                            'user': 'insertB',
                            'id_scheda': val2,
                            'id_es': val
                        },
                        success: function(data) {
                            console.log(data);
                            $('#modalEsScheda').modal('hide');
                            openEsB(val2);
                        }
                    });
                }

                function delEsB(ids, ides) {
                    $('#textModal').text('Sicuro di voler eliminare l\' esercizio dalla scheda?');
                    
                    $('#modal').modal('show');
                    if (!$('#confdel').length) {
                    $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confdel">Conferma</button>');
                    }
                    $("#confdel").click(function() {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/EserciziScheda.php',
                            data: {
                                'user': 'deleteEsSchB',
                                'ids': ids,
                                'ides': ides
                            },
                            success: function(data) {
                                openEsB(ids);

                            }
                        });
                    });
                }


                /*Schede Nomrmali  */
                <?php if (isset($_GET['atl'])) {
                    echo "$(\"#atleta\").val(" . $_GET['atl'] . ")";
                } ?>

                function schedeScad() {

                    $('#labelScad').text('Visualizza schede scadute');
                    $('#modalScad').modal('show');
                }

                /* Funzionalità relative agli esercizi nella scheda */
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

                function saveEs() {

                    val = $("#es").val();
                    val2 = $("#idScheda").val();
                    val3 = $("#serie").val();
                    val4 = $("#ripetizioni").val();

                    $.ajax({
                        type: 'POST',
                        url: '../Controller/EserciziScheda.php',
                        data: {
                            'user': 'insert',
                            'serie': val3,
                            'ripetizioni': val4,
                            'id_scheda': val2,
                            'id_es': val
                        },
                        success: function(data) {
                            console.log(data);
                            $('#modalEsScheda').modal('hide');
                            openEs(val2);
                        }
                    });
                }

                function addEsInScheda(id) {
                    $("#idScheda").val(id);
                    $('#labelEsInScheda').text('Inserisci esercizio nella scheda');
                    $('#modalEsScheda').modal('show');
                }

                function delEs(ids, ides) {
                    $('#textModal').text('Sicuro di voler eliminare l\' esercizio dalla scheda?');
                    $('#modal').modal('show');
                    if (!$('#confdel').length) {
                    $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confdel">Conferma</button>');
                    }
                    $("#confdel").click(function() {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/EserciziScheda.php',
                            data: {
                                'user': 'deleteEsSch',
                                'ids': ids,
                                'ides': ides
                            },
                            success: function(data) {
                                openEs(ids);

                            }
                        });
                    });
                }

                function openEs(id) {

                    $.ajax({
                        type: 'POST',
                        url: '../Controller/EserciziScheda.php',
                        data: {

                            'id': id
                        },
                        success: function(data) {

                            $("#schedaSpace").html(data);

                            $("#main").animate({
                                scrollTop: 500
                            }, 1000);

                        }
                    });
                }


                /* Funzionalità scheda aggiunta , eliminazione ,modifica e salvataggio */
                function addScheda(id) {
                    val = $("#atleta").val();
                    $("#idu").val(val);
                    $('#labelScheda').text('Inserisci nuova scheda');
                    $('#modalScheda').modal('show');
                }

                function delSch(id) {
                    $('#textModal').text('Sicuro di voler eliminare la scheda selezionata?');
                    $('#modal').modal('show');
                    if (!$('#confdel').length) {
                    $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confdel">Conferma</button>');
                    }
                    $("#confdel").click(function() {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/Scheda.php',
                            data: {
                                'user': 'deleteSch',
                                'id_del': id
                            },
                            success: function(data) {
                                getSch();

                            }
                        });
                    });
                }

                function editSch(id, nome, datai, datas, attiva) {
                    $("#nome").val(nome);
                    $("#dataI").val(datai);
                    $("#dataS").val(datas);
                    if (attiva == 1) {
                        $("#attiva").prop("checked", true)
                    } else {
                        $("#attiva").prop("checked", false)
                    };
                    $("#attiva").val("attiva");
                    $("#user").val("updateSch");
                    $("#idS").val(id);
                    $('#labelScheda').text('Modifica info scheda');
                    $('#modalScheda').modal('show');
                }

                function saveScheda() {
                    val = $("#nome").val();
                    val2 = $("#dataI").val();
                    val3 = $("#dataS").val();
                    if ($("#attiva").is(":checked")) {
                        val4 = 1
                    } else {
                        val4 = 0
                    };
                    val5 = $("#user").val();
                    val6 = $("#idu").val();

                    id = $("#idS").val();
                    if (val == "" || val2 == "" || val3 == "") {
                        alert("Nessun campo può essere lasciato vuoto")
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '../Controller/Scheda.php',
                            data: {
                                'idS': id,
                                'idu': val6,
                                'user': val5,
                                'nome': val,
                                'dataI': val2,
                                'dataS': val3,
                                'attiva': val4,

                            },
                            success: function(data) {

                                getSch();
                            }
                        });
                    }
                }

                /* Scelta del gruppo e cambio dell' esercizio */
                var val = $("#gruppo").val();
                $.ajax({
                    type: 'POST',
                    url: '../Controller/Scheda.php',
                    data: {
                        'gruppo': val
                    },
                    success: function(data) {

                        $("#es").html(data);
                    }
                });

                $('#gruppo').change(function() {
                    var val = $(this).val();
                    // alert(val);
                    $.ajax({
                        type: 'POST',
                        url: '../Controller/Scheda.php',
                        data: {
                            'gruppo': val
                        },
                        success: function(data) {

                            $("#es").html(data);
                        }
                    });

                });

                getSch();
                /* Scelta dell'atleta  e cambio della lista delle schede*/
                function getSch() {
                    var val = $("#atleta").val();
                    $.ajax({
                        type: 'POST',
                        url: '../Controller/Scheda.php',
                        data: {
                            'id': val
                        },
                        success: function(data) {

                            $("#cardSpace").html(data);
                        }
                    });
                }

                if($('#atleta').val() == ""){
                         $("#btnAddSch").css("display","none");
                    }else{
                        $("#btnAddSch").show();
                    }
                $('#atleta').change(function() {
                    var val = $(this).val();
                    if(val == ""){
                         $("#btnAddSch").hide();
                    }else{
                        $("#btnAddSch").show();
                    }
                    // alert(val);
                    $.ajax({
                        type: 'POST',
                        url: '../Controller/Scheda.php',
                        data: {
                            'id': val
                        },
                        success: function(data) {

                            $("#cardSpace").html(data);
                            $("#schedaSpace").html('');
                        }
                    });

                });
            </script>