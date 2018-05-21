<?php

// Hämta .env-filen

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
$dotenv->load();


require_once __DIR__ . '/../connections/hsConnection.php';

/**
 * Klass med två funktioner som används för att hämta en utvald blogg med alla inlägg, samt hämta
 * specifika inlägg ur en utvald blogg.
 * 
 */

class BlogHandler {

    protected $hsConnect;

    function __construct() {

        $this->hsConnect = new hsConnection();
    }

    function getBlog($blogId) {



        $url = 'https://api.hubapi.com/content/api/v2/blog-posts?hapikey=' . getenv('HS_APIKEY') . '&content_group_id=' . $blogId;

        try {
            $decoded = json_decode($this->hsConnect->getResponse($url));
        } catch (Exception $e) {
            require_once 'exceptionHandler.php';

            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);
        }

        $blogCount = $decoded->total_count;



        $blogPosts = array();

        for ($i = 0; $i < $blogCount; $i++) {


            $blogPosts[] = array(
                "author" => $decoded->objects[$i]->author_name,
                "post" => $decoded->objects[$i]->post_body,
                "image" => $decoded->objects[$i]->featured_image,
                "id" => $decoded->objects[$i]->id,
                "title" => $decoded->objects[$i]->title
            );
        }



        return $blogPosts;
    }

    function getBlogPost($postId) {
        $url = 'https://api.hubapi.com/content/api/v2/blog-posts/' . $postId . '?hapikey=' . getenv('HS_APIKEY');

        try {
            $decoded = json_decode($this->hsConnect->getResponse($url));
        } catch (Exception $e) {
            require_once 'exceptionHandler.php';

            $exHandler = new ExceptionHandler();
            $exHandler->addException($vid, $url, $e);
        }
        //Hämta endast jobb om parameter är id:t är giltigt
        if (!isset($decoded->status)) {
            $blogPost = array(
                "author" => $decoded->author_name,
                "author_email" => $decoded->author_email,
                "title" => $decoded->title,
                "body" => $decoded->post_body,
                "image" => $decoded->featured_image
            );

            return $blogPost;
        }
    }

}
