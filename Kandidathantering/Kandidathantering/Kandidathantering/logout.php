<?php
/* Här loggas användaren ut genom att cookiens expiration time sätts till - 3600 sekunder
 * och innehållet i $_SESSION tas bort */


setcookie('loggedIn', '', time() - 3600);
unset($_SESSION['user']);
header("Location: index.php");
?>
