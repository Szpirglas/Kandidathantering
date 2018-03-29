<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbConnection
 *
 * @author mattias
 */
class dbConnection {
    
    
    
    
     function connect()
    {
     $servername = getenv('DB_HOST');
     $database = getenv('DB_NAME');
     $username = getenv('DB_USER');
     $password = getenv('DB_PASSWORD');
     
     return   mysqli_connect($servername, $username, $password, $database);
    }
}
