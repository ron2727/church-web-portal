<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="310x310" href="assets/img/tic_logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Services</title>
    <style>
        #pageTitle{
            backdrop-filter: blur(10px);
            background-image: url('assets/img/service.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height:300px
        }
     
        .img-container{
            background-size: cover;
        }
        #cardImg{
            background-size: cover;
            background-repeat: no-repeat;
        }
        #cardContainer{
            border-right: 15px solid #0275d8;
        }
    </style>
</head>
<body>
       <!-- Navigation -->
        <?php include('navigation.php')?>
      <!-- Content -->
      <main>
            <div id="pageTitle" class="container-fluid p-5 shadow mb-5 bg-white d-flex align-items-end">
                <p class="title-text display-3 text-light">Services</p>
             </div>
     

             <div class="container">
                   <div id="cardContainer" class="my-5 bg-white rounded-4 shadow p-3">
                     <div class="row">
                       <div class="col-md-5" style="height: 250px;">
                           <div id="cardImg" class="rounded-4 w-100 h-100" style="background-image: url('assets/img/baptism2.jpg');">
                      
                           </div>
                       </div>
                       <div class="col-md-7" style="height: 250px;font-family: Poppins;">
                            <h4 class="text-start py-3">Baptism</h4>
                            <p class="py-1">Come and celebrate this special occasion by our side. A Baptism is an important rite of passage, and one that should be shared with loved ones, Don't hesitate to make a request</p>
                            <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#bapTypeCon">Fill out form</button> 
                           
                        </div>
                    </div>
                      <div id="bapTypeCon" class="collapse py-3">
                               <div>
                                  <h4> Child Dedication</h4>
                                  <p>Our child dedication is a baptism for children.</p>
                                  <a href="auth.php?page=services&service=bchild" class="nav-link"><button class="btn btn-secondary">Proceed</button></a> 
                               </div>
                               <br>
                               <div>
                                  <h4>Water Baptism</h4>
                                  <p>Our baptism youth is for baptism for teens and adult</p>
                                  <a href="auth.php?page=services&service=byouth" class="nav-link"><button class="btn btn-secondary">Proceed</button></a> 
                                </div>
                       </div>
                   </div>

                   <div id="cardContainer" class="my-5 bg-white rounded-4 shadow p-3">
                     <div class="row">
                       <div class="col-md-5" style="height: 250px;">
                           <div id="cardImg" class="rounded-4 w-100 h-100" style="background-image: url('assets/img/wedding.jpg');">
                      
                           </div>
                       </div>
                       <div class="col-md-7" style="height: 250px;font-family: Poppins;">
                            <h4 class="text-start py-3">Wedding</h4>
                            <p class="py-1">We are so excited to celebrate our special day with family and friends. Don't hesitate to make a request</p>
                            <a href="auth.php?page=services&service=Wedding" class="nav-link "><button class="btn btn-secondary">Fill out form</button></a>
                        </div>
                    </div>
                   </div>

                   <div id="cardContainer" class="my-5 bg-white rounded-4 shadow p-3">
                     <div class="row">
                       <div class="col-md-5" style="height: 250px;">
                           <div id="cardImg" class="rounded-4 w-100 h-100" style="background-image: url('assets/img/Funeral.jpg');">
                      
                           </div>
                       </div>
                       <div class="col-md-7" style="height: 250px;font-family: Poppins;">
                            <h4 class="text-start py-3">Funeral</h4>
                            <p class="py-1">Funeral is a ceremony connected with the final disposition of a corpse, such as a burial or cremation, with the attendant observances, our church offer a funeral service</p>
                            <a href="auth.php?page=services&service=Funeral" class="nav-link "><button class="btn btn-secondary">Fill out form</button></a>
                        </div>
                    </div>
                   </div>

                   
             </div>


      </main>
      <!-- Footer -->
      <?php include('footer.php')?>

      <script>
         $(document).ready(function(){
          $('.services-link').removeClass('text-white');
          $('.services-link').addClass('text-dark border rounded-pill px-4 bg-white');
          $('.m-services-link').removeClass('text-white');
          $('.m-services-link').addClass('text-dark border px-4 bg-white');
        })
      </script>
</body>
</html>