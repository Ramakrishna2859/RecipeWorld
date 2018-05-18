<?php 
include "includes/connect.php";
session_start();
if(!isset($_SESSION['email'])) 
    header('location:login.php');

if(isset($_POST['sub'])) {
    $rname = $_POST['rname'];
    $description = $_POST['description'];    
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    $user_id=$_SESSION['user_id'];
   
    $uploadOk = 0;
    // https://www.tutorialspoint.com/php/php_file_uploading.htm
    //To Do: Check the file size. It should be less than 50000.
    //To Do: Restrict the file type to jpg or jpeg or gif.
    //To Do: Uload the file using PHP move_uploaded_file() function
    //TO Do change the $uploadOk to 1 after above if above tasks are completed
    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $tmp=explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($tmp));
        
        $expensions= array("jpeg","jpg","gif");
        
        if(in_array($file_ext,$expensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 500000){
           $errors[]='File size must be excately 50000';
        }
        
        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"images/".$file_name);
           $uploadOk=1;

        }else{
           print_r($errors);
        }

     }
    if ($uploadOk == 1) {
    $photo= $_FILES["image"]["name"];
    $qry = "INSERT INTO `tbl_recipe`(`name`,`user_id`,`description`,`ingredients`,`directions`,`photo`) VALUES('$ranme','$user_id','$description','$ingredients','$directions','$photo');";
    //create an insert query to insert name, userid, description, ingredients, directions and photo name to recipe table
    // execute the query
    mysqli_query($conn,$qry) or die("Connection failed: " . $qry);
        header('location:recipes.php');
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
                <h2>Suggest</h2>
                <h4> <?php if(isset($warning)) echo $warning; ?></h4>
                <!--NOTE: enctype is necessary for upload and you cant use GET, only POST-->
                <form class="form" method="post" action="" enctype="multipart/form-data">
                Recipe Name<input type="text" name="rname">
                Description<textarea name="description"></textarea>
                Ingrediants<textarea name="ingredients"></textarea>
                Directions<textarea name="directions"></textarea>
                Photo<input type="file" name="image" id="photo">
                <input type="submit" name="sub" value="Click to Submit">
            </form>
            </div> 
            <p class="footer">&#169; 2014 Recipe World</p>
        </div>
    </body>  
</html>