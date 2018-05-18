<?php 
include "includes/connect.php";
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
            <title>Recipe World</title>
            <link rel="stylesheet" href="home.css">
    </head>   
    <body>
        <div class="header">
            <?php include "includes/header.php"?>
        </div>
        <div class="content">
            <div class="disp">
                <h2>Home</h2>
                <h3 class="home-h3">Featured:Magic Cake</h3>
                <img src="images/magic-cake-featured.jpg" class="home-img">
            </div>
            <p class="footer">&#169; 2014 Recipe World</p>
        </div>
        
    </body>  
</html>