<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_COOKIE["loggedIn"])) {

    header("Location: index.php");
} else {


$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$interest = filter_input(INPUT_POST, 'intresse');



        
        
$email = $_COOKIE['loggedIn'];


require_once('ProfileHandler.php');

$updateProfile = new ProfileHandler();

require_once('apiKeyConnect.php');

$updateProfile = new apiKeyConnect();

$updateProfile->updateProfile($email, $firstname, $lastname, $interest);
 



}