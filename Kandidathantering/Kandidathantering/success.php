<?php
// Skicka tillbaka till huvudsidan om användaren försöker besöka sidan enskilt
if(strpos(strtolower(basename($_SERVER['REQUEST_URI'])), "success.php") !== false) {
    header("Location: index.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
        <title></title>
    </head>
    <body>
        <?php
        
        
//Presenterar för- och efternamn som hämtats från API'n och lagrats i cookien
        echo "<h1>Välkommen!</h1>";
        echo "<h2>" . $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'] . "!</h2>";
        ?>
        </br>
        <img class="strategWhite" src="content/bilder/Strateg_liggande-VIT_utan_text.png" alt="strateg"/>
        </br>
        <form action="updateprofileform.php">
            <input class="button button-black" type="submit" value="Redigera profil" />
        </form>
        </br>
        <?php 
        //Om användare ej lagt till CV eller personligt brev, uppmana att göra det
        if (strlen($_SESSION['user']['cv']) < 5 || strlen($_SESSION['user']['personligt_brev']) < 5)
        {
        echo '<div id="cvWarning">GLÖM INTE ATT LÄGGA IN CV OCH PERSONLIGT BREV!</div>';  
        echo '</br>';
        }
        ?>
        
        <form action="logout.php">
            <input class="button button-black" type="submit" value="Logga ut" />
        </form>



    </body>
</html>
