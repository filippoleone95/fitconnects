<?php
if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/Dashboard.php");

?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Gruppi Muscolari</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0" style="height: 200px; max-height: 250px;">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gruppo</th>
                                    <?php
                                    if ($Istruttore) {
                                    ?>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opzioni </th>
                                    <?php
                                    } else {
                                    ?>
                                       <!--  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Percentuale allenamento </th> -->
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($Gruppi->getGruppi($db) as $g) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2" style="cursor:pointer;" onclick='selGroup("<?= $g["nome_gruppo"] ?>",<?= $g["id_gruppo"] ?>)'>
                                                <div>
                                                    <i class="material-icons mx-4 my-1">fitness_center</i>
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 mx-2 text-sm"><?= $g["nome_gruppo"] ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                        if (!$Istruttore) {
                                        ?>
                                           <!--  <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span class="me-2 text-xs font-weight-bold">60%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td> -->
                                        <?php
                                        } else {
                                        ?>
                                            <td class="align-middle">
                                                <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                                    <i class="fa fa-ellipsis-v text-xs"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><button class="dropdown-item" onclick="delGr(<?= $g['id_gruppo'] ?>)">Elimina</button></li>
                                                    <li><button class="dropdown-item" onclick="editGr(<?= $g['id_gruppo'] ?>,'<?= $g['nome_gruppo'] ?>')">Modifica</button></li>
                                                </ul>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                if ($Istruttore) {
                ?>
                    <div class="card-footer p-3">

                        <button class="btn btn-warning text-light mb-0 rounded-circle" onclick="newGr()">
                            <i class="fa fa-plus fa-2x text-xs"></i>
                        </button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-xl-8 col-sm-12 mb-xl-0 mb-4" id="esSpace">
            <!-- CARD per lista esercizi -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-4" id="infoSpace">
                <!-- CARD per info esercizio -->
            </div>
        </div>
    </div>
</div>
<?php
include($View->getURL() . "/Footer.php");
include($View->getURL() . "/JS_Script.php");
include($View->getURL() . "/Modal.php");
?>

<script>
  
    function info() {
        alert("Codice che si trova alla fine dell' URL di youtube subito dopo l'uguale es. https://www.youtube.com/watch?v= i1nhJdeqfGg <-- Questo")
    }

    function newGr() {
        $('#labelGroup').text('Inserisci nuovo gruppo muscolare');
        $('#modalGroup').modal('show');
    }

    function newEs() {
        $('#labelEs').text('Inserisci nuovo esercizio');
        $('#modalEs').modal('show');
    }
    //Esercizi
    function saveEs() {
        val = $("#nomeEs").val();
        val2 = $("#desc").val();
        val3 = $("#code").val();
        val4 = $("#user2").val();
        val5 = $("#idGroupSelect").val();
        id = $("#id2").val();
        if (val == "" || val2 == "") {
            alert("Descrizione e nome non possono essere lasciati vuoti")
        } else {
            $.ajax({
                type: 'POST',
                url: '../Controller/Esercizi.php',
                data: {
                    'id': id,
                    'idgr': val5,
                    'nome': val,
                    'desc': val2,
                    'code': val3,
                    'user': val4,

                },
                success: function(data) {
                    //Caricaro le immagini se ci sono
                    if (data == "true") {
                        var fd = new FormData();
                        var files = $("#images").get(0).files; // this is my file input in which We can select multiple files.
                        fd.append("label", val);

                        for (var i = 0; i < files.length; i++) {
                            fd.append("UploadedImage" + i, files[i]);
                        }

                        $.ajax({
                            type: "POST",
                            url: '../Controller/Esercizi.php',
                            contentType: false,
                            processData: false,
                            data: fd,
                            success: function(e) {
                                if (e != "") {
                                    alert(e);
                                } else {
                                    alert("Esercizio creato/modificato correttamente!");
                                    location.reload();
                                }

                            }
                        });
                    }else{
                        alert(data);
                    }


                }
            });
        }
    }

    function isFileImage(file1) {
        var file = file1;
        var fileType = file["type"];
        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            return false;
        } else {
            return true;
        }
    }

    function selEser(id) {

        $.ajax({
            type: 'POST',
            url: '../Controller/Esercizi.php',
            data: {
                'idEs': id,
                'info': 'true'
            },
            success: function(data) {
                $("#main").animate({
                    scrollTop: 500
                }, 1000);
                $("#infoSpace").html(data);
            }
        });
    }

    function delEs(id,nome) {
        $('#textModal').text('Vuoi eliminare l\'esercizio ? L\' esercizio eliminato scomaparirirà da tutte le schede e con esso tutti i relativi risultati ottenuti dagli atleti !');
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
                url: '../Controller/Esercizi.php',
                dataType: 'text',
                data: {
                    'nome': nome,
                    'user': 'deleteEs',
                    'id': id
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
    }

    function editEs(nome, code, id) {
        $.ajax({
            type: 'POST',
            url: '../Controller/Esercizi.php',
            data: {
                'id' : id, 
                'user': 'info' 
            },
            success: function(data) {
                $("#desc").val(data);
            }
        });
        $("#nomeEs").val(nome);
        //$("#desc").val(desc);
        $("#code").val(code);
        $("#user2").val("updateEs");
        $("#id2").val(id);

        $('#labelEs').text('Modifica esercizio');
        $('#modalEs').modal('show'); 
    }

    // Gruppo
    function selGroup(nome, id) {
        $.ajax({
            type: 'POST',
            url: '../Controller/Esercizi.php',
            data: {
                'gruppoid': id,
                'gruppo': nome
            },
            success: function(data) {
                $("#esSpace").html(data);
            }
        });
    }

    function saveGr() {
        val = $("#nome").val();
        val2 = $("#user").val();
        id = $("#id").val();
        if (val == "") {
            alert("Nessun campo può essere lasciato vuoto")
        } else {
            $.ajax({
                type: 'POST',
                url: '../Controller/Esercizi.php',
                data: {
                    'id': id,
                    'user': val2,
                    'nome': val
                },
                success: function(data) {

                    location.reload();
                }
            });
        }
    }

    function delGr(id) {
        $('#textModal').text('Vuoi eliminare il gruppo muscolare ? Il gruppo eliminato scomaparirirà !');
        $('#modal').modal('show');
        if (!$('#confc').length) {
            if ($('#conf').length) {
                $('#conf').remove();
            }
            $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confc">Conferma</button>');
        }
        $("#confc").click(function() {
            $.ajax({
                type: 'POST',
                url: '../Controller/Esercizi.php',
                data: {
                    'user': 'delete',
                    'id': id
                },
                success: function(data) {
                    // location.reload();
                    if (data == 'true') {
                        location.reload();
                    } else {
                        alert('Impossibile eliminare gruppo poichè sono presenti esercizi collegati ad esso!');
                    }

                }
            });
        });
    }

    function editGr(id, nome) {
        $("#nome").val(nome);
        $("#user").val("update");
        $("#id").val(id);
        $('#labelGroup').text('Modifica gruppo muscolare');
        $('#modalGroup').modal('show');
    }
</script>