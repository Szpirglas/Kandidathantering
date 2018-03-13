<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of apiKeyConnect
 *
 * @author mattias
 */
class apiKeyConnect {

    function getResponse($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    function getBlogPosts() {
        
        
         $decoded =  json_decode($this->getResponse('https://api.hubapi.com/content/api/v2/blog-posts?hapikey=79d91373-8e94-4879-893c-e7d080224a55'));
         
         $blogCount = $decoded->total_count;



        $blogPosts = array();

        for ($i = 0; $i < $blogCount; $i++) {

            $blogPosts[] = array(
                "author"=>$decoded->objects[$i]->author_name,
                "post"=>$decoded->objects[$i]->post_body
                    );
        }


        return $blogPosts;

   
    }


}
