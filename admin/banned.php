<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';
 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <link href="../assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/textarea/ui/trumbowyg.min.css">
    <title>Document</title>
</head>
<style>
   ul li{
    cursor: pointer;
   }
   ul li a:hover{
    background-color: #0275d8;
   }
   #tableContainer{
    height: 100%;
    overflow: auto;
   }
   .prof-img{
        width: 40px;
        height: 40px;
        border-radius: 50%;
       }
</style>

<body>
     <div class="container-fluid">
      <div class="row">
       <div id="sideNav" class="col-sm-2 bg-dark p-0" style="overflow-y: auto;height:100vh;">
            <div id="navTitle" class="border-bottom text-white p-4">
                 <h3 class="text-center">Admin</h3>
            </div>
            <!-- Menu -->
            <?php include('navigation.php')?>
            
       </div>
       <!-- Main content -->
       <div class="col-sm-10 p-0" style="height: 100vh;">
           <!-- Top nav -->
              <?php 
              include('top_navigation.php')
              ?>

 
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Forum</li>
                    <li class="breadcrumb-item">Banned</li>
                    <li class="breadcrumb-item"><?php echo ucfirst($_GET['type'])?></li>
                   </ol>
               </div>
                   <div style="height:70%">
                       <div class="container-fluid p-0 border bg-white">
                         <!-- <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddAcc">
                            <i class="bi bi-plus"></i> Add New
                            </button>
                          </div> -->

                         <div id="tableContainer" class="px-5 pt-3">
                 <?php if($_GET['type'] === 'comment'):?>
                               <?php 
                                  $query = "SELECT user_account.user_id,user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,comment.comment_id, comment.date, comment.time, comment.comment
                                  FROM user_account
                                  INNER JOIN comment ON user_account.user_id = comment.user_id
                                  WHERE comment.status = 'Banned'
                                  ORDER BY date DESC, time DESC";
                                  $result = mysqli_query($conn, $query);     
                                ?>
                        <?php if(mysqli_num_rows($result) > 0):?>
                         <?php while($row = mysqli_fetch_assoc($result)):?>  
                      <div class="row mb-2" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex">
                            <img class="prof-img" src="../assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                     <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;"><?php echo $row['ministry']?></span>
                                 </div>
                                
                                <div id="date" class="text-grey" style="font-size: 0.8rem;">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 py-3 d-flex align-items-center">
                            <div>
                            <p><?php echo $row['comment']?></p>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="bg-danger text-white float-start">
                                <span class="bg-danger badge rounded-pill">Banned</span>
                            </div>
                        </div>
                     </div>
                         <?php endwhile;?>
                         <?php else:?>
                             <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                             <i class="bi bi-emoji-laughing"></i>&nbsp;There's no banned comment
                             </div>
                        <?php endif;?>
                 <?php endif;?>
                 <?php if($_GET['type'] === 'post'):?>
                                <?php 
                                     $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,post.status, post.date, post.time, topics.topic, post.text,post.views, post.post_id, user_account.user_id, topics.topic_id 
                                     FROM user_account 
                                     INNER JOIN post ON post.user_id = user_account.user_id 
                                     INNER JOIN topics ON post.topic_id = topics.topic_id
                                     WHERE post.status = 'Banned'";     
                                     $result = mysqli_query($conn, $query);    
                                ?>
                                <?php if(mysqli_num_rows($result) > 0):?>
                         <?php while($row = mysqli_fetch_assoc($result)):?>  
                      <div class="row mb-2" style="border: 1px solid #d9d9d9; border-left: 4px solid #6C5B7B;">
                        <div class="col-md-5 py-4 d-flex">
                            <img class="prof-img" src="../assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                     <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;"><?php echo $row['ministry']?></span>
                                 </div>
                                
                                <div id="date" class="text-grey" style="font-size: 0.8rem;">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 py-3 d-flex align-items-center">
                            <div>
                            <h5 class="post-topic"><?php echo $row['topic']?></h5>
                            <p><?php echo $row['text']?></p>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="bg-danger text-white float-start">
                                <span class="bg-danger badge rounded-pill">Banned</span>
                            </div>
                        </div>
 
                     </div>
                         <?php endwhile;?>
                         <?php else:?>
                             <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                             <i class="bi bi-emoji-laughing"></i>&nbsp;There's no banned post
                             </div>
                        <?php endif;?>
                 <?php endif;?>

                 <?php if($_GET['type'] === 'member'):?>
                  <?php
                     date_default_timezone_set('Asia/Manila');
                     $query = "SELECT * FROM ban_duration";
                     $result = mysqli_query($conn, $query);
                     
                     if (mysqli_num_rows($result) > 0) {
                         while($row = mysqli_fetch_assoc($result)){
                            $user_id = $row['user_id'];
                            $current_hours  = date('G');
                            $current_mins = date('i');
                           
                            $ban_hours = date('G', strtotime($row['time_duration']));
                            $ban_mins = date('i', strtotime($row['time_duration']));
      
                            $days_left =  date('z', strtotime($row['date_duration'])) - date('z');
                            $hours_left = $ban_hours - $current_hours;
                            $mins_left = $ban_mins - $current_mins;
                            if($days_left <= 0 && $hours_left <= 0 && $mins_left <=0){
                                 $query = "UPDATE user_account SET status = 'Verified' WHERE user_id = '$user_id'";
                                 mysqli_query($conn, $query);
                                 $query = "DELETE FROM ban_duration WHERE user_id = '$user_id'";
                                 mysqli_query($conn, $query);
                             }

                          }
                     }
                  ?>
 
                 <?php
                   $query = "SELECT * FROM user_account WHERE status = 'Banned'";
                   $result = mysqli_query($conn, $query);
                  ?>
                  <?php if(mysqli_num_rows($result) > 0):?>
                     <?php while($row = mysqli_fetch_assoc($result)):?>  
                      <div class="row mb-2" style="border: 1px solid #d9d9d9; border-left: 4px solid #6C5B7B;">
                        <div class="col-md-5 py-4 d-flex align-items-center">
                            <img class="prof-img" src="../assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                     <span id="position" class="badge rounded-pill" style="background: #FF4E50;"><?php echo $row['ministry']?></span>
                                 </div>
                                
                              
                            </div>
                        </div>

                        <div class="col-md-6 py-3 d-flex align-items-center justify-content-end">
                            <div>
                                <?php
                                  $query = 'SELECT * FROM ban_duration WHERE user_id = "'.$row['user_id'].'"';
                                  $time = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                  $ban_hours = date('G', strtotime($time['time_duration']));
                                  $ban_mins = date('i', strtotime($time['time_duration']));
                                  $ban_month = date('n', strtotime($time['date_duration']));
                                  $ban_year = date('Y', strtotime($time['date_duration']));
                                  $ban_day = date('j', strtotime($time['date_duration']));

                                  $ban_timeleft = mktime($ban_hours, $ban_mins, 0, $ban_month, $ban_day, $ban_year) - mktime(date('H'), date('i'), 0, date('n'), date('j'), date('Y'));
                                  
                                  $days_left = date('z', $ban_timeleft);
                                  $hours_left = date('H', $ban_timeleft);
                                  $mins_left = date('i', $ban_timeleft);
                                  $sec_left = date('s', $ban_timeleft);
                                 ?>
                              
 
                                  <span class="d-inline">Account Availability</span>
                                  <span class="d-inline text-white px-2 py-1" style="background: #474747;"><?php echo date('F d, Y', strtotime($time['date_duration']))?></span>
                                  <span class="d-inline text-white px-2 py-1" style="background: #474747;"><?php echo date('h:i A', strtotime($time['time_duration']))?></span>
                                   
                             
                          
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="bg-danger text-white float-start">
                                <span class="bg-danger badge rounded-pill">Banned</span>
                            </div>
                        </div>
 
                     </div>
                         <?php endwhile;?>
                         <?php else:?>
                             <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                             <i class="bi bi-emoji-laughing"></i>&nbsp;There's no banned account
                             </div>
                        <?php endif;?>
                 <?php endif;?>
                         </div>
                       </div>
                   </div>
            </div>
       </div>
        
       </div>
     </div>
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>
     <script src="../assets/js/notification.js"></script>
     <script type="text/javascript">
        
          $(document).ready(function(){
            let type = '<?php echo $_GET['type'] ?? ''?>';
             $('.forum-menus').removeClass('collapse');
             $('.banned-menus').removeClass('collapse');
             if (type === 'comment') {
                $('.topic-link').addClass('rounded-3 bg-primary');
             }
             if (type === 'post') {
                $('.post-link').addClass('rounded-3 bg-primary');
             }
             if (type === 'member') {
                $('.mem-link').addClass('rounded-3 bg-primary');
             }
             
             
               $('#tbBaptism').DataTable({
                    autoWidth: false,
                    columnDefs: [
                                  {
                                   targets: ['_all'],
                                   className: 'mdc-data-table__cell',
                                  },
                                ],
              });
              $('.btn-change-pass').click(function(){
                let userID = $(this).attr('user-id');
                $('#modalChangePass').modal('show');
                $('#userId').val(userID);
              })
              if (action == 'add') {
                toastr.success('Account has been created successfully', 'Create Account');
              }
              if (action == 'changepass') {
                toastr.success('Change Password Successfully', 'Change Password');
              }
              if (action == 'error') {
                toastr.error('Creating an account failed', 'Create Account');
              }
              $('#events').addClass('dropdown').removeClass('dropup');
              $('#formAddEvent').validin({
                required_fields_initial_error_message: "",
                form_error_message: "",
              });
          })
     </script>

</body>
</html>