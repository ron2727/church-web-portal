<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
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
    <link rel="stylesheet" href="assets/css/jquery.toast.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.toast.js"></script>
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
       .post-topic, .post-text{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        }
         /* responsive */
        .main-con{
            width: 60%;

         }
         .create-topic{
            display: flex;
            justify-content: flex-end;
            padding: 20px 10px 20px 10px;
            margin-bottom: 5px;
         }
         .create-topic a{
           padding: 10px 8px 10 8px;
         }
         .create-post{
            padding: 10px 10px 10px 10px;
            margin-bottom: 5px;
         }
         .create-post input[type='text']{
            margin: 0px 3px 0px 3px;
          }
          .filter-con{
            padding: 5px 5px 5px 5px;
          }
          .topic-nav{
            display: none;
          }
        @media only screen and (max-width: 765px) {
          .topic-nav{
            display: block;
          }
         .nav2{
            display: none;
         }
         .main-con{
            width: 100%;
         }
         .create-topic{
            justify-content: space-between;
            padding: 7px 3px 7px 3px;
            margin-bottom: 5px;
         }
         .create-topic a{
            font-size: 0.5rem;
            padding: 3px 7px 3px 7px;
         }
         .create-post{
            display: flex;
            align-items: center;
         }
         .create-post img{
            width: 35px;
            height: 35px;
            border-radius: 50%;
         }
         .create-post input[type='text']{
            height: 25px;
            font-size: 0.6rem;
          }
       
          .filter-con ul li{
             font-size: 0.6rem;
          }
          .user-profile img{
            width: 25px;
            height: 25px;
            border-radius: 50%;
          }
          .user-profile{
            font-size: 0.6rem;
          }
          .post-date{
            font-size: 0.4rem;
          }
          .post-content h4{
            font-size: 0.9rem;
          }
          #reaction{
            font-size: 0.8rem;
          }
          #loaderCon{
            font-size: 0.5;
          }
          #btnLoadmore{
            height: 20px;
            font-size: 0.3rem;
          }
          #spin{
            height: 15px;
            width: 15px;
          }
          .no-post{
            font-size: 0.5rem;
          }
        }
        :focus {
          outline: 0 !important;
          box-shadow: 0 0 0 0 rgba(0, 0, 0, 0) !important;
          background-color: white !important;
          color: #121212 !important;
        } 
    </style>
