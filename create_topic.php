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
            $topic = $_POST['topic'];
            $description = $_POST['description'];

            $query = "INSERT INTO topics(user_id, topic, description,date, time, privacy) VALUES('$user_id', '$topic', '$description', '$date', '$time', '$privacy')";
            mysqli_query($conn, $query);
            header("Location: topics.php");
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
                       <h3>Create New Topic</h3>
                  </div>    
            <?php
               $user_id = $_SESSION['user_id'];
               $query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
               $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
             ?>
             <div id="postList" class="container border p-3">
                <!-- Profile Con -->
                <div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">
                    <div id="userInfo" class="d-flex">    
                        <div id="imgContainer">
                           <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="<?php $row['profile']?>">
                        </div>
                        <div id="userNameContainer" class="ms-3">
                           <div id="userName">
                              <span class="username-text"><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                               <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="position" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
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
                             </ul>
                           </div>
                         </div>
                      
                    </div>          
              </div>
                <!-- End -->
                  <form id="postForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                  <input class="form-control" type="hidden" name="privacy" id="privacy" value="Anyone">
                    <div id="selecttopic">
                       <label class="label-head">Topic</label>
                       <input type="text" name="topic" class="form-control" placeholder="Enter your topic" required>
                     </div>
                     <br>
                     <div class="inputField">
                        <label class="label-head">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
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
     <script src="assets/js/validin.js"></script>
     <script src="assets/libs/textarea/trumbowyg.min.js"></script>
     <script>
            $(document).ready(function(){
              $('#postForm').validin({
               });
               $('#description').trumbowyg({
                  btns: [
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['strong', 'em'],
                 ],
               });

               $('.privacy-type').click(function(){
                 let privacy = $(this).html();
                 let privacyText = $(this).text();
                 $('#btnPrivacy').html(privacy);
                 $('#privacy').val(privacyText.trim());
             })
         })
      
     </script>
 </body>
</html>