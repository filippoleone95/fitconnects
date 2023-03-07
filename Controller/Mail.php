<?php

namespace FitCon\Controller\Mail;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require $Vendor->getURL() . "/autoload.php";

function newEmail($motivo, $messaggio ,$destinatario,$username)
{
    //Create an instance; passing `true` enables exceptions
    //Prova
    $mailer = new PHPMailer(true);

    try {
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
        $mailer->setFrom("fconnects22@gmail.com", "Fit Connects",0);
        $mailer->Body = $messaggio;
        $mailer->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
    }
}
