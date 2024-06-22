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
       .header-topic-des{
          font-weight: 100;
          font-size: 1.5rem;
        }
       @media only screen and (max-width: 765px) {
        #img2{
          width: 40px;
          height: 40px;
          border-radius: 50%;
        }
        #date{
            font-size: 0.6rem;
          }
        #userName{
          font-size: 0.7rem;
        }
        #groupName{
          font-size: 0.6rem;
        }
        .post-topic{
          font-size: 1rem;
        }
        .header-topic{
          font-size: 1rem;
        }
        .header-topic-des{
          font-weight: 100;
          font-size: 0.8rem;
        }
        .total-post{
          font-size: 0.6rem;
        }
       }
    </style>
</head>
<body class="bg-white">
  
       <!-- Navigation -->
       <?php include('forum_nav.php')?>


     <?php
     $topic_id = $_GET['topic_id'];
     $query = "SELECT * FROM topics
     WHERE topic_id = '$topic_id'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
    ?>
      <main>
      <div class="container-fluid">
      <div id="mainContainer" class="container border">
      <div id="reportModal" class="modal">
            <div class="modal-dialog">
                 <div class="modal-content modal-fullscreen-md-down">
                   <div class="modal-header border-0">
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
                        <input type="hidden" name="topicid" value="<?php echo $_GET['topic_id']?>">
                        <input type="hidden" name="created_by" value="<?php echo $created_by?>">
                        <input type="hidden" name="reported_by" value="<?php echo $reported_by?>">
                        <div class="rd-report form-check px-5 py-3 border">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Violence">
                             <label class="form-check-label" for="radNo">
                               Violence
                             </label>
                             <div id="reportDes">
                                 For the post that contains Violence
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Nudity">
                             <label class="form-check-label" for="radNo">
                               Nudity
                             </label>
                             <div id="reportDes">
                                 For the post that contains Nudity
                             </div>
                        </div>
                        <div class="rd-report form-check px-5 py-3 border-bottom">
                             <input class="form-check-input" type="radio" name="reason" id="radNo" value="Sex">
                             <label class="form-check-label" for="radNo">
                              Sex
                             </label>
                             <div id="reportDes">
                                 For the post that contains Sex
                             </div>
                        </div>
                       <!-- <p class="border p-2 m-0">Sex</p>
                       <p class="border p-2 m-0">Nudity</p>
                       <p class="border p-2 m-0">Violence</p> -->
                     </div>
                     <div class="modal-footer border-0">
                        <button class="btn btn-primary">Report</button>
                     </div>
                    </form>
                   </div>
                 </div>
            </div>
         </div>
          <?php if($row['status'] !== 'Banned'):?>
             <div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">
                    <div id="userInfo" class="d-flex">    
                     <h3 class="header-topic"><?php echo $row['topic']?></h3>
                    </div>
                    <?php
                      $user_id = $_SESSION['user_id'];
                    ?>
                   <?php if($user_id !== $row['user_id']):?> 
                     <!-- <div id="postMenu">
                       <div id="btnReport"
                            class="p-2" 
                            style="cursor: pointer;user-select:none; border-radius:50%;"
                            data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                        </div>
                        <ul class="dropdown-menu" style="cursor: pointer;">
                            <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportModal">Report</li>
                        </ul>
                    </div> -->
                    <?php endif;?>
              </div>
              <h5 class="header-topic-des px-2"><?php echo $row['description']?></h5>
              <?php
              $user_id = $_SESSION['user_id'];
              $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
              $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
              $user_group = $group['ministry'];

              $topic_id = $_GET['topic_id'];
              $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, topics.topic,post.privacy, post.text, post.post_id, post.views, user_account.user_id 
              FROM user_account 
              INNER JOIN post ON post.user_id = user_account.user_id 
              INNER JOIN topics ON post.topic_id = topics.topic_id
              WHERE topics.topic_id = $topic_id AND post.status != 'Banned'
              AND (post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group')
              LIMIT 10";
              $result = mysqli_query($conn, $query);
              $total_post = mysqli_num_rows($result)
             ?>
            <nav class="navbar navbar-expand">
                <div class="container-fluid py-2 border-top border-bottom">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="total-post nav-link active">Post  <span class="badge bg-danger"><?php echo $total_post?></span></a>
                        </li>
                    </ul>
                </div>
            </nav>

      <div class="container-fluid">
         <?php if($total_post):?>   
          <div id="postList">
           <?php while($row = mysqli_fetch_assoc($result)):?>
                 <a href="view_post.php?post_id=<?php echo $row['post_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex align-items-center">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-2">
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
                            <h5 class="post-topic"><?php echo $row['topic']?></h5>
                             <!-- <div>
                                <span id="tagName" class="badge rounded-pill bg-warning">Thankful</span>
                                <span id="tagName" class="badge rounded-pill bg-info ms-2">Feeling Blessed</span>
                             </div> -->
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
                  <?php if($total_post > 10):?>
                    <div id="loaderCon" class="container-fluid text-center py-3">
                       <div id="spin" class="spinner-border text-primary"></div>
                      <button id="btnLoadMore" class="btn btn-primary">
                        Load more
                      </button>
                    </div>
                  <?php endif;?>
             <?php else:?>
                <div class="container_fluid text-center">
                    Theres no post here
                </div>  
             <?php endif;?>  
           </div>


           <?php else:?>
             <?php
              $topic_id = $_GET['topic_id'];
              $query = "SELECT topics.user_id
                        FROM topics
                        INNER JOIN user_account ON topics.user_id = user_account.user_id
                        WHERE topics.topic_id = $topic_id";
              $topic_userid = mysqli_fetch_assoc(mysqli_query($conn, $query));
              ?>
                  <?php if($_SESSION['user_id'] === $topic_userid['user_id']):?>
                     <div class="py-5 d-flex justify-content-center">
                       <div>
                         <i class="bi bi-emoji-frown"></i> We removed this topic since its violate some rules of our forum
                       </div>
                     </div>
                  <?php else:?>
                     <div class="py-5 d-flex justify-content-center">
                       <div>
                         <i class="bi bi-emoji-frown"></i> This topic is unavailable
                       </div>
                     </div> 
                  <?php endif;?> 
           <?php endif;?>
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
          $('.rd-report').children('div').hide();
          $('.rd-report').click(function(){
            $('.rd-report').children('div').slideUp();
             $('.rd-report').children('input').removeAttr('checked');
            $(this).children('input').attr('checked', 'true');
             $(this).children('div').slideDown();
          })
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
          let pageNum = 2;
                   $('#spin').hide();
                  $('#btnLoadMore').click(function(){
                      $('#spin').show();
                      $('#btnLoadMore').hide();
                    setTimeout(() => {
                        $.ajax({
                        url: 'ajax/load_more.php',
                        method: 'GET',
                        data: {
                           topic_id:<?php echo $_GET['topic_id']?>,
                           start: pageNum,
                           page: 'view_topic',
                        },
                        success: function(data){
                             if (!$.trim(data)) {
                              $('#spin').hide();
                              $('#btnLoadMore').hide();
                              $('#postList').append('<p class="text-center">No More Topic</p>');
                             
                             }else{
                              $('#postList').append(data);
                              $('#spin').hide();
                              $('#btnLoadMore').show();
                             }
                        }
                      })
                      pageNum = pageNum + 2;
                    }, 1000);
                      
                  })
         })
     </script>
</body>
</html>