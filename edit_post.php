<?php
require __DIR__ .'/assets/database/connection.php';
session_start();

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
   $user_id = $_SESSION['user_id'];
   $post_id = $_POST['postid'];
   $privacy = $_POST['privacy'];
   if ($privacy === 'Group') {
     $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
     $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
     $privacy = $group['ministry'];
   }

   $topic_id = $_POST['topic'];
   $text = $_POST['text'];

   $query = "UPDATE post SET topic_id = $topic_id, text = '$text', privacy = '$privacy' WHERE post_id = $post_id";
   mysqli_query($conn, $query);

     $query = "SELECT user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,post.status, post.date, post.time, topics.topic, post.text,post.views, post.post_id,post.privacy, user_account.user_id, topics.topic_id 
     FROM user_account 
     INNER JOIN post ON post.user_id = user_account.user_id 
     INNER JOIN topics ON post.topic_id = topics.topic_id
     WHERE post.post_id = $post_id;";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
}
?>

<div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">
                <a href="view_profile.php?user_id=<?php echo $row['user_id']?>" class="nav-link">  
                     <div id="userInfo" class="d-flex">    
                        <div id="imgContainer">
                           <img class="post-profile" src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="<?php $row['profile']?>">
                        </div>
                        <div id="userNameContainer" class="ms-2">
                           <div id="userName">
                              <span><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                               <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill">Admin</span>
                              <?php endif;?>
                           </div>
                           <div id="postedDate">
                              <?php echo date('F d, Y',strtotime($row['date']))?>
                               &nbsp;at&nbsp; 
                              <?php echo date('g:i A',strtotime($row['time']))?>
                                     <i class="bi bi-dot"></i>
                               <?php 
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
                                $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                $user_group = $group['ministry'];
                               ?>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i>
                               <?php endif;?>
                            </div>
                         </div>
                      
                    </div>
                    </a>
                    <div id="postMenu">
                       <div id="btnReport"
                            class="p-2" 
                            data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                        </div>
                        <ul class="dropdown-menu" style="cursor: pointer;">
                             <?php if($row['user_id'] === $_SESSION['user_id']):?>
                               <li id="openModal" class="dropdown-item" post-id="<?php echo $_POST['post_id']?> "><i class="bi bi-pencil-fill"></i> Edit Post</li>
                             <?php else:?>
                              <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportModal"><i class="bi bi-flag-fill"></i> Report</li>
                             <?php endif;?>
                        </ul>
                    </div>
                  
              </div>

              <div id="postContentContainer" class="px-3">
                  <div id="postTopic">
                     <?php
                       $query = 'SELECT status FROM topics WHERE topic_id = '.$row['topic_id'].'';
                       $status = mysqli_fetch_assoc(mysqli_query($conn, $query));
                     ?>
                     <?php if($status['status'] === 'Banned'):?>
                        <h4 class="topic text-dark">[Unavailable]</h4>
                     <?php else:?>
                        <a href="view_topic.php?topic_id=<?php echo $row['topic_id']?>">
                         <h4 class="topic text-dark"> <?php echo $row['topic']?></h4>
                        </a>
                     <?php endif;?>  
                  </div>
                   <div class="text">
                     <?php echo $row['text']?>
                   </div>
              </div>
            
              <div id="reactionInfo" class="container mt-2 py-3">
                   <?php
                    $post_id = $_POST['post_id'];
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM forum_like WHERE user_id = '$user_id' AND post_id = $post_id";
                    $is_post_hearted = mysqli_query($conn, $query);
                   ?>
                     <span id="totalLikes" postid="<?php echo $post_id?>">
                      <?php if(mysqli_num_rows($is_post_hearted) > 0):?>
                        <i id="btnHeart" class="bi bi-heart-fill text-danger" style="cursor:pointer"></i>
                       <?php else:?> 
                        <i id="btnHeart" class="bi bi-heart" status='' style="cursor:pointer"></i>
                      <?php endif;?>
                      <?php
                         $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
                         $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
                      ?>
                         <?php echo $total_likes?> 
                     </span>
                     <?php 
                       $post_id = $row['post_id'];
                       $query = "SELECT reply.reply
                                 FROM reply
                                 INNER JOIN comment ON reply.comment_id = comment.comment_id
                                 WHERE comment.post_id = $post_id";
                       $total_reply = mysqli_num_rows(mysqli_query($conn, $query));
                       
                       $query = "SELECT comment.comment
                                 FROM comment
                                 INNER JOIN post ON comment.post_id = post.post_id
                                 WHERE post.post_id = $post_id";
                        $total_comments = mysqli_num_rows(mysqli_query($conn, $query)); 
                      ?>
                    <span id="totalComments" class="ms-2">
                      <i class="bi bi-chat-left"></i> 
                       <?php echo ($total_reply + $total_comments)?>
                    </span>
                    <span id="totalViews" class="ms-2">
                      <i class="bi bi-eye"></i>
                      <?php echo $row['views']?>
                    </span>
              </div>
             <?php if($row['privacy'] === 'Locked'):?>
               <div id="commentField" class="container-fluid d-flex align-items-center border-top">
                <div id="inputComment" class="container">
                     <input type="text" name="comment" id="comment" placeholder="Add Comment..." class="form-control rounded-5" disabled>
                </div>
                <button type="submit" class="btn btn-primary rounded-5" disabled>Comment</button>  
               </div>
             <?php else:?>
                  <form id="commentForm" method="post">
                    <div id="commentField" class="container-fluid d-flex align-items-center border-top border-bottom">
                      <input type="hidden" id="postid" name="postid" value="<?php echo $_POST['post_id']?>">
                      <input type="hidden" id="postuserid" name="postuserid" value="<?php echo $row['user_id']?>">
                      <input type="hidden" id="userid" name="userid" value="<?php echo $_SESSION['user_id']?>">
                      <div id="inputComment" class="container">
                        <input type="text" name="comment" id="comment" placeholder="Add Comment..." class="form-control rounded-5">
                      </div>
                       <button id="btnComment" type="submit" class="btn btn-primary rounded-5" disabled>Comment</button>  
                    </div>
                 </form>
             <?php endif;?>
             
                  <?php if($row['privacy'] === 'Locked'):?>
                  <div class="d-flex justify-content-center">
                    <div class="pt-5">
                     <i class="bi bi-lock"></i> Comment is disabled
                   </div>
                 </div>
                 <?php endif;?>
           
              <script>
         $(document).ready(function(){
         
              $('#openModal').click(function(){
                 postID = $(this).attr('post-id');
                 $.ajax({
                        url: 'post_details.php',
                        type: 'POST',
                        data: {postid: postID},
                        success: function(data){
                            $('#modalBody').html(data);
                          }
                    })
                    $('#editpostModal').modal('show');
              })

                $('#editPost').submit(function(e){
                 e.preventDefault();
                 let formData = $(this).serialize();
                  $.ajax({
                        url: 'edit_post.php',
                        type: 'POST',
                        data: formData,
                    })
                  //   $('#editpostModal').modal('show');
              })
              $('.reply-container').hide();
             $('.btn-reply').click(function(){
                $('.reply-container').hide();
               $(this).siblings().show();
               })
              $('#comment').keyup(function(){
                let inputComm = $(this).val().trim();
                 if (inputComm == '' || inputComm == null) {
                   $('#btnComment').attr('disabled', 'true');
                 }else{
                  
                   $('#btnComment').removeAttr('disabled')
                 }
              })
              let userComTotal = 1;
              let = totalComm = <?php echo $total_comments?>;
             $('#commentForm').submit(function(e){
                e.preventDefault();
                $.ajax({
                url: 'ajax/comment.php',
                method: 'POST',
                data: {
                  postid: $('#postid').val(),
                  postuserid: $('#postuserid').val(),
                  userid: $('#userid').val(),
                  comment: $('#comment').val(),
                  limit: userComTotal
                },
                success: function(data){
                   if (totalComm === 0) {
                    $('#commentList').html(data);
                   }else{
                    $('#commentList').prepend(data);
                   }
                   $('#btnComment').attr('disabled', 'true');
                   $('#comment').val('');
                 }
             })
             userComTotal = userComTotal + 1;
          })
      })
       
     </script>