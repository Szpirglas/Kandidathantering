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

    function createTask($vid, $jobId, $applicantName) {
        
        
        
        $taskBody = $applicantName . ' har sökt jobb: ' . $jobId;
        $taskSubject = 'Jobbansökan: ' . $applicantName;
        
       
        
        $task = array(
            'engagement' => array(
                'active' => true,
                'ownerId' => null,
                'type' => 'TASK',
                
            ),
            'associations' => array(
                'contactIds' => array($vid),
                'companyIds' => array(),
                'dealIds' => array(),
                'ownerIds' => array()
            ),

            'metadata' => array(
                'body' => $taskBody,
                'subject' => $taskSubject,
                'status' => 'NOT_STARTED',
                'forObjectType' => 'CONTACT'
            )
        );

        $encode = json_encode($task, JSON_NUMERIC_CHECK);

        $fp = fopen('results.json', 'w');
       fwrite($fp, $encode);
       fclose($fp);

        $url = 'https://api.hubapi.com/engagements/v1/engagements?hapikey=' . getenv('HS_APIKEY');

        $this->hsConnect->sendToHubSpot($url, $encode);
    }

}
