<?php ?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="messageContainer">

            <!--        Sparar ner email i ett element för att kunna pusha in det i hubspotformuläret. 
            Fick det inte att fungera att blanda js, php och jquery vilket det hade krävt annars.
            En liten fuling :(-->
            <?php
            require_once("profileHandler.php");
            $api = new ProfileHandler();
            $vid = $_COOKIE['loggedIn'];
            $profile = $api->getProfile($vid);
            echo '<p class="emailHolder" style="display: none">' . $profile['email'] . '</p>'
            ?>



            <!--[if lte IE 8]>
      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
      <![endif]-->
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
            <script>

                var email = $('.emailHolder').text();
                hbspt.forms.create({
                    portalId: "2896922",
                    formId: "1e71a04b-87da-45d9-b262-60ad26735ee1",
                    css: "",
                    onFormReady: function ($form) {
                        $('input[name="email"]').val(email).change();
                    }
                });


            </script> 


        </div>
    </body>
</html>

