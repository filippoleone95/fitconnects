<?php

namespace FitCon\Controller\Notizie;
include "Includer.php";


if (isset($_POST['user']) && $_POST['user'] == "newNews") {
   
    if ($Notizie->nuovaNotizia($_POST['title'],$_POST['corpo'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "delNews") {
   
    if ($Notizie->delNotizia($_POST['id'], $db)) {
        echo "true";
    }
}

if (isset($_POST['user']) && $_POST['user'] == "updateNews") {
   
    if ($Notizie->updateNotizia($_POST['title'],$_POST['corpo'],$_POST['idn'], $db)) {
        echo "true";
    }
}



