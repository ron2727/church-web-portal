 <?php
 require __DIR__ .'/assets/database/connection.php';

   
    $reported = false;
    $created_by = $_POST['created_by'];
    $reported_by = $_POST['reported_by'];
    $reason = $_POST['reason'];
    
    if (isset($_POST['postid'])) {
        $post_id = $_POST['postid'];
        $query = "SELECT * FROM reported_post WHERE post_id = $post_id AND reported_by = '$reported_by'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) === 0) {
            $query = "INSERT INTO reported_post(post_id, created_by, reported_by, reason) 
            VALUES($post_id, '$created_by', '$reported_by', '$reason')";
            mysqli_query($conn, $query);
        }else {
            $reported = true;
            $type = 'post';
        }
    }

    // if (isset($_POST['topicid'])) {
    //     $topic_id = $_POST['topicid'];
    //     $query = "SELECT * FROM reported_topic WHERE topic_id = $topic_id AND reported_by = '$reported_by'";
    //     $result = mysqli_query($conn, $query);
    //     if (mysqli_num_rows($result) === 0) {
    //         $query = "INSERT INTO reported_topic(topic_id, created_by, reported_by, reason) 
    //         VALUES($topic_id, '$created_by', '$reported_by', '$reason')";
    //         mysqli_query($conn, $query);
    //     }else {
    //         $reported = true;
    //         $type = 'topic';
    //     }
    // }
    if (isset($_POST['commentid'])) {
        $comment_id = $_POST['commentid'];
        $post_id = $_POST['post_id'];
        $query = "SELECT * FROM reported_comment WHERE comment_id = '$comment_id' AND reported_by = '$reported_by'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) === 0) {
            $query = "INSERT INTO reported_comment(post_id, comment_id, created_by, reported_by, reason) 
            VALUES($post_id, '$comment_id', '$created_by', '$reported_by', '$reason')";
            mysqli_query($conn, $query);
        }else {
            $reported = true;
            $type = 'comment';
        }
    }

 ?> 
  
                   <?php if($reported):?>
                    <div class="py-3">
                         <p class="text-center text-success"><i class="bi bi-check-circle-fill"  style="font-size: 2rem;"></i></p>
                         <h5 class="text-center">We already received your report, we will review this <?php echo $type?> and we will take an action immediately</h5>
                        <br>
                        <div class="container-fluid text-center">
                            <h3><span class="text-primary badge rounded-pill px-3" style="background: #60a5fa;"><i class="bi bi-check-lg"></i> <?php echo $reason?></span></h3>
                        </div>
                     </div>
                    <?php else:?>
                        <div class="py-3">
                         <p class="text-center text-success"><i class="bi bi-check-circle-fill"  style="font-size: 2rem;"></i></p>
                         <h5 class="text-center">Thank you, we received your report</h5>
                         <br>
                        <div class="container-fluid text-center">
                            <h3><span class="text-primary badge rounded-pill px-3" style="background: #60a5fa;"><i class="bi bi-check-lg"></i> <?php echo $reason?></span></h3>
                        </div>
                     </div>
                    <?php endif;?>     