<?php
require "../Model/Database.php";


$host= "eu-cdbr-west-03.cleardb.net";
$username = "b4c61337ec540b";
$password = "ae42bd7a";
$db_name = "heroku_43dcf4d97c3e9a8";

$database = new Database($host,$username,$password,$db_name);
$db = $database->getPDO(); 

?>