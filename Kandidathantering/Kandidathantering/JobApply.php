<?php

class JobApply {
    
   
    
    function __construct() {
        


require_once 'dbConnection.php';

$db = new dbConnection();

$connect = $db->connect();

if ($con->connect_error) {
    echo "Connection failed: " . $con->connect_error;
}


?>

        
    }
    
    
}
