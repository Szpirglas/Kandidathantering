<?php

// Hämta .env-filen

require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require 'hsConnection.php';

$hsConnect;

class BlogHandler {
    
    function __construct()
    {
        $this->hsConnect = new hsConnection();
        
    }

    function getBlog($blogId) {



        $url = 'https://api.hubapi.com/content/api/v2/blog-posts?hapikey=' . getenv('HS_APIKEY') . '&content_group_id=' . $blogId;

        $decoded = json_decode($this->hsConnect->getResponse($url));

        $blogCount = $decoded->total_count;



        $blogPosts = array();

        for ($i = 0; $i < $blogCount; $i++) {


            $blogPosts[] = array(
                "author" => $decoded->objects[$i]->author_name,
                "post" => $decoded->objects[$i]->post_body,
                "image" => $decoded->objects[$i]->featured_image,
                "id" => $decoded->objects[$i]->id
            );
        }



        return $blogPosts;
    }

    function getBlogPost($postId) {


        $url = 'https://api.hubapi.com/content/api/v2/blog-posts/' . $postId . '?hapikey=' . getenv('HS_APIKEY');



        $decoded = json_decode($this->hsConnect->hsConnect($url));


        $blogPost = array(
            "author" => $decoded->author_name,
            "author_email" => $decoded->author_email,
            "title" => $decoded->title,
            "body" => $decoded->post_body
        );

        return $blogPost;
    }

}
