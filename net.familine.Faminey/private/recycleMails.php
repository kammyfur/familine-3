<?php

require './email/Exception.php';
require './email/PHPMailer.php';
require './email/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$addresses = json_decode(file_get_contents("./emails.json"));

foreach ($addresses as $user => $address) {
    echo 'Sending email for ' . $user . "\n";
    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'cd769352190a193431d6bad899363456';                     // SMTP username
    $mail->Password   = 'c29c09c3e4d5a749726537e23eb111bc';                               // SMTP password
    $mail->SMTPSecure = 'none';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('faminey@private.minteck-projects.rf.gd', 'Faminey');
    $mail->addAddress($address);

    // Elements
    $elements = "";
    $list = json_decode(file_get_contents("./recycles.json"), true);

    foreach ($list as $item) {
        if ($item['qty'] > 0) {
            $elements = $elements . "    - " . $item['name'] . "\n        - Recherche de " . $item['qty'] . " pour " . $item['price'] . "€\n";
        }
    }

    // Content
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = "Offres disponibles au " . date('d/m/Y') . " - Réutilisation Faminey";
    $mail->CharSet = 'UTF-8';
    $mail->Body    = "Bonjour " . $user . ",\n\nVoici la liste des offres actuellement disponibles dans l'option de réutilisation de Faminey :\n\n" . $elements ."\nConsultez Faminey (https://familine.ddns.net/fpn/#/recycle) pour en savoir plus.\n\nCordialement,\nVotre équipe Familine";

    // PHP 5.6+ fix
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->send();
    echo 'Sent for ' . $user . "\n";
}