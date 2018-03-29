<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 

if (isset($_COOKIE["loggedIn"]))
{
    header("Location: success.php");
    
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>LOGGA IN</h1>
        <br>
        <br>
         <div id="loginForm"><form action="login.php" method="post">
         
                 E-mail: <br>
                 <input type="text" name="email"><br>
                 Password: <br>
                 <input type="password" name="password"><br>
            <input type="submit">
                
            <br>
            <br>
            <a href="registerform.php">Registrera dig här!</a>
          
            
            </form></div>
   
    </body>
</html>
