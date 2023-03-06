<?php
if (!isset($_COOKIE["dark"])) {
    $_COOKIE["dark"] = "";
}
include("../Controller/Dashbord.php");
include("../Controller/Profilo.php");
include($View->getURL() . "/JS_Script.php");
?>
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-200 border-radius-xl mt-4" style="background-image: url('../Assets/assets/img/profile.jpg');">
        <span class="mask  bg-gradient-warning  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative" style="cursor:pointer">
                    <?php if (file_exists("../Assets/ImmaginiProf/profile[" . $auth->getUSerId() . "].jpg")) {
                        echo "<img src=\"../Assets/ImmaginiProf/profile[" . $auth->getUSerId() . "].jpg\" alt=\"profile_image\" class=\"w-100 border-radius-lg shadow-sm\" onclick=\"modalImg()\">";
                    } else {

                        echo "<img src=\"../Assets/assets/img/login.jpg\" alt=\"profile_image\" class=\"w-100 border-radius-lg shadow-sm\" onclick=\"modalImg()\">";
                    } ?>

                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        <?= $ProfiloInfo["NOME"] ?> <?= $ProfiloInfo["COGNOME"] ?>
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        <?php
                        if ($Istruttore) {
                            echo "Allenatore";
                        } else {
                            echo "Atleta";
                        }
                        ?>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Informazioni Profilo</h6>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="javascript:;">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifica Profilo" onclick="editInfo()"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                <hr class="horizontal gray-light my-4">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nome e Cognome:</strong> &nbsp; <?= $ProfiloInfo["NOME"] ?> <?= $ProfiloInfo["COGNOME"] ?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Data Nascità:</strong>
                                        &nbsp; <?= date("d/m/Y", strtotime($ProfiloInfo["DATA_NASCITA"])) ?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?= $auth->getEmail() ?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Indirizzo:</strong> &nbsp; <?= $ProfiloInfo["INDIRIZZO"] ?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Sesso:</strong> &nbsp; <?php if($ProfiloInfo["SESSO"] == 'T'){
                                        echo "Altro";
                                    }else if($ProfiloInfo["SESSO"] == 'M') {echo "Maschio";}else{ echo "Femmina";} ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (!$Istruttore) {
                    ?>
                        <div class="col-12 col-xl-4">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="">Informazioni sui Progressi</h6>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <a href="javascript:;">
                                                <i class="fas fa-pen-to-square text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifica Profilo" onclick="editProg()"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <hr class="horizontal gray-light my-4">
                                    <?php
                                    if ($Prog) {
                                    ?>
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Altezza :</strong> &nbsp; <?= $ProgrInfo["ALTEZZA"]  ?> cm</li>
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Peso iniziale:</strong> &nbsp; <?= $Peso[0]["PESO"] ?> Kg</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Peso desiderato:</strong> &nbsp; <?= $ProgrInfo["PESO_DESIDERATO"] ?> kg</li>
                                            <?php if (count($Peso) > 1) { ?>
                                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Peso attuale:</strong> &nbsp; <?= $Peso[count($Peso) - 1]["PESO"] ?> kg</li>
                                            <?php } else { ?>
                                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Peso attuale:</strong> &nbsp; Peso non ancora aggiornato!</li>
                                            <?php } ?>

                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Obiettivo attuale:</strong> &nbsp; <?= $ProgrInfo["OBIETTIVO"] ?></li>

                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Allenamenti settimanali previsti:</strong> &nbsp; <?= $ProgrInfo["ALLENAMENTI"] ?></li>

                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Ultimo allenamento da:</strong> &nbsp; <?= $ProgrInfo["ULTIMO_ALL"] ?></li>

                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Ultimo sport:</strong> &nbsp; <?= $ProgrInfo["ULTIMO_SPORT"] ?></li>

                                        </ul>
                                    <?php
                                    } else {
                                    ?>

                                        <p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessuna informazione ancora inserita</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-0">Istruttori preferiti</h6>
                                </div>
                                <div class="card-body p-3">

                                    <ul class="list-group">
                                        <?php
                                        $is = "";
                                        if($Progressi->getIstruttPref($db)){
                                        foreach ($Progressi->getIstruttPref($db) as $is) {
                                            $Prof = $Profilo->getProfiloFromId($is,$db)

                                        ?>
                                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                                <div class="avatar me-3">
                                                    <img src="../Assets/assets/img/PNG/user.png" alt="kal" class="border-radius-lg shadow">
                                                </div>
                                                <div class="d-flex align-items-start flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?=$Prof['NOME']?> <?=$Prof['COGNOME']?></h6>

                                                </div>
                                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="../Public/Contatti">Contatta</a>
                                            </li>
                                        <?php
                                        }
                                        }
                                        else{
                                        ?>
                                         <p style="text-align: center;"> <i class="fas fa-triangle-exclamation fa-4x" data-bs-placement="top"></i><br>Nessun istruttore inserito</p>
                                    
                                        <?php
                                        }
                                        ?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php
                    }else{
                       ?>
                       <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Informazioni di contatto!</h6>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="javascript:;">
                                     
                                            <i class="fas fa-phone text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifica/Inserisci Numero" onclick="editPhone()"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                <hr class="horizontal gray-light my-4">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                        <strong class="text-dark">Numero di telefono (whatsapp):</strong> 
                                        <br><?php if($ProfiloInfo["TELEFONO"] != NULL){
                                                    echo $ProfiloInfo["TELEFONO"];
                                                 } else {
                                                    echo "Inserire numero di telefono per essere contattato su whatsapp";
                                                 }?>&nbsp;
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                       <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include($View->getURL() . "/Modal.php");
include($View->getURL() . "/Footer.php");

?>
<script>
    function editProg() {
        <?php if (isset($ProgrInfo["ALTEZZA"])) { ?>

            $("#altezza").val('<?= $ProgrInfo["ALTEZZA"]  ?>');
            $("#pesoI").val('<?= $Peso[0]["PESO"] ?>');
            $("#pesoD").val('<?= $ProgrInfo["PESO_DESIDERATO"] ?>');
            $("#pesoF").val('<?php if (count($Peso) > 1) {
                                    echo $Peso[count($Peso) - 1]["PESO"];
                                } ?>');

            $("#allenamento").val('<?= $ProgrInfo["ALLENAMENTI"] ?>');
            $("#obiettivo").val('<?= $ProgrInfo["OBIETTIVO"] ?>');
            $("#ultimo").val('<?= $ProgrInfo["ULTIMO_ALL"] ?>');
            $("#ultimos").val('<?= $ProgrInfo["ULTIMO_SPORT"] ?>');
        <?php } ?>
        $('#labelPr').text('Modifica informazioni progressi');
        $('#modalProgressi').modal('show');
    }

    function editInfo() {
        $("#nome").val('<?= $ProfiloInfo["NOME"] ?>');
        $("#cognome").val('<?= $ProfiloInfo["COGNOME"] ?>');
        $("#data_n").val('<?= $ProfiloInfo["DATA_NASCITA"] ?>');
        $("#ind").val('<?= $ProfiloInfo["INDIRIZZO"] ?>');
        $("#sesso").val('<?= $ProfiloInfo["SESSO"] ?>');
        $('#labelP').text('Modifica informazioni personali');
        $('#modalProfilo').modal('show');
    }

    function editPhone() {
        $("#phone").val('<?= $ProfiloInfo["TELEFONO"] ?>');
        if ($("#phone").val() == '') {
            $('#btnDelNum').hide();
        }       
        $('#labelNum').text('Modifica informazioni di contatto');
        $('#modalNum').modal('show');
    }

    function saveNum(n) {
        if(n == 1){
            $phone =  $("#phone").val();
        }else{
            $phone =  null;
        }
        
        $id = <?= $ProfiloInfo["ID_PROFILO"] ?>;
        console.log($phone);
        if ($phone == "" ) {
            alert("Nessun campo può essere lasciato vuoto")
        } else {
            $.ajax({
                type: "POST",
                url: "<?= $Controller->GetURL() ?>/Profilo.php",
                data: {
                    phone: $phone,
                    id: $id
                 
                },
                dataType: "text",
                success: function(risposta) {
                    if (risposta == "true") {
                        location.reload();
                    } else {
                        console.log(risposta);
                    }

                },
                error: function() {
                    allert("errore AJAX");
                }
            });
        }

    }

    function modalImg() {
        $('#labelImg').text('Carica immaginie profilo');
        $('#modalImg').modal('show');
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

    $('#loadBtn').on('click', function() {

        var file_data = $('#imageProf').prop('files')[0];
        if (isFileImage(file_data)) {
            var form_data = new FormData();
            form_data.append('file', file_data);

            $.ajax({
                url: '../Controller/Profilo.php', // <-- point to server-side PHP script 
                dataType: 'text', // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(risp) {
                    if(risp == ""){
                        alert('Immagine del profilo cambiata');
                        location.reload()
                    } else if(risp == "Error: 1<br>"){
                        alert('Immagine troppo grande');
                    }
                    
                    //location.reload() // <-- display response from the PHP script, if any
                }
            });
        } else {
            alert("Inserire un formato corretto tra jpg e png");
        }


    });

    function salva() {
        $nome = $("#nome").val();
        $cognome = $("#cognome").val();
        $data_n = $("#data_n").val();
        $ind = $("#ind").val();
        $sesso = $("#sesso").val();
        $user = $("#user").val();
        if ($nome == "" || $cognome == "" || $data_n == "" || $ind == "") {
            alert("Nessun campo può essere lasciato vuoto")
        } else {
            $.ajax({
                type: "POST",
                url: "<?= $Controller->GetURL() ?>/Profilo.php",
                data: {
                    nome: $nome,
                    cogn: $cognome,
                    data: $data_n,
                    ind: $ind,
                    sesso: $sesso,
                    user: $user,
                },
                dataType: "text",
                success: function(risposta) {
                    if (risposta == "true") {
                        location.reload();
                    } else {
                        console.log(risposta);
                    }

                },
                error: function() {
                    allert("errore AJAX");
                }
            });
        }

    }

    function salva2() {
        $peso = $("#pesoF").val();
        $pesoD = $("#pesoD").val();
        $altezza = $("#altezza").val();
        $allenamento = $("#allenamento").val();
        $ultimo = $("#ultimo").val();
        $ultimos = $("#ultimos").val();
        $obiettivo = $("#obiettivo").val();


        $user = $("#userP").val();

        if ($peso == "" || $pesoD == "" || $altezza == "" || $allenamento == "" ||
            $ultimo == "" || $ultimos == "" || $obiettivo == "") {
            alert("Nessun campo può essere lasciato vuoto")
        } else {
            $.ajax({
                type: "POST",
                url: "<?= $Controller->GetURL() ?>/Profilo.php",
                data: {
                    peso: $peso,
                    pesoD: $pesoD,
                    alt: $altezza,
                    all: $allenamento,
                    ult: $ultimo,
                    ults: $ultimos,
                    obie: $obiettivo,

                    user: $user
                },
                dataType: "text",
                success: function(risposta) {
                    if (risposta == "true") {
                        location.reload();
                    } else {
                        console.log(risposta);
                    }

                },
                error: function() {
                    allert("errore AJAX");
                }
            });
        }
    }
</script>