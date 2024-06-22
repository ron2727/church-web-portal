<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
     $post_id = $_POST['postid'];
     $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,post.status, post.date, post.time, topics.topic, post.text,post.views, post.post_id,post.privacy, user_account.user_id, topics.topic_id 
     FROM user_account 
     INNER JOIN post ON post.user_id = user_account.user_id 
     INNER JOIN topics ON post.topic_id = topics.topic_id
     WHERE post.post_id = $post_id;";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);

?>
    <link rel="stylesheet" href="assets/libs/textarea/ui/trumbowyg.min.css">
     <style>
        img{
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
     </style>
             <div id="postList" class="container border p-3">
                  <div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">
                    <div id="userInfo" class="d-flex">    
                        <div id="imgContainer">
                           <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="<?php $row['profile']?>">
                        </div>
                        <div id="userNameContainer" class="ms-3">
                           <div id="userName">
                              <span class="username-text"><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                               <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill ms-2">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill ms-2">Pastor</span>
                              <?php endif;?>
                           </div>
                           <?php 
                             $user_id = $row['user_id'];
                             $group = mysqli_fetch_assoc(mysqli_query($conn,"SELECT ministry FROM user_account WHERE user_id = '$user_id'"));
                             $user_group = $group['ministry'];
                           ?>
                            <div class="dropdown">
                              <button id="btnPrivacy" type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" style="background: #e5e7eb;font-weight:bold" <?php echo ($row['privacy'] === $user_group ? 'disabled' : '')?>>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i> Anyone
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i> Group
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i> Locked
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i> Private
                               <?php endif;?>
                             </button>
                             <ul class="dropdown-menu">
                               <li class="privacy-type dropdown-item"><i class="bi bi-globe-americas"></i> Anyone</li>
                               <li class="privacy-type dropdown-item"><i class="bi bi-people-fill"></i> Group</li>
                               <li class="privacy-type dropdown-item"><i class="bi bi-lock-fill"></i> Locked</li>
                               <li class="privacy-type dropdown-item"><i class="bi bi-incognito"></i> Private</li>
                             </ul>
                           </div>
                         </div>
                      
                    </div>          
              </div>
                     <br>
                     <!-- <form id="editPost" action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> -->
                      <input class="form-control" type="hidden" name="postid" id="postid" value="<?php echo $post_id?>">
                      <input class="form-control" type="hidden" name="privacy" id="privacy" value="<?php echo ($row['privacy'])?>">
                      <input class="form-control" type="hidden" name="topic" id="topic" value="<?php echo $row['topic_id']?>">
                      <label class="label-head">Topic</label>
                        <div class="dropdown">
                              <button id="btnTopic" type="button" class="btn btn-white border" data-bs-toggle="dropdown" style="font-weight:bold;width:100%;">
                                 <?php echo $row['topic']?>
                             </button>
                             <?php
                           $user_id = $_SESSION['user_id'];
                           $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
                           $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
                           $user_group = $group['ministry'];

                           $query = "SELECT * FROM topics WHERE status != 'Banned'
                           AND privacy = 'Anyone' OR privacy = '$user_group'";
                           $result = mysqli_query($conn, $query);
                          ?>
                             <ul class="dropdown-menu w-100">
                             <?php while($row = mysqli_fetch_assoc($result)):?>
                                <?php if($row['privacy'] === $user_group):?>
                                 <li class="topic-type dropdown-item" privacy-group="<?php echo $user_group?>" topic-id="<?php echo $row['topic_id']?>"><?php echo $row['topic']?></li>
                                 <?php else:?>
                                  <li class="topic-type dropdown-item" topic-id="<?php echo $row['topic_id']?>"><?php echo $row['topic']?></li>
                                <?php endif;?>
                            <?php endwhile;?>
                             </ul>
                           </div>
                           <small id="info"></small>
                     <br>
                     <?php 
                      $query = "SELECT text FROM post WHERE post_id = $post_id";
                      $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                     ?>
                     <div class="inputField">
                        <label class="label-head">Text</label>
                        <textarea name="text" id="text" class="form-control"><?php echo $row['text']?></textarea>
                     </div>
                 
                  <!-- </form> -->
                 
        
 
                 <!-- End -->
                 
             </div>

             <script src="assets/libs/textarea/trumbowyg.min.js"></script>
     <script>
          $(document).ready(function(){
            $('#text').trumbowyg({
                  btns: [
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['unorderedList', 'orderedList'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                  ],
             });
               
             $('.privacy-type').click(function(){
                 let privacy = $(this).html();
                 let privacyText = $(this).text();
                 $('#btnPrivacy').html(privacy);
                 $('#privacy').val(privacyText.trim());
             })
             $('.topic-type').click(function(){
                 let topicText = $(this).text();
                 let privacy = $(this).attr('privacy-group');
                  $('#topic').val($(this).attr('topic-id'));
                  $('#btnTopic').text(topicText);
                   if (privacy) {
                     $('#info').html('<i class="bi bi-info-circle"></i> This topic privacy is only for your group, privacy automatically set to group');
                     $('#btnPrivacy').html('<i class="bi bi-people-fill"></i> Group');
                     $('#btnPrivacy').attr('disabled', 'true');
                     $('#privacy').val(privacy);
                   }else{
                     $('#info').text('');
                     $('#btnPrivacy').removeAttr('disabled');
                   }
             })

        
   
          })
     </script>