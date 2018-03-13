<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       
       /* include_once('oathConnect.php');
        
       $oath = new oathConnect();
       
       $link = $oath->connect(); */
        
        include_once('apiKeyConnect.php');
        
        $key = new apiKeyConnect();
        
    
      
   
        
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $key->getContacts());
$result = curl_exec($ch);
curl_close($ch);

$obj = json_decode($result);

/*
$test = array(

$obj->contacts[0]->addedAt,

$obj->contacts[1]->addedAt,

$obj->contacts[2]->addedAt,

$obj->contacts[3]->addedAt
        
); 


foreach ($test as $thingy)
{
    echo $thingy;
    echo " <br> ";
    
} */

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $key->getBlogPosts());
$resultBlog = curl_exec($ch);
curl_close($ch);

$objBlog = json_decode($resultBlog);

$blogCount = $objBlog->total_count;



$testBlog = array();

for ($i = 0; $i < $blogCount; $i++)
{
    
$testBlog[] = $objBlog->objects[$i]->post_body;

}

foreach ($testBlog as $thingy)
{
    echo $thingy;
    echo " <br> ";
    
}

?>
        
         
    </body>
</html>
