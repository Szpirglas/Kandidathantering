


<?php

function getBlogPosts() {
    require_once("apiKeyConnect.php");


    $api = new apiKeyConnect();

    $blogPosts = $api->getBlogPosts();

    foreach ($blogPosts as $blogPost) {
        echo $blogPost['author'];
        echo $blogPost['post'];
    }
}
?>
        
