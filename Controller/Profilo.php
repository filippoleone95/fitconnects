<?php

namespace FitCon\Controller\Profilo;

use FitCon\Model\Profilo\Profilo;


if (!isset($auth)) {
    require("../Controller/User.php");
}

$ProfiloInfo =  $Profilo->getProfilo($db);
$ProgrInfo = $Progressi->getProgressi($db);

$Peso = $Progressi-> getPeso($db);

if (isset($_POST['user']) && $_POST['user'] == "updateProf") {
    if ($Profilo->updateProfilo($_POST['nome'], $_POST['cogn'], $_POST['data'], $_POST['ind'], $_POST['sesso'], $db)) {
        echo "true";
    }
}

if (isset($_POST['phone']) ) {
    if ($Profilo->updatePhone($_POST['phone'], $_POST['id'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "updateProg") {
    if ($Progressi->insertProgressi($_POST['peso'], $_POST['pesoD'],$_POST['alt'], $_POST['all'], $_POST['ult'],
                                     $_POST['ults'], $_POST['obie'],  $_POST['istr'],$Richieste, $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "updateProg2") {
    if ($Progressi->insertNewProgressi($_POST['peso'], $_POST['pesoD'],$_POST['alt'], $_POST['all'], $_POST['ult'],
    $_POST['ults'], $_POST['obie'], $db)) {
        echo "true";
    }
}

if (isset($_FILES['file'])) {
    if (0 < $_FILES['file']['error']) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = "profile[".$auth->getUSerId()."].jpg";
        chmod("../Assets/ImmaginiProf/", 0777);
        move_uploaded_file($_FILES["file"]["tmp_name"], "../Assets/ImmaginiProf/" . $newfilename);
    }
}

if (isset($_POST['givePesi'])) {

        foreach ($Peso as $p){
            $pesi["p"][] =  floatval($p["peso"]);
            $pesi["d"][] = date("d/m/Y", strtotime($p["data_peso"]));
        }
        if(isset($pesi)){
            echo json_encode($pesi);
        }else{
            echo "[]";
        }
        
}