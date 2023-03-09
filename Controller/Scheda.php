<?php

namespace FitCon\Controller\DashBoard;

use FitCon\Model\Profilo\Profilo;
use FitCon\Model\USer\User;

include "Includer.php";
require_once "../Model/Profilo.php";
require_once "../Model/User.php";

if (isset($_POST['gruppo'])) {
  foreach ($Esercizi->getEserciziForGroup($_POST['gruppo'], $db) as $E) {
    $eser = $Esercizi->getInfoEsercizio($E["id_esercizio"], $db);
    echo "<option value=\"" . $E["id_esercizio"] . "\">" . $eser['nome'] . "</option>";
  }
}


if (isset($_POST["id"])) {
?>
  <table class="table table-warning table-striped table-hover">
    <thead>
      <tr>
        <th class="text-center">Scheda</th>
        <th class="text-center">Data inizio scheda</th>
        <th class="text-center">Data scadenza scheda</th>
        <th class="text-center">Attiva</th>
        <th class="text-center">Modifica scheda</th>
        <th class="text-center">Elimina scheda</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($Scheda->getSchedeFromId($_POST["id"], $db) as $s) {
      ?>

        <tr style="cursor: pointer;">

          <td class="text-center" onclick="openEs(<?= $s['id_scheda'] ?>)"><?= $s["nome_scheda"] ?></td>
          <td class="text-center" onclick="openEs(<?= $s['id_scheda'] ?>)"><?= date("d/m/Y", strtotime($s["data_inizio"])) ?></td>
          <td class="text-center" onclick="openEs(<?= $s['id_scheda'] ?>)"><?php if ($s["data_scadenza"] < date("Y-m-d")){
                                                                                        echo"<p style='color:RED;'>".date("d/m/Y", strtotime($s["data_scadenza"]))."</p>";
                                                                                  }else{
                                                                                        echo"".date("d/m/Y", strtotime($s["data_scadenza"]))."";
                                                                                  }
                                                                           ?></td>
          <td class="text-center" onclick="openEs(<?= $s['id_scheda'] ?>)"><?php if ($s["attiva"]) echo "si";
                                                                            else echo "no"; ?></td>

          <td class="text-center">
            <button type='button' class="btn btn-warning mb-0" style="z-index: 3000;" onclick='editSch(<?= $s["id_scheda"] ?>,"<?= $s["nome_scheda"] ?>"
                                                                                  ,"<?= $s["data_inizio"] ?>","<?= $s["data_scadenza"] ?>",<?= $s["attiva"] ?>) '>
              <i class="fa-solid fa-pen"></i>
            </button>
          </td>
          <td class="text-center">
            <button type='button' class="btn btn-danger" style="z-index: 3000;" onclick='delSch(<?= $s["id_scheda"] ?>) '>
              <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        </tr>
      <?php
      }
    }
    if (isset($_POST['user']) && $_POST['user'] == 'newScheda') {
      if ($Scheda->insertScheda($_POST['idu'], $_POST['nome'], $_POST['dataI'], $_POST['dataS'], $_POST['attiva'], 0, $auth->getUserId(), $db)) {
        echo 'true';
      }
    }

    if (isset($_POST['user']) && $_POST['user'] == 'deleteSch') {
      if ($Scheda->deleteScheda($_POST['id_del'], $db)) {
        echo 'true';
      }
    }

    if (isset($_POST['user']) && $_POST['user'] == 'updateSch') {
      if ($Scheda->updateScheda($_POST['idS'], $_POST['nome'], $_POST['dataI'], $_POST['dataS'], $_POST['attiva'], 0, $auth->getUserId(), $db)) {
        echo 'true';
      }
    }


    /* Schede base */
    if (isset($_POST["base"])) {
      ?>
      <div class="table-responsive p-0 " >
            <table class="table align-items-center table-info table-striped justify-content-center mb-0 ">
     
        <thead>
          <tr>
            <th class="text-center">Scheda</th>
            <th class="text-center">Range età</th>
            <th class="text-center">Sesso consigliato</th>
            <th class="text-center">Modifica scheda</th>
            <th class="text-center">Elimina scheda</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($Scheda->getSchedeBase($db) as $s) {
          ?>

            <tr style="cursor: pointer;">

              <td class="text-center" onclick="openEsB(<?= $s['id_scheda_b'] ?>)"><?= $s["nome"] ?></td>
              <td class="text-center" onclick="openEsB(<?= $s['id_scheda_b'] ?>)"><?= $s["anni_min"] ?> - <?= $s["anni_max"] ?></td>
              <td class="text-center" onclick="openEsB(<?= $s['id_scheda_b'] ?>)"><?= $s["sesso_c"] ?></td>

              <td class="text-center">
                <button type='button' class="btn btn-warning mb-0" style="z-index: 3000;" onclick='editSchB(<?= $s["id_scheda_b"] ?>,"<?= $s["nome"] ?>"
                                                                                            ,<?= $s["anni_min"] ?>,<?= $s["anni_max"] ?>,"<?= $s["sesso_c"] ?>") '>
                  <i class="fa-solid fa-pen"></i>
                </button>
              </td>
              <td class="text-center">
                <button type='button' class="btn btn-danger" style="z-index: 3000;" onclick='delSchB(<?= $s["id_scheda_b"] ?>) '>
                  <i class="fa-solid fa-trash"></i>
                </button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>

      <div class="container-fluid py-4" style="z-index: 1000;">

        <div class="row justify-content-end">

          <div class="col-auto">
            <button type="button" class="btn bg-gradient-warning mb-2" onclick="addSchedaB()">Aggiungi nuova scheda base &nbsp;&nbsp;<i class="material-icons text-sm">add</i></button>
          </div>

        </div>
      </div>
      <?php
    }
    if (isset($_POST['user']) && $_POST['user'] == 'newSchedaB') {
      if ($Scheda->insertSchedaBase($_POST['nome'], $_POST['amin'], $_POST['amax'], $_POST['sex'], $db)) {
        echo 'true';
      }
    }
    if (isset($_POST['user']) && $_POST['user'] == 'updateSchB') {
      if ($Scheda->updateSchedaBase($_POST['idS'], $_POST['nome'], $_POST['amin'], $_POST['amax'], $_POST['sex'], $db)) {
        echo 'true';
      }
    }
    if (isset($_POST['user']) && $_POST['user'] == 'deleteSchB') {
      if ($Scheda->deleteSchedaBase($_POST['id_del'], $db)) {
        echo 'true';
      }
    }




    /* Lato User */
    

    if (isset($_POST['user']) && $_POST['user'] == 'switchBase') {
      $p = $Profilo->getProfilo($db);
      $age = $Profilo->getAge($p['data_nascita']);
      $sex = $p['sesso'];

      foreach ($Scheda->getSchedeBase($db) as $row) {
        if (($row['sesso_c'] == $sex || $row['sesso_c'] == 'T')
          && (($row['anni_min'] <= $age) && ($age <= $row['anni_max']))
        ) {
      ?>
          <div class="col-auto mb-xl-3 mb-4 my-3">
            <div class="card shadow-light">
              <div class="card-header p-3 pt-2">
                <div class="bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute mx-2">
                  <h3 class="text-light mx-3"><i class="fa-solid fa-clipboard-list"></i>&nbsp;&nbsp; <?= $row["nome"] ?></h3>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class=" pt-1 mx-4">
                  <p class="text-sm mb-0 text-capitalize">Scheda Pensata per </p>
                  <h6 class="mb-0"><?php if ($row["sesso_c"] == "M") {
                                      echo "atleti di sesso Maschile";
                                    } else if ($row["sesso_c"] == "F") {
                                      echo "atleti di sesso Femminile";
                                    } else {
                                      echo "atleti di entrambi i sessi";
                                    } ?></h6>
                  <p class="text-sm mb-0 text-capitalize">Con età compresa tra </p>
                  <h6 class="mb-0"> <?= $row["anni_min"] ?> - <?= $row["anni_max"] ?></h6>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <div class="col-auto row">
                  <div class="col-auto">
                    <button class="btn btn-primary mb-0" type="button" onclick="openEsB(<?= $row['id_scheda_b'] ?>)"> Visualizza esercizi <span class="text-success text-sm font-weight-bolder"></span></button>
                  </div>
                  <div class="col-auto">
                    <a class="mb-0 btn btn-info" href="./Allenamento?idb=<?= $row['id_scheda_b'] ?>"> Inizia allenamento <span class="text-success text-sm font-weight-bolder end-0"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
      }
    }
    if (isset($_POST['user']) && $_POST['user'] == 'switchPers') {
      
      $schede = $Scheda->getSchede($db);
      foreach ($schede as $row) {
        ?>

        <div class="col-auto mb-xl-3 mb-4 my-3">
          <div class="card shadow-light">
            <div class="card-header p-3 pt-2">
              <div class="bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <h3 class="text-light mx-3"><i class="fa-solid fa-clipboard-list"></i>&nbsp;&nbsp; <?= $row["nome_scheda"] ?></h3>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Data inizio scheda</p>
                <h5 class="mb-0"><?= date("d/m/Y", strtotime($row["data_inizio"])) ?></h5>
                <p class="text-sm mb-0 text-capitalize">Data scadenza scheda</p>
                <h5 class="mb-0"><?= date("d/m/Y", strtotime($row["data_scadenza"])) ?></h5>
                <p class="text-sm mb-0 text-capitalize">Istruttore</p>
                <h5 class="mb-0"><?php $p = $Profilo->getProfiloFromId($row["id_istruttore"], $db);
                                  echo $p['nome'] . " " . $p['cognome'] ?></h5>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <div class="row">
                <div class="col-auto  ">
                  <button class="btn btn-primary m-1 " type="button" onclick="openEs(<?= $row['id_scheda'] ?>)"> Visualizza esercizi <span class="text-success text-sm font-weight-bolder"></span></button>
                </div>
                <div class="col-auto  ">
                  <button class="mb-0 btn btn-light m-1 "  type="button" onclick="modReq(<?= $row['id_scheda'] ?>,<?= $row['id_istruttore'] ?>)"> Richiedi modifica <span class="text-success text-sm font-weight-bolder end-0"></span></button>
                </div>
                <div class="col-auto  ">
                  <a class="mb-0 btn btn-info m-1 "  type="button" href="./Allenamento?id=<?= $row['id_scheda'] ?>"> Inizia allenamento <span class="text-success text-sm font-weight-bolder end-0"></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    <?php
      }
      if(empty($schede)){
        echo '<p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessuna scheda presente</p>';
      }
    } ?>