<<<<<<< HEAD
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>

<?php

function getBlogPosts() {
    require_once("blogHandler.php");

    $api = new BlogHandler();

    $blogPosts = $api->getBlog(getenv('HSBLOG_NEWS'));

    foreach ($blogPosts as $blogPost) {
        
        echo("<div class='blogPostContainer'>".
                "<div class='blogPostTitle'><h2>". $blogPost['title'] ."</h2></div>".
                "<div class='blogPostPost'>". $blogPost['post'] ."</div>".
                "<div class='blogPostAuthor'>". $blogPost['author'] ."</div>".
                "<hr>".
                "</div>");

    }
}

getBlogPosts();

?>
    

</body>
</html>


    
=======
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>

<?php

function getBlogPosts() {
    require_once("apiKeyConnect.php");

    $api = new apiKeyConnect();

    $blogPosts = $api->getBlog(getenv('HSBLOG_NEWS'));

    foreach ($blogPosts as $blogPost) {
        
        echo("<div class='blogPostContainer'>".
                "<div class='blogPostTitle'><h2>". $blogPost['title'] ."</h2></div>".
                "<div class='blogPostPost'>". $blogPost['post'] ."</div>".
                "<div class='blogPostAuthor'>". $blogPost['author'] ."</div>".
                "<hr>".
                "</div>");

    }
}

getBlogPosts();

?>
    

</body>
</html>


    
>>>>>>> Jimmy
