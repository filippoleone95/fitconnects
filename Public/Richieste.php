<?php
if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/DashBoard.php");

?>

<div class="container-fluid py-4" id="pagecont">
    <div class="row">
        <?php
        if ($Istruttore) {
        ?>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Richieste schede</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container-fluid py-4">
                            <div class="row">
                                <div class="col-xl-12 table-responsive">
                                    <table class="table table-warning table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Atleta</th>
                                                <th class="text-center">Tipo richiesta</th>
                                                <th class="text-center">Stato richiesta</th>
                                                <th class="text-center">Segna come vista</th>
                                                <th class="text-center">Segna come completa</th>
                                                <th class="text-center">Vedi note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!$Amministratore){
                                                $Ric = $Richieste->getRichieste($db);
                                            }else{
                                                $Ric = $Richieste->getAllRichieste($db);
                                            }
                                            foreach ($Ric  as $r) {
                                                $p = $Profilo->getProfiloFromId($r["id_atleta"], $db);
                                                if($r["stato"] != "complete"){

                                            ?>

                                                <tr style="cursor: pointer;">

                                                    <td class="text-center" onclick="window.location.replace('../Public/Scheda?atl=<?= $r['id_atleta'] ?>')"><?= $p["nome"] . " " . $p["cognome"] ?></td>
                                                    <td class="text-center" onclick="window.location.replace('../Public/Scheda?atl=<?= $r['id_atleta'] ?>')"><?= $r["tipo_richiesta"] ?>  <?php if($r["id_scheda"] != '' && $r["id_scheda"] != 'NULL') echo ": <b>".$Scheda->getScheda($r["id_scheda"],$db)['nome_scheda']  ?></b>  </td>
                                                    <td class="text-center" onclick="window.location.replace('../Public/Scheda?atl=<?= $r['id_atleta'] ?>')">
                                                        <?php if ($r["stato"] == "new") {
                                                            echo " <span class=\"badge badge-sm bg-gradient-danger\">Nuova</span>";
                                                        }else if ($r["stato"] == "view"){
                                                            echo " <span class=\"badge badge-sm bg-gradient-info\">Vista</span>";
                                                        }else if ($r["stato"] == "complete"){
                                                            echo " <span class=\"badge badge-sm bg-gradient-success\">Completata</span>";
                                                        }
                                                             ?>
                                                    </td>
                                                    <td class="text-center" >
                                                        <button type='button' class="btn btn-info" style="" onclick="setView(<?= $r['id_richiesta']?>)">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type='button' class="btn btn-success" style="" onclick="complete(<?= $r['id_richiesta']?>)">
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($r['note'] != '' && $r['note'] != 'NULL'){?>
                                                            <button type='button' class="btn btn-success" style="" onclick="note('<?= $r['note']?>')">
                                                                <i class="fa-solid fa-note-sticky"></i>
                                                            </button>
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                            <?php
                                                }
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
        <?php
        }

        ?>

        <?php
        include($View->getURL() . "/Modal.php");
        include($View->getURL() . "/Footer.php");
        include($View->getURL() . "/JS_Script.php");
        ?>

        <script>
            /* Setta come vista  */
            function setView(idr) {
              
                $('#textModal').text('Vuoi segnare la richiesta come vista ? \n Non ti verrà più notificato nella home!');
                $('#modal').modal('show');
                if(!$('#conf').length){
                    if($('#confc').length){
                        $('#confc').remove();
                    }
                    $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="conf">Conferma</button>');
                }
               
                $( "#conf" ).click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '../Controller/Richieste.php',
                        data: {
                            
                            'idr' : idr ,
                            'user': 'setView'
                            
                        },
                        success: function(data) {
                            location.reload();
                            //console.log(data);
                        }
                    });
                });
            }
            function note (n){
                $('#label').text('Note');
                $('#textModal').text(n);
                $('#modal').modal('show');
            }
             /* Setta come completa  */
             function complete(idr) {
                console.log(idr);
                $('#textModal').text('Vuoi segnare la richiesta come completata ? La richiesta verrà eliminata e segnalato il completamento direttamente all\' atleta !');
                $('#modal').modal('show');
                if(!$('#confc').length){
                    if($('#conf').length){
                        $('#conf').remove();
                    }
                    $('#mod_foot').append('<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confc">Conferma</button>');
                }
                $( "#confc" ).click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '../Controller/Richieste.php',
                        data: {
                            
                            'idr' : idr ,
                            'user': 'complete'
                            
                        },
                        success: function(data) {
                            location.reload();
                            //console.log(data);
                        }
                    });
                });
            }
           
        </script>