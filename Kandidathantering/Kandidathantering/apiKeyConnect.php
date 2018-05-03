<?php

// Hämta .env-filen

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();


class apiKeyConnect {

    /**
     * Denna funktion används för att via cURL HTTP-POSTa data till HubSpot-databasen.
     * 
     * @param type $url = URL'en till det specifika API'et
     * @param type $json = en JSON som innehåller det som ska skickas
     */
    
    function sendToHubSpot($url, $json) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json))
        );

        curl_exec($ch);

    }
    /**
     * Funktion som använder cURL för att hämta data från ett specifikt API.
     * 
     * @param type $url = URL till API'et
     * @return type $result = ett svar som är i JSON.
     */
        
    function getResponse($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    function getBlogPosts($blogId) {

        $url = 'https://api.hubapi.com/content/api/v2/blog-posts?hapikey='.getenv('HS_APIKEY').'&content_group_id='. $blogId;
        
        $file = fopen("url.txt", "w");
        fwrite($file, $url);
        fclose($file);
        
        $decoded = json_decode($this->getResponse($url));

        $blogCount = $decoded->total_count;



        $blogPosts = array();

        for ($i = 0; $i < $blogCount; $i++) {


            $blogPosts[] = array(
                "author" => $decoded->objects[$i]->author_name,
                "post" => $decoded->objects[$i]->post_body);
        }



        return $blogPosts;
    }
    
    /**
     * Denna funktion hämtar profilinformationen från HubSpot via den inloggades epostadress
     * och returnerar sedan en array med informationen. 
     * 
     * @param type $vid
     * @return type
     */

    function getProfile($vid) {
        $decoded = json_decode($this->getResponse('https://api.hubapi.com/contacts/v1/contact/vid/' . $vid . '/profile?hapikey='.getenv('HS_APIKEY')));

        $profile[] = array(
            "firstname" => $decoded->properties->firstname->value,
            "lastname" => $decoded->properties->lastname->value);
                

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
        
        $url = 'https://api.hubapi.com/contacts/v1/contact/?hapikey='.getenv('HS_APIKEY');
        
        $this->sendToHubSpot($url, $profileEncoded);
    }

    function subscribeNewsletter($email, $frequency)
    {
        $decoded = json_decode($this->getResponse('https://api.hubapi.com/contacts/v1/contact/email/' . $email . '/profile?hapikey='.getenv('HS_APIKEY')));
        
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
        $url = 'https://api.hubapi.com/contacts/v1/contact/vid/' . $vid . '/profile?hapikey='.getenv('HS_APIKEY');

        $this->sendToHubSpot($url, $subscriptionEncoded);
    }

}
