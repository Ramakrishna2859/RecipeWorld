<?php 
include "includes/connect.php";
session_start();
if(isset($_SESSION['email'])) 
    header('location:index.php');

    if(isset($_POST['sub'])) {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $qry = "SELECT * FROM `tbl_user` WHERE  `user_email`='$email' AND `password`='$pass';";
        $sql = mysqli_query($conn,$qry) or die("Connection failed: " . mysqli_error());
        if(mysqli_num_rows($sql)>0) {
            $row=mysqli_fetch_assoc($sql);
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION["user"] = $row['user_name'];
            $_SESSION["email"] = $row['user_email'];
            header('location:index.php');
        } else {
            $warning = "Invalid login";
        }
    
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
                <h2>Login</h2>
                <h4> <?php if(isset($warning)) echo $warning; ?></h4>
                <form class="form" method="post" action="">
                Email<input type="text" name="email">
                Password<input type="password" name="pass">
                <input type="submit" name="sub" value="Click to Submit">
            </form>
            </div> 
            <p class="footer">&#169; 2014 Recipe World</p>
        </div>
    </body>  
</html>