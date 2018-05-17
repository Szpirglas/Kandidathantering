<!DOCTYPE html>


<?php
/* Om användaren har en cookie lagrad på sin dator så omdirigeras hen automatiskt
 * till sidan för inloggade */

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>LOGGA IN</h1>


        <div class="loginForm"><form action="login.php" method="post">
                <?php
                    echo '<p class="errors">' . $_SESSION['loginError'] . '</p>';
                ?>
                E-mail: <br>
                <input type="text" name="email"><br><br>
                Lösenord: <br>
                <input type="password" name="password"><br><br>
                <input class="button button-black" type="submit" value="Logga in">

                <br>
                <br>
                <a href="registerform.php">Registrera dig här!</a>



            </form></div>

    </body>
</html>
