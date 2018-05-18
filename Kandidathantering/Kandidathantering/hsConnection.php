<?php

// Hämta .env-filen

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

class hsConnection {
    
    function __construct() {
        
    }


    function sendToHubSpot($url, $json) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json))
        );

        curl_exec($ch);
        
        if (curl_errno($ch)){
            throw new Exception("cURL POST ERROR: " . curl_errno($ch));
        }
        
        curl_close($ch);
        
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
        
        
         if (curl_errno($ch)){
            throw new Exception("cURL POST ERROR: " . curl_errno($ch));
        }
        
        curl_close($ch);
        return $result;
    }
}
