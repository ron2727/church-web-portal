<?php
require __DIR__ .'/../assets/database/connection.php';
session_start();

$post_id = $_POST['post_id'];
$user_id = $_SESSION['user_id'];


$query = "SELECT * FROM forum_like WHERE user_id = '$user_id' AND post_id = $post_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

 <?php if(mysqli_num_rows($result) > 0):?>
       <?php 
         $query = "DELETE FROM forum_like WHERE user_id = '$user_id' AND post_id = $post_id";
         mysqli_query($conn, $query); 
       ?>
       <i id="btnHeart" class="bi bi-heart" style="cursor:pointer"></i>
       <?php
        $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
        $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
       ?>
       <?php echo $total_likes?>
  <?php else:?>
     <?php 
         $query = "INSERT INTO forum_like(user_id, post_id) VALUES('$user_id', $post_id)";
         mysqli_query($conn, $query); 
       ?>
       <i id="btnHeart" class="bi bi-heart-fill text-danger" style="cursor:pointer"></i>
       <?php
        $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
        $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
       ?>
       <?php echo $total_likes?> 
 <?php endif;?>