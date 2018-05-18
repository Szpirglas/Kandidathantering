
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


        <!--        <br>  <a href="logout.php">Log out!</a> <br>-->
        </br>
<!--        <img class="strategBlack" src="content/bilder/Strateg_liggande-SVART_1.png" alt="strateg"/>-->
        <img class="strategWhite" src="content/bilder/Strateg_liggande-VIT_utan_text.png" alt="strateg"/>
        </br>


        <form action="updateprofileform.php">

            <input class="button button-black" type="submit" value="Redigera profil" />
        </form>
        </br>

        <?php 
        if (strlen($_SESSION['user']['cv']) < 5 || strlen($_SESSION['user']['personligt_brev']) < 5)
        {
        echo '<div id="cvWarning">GLÖM INTE ATT LÄGGA IN CV OCH PERSONLIGT BREV!</div>';
            
        echo '</br></br>';
        }
        ?>
        
        <form action="logout.php">
            <input class="button button-black" type="submit" value="Logga ut" />
        </form>



    </body>
</html>
