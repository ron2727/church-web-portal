<?php
require __DIR__ .'/../assets/database/connection.php';
session_start();
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM forum_notification WHERE user_id = '$user_id' AND view = 'no'";
 $total_new_notif = mysqli_num_rows(mysqli_query($conn, $query))

?>
    <?php if($total_new_notif > 0):?>
        <span class="badge bg-danger float-start"><?php echo $total_new_notif?></span>
    <?php endif;?>
         