<?php
     require_once 'profileHandler.php';


    $connect = new ProfileHandler();

    $profile = $connect->getProfile($_COOKIE['loggedIn']);

    session_start();


    $_SESSION['user'] = $profile;

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    </head>
    <body>
        <!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
        <section class="updateProfileFormContainer">
            <h1>Uppdatera profil</h1>
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
            <script>
                var firstname = "<?php echo $_SESSION['user']['firstname'] ?>";
                var lastname = "<?php echo $_SESSION['user']['lastname'] ?>";
                var email = "<?php echo $_SESSION['user']['email'] ?>";
                var area_of_interest = "<?php echo $_SESSION['user']['area_of_interest'] ?>".split("; ");
                var cv = "<?php echo $_SESSION['user']['cv'] ?>";
                var personligt_brev = "<?php echo $_SESSION['user']['personligt_brev'] ?>";

                hbspt.forms.create({
                    portalId: "2896922",
                    formId: "479de400-f121-410c-8e10-fd2f4ba968a6",
                    css: "",
                    onFormReady: function ($form) {
                        $('input[name="firstname"]').val(firstname).change();
                        $('input[name="lastname"]').val(lastname).change();
                        $('input[name="email"]').val(email).change();

                        $('input[value="Strateg"]').prop('checked', true).change();
                        $('input[value="Strateg"]').closest('li').hide();
                        

                        if (area_of_interest.includes("Marknadsforing")) {
                            $('input[value="Marknadsforing"]').prop('checked', true).change();
                        }
                        if (area_of_interest.includes("IT")) {
                            $('input[value="IT"]').prop('checked', true).change();
                        }
                        if (area_of_interest.includes("GrafiskDesign")) {
                            $('input[value="GrafiskDesign"]').prop('checked', true).change();
                        }
                        

                        if (cv != " ") {
                            $('.hs-fieldtype-file').find("legend").html("<a href=" + cv + ">Se uppladdat CV.</a><p>Ladda upp ett nytt CV om du önskar ersätta det gamla</p>").change();
                        } else {
                            $('.hs-fieldtype-file').find("legend").html("").change();
                        }


                        $('textarea[name="personligt_brev"]').val(personligt_brev).change();                    
                    },

                    onFormSubmit: function ($form) {

                        setTimeout(function () {
                            window.location.replace("index.php");
                        }, 2000);

                    }


                });
            </script>
        </section>









        <!--        <div id="updateForm">
                    <form action="updateprofile.php" method="post">
                        Förnamn:<br>
                        <input type="text" name="firstname"><br>
                        Efternamn:<br>
                        <input type="text" name="lastname"><br>
        
                        Intresseområde: <br>
                        <input type="radio" name ="intresse" value="IT">IT<br>
                        <input type="radio" name="intresse" value="Marknadsföring">Marknadsföring<br>
                        <input type="radio" name="intresse" value="Försäljning">Försäljning<br>
                        <input type="submit">
        
        
        
        
                    </form>
                </div>-->
    </body>
</html>
