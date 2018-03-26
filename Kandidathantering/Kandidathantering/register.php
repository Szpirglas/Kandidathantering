<?php

$regEmail = filter_input(INPUT_POST, 'email');
$regPassword = filter_input(INPUT_POST, 'password');

if ($regEmail != null AND $regPassword != null) {
    if (filter_var($regEmail, FILTER_VALIDATE_EMAIL)) {



        require_once("dbConnection.php");
        $db = new dbConnection();
        $con = $db->connect();

        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        }

        $sql = "INSERT INTO USER (EMAIL, PASSWORD) values ('$regEmail', '$regPassword')";
               

        if ($con->query($sql) === true) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    

    $con->close();
    }
}

header('Location: success.php');

?>
