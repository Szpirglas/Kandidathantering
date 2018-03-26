<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
         <div id="loginForm"><form action="login.php" method="post">
         
                 E-mail: <br>
                 <input type="text" name="email"><br>
                 Password: <br>
                 <input type="password" name="password"><br>
            <input type="submit">
                
            
            <?php
            require_once("apiKeyConnect.php");
            
            $connect = new apiKeyConnect();
            
            $profile = $connect->getProfile('mattias@sandinfoto.se');
            
            echo '<br>';
            echo $profile[0]['firstname'] . ' ' . $profile[0]['lastname'];
            
            ?>
            
            </form></div>
   
    </body>
</html>
