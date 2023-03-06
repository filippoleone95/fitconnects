<?php

namespace FitCon\Controller\Richieste;
include "Includer.php";

if (isset($_POST['user']) && $_POST['user'] == "setView") {
   
    if ($Richieste->setState('view',$_POST['idr'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "complete") {
   
    if ($Richieste->setState('complete',$_POST['idr'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "cancel") {
   
    if ($Richieste->delReq($_POST['idr'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "editReq") {
   
    if ($Richieste->insertRichiesta($_POST['istr'],"Modifica/Cambio scheda","new",$_POST['note'],$_POST['ids'],$db)) {
        echo "true";
    }
}

