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
    
$blogPosts = $key->getBlogPosts();


echo " <table> ";

foreach ($blogPosts as $blogPost)
{
   echo " <tr> ";
   echo " <td> ";
    echo $blogPost["author"] . " <br> <br> " . $blogPost["post"];
    echo " <hr> ";
    echo " </td> ";
    echo " </tr> ";
}

echo " </table> ";

?>
   
    </body>
</html>
