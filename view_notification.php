<?php
require __DIR__ .'/assets/database/connection.php';

$notif_id = $_GET['notif_id'];
$post_id = $_GET['post_id'];
$query = "UPDATE forum_notification SET view = 'yes' WHERE notification_id = $notif_id";
mysqli_query($conn, $query);


$query = "SELECT * FROM forum_notification WHERE notification_id = $notif_id";
$type = mysqli_fetch_assoc(mysqli_query($conn, $query));
if ($type['type'] === 'banned2') {
    header("Location: view_topic.php?topic_id=$post_id");
    exit;
}
header("Location: view_post.php?post_id=$post_id");
exit;

?>