</head>
<body class="bg-white">
          
         <?php include('forum_nav.php')?>
 
         <div class="container-fluid" style="height: 50px;"></div>
      <main>
               
          <div class="container-fluid bg-white d-flex justify-content-center">
                
             <!-- side nav -->
               <div class="nav2 me-4 sticky-top" style="width:30%;height:400px;font-family: 'Poppins', sans-serif;">
                                    <!-- Topic -->
                                    <div class="topic-list container-fluid border mb-2 p-3">
                       <h5>New Topics</h5>
                       <div class="topic-list">
                        <?php
                        $query = "SELECT * FROM topics WHERE status != 'Banned' AND privacy = 'Anyone' OR privacy = '$user_group'
                                  ORDER BY date DESC, time DESC
                                  LIMIT 4";
                        $result = mysqli_query($conn, $query);
                        ?>
                        <?php while($row = mysqli_fetch_assoc($result)):?>
                          <a href="view_topic.php?topic_id=<?php echo $row['topic_id']?>" class="text-decoration-none">
                            <button type="button" class="btn rounded-3 text-white py-1 mt-1" style="font-size: 0.7rem;background: #355C7D;">
                              <?php echo $row['topic']?> 
                              <?php
                                $topic_id = $row['topic_id'];
                                $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, topics.topic, post.text, post.post_id, user_account.user_id 
                                FROM user_account 
                                INNER JOIN post ON post.user_id = user_account.user_id 
                                INNER JOIN topics ON post.topic_id = topics.topic_id
                                WHERE topics.topic_id = '$topic_id'";
                                $total_post = mysqli_num_rows(mysqli_query($conn, $query));
                                ?>
                               <span class="badge bg-danger"><?php echo $total_post?></span>
                           </button>
                          </a>
                         <?php endwhile;?> 
                       <!-- <span class="badge rounded-pill bg-primary"><span class="">Who's God? </span><span class="badge rounded-pill bg-danger ms-2">4</span></span> -->
                        </div>
                        <div class="container-fluid text-end mt-2">
                          <a href="topics.php" class="text-decoration-none">
                            View All
                          </a>
                        </div>
                   </div>
                   <!-- Forum Rules -->
                <?php
                  $query = "SELECT * FROM event WHERE status = 'Upcoming'";
                  $result = mysqli_query($conn, $query);
                 ?>
                   <div class="event-list container-fluid border mb-2 p-3 bg-white">
                       <h5 class="pb-2">Forum Rules</h5>
                       <div class="accordion accordion-flush" id="accordionRules">
                          <div class="accordion-item">
                             <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <i class="bi bi-pin-angle-fill text-danger"></i>&nbsp;&nbsp; Be courteous and respectful
                                </button>
                             </h2>
                             <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRules">
                                <div class="accordion-body">Appreciate that others may have an opinion different from yours</div>
                             </div>
                          </div>

                          <div class="accordion-item">
                             <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <i class="bi bi-pin-angle-fill text-danger"></i>&nbsp; Stay on topic
                                </button>
                             </h2>
                             <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRules">
                                <div class="accordion-body">When creating a new discussion, give a clear topic title. When contributing to an existing discussion, try to stay 'on topic'. If something new comes up within a topic that you would like to discuss, start a new thread</div>
                             </div>
                          </div>

                          <div class="accordion-item">
                             <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                <i class="bi bi-pin-angle-fill text-danger"></i>&nbsp;  Share your knowledge
                                </button>
                             </h2>
                             <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRules">
                                <div class="accordion-body">Don't hold back in sharing your knowledge – it's likely someone will find it useful or interesting</div>
                             </div>
                          </div>

                          <div class="accordion-item">
                             <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                <i class="bi bi-pin-angle-fill text-danger"></i>&nbsp; Keep it friendly
                                </button>
                             </h2>
                             <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRules">
                                <div class="accordion-body">Refrain from demeaning, discriminatory, or harassing behaviour and speech.</div>
                             </div>
                          </div>
                      
                      </div>

                      <div class="container-fluid text-end mt-2">
                          <a href="forum_rules.php" class="text-decoration-none">
                            Read more
                          </a>
                        </div>
                   </div>  
                  <!-- Forum Rules  -->
               

                <!-- Events -->
                <?php
                  $query = "SELECT * FROM event WHERE status = 'Upcoming'";
                  $result = mysqli_query($conn, $query);
                 ?>
                   <!-- <div class="event-list container-fluid border p-3">
                       <h5 class="pb-2">Upcoming Events</h5>
                       <div class="event-list">
                        <?php while($row = mysqli_fetch_assoc($result)):?>
                         <div class="row mb-2">
                            <div class="col-sm-3">
                              <i class="bi bi-calendar-event text-primary" style="font-size: 3.5rem;"></i>
                            </div>
                             <div class="col-sm-7">
                                <div class="ev-title" style="font-size: 1rem;"><?php echo $row['title']?></div>
                                <div class="ev-place" style="font-size: 0.7rem;">@ <?php echo $row['place']?></div>
                                <div class="ev-date" style="font-size: 0.6rem;"><?php echo date('F d, Y', strtotime($row['date']))?></div>
                             </div>
                             <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                <a href="view_event.php?event_id=<?php echo $row['event_id']?>" target="_blank" class="text-decoration-none" style="font-size: 0.8rem;">View</a>
                             </div>
                         </div>
                        <?php endwhile;?> 
                       </div>
                   </div>   -->
                  <!-- Events  -->

               </div>
          
            <!-- post list -->
               <div class="main-con">
                  <div class="create-topic container border">
                          <div class="topic-nav">
                            <a href="topics.php" class="nav-link" style="font-weight: bold;">
                               <i class="bi bi-card-text"></i> Topics
                            </a>
                          </div>
 
                          <a href="create_topic.php" class="text-decoration-none rounded-3 text-white bg-primary">
                            <i class="bi bi-plus-lg text-white"></i> Create New Topic
                          </a>
                  </div>    
                <a href="create_post.php" class="nav-link">
                  <div class="create-post container d-flex border">
                      <?php
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT profile FROM user_account WHERE user_id = '$user_id'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                      ?>
                    <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="">
                    <input type="text" placeholder="Share Something..." class="form-control rounded-pill">
                 </div>
              </a>

                <nav class="nav-filter-con navbar navbar-expand">
                 <div class="filter-con container border">
                   <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="forum.php?filter=latest" class="nav-link <?php echo(isset($_GET['filter']) && $_GET['filter'] === 'latest' ? 'active': '')?>">
                           <i class="bi bi-award<?php echo(isset($_GET['filter']) && $_GET['filter'] === 'latest' ? '-fill text-danger': '')?>"></i>&nbsp;Latest
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="forum.php?filter=top" class="nav-link <?php echo(isset($_GET['filter']) && $_GET['filter'] === 'top' ? 'active': '')?>">
                           <i class="bi bi-fire <?php echo(isset($_GET['filter']) && $_GET['filter'] === 'top' ? 'text-danger': '')?>"></i>&nbsp;Top
                        </a>
                    </li>
                   </ul>
                  </div>
                </nav>

             <div id="postList" class="container">
             <?php
               if (isset($_GET['filter'])) {
                    if ($_GET['filter'] === 'latest') {
                     $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time,topics.topic_id, topics.topic, post.privacy, post.text, post.post_id, post.views 
                         FROM user_account 
                         INNER JOIN post ON post.user_id = user_account.user_id 
                         INNER JOIN topics ON post.topic_id = topics.topic_id
                         WHERE post.status != 'Banned' AND post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group'
                         ORDER BY date DESC, time DESC
                         LIMIT 10";
                    }
                    if ($_GET['filter'] === 'top') {
                     $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time,topics.topic_id, topics.topic, post.privacy, post.text, post.post_id, post.views 
                         FROM user_account 
                         INNER JOIN post ON post.user_id = user_account.user_id 
                         INNER JOIN topics ON post.topic_id = topics.topic_id
                         WHERE post.status != 'Banned' AND post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group'
                         ORDER BY views DESC
                         LIMIT 10";
                    }
               }else {
                  $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time,topics.topic_id, topics.topic, post.privacy, post.text, post.post_id, post.views 
                         FROM user_account 
                         INNER JOIN post ON post.user_id = user_account.user_id 
                         INNER JOIN topics ON post.topic_id = topics.topic_id
                         WHERE post.status != 'Banned' AND post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group'
                         ORDER BY date DESC, time DESC
                         LIMIT 10";
               }
               
               $result = mysqli_query($conn, $query);
               $total_post = mysqli_num_rows($result);
              ?>
            <?php if ($total_post > 0):?>
              <?php while($row = mysqli_fetch_assoc($result)):?>
                 <a href="view_post.php?post_id=<?php echo $row['post_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="user-profile col-md-5 py-4 d-flex align-items-center">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
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
                                
                                <div class="post-date text-grey" style="font-size: 0.8rem;">
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
                            <div class="post-content">
                               <?php
                                 $query = 'SELECT status FROM post WHERE post_id = '.$row['post_id'].'';
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
        
 
                 <!-- End -->
                 
             </div>
                   <?php if ($total_post > 10):?>
                      <div id="loaderCon" class="container-fluid text-center">
                         <div id="spin" class="spinner-border text-primary"></div>
                         <button id="btnLoadMore" class="btn btn-primary">
                             Load more
                         </button>
                      </div>
                    <?php endif;?>
               </div>
             <?php else:?>
                 <div class="nopost-text container-fluid text-center py-5">
                  <i class="bi bi-emoji-neutral"></i> There's no post yet
                 </div>
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
                let pageNum = 10;
                
                   $('#spin').hide();
                  $('#btnLoadMore').click(function(){
                      $('#spin').show();
                      $('#btnLoadMore').hide();
                    setTimeout(() => {
                        $.ajax({
                        url: 'ajax/load_more.php',
                        method: 'GET',
                        data: {
                           filter: '<?php echo $_GET['filter'] ?? ''?>',
                           start: pageNum,
                           page: 'forum',
                        },
                        success: function(data){
                             if (!$.trim(data)) {
                              $('#spin').hide();
                              $('#btnLoadMore').hide();
                              $('#postList').append('<p class="text-center no-post">No More Post</p>');
                             
                             }else{
                              $('#postList').append(data);
                              $('#spin').hide();
                              $('#btnLoadMore').show();
                             }
                        }
                      })
                      pageNum = pageNum + 5;
                    }, 1000);
                      
                  })
                  // let noMorePost = false;
                  // let height = 0;
                  // $(".display-6").text($(window).scrollTop() + '=' + ($(document).height() - 660));
                  // $(window).scroll(function() {
                  //    // height = height + $(window).height();
                  //    $(".display-6").text($(window).scrollTop() + $(window).height());
                  //    if($(window).scrollTop() + $(window).height() == $(document).height()) {
                  //     alert("bottom!");
                  //   }
                  // });
                  // $(window).scroll(function() {
                  //    // height = height + $(window).height();
                  //    $(".display-6").text($(window).scrollTop() + '=' + ($(document).height() - 660));
                  //    if (!noMorePost) {
                  //       if($(window).scrollTop() > ($(document).height() - 660)) {
                  //       $('#spin').show();
                  //   setTimeout(() => {
                  //       $.ajax({
                  //       url: 'ajax/load_more.php',
                  //       method: 'GET',
                  //       data: {
                  //          start: pageNum,
                  //          page: 'forum',
                  //       },
                  //       success: function(data){
                  //            if (!$.trim(data)) {
                  //             noMorePost = true;
                  //             $('#spin').hide();
                  //              $('#postList').append('<p class="text-center">No More Post</p>');
                               
                             
                  //            }else{
                  //             $('#postList').append(data);
                  //             $('#spin').hide();
                  //             }
                  //       }
                  //     })
                  //     pageNum = pageNum + 3;
                  //   }, 1000);
                  //   }
                  //    }


                  // });

               
         })
       </script>
 </body>
</html>