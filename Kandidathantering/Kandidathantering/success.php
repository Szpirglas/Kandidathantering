<?php




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
echo '<br>';

?>
        <br>  <a href="logout.php">Log out!</a> <br>




    </body>
</html>
