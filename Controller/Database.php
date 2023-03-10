<?php
require "../Model/Database.php";

require_once __DIR__ . '/../log/LoggerUtil.php';

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('Database.php -> --- Richiamato file Database.php ---');

$logger->info('Database.php -> Inizializzo i dati per il collegamento al database');
$host= "eu-cdbr-west-03.cleardb.net";
$username = "b4c61337ec540b";
$password = "ae42bd7a";
$db_name = "heroku_43dcf4d97c3e9a8";

$logger->info('Database.php -> istanzio oggetto $database di tipo Database');
$database = new Database($host,$username,$password,$db_name);
$db = $database->getPDO(); 

$logger->info('Database.php -> Fine file');
?>