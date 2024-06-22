<?php
require __DIR__ .'/assets/database/connection.php';
session_start();

if (isset($_GET['post_id'])) {
     $post_id = $_GET['post_id'];
     $query = "SELECT views FROM post WHERE post_id = $post_id";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
     $current_views = $row['views']; 
   //   $current_views = settype($row['views'], "integer");
     $updated_views = $current_views + 1;
     
     $query = "UPDATE post SET views = $updated_views WHERE post_id = $post_id";
     mysqli_query($conn, $query);
     
}else {
   header("Location: forum.php");
   exit;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/textarea.css">
    <link rel="stylesheet" href="assets/libs/textarea/ui/trumbowyg.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Navigation</title>
    <style>
       img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
       }
       .post-profile{
        width: 50px;
        height: 50px;
        border-radius: 50%;
       }
    
       #date{
        color: #6c6c6c;
       }
       #userName{
        font-weight: bold;
       }
       #postedDate span{
        color: #8c8c8c;
        font-size: 0.8rem;
       }
       #btnReport:hover, #reportType p:hover{
        background-color: #f2f2f2;
       }
       #postTopic a{
         text-decoration: none;
         color: #121212;
       }
       #btnReply:hover{
         background-color: #f2f2f2;
       }
       #postTopic a:hover{
         text-decoration: underline;
       }
       .btn-view-replies{
         cursor: pointer;
       }
       .btn-view-replies:hover{
         background-color: #bae6fd;
       }

       /* responsive */
       #postedDate{
          font-size: 0.9rem;
         }
         #btnReport{
         cursor: pointer;
         user-select:none; 
         border-radius:50%;
         }
         .text {
          overflow: hidden;
         }
         #commentField{
          padding-top: 15px;
          padding-bottom: 15px;
         }
         .btn-view-replies{
          padding: 3px 10px 3px 10px;
          font-weight: bold;
          font-size: 0.9rem;
         }
       @media only screen and (max-width: 765px) {
         #imgContainer img{
          width: 35px;
          height: 35px;
          border-radius: 50%;
         }
         #userName{
          font-size: 0.6rem;
         }
         #postedDate{
          font-size: 0.4rem;
         }
         #btnReport{
          font-size: 0.8rem;
         }
         #postTopic h4{
          font-size: 0.8rem;
         }
         #postTopic a h4{
          font-size: 0.8rem;
         }
         .text{
          font-size: 0.6rem;
         }
         #reactionInfo{
          font-size: 0.8rem;
         }
         #commentField #inputComment input[type='text'], .reply-input input[type='text']{
           font-size: 0.5rem;
           height: 25px;
         }
         #btnComment{
           font-size: 0.5rem;
           height: 25px;
         }
         .no-comment{
          font-size: 0.6rem;
         }
         .comment, .btn-reply{
          font-size: 0.6rem;
         }
         .btn-view-replies{
          font-size: 0.5rem;
          font-weight: bold;
         }
         #spin{
          width: 20px;
          height: 20px;
         }
         #btnLoadMore{
          height: 25px;
          font-size: 0.5rem;
          }
          .no-more{
            margin-top: 20px;
            font-size: 0.5rem;
          }
          .btn-add-reply{
            font-size: 0.5rem;
           }
           #editpostModal{
            height: 500px;
           }
           .modal-report-head h4{
             font-size: 1rem;
           }
           .modal-report-head button{
             font-size: 0.8rem;
           }
           .rd-report input[type=radio]{
            width: 10px;
            height: 10px;
           }
           .rd-report label{
            font-size: 0.7rem;
           }
           .rd-report div{
            font-size: 0.6rem;
           }
           .modal-btn-report{
             height: 25px;
             font-size: 0.6rem;
           }
           
       }
    </style>
