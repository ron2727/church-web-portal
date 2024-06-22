<?php
 
   $user_id = $_SESSION['user_id'];
   $query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
?>
<link rel="stylesheet" href="assets/css/jquery.toast.css">
<script src="assets/js/jquery.toast.js"></script>
<style>
 
   .notif-date{
    font-size: 0.7rem;
   }
   .toast-notif{
    width: 300px;
   }
   .nofication-list{
      width: 400px;
      height: 400px;
      overflow: auto;
      overflow-x: hidden;
   }
   #notifProfileImg{
      width: 60px;
      height: 60px;
      border-radius: 50%;
   }
   .content-con{
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
   }
    .forum-menus2{
      display: none;
   }
   #profileImg2{
      height: 50px;
      width: 50px;
      border-radius: 50%;
    }
   @media only screen and (max-width: 765px) {
    .forum-menus1{
      display: none;
    }
    .forum-menus2{
      padding: 10px 0px 10px 0px;
      display: block;
    }
    .forum-menus2 i{
      font-size: 1.5rem;
    }
    #finputSearch{
      height: 30px;
      font-size: 0.8rem;
    }
    .m-profile{
      font-size: 0.8rem;
      font-weight: bold;
      color: white;
    }
    #m-profileImg2{
      height: 40px;
      width: 40px;
      border-radius: 50%;
    }
 
   }
</style>
<!-- mobile -->
<div class="offcanvas offcanvas-start offcanvas-md p-0 m-0" id="navMenu" style="width:100%; font-family:Poppins;background: #343a40;">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title text-white" style="font-size: 1rem;">Forum</h1>
    <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body px-3">
        <ul class="navbar-nav text-white">
            <li class="nav-item m-nav-search">
              <form action="search.php" method="get">
                   <div class="input-group">
                       <input type="text" name="search" id="finputSearch" placeholder="Search.." class="form-control border-none" value="<?php echo $_GET['search'] ?? ''?>" required>
                         <button id="fbtnSearch" class="btn btn-primary">
                            <i class="bi bi-search text-light"></i>
                         </button>
                    </div>
                </form>
            </li>
              <li class="m-profile nav-item mb-3">
                  <img id="m-profileImg2" src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
                  &nbsp; <?php echo $row['firstname']. ' ' .$row['lastname']?>
               </li>
                 <li><a class="nav-link" href="view_profile.php?user_id=<?php echo $row['user_id']?>"><i class="bi bi-person"></i>&nbsp; My Profile</a></li>
                 <li><a class="nav-link" href="user_settings.php?user_id=<?php echo $row['user_id']?>"><i class="bi bi-gear"></i>&nbsp; User Settings</a></li>
                 <li><a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-left"></i>&nbsp; Logout</a></li>
         </ul>
  </div>
</div>

<nav class="forum-menus2 navbar navbar-expand-sm shadow-sm">
  <div class="container-fluid">
      <div class="d-flex align-items-center">
        <a href="index.php" class="nav-link"><i class="bi bi-arrow-bar-left"></i></a> 
        <a href="forum.php" class="nav-link me-3">Forum</a>
        <a href="forum.php" class="home-link nav-link">
           <i class="bi bi-house-door"  style="font-size: 1rem"></i>
           <span style="font-size: 0.7rem;">Home</span>
         </a>
      </div>
  
        
       <div class="d-flex align-items-center">
          <div class="me-3 d-flex">
              <a href="all_notification.php?user_id=<?php echo $user_id?>" class="nav-link">
               <i class="bi bi-bell" style="font-size: 1rem;"></i>
                   <?php
                      $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id' AND view = 'no'";
                      $total_new_notif = mysqli_num_rows(mysqli_query($conn, $query))
                    ?>
                </a>
                   <div class="notif-new">
                        <?php if($total_new_notif):?>
                           <span class="badge bg-danger float-start" style="font-size:0.5rem"><?php echo $total_new_notif?></span>
                        <?php endif;?>
                     </div> 
          </div>
          <div data-bs-toggle="offcanvas" data-bs-target="#navMenu">
             <i class="bi bi-list"></i>
          </div>
       </div>
       
  </div>
</nav>

