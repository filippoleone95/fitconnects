<?php

if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/Dashboard.php");

?>
<div class="container-fluid py-4" id="pagecont">
    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3 ">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h6 class="text-white text-capitalize ps-3" id="title_c">Archivio</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container-fluid py-4">
                            <div class="row">
                                <div class="col-xl-12 table-responsive">
                                    <table class="table table-info table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Scheda</th>
                                                <th class="text-center">Inizio</th>
                                                <th class="text-center">Fine</th>
                                                <th class="text-center">Elimina allenamento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($Allenamento->getAllenamenti($auth->getUserId(), $db) as $s) {
                                            ?>

                                                <tr style="cursor: pointer;">

                                                    <td class="text-center" onclick="info(<?= $s['id_scheda'] ?>,<?= $s['base'] ?>,<?= $s['id_allenamento'] ?>)"><?php if ($s['base'] == 1) {
                                                                                                                                                                        echo $Scheda->getSchedaBase($s["id_scheda"], $db)['nome'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $Scheda->getScheda($s["id_scheda"], $db)['nome_scheda'];
                                                                                                                                                                    }
                                                                                                                                                                    ?></td>
                                                    <td class="text-center" onclick="info(<?= $s['id_scheda'] ?>,<?= $s['base'] ?>,<?= $s['id_allenamento'] ?>)">
                                                        <?= date("d/m/Y H:i", strtotime($s["ora_inizio"])) ?></td>
                                                    <td class="text-center" onclick="info(<?= $s['id_scheda'] ?>,<?= $s['base'] ?>,<?= $s['id_allenamento'] ?>)">
                                                        <?= date("d/m/Y H:i", strtotime($s["ora_fine"])) ?></td>
                                                    <td class="text-center"><button type='button' class="btn btn-danger" style="z-index: 3000;" onclick='delAll(<?= $s["id_allenamento"] ?>) '>
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button></td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
include($View->getURL() . "/JS_Script.php");

?>
<script>
    function info(ids, b, ida) {

        $.ajax({
            type: 'POST',
            url: '../Controller/Allenamento.php',
            data: {
                'user': 'endAll',
                'notEnd': 1,
                'ids': ids,
                'base': b,
                'ida': ida
            },
            success: function(data) {
                if ($('#confdel').length) {
                    $('#confdel').remove();
                }
                $("#textModal").html(data);
                var ModalR = new bootstrap.Modal(document.getElementById('modal'), options);
                ModalR.show();



            }
        });
    }

    function delAll(ida) {
        $('#textModal').text('Sicuro di voler eliminare l\'allenamento selezionato?');
        $('#modal').modal('show');
        if (!$('#confdel').length) {
            $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confdel">Conferma</button>');
        }
        $("#confdel").click(function() {
            $.ajax({
                type: 'POST',
                url: '../Controller/Allenamento.php',
                data: {
                    'user': 'delAll',
                    'id_del': ida
                },
                success: function(data) {

                    location.reload();

                }
            });
        });

    }
</script>