<?php
include "includes/connect.php";
session_start();
$comment = $_GET['comment'];
$rid = $_GET['rid'];
$user_id = $_SESSION['user_id'];
$qry = "INSERT INTO `tbl_comments` ( `comment`, `user_id` , `recipe_id`)
VALUES ('$comment', '$user_id', '$rid');";
mysqli_query($conn,$qry) or die("error running query: ".$qry);

$qry2 = "SELECT * FROM `tbl_user` where `user_id` = '$user_id'";
$sql2 = mysqli_query($conn,$qry2) or die("error running query: ".$qry2);
$row2=mysqli_fetch_assoc($sql2);
echo "<div class='comment'>";
echo "By:<b>".$row2['user_name']."</b><br>";
echo $comment;
echo "</div>";
?>