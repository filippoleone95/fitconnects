<?php

namespace FitCon\Controller\Dashbord;

use FitCon\Model\Profilo\Profilo;
use FitCon\Model\USer\User;



include "Includer.php";

require_once "../Model/Profilo.php";
require_once "../Model/User.php";


if (!Profilo::checkProfilo($auth->getUserId(), $db)) {
    header("Location:" . $Public->getURL() . "/Complete");
}

if (!$Progressi->checkProgressi($db) && !$Istruttore) {
    $Prog = false;
} else {
    $Prog = true;
}

if (!$auth->isLoggedIn() || !isset($auth)) {
    header("Location:" . $Public->getURL() . "/Login");
}
$User = new User();
$Atleti = $User->getUserAtleti($auth, $User->getListUser($db));
$Istruttori = $User->getUserIstr($auth, $User->getListUser($db));
