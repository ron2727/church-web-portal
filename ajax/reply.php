<?php
require __DIR__. '/../assets/database/connection.php';
session_start();
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
    $user_id = $_SESSION['user_id'];
    $comment_userid = $_POST['comment_userid'];
    $comment_id = $_POST['comment_id'];
    $reply = $_POST['reply'];
    $query = "INSERT INTO reply(comment_id, user_id, reply) VALUES('$comment_id', '$user_id', '$reply')";
    mysqli_query($conn, $query);

   //  notify user in the post
   // if ($comment_userid !== $user_id) {
   //     $query = "INSERT INTO forum_notification(post_id, user_id, source_id, type)
   //               VALUES($post_id, '$post_userid', '$user_id', 'reply')";
   //     mysqli_query($conn, $query);
   // }
}
?>
              <?php
                 $query = "SELECT user_account.user_id, user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, reply.reply, reply.date, reply.time
                          FROM user_account
                          INNER JOIN reply ON user_account.user_id = reply.user_id
                          WHERE reply.user_id = '$user_id' AND reply.comment_id = '$comment_id'
                          ORDER BY date DESC, time DESC
                          LIMIT 1;";
                 $result = mysqli_query($conn, $query);       
                 $row = mysqli_fetch_assoc($result); 

             ?>

               <li>
                   <a href="view_profile.php?user_id=<?php echo $row['user_id']?>" class="nav-link">  
                     <div id="userComment" class="container-fluid">
                       <div id="userInfo" class="d-flex">
                          <div id="imgContainer">
                           <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
                          </div>
                          <div id="userNameContainer" class="ms-1">
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
                       <div id="comment-con" class="ps-4 py-2">
                           <div style="border-left: 1px solid #121212;">
                            <div class="comment px-3 py-1">
                              <?php echo $row['reply']?>
                             </div>
                        </div>
                      </div>
                        </li>
 