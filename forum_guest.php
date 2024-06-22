<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: forum.php");
  exit;
// if ($_SESSION['user_role'] === 'Admin') {
//   header("Location: admin");
//   exit;
// }
// if ($_SESSION['user_role'] === 'Member') {
//   header("Location: forum.php");
//   exit;
// }  
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="310x310" href="assets/img/tic_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Forum</title>
    <style>
        .nav-menus{
          padding: 20px 30px 20px 30px;
        }
        .forumText{
          font-size: 1.5rem;
        }
        .nav-sign{
          padding: 3px 10px 3px 10px;
        }
        .message-con{
          height: 100vh;
        }
        .message-con div{
         padding: 30px 40px 30px 40px;
        }        

        .arrow-left{
          font-size: 2.5rem;
        }
        @media only screen and (max-width: 765px) {
        
        .nav-menus{
          padding: 10px 5px 10px 5px;
         }
        .arrow-left{
          font-size: 1rem;
        }
        .forumText{
          font-size: 1rem;
        }
        .nav-sign a{
          font-size: 0.8rem;
        }
        .nav-sign{
          padding: 0;
        }
        .message-con div{
         padding: 30px 40px 30px 40px;
        }
        .message-con div p{
          font-size: 1rem;
        }
        }
    </style>
</head>
<body>
     <!-- navigation -->
      <!-- <nav id="mainNav" class="navbar navbar-expand-md bg-dark">
        <div class="container-fluid d-flex justify-content-between py-3 ps-5">
            <a class="navbar-brand text-white">
               Taytay Immanuel Church
               <img src="assets/img/alden3.jpg" alt="">
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navMenu" class="collapse navbar-collapse">
               <ul class="navbar-nav">
                  <li class="nav-item px-2"><a href="index.php" class="nav-link text-white">Home</a></li>
                  <li class="nav-item px-2"><a href="services.php" class="nav-link text-white">Services</a></li>
                  <li class="nav-item px-2"><a href="event.php" class="nav-link text-white">Events</a></li>
                  <li class="nav-item px-2"><a href="aboutus.php" class="nav-link text-white">About Us</a></li>
                  <li class="nav-item px-2"><a href="track.php" class="nav-link text-white">Track Request</a></li>
                  <li class="nav-item px-2"><a href="forum_guest.php" class="nav-link text-dark border rounded-pill px-4 bg-white">Forum</a></li>
                  
              </ul>
            </div>
        </div>
      </nav>    -->
      <!-- Arrow down -->
      <!-- <div id="arrow" class="container-fluid btn text-center" data-bs-toggle="collapse" data-bs-target="#mainNav"> 
         <div id="arrowIcon" class="down">
           <i class="bi bi-chevron-down"></i>
         </div>
      </div> -->

      <nav class="navbar navbar-expand">
       <div class="nav-menus container-fluid shadow-sm">
           <!-- <a href="i" class="navbar-brand" style="font-size: 1.5rem;">Forum</a> -->
           <ul class="navbar-nav">
           <li class="nav-item">
              <a href="index.php" class="arrow-left nav-link"><i class="bi bi-arrow-bar-left"></i></a> 
            </li>
             <li class="nav-item d-flex align-items-center">
                 <span class="forumText">Forum</span>
             </li>
            </ul>

            <ul class="navbar-nav">
             <li class="nav-sign nav-item me-3 bg-primary text-light"><a href="signin.php" class="nav-link text-light">Sign In</a></li>
             <li class="nav-sign nav-item border border-secondary text-light"><a href="signup.php" class="nav-link">Sign Up</a></li>
           </ul>
       </div>

      </nav>

      <main>
               
          <div class="message-con container-fluid d-flex align-items-center justify-content-center">
               <div class="shadow">
                <div class="text-center">
                 <i class="bi bi-file-earmark-lock display-3"></i>
                 </div>
                 <p class="display-6">To view this content please Login first</p>
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

     <!-- <script>
         $(document).ready(function(){
              $('#arrow').click(function(){
                   if ($('#arrowIcon').hasClass('down')) {
                    $('#arrowIcon').removeClass('down');
                    $('#arrowIcon').addClass('up');
                   }else{
                    $('#arrowIcon').removeClass('up');
                    $('#arrowIcon').addClass('down');
                   }
                  
              })
          })
     </script> -->
</body>
</html>