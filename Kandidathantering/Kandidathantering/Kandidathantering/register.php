<?php

//Variablerna från formuläret i registerform.php hämtas

$regFirstName = filter_input(INPUT_POST, 'firstname');
$regLastName = filter_input(INPUT_POST, 'lastname');
$regEmail = filter_input(INPUT_POST, 'email');
$regPassword = filter_input(INPUT_POST, 'password');
$regConfirmPwd = filter_input(INPUT_POST, 'confirmpwd');

//Variablerna valideras

if (filter_var($regEmail, FILTER_VALIDATE_EMAIL) AND
        $regPassword != null AND
        $regFirstName != null AND
        $regLastName != null AND
        $regConfirmPwd != null AND 
        $regPassword == $regConfirmPwd) {


    //Uppkoppling och insert i databasen

    require_once("dbConnection.php");
    $db = new dbConnection();
    $con = $db->connect();

    if ($con->connect_error) {
        echo "Connection failed: " . $con->connect_error;
    }

    $checkReg = "SELECT * FROM user where email = '$regEmail'";
    $sql = "INSERT INTO USER (EMAIL, PASSWORD) values ('$regEmail', '$regPassword')";

    $checkResponse = $con->query($checkReg);

    if ($checkResponse->num_rows == 0) {



        if ($con->query($sql) === true) {

            require_once 'apiKeyConnect.php';
            $send = new apiKeyConnect();

            $send->createProfile($regFirstName, $regLastName, $regEmail);

            $con->close();

            setcookie("loggedIn", $regEmail);

            header('Location: success.php');
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;

            $con->close();

            header('Location: registerform.php');
        }
    } else {


        $con->close();

        header('Location: index.php');
    }
} else {

    //Manuell felhantering, kommer inte finnas kvar i framtiden :)

    echo 'ERROR INRE!';
}

