<?php
//Om query saknar siffror
if (preg_match('~[0-9]~', basename($_SERVER['REQUEST_URI'])) == 0) {
    header("Location: index.php");
}


// Om ingen query finns
if (!isset($_SERVER['QUERY_STRING'])) {
    header("Location: index.php");
}
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
        <title> 
            <?php
            $jobId = $_SERVER['QUERY_STRING'];



            require_once("blogHandler.php");
            $api = new BlogHandler();
            $job = $api->getBlogPost($jobId);
// Titel på besökt arbetsannons
            echo "Strateg - " . $job['title'];
            ?>
        </title>
        <link rel='shortcut icon' type='image/x-icon' href='content/favicon.ico' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="navHeader">
            <a href="index.php">
                <img class="navImg" src="content/bilder/Strateg_liggande-SVART_1.png" alt="index"/>
            </a>
        </div>
        <?php
        $jobId = $_SERVER['QUERY_STRING'];
        require_once("blogHandler.php");
        $api = new BlogHandler();
        $job = $api->getBlogPost($jobId);

        // Om parameter i url är korrekt visa jobb, annars visa ej jobb
        if (isset($job['title'])) {
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

// Om utloggad -> logga in
// Om inloggad och skickad ansökan -> ru har redan sökt meddelande
// Om inloggad -> sök jobb knapp
            if (!isset($_SESSION['user']['vid'])) {
                echo 'Du måste vara inloggad för att kunna söka tjänsten';
            } elseif (hasApplied($_SESSION['user']['vid'], $jobId)) {

                echo "Du har redan sökt den här tjänsten!";
            } else {

                echo '<button type="button" id="jobApplyBtn" class="button button-white">Sök detta jobb</button>';
            }

            echo '</div>';
        } else {
            echo "Detta jobb är inte tillgängligt.";
        }
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


                if (<?php echo strlen($_SESSION['user']['cv']) ?> < 5 || <?php echo strlen($_SESSION['user']['personligt_brev']) ?> < 5) {

                    // Uppmana att ladda upp dokument om det ej gjorts
                    alert('Glöm inte att ladda upp CV och personligt brev!');
                    $('#jobSearch').html("Tack för din ansökan! <a href='updateprofileform.php'>Klicka här för att lägga upp CV och personligt brev!</a>");
                } else
                {
                    $('#jobSearch').html("Tack för din ansökan!");
                }

            });

        });
    });


</script>

