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

require_once __DIR__ . '/../Log/LoggerUtil.php';

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('Session.php -> --- Richiamato file Session.php ---');

$logger->info('Session.php -> richiedo file autoload.php');
require $Vendor->getURL() . "/autoload.php";
$logger->info('Session.php -> richiedo file Profilo.php');
require $Model->getURL() . "/Profilo.php";
$logger->info('Session.php -> richiedo file Progresso.php');
require $Model->getURL() . "/Progresso.php";
$logger->info('Session.php -> richiedo file Scheda.php');
require $Model->getURL() . "/Scheda.php";
$logger->info('Session.php -> richiedo file Gruppo.php');
require $Model->getURL() . "/Gruppo.php";
$logger->info('Session.php -> richiedo file Esercizio.php');
require $Model->getURL() . "/Esercizio.php";
$logger->info('Session.php -> richiedo file Richiesta.php');
require $Model->getURL() . "/Richiesta.php";
$logger->info('Session.php -> richiedo file Notizia.php');
require $Model->getURL() . "/Notizia.php";
$logger->info('Session.php -> richiedo file Risultato.php');
require $Model->getURL() . "/Risultato.php";
$logger->info('Session.php -> richiedo file Allenamento.php');
require $Model->getURL() . "/Allenamento.php";

$logger->info('Session.php -> Richiamato file Database.php');
include "Database.php";

$logger->info('Session.php -> Inizializzo la variabile $auth di tipo Auth');
$auth = new Auth($db, null, null, false);

$logger->info("Session.php -> Controllo se l'utente è già loggato");
if ($auth->isLoggedIn()) {

    $logger->info("Session.php -> Recupero l'id dell'utente");
    $id = $auth->getUserId();

    //Carico tutte le informazioni dell ' utente
    $logger->info("Session.php -> Carico tutte le informazioni dell'utente");
    $Profilo = new Profilo($id);
    $Progressi = new Progresso($Profilo->getProfiloId($db));
    $Scheda = new Scheda($id);
    $Gruppi = new Gruppo();
    $Esercizi = new Esercizio();
    $Richieste = new Richiesta($id);
    $Notizie = new Notizia();
    $Risultato = new Risultato();
    $Allenamento = new Allenamento();

    $logger->info("Session.php -> Controllo se l'utente è un istruttore");
    if ($auth->hasRole(\Delight\Auth\Role::COLLABORATOR)) {
        $logger->info("Session.php -> L'utente è un istruttore");
        $Istruttore = true;
    } else {
        $Istruttore = false;
    }

    $logger->info("Session.php -> Controllo se l'utente è un amministratore");
    if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
        $logger->info("Session.php -> L'utente è un amministratore");
        $Amministratore = true;
        $Istruttore = true;
    } else {
        $Amministratore = false;
    }

    $logger->info("Session.php -> Aggiorno ill database con l'ultimo accesso effettuato dall'utente");
    $result = $db->query("SELECT id_user FROM activity WHERE id_user = $id");
    if ($result->rowCount() == 0) {
        $db->query("INSERT INTO activity (id_user, ultima)
                VALUES ($id,NOW() );");
    } else {
        $db->query("UPDATE  activity SET  ultima  = NOW() 
                WHERE id_user = $id");
    }

}

$logger->info('Session.php -> Fine file');