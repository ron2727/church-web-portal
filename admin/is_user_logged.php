<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../signin.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user_account where user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>