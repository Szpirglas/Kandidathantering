<?php
if (!isset($_COOKIE["loggedIn"])) {
    session_start();
    $_SESSION['user'] = array();
    $_SESSION['errors'] = array();
    if (empty($_SESSION['loginError'])) {
        $_SESSION['loginError'] = "";
    }
} else {


    require_once 'profileHandler.php';


    $connect = new ProfileHandler();

    $profile = $connect->getProfile($_COOKIE['loggedIn']);

    session_start();


    $_SESSION['user'] = $profile;
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    </head>
    <body>


        <section class="hero">        
            <video autoplay muted loop class="heroVideo" poster="content/bilder/rekryteringskaffe.png">
                <source src="content/videos/Rekryteringskaffe.mp4" type="video/mp4">
            </video>
            <div class="heroTextBig">
                <h1>DET BÄSTA MED ATT JOBBA PÅ STRATEG</h1>
                <p>Fina förmåner och utvecklingsmöjligheter i all ära, här på Strateg är det de lite mjukare värdena som smäller allra högst. Att vi har kul ihop. Att vi hjälper varandra att bli ännu bättre. Att vi bryr oss om varandra, på riktigt. Och nio-fikat så klart.</p>
            </div>
        </section>

        <section class="workForUs">
            <h1 class="heroTextSmall">DET BÄSTA MED ATT JOBBA PÅ STRATEG</h1>
            <p class="heroTextSmall">Fina förmåner och utvecklingsmöjligheter i all ära, här på Strateg är det de lite mjukare värdena som smäller allra högst. Att vi har kul ihop. Att vi hjälper varandra att bli ännu bättre. Att vi bryr oss om varandra, på riktigt. Och nio-fikat så klart.</p>
            <p>
                På frågan om vad som är det bästa med att jobba på Strateg får man en hel massa svar. Många nämner förstås att vi har möjlighet att utvecklas, medan andra älskar att vi jobbar så tydligt efter våra värdeord – professionalism, glädje och kreativitet. Några lyfter fram de gemensamma, nästan obligatoriska, fikastunderna, och någon annan berättar om hur himla roligt vi har tillsammans, varje dag på jobbet och ibland vid sidan av det också.
            </p>
            <p>
                Något som nästan alla tar upp är den här speciella känslan av omtanke, av att alla faktiskt bryr sig om. Inte för att man ska och borde, utan för att det är så vi är här på Strateg. Fint, tycker vi.
            </p>
            <h3>
                Vi har alltid ett fönster öppet
            </h3>
            <p>
                På Strateg är vi alltid nyfikna på spännande människor med intressanta kunskaper och kompetenser. Dra iväg en spontanansökan genom att skapa en profil!
            </p>
            <p>
                Och du, just nu finns det några koppar lediga
            </p>

        </section>
        <section class="profile">
            <?php
            if (!isset($_COOKIE["loggedIn"])) {
                include_once 'loginform.php';
            } else {
                include_once 'success.php';
            }
            ?>
        </section>

        <section class="jobs">


            <?php

            function listJobs() {
                require_once("blogHandler.php");

                $api = new BlogHandler();

                $jobs = $api->getBlog(getenv('HSBLOG_JOBS'));




                foreach ($jobs as $job) {

                    echo("<div class='jobContainer'>" .
                    "<div class='jobWrapper'>" .
                    "<a href='job.php?" . $job['id'] . "'>" .
                    "<div class='imageWrapper'>" .
                    "<img class='jobListingImage' src='" . $job['image'] . "' alt='" . $job['title'] . "'/>" .
                    "</div>" .
                    "</a>" .
                    "<a href='job.php?" . $job['id'] . "'>" .
                    "<div class='jobTitleButton button button-white'>" . $job['title'] . "</div>" .
                    "</a>" .
                    "</div>" .
                    "</div>");
                }

                echo("<div class='jobContainer'>" .
                "<div class='jobWrapper'>" .
                "<a href='message.php'>" .
                "<div class='imageWrapper'>" .
                "<img class='jobListingImage' src='content/bilder/meddelande.png' alt='meddelande'/>" .
                "</div>" .
                "</a>" .
                "<a href='message.php'>" .
                "<div class='jobTitleButton button button-white'>Frågor? Skicka meddelande!</div>" .
                "</a>" .
                "</div>" .
                "</div>");
            }

            listJobs();
            ?>

        </section>

        <section class="blog">

            <div class="latestBlogPost">
                <?php

                function getBlogPosts() {



                    require_once("blogHandler.php");

                    $api = new BlogHandler();


                    $blogPosts = $api->getBlog(getenv('HSBLOG_NEWS'));


                    foreach ($blogPosts as $blogPost) {

                        echo("<div class='blogPostContainer'>" .
                        "<div class='blogPostTitle'><h2>" . $blogPost['title'] . "</h2></div>" .
                        "<div class='blogPostPost'>" . $blogPost['post'] . "</div>" .
                        "<div class='blogPostAuthor'>" . $blogPost['author'] . "</div>" .
                        "</div>");

                        if (strlen($blogPost['title']) >= 1) {
                            break;
                        }
                    }
                }

                getBlogPosts();
                ?>
            </div>
            <div class="viewBlog">
                <form class="viewBlogBtn" action="Blog.php">
                    <input class="button button-black" type="submit" value="Se hela bloggen" />
                </form>
            </div>
        </section>

        <section class="imageGallery">
            <img src="content/ord/fotboll.png"/>
            <video autoplay muted loop poster="content/bilder/fikabord.png">
                <source src="content/videos/trappa.mp4" type="video/mp4">
            </video>
            <img src="content/ord/friskvård.png"/>
            <img src="content/bilder/reception.jpg"/>
            <img src="content/ord/fika.png"/>
            <img src="content/bilder/trappa.jpg"/>                    
            <img src="content/ord/flamingo.png"/>
            <img src="content/bilder/glad.jpg"/>
            <img src="content/ord/hus.png"/>
            <video autoplay muted loop poster="content/bilder/kaffe.jpg">
                <source src="content/videos/filma.mp4" type="video/mp4">
            </video>
            <img src="content/ord/skratt.png"/>
            <img src="content/bilder/glass.jpg"/>
            <img src="content/ord/godis.png"/>
            <video autoplay muted loop poster="content/bilder/hus.jpg">
                <source src="content/videos/rita.mp4" type="video/mp4">
            </video>
            <img src="content/ord/hackaton.png"/>
            <img class="hideIf2000pxOrMore" src="content/bilder/skratt.jpg"/>
            <img class="hideIf2000pxOrMore" src="content/ord/läge.png"/>
            <video class="hideIf2000pxOrMore" autoplay muted loop>
                <source src="content/videos/megaman.mp4" type="video/mp4">
            </video>
        </section>
    </body>
</html>

<?php
if (!isset($_COOKIE["loggedIn"])) {
    $_SESSION['loginError'] = "";
}
?>
