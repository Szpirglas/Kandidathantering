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
        
        include_once('apiKeyConnect.php');
        
        $key = new apiKeyConnect();
    
$objBlog = json_decode($key->getBlogPosts());

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
