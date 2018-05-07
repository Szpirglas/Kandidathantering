<?php



//Informationen som fyllts in i formuläret i index.php hämtas och lagras i variabler

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$success = false;

//Validering så att variablerna innehåller något
if ($email != null AND $password != null) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


        //Här kopplar koden upp sig mot databasen för att kontrollera så användaren finns
        require_once("dbConnection.php");
        $db = new dbConnection();
        $con = $db->connect();

        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        }

        $sql = "SELECT EMAIL FROM USER WHERE EMAIL LIKE '" . $email . "' AND PASSWORD LIKE '" . $password . "'";


        $result = $con->query($sql);
        
        

        
        if ($result->num_rows == 1) {
            $success = true;
        } else {

            $rows = $result->num_rows;
            $success = false;
        }



        $con->close();
    }
}


/* Anledningen till att if/else-satsen ovan använder sig av en bool istället för att
köra nedanstående kod direkt, är för att det fick cookie-skapandet att krångla, och
och cookien lagrades inte rätt. Att flytta ner koden hit löste problemet, varför vet vi inte
men funkar det så funkar det! :) */

if ($success == true) {
    
<<<<<<< HEAD
    require_once('hsConnection.php');
    
    $getApi = new hsConnection();
=======
    require_once('apiKeyConnect.php');
    
    $getApi = new apiKeyConnect();
>>>>>>> Jimmy
    
    $decoded = json_decode($getApi->getResponse('https://api.hubapi.com/contacts/v1/contact/email/' . $email . '/profile?hapikey='.getenv('HS_APIKEY')));
        
        $vid = array(
            "vid" => $decoded->vid
        );
        
    setcookie("loggedIn", $vid['vid']);

    header('Location: success.php');
<<<<<<< HEAD
   
=======
>>>>>>> Jimmy
    
    
} else {
   header('Location: index.php');
<<<<<<< HEAD
  
=======
    echo 'FAIL';
>>>>>>> Jimmy
}
?>