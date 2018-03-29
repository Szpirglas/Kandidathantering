<?php

setcookie('loggedIn', '', time() - 3600);
unset($_SESSION['user']);
header("Location: index.php");
?>
