<?php

namespace  FitCon\Controller\EmailVerify;
use \Delight\Auth\InvalidSelectorTokenPairException ;

include "Includer.php";
$logger->info('EmailVerify.php -> richiedo file autoload.php');
require $Vendor->getURL() . "/autoload.php";

$msg = "";
if (isset($_GET['selector']) && $_GET['token']) {

    try {
        $auth->confirmEmail($_GET['selector'], $_GET['token']);
        $msg = 'Indirizzo email confermato';
        
    } catch (InvalidSelectorTokenPairException $e) {
        $msg = 'Token non valido';
    } catch (\Delight\Auth\TokenExpiredException $e) {
        $msg = 'Token scaduto';
    } catch (\Delight\Auth\UserAlreadyExistsException $e) {
        $msg = 'Indirizzo email già esistente';
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        $msg = 'Troppo richieste';
    }
}
