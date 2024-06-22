<?php
require __DIR__. '/../assets/database/connection.php';
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
    $comment_id = uniqid();
    $limit = $_POST['limit'];
    $post_id = $_POST['postid'];
    $post_userid = $_POST['postuserid'];
    $user_id = $_POST['userid'];
    $comment = $_POST['comment'];
    $query = "INSERT INTO comment(comment_id, post_id, user_id, comment) VALUES('$comment_id', $post_id, '$user_id', '$comment')";
    mysqli_query($conn, $query);

   //  notify user in the post
   if ($post_userid !== $user_id) {
       $query = "INSERT INTO forum_notification(post_id, user_id, source_id, type)
                 VALUES($post_id, '$post_userid', '$user_id', 'comment')";
       mysqli_query($conn, $query);
   }
}

$reply_input = "reply".uniqid();
$add_reply = "btnRep".uniqid();
?>
           <?php
              $query = "SELECT user_account.user_id, user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,comment.comment_id, comment.date, comment.time, comment.comment
                        FROM user_account
                        INNER JOIN comment ON user_account.user_id = comment.user_id
                        INNER JOIN post ON comment.post_id = post.post_id
                        WHERE comment.user_id = '$user_id' AND post.post_id = $post_id
                        ORDER BY date DESC, time DESC
                        LIMIT 1;";
               $result = mysqli_query($conn, $query);        
                                
               if (mysqli_num_rows($result) === 0) {
                  $query = "SELECT user_account.user_id, user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,comment.comment_id, comment.date, comment.time, comment.comment
                  FROM user_account
                  INNER JOIN comment ON user_account.user_id = comment.user_id
                  INNER JOIN post ON comment.post_id = post.post_id
                  WHERE post.post_id = $post_id";
                 $result = mysqli_query($conn, $query);
               }
               $row = mysqli_fetch_assoc($result);

            ?>
                   <li>
                   <a href="view_profile.php?user_id=<?php echo $row['user_id']?>" class="nav-link">  
                     <div id="userComment" class="container-fluid py-1">
                       <div id="userInfo" class="d-flex">
                          <div id="imgContainer">
                           <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
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
                              </div>
                          </div>
                        </div>  
                       </div>     
                     </a>
                       <div id="comment-con" class="px-4">
                           <div style="border-left: 1px solid #121212;">
                            <div class="comment px-3 py-1">
                              <?php echo $row['comment']?>
                             </div>
                              <div class="action-con px-3">
                                <span class="btn-reply rounded-5 px-3 py-1" style="cursor: pointer;">
                                 <i class="bi bi-reply"></i> Reply
                                </span> 
                                  <div class="reply-container">
                                       <div class="reply-input py-2 d-flex align-items-center">
                                         <input type="hidden" id="comment_userid" value="<?php echo $row['user_id']?>">
                                         <input type="hidden" id="commentId" value="<?php echo $row['comment_id']?>">
                                         <input type="text" name="reply" id="reply" placeholder="Add a Reply..." class="replay-input form-control rounded-5" style="width: 80%;">
                                         <button class="btn-add-reply btn btn-primary ms-2 py-2 px-3 rounded-5" disabled>Reply</button> 
                                      </div> 
                                  </div>
                                   <div class="reply-list-con pt-2">
                                           <div class="text-start">
                                                <?php 
                                                   $comment_id = $row['comment_id'];
                                                   $query = "SELECT * FROM reply WHERE comment_id = '$comment_id'";
                                                   $total_replies = mysqli_num_rows(mysqli_query($conn, $query));
                                                ?>
                                                <?php if($total_replies > 0):?>
                                                  <span comment-id="<?php echo $comment_id?>" class="btn-view-replies text-primary rounded-5"><?php echo $total_replies?> replie/s</span>
                                                 <?php endif;?>
                                           </div>
                                        
                                            <div class="reply-list">
                                          
                                             </div>
                                             
                                     </div> 
                             </div>
                        </div>
                      </div>
                        </li>
            
 <script>
             $('.replay-input').keyup(function(){
                let inputComm = $(this).val().trim();
                 if (inputComm == '' || inputComm == null) {
                   $(this).parent().children('button').attr('disabled', 'true');
                 }else{
                  $(this).parent().children('button').removeAttr('disabled')
                 }
              })
               $('.btn-add-reply').click(function(){
                 let btnReply = $(this);
                 let replyList = $(this).parent().parent().siblings('.reply-list-con').children('div.reply-list');
                 let commentUserId = $(this).parent().children('input#comment_userid').val();
                 let commentID = $(this).parent().children('input#commentId').val();
                 let reply = $(this).parent().children('input#reply').val();
                 $(this).parent().children('input#reply').val('');  
                 $.ajax({
                 url: 'ajax/reply.php',
                 method: 'POST',
                 data: {
                  comment_userid: commentUserId,
                  comment_id: commentID,
                  reply: reply,
                  },
                 success: function(data){
                  btnReply.attr('disabled', 'true');
                  replyList.prepend(data);
                   //  $('#commentContainer').prepend(data)
                 },
                 error: function(data){
                  alert(data)
                 }
              })

            })
 </script>