<?php

namespace FitCon\Controller\Esercizi;

use FitCon\Model\Esercizio\Esercizio;
use FitCon\Model\Gruppo\Gruppo;
use PDO;

include "Includer.php";
require_once "../Model/Profilo.php";
require_once "../Model/User.php";
require_once "../Model/Esercizio.php";
require_once "../Model/Gruppo.php";



//Ajax Gruppi Muscolari
if (isset($_POST['user']) && $_POST['user'] == "newGrup") {
    if ($Gruppi->insertGruppo($_POST['nome'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "delete") {
    if ($Gruppi->deleteGruppo($_POST['id'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "update") {
    if ($Gruppi->updateGruppo($_POST['id'], $_POST['nome'], $db)) {
        echo "true";
    }
}

//Ajax  Esercizi
if (isset($_POST['user']) && $_POST['user'] == "newEs") {
    if ($Esercizi->insertEsercizi($_POST['nome'], $_POST['desc'], $_POST['code'], $_POST['idgr'], $db)) {

        echo "true";
    }
}


if (isset($_POST['user']) && $_POST['user'] == "deleteEs") {
    if ($Esercizi->deleteEsercizio($_POST['id'], $db)) {
        $files = scandir($Assets->getURL() . "/ImmaginiEser");
        foreach ($files as $file) {
            $pieces = explode('[', $file);
            if ($pieces[0] == $_POST['nome']) {
                unlink($Assets->getURL() . "/ImmaginiEser/".$file);
            } 
        }        
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "updateEs") {
    if ($Esercizi->updateEsercizio($_POST['nome'], $_POST['desc'], $_POST['code'],$_POST['id'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "info") {
    echo $Esercizi->getInfoEsercizio($_POST['id'], $db)['descrizione'];
}

if (isset($_FILES["UploadedImage0"])) {
    $f = $_FILES;
    $l = $_POST['label'];
    for ($n = 0; $n <= count($f) - 1; $n++) {
        if (0 < $f["UploadedImage" . $n]['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            $temp = explode(".", $f["UploadedImage" . $n]["name"]);
            $newfilename = $l . "[" . $n . "].jpg";
            chmod("../Assets/ImmaginiProf/", 0777);
            move_uploaded_file($f["UploadedImage" . $n]["tmp_name"], "../Assets/ImmaginiEser/" . $newfilename);
        }
    }
}

if (isset($_POST['info'])) {
    $E = $Esercizi->getInfoEsercizio($_POST['idEs'], $db);
?>
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Informazioni Esercizio</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <div class="d-flex flex-column">
                <h6 class="mb-3 text-sm"><?= $E['nome'] ?></h6>
                <span class="text-dark font-weight-bold ms-sm-2">Descrizione: <br />
                    <span class="mb-2 text-xs">
                        <h6 class="mb-3 text-sm"><?= $E['descrizione'] ?></h6>
                    </span>
                </span>
                <div id="carouselExampleFade" class="carousel slide " data-bs-interval="false" >
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container d-block w-90" style=" background-image: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5))">
                                <div class="container d-block center">

                                    <iframe width="auto" style="width: 100%; height:100%; min-height: 500px;  top: 50%;
                                                                                                            left: 50%;" src="https://www.youtube.com/embed/<?= $E['codice_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                </div>

                            </div>
                        </div>
                        <?php $files = scandir($Assets->getURL() . "/ImmaginiEser");
                        if($files){

                        
                        foreach ($files as $file) {

                            $pieces = explode('[', $file);
                            if ($pieces[0] == $E['nome']) { ?>
                                <div class="carousel-item ">
                                    <div class="container d-block w-100" style="width: 100%; height:500px; ">
                                        <img src="<?= $Assets->getURL() . "/ImmaginiEser/".$file ?>" style="position: absolute;
                                                                                                            top: 50%;
                                                                                                            left: 50%;
                                                                                                            transform: translateX(-50%) translateY(-50%);
                                                                                                            max-width: 100%;
                                                                                                            max-height: 100%;">
                                    </div>
                                </div>
                        <?php    }
                        }
                        } ?>

                        

                    </div>
                    <button class="carousel-control-prev my-10" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next my-10" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" style="background-image: none;">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: none; color:black;"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
<?php
}
if (isset($_POST['gruppo'])) {
?>

    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Esercizi <?= $_POST['gruppo'] ?></h6>
                <input type="hidden" id="idGroupSelect" value="<?= $_POST['gruppoid'] ?>">
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0 " style="height: 200px; max-height: 250px;">
                <table class="table align-items-center justify-content-center mb-0 max-height-vh-100">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ultimo risultato</th>
                            <?php
                            if ($Istruttore) {
                            ?>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Opzioni</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Esercizi->getEserciziForGroup($_POST['gruppoid'], $db) as $es) {
                            $E = $Esercizi->getInfoEsercizio($es['id_esercizio'], $db);
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2" style="cursor:pointer;" onclick='selEser("<?= $E["id_esercizio"] ?>")'>

                                        <div class="my-auto mx-2 my-2">
                                            <h6 class="mb-0 text-sm"><?= $E["nome"] ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2">
                                        <h6 class="mb-0 text-sm"><?php if($r = $Risultato->getLastRisultatoEs($auth->getUserId(),$E["id_esercizio"],$db)){
                                            echo $r["quantita"]." ".$r["misura"];
                                        }else{
                                            echo "Ancora nessun risultato registrato";
                                        }
                                        ?></h6> <!-- TODO -->
                                    </div>
                                </td>
                                <?php
                                if ($Istruttore) {
                                ?>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><button class="dropdown-item" onclick="delEs(<?= $E['id_esercizio'] ?>,'<?= $E['nome'] ?>')">Elimina</button></li>
                                            <li><button class="dropdown-item" onclick="editEs('<?= $E['nome'] ?>','<?= $E['codice_video'] ?>',<?= $E['id_esercizio'] ?>)">Modifica</button></li>
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

                <button class="btn btn-warning text-light mb-0 rounded-circle" onclick="newEs()">
                    <i class="fa fa-plus fa-2x text-xs"></i>
                </button>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>