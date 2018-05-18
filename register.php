<?php 
include "includes/connect.php";
session_start();

if(isset($_POST['sub'])) {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $qry = "INSERT INTO `tbl_user` ( `user_name`, `user_email`, `password`) VALUES ('$name', '$email', '$pass')";
        mysqli_query($conn,$qry) or die("Connection failed: " . mysqli_error());
        header('location:login.php');
    }
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
                <h2>Suggest</h2>
                <form class="form" method="post" action="">
                Name<input type="text" name="name">
                Email<input type="text" name="email">
                Password<input type="password" name="pass">
                Retype Password <input type="text" name="repass">
                <input type="submit" name="sub" value="Click to Submit">
            </form>
            </div> 
            <p class="footer">&#169; 2014 Recipe World</p>
        </div>
    </body>  
</html>