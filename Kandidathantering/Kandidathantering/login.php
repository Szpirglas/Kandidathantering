<?php

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$success = false;

if ($email != null AND $password != null) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {



        require_once("dbConnection.php");
        $db = new dbConnection();
        $con = $db->connect();

        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        }

        $sql = "SELECT EMAIL FROM USER WHERE EMAIL LIKE '" . $email .  "' AND PASSWORD LIKE '" . $password . "'";
        //$sql = "select email from user where email like 'mattias@sandinfoto.se' and password like 'test'";

        $result = $con->query($sql);

       
        
        
        
       
        if ($result->num_rows == 1) {

            $success = true;
        } else {
            
            
            $success = false;
        }

     

        $con->close();
    }
}


if ($success == true) {
    header('Location: success.php');
} else {
    header('Location: index.php');
}
?>