<?php
require "../Model/Database.php";

require_once __DIR__ . '/../Log/LoggerUtil.php';

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('Database.php -> --- Richiamato file Database.php ---');

$logger->info('Database.php -> Inizializzo i dati per il collegamento al database');
$host= "eu-cdbr-west-03.cleardb.net";
$username = "b25eddb0c21b3d";
$password = "37f52990";
$db_name = "heroku_b92979442b43447";

$logger->info('Database.php -> istanzio oggetto $database di tipo Database');
$database = new Database($host,$username,$password,$db_name);
$db = $database->getPDO(); 

$logger->info('Database.php -> Fine file');
?>