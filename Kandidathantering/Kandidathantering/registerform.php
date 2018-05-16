<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Registrera dig!</title>
    </head>
    <body>
        <div class="regForm">
            <h1>Registrera</h1>
            <form action="register.php" method="post">
                Förnamn<br>
                <input type="text" name="firstname"><br>
                Efternamn<br>
                <input type="text" name="lastname"><br>
                E-mail <br>
                <input type="text" name="email"><br>
                <br>
                Lösenord <br>
                <input type="password" name="password"><br>
                Bekräfta lösenord <br>
                <input type="password" name="confirmpwd"><br>
                <input type="submit" value="Registrera">




            </form>
        </div>

    </body>
</html>
