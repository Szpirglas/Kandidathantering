<?php

session_start();

     function sendQuery($query) {
        
        require_once 'dbConnection.php';
        
        $db = new dbConnection();
        
        $connect = $this->db->connect();

        if ($connect->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        }
        
        $result = $connect->query($query);
        
        $connect->close();
        
        return $result;
    }
    
    function hasApplied($vid, $jobId)
    {
        $query = "SELECT * FROM JOBAPPLY WHERE USERID = " . $vid . " AND JOBPOSTID = " . $jobId;
        
        $result = $this->sendQuery($query);
        
        if ($result->num_rows > 0)
        {
            
            return true;
            
        }
        
        else {
            
            return false;
            
        }
        
        function Apply($vid, $jobId)
        {
            $query = "INSERT INTO JOBAPPLY (USERID, JOBPOSTID, STATUS) VALUES (" . $vid . ", " . $jobId . ", 'Applied')";
            
            $this->sendQuery($query);
        }
        
        
    }


?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title> <?php
        $jobId = $_SERVER['QUERY_STRING'];
        require_once("blogHandler.php");
        $api = new BlogHandler();
        $job = $api->getBlogPost($jobId);

        echo $job['title'];
        ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
    <body>
        <?php
        $jobId = $_SERVER['QUERY_STRING'];
        require_once("blogHandler.php");
        $api = new BlogHandler();
        $job = $api->getBlogPost($jobId);

        echo("<div class='jobPostContainer'>" .
        "<div class='jobPostImageWrapper'>" .
        "<img class='jobPostImage' src='" . $job['image'] . "' alt='" . $job['title'] . "'/>" .
        "</div>" .
        "<div class='jobPostText'>" .
        "<div class=''><h1>" . $job['title'] . "</h1></div>" .
        "<div class=''>" . $job['body'] . "</div>" .
        "</div>" .
        "</div>");
        
       
       
       
       
       if ($this->hasApplied($_SESSION['user']['vid'], $jobId))
       {
           echo '<button type="button" disabled>Sök detta jobb</button>';
       }
       
       else {
           
           echo 'tada!';
         
               
           
       }
       
        ?>
    </body>
</html>

