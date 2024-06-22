<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';

if(isset($_GET['userid'])){
    $user_id = $_GET['userid'];
    
    $query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $sql = 'INSERT INTO archived_user_account(
             user_id,
             role,
             status,
             email,
             password,
             firstname,
             lastname,
             ministry,
             certificate_baptism,
             profile,
             bio
            )
            VALUES(
                "'.$row['user_id'].'",
                "'.$row['role'].'",
                "'.$row['status'].'",
                "'.$row['email'].'",
                "'.$row['password'].'",
                "'.$row['firstname'].'",
                "'.$row['lastname'].'",
                "'.$row['ministry'].'",
                "'.$row['certificate_baptism'].'",
                "'.$row['profile'].'",
                "'.$row['bio'].'"
            )';
         mysqli_query($conn, $sql);

         $query = "DELETE FROM user_account WHERE user_id = '$user_id'";
         mysqli_query($conn, $query);
         header("Location: pending.php?action=archived");
         exit;    
}



?>