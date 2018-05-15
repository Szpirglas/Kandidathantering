<?php
session_start();
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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


        require_once 'JobApply.php';


        echo '<div id="jobSearch">';

        if (!isset($_SESSION['user'])) {
            echo 'Du måste vara inloggad för att kunna söka tjänsten';
        } elseif (hasApplied($_SESSION['user']['vid'], $jobId)) {

            echo "Du har redan sökt den här tjänsten!";
        } else {

            echo '<button type="button" id="jobApplyBtn">Sök detta jobb</button>';
        }
        
        echo '</div>'
        ?>
        
    </body>
</html>

<script>
    $(document).ready(function () {
        $('#jobApplyBtn').click(function () {

            $.ajax({
                type: "POST",
                url: "JobApply.php",
                data: {vid: <?php echo $_SESSION['user']['vid'] ?>,
                    jobId: <?php echo $_SERVER['QUERY_STRING'] ?>}
            }).done(function () {
            
            $('#jobSearch').html("Tack för din ansökan!"); 
                
            });

        });
    });


</script>

