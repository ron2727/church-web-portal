<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: forum_guest.php");
    exit;
}
               $user_id = $_SESSION['user_id'];
               $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
               $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
               $user_group = $group['ministry'];

 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Navigation</title>
    <style>

       img{
        width: 60px;
        height: 60px;
        border-radius: 50%;
       }
       #date{
        color: #6c6c6c;
       }
       #userName{
        font-weight: bold;
       }
       .label-head{
        font-size: 1rem;
       }
       .dropdown-item:hover{
         cursor: pointer;
       }
       .main-con{
            width: 50%;
         } 
       /* responsive */
       .main-con{
            width: 50%;
         }
       .header{
           padding: 5px 10px 5px 10px;
       }
       #postedDate{
          font-size: 0.9rem;
       }
       @media only screen and (max-width: 765px) {
         .main-con{
            width: 100%;
         }
         .header{
           padding: 3px 5px 0px 5px;
         }
         .header h4{
            font-size: 1rem;
         }
         #imgContainer img{
            width: 40px;
            height: 40px;
            border-radius: 50%;
         }
         .name{
           font-size: 0.65rem;
         }
         #groupName{
            font-size: 0.55rem;
         }
         #postedDate{
          font-size: 0.5rem;
       }
        #postTopic h4{
         font-size: 0.9rem;
        }
        .text{
         font-size: 0.6rem;
        }
        #reactionInfo{
         font-size: 0.7rem;
        }

        #loaderCon{
            font-size: 0.5;
          }
          #btnLoadmore{
            height: 25px;
            font-size: 0.4rem;
          }
          #spin{
            height: 15px;
            width: 15px;
          }
          .no-post{
            margin-top: 10px;
            font-size: 0.5rem;
          }
       }
    </style>
</head>
<body class="bg-white">
        <!-- Navigation -->
        <?php include('forum_nav.php')?>
     

      <main>
               
          <div class="container-fluid bg-white d-flex justify-content-center">
                
          
            <!-- post list -->
           <div class="main-con">
                   
                    <?php
                      $search = $_GET['search'];
                      $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry,post.status, post.date, post.time, topics.topic, post.text,post.views, post.post_id,post.privacy, user_account.user_id, topics.topic_id 
                      FROM user_account 
                      INNER JOIN post ON post.user_id = user_account.user_id 
                      INNER JOIN topics ON post.topic_id = topics.topic_id
                      WHERE post.status != 'Banned' AND post.privacy = '$user_group' OR post.privacy = 'Anyone' OR post.privacy = 'Locked' AND (post.text LIKE '%$search%' OR topics.topic LIKE '%$search%' OR user_account.firstname LIKE '%$search%' OR user_account.lastname LIKE '%$search%')
                      LIMIT 5;";
                      $result = mysqli_query($conn, $query);
                     ?>
                                          <!-- WHERE post.status != 'Banned' AND (post.text LIKE '%$search%' OR topics.topic LIKE '%$search%' OR user_account.firstname LIKE '%$search%' OR user_account.lastname LIKE '%$search%') -->

          <div id="searchList" class="container p-3">
                <div class="header container-fluid border mb-2">
                       <h4>Result</h4>
                  </div>
           <?php if(mysqli_num_rows($result) > 0):?>     
            <div class="post-con">  
            <?php while($row = mysqli_fetch_assoc($result)):?>
              <?php 
              $post_id = $row['post_id'];
              ?> 
             <a href="view_post.php?post_id=<?php echo $post_id?>" target="_blank" class="nav-link">
             <div class="border mt-3">
              <div id="post">
               <div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">  
                   <div id="userInfo" class="d-flex">    
                        <div id="imgContainer">
                           <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="<?php $row['profile']?>">
                        </div>
                        <div id="userNameContainer" class="ms-3">
                           <div id="userName">
                              <span class="name"><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                               <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning ms-1">&nbsp;Youth</span>
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
                 
                  </div>
              </div>

              <div id="postContentContainer" class="px-4">
                  <div id="postTopic">
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
                   <div class="text">
                     <?php echo $row['text']?>
                   </div>
              </div>
            
              <div id="reactionInfo" class="container d-flex justify-content-around mt-2 py-3 border-top border-bottom">
                   <?php
                    $post_id = $row['post_id'];
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
                       $query = "SELECT comment.comment
                                 FROM comment
                                 INNER JOIN post ON comment.post_id = post.post_id
                                 WHERE post.post_id = $post_id";
                        $total_comments = mysqli_num_rows(mysqli_query($conn, $query)); 
                      ?>
                    <span id="totalComments" class="ms-2">
                      <i class="bi bi-chat-left"></i> 
                       <?php echo $total_comments?>
                    </span>
                    <span id="totalViews" class="ms-2">
                      <i class="bi bi-eye"></i>
                      <?php echo $row['views']?>
                    </span>
              </div>
              </div>
              </a>
             <?php endwhile;?>
             </div> 
              <?php if(mysqli_num_rows($result) > 5):?>
               <div id="loaderCon" class="container-fluid text-center py-3">
                  <div id="spin" class="spinner-border text-primary"></div>
                   <button id="btnLoadMore" class="btn btn-primary">
                     Load more
                   </button>
                 </div>
               <?php endif?>
             <?php else:?>
                <div class="text-center py-5">
                   No search found
                </div>
            <?php endif;?>
          </div>
                
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
                           search: '<?php echo $_GET['search'] ?? ''?>',
                           start: pageNum,
                           page: 'search',
                        },
                        success: function(data){
                             if (!$.trim(data)) {
                              $('#spin').hide();
                              $('#btnLoadMore').hide();
                              $('.post-con').append('<p class="text-center no-post">No More Post</p>');
                             
                             }else{
                              $('.post-con').append(data);
                              $('#spin').hide();
                              $('#btnLoadMore').show();
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