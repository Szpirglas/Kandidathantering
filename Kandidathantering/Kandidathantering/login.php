<?php

//Informationen som fyllts in i formuläret i index.php hämtas och lagras i variabler

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$success = false;

//Validering så att variablerna innehåller något

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


        //Här kopplar koden upp sig mot databasen för att kontrollera så användaren finns
        require_once("dbConnection.php");
        $db = new dbConnection();

       

        try {
            $con = $db->connect();
            
             if ($con->connect_error) {
            throw new Exception("Connection failed: " . $con->connect_error);
        }
        
        } catch (Exception $e) {
            require_once 'exceptionHandler.php';

            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);
        }


    if ($con->connect_error) {
        echo "Connection failed: " . $con->connect_error;
    }

    $sql = "SELECT EMAIL FROM USER WHERE EMAIL LIKE '" . $email . "' AND PASSWORD LIKE '" . $password . "'";


        $result = $con->query($sql);




        if ($result->num_rows == 1) {
            $success = true;
        } else {





    if ($result->num_rows == 1) {
        $success = true;
    } else {

        $rows = $result->num_rows;
        $success = false;
    }



    $con->close();
}



/* Anledningen till att if/else-satsen ovan använder sig av en bool istället för att
  köra nedanstående kod direkt, är för att det fick cookie-skapandet att krångla, och
  och cookien lagrades inte rätt. Att flytta ner koden hit löste problemet, varför vet vi inte
  men funkar det så funkar det! :) */

if ($success == true) {


    require_once 'profileHandler.php';

    $connect = new ProfileHandler();


    try {
        $profile = $connect->getProfileId($email);
    } catch (Exception $e) {
        require_once 'exceptionHandler.php';


        $exHandler = new ExceptionHandler();
        $exHandler->addException($vid, $url, $e);
    }


    setcookie("loggedIn", $profile['vid']);


    header('Location: index.php');
} else {
    header('Location: index.php');
    session_start();
    $_SESSION['loginError'] = "Felaktig email eller lösenord.";

}
?>