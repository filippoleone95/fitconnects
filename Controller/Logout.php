<?php
include "Includer.php";

if ($auth->isLoggedIn()) {
    $auth->logOut();
    header("Location:".$Public->getURL()."/Login");
}
 
?>