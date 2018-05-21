<?php

// Hämta .env-filen


require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
$dotenv->load();



class dbConnection {
    
    
    
    /**
     * Funktion för att koppla upp sig mot användardatabasen,
     * och returnerar en uppkoppling.
     * 
     * @return type
     */
     function connect()
    {
     $servername = getenv('DB_HOST');
     $database = getenv('DB_NAME');
     $username = getenv('DB_USER');
     $password = getenv('DB_PASSWORD');
     
     return   mysqli_connect($servername, $username, $password, $database);
    }
}
