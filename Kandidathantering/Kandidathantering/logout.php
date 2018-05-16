<?php
/* Här loggas användaren ut genom att cookiens expiration time sätts till - 3600 sekunder
 * och innehållet i $_SESSION tas bort */

session_start();
setcookie('loggedIn', '', time() - 3600);
session_unset();
header("Location: index.php");
?>
