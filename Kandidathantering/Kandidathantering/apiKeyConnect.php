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
    //put your code here
    
 

  
   
    function getBlogPosts()
    {
        
        return 'https://api.hubapi.com/content/api/v2/blog-posts?hapikey=79d91373-8e94-4879-893c-e7d080224a55';
        
    }
    
    function getContacts()
    {
        return 'https://api.hubapi.com/contacts/v1/lists/all/contacts/all?hapikey=79d91373-8e94-4879-893c-e7d080224a55&count=4';
        
    }
}