</head>
<body class="bg-white">
 
      <?php include('forum_nav.php')?>
 
    <?php
     $post_id = $_GET['post_id'];
     $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry,post.status, post.date, post.time, topics.topic, post.text,post.views, post.post_id,post.privacy, user_account.user_id, topics.topic_id 
     FROM user_account 
     INNER JOIN post ON post.user_id = user_account.user_id 
     INNER JOIN topics ON post.topic_id = topics.topic_id
     WHERE post.post_id = $post_id;";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
   ?>
      <main>
          <div id="reportModal" class="modal">
            <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-report-head modal-header border-0">
                     <h4>Report</h4>
                     <button class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                   <?php
                    $created_by = $row['user_id'];
                    $reported_by = $_SESSION['user_id'];
                   ?>
                   <div id="reportContent">
                    <form id="reportForm" method="post"> 
                     <div id="reportType" class="modal-body p-0" style="cursor: pointer;">
                        <input type="hidden" name="postid" value="<?php echo $_GET['post_id']?>">
                        <input type="hidden" name="created_by" value="<?php echo $created_by?>">
                        <input type="hidden" name="reported_by" value="<?php echo $reported_by?>">
                        <div class="rd-report form-check px-5 py-3 border">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Strong languages">
                             <label class="form-check-label" for="radNo">
                               Strong languages
                             </label>
                             <div id="reportDes">
                                Saying bad or inappropriate words
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Harassment and bullying">
                             <label class="form-check-label" for="radNo">
                               Harassment and bullying
                             </label>
                             <div id="reportDes">
                               Harrasment or threaning an individual
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Hate speech">
                             <label class="form-check-label" for="radNo">
                              Hate speech
                             </label>
                             <div id="reportDes">
                               Serious attack on a group
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="False Information">
                             <label class="form-check-label" for="radNo">
                              False Information
                             </label>
                             <div id="reportDes">
                              Making false information to someone
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Sexual exploitation">
                             <label class="form-check-label" for="radNo">
                              Sexual exploitation
                             </label>
                             <div id="reportDes">
                              Sexually explicit post
                             </div>
                        </div>
                     </div>
                     <div class="modal-footer border-0">
                        <button class="btn btn-primary modal-btn-report">Report</button>
                     </div>
                    </form>
                   </div>
                 </div>
            </div>
         </div>

         <div id="reportComment" class="modal">
            <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-report-head modal-header border-0">
                     <h4>Report Comment</h4>
                     <button class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
 
                   <div id="reportComContent">
                    <form id="reportComForm" name="report-comment" method="post"> 
                     <div id="reportType" class="modal-body p-0" style="cursor: pointer;">
                         
                        <input type="hidden" id="post-Id" name="post_id">
                        <input type="hidden" id="comment-Id" name="commentid">
                        <input type="hidden" id="createdBy" name="created_by">
                        <input type="hidden" id="reportedBy" name="reported_by">
                        <div class="rd-report form-check px-5 py-3 border">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Strong languages">
                             <label class="form-check-label" for="radNo">
                               Strong languages
                             </label>
                             <div id="reportDes">
                                Saying bad or inappropriate words
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Harassment and bullying">
                             <label class="form-check-label" for="radNo">
                               Harassment and bullying
                             </label>
                             <div id="reportDes">
                               Harrasment or threaning an individual
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Hate speech">
                             <label class="form-check-label" for="radNo">
                              Hate speech
                             </label>
                             <div id="reportDes">
                               Serious attack on a group
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="False Information">
                             <label class="form-check-label" for="radNo">
                              False Information
                             </label>
                             <div id="reportDes">
                              Making false information to someone
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Sexual exploitation">
                             <label class="form-check-label" for="radNo">
                              Sexual exploitation
                             </label>
                             <div id="reportDes">
                              Sexually explicit post
                             </div>
                        </div>
                     </div>
                     <div class="modal-footer border-0">
                        <button class="btn btn-primary modal-btn-report">Report</button>
                     </div>
                    </form>
                   </div>
                 </div>
            </div>
         </div>

         <div id="editpostModal" class="modal">
            <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header border-0">
                     <h4>Edit Post</h4>
                     <button class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                     <form id="editPost" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                       <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']?>">
                      <div id="modalBody" class="modal-body p-0" style="cursor: pointer;">
                           
                     </div>
                     <div class="modal-footer border-0">
                          <button id="btnSubmit" type="submit" class="btn btn-primary py-2 rounded-5 px-4">
                             <div id="btnSubSpin"></div> Post
                          </button>
                     </div>
                     </form>
                  </div>
            </div>
         </div>
         <div id="postContainer" class="container mt-5 border">
           <?php if($row['status'] !== 'Banned'):?>
            <div id="post">
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
                            >
                        <?php if($row['user_id'] === $_SESSION['user_id']):?>
                           <li  class="dropdown-item" ><i id="openModal" class="bi bi-pencil-fill" post-id="<?php echo $_GET['post_id']?> "></i></li>
                        <?php else:?>
                            <i class="bi bi-flag-fill" data-bs-toggle="modal" data-bs-target="#reportModal"></i> 
                        <?php endif;?>
                        </div>
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
                    $post_id = $_GET['post_id'];
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
                                 WHERE post.post_id = $post_id AND comment.status != 'Banned'";
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
                      <input type="hidden" id="postid" name="postid" value="<?php echo $_GET['post_id']?>">
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
              


            </div>
            
          
        <!-- Comment section -->
              <div id="commentContainer">
            <?php
              $query = "SELECT user_account.user_id,user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,comment.comment_id, comment.date, comment.time, comment.comment
                        FROM user_account
                        INNER JOIN comment ON user_account.user_id = comment.user_id
                        WHERE comment.post_id = $post_id AND comment.status != 'Banned'
                        ORDER BY date DESC, time DESC";
               $result = mysqli_query($conn, $query);
             ?>
            
                 <ul id="commentList" class="p-0" style="list-style: none;">
                 <?php if($row = mysqli_num_rows($result)):?>
                 <?php while($row = mysqli_fetch_assoc($result)):?>
                   <li>
                 <div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">   
                   <a href="view_profile.php?user_id=<?php echo $row['user_id']?>" class="nav-link">  
                     <div id="userComment" class="container-fluid py-1">
                       <div id="userInfo" class="d-flex">
                          <div id="imgContainer">
                           <img class="post-profile" src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
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
                     <?php if($row['user_id'] !== $_SESSION['user_id']):?>
                     <div id="repMenu">
                         <div id="btnReport"
                            class="p-2" 
                            data-bs-toggle="dropdown">
                          <i class="bi bi-three-dots"></i>
                         </div>
                          <ul class="dropdown-menu" style="cursor: pointer;">                     
                                <li class="dropdown-item btn-reportCom" user-id="<?php echo $row['user_id']?>" comment-id="<?php echo $row['comment_id']?>" data-bs-toggle="modal" data-bs-target="#reportComment"><i class="bi bi-flag-fill"></i> Report</li>
                          </ul>
                        </div>
                      <?php endif;?>
                    </div>
                       <div id="comment-con" class="px-5">
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
                                        
                                            <div class="reply-list pt-3">
 
                                             </div>
                                             
                                     </div> 
                             </div>
                        </div>
                      </div>
                        </li>
                        
                  <?php endwhile;?>  
                    <?php else:?>
                      <div class="no-comment container py-5 d-flex justify-content-center align-items-center">
                      <i class="bi bi-emoji-neutral"></i> &nbsp; No Comments
                    </div>
                  <?php endif;?>
                 </ul>
                 <!-- <?php if($row = mysqli_num_rows($result)):?>
                    <div id="loaderCon" class="container-fluid text-center py-3">
                          <div id="spin" class="spinner-border text-primary"></div>
                          <button id="btnLoadMore" class="btn btn-primary">
                            View more replies
                          </button>
                        </div>
                  <?php endif;?> -->
                      
             
                      </div>
           <?php else:?>
             <?php
              $post_id = $_GET['post_id'];
              $query = "SELECT post.user_id
                        FROM post
                        INNER JOIN user_account ON post.user_id = user_account.user_id
                        WHERE post.post_id = $post_id";
              $post_userid = mysqli_fetch_assoc(mysqli_query($conn, $query));
             ?>
                  <?php if($_SESSION['user_id'] === $post_userid['user_id']):?>
                     <div class="py-5 d-flex justify-content-center">
                       <div>
                         <i class="bi bi-emoji-frown"></i> We removed this post since its violate some rules of our forum
                       </div>
                     </div>
                  <?php else:?>
                     <div class="py-5 d-flex justify-content-center">
                       <div>
                         <i class="bi bi-emoji-frown"></i> This post is unavailable
                       </div>
                     </div> 
                  <?php endif;?> 
                          
          <?php endif;?>  
        </div>

      </main>

          <!-- Footer -->
     <footer class="bg-light text-center text-lg-start">
             <hr>
             <div id="footerText" class="text-center p-3">
                 © <?php echo date('Y')?> Copyright: Taytay Immanuel Church
              </div>
     </footer>

     <script>
          $(document).ready(function(){
            
               // $('.btn-reply').click(function(){
              //  $('.reply-container').hide();
              //  $(this).siblings().show();
              //  })
              $('#reportForm').submit(function(e){
            e.preventDefault();
            $('#reportContent').html(`
              <div class="text-center py-5">
               <span class="spinner-border spinner-border-xl text-primary"></span>
              </div>
              `);
                      $.ajax({
                        url: 'submit_report.php',
                        type: 'POST',
                        data: $(this).serialize(),
                         success: function(data){
                            $('#reportContent').html(data);
                         }
                    })
            
          })
          let commentID = '';
          let comUserID = '';
          $('.btn-reportCom').click(function(){
                 commentID = $(this).attr('comment-id');
                 comUserID = $(this).attr('user-id')
                 $('.test').text('comUserid: ' + comUserID + ' Comment_id: ' + commentID);
          })
          
          $('#reportComForm').submit(function(e){
             $('#post-Id').val('<?php echo $_GET['post_id']?>');
            $('#comment-Id').val(commentID)
            $('#createdBy').val(comUserID)
            $('#reportedBy').val('<?php echo $_SESSION['user_id']?>')
             e.preventDefault();
            $('#reportComContent').html(`
              <div class="text-center py-5">
               <span class="spinner-border spinner-border-xl text-primary"></span>
              </div>
              `);
                      $.ajax({
                        url: 'submit_report.php',
                        type: 'POST',
                        data:  $(this).serialize(),
                         success: function(data){
                            $('#reportComContent').html(data);
                         }
                    })
            
          })

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
                 $('#modalBody').html(`<div class="text-center py-5">
                                         <span class="spinner-border spinner-border-lg text-primary"></span>
                                       </div>`);
                   $.ajax({
                        url: 'edit_post.php',
                        type: 'POST',
                        data: formData,
                        success: function(data){
                            $('#post').html(data);
                            $('#editpostModal').modal('hide');
                          }
                    })
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


              $('.reply-container').hide();

              $('.replay-input').keyup(function(){
                let inputComm = $(this).val().trim();
                 if (inputComm == '' || inputComm == null) {
                   $(this).parent().children('button').attr('disabled', 'true');
                 }else{
                  $(this).parent().children('button').removeAttr('disabled')
                 }
              })
             
           
               $('.btn-reply').click(function(){
                 $(this).parent().children('div.reply-container').show();
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

           $('.btn-view-replies').click(function(){
                $('.btn-view-replies').parent().siblings().hide();
                $(this).parent().siblings().show();
                 let commentId = $(this).attr('comment-id');
                 let elem = $(this)
                 elem.attr('disabled', true);
                $.ajax({
                  url: 'ajax/get_replies.php',
                  method: 'GET',
                  data:{comment_id: commentId},
                  success: function(data){
                    elem.parent().siblings().html(data)
                  }
                })
           })
           

          $('.rd-report').children('div').hide();
          $('.rd-report').click(function(){
            $('.rd-report').children('div').slideUp();
             $('.rd-report').children('input').removeAttr('checked');
            $(this).children('input').attr('checked', 'true');
             $(this).children('div').slideDown();
          })


          $('#totalLikes').click(function(){
            let postID = $(this).attr('postid');
             $.ajax({
               url: 'ajax/like.php',
               method: 'POST',
               data: {post_id: postID},
               success: function(data){
                  $('#totalLikes').html(data);
               }
             })
          })


          let pageNum = 5;
                
                   $('#spin').hide();
                  $('#btnLoadMore').click(function(){
                      $('#spin').show();
                      $('#btnLoadMore').hide();
                    setTimeout(() => {
                        $.ajax({
                        url: 'ajax/load_more.php',
                        method: 'GET',
                        data: {
                           postid: <?php echo $_GET['post_id']?>,
                           start: pageNum,
                           page: 'comment',
                        },
                        success: function(data){
                              if (!$.trim(data)) {
                               $('#btnLoadMore').hide();
                              $('#spin').hide();
                              $('#commentList').append('<p class="text-center no-more">No More Comment</p>');
                             
                             }
                             else{
                              $('#commentList').append(data);
                              $('#spin').hide();
                              $('#btnLoadMore').show();
                             }
                        }
                      })
                      pageNum = pageNum + 3;
                    }, 1000);
                      
                  })
      

                //   let pageNum2 = 3;
                //   $('.reply-loading').hide();
                //  $('.btn-loadmore').click(function(){
                //     let commentId = $(this).attr('comment_id');
                //     let replyList = $(this).parent().siblings();
                //     let spinner = $(this).siblings();
                //     let btnLoadmore = $(this);
                //     spinner.show();
                //     btnLoadmore.hide();
                //         setTimeout(() => {
                //         $.ajax({
                //         url: 'ajax/load_more.php',
                //         method: 'GET',
                //         data: {
                //            comment_id: commentId,
                //            start: pageNum2,
                //            page: 'reply',
                //         },
                //         success: function(data){
                //              if (!$.trim(data)) {
                //                 replyList.append('<p class="text-center">No More Post</p>');
                //                 spinner.hide();
                //                 btnLoadmore.hide();
                //              }else{
                //                 spinner.hide();
                //                 btnLoadmore.show();
                //              }
                //         }
                //       })
                //       pageNum2 = pageNum2 + 3;
                //     }, 1000);
                      
                //   })

      })
       
     </script>
 </body>
</html>