<?php
    include "../Routes/Routes.php";
    include "../Lib/Info.php";
    include "../Controller/Session.php";
    /* Ogni qual volta viene richiamata la variabile $base, verrà restituito il nome del file che la sta utilizzando */
    $base = basename($_SERVER["SCRIPT_FILENAME"], '.php') ;
    include "../View/Panel.php";
?>


