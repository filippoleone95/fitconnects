<?php

namespace FitCon\Controller\User;

use function FitCon\Controller\Mail\newEmail;
use \Delight\Auth\InvalidEmailException;
use Exception;
use FitCon\Model\Istruttore\Istruttore;
use FitCon\Model\Profilo\Profilo;

require_once __DIR__ . '/../Log/LoggerUtil.php';
/* Inizializzo il logger */

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();
$logger->info('User.php -> --- Richiamato file User.php ---');

$logger->info('User.php -> Richiamato file User.php');
include "Includer.php";

$logger->info('User.php -> Richiamato file ../Model/Istruttore.php');
require_once "../Model/Istruttore.php";

$logger->info('User.php -> Richiamato file ../Model/Profilo.php');
require_once "../Model/Profilo.php";

//Registrazione Atleta
if (isset($_POST['user']) && $_POST['user'] == "signup") {
    $logger->info('User.php -> Avviata registrazione atleta');

    try {
        
        if ($_POST['pass1'] != $_POST['pass2']) {
            die('Le due password non corrispondono');
        }

        $userId = $auth->register($_POST['email'], $_POST['pass1'], $_POST['nome'], function ($selector, $token) use ($logger) {
            $logger->info('User.php -> Creazione link per la mail di attivazione account');
            $url = SERV_NAME . 'Public/EmailVerify?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);

            $logger->info('User.php -> Creazione messaggio per la mail');
            $mex = 'Per completare la registrazione seguire il seguente url : ' . $url;

            $logger->info('User.php -> richiamo la funzione per invio mail newEmail()');
            newEmail("Registrazione", $mex, $_POST['email'], $_POST['nome'], $logger);
            die('Url attivazione account -> ' . $url); // Solo in programmazione Da togliere
            //die('Controlla la tua mail! Se non la trovi controlla anche nello SPAM !');
        });

        echo 'We have signed up a new user with the ID ' . $userId;
    } catch (InvalidEmailException $e) {
        die('Email non valida');
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        die('Password non valida');
    } catch (\Delight\Auth\UserAlreadyExistsException $e) {
        die('Utente già esistente');
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        die('Troppe richieste, riprova tra poco');
    } catch (Exception $e) {
        die("Qualcosa è andato storto nella registazione... contattare il supporto.");
    }


    //Login Atleta e Istruttore
} elseif (isset($_POST['user']) && $_POST['user'] == "login") {

    try {
        $auth->login($_POST['email'], $_POST['pass1']);

        if (!Profilo::checkProfilo($auth->getUserId(), $db)) {
            die("Completa la registrazione");
        }
        die("Attendi");
    } catch (\Delight\Auth\InvalidEmailException $e) {
        die('Email sbagliata');
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        die('Password errata');
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        die('Email non verificata , controllare la casella di posta elettronica');
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        die('Troppe richieste, riprova tra poco');
    }

    //Login Admin
} elseif (isset($_POST['user']) && $_POST['user'] == "admin") {

    try {
        $auth->login($_POST['email'], $_POST['pass1']);
        if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
        } else {
            $auth->logOut();
            die('Non sei un amministratore');
        }
        //$auth->admin()->addRoleForUserById($auth->getUserId(), \Delight\Auth\Role::ADMIN);

    } catch (\Delight\Auth\UnknownIdException $e) {
        die('Unknown user ID');
    } catch (\Delight\Auth\InvalidEmailException $e) {
        die('Email sbagliata');
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        die('Password errata');
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        die('Email non verificata , controllare la casella di posta elettronica');
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        die('Troppe richieste, riprova tra poco');
    }
    //Registrazione istruttore
} elseif (isset($_POST['user']) && $_POST['user'] == "istruttore") {

    try {
        $Istruttore = new Istruttore();
        if ($_POST['pass1'] != $_POST['pass2']) {
            die('Le due password non corrispondono');
        }
        if (!$Istruttore->controlCode($_POST['code'], $db)) {
            die('Codice errato!');
        }

        $userId = $auth->register($_POST['email'], $_POST['pass1'], $_POST['nome'], function ($selector, $token) use ($logger) {
            $url = SERV_NAME . '/FitCon/Public/EmailVerify?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
            $mex = 'Per completare la registrazione seguire il seguente url : ' . $url;
            newEmail("Registrazione", $mex, $_POST['email'], $_POST['nome'], $logger);
            //echo  $url; // Solo in programmazione Da togliere

        });
        $auth->admin()->addRoleForUserById($userId, \Delight\Auth\Role::COLLABORATOR);
        $Istruttore->attivaIstruttore($userId, $_POST['code'], $db);
        die('Controlla la tua mail! Se non la trovi controlla anche nello SPAM !');
        echo 'We have signed up a new user with the ID ' . $userId;
    } catch (InvalidEmailException $e) {
        die('Email non valida');
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        die('Password non valida');
    } catch (\Delight\Auth\UserAlreadyExistsException $e) {
        die('Utente già esistente');
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        die('Troppe richieste, riprova tra poco');
    }
} else if (isset($_POST['user']) && $_POST['user'] == "complete") {
    if (Profilo::insertProfilo($auth->getUserId(), $_POST['nome'], $_POST['cogn'], date("Y-m-d", strtotime($_POST['data'])), $_POST['ind'], $_POST['sesso'], $db)) {
        die("true");
    }
}
