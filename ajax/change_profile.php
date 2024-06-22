<?php
require __DIR__ .'/../assets/database/connection.php';
session_start();
if (isset($_POST['image'])) {
     $data = $_POST['image'];
     $user_id = $_SESSION['user_id'];

     $image1 = explode(';', $data);
     $image2 = explode(',', $image1[1]);
    $img_new_name = uniqid("PROFILE-IMG", false).'.png';
    $img_name = base64_decode($image2[1]);
    $image_name = '../assets/uploaded_images/profile/'.$img_new_name.'';
    file_put_contents($image_name, $img_name);    
    echo "<h1>$img_name</h1>";

    $query = "UPDATE user_account SET profile = '$img_new_name' WHERE user_id = '$user_id'";
    mysqli_query($conn, $query);
}
?>
