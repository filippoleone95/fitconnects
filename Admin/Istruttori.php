<?php

use FitCon\Model\Istruttore\Istruttore;

require_once "../Model/Istruttore.php";
if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/DashBoard.php");
if (!$auth->hasRole(\Delight\Auth\Role::ADMIN)) {
    header("Location:" . $Public->getURL() . "/Login.php");
}

include($View->getURL() . "/Panel.php");
$Istruttori = new Istruttore();
include($View->getURL() . "/JS_Script.php");
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Codici Istruttori</h6>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn bg-gradient-dark mb-0" onclick="addModal()"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Aggiungi nuovo istruttore</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <?php $is = $Istruttori->getIstruttori($db);
                        foreach ($is as $value) {
                            if ($value["ID_USER"] != NULL) {
                                $registrato = "Si";
                            } else {
                                $registrato = "No";
                            }
                        ?>
                            <div class="col-md-3 mb-md-0 mb-4">
                                <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" style="margin-bottom: 10px;">
                                        <img class="w-10 me-3 mb-0" src="../Assets/assets/img/PNG/user.png" alt="logo">
                                        <h6 class="mb-0"><?= $value["CODICE"] ?></h6>&nbsp;&nbsp;
                                        <p class="mb-0">Registrato : <?= $registrato ?></p>
                                        
                                        
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function addModal() {
        $('#textModal').text("Aggiungi nuovo istruttore");
        $('#modal').modal('show');
    }

    function add() {
        $code = $('#code').val();
        $.ajax({
            type: "POST",
            url: "<?= $Controller->GetURL() ?>/Istruttori.php",
            data: {
                code: $code,
            },
            dataType: "text",
            success: function(risposta) {
                if (risposta == "1") {
                    
                    alert("Codice creato correttamente");
                    location.reload()
                } else {
                    $('#modalMessage').modal('show');
                    $('#textModal2').text(risposta);
                }


            },
            error: function() {
                allert("errore AJAX");
            }
        });
    }
</script>

<?php
include($Admin->getURL() . "/Modal.php");
include($View->getURL() . "/Footer.php");

?>