<?php
if (!isset($_COOKIE["loggedIn"])) {
    echo ("<p id='NotLoggedIn'></p>");
} else {
    session_start();
}


?>

<html>
    <head>
        <title>Strateg - Meddelande</title>
        <link rel='shortcut icon' type='image/x-icon' href='content/favicon.ico' />
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="navHeader">
            <a href="index.php">
                <img class="navImg" src="content/bilder/Strateg_liggande-SVART_1.png" alt="index"/>
            </a>
        </div>
        <div class="messageContainer hsFormContainer">
            <h1>Skicka ett meddelande</h1>
            <!--[if lte IE 8]>
      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
      <![endif]-->
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
            <script>


                var email = "<?php
if (!isset($_COOKIE["loggedIn"])) {
    echo "";
} else {
    echo $_SESSION['user']['email'];
}
?>";


                hbspt.forms.create({
                    portalId: "2896922",
                    formId: "1e71a04b-87da-45d9-b262-60ad26735ee1",
                    css: "",
                    onFormReady: function ($form) {
                        $('input[name="email"]').val(email).change();
                        if ($("#NotLoggedIn").length == 0) {
//                            $('input[name="email"]').val(email).change();
                            $('.hs_email').hide().change();
                        } else {
//                            $('input[name="email"]').val("").change();
                        }
                    },

                    onFormSubmit: function ($form) {

                        setTimeout(function () {
                            window.location.replace("index.php");
                        }, 2000);

                    }
                });

            </script> 
        </div>
    </body>
</html>

