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
    
$objBlog = $key->getBlogPosts();

$blogCount = $objBlog->total_count;



$testBlog = array();

for ($i = 0; $i < $blogCount; $i++)
{
    
$testBlog[] = $objBlog->objects[$i]->post_body;

}

echo " <table> ";

foreach ($testBlog as $blogPost)
{
   echo " <tr> ";
   echo " <td> ";
    echo $blogPost;
    echo " <hr> ";
    echo " </td> ";
    echo " </tr> ";
}

echo " </table> ";

?>
        
         
    </body>
</html>
