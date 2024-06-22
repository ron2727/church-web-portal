<?php
require __DIR__ .'/../assets/database/connection.php';
session_start();

 $user_id = $_SESSION['user_id'];


 if (isset($_POST['postid']) && !isset($_POST['commentid'])) {
    $post_id = $_POST['postid'];
    $post_userid = $_POST['post_userid'];
    $query = "UPDATE post SET status = 'Banned' WHERE post_id = $post_id";
    $type = 'post';
 }
 if (isset($_POST['topicid'])) {
    $topic_id = $_POST['topicid'];
    $topic_userid = $_POST['topic_userid'];
    $query = "UPDATE topics SET status = 'Banned' WHERE topic_id = $topic_id";
    $type = 'topic';
 }
 if (isset($_POST['commentid'])) {
   $post_id = $_POST['postid'];
   $comment_id = $_POST['commentid'];
   $com_userid = $_POST['com_userid'];
   $query = "UPDATE comment SET status = 'Banned' WHERE comment_id = '$comment_id'";
   $type = 'comment';
 }

 mysqli_query($conn, $query);
?>

                       <?php if($type === 'post'):?>
                       <p class="text-center text-success"><i class="bi bi-check-circle-fill"  style="font-size: 2rem;"></i></p>
                         <h5 class="text-center">Post was successfully banned</h5>
                        <br>
                        <div class="container-fluid text-center">
                            <a href="../view_post.php?post_id=<?php echo $post_id?>" target="_blank" class="nav-link"><h5 class="check-post text-primary">Check Post <i class="bi bi-box-arrow-right"></i></h5></a>
                        </div>
                       <?php endif;?> 

                       <?php if($type === 'topic'):?>
                       <p class="text-center text-success"><i class="bi bi-check-circle-fill"  style="font-size: 2rem;"></i></p>
                         <h5 class="text-center">Topic was successfully banned</h5>
                        <br>
                        <div class="container-fluid text-center">
                            <a href="../view_topic.php?topic_id=<?php echo $topic_id?>" target="_blank" class="nav-link"><h5 class="check-post text-primary">Check Post <i class="bi bi-box-arrow-right"></i></h5></a>
                        </div>
                       <?php endif;?> 

                       <?php if($type === 'comment'):?>
                       <p class="text-center text-success"><i class="bi bi-check-circle-fill"  style="font-size: 2rem;"></i></p>
                         <h5 class="text-center"> Comment was successfully banned</h5>
                        <br>
                        <div class="container-fluid text-center">
                            <a href="../view_post.php?post_id=<?php echo $post_id?>" target="_blank" class="nav-link"><h5 class="check-post text-primary">Check Post <i class="bi bi-box-arrow-right"></i></h5></a>
                        </div>
                       <?php endif;?>  
                       <div class="text-end px-4 py-3 border-top">
                          <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                       </div>

<?php
if ($type === 'post') {
   $type = 'banned1';
   $query = "INSERT INTO reported_member(user_id, type)
             VALUES('$post_userid', 'post')";
   mysqli_query($conn, $query);
   $query = "INSERT INTO forum_notification(post_id, user_id, source_id, type)
   VALUES($post_id, '$post_userid', '$user_id', '$type')";
}
if ($type === 'topic') {
  $type = 'banned2';
  $query = "INSERT INTO forum_notification(post_id, user_id, source_id, type)
  VALUES($topic_id, '$topic_userid', '$user_id', '$type')";
}

if ($type === 'comment') {
   $type = 'banned3';
   $query = "INSERT INTO reported_member(user_id, type)
             VALUES('$com_userid', 'comment')";
   mysqli_query($conn, $query);
   $query = "INSERT INTO forum_notification(post_id, user_id, source_id, type)
   VALUES($post_id, '$com_userid', '$user_id', '$type')";
 }

 mysqli_query($conn, $query);
?>