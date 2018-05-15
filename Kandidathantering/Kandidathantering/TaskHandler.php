<?php

// Hämta .env-filen

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require_once 'hsConnection.php';
require_once 'profileHandler.php';

class TaskHandler {
    
    protected $hsConnect;
    
    function __construct() {
        $this->hsConnect = new hsConnection();
    }
    
    function createTask($vid, $jobId, $applicantName)
    {
$task = array(
            'engagement' => array(
                'active' => true,
                'ownerId' => null,
                'type' => 'TASK',
                'timestamp' => date("Y/m/d h:i:sa")
            ),
            'associations' => array(
                'contactIds' => array($vid),
                'companyIds' => array(),
                'dealIds' => array(),
                'ownerIds' => array()

            ),
            'attachments' => array(
                "id" => array()
            ),
            'metadata' => array(
                'body' => $applicantName . " " . 'har sökt jobb:' . " " . $jobId,
                'subject' => 'Jobbansökan' . " " . $applicantName,
                'status' => 'NOT_STARTED',
                'forObjectType' => 'CONTACT'
            )
    );
      $fp = fopen('results.json', 'w');
        fwrite($fp, json_encode($task));
        fclose($fp);  
      $encode = json_encode($task);
      
      $url = 'https://api.hubapi.com/engagements/v1/engagements?hapikey=' . getenv('HS_APIKEY');
      
      $this->hsConnect->sendToHubSpot($url, $encode);
  }
}


