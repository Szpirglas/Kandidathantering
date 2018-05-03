<?php ?>

<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <section class="hero">        
            <video autoplay muted loop class="heroVideo">
                <source src="content/videos/Rekryteringskaffe.mp4" type="video/mp4">
            </video>
            <div class="heroText">
                <h1>DET BÄSTA MED ATT JOBBA PÅ STRATEG</h1>
                <p>Fina förmåner och utvecklingsmöjligheter i all ära, här på Strateg är det de lite mjukare värdena som smäller allra högst. Att vi har kul ihop. Att vi hjälper varandra att bli ännu bättre. Att vi bryr oss om varandra, på riktigt. Och nio-fikat så klart.</p>
            </div>
        </section>

        <section class="workForUs">
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
            <?php include 'index.php'; ?>
        </section>

        <section class="jobs">
            Here be jobs
        </section>

        <section class="blog">
            <div class="viewBlog">
                // Fixa länk i action!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                <form class="viewBlogBtn" action="">
                    <input type="submit" value="Se hela bloggen" />
                </form>
            </div>
            <div class="latestBlogPost">
                <?php

                function getBlogPosts() {
                    require_once("apiKeyConnect.php");

                    $api = new apiKeyConnect();

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
        </section>

        <section class="imageGallery">

                    <img src="content/ord/fotboll.png"/>
               
                    <video autoplay muted loop>
                        <source src="content/videos/trappa.mp4" type="video/mp4">
                    </video>
               
                    <img src="content/ord/friskvård.png"/>
                    <img src="content/bilder/reception.jpg"/>
                    <img src="content/ord/fika.png"/>
                    <img src="content/bilder/trappa.jpg"/>                    
<!--                    <img src="content/bilder/hus.jpg"/>-->
                    <img src="content/ord/flamingo.png"/>
<!--                    <img src="content/bilder/fikabord.png"/>-->
                    <img src="content/bilder/glad.jpg"/>
                    <img src="content/ord/hus.png"/>
                    
                    <video autoplay muted loop>
                        <source src="content/videos/filma.mp4" type="video/mp4">
                    </video>
                    
                    <img src="content/ord/skratt.png"/>
                    <img src="content/bilder/glass.jpg"/>
                    <img src="content/ord/godis.png"/>
<!--                    <img src="content/bilder/kaffe.jpg"/>-->
                    
                    <video autoplay muted loop>
                        <source src="content/videos/rita.mp4" type="video/mp4">
                    </video>
                    
                    <img src="content/ord/hackaton.png"/>
                    
                    <video class="hideIf2000pxOrMore" autoplay muted loop>
                        <source src="content/videos/megaman.mp4" type="video/mp4">
                    </video>
                    
                    <img class="hideIf2000pxOrMore" src="content/ord/läge.png"/>
                    <img class="hideIf2000pxOrMore" src="content/bilder/skratt.jpg"/>
<!--                    <img src="content/ord/code.png"/>-->
                    
<!--                    <video autoplay muted loop>
                        <source src="content/videos/roligt.mp4" type="video/mp4">
                    </video>-->
                    
<!--                    <video autoplay muted loop>
                        <source src="content/videos/lava.mp4" type="video/mp4">
                    </video>-->
        </section>


    </body>
</html>

