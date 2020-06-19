<?php
    include './external_autoload.php';
    
    $indeControllerReference = new controllers\IndexController();
    $indeControllerReference->index();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CMS</title>
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="style/public.css">
    </head>
    <body>
        
        <div id="application-header" class="web-header">
            <h1 class="logo">CMS</h1>
        </div>
            
        <div id="blog">
            <div id="category-header" class="component">
                <ul class="category-list">
                    <li class="category">Жълтини</li>
                    <li class="category">Клюки</li>
                    <li class="category">Истерии</li>
                    <li class="category">Скандали</li>
                </ul>
            </div>
                        
            <div id="content" class="component">
                
                <?php 
                
                foreach ($indeControllerReference->getBlogPostCollection() as $value) {
                    
                   echo "<div class='post'>";
                   echo "<header class='post-title'>{$value['title']}</header>";
                   echo "<div class='post-timestamp'>преди 1 час</div>";
                   echo "<a href='#'> - </a>";
                   echo "</div>";
                }

                ?>
                      
            </div>
        </div>
        
        <script src="scripts/client/netitquery.js"></script>
        <script src="scripts/vendor/jquery.js"></script>
        <script src="scripts/application/index.js"></script>
    </body>
</html>