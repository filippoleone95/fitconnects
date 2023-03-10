<?php

require_once __DIR__ . '/../log/LoggerUtil.php';
/* Inizializzo il logger */

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('Routes.php -> --- Richiamato file Routes.php ---');

$logger->info('Routes.php -> Richiamato file Route.php');
include "Route.php";

$logger->info('Routes.php -> Istanzio variabili con i rispettivi path');
$Model = new Route("../Model");
$View = new Route("../View");
$Controller = new Route("../Controller");
$Lib = new Route("../Lib");
$Vendor = new Route("../vendor");
$Assets = new Route("../Assets");
$Public = new Route("../Public");
$Admin = new Route("../Admin");

$Logger = new Route("../log");
$logger->info('Routes.php -> Fine file');
