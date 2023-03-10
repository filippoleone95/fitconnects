<?php

    require_once __DIR__ . '/../log/LoggerUtil.php';
    /* Inizializzo il logger */
    use FitConnects\Log\LoggerUtil;
    // Ottiengo un'istanza del logger
    $logger = LoggerUtil::getLogger();
    $logger->info('Includer.php -> --- Richiamato file Includer.php ---');

    $logger->info('Includer.php -> Richiamato file /Routes/Routes.php');
    include "../Routes/Routes.php";
    $logger->info('Includer.php -> Richiamato file /Lib/Info.php');
    include "../Lib/Info.php";
    $logger->info('Includer.php -> Richiamato file /Controller/Session.php');
    include "../Controller/Session.php";

    /* Ogni qual volta viene richiamata la variabile $base, verrà restituito il nome del file che la sta utilizzando */
    $logger->info('Includer.php -> iniziallizzo la variabile $base');
    $base = basename($_SERVER["SCRIPT_FILENAME"], '.php') ;

    $logger->info('Includer.php -> Includo file View/Panel.php');
    include "../View/Panel.php";

    $logger->info('Includer.php -> Fine file');
?>


