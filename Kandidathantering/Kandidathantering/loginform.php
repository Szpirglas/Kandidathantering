<!DOCTYPE html>


<?php 

/* Om användaren har en cookie lagrad på sin dator så omdirigeras hen automatiskt
 * till sidan för inloggade */
   
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
         <div class="loginForm"><form action="login.php" method="post">
         
                 E-mail: <br>
                 <input type="text" name="email"><br><br>
                 Lösenord: <br>
                 <input type="password" name="password"><br><br>
            <input type="submit">
                
            <br>
            <br>
            <a href="registerform.php">Registrera dig här!</a>
          
            
            </form></div>
   
    </body>
</html>
