<?php

namespace FitCon\Controller\Allenamento;


require_once "Includer.php";



if (isset($_POST['user']) && $_POST['user'] == "newAll") {
    if ($Allenamento->newAll($auth->getUserId(), $_POST['ids'], $db)) {
        echo $Allenamento->getAllenamento($auth->getUserId(), $db)['id_allenamento'];
    }
}


if (isset($_POST['user']) && $_POST['user'] == "endAll") {

    if (!isset($_POST['notEnd'])) {
        $Allenamento->endAll( $_POST['ida'],$_POST['base'], $db);
    }
?>
        <div class="card card-plain h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Riepilogo</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <div class="row">
                            <div class="col-4">
                                <strong class="text-dark">Esercizi svolti:</strong>
                            </div>
                            <div class="col-8">
                                <?php
                                foreach ($Allenamento->getEsFatto($_POST['ida'], $db) as $ef) {
                                    echo "- ".$Esercizi->getInfoEsercizio($ef['id_esercizio'], $db)['nome'] . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><div class="row">
                            <div class="col-4">
                                <strong class="text-dark">Esercizi ignorati:</strong>
                            </div>
                            <div class="col-8">
                                <?php
                                foreach ($Allenamento->getEsIgnorato($_POST['ida'], $db) as $ef) {
                                    echo "- ".$Esercizi->getInfoEsercizio($ef['id_esercizio'], $db)['nome'] . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><div class="row">
                            <div class="col-4">
                                <strong class="text-dark">Esercizi tralasciati:</strong>
                            </div>
                            <div class="col-8">
                                <?php
                                foreach ($Allenamento->getEsTralasciato($_POST['ids'],$_POST['base'],$_POST['ida'], $db) as $ef) {
                                    echo "- ".$Esercizi->getInfoEsercizio($ef['id_esercizio'], $db)['nome'] . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><div class="row">
                            <div class="col-4">
                                <strong class="text-dark">Ora inizio:</strong>
                            </div>
                            <div class="col-8">
                                <?php
                                    echo date("d/m/Y H:i", strtotime($Allenamento->getAllenamentoEnd($_POST['ida'], $db)['ora_inizio']));

                                ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><div class="row">
                            <div class="col-4">
                                <strong class="text-dark">Ora fine:</strong>
                            </div>
                            <div class="col-8">
                                <?php
                                    echo date("d/m/Y H:i", strtotime($Allenamento->getAllenamentoEnd($_POST['ida'], $db)['ora_fine']));
                                ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
<?php
    
}

if (isset($_POST['getAllenamenti']) && $_POST['getAllenamenti'] == "true") {
    
        echo json_encode($Allenamento->getAllenamentiForMonth($auth->getUserId(),$db));
    
}

if (isset($_POST['user']) && $_POST['user'] == "fatto") {
    if ($Allenamento->esFatto($_POST['ide'], $_POST['ida'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "delAll") {
    if ($Allenamento->delAll($_POST['id_del'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "ignorato") {
    if ($Allenamento->esIgnorato($_POST['ide'], $_POST['ida'], $db)) {
        echo "true";
    }
}
