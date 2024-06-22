<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: forum_guest.php");
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
       .username-text{
         font-size: 1.3rem;
       }
       .label-head{
        font-size: 1rem;
       }
       .notif-date{
    font-size: 0.7rem;
   }
 
   .notif-profile-img{
      width: 80px;
      height: 80px;
      border-radius: 50%;
   }
   .source-name{
    font-weight: bold;
    font-size: 1rem;
   }
   .notif-type{
    font-size: 1rem;
   }
   .content-con{
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
   }
       .dropdown-item:hover{
         cursor: pointer;
       }
    /* responsive */
    .main-con{
      width: 40%;
    }
    .notif-con{
      padding: 10px 0px 10px 0px;
    }
    .bi-dot{
      font-size: 3rem;
    }
    @media only screen and (max-width: 765px) {
      .main-con{
      width: 100%;
      }
      .header{
         padding: 10px 0px 0px 10px;
         margin-top: 10px;
      }
      .header h3{
         font-size: 1rem;
      }
      .notif-profile-img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
      }
      .source-name,.notif-type,.content-con{
       font-size: 0.7rem;
      }
      .bi-dot{
       font-size: 2rem;
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
                 <div class="header container-fluid border mb-2">
                       <h3>Notification</h3>
                  </div>    
          
           
              <div id="postList" class="container border py-3">
                       <?php
                          $user_id = $_SESSION['user_id'];
                          $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'";
                          $result = mysqli_query($conn, $query);
                        ?>
                    <?php if(mysqli_num_rows($result) > 0):?>
                         <!-- New -->
                      <?php
                          $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'
                                    ORDER BY date DESC, time DESC
                                    LIMIT 3";
                          $result = mysqli_query($conn, $query);
                        ?>
                     <div class="notif-list">
                       <div class="px-3" style="font-weight: bold;">New</div>
                     <?php while($notif_row = mysqli_fetch_assoc($result)):?>
                       <a href="view_notification.php?notif_id=<?php echo $notif_row['notification_id']?>&post_id=<?php echo $notif_row['post_id']?>" class="nav-link">  
                        <div class="notif-con row">
                           <div class="col-2 d-flex align-items-center">
                              <?php
                                 $query = 'SELECT profile, firstname, lastname FROM user_account WHERE user_id = "'.$notif_row['source_id'].'"';
                                 $profile = mysqli_fetch_assoc(mysqli_query($conn, $query));
                              ?>
                             <img class="notif-profile-img" src="assets/uploaded_images/profile/<?php echo $profile['profile']?>" alt="buere">
                           </div>
                           <div class="col-10 py-1 px-3" style="font-size: 0.9rem;">
                               <div class="source-con">
                                  <span class="source-name text-secondary" style="font-weight: bold;"><?php echo $profile['firstname'].' '.$profile['lastname']?></span>
                                  <?php if($notif_row['type'] === 'comment'):?>
                                  <span class="notif-type">commented to your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned1'):?>
                                  <span class="notif-type text-danger">Ban your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned2'):?>
                                  <span class="notif-type text-danger">Ban your topic: </span>
                                  <?php endif;?>
                                  
                                  <?php if($notif_row['view'] === 'no'):?>
                                  <span class="float-end"><i class="bi bi-dot text-primary"></i></span>
                                  <?php endif;?>  
                               </div>
                               <div class="content-con">
                                      <?php
                                       $query = 'SELECT text FROM post WHERE post_id = '.$notif_row['post_id'].'';
                                       $text = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                     ?>
                                        <span>
                                              <?php 
                                               $post_text = filter_var($text['text'], FILTER_SANITIZE_STRING);
                                                echo "''$post_text''";
                                              ?>
                                        </span>
                                 </div>
                                <div class="notif-date">
                                     <?php
                                    $time_past = strtotime($notif_row['date_time']);
                                     ?>
                                     <?php if($notif_row['view'] === 'no'):?>
                                       <span class="text-primary"><?php echo date('F d, Y', strtotime($notif_row['date']))?></span>
                                       <span class="text-primary"><?php echo date('g:i A',strtotime($notif_row['time']))?></span>
                                     <?php else:?> 
                                        <span><?php echo date('F d, Y', strtotime($notif_row['date']))?></span>
                                       <span><?php echo date('g:i A',strtotime($notif_row['time']))?></span>
                                     <?php endif;?>
                                </div>
                           </div>
                        </div>
                       </a>
                       <?php endwhile;?>
                       <!-- Old  -->
                       <?php
                          $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'
                                    ORDER BY date DESC, time DESC
                                    LIMIT 3, 5";
                          $result = mysqli_query($conn, $query);
                          $total_oldnotif = mysqli_num_rows($result);
                        ?>
                     <?php if($total_oldnotif > 0):?>
                       <div class="px-3" style="font-weight: bold;">Old</div>
                       <?php while($notif_row = mysqli_fetch_assoc($result)):?>
                       <a href="view_notification.php?notif_id=<?php echo $notif_row['notification_id']?>&post_id=<?php echo $notif_row['post_id']?>" class="nav-link">  
                        <div class="notif-con row">
                           <div class="col-2 d-flex align-items-center">
                              <?php
                                 $query = 'SELECT profile, firstname, lastname FROM user_account WHERE user_id = "'.$notif_row['source_id'].'"';
                                 $profile = mysqli_fetch_assoc(mysqli_query($conn, $query));
                              ?>
                             <img class="notif-profile-img" src="assets/uploaded_images/profile/<?php echo $profile['profile']?>" alt="buere">
                           </div>
                           <div class="col-10 py-1 px-3" style="font-size: 0.9rem;">
                               <div class="source-con">
                                  <span class="source-name text-secondary" style="font-weight: bold;"><?php echo $profile['firstname'].' '.$profile['lastname']?></span>
                                  <?php if($notif_row['type'] === 'comment'):?>
                                  <span class="notif-type">commented to your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned1'):?>
                                  <span class="notif-type text-danger">Ban your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned2'):?>
                                  <span class="notif-type text-danger">Ban your topic: </span>
                                  <?php endif;?>
                                  
                                  <?php if($notif_row['view'] === 'no'):?>
                                  <span class="float-end"><i class="bi bi-dot text-primary"></i></span>
                                  <?php endif;?>  
                               </div>
                               <div class="content-con">
                                      <?php
                                       $query = 'SELECT text FROM post WHERE post_id = '.$notif_row['post_id'].'';
                                       $text = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                     ?>
                                        <span>
                                              <?php 
                                               $post_text = filter_var($text['text'], FILTER_SANITIZE_STRING);
                                                echo "''$post_text''";
                                              ?>
                                        </span>
                                 </div>
                                <div class="notif-date">
                                     <?php
                                    $time_past = strtotime($notif_row['date_time']);
                                     ?>
                                     <?php if($notif_row['view'] === 'no'):?>
                                       <span class="text-primary"><?php echo date('F d, Y', strtotime($notif_row['date']))?></span>
                                       <span class="text-primary"><?php echo date('g:i A',strtotime($notif_row['time']))?></span>
                                     <?php else:?> 
                                        <span><?php echo date('F d, Y', strtotime($notif_row['date']))?></span>
                                       <span><?php echo date('g:i A',strtotime($notif_row['time']))?></span>
                                     <?php endif;?>
                                </div>
                           </div>
                        </div>
                       </a>
                       <?php endwhile;?>
                       </div>
                     <?php endif;?>
                          <?php if($total_oldnotif > 3):?>
                             <div id="loaderCon" class="container-fluid text-center py-3">
                                 <div id="spin" class="spinner-border text-primary spinner-sm"></div>
                                 <button id="btnLoadMore" class="btn btn-primary btn-sm">
                                    Load more
                                 </button>
                             </div>
                          <?php endif;?>
                        
                   <?php else:?>
                          <div class="text-center py-5">
                           <i class="bi bi-bell-slash" style="font-size: 9rem;"></i>
                           <br>
                           <br>
                           <span>
                              No Notification 
                           </span>
                         </div>
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
            let pageNum = 8;
                
                $('#spin').hide();
               $('#btnLoadMore').click(function(){
                   $('#spin').show();
                   $('#btnLoadMore').hide();
                 setTimeout(() => {
                     $.ajax({
                     url: 'ajax/load_more.php',
                     method: 'GET',
                     data: {
                        start: pageNum,
                        page: 'all_notification',
                     },
                     success: function(data){
                          if (!$.trim(data)) {
                           $('#spin').hide();
                           $('#btnLoadMore').hide();
                           $('#postList').append('<p class="text-center no-more">No More Notification</p>');
                          
                          }else{
                           $('.notif-list').append(data);
                           $('#spin').hide();
                           $('#btnLoadMore').show();
                          }
                     }
                   })
                   pageNum = pageNum + 5;
                 }, 1000);
                   
               })
  
          })
     </script>
 </body>
</html>