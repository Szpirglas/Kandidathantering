<?php

$regFirstName = filter_input(INPUT_POST, 'firstname');
$regLastName = filter_input(INPUT_POST, 'lastname');
$regEmail = filter_input(INPUT_POST, 'email');
$regPassword = filter_input(INPUT_POST, 'password');
$regConfirmPwd = filter_input(INPUT_POST, 'confirmpwd');

if ($regEmail != null AND $regPassword != null AND $regFirstName != null AND $regLastName != null AND $regConfirmPwd != null) {
    if (filter_var($regEmail, FILTER_VALIDATE_EMAIL) AND ( $regPassword == $regConfirmPwd)) {



        require_once("dbConnection.php");
        $db = new dbConnection();
        $con = $db->connect();

        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        }

        $sql = "INSERT INTO USER (EMAIL, PASSWORD) values ('$regEmail', '$regPassword')";


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
        echo 'ERROR INRE!';
    }
} else {
    echo 'ERROR YTTRE!';
}
?>
