<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
date_default_timezone_set('Asia/Manila');
if (!isset($_SESSION['user_id'])) {
    header("Location: forum_guest.php");
    exit;
}
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
   $user_id = $_SESSION['user_id'];
   $privacy = $_POST['privacy'];
   $date = date('Y-m-d');
   $time = date('G:i');
   if ($privacy === 'Group') {
     $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
     $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
     $privacy = $group['ministry'];
   }

   $topic_id = $_POST['topic'];
   $text = $_POST['text'];

   $query = "INSERT INTO post(user_id, topic_id, text, date, time, privacy) VALUES('$user_id', $topic_id, '$text', '$date', '$time', '$privacy')";
   mysqli_query($conn, $query);
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
    <link rel="stylesheet" href="assets/libs/textarea/ui/trumbowyg.min.css">
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
       .username-text{
         font-size: 1.3rem;
       }
       .label-head{
        font-size: 1rem;
       }
       .dropdown-item:hover{
         cursor: pointer;
       }
       .main-con{
            width: 60%;
            margin-top: 20px;
         }
       @media only screen and (max-width: 765px) {
         .main-con{
            width: 100%;
         }
         .username-text{
            font-size: 0.8rem;
         }
         #position{
            font-size: 0.5rem;
         }
         .privacy-type, #btnPrivacy{
            font-size: 0.8rem;
         }
         #btnPrivacy{
            font-size: 0.8rem;
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
                 <div class="container-fluid p-2 px-3 border mb-2">
                       <h3>Create Post</h3>
                  </div>    
          
             <?php
               $user_id = $_SESSION['user_id'];
               $query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
               $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
             ?>
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
                            <div class="dropdown">
                              <button id="btnPrivacy" type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" style="background: #e5e7eb;font-weight:bold">
                                 <i class="bi bi-globe-americas"></i> Anyone
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
                     <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                      <input class="form-control" type="hidden" name="privacy" id="privacy" value="Anyone">
                      <input class="form-control" type="hidden" name="topic" id="topic">
                      <label class="label-head">Topic</label>
                        <div class="dropdown">
                              <button id="btnTopic" type="button" class="btn btn-white border" data-bs-toggle="dropdown" style="font-weight:bold;width:100%;">
                                 Select topic..
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
                     <div class="inputField">
                        <label class="label-head">Text</label>
                        <textarea name="text" id="text" class="form-control"></textarea>
                     </div>
                     <div class="text-end">
                  <br>
                  <a href="signin.php" style="text-decoration: none;">
                   <button type="button" class="btn btn-secondary py-2 rounded-5 px-4" style="text-decoration: none;">
                      Cancel
                 </button>
                 </a>
                <button id="btnSubmit" type="submit" class="btn btn-primary py-2 rounded-5 px-4">
                  <div id="btnSubSpin"></div> Post
                </button>
    
                </div>
                  </form>
                 
        
 
                 <!-- End -->
                 
             </div>

            <!-- <div class="container d-flex justify-content-end border pt-3">
            <ul class="pagination pagination-sm">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
             </ul>
            </div> -->
    
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
                    ['emoji'],
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
                     $('#info').html('<i class="bi bi-info-circle"></i> This topic privacy is only for your group, privacy automatically set to group ' + privacy);
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
 </body>
</html>