<?php

// Hämta .env-filen

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require_once 'dbConnection.php';

/**
 * Klass som används för att hantera undantag. Undantagen lagras i databasen
 * för att enkelt logga fel som uppstått, och användaren dirigeras till en
 * sida med ett felmeddelande.
 */

class ExceptionHandler {

    protected $dbConnect;

    function __construct() {

        $this->dbConnect = new dbConnection();
    }

    function addException($vid, $url, $exception) {

        $connect = $this->dbConnect->connect();
        
        $time = date("Y-m-d H:i:s");
        
        if (!isset($vid))
        {
            $vid = 0000;
            
        }
        
        if (!isset($url)){
            $url = 'NO URL';
        }

        $query = "INSERT INTO EXCEPTION (USERID, URL, EXMSG, DATE) VALUES ($vid, '$url', '$exception->getMessage()', $time)";
        
        $connect->query($query);
        
        header("Location: error.php");
    }

}
