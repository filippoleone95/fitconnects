<?php
if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/Dashbord.php");

?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Contatti</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contatto</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ruolo</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contatta</th>
                                </tr>
                            </thead>
                            <tbody><?php
                                    foreach ($Istruttori as $row) {
                                        $p = $Profilo->getProfiloFromId($row["id"], $db);
                                        if ($Profilo::checkProfilo($row["id"],$db)){
                                                    
                                              
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <i class="bi bi-person-circle " style="font-size: 2rem; margin-right: 10px"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?= $p["nome"] ?> <?= $p["cognome"] ?></h6>
                                                    <p class="text-xs text-secondary mb-0"><?= $row["email"] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Allenatore</p>

                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <?php if($p["telefono"] != NULL ){ ?>
                                            <a class="" href="https://wa.me/39<?= $p["telefono"] ?>?text=Ciao">
                                                <i class="fa-brands fa-whatsapp fa-3x"></i>
                                            </a>
                                            <?php }?>
                                            &nbsp;&nbsp;
                                            <a href="mailto:<?= $row["email"] ?>">
                                                <i class="fa-solid fa-envelope fa-3x"></i>
                                            </a>
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
include($View->getURL() . "/Footer.php");
include($View->getURL() . "/JS_Script.php");
?>