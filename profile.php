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
    </style>
</head>
<body class="bg-white">
     <nav id="mainNav" class="navbar navbar-expand-md" style="background-color: #3F4359;opacity: 0.8">
        <div class="container-fluid d-flex justify-content-between p-3">
            <a id="logo" class="navbar-brand text-light">Taytay Immanuel Church</a>
               <ul class="navbar-nav">
                  <li class="nav-item"><a href="index.php" class="nav-link text-light">Home</a></li>
                  <li class="nav-item"><a href="services.php" class="nav-link text-light">Services</a></li>
                  <li class="nav-item"><a href="event.php" class="nav-link text-light">Events</a></li>
                  <li class="nav-item"><a href="aboutus.php" class="nav-link text-light">About Us</a></li>
                  <li class="nav-item"><a href="forum.php" class="nav-link text-light" style="font-weight: bold;">Forum</a></li>
              </ul>        
        </div>
      </nav>
       <!-- Arrow down -->
       <div id="arrow" class="container-fluid btn text-center" data-bs-toggle="collapse" data-bs-target="#mainNav"> 
         <div id="arrowIcon" class="down">
           <i class="bi bi-chevron-down"></i>
         </div>
      </div>
        
      <nav class="navbar navbar-expand-sm">
       <div class="container-fluid shadow-sm px-5 pb-3 mb-5">
           <a href="" class="navbar-brand" style="font-size: 1.5rem;">Forum</a>
           <div id="profile" class="dropdown d-flex align-items-center" data-bs-toggle="dropdown" data-bs-target="#profile" style="cursor: pointer;">
                <img src="assets/img/alden3.jpg" alt="buere">
               <span class="px-2">
                John Ron Buere
               </span>
               <ul class="dropdown-menu">
                 <li><a class="dropdown-item" href="#">My Profile</a></li>
                 <li><a class="dropdown-item" href="#">User Settings</a></li>
                 <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
           </div>
       </div>
      </nav>


      <main>
        
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
     </script>
</body>
</html>