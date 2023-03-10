<?php
    namespace FitConnects;

    require_once __DIR__ . '/Log/LoggerUtil.php';

    /* Inizializzo il logger */
    use FitConnects\Log\LoggerUtil;
    // Ottiengo un'istanza del logger
    $logger = LoggerUtil::getLogger();
    $logger->info('*************************************************************');
    $logger->info('Index.php -> Richiesto file Home.php');

    header("Location: ./Public/Home.php");
?>
