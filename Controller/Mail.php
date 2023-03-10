<?php

namespace FitCon\Controller\Mail;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../log/LoggerUtil.php';
/* Inizializzo il logger */

use FitConnects\Log\LoggerUtil;
// Ottiengo un'istanza del logger
$logger = LoggerUtil::getLogger();

$logger->info('Mail.php -> --- Richiamato file Mail.php ---');

//Load Composer's autoloader
$logger->info('Mail.php -> richiedo file autoload.php');
require $Vendor->getURL() . "/autoload.php";

function newEmail($motivo, $messaggio, $destinatario, $username, $logger)
{
    //Create an instance; passing `true` enables exceptions
    //Prova
    $mailer = new PHPMailer(true);

    try {
        $logger->info('Mail.php -> Inizializzo dati di invio per la mail');
        $mailer->IsSMTP();
        $mailer->Host = "smtp.gmail.com";
        $mailer->SMTPAuth = true;
        $mailer->Username = 'fconnecst22@gmail.com';
        /* $mailer->Password = 'Fitcon22-'; */
        $mailer->Password = 'zxwufnlawvrjaexg';
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;
        
        $mailer->addAddress($destinatario, $username);
        $mailer->Subject = $motivo;
        $mailer->CharSet = "utf-8";
        $mailer->setFrom("fconnects22@gmail.com", COMP_NAME,0);
        $mailer->Body = $messaggio;
        $mailer->send();

        $logger = LoggerUtil::getLogger();
        $logger->info('Mail.php -> Mail inviata correttamente.');
        return true;
        
    } catch (Exception $e) {
        $logger->error("Mail.php -> Errore nell'invio della mail. Errore -> " . $mailer->ErrorInfo);
        return false;
    }
}
