<?php
require __DIR__ .'/../assets/database/connection.php';


 if (isset($_POST['postid'])) {
    $post_id = $_POST['postid'];
    $query = "SELECT * FROM reported_post WHERE post_id = $post_id";
    $type = 'post';
 }
 if (isset($_POST['topicid'])) {
    $topic_id = $_POST['topicid'];
    $query = "SELECT * FROM reported_topic WHERE topic_id = $topic_id";
    $type = 'topic';
 }
 if (isset($_POST['commentid'])) {
   $comment_id = $_POST['commentid'];
   $query = "SELECT * FROM reported_comment WHERE comment_id = '$comment_id'";
   $type = 'comment';
}
$result = mysqli_query($conn, $query);
$post_from = mysqli_fetch_assoc($result);
?>                    

           
            <?php
               $author_id = $post_from['created_by'];
               $query = "SELECT firstname, lastname, profile FROM user_account WHERE user_id = '$author_id'";
               $author = mysqli_fetch_assoc(mysqli_query($conn, $query));   
             ?>
                        <div>
                             <div class="text-center">
                              <img class="post-from-img" src="../assets/uploaded_images/profile/<?php echo $author['profile']?>" alt="">
                              </div> 
                              <div class="text-center">
                                 <?php echo $author['firstname']. ' ' .$author['lastname']?>
                               </div>
                                <div class="text-center" style="font-weight:bold">
                                  Owner
                                </div>
                           
                            &nbsp;
                       </div>

       <?php
        if (isset($_POST['postid'])) {
         $post_id = $_POST['postid'];
         $query = "SELECT * FROM reported_post WHERE post_id = $post_id";
         $type = 'post';
      }
      if (isset($_POST['topicid'])) {
         $topic_id = $_POST['topicid'];
         $query = "SELECT * FROM reported_topic WHERE topic_id = $topic_id";
         $type = 'topic';
      }
      if (isset($_POST['commentid'])) {
         $comment_id = $_POST['commentid'];
         $query = "SELECT * FROM reported_comment WHERE comment_id = '$comment_id'";
         $type = 'comment';
      }
     $result = mysqli_query($conn, $query);
     $total_reporter = mysqli_num_rows($result);
       ?> 
       <div>Reported by <span class="text-danger"><?php echo $total_reporter?></span> people</div>
       <table class="container-fluid">
                  <tr>
                     <td class="py-2" style="font-weight:bold">Profile</td>
                     <td class="py-2" style="font-weight:bold">Reason</td>
                  </tr>              
        <?php while($reporter = mysqli_fetch_assoc($result)):?>
             <?php
               $user_id = $reporter['reported_by'];
               $query = "SELECT firstname, lastname, profile FROM user_account WHERE user_id = '$user_id'";
               $name = mysqli_fetch_assoc(mysqli_query($conn, $query));   
             ?>
                    
                    
                             <!-- <div class="border-bottom">
                                <h5>Reporter: <?php echo $name['firstname']. ' ' .$name['lastname']?></h5>
                                <h5>Reason: <?php echo $reporter['reason']?></h5>
                              </div> -->

                              
                                 <tr>
                                    <td><img class="post-from-img" src="../assets/uploaded_images/profile/<?php echo $name['profile']?>" alt=""> <?php echo $name['firstname']. ' ' .$name['lastname']?></td>
                                    <td><?php echo $reporter['reason']?></td>
                                 </tr>
                              
        <?php endwhile;?>               
              </table>       