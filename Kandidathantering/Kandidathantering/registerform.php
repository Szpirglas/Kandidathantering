<?php session_start(); ?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Strateg - Registrera</title>
        <link rel='shortcut icon' type='image/x-icon' href='content/favicon.ico' />
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
        <title>Registrera dig!</title>
    </head>
    <body>
        <div class="navHeader">
            <a href="index.php">
                <img class="navImg" src="content/bilder/Strateg_liggande-SVART_1.png" alt="index"/>
            </a>
        </div>
        <div class="regForm hsFormContainer">
            <h1>Registrera</h1>
            <form action="register.php" method="post">
                Förnamn<br>
                <input type="text" name="firstname" value="<?php

                // Om användare försökt registrera men nekats så fylls fält i.

                if (!empty($_SESSION['user']['firstname'])) {
                    echo $_SESSION['user']['firstname'];
                }
                ?>"><br>
                Efternamn<br>
                <input type="text" name="lastname" value="<?php

                // Om användare försökt registrera men nekats så fylls fält i.

                if (!empty($_SESSION['user']['lastname'])) {
                    echo $_SESSION['user']['lastname'];
                }
                ?>"><br>
                E-mail <br>
                <input type="text" name="email" value="<?php

                // Om användare försökt registrera men nekats så fylls fält i.

                if (!empty($_SESSION['user']['email'])) {
                    echo $_SESSION['user']['email'];
                }
                ?>"><br>
                <br>
                Lösenord <br>
                <input type="password" name="password"><br>
                Bekräfta lösenord <br>
                <input type="password" name="confirmpwd"><br>
                <input class="button button-white" type="submit" value="Registrera">
                <?php
//if($_POST('firstname') != NULL) {
                echo '<ul class="errors">';
                foreach ($_SESSION['errors'] as $error => $errorMessage) {
                    echo '<li>' . $errorMessage . '</li>';
                }
                echo '</ul>';
                ?>



            </form>
        </div>

    </body>
</html>
