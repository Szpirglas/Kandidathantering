<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();


class apiKeyConnect {

    function sendToHubSpot($url, $json) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json))
        );

        $result = curl_exec($ch);
        
        $file = fopen("post.txt", "w");
        fwrite($file, $result);
        fclose($file);
    }

    function getResponse($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    function getBlogPosts() {


        $decoded = json_decode($this->getResponse('https://api.hubapi.com/content/api/v2/blog-posts?hapikey='.getenv('HS_APIKEY')));

        $blogCount = $decoded->total_count;



        $blogPosts = array();

        for ($i = 0; $i < $blogCount; $i++) {


            $blogPosts[] = array(
                "author" => $decoded->objects[$i]->author_name,
                "post" => $decoded->objects[$i]->post_body);
        }



        return $blogPosts;
    }

    function getProfile($email) {
        $decoded = json_decode($this->getResponse('https://api.hubapi.com/contacts/v1/contact/email/' . $email . '/profile?hapikey='.getenv('HS_APIKEY')));

        $profile[] = array(
            "firstname" => $decoded->properties->firstname->value,
            "lastname" => $decoded->properties->lastname->value);

        return $profile;
    }

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

}
