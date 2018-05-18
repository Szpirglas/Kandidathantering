<?php
session_start();
//Variablerna från formuläret i registerform.php hämtas

$regFirstName = filter_input(INPUT_POST, 'firstname');
$regLastName = filter_input(INPUT_POST, 'lastname');
$regEmail = filter_input(INPUT_POST, 'email');
$regPassword = filter_input(INPUT_POST, 'password');
$regConfirmPwd = filter_input(INPUT_POST, 'confirmpwd');

//Variablerna valide

$errors = array();
if (!filter_var($regEmail, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Ange en giltig email.");
}
if ($regFirstName == null ||
        $regLastName == null ||
        $regEmail == null ||
        $regPassword == null ||
        $regConfirmPwd == null) {
    array_push($errors, "Fyll i alla fält.");
}
if (strlen($regFirstName) > 50 ||
        strlen($regLastName) > 50 ||
        strlen($password) > 50) {
    array_push($errors, "Max 50 tecken per fält tillåtet.");
}
if (!preg_match('/^\p{L}*$/', $regFirstName) || !preg_match('/^\p{L}*$/', $regFirstName)) {
    array_push($errors, "Ditt namn får endast innehålla bokstäver.");
}
if ($regPassword != $regConfirmPwd) {
    array_push($errors, "Lösenord matchar ej.");
}

if (empty($errors)) {
$_SESSION['errors'] = $errors;

    //Uppkoppling och insert i databasen

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
    $checkReg = "SELECT * FROM user where email = '$regEmail'";
    $sql = "INSERT INTO USER (EMAIL, PASSWORD) values ('$regEmail', '$regPassword')";

    $checkResponse = $con->query($checkReg);

    
    
    if ($checkResponse->num_rows == 0) {

        if ($con->query($sql) === true) {

            require_once 'ProfileHandler.php';
            $send = new ProfileHandler();

            $send->createProfile($regFirstName, $regLastName, $regEmail);

            $con->close();



            header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;

            $con->close();
//            $_SESSION['errors'] = $errors;
            header('Location: registerform.php');
       }
    } else {


        $con->close();
        header('Location: index.php');
        
    }
} else {


    $_SESSION['errors'] = $errors;
    $_SESSION['user']['firstname'] = $regFirstName;
    $_SESSION['user']['lastname'] = $regLastName;
    $_SESSION['user']['email'] = $regEmail;
    header('Location: registerform.php');

}

