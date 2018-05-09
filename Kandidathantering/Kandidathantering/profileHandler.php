<?php

// Hämta .env-filen

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require 'hsConnection.php';

class ProfileHandler {
    

    
    protected $hsConnect;
    
    function __construct()
    {
        $this->hsConnect = new hsConnection();
        
    }
    
    function getProfile($vid) {
        
        
        $decoded = json_decode($this->hsConnect->getResponse('https://api.hubapi.com/contacts/v1/contact/vid/' . $vid . '/profile?hapikey=' . getenv('HS_APIKEY')));


        $profile = array(
            "firstname" => $decoded->properties->firstname->value,
            "lastname" => $decoded->properties->lastname->value,
            "email" => $decoded->properties->email->value);



        return $profile;
    }

    /**
     * Denna funktion används för att skapa en profil som ska lagras i HubSpot
     * och används i samband med att en användare registrerar sig.
     * Profilinformationen lagras i en flerdimensionell array som konverteras
     * till JSON-format och sedan skickas in till HubSpot-API'et via anropad
     * funktion.
     * 
     * @param type $firstname
     * @param type $lastname
     * @param type $email
     */
    function createProfile($firstname, $lastname, $email) {

        $profile = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $email
                ),
                array(
                    'property' => 'firstname',
                    'value' => $firstname
                ),
                array(
                    'property' => 'lastname',
                    'value' => $lastname
                ),
            )
        );

        $profileEncoded = json_encode($profile);

        $url = 'https://api.hubapi.com/contacts/v1/contact/?hapikey=' . getenv('HS_APIKEY');

        $this->hsConnect->sendToHubSpot($url, $profileEncoded);
    }
    
     function updateProfile($email, $firstname, $lastname, $interest) {
        $profile = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $email
                ),
                array(
                    'property' => 'firstname',
                    'value' => $firstname
                ),
                array(
                    'property' => 'lastname',
                    'value' => $lastname),
                array(
                    'property' => 'intresse',
                    'value' => $interest
        )));
        $profileEncoded = json_encode($profile);

        $url = 'https://api.hubapi.com/contacts/v1/contact/email/' . $email . '/profile?hapikey=' . getenv('HS_APIKEY');
        $this->hsConnect->sendToHubSpot($url, $profileEncoded);
    }
    
    function subscribeNewsletter($email, $frequency) {
        $decoded = json_decode($this->getResponse('https://api.hubapi.com/contacts/v1/contact/email/' . $email . '/profile?hapikey=' . getenv('HS_APIKEY')));

        $vid = array(
            "vid" => $decoded->vid
        );

        $subcription = array(
            array(
                'property' => 'blog_kandidat_5623197993_subscription',
                'value' => $frequency
            )
        );

        $subscriptionEncoded = json_encode($subcription);
        $url = 'https://api.hubapi.com/contacts/v1/contact/vid/' . $vid . '/profile?hapikey=' . getenv('HS_APIKEY');

        $this->hsConnect->sendToHubSpot($url, $subscriptionEncoded);
    }

   
}
