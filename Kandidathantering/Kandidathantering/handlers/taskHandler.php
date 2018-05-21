<?php



// Hämta .env-filen
require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
$dotenv->load();

/**
 * Denna klassen används för att skapa Tasks i Hubspot via dess API
 */

class TaskHandler {

    protected $hsConnect;

    function __construct() {
        $this->hsConnect = new hsConnection();
    }
    
    /**
     * Funktion som skapar en Task för en sökt tjänst. Denna funktion tar emot
     * användarens ID, namn, samt namnet på tjänsten. Dessa stoppas sedan in i det
     * meddelande som dyker upp i Hubspot. 
     * 
     * @param type $vid
     * @param type $jobName
     * @param type $applicantName
     */

    function createTask($vid, $jobName, $applicantName) {
        
        
        
        $taskBody = $applicantName . ' har sökt jobb: ' . $jobName;
        $taskSubject = 'Jobbansökan: ' . $applicantName;
        
        // Simons ownerId inte vid
        $owner = 31147716;
        
       
        
        $task = array(
            'engagement' => array(
                'active' => true,
                'ownerId' => $owner,
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
        
        /*JSON_NUMERIC_CHECK-flaggan används för att $vid ska sparas som en int
         * och inte som en string i JSON-filen. Skillnaden är att när det sparas
         * som en string så läggs det till fnuttar, vilket Hubspots API inte vill ha.
         */
        
        $encode = json_encode($task, JSON_NUMERIC_CHECK);


        $url = 'https://api.hubapi.com/engagements/v1/engagements?hapikey=' . getenv('HS_APIKEY');
        
        try{
            $this->hsConnect->sendToHubSpot($url, $encode);
        }
        
        catch (Exception $e)
        {
            require_once 'exceptionHandler.php';
            
            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);            
        }
    }

}
