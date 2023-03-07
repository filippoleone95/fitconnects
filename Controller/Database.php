<?php
require "../Model/Database.php";

// Database remoto
/* $host= "localhost";
$username = "fitconnects";
$password = "Test";
$db_name = "my_fitconnects"; */

$host= "eu-cdbr-west-03.cleardb.net";
$username = "b4c61337ec540b";
$password = "ae42bd7a";
$db_name = "heroku_43dcf4d97c3e9a8";

// Database locale
/* $host= "127.0.0.1";
$username = "filippo";
$password = "Trk2.6Pro";
$db_name = "fitconnects"; */

$database = new Database($host,$username,$password,$db_name);
$db = $database->getPDO(); 

?>