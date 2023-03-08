<?php

namespace FitCon\Controller\User;

use function FitCon\Controller\Mail\newEmail;
use \Delight\Auth\InvalidEmailException;
use FitCon\Model\Istruttore\Istruttore;
use FitCon\Model\Profilo\Profilo;

include "Includer.php";
require_once "../Model/Istruttore.php";
require_once "../Model/Profilo.php";

//Registrazione Atleta
if (isset($_POST['user']) && $_POST['user'] == "signup") {

    try {
        if ($_POST['pass1'] != $_POST['pass2']) {
            die('Le due password non corrispondono');
        }
        $userId = $auth->register($_POST['email'], $_POST['pass1'], $_POST['nome'], function ($selector, $token) {
            $url = SERV_NAME . 'Public/EmailVerify?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
            $mex = 'Per completare la registrazione seguire il seguente url : ' . $url;
            newEmail("Registrazione", $mex, $_POST['email'], $_POST['nome']);
            // echo  $url; // Solo in programmazione Da togliere
            die('Controlla la tua mail! Se non la trovi controlla anche nello SPAM !');
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

        $userId = $auth->register($_POST['email'], $_POST['pass1'], $_POST['nome'], function ($selector, $token) {
            $url = SERV_NAME . '/FitCon/Public/EmailVerify?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
            $mex = 'Per completare la registrazione seguire il seguente url : ' . $url;
            newEmail("Registrazione", $mex, $_POST['email'], $_POST['nome']);
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
