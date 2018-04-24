<?php
require_once("apiKeyConnect.php");


//Kontrollerar om det finns en cookie, annars skickas användaren tillbaka till login-sidan
if (!isset($_COOKIE["loggedIn"])) {

    header("Location: index.php");
} else {
    
    //Om cookie finns, hämtas profilinformationen via API'et och lagras i en session.
    
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

//Presenterar för- och efternamn som hämtats från API'n och lagrats i cookien

echo "<h1>Välkommen, " . $_SESSION['user']['firstname']. " " . $_SESSION['user']['lastname'] . "!</h1>";
?>
        <br>  <a href="logout.php">Log out!</a> <br>




    </body>
</html>
