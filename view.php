<?php 
  include "includes/connect.php";
  session_start();

  $rid = $_GET['rid'];// het the rid parameter of GET request using $_GET associative array
  $qry = "SELECT * FROM `tbl_recipe` where `recipe_id`='$rid'";
  $sql = mysqli_query($conn,$qry);
  if(mysqli_num_rows($sql)>0) 
     $row=mysqli_fetch_assoc($sql);
  else 
     $warning = "Invalid page";
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
            <div class="disp decription">
                <h2><?php echo $row['name'];?></h2>
                <p ><?php echo $row['description'];?></p>
                <h3>Ingredients</h3>
                <?php echo $row['ingredients'];?>
                <h3>Directions</h3>
                 <?php echo $row['directions'];?>
                <h3>Your Photos</h3>
                <ul class="inline">
                    <li><img src="uploads/<?php echo $row['photo'];?>"></li>
                </ul>
                <h3>Add Comments</h3>
                <form method="post" id="frm">
                <textarea name="comment" id="comment"></textarea>
                <input type="button" value="submit" onclick="showComments()"/>
                </form>
                
                <div id="comments" class="comments">
                <?php $qry1 = "SELECT * FROM `tbl_comments` where `recipe_id` = '$rid'";
                $sql1 = mysqli_query($conn,$qry1);
                if(mysqli_num_rows($sql1)>0) {
                while($row1=mysqli_fetch_assoc($sql1)) {
                $uid = $row1['user_id'];
                $qry2 = "SELECT * FROM `tbl_user` where `user_id` = '$uid'";
                $sql2 = mysqli_query($conn,$qry2);
                $row2=mysqli_fetch_assoc($sql2);
                echo "<div class='comment'>";
                echo "By:<b>".$row2['user_name']."</b><br>";
                echo $row1['comment'];
                echo "</div>";
                }
                }
                else echo "Nocomments"; ?>
                </div>
                <script>
                function showComments() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("comments").innerHTML += this.responseText;
                        }
                    };
                    var comment = document.getElementById("comment").value;
                    document.getElementById("frm").reset();
                    xhttp.open("GET", "showComment.php?rid=<?php echo $rid;?>&comment="+comment, true);
                    xhttp.send();
                }
                </script>
            </div> 
            <p class="footer">&#169; 2014 Recipe World</p>
        </div>
    </body>  
</html>