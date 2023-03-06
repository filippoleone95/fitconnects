<?php
require "../Model/Database.php";

// Database remoto
$host= "localhost";
$username = "fitconnects";
$password = "Test";
$db_name = "my_fitconnects";

// Database locale
/* $host= "127.0.0.1";
$username = "filippo";
$password = "Trk2.6Pro";
$db_name = "fitcon"; */

$database = new Database($host,$username,$password,$db_name);
$db = $database->getPDO(); 

?>