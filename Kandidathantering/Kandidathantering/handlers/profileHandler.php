<?php

// Hämta .env-filen
require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
$dotenv->load();

require_once __DIR__ . '/../connections/hsConnection.php';

/**
 * Klass som används för att hantera användare och dess profiler.
 */
class ProfileHandler {

    protected $hsConnect;

    function __construct() {
        $this->hsConnect = new hsConnection();
    }

    /**
     * Används främst vid inloggning för att hämta ut en användares ID med hjälp
     * av dess epost-adress. Returnerar ID tillsammans med förnamn och efternamn.
     * 
     * @param type $email
     * @return type
     * 
     */
    function getProfileId($email) {

        $url = 'https://api.hubapi.com/contacts/v1/contact/email/' . $email . '/profile?hapikey=' . getenv('HS_APIKEY');

        
        
        try {
            $decoded = json_decode($this->hsConnect->getResponse($url));
        } catch (Exception $e) {
            require_once 'exceptionHandler.php';

            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);
        }
        
        
     

        $profile = array(
            
            "vid" => $decoded->vid,
            "firstname" => $decoded->properties->firstname->value,
            "lastname" => $decoded->properties->lastname->value
          
        );
        
        

        return $profile;
    }

    /**
     * Hämtar mer utökad profilinformation med hjälp av användarens ID.
     * 
     * @param type $vid
     * @return type
     */
    function getProfile($vid) {

        $url = 'https://api.hubapi.com/contacts/v1/contact/vid/' . $vid . '/profile?hapikey=' . getenv('HS_APIKEY');

        try {
            $decoded = json_decode($this->hsConnect->getResponse($url));
        } catch (Exception $e) {
            require_once 'exceptionHandler.php';

            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);
        }

        $profile = array(
            "firstname" => $decoded->properties->firstname->value,
            "lastname" => $decoded->properties->lastname->value,
            "email" => $decoded->properties->email->value,
            "vid" => $vid,
            "cv" => $decoded->properties->cv->value,
            "area_of_interest" => $decoded->properties->area_of_interest->value,
            "personligt_brev" => $decoded->properties->personligt_brev->value
        );



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
                array(
                    'property' => 'area_of_interest',
                    'value' => 'Strateg'
                ),
                array(
                    'property' => 'cv',
                    'value' => ' '
                ),
                array(
                    'property' => 'personligt_brev',
                    'value' => ' '
                ),
            )
        );

        $profileEncoded = json_encode($profile);

        $checkEmptyProfile = $this->getProfileId($email);

//        Uppdaterar en profil om mailen redan finns tillaggd i HubSpot. Händer om användare skickat meddelande innan de registrerat sig. 
//        Måste göras en koll för att se vilken av url:erna som ska användas.




        if ($checkEmptyProfile['vid'] != NULL && $checkEmptyProfile['firstname'] == null && $checkEmptyProfile['lastname'] == NULL) {
            $url = 'https://api.hubapi.com/contacts/v1/contact/email/' . $email . '/profile?hapikey=' . getenv('HS_APIKEY');
        } else {
            $url = 'https://api.hubapi.com/contacts/v1/contact/?hapikey=' . getenv('HS_APIKEY');
        }

        try {
            $this->hsConnect->sendToHubSpot($url, $profileEncoded);
        } catch (Exception $e) {
            require_once 'exceptionHandler.php';

            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);
        }
    }

}
