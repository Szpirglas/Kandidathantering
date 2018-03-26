<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbConnection
 *
 * @author mattias
 */
class dbConnection {
    
    
    
     function connect()
    {
     $servername = "server.sandinfoto.se";
     $database = "strateg";
     $username = "strateg";
     $password = "SUPenR0cks";
     
     return   mysqli_connect($servername, $username, $password, $database);
    }
}
