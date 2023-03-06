<?php

namespace FitCon\Controller\Risultati;

require_once "Includer.php";


if (isset($_POST['userR']) && $_POST['userR'] == "addRis") {
  if ($Risultato->addRis($_POST['misura'], $_POST['quantita'], $_POST['ide'], $auth->getUserId(), $db)) {
    echo "true";
  }
}

if (isset($_POST['userR']) && $_POST['userR'] == "delteRis") {
  if ($Risultato->delRis($_POST['id_del'], $db)) {
    echo "true";
  }
}

if (isset($_POST['userR']) && $_POST['userR'] == "storico") {
?>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 table-responsive">
        <table class="table table-info table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center">Quantita</th>
              <th class="text-center">Misura</th>
              <th class="text-center">Data Risultato</th>

            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($Risultato->getRisultatiEs($auth->getUserId(), $_POST['ide'], $db) as $r) {
            ?>

              <tr style="cursor: pointer;">
                <td class="text-center"><?= $r["misura"] ?></td>
                <td class="text-center"><?= $r["quantita"] ?></td>
                <td class="text-center"><?= date("d/m/Y", strtotime($r["data_ris"])) ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php
}
if (isset($_POST['userR']) && $_POST['userR'] == "storicoEdit") {
?>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 table-responsive">
        <table class="table table-info table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center">Quantita</th>
              <th class="text-center">Misura</th>
              <th class="text-center">Data Risultato</th>
              <th class="text-center">Elimina Risultato</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($Risultato->getRisultatiEs($auth->getUserId(), $_POST['ide'], $db) as $r) {
            ?>

              <tr style="cursor: pointer;">
                <td class="text-center"><?= $r["misura"] ?></td>
                <td class="text-center"><?= $r["quantita"] ?></td>
                <td class="text-center"><?= date("d/m/Y", strtotime($r["data_ris"])) ?></td>
                <td class="text-center"><button type='button' class="btn btn-danger" style="z-index: 3000;" onclick='delRis(<?= $r["id_risultato"] ?>) '>
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
<?php

}
