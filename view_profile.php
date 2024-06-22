<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Navigation</title>
    <style>

       img{
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

       /* responsive */
       #userInfoContainer{
         /* padding: 0px; */
         padding: 5px 0px 0px 5px;
       }
   
     
         #mainContainer{
            margin-top: 10px;
         }
         .name{
         font-size: 2rem;
       }
       @media only screen and (max-width: 765px) {
         #userInfoContainer{
         /* padding: 0px; */
         padding-top: 5px;
       }
    
       #userGroup,#position{
         font-size: 0.3rem;
        }
         #profileImg{
            width: 50px;
            height: 50px;
            border-radius: 50%;
         }
       
         #userName .name{
           font-size: 1rem;
         }
         #userBio{
            font-size: 0.6rem;
         }
         .post-nav{
            font-size: 0.6rem;
         }
         .post-nav span{
            font-size: 0.5rem;
         }
         #img2{
          width: 35px;
          height: 35px;
          border-radius: 50%;
        }
         .group-name{
          font-size: 0.5rem;
        }
        .post-name{
          font-size: 0.7rem;
        }
        #date{
         font-size: 0.45rem;
        }
        .topic{
         font-size: 1rem;
        }
        #reaction div{
         font-size: 0.6rem;
        }
        #loaderCon{
            font-size: 0.5;
          }
          #btnLoadmore{
            height: 25px;
            font-size: 0.5rem;
          }
          #spin{
            height: 15px;
            width: 15px;
          }
          .no-more{
            font-size: 0.7rem;
          }
          .post-topic{
            font-size: 1rem;
          }
          .topic-des{
            font-size: 0.5rem;
          }
          .total-post{
            font-size: 0.7rem;
          }
       }
       
    </style>
