<?php

namespace FitCon\Controller\EserciciziScheda;

use FitCon\Model\Profilo\Profilo;
use FitCon\Model\USer\User;
use FitCon\Model\EserciziScheda\EserciziScheda;

include "Includer.php";
require_once "../Model/Profilo.php";
require_once "../Model/User.php";

if (isset($_POST["user"]) &&  $_POST["user"] == 'insert') {
    if (EserciziScheda::insertEsInScheda($_POST["ripetizioni"],$_POST["serie"],$_POST["id_scheda"], $_POST["id_es"], $db)) {
        echo "true";
    };
}
if (isset($_POST['user']) && $_POST['user'] == 'deleteEsSch') {
    if (EserciziScheda::deleteEsInScheda($_POST["ids"], $_POST["ides"], $db)) {
      echo 'true';
    }
  }

if (isset($_POST["id"])) {
    $S =  $Scheda->getScheda($_POST["id"], $db);
?>

    <div class="card mt-4" style="background-color: #80808094;">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Scheda <?= $S['nome_scheda'] ?></h6>
                </div>
                <?php if($Istruttore){?>
                <div class="col-6 text-end">
                    <button type="button" class="btn bg-gradient-dark mb-2" onclick="addEsInScheda(<?= $_POST['id'] ?>)"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Aggiungi nuovo esercizio</button>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="card-body p-3">
            <?php
            $n = 0;
            foreach ($Gruppi->getGruppi($db) as $g) {
            ?>
                <div class="row">
                    
                    <?php
                    $Es = $Scheda->getEserciziInSchedaForGroup($_POST["id"], $g['id_gruppo'], $db);
                    if(!empty($Es))
                        echo "<h6 class=\"mb-0\"> ".$g["nome_gruppo"]." </h6>";
                    foreach ($Es as $E) {
                        $es_scheda = $Esercizi->getInfoEsercizio($E['id_esercizio'], $db);
                        $n ++;
                    ?>
                        <div class="col-md-4 mb-md-3 mb-4">
                            
                            <div class="card card-body border  border-radius-lg d-flex align-items-center flex-row mb-2" >
                                <div class="col-2">
                                    <div>
                                        <i class="material-icons">fitness_center</i>
                                    </div>
                                </div>
                                <div class="col-8" style="cursor: pointer;" onclick="openInfo(<?=$E['id_esercizio'] ?>)">
                                    <h6 class="mb-0"><?= $es_scheda['nome'] ?></h6>
                                    <h6 class="mb-0">Serie <?= $E['serie']?> x <?= $E['ripetizioni']?></h6>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-link text-secondary mb-0 dropdown-toggle" 
                                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" style="padding: 15px;">
                                        <i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i>
                                    </button>
                                    <?php if ($Istruttore){?>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><button class="dropdown-item" onclick="delEs(<?= $_POST['id']?> ,<?=$E['id_esercizio'] ?>)">Elimina dalla scheda</button></li>
                                        
                                    </ul>
                                    <?php } else {?>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        
                                    <li><button class="dropdown-item" onclick="storico(<?= $E['id_esercizio'] ?>)">Storico risultuati esercizio</button></li>
                                        <li><button class="dropdown-item" onclick="risultato(<?= $E['id_esercizio'] ?>)">Aggiungi nuovo risultuato</button></li>
                                    </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        
                        </div>
            <?php
                    }
            ?>
            </div>
        <?php
            }
            if($n == 0 ){
                echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessun esercizio per questa scheda</p>';
            }
        ?>
        </div>
    </div>

<?php
}

if (isset($_POST["idb"])) {
    $S =  $Scheda->getSchedaBase($_POST["idb"], $db);
?>

    <div class="card mt-4" style="background-color: #80808094;">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Scheda <?= $S['nome'] ?></h6>
                </div>
                <?php if($Istruttore){?>
                <div class="col-6 text-end">
                    <button type="button" class="btn bg-gradient-dark mb-2" onclick="addEsInSchedaB(<?= $_POST['idb'] ?>)"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Aggiungi nuovo esercizio</button>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="card-body p-3">
            <?php
            $n = 0;
            foreach ($Gruppi->getGruppi($db) as $g) {
            ?>
                <div class="row">
                    
                    <?php
                    $Es = $Scheda->getEserciziInSchedaBForGroup($_POST["idb"], $g['id_gruppo'], $db);
                    if(!empty($Es))
                        echo "<h6 class=\"mb-0\"> ".$g["nome_gruppo"]." </h6>";
                    foreach ($Es as $E) {
                        $es_scheda = $Esercizi->getInfoEsercizio($E['id_esercizio'], $db);
                        $n ++ ;
                    ?>
                        <div class="col-md-4 mb-md-3 mb-4">
                            
                            <div class="card card-body border  border-radius-lg d-flex align-items-center flex-row mb-2" >
                                <div class="col-2">
                                    <div>
                                        <i class="material-icons">fitness_center</i>
                                    </div>
                                </div>
                                <div class="col-8" style="cursor: pointer;" onclick="openInfo(<?=$E['id_esercizio'] ?>)">
                                    <h6 class="mb-0"><?= $es_scheda['nome'] ?></h6>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-link text-secondary mb-0 dropdown-toggle" 
                                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" style="padding: 15px;">
                                        <i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i>
                                    </button>
                                    <?php if ($Istruttore){?>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><button class="dropdown-item" onclick="delEsB(<?= $_POST['idb']?> ,<?=$E['id_esercizio'] ?>)">Elimina dalla scheda</button></li>
                
                                    </ul>
                                    <?php } else {?>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><button class="dropdown-item" onclick="storico(<?= $E['id_esercizio'] ?>)">Storico risultuati esercizio</button></li>
                                        <li><button class="dropdown-item" onclick="risultato(<?= $E['id_esercizio'] ?>)">Aggiungi nuovo risultuato</button></li>
                                    </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        
                        </div>
            <?php
                    }
            ?>
            </div>
        <?php
            }
            if($n == 0 ){
                echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessun esercizio per questa scheda</p>';
            }
        ?>
        </div>
    </div>

<?php
}

if (isset($_POST["user"]) &&  $_POST["user"] == 'insertB') {
    if (EserciziScheda::insertEsInSchedaB($_POST["id_scheda"], $_POST["id_es"], $db)) {
        echo "true";
    };
}
if (isset($_POST['user']) && $_POST['user'] == 'deleteEsSchB') {
    if (EserciziScheda::deleteEsInSchedaB($_POST["ids"], $_POST["ides"], $db)) {
      echo 'true';
    }
  }
?>