
<!DOCTYPE html>
<html>
    <head>
        <title>Strateg - Blogg</title>
        <link rel='shortcut icon' type='image/x-icon' href='content/favicon.ico' />
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    </head>
    <body>
        <div class="navHeader">
            <a href="index.php">
                <img class="navImg" src="content/bilder/Strateg_liggande-SVART_1.png" alt="index"/>
            </a>
        </div>
        <?php
        //Hämta och visa alla blogginlogg från HR-bloggen
        function getBlogPosts() {
            require_once("handlers/blogHandler.php");
            

            $api = new BlogHandler();

            $blogPosts = $api->getBlog(getenv('HSBLOG_NEWS'));

            foreach ($blogPosts as $blogPost) {

                echo("<div class='blogPostContainer'>" .
                "<div class='blogPostTitle'><h2>" . $blogPost['title'] . "</h2></div>" .
                "<div class='blogPostPost'>" . $blogPost['post'] . "</div>" .
                "<div class='blogPostAuthor'>" . $blogPost['author'] . "</div>" .
                "<hr>" .
                "</div>");
            }
        }

        getBlogPosts();
        ?>


    </body>
</html>
