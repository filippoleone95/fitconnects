<?php

require_once __DIR__ . '/../Log/LoggerUtil.php';
/* Inizializzo il logger */

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('Info.php -> --- Richiamato file Info.php ---');

$project_name = "";
$company_name = "FitConnects";
$server_name = "https://fit-connects.herokuapp.com/"; //es. www.fitcon.com or localhost , cambiare se non in locale  
define("COMP_NAME", $company_name);
define("SERV_NAME", $server_name);

$logger->info('Info.php -> Fine file');
