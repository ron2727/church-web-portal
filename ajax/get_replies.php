<?php
require __DIR__. '/../assets/database/connection.php';
 $comment_id = $_GET['comment_id'];
 $load_id = uniqid();
 $pageNum = "page". uniqid();
 $query = "SELECT user_account.user_id, user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, reply.reply, reply.date, reply.time
                        FROM user_account
                        INNER JOIN reply ON user_account.user_id = reply.user_id
                        WHERE reply.comment_id = '$comment_id' LIMIT 3";
 $result = mysqli_query($conn, $query);
 $number_replies = mysqli_num_rows($result);
?>
               
                 <?php while($row = mysqli_fetch_assoc($result)):?>
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
                  <?php endwhile;?>
                  <?php 
                   $query = "SELECT user_account.user_id, user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, reply.reply, reply.date, reply.time
                   FROM user_account
                   INNER JOIN reply ON user_account.user_id = reply.user_id
                   WHERE reply.comment_id = '$comment_id'";
                   $result = mysqli_query($conn, $query);
                   $number_replies = mysqli_num_rows($result);
                  ?>
                   <?php if($number_replies > 3):?>
                     <li>
                       <div id="loaderCon" class="container-fluid text-center py-3">
                          <button id="<?php echo $load_id?>" comment-id="<?php echo $comment_id?>" class="btn-loadmore btn btn-primary">
                               Load more reply
                          </button>
                        </div>
                     </li>  
                   <?php endif;?>
                         
         
    
     <script>
              let <?php echo $pageNum?> = 3;
                  $('#<?php echo $load_id?>').click(function(){
                    $(this).html(`
                           <div class="px-4 py-1">
                              <div class="reply-loading spinner-border spinner-border-sm text-white"></div>
                           </div>
                    `);
                    let commentId = $(this).attr('comment-id');
                    let replyList = $(this).parent().parent();
                    let spinner = $(this).siblings();
                    let btnLoadmore = $(this);
                    spinner.show();
                    btnLoadmore.hide();
                        // setTimeout(() => {
                        $.ajax({
                        url: 'ajax/load_more.php',
                        method: 'GET',
                        data: {
                           comment_id: commentId,
                           start: <?php echo $pageNum?>,
                           page: 'reply',
                        },
                        success: function(data){
                             if (!$.trim(data)) {
                                replyList.append('<p class="text-center">No More Reply</p>');
                                spinner.hide();
                                btnLoadmore.hide();
                             }else{
                                replyList.before(data);
                                spinner.hide();
                                btnLoadmore.html('Load more reply');
                                btnLoadmore.show();
                             }
                        }
                      })
                      <?php echo $pageNum?> = <?php echo $pageNum?> + 3;
                  //   }, 1000);
                      
                  })
      </script>
 