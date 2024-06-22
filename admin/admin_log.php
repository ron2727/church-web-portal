<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: TaytayImmanuelChurchWebPortal/signin.php");
    exit;
}
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM admin where admin_id = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>


