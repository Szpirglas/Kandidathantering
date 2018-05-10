<?php
//Kontrollerar om det finns en cookie, annars skickas användaren tillbaka till login-sidan
?>
<html>
    <head>
        <meta charset="UTF-8">


        <title></title>
    </head>
    <body>
        <?php
//Presenterar för- och efternamn som hämtats från API'n och lagrats i cookien

        echo "<h1>Välkommen!</h1>";
        echo "<h2>" . $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'] . "!</h2>";
        ?>


        <!--        <br>  <a href="logout.php">Log out!</a> <br>-->
        </br>
        <img class="strategBlack" src="content/bilder/Strateg_liggande-SVART_1.png" alt="strateg"/>
        <img class="strategWhite" src="content/bilder/Strateg_liggande-VIT_utan_text.png" alt="strateg"/>
        </br


        <form action="updateprofileform.php">
            <input type="submit" value="Redigera profil" />
        </form>
        </br>        </br>

        <form action="logout.php">
            <input type="submit" value="Logga ut" />
        </form>



    </body>
</html>
