<?php
namespace FitCon\Controller\Sessione;
use \Delight\Auth\Auth;
use FitCon\Model\Profilo\Profilo;
use FitCon\Model\Progresso\Progresso;
use FitCon\Model\Scheda\Scheda;
use FitCon\Model\Gruppo\Gruppo;
use FitCon\Model\Esercizio\Esercizio;
use FitCon\Model\Richiesta\Richiesta;
use FitCon\Model\Notizia\Notizia;
use FitCon\Model\Risultato\Risultato;
use FitCon\Model\Allenamento\Allenamento;


require $Vendor->getURL() . "/autoload.php";
require $Model->getURL() . "/Profilo.php";
require $Model->getURL() . "/Progresso.php";
require $Model->getURL() . "/Scheda.php";
require $Model->getURL() . "/Gruppo.php";
require $Model->getURL() . "/Esercizio.php";
require $Model->getURL() . "/Richiesta.php";
require $Model->getURL() . "/Notizia.php";
require $Model->getURL() . "/Risultato.php";
require $Model->getURL() . "/Allenamento.php";
include "Database.php";



$auth = new Auth($db,null,null,false);

if ($auth->isLoggedIn()) {
$id = $auth->getUserId();

//Carico tutte le informazioni dell ' utente
$Profilo = new Profilo($id);
$Progressi = new Progresso($Profilo->getProfiloId($db));
$Scheda = new Scheda($id);
$Gruppi = new Gruppo();
$Esercizi = new Esercizio();
$Richieste = new Richiesta($id);
$Notizie = new Notizia();
$Risultato = new Risultato();
$Allenamento = new Allenamento();

if($auth->hasRole(\Delight\Auth\Role::COLLABORATOR)){
    $Istruttore = true;
}else{
    $Istruttore = false;
}

if($auth->hasRole(\Delight\Auth\Role::ADMIN)){
    $Amministratore = true;
    $Istruttore = true;
}else{
    $Amministratore = false;
}

$result = $db->query("SELECT id_user FROM activity WHERE id_user = $id");
if($result->rowCount() == 0) {
    $db->query("INSERT INTO activity (id_user, ultima)
                VALUES ($id,NOW() );");
} else {
    $db->query("UPDATE  activity SET  ultima  = NOW() 
                WHERE id_user = $id");
}
}
 

?>