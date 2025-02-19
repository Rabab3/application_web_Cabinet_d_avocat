<?php
// Inclure la bibliothèque Twilio
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// SID et token d'authentification Twilio
$twilioSid = 'YOUR_TWILIO_SID';
$twilioToken = 'YOUR_TWILIO_TOKEN';

// Numéro Twilio à partir duquel envoyer le SMS
$twilioPhoneNumber = 'YOUR_TWILIO_PHONE_NUMBER';

// Fonction pour envoyer un SMS avec Twilio
function envoyerSMS($to, $message) {
    global $twilioSid, $twilioToken, $twilioPhoneNumber;

    $twilio = new Client($twilioSid, $twilioToken);

    $twilio->messages->create(
        $to,
        array(
            'from' => $twilioPhoneNumber,
            'body' => $message
        )
    );
}
?>