<!-- pc -->
<nav class="forum-menus1 navbar navbar-expand-sm">
       <div class="container-fluid shadow-sm py-3 px-5"> 
         <ul class="navbar-nav">
            <li class="nav-item">
              <a href="index.php" class="nav-link"><i class="bi bi-arrow-bar-left" style="font-size: 2.5rem;"></i></a> 
            </li>
            <li class="nav-item">
                <a href="forum.php" class="nav-link ms-3 text-dark" style="font-size: 1.5rem;">Forum</a>
             </li>
             <li class="d-flex align-items-center px-5">
               <a href="forum.php" class="home-link nav-link me-5"><i class="bi bi-house-door"  style="font-size: 1.5rem;"></i> Home</a>
             </li>
             <li class="nav-item d-flex align-items-center">
                <form action="search.php" method="get">
                   <div class="input-group">
                       <input type="text" name="search" id="inputSearch" placeholder="Search.." class="form-control border-none" value="<?php echo $_GET['search'] ?? ''?>" required>
                         <button id="btnSearch" class="btn btn-primary">
                            <i class="bi bi-search text-light"></i>
                         </button>
                    </div>
                </form>
             </li>
              
          </ul>
          <div class="d-flex align-items-center">
             <div class="dropdown dropstart" style="cursor: pointer;">
                  <div id="btnNotif" class="d-flex align-items-center me-3" data-bs-toggle="dropdown" data-bs-auto-close="false">
                    <i class="bi bi-bell" style="font-size: 2rem;"></i>
                    <?php
                      $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id' AND view = 'no'";
                      $total_new_notif = mysqli_num_rows(mysqli_query($conn, $query))
                    ?>
                    <div class="notif-new">
                          <?php if($total_new_notif > 0):?>
                             <span class="badge bg-danger float-start"><?php echo $total_new_notif?></span>
                          <?php endif;?>
                     </div> 
                  </div>
                  
                 <ul class="dropdown-menu">
                    <li class="px-3">
                      <h4>Notification</h4>
                    </li>
                     <li><hr class="dropdown-divider"></hr></li>
                     <li>
                        <div class="text-end">
                           <a href="all_notification.php?user_id=<?php echo $user_id?>" class="nav-link text-primary px-3">View All</a>
                        </div>
                     </li>
                       <?php
                          $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'";
                          $result = mysqli_query($conn, $query);
                        ?>
               <?php if(mysqli_num_rows($result) > 0):?>

                     <li>
                      <div class="nofication-list">
                        <!-- New -->
                      <?php
                          $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'
                                    ORDER BY date DESC, time DESC
                                    LIMIT 3";
                          $result = mysqli_query($conn, $query);
                        ?>
                       <div class="px-3" style="font-weight: bold;">New</div>
                     <?php while($notif_row = mysqli_fetch_assoc($result)):?>
                       <a href="view_notification.php?notif_id=<?php echo $notif_row['notification_id']?>&post_id=<?php echo $notif_row['post_id']?>" class="nav-link">  
                        <div class="row px-3 py-2">
                           <div class="col-sm-2 d-flex align-items-center">
                              <?php
                                 $query = 'SELECT profile, firstname, lastname FROM user_account WHERE user_id = "'.$notif_row['source_id'].'"';
                                 $profile = mysqli_fetch_assoc(mysqli_query($conn, $query));
                              ?>
                             <img id="notifProfileImg" src="assets/uploaded_images/profile/<?php echo $profile['profile']?>" alt="buere">
                           </div>
                           <div class="col-sm-10 py-1 px-3" style="font-size: 0.9rem;">
                               <div class="source-con">
                                  <span class="source-name text-secondary" style="font-weight: bold;"><?php echo $profile['firstname'].' '.$profile['lastname']?></span>
                                  <?php if($notif_row['type'] === 'comment'):?>
                                  <span class="notif-type">commented to your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'reply'):?>
                                  <span class="notif-type">reply to your comment: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned1'):?>
                                  <span class="notif-type text-danger">Ban your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned2'):?>
                                  <span class="notif-type text-danger">Ban your topic: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned3'):?>
                                  <span class="notif-type text-danger">Ban your comment: </span>
                                  <?php endif;?>
                                  
                                  <?php if($notif_row['view'] === 'no'):?>
                                  <span class="float-end"><i class="bi bi-dot text-primary" style="font-size: 3rem;"></i></span>
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
                        ?>
               <?php if(mysqli_num_rows($result)):?> 
                  <div class="px-3" style="font-weight: bold;">Old</div>
                     <?php while($notif_row = mysqli_fetch_assoc($result)):?>
                       <a href="view_notification.php?notif_id=<?php echo $notif_row['notification_id']?>&post_id=<?php echo $notif_row['post_id']?>" class="nav-link">  
                        <div class="row px-3 py-2">
                           <div class="col-sm-2 d-flex align-items-center">
                              <?php
                                 $query = 'SELECT profile, firstname, lastname FROM user_account WHERE user_id = "'.$notif_row['source_id'].'"';
                                 $profile = mysqli_fetch_assoc(mysqli_query($conn, $query));
                              ?>
                             <img  id="notifProfileImg" src="assets/uploaded_images/profile/<?php echo $profile['profile']?>" alt="buere">
                           </div>
                           <div class="col-sm-10 py-1 px-3" style="font-size: 0.9rem;">
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
                                  <span class="float-end"><i class="bi bi-dot text-primary" style="font-size: 3rem;"></i></span>
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
                     <?php endif;?>  
                       </div>
                        <?php if(mysqli_num_rows($result) > 5):?>
                           <div id="floaderCon" class="container-fluid text-center py-3">
                         <div id="fspin" class="spinner-border text-primary spinner-sm"></div>
                         <button id="fbtnLoadMore" class="btn btn-primary btn-sm">
                          Load more
                         </button>
                        </div>
                        <?php endif;?>
                     </li>
                     
                     <li>
                       
                     </li>
                  <?php else:?> 
                       <li>
                         <div class="text-center py-5" style="padding: 0px 50px 0px 50px;">
                           <i class="bi bi-bell-slash" style="font-size: 9rem;"></i>
                           <br>
                           <br>
                           <span>
                              No Notification
                           </span>
                         </div>
                       </li>      
                  <?php endif;?>
                 </ul>
             </div>
            
             <div id="profile" class="dropdown dropstart d-flex align-items-center" style="cursor: pointer;">
                <img id="profileImg2" src="assets/uploaded_images/profile/<?php echo $row['profile']?>" data-bs-toggle="dropdown" alt="buere">
                &nbsp;<span data-bs-toggle="dropdown" style="font-weight:bold;"><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                <ul class="dropdown-menu">
                  <li class="text-center">
                  <img id="profileImg2" src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
                  
                 </li>
                 <li><hr class="dropdown-divider"></hr></li>
                 <li><a class="dropdown-item" href="view_profile.php?user_id=<?php echo $row['user_id']?>"><i class="bi bi-person"></i>&nbsp; My Profile</a></li>
                 <li><a class="dropdown-item" href="user_settings.php?user_id=<?php echo $row['user_id']?>"><i class="bi bi-gear"></i>&nbsp; User Settings</a></li>
                 <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i>&nbsp; Logout</a></li>
               </ul>
             </div>            
            </div>   
 
       </div>
      </nav>

                      
 <script>
   $(document).ready(function(){
      let isNotifClick = false;
      let pageNum1 = 5;
                
                $('#fspin').hide();
               $('#fbtnLoadMore').click(function(){
                   $('#fspin').show();
                   $('#fbtnLoadMore').hide();
                   pageNum1 = pageNum1 + 5
               })
      $('#btnNotif').click(function(){
          if (isNotifClick) {
            $(this).children('i').removeClass();
            $(this).children('i').addClass('bi bi-bell');
            isNotifClick = false;
         }else{
            $(this).children('i').removeClass();
            $(this).children('i').addClass('bi bi-bell-fill');
            isNotifClick = true;
         }
         
      })
      function loadNotification(){
          $.ajax({
            url: 'ajax/load_notif.php',
            method: 'GET',
            data:{limit: pageNum1},
            success: function(data){
               $('.nofication-list').html(data);
               $('#fspin').hide();
               $('#fbtnLoadMore').show();
            }
          })
         //  $.ajax({
         //    url: 'ajax/received_notif.php',
         //    method: 'GET',
         //    success: function(data){
         //       $('.notif-new').html(data);
         //    }
         //  })
          
      }
      function updateNotification(){
         $.ajax({
            url: 'ajax/received_notif.php',
            method: 'GET',
            success: function(data){
               $('.notif-new').html(data);
            }
          })
      }
      setInterval(loadNotification, 500);
      setInterval(updateNotification, 500);
   })
 </script>     