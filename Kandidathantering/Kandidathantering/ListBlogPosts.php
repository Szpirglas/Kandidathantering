


<?php

class ListBlogPosts {

    function getBlogPosts($blogId) {
        require_once("apiKeyConnect.php");


        $api = new apiKeyConnect();



        $blogPosts = $api->getBlogPosts($blogId);

        foreach ($blogPosts as $blogPost) {
            echo $blogPost['author'];
            echo $blogPost['post'];
        }
    }

}
?>
        
