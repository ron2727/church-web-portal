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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>About Us</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&family=Red+Hat+Display&display=swap');
    .card{
            width: 300px;
            height: 400px;
        }
        /* .card-body{
            background-size: contain;
            background-repeat: no-repeat;
        } */
    #aboutText{
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: bold;
    }
    #missionText,#visionText{
        font-family: 'Red Hat Display', sans-serif; 
        font-weight: bold;
        letter-spacing: 2px;
    }
    body{
        background: white;
    }
    #imgContainer{
       margin-bottom: -80px;
    }
    #pageTitle{
            background-image: url('assets/img/church_img1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height:300px
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include('navigation.php')?>
  
      <!-- Content -->
      <main>
         <div id="pageTitle" class="container-fluid p-5 shadow mb-5 bg-white d-flex align-items-end">
                <p class="title-text display-3 text-light">About Us</p>
          </div>
         

      <div class="container">
          
             <div class="container-fluid">
                <!-- <p id="aboutText" class="text-center" style="font-size: 1.5rem">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet ea iusto quo aspernatur dicta veritatis minus velit suscipit illum quia itaque asperiores laudantium, impedit, sunt facilis sapiente laborum ducimus pariatur.
                 </p> -->
             </div>
             
             
             <div id="pastorContainer" class="border-top border-primary py-3" style="cursor: pointer;">
                  <h4 class="text-center" data-bs-toggle="collapse" data-bs-target="#pastorContent">Our Pastor</h4>
                  <div id="pastorContent">
                  <?php 
                     $query = "SELECT * FROM pastor WHERE privacy = 'visible'";
                     $result = mysqli_query($conn, $query);
                  ?>
                  <?php if (mysqli_num_rows($result) > 0):?>
                  <div id="carouselExampleControls" class="carousel slide">
                         <div class="carousel-inner py-3" style="font-family: Lato;">
                            <?php while($row = mysqli_fetch_assoc($result)):?>
                              <div class="carousel-item active">

                                   <div class="container d-flex justify-content-center">
                                         <div id="cardProfile" class="card border-0 shadow py-2 px-3">
                                            <div class="d-flex">
                                            <div class="card-header bg-white border-0 d-flex justify-content-center">
                              
                                                     <img id="profileImg" src="assets/uploaded_images/profile/<?php echo $row['image']?>" alt="a">
                                                            
                                            </div>
                                            <div class="card-body d-flex align-items-center">
                                                   <div>
                                                   <span id="pastorName" style="font-weight:bold;"><?php echo $row['name']?></span><br>
                                                   <span id="pastorPos" class="text-secondary"><?php echo $row['position']?></span>
                                                   </div>
                                            </div>
                                            </div>
                                            <div class="details p-3">
                                              <?php echo $row['description']?>
                                            </div>
                                         </div>
                                   </div>
                                </div>
                           <?php endwhile;?>
                            
                          </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                          <div class="p-4 bg-secondary rounded-circle">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                          </div>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                         <div class="p-4 bg-secondary rounded-circle">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                          </div>
                        </button>
                    </div>
                
                  <?php else:?>
                    <div class="py-5 text-center">
                          Nothing to show 
                    </div>
                  <?php endif;?>

                   </div>
             </div>



             <div id="visionContainer" class="border-top border-primary py-3" style="cursor: pointer;">
                  <h4 class="text-center" data-bs-toggle="collapse" data-bs-target="#visionText">Our Vision</h4>
                  <div id="visionText" class="text-center">
                    We envisioned renewed society by the Holy Spirit empowered people of God
                   </div>
             </div>

             <div id="missionContainer" class="border-top border-primary py-3" style="cursor: pointer;">
                  <h4 class="text-center" data-bs-toggle="collapse" data-bs-target="#missionText">Our Mission</h4>
                  <div id="missionText" class=" text-center">
                  To bring the gospel to the lost, to build lives to its fullest and to become like Christ in all things
                   </div>
             </div>

             <div id="addressContainer" class="border-top border-primary py-3" style="cursor: pointer;">
                  <h4 class="text-center" data-bs-toggle="collapse" data-bs-target="#address">Location</h4>
                  <div id="address" class=" text-center">
                    
                    <h6 class="text-start py-3"><span class="bg-dark rounded-circle p-1"><i class="bi bi-geo-alt text-light"></i></span>&nbsp; Road 20, Siwang Nagtinig, San Juan Taytay Rizal</h6>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d965.495940939042!2d121.11995911752636!3d14.542921179556442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTTCsDMyJzM0LjciTiAxMjHCsDA3JzEzLjQiRQ!5e0!3m2!1sen!2sph!4v1675082810829!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
             </div>

             <!-- <div id="contactContainer" class="border-top border-bottom border-primary py-3" style="cursor: pointer;">
                  <h4 class="text-center" data-bs-toggle="collapse" data-bs-target="#contactContent">Contact Us</h4>
                  <div id="contactContent">
                       <div class="row d-flex justify-content-center">
                          <div id="contactForm" class="col-sm-12">
                              <form action="">
                                <div>
                                  <label for="name">Name</label><br>
                                  <input type="text" name="name" class="form-control rounded-0 rounded-0" placeholder="Enter your Name">
                                  <small></small>
                                  <br>
                                </div>
                                <div>
                                  <label for="email">Email</label><br>
                                  <input type="text" name="email" class="form-control rounded-0" placeholder="Enter your Email">
                                  <small></small>
                                  <br>
                                </div>
                                <div>
                                  <label for="message">Message</label>
                                  <textarea name="message" id="message" rows="8" style="resize:none; font-family:Poppins" class="form-control rounded-0" placeholder="Write your Message"></textarea>
                                   <div class="d-flex justify-content-between py-2">
                                      <div>
                                       <button type="submit" class="btn btn-secondary">Submit</button>
                                      </div>
                                       <div class="d-flex">
                                        <span><a href="" class="nav-link me-2"><i class="bi bi-envelope-fill" style="font-size: 2rem;"></i></a></span>
                                        <span><a href="" class="nav-link"><i class="bi bi-facebook" style="font-size: 2rem;"></i></a></span>
                                       </div>
                                   </div>
                                </div>
                              </form>
                         </div>
                       </div>
                       
                     <div class="row">
                        <div class="col-sm-4 mb-3">
                            <div class="d-flex justify-content-start p-1">
                            <span class="rounded-circle bg-dark p-2 text-start">
                              <i class="bi bi-telephone text-light"></i>
                              </span>
                              &nbsp;09564196789
                            </div>

                            <div class="d-flex justify-content-start p-1">
                            <span class="rounded-circle bg-dark p-2 text-start">
                              <i class="bi bi-envelope text-light"></i>
                              </span>
                              &nbsp;taytayimmanuelchurch@gmail.com
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="d-flex justify-content-start p-1">
                            <span class="rounded-circle bg-dark p-2 text-start">
                              <i class="bi bi-facebook text-light"></i>
                              </span>
                              &nbsp;TaytayImmanuelChurch
                            </div>

                            <div class="d-flex justify-content-start p-1">
                            <span class="rounded-circle bg-dark p-2 text-start">
                            <i class="bi bi-twitter text-light"></i>
                              </span>
                              &nbsp;TaytayImmanuelChurch
                            </div>

                            <div class="d-flex justify-content-start p-1">
                            <span class="rounded-circle bg-dark p-2 text-start">
                             <i class="bi bi-instagram text-light"></i>
                              </span>
                              &nbsp;TaytayImmanuelChurch
                            </div>
                        </div>

                        <div class="col-sm-4 mb-3 d-flex justify-content-start">
                           <div class="p-1">
                            <span class="rounded-circle bg-dark p-2 text-start">
                            <i class="bi bi-geo-alt text-light"></i>
                              </span>
                              &nbsp;Road 20, Siwang Nagtinig, San Juan Taytay Rizal
                            </div>
                        </div>
                     </div>
                  </div>
             </div> -->


            
      </div>




      </main>

       <!-- footer -->
       <?php include('footer.php')?>

    
     <script>
        // $(document).ready(function(){
        //      $('#pastorContent').toggle();
        // })
        $(document).ready(function(){
          $('.about-link').removeClass('text-white');
          $('.about-link').addClass('text-dark border rounded-pill px-4 bg-white');
          $('.m-about-link').removeClass('text-white');
          $('.m-about-link').addClass('text-dark border px-4 bg-white');
        })
     </script>
</body>
</html>