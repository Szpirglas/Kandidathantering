<?php
require_once("apiKeyConnect.php");

if (!isset($_COOKIE["loggedIn"])) {

    header("Location: index.php");
} else {
    $connect = new apiKeyConnect();

    $profile = $connect->getProfile($_COOKIE["loggedIn"]);

    session_start();
    $_SESSION['user'] = $profile[0];
}
?>
<html>
    <head>
        <meta charset="UTF-8">


        <title></title>
    </head>
    <body>
<?php

echo "<h1>Välkommen, " . $_SESSION['user']['firstname'] . "!</h1>";
?>
        <br>  <a href="logout.php">Log out!</a> <br>




    </body>
</html>