</head>
<body class="bg-white">
  
       <!-- Navigation -->
       <?php include('forum_nav.php')?>


     <?php
     $user_id = $_GET['user_id'];
     $query = "SELECT * FROM user_account
     WHERE user_id = '$user_id'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
    ?>
      <main>
      <div class="container-fluid">
      <div id="mainContainer" class="container border">
            <div id="userInfoContainer" class="container-fluid d-flex justify-content-between align-items-center">
                    <div id="userInfo" class="d-flex align-items-center">
                        <div id="imgContainer">
                          <img id="profileImg" src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
                        </div>
                        <div id="userNameContainer" class="ms-2">
                           <div id="userName" class="d-flex align-items-center">
                              <span class="name"><?php echo $row['firstname']. ' ' .$row['lastname']?></span></span>
                              <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge bg-warning rounded-pill ms-1">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="groupName" class="bg-info badge rounded-pill ms-1">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="groupName" class="badge rounded-pill ms-1" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="groupName" class="badge rounded-pill ms-1" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="groupName" class="bg-primary badge rounded-pill ms-1">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span id="groupName" class="bg-primary badge rounded-pill ms-1">Admin</span>
                              <?php endif;?>
                           </div>
                           <div id="userBio">
                              <p class="small"><?php echo $row['bio']?></p>
                           </div>
                        </div>
                        <div id="userForumStats">
                           <span></span>
                           <span></span>
                           <span></span>
                        </div>
                    </div>
             </div>

            <nav class="navbar navbar-expand">
                <div class="container-fluid py-2 border-top border-bottom">
                  
                    <ul class="navbar-nav">
                        <li class="nav-item" style="<?php echo (!isset($_GET['link']) || $_GET['link'] === 'post' ? 'border-bottom:1px solid #121212': '')?>">
                           <a href="view_profile.php?user_id=<?php echo $_GET['user_id']?>&link=post" class="post-nav nav-link <?php echo (!isset($_GET['link']) || $_GET['link'] === 'post' ? 'active': '')?>">Post 
                            <?php if (!isset($_GET['link']) || $_GET['link'] === 'post'):?>
                              <?php   
                                 $query = "SELECT * FROM post WHERE user_id = '$user_id'";
                                 $res =  mysqli_query($conn, $query);
                                 $total_post = mysqli_num_rows($res);
                               ?>
                              <span class="badge bg-danger"><?php echo $total_post?></span>
                            <?php endif;?>
                           </a>
                        </li>
                        <li class="nav-item" style="<?php echo (isset($_GET['link']) && $_GET['link'] === 'topic' ? 'border-bottom:1px solid #121212': '')?>">
                           <a href="view_profile.php?user_id=<?php echo $_GET['user_id']?>&link=topic" class="post-nav nav-link <?php echo (isset($_GET['link']) && $_GET['link'] === 'topic' ? 'active': '')?>">Topics
                           <?php if (isset($_GET['link']) && $_GET['link'] === 'topic'):?>
                              <?php   
                                 $query = "SELECT * FROM topics WHERE user_id = '$user_id'";
                                 $res =  mysqli_query($conn, $query);
                                 $total_topics = mysqli_num_rows($res);
                               ?>
                               <span class="badge bg-danger"><?php echo $total_topics?></span>
                           <?php endif;?>
                          </a>
                        </li>
                    </ul>
                </div>
            </nav>
   <?php
     
     $my_user_id = $_SESSION['user_id'];
     $query = "SELECT ministry FROM user_account WHERE user_id = '$my_user_id'";
     $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
     $user_group = $group['ministry'];
     $user_id = $_GET['user_id'];
     
     if ($my_user_id === $user_id) {
             if (isset($_GET['link']) && $_GET['link'] === 'topic') {
               $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, user_account.user_id, topics.topic_id, topics.topic, topics.description, topics.date, topics.time, topics.privacy
               FROM user_account
               INNER JOIN topics ON user_account.user_id = topics.user_id
               WHERE topics.user_id = '$user_id'
               ORDER BY date DESC, time DESC
               LIMIT 5";
               }else{
                $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, post.views, post.privacy, topics.topic_id, topics.topic, post.text, post.post_id, user_account.user_id 
               FROM user_account 
               INNER JOIN post ON post.user_id = user_account.user_id 
               INNER JOIN topics ON post.topic_id = topics.topic_id
               WHERE post.user_id = '$user_id'
               ORDER BY date DESC, time DESC
               LIMIT 5";
             }
     }else{
         if (isset($_GET['link']) && $_GET['link'] === 'topic') {
                $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, user_account.user_id, topics.topic_id, topics.topic, topics.description, topics.date, topics.time, topics.privacy
               FROM user_account
               INNER JOIN topics ON user_account.user_id = topics.user_id
               WHERE topics.user_id = '$user_id' 
               AND (topics.privacy = 'Anyone' OR topics.privacy = '$user_group')
               ORDER BY date DESC, time DESC
               LIMIT 5";
         }else{
            $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, post.views, post.privacy, topics.topic_id, topics.topic, post.text, post.post_id, user_account.user_id 
            FROM user_account 
            INNER JOIN post ON user_account.user_id = post.user_id
            INNER JOIN topics ON post.topic_id = topics.topic_id
            WHERE post.user_id = '$user_id'
            AND (post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group')
            ORDER BY date DESC, time DESC
            LIMIT 5";
       }
     }
     $result = mysqli_query($conn, $query);
     $total_posttopic = mysqli_num_rows($result);
     ?>
           <div class="container-fluid">
      <?php if(!isset($_GET['link']) || $_GET['link'] === 'post'):?>      
         <?php if($row = mysqli_num_rows($result)):?>
            <div id="postList">    
           <?php while($row = mysqli_fetch_assoc($result)):?>
                 <a href="view_post.php?post_id=<?php echo $row['post_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex align-items-center">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-2">
                                <div id="userName">
                                  <span class="post-name"><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                                <?php if($row['ministry'] === 'Youth'):?> 
                                  <span class="group-name badge rounded-pill bg-warning ms-1">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span class="group-name bg-info badge rounded-pill ms-1">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span class="group-name badge rounded-pill ms-1" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span class="group-name badge rounded-pill ms-1" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span class="group-name bg-primary badge rounded-pill ms-1">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span class="group-name bg-primary badge rounded-pill ms-1">Admin</span>
                              <?php endif;?>
                                 </div>
                                
                                <div id="date" class="text-grey">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                    <i class="bi bi-dot"></i>
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

                        <div class="col-md-5 m-auto">
                            <div>
                            <?php
                       $query = 'SELECT status FROM topics WHERE topic_id = '.$row['topic_id'].'';
                       $status = mysqli_fetch_assoc(mysqli_query($conn, $query));
                     ?>
                     <?php if($status['status'] === 'Banned'):?>
                        <h4 class="topic text-dark">[Unavailable]</h4>
                     <?php else:?>
                          <h4 class="topic text-dark"> <?php echo $row['topic']?></h4>
                      <?php endif;?>  
                             </div>
                        </div>

                        
                        <div class="col-md-2 d-flex align-items-center">
                              <?php 
                                $post_id = $row['post_id'];
                                $query = "SELECT comment.comment
                                          FROM comment
                                          INNER JOIN post ON comment.post_id = post.post_id
                                          WHERE post.post_id = $post_id";
                                $total_comments = mysqli_num_rows(mysqli_query($conn, $query)); 
                              ?>
                                 <div id="reaction">
                                  <div>
                                     <i id="btnHeart" class="bi bi-heart"></i>&nbsp;
                                     <?php
                                      $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
                                      $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
                                     ?>
                                      <?php echo $total_likes?>
                                   </div>
                                   <div>
                                   <i class="bi bi-chat-left"></i>&nbsp;
                                   <span id="like"><?php echo $total_comments?></span>
                                   </div>
                                   <div>
                                  
                                   <i class="bi bi-eye"></i></i>&nbsp;
                                   <span id="like"><?php echo $row['views']?></span>
                                   </div> 
                                 </div>
                        </div>
                     </div>
                 </a>
               <?php endwhile;?>
               </div>
                      <?php if($total_posttopic > 5):?>
                        <div id="loaderCon" class="container-fluid text-center py-3">
                            <div id="spin" class="spinner-border text-primary"></div>
                            <button id="btnLoadMore" class="btn btn-primary">
                              Load more
                            </button>
                         </div>
                      <?php endif;?>
                        
             <?php else:?>
                <div class="container_fluid text-center py-5">
                    Theres no post here
                </div>  
             <?php endif;?>
            <!-- if user topic -->
           <?php else:?>
            <?php if($row = mysqli_num_rows($result)):?>
               <div id="topicList">
             <?php while($row = mysqli_fetch_assoc($result)):?>  
                 <a href="view_topic.php?topic_id=<?php echo $row['topic_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-2">
                            <div id="userName">
                                  <span class="post-name"><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                                <?php if($row['ministry'] === 'Youth'):?> 
                                  <span class="group-name badge rounded-pill bg-warning ms-1">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span class="group-name bg-info badge rounded-pill ms-1">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span class="group-name badge rounded-pill ms-1" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span class="group-name badge rounded-pill ms-1" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span class="group-name bg-primary badge rounded-pill ms-1">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span class="group-name bg-primary badge rounded-pill ms-1">Admin</span>
                              <?php endif;?>
                                 </div>
                                
                                <div id="date" class="text-grey">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                    <i class="bi bi-dot"></i>
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

                        <div class="col-md-5 py-3 d-flex align-items-center">
                            <div>
                            <h5 class="post-topic"><?php echo $row['topic']?></h5>
                            <p class="topic-des"><?php echo $row['description']?></p>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex align-items-center justify-content-end">
                              <?php
                                $topic_id = $row['topic_id'];
                                $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, topics.topic, post.text, post.post_id, user_account.user_id 
                                FROM user_account 
                                INNER JOIN post ON post.user_id = user_account.user_id 
                                INNER JOIN topics ON post.topic_id = topics.topic_id
                                WHERE topics.topic_id = '$topic_id'";
                                $total_post = mysqli_num_rows(mysqli_query($conn, $query));
                              ?>
                            <div class="total-post p-3">
                              <i class="bi bi-chat-left-quote"></i> <?php echo $total_post?>
                            </div>
                        </div>
 
                     </div>
                 </a>
                <?php endwhile;?>
                 </div>
                 <?php if($total_posttopic > 5):?>
                  <div id="loaderCon" class="container-fluid text-center py-3">
                  <div id="tspin" class="spinner-border text-primary"></div>
                   <button id="tbtnLoadMore" class="btn btn-primary">
                     Load more
                   </button>
                   </div>
                 <?php endif;?>
                
               <?php else:?>
                  <div class="container_fluid text-center py-5">
                    Theres no topic here
                </div>
              <?php endif;?>


              
           <?php endif;?>   
           </div>
      </div>

       
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
            let pageNum = 3;
                   $('#spin').hide();
                  $('#btnLoadMore').click(function(){
                      $('#spin').show();
                      $('#btnLoadMore').hide();
                    setTimeout(() => {
                        $.ajax({
                        url: 'ajax/load_more.php',
                        method: 'GET',
                        data: {
                           user_id:'<?php echo $_GET['user_id']?>',
                           start: pageNum,
                           page: 'view_profile',
                        },
                        success: function(data){
                             if (!$.trim(data)) {
                              $('#spin').hide();
                              $('#btnLoadMore').hide();
                              $('#postList').append('<p class="text-center no-more">No More Post</p>');
                             
                             }else{
                              $('#postList').append(data);
                              $('#spin').hide();
                              $('#btnLoadMore').show();
                             }
                        }
                      })
                      pageNum = pageNum + 3;
                    }, 1000);
                      
                  })

                  $('#tspin').hide();
                  $('#tbtnLoadMore').click(function(){
                      $('#tspin').show();
                      $('#tbtnLoadMore').hide();
                    setTimeout(() => {
                        $.ajax({
                        url: 'ajax/load_more.php',
                        method: 'GET',
                        data: {
                           user_id:'<?php echo $_GET['user_id']?>',
                           start: pageNum,
                           page: 'view_profile_topic',
                        },
                        success: function(data){
                             if (!$.trim(data)) {
                              $('#tspin').hide();
                              $('#tbtnLoadMore').hide();
                              $('#topicList').append('<p class="text-center no-more">No More Topic</p>');
                             
                             }else{
                              $('#topicList').append(data);
                              $('#tspin').hide();
                              $('#tbtnLoadMore').show();
                             }
                        }
                      })
                      pageNum = pageNum + 3;
                    }, 1000);
                      
                  })
          })
     </script>
</body>
</html>
 