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
    <link rel="icon" type="image/png" sizes="310x310" href="../assets/img/tic_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <title>Admin|Dashboard</title>
</head>
<style>
   @import url('https://fonts.googleapis.com/css2?family=Anton&family=Raleway&family=Secular+One&family=Roboto&family=Lato&family=Poppins&display=swap');

   ul li{
    cursor: pointer;
   }




   ul li a:hover{
    background-color: #0275d8;
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
       <div class="col-sm-10" style="height:100vh; overflow: auto;">
           <!-- Top nav -->
              <?php 
              include('top_navigation.php')
              ?>
        

            <!-- Table Section -->
            <div class="container-fluid h-80 pb-5">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
            
                  </ol>
               </div>
                   <div>
                    <style>
                         .status{
                          font-weight: bold;
                         }
                    </style>
                       <div id="serviceCon">
                           <div class="row" style="font-family: Poppins;">
                             <h2>Services</h2>
                             <!-- 1 -->
                              <div class="col-4 d-flex justify-content-center">
                                  <div class="text-white py-5 rounded-4" style="width: 90%;background:#fef3c7;">
                                      <div class="d-flex justify-content-between px-4">
                                         <h3  style="color: f59e0b;font-size:1.5rem"><i class="bi bi-gear-wide-connected"></i> Child Dedication</h3>
                                         <?php 
                                           $query = "SELECT * FROM baptism_form WHERE status = 'Completed' AND baptism_type = 'child'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                         <span class="status" style="color: f59e0b;"><?php echo $total_completed?></span>
                                      </div>
                                      <div class="d-flex justify-content-around text-dark pt-5">
                                         <?php 
                                           $query = "SELECT * FROM baptism_form WHERE status = 'Approved' AND baptism_type = 'child'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-success"><i class="bi bi-check-lg"></i> Approve: <?php echo $total_completed?></div>
                                        <?php 
                                           $query = "SELECT * FROM baptism_form WHERE status = 'Pending' AND baptism_type = 'child'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-danger"><i class="bi bi-dash-circle-fill"></i> Pending: <?php echo $total_completed?></div>
                                      </div>
                                  </div>
                              </div>

                              <!-- 1 -->
                              <div class="col-4 d-flex justify-content-center">
                                  <div class="text-white py-5 rounded-4" style="width: 90%;background:#fef3c7;">
                                      <div class="d-flex justify-content-between px-4">
                                         <h3  style="color: f59e0b;font-size:1.5rem"><i class="bi bi-gear-wide-connected"></i> Water Baptism</h3>
                                         <?php 
                                           $query = "SELECT * FROM baptism_form WHERE status = 'Completed' AND baptism_type = 'youth'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                         <span class="status" style="color: f59e0b;"><?php echo $total_completed?></span>
                                      </div>
                                      <div class="d-flex justify-content-around text-dark pt-5">
                                         <?php 
                                           $query = "SELECT * FROM baptism_form WHERE status = 'Approved' AND baptism_type = 'youth'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-success"><i class="bi bi-check-lg"></i> Approve: <?php echo $total_completed?></div>
                                        <?php 
                                           $query = "SELECT * FROM baptism_form WHERE status = 'Pending' AND baptism_type = 'youth'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-danger"><i class="bi bi-dash-circle-fill"></i> Pending: <?php echo $total_completed?></div>
                                      </div>
                                  </div>
                              </div>
                                  <!-- 2 -->
                                  <div class="col-4 d-flex justify-content-center">
                                  <div class="text-white py-5 rounded-4" style="width: 90%;background:#ede9fe;">
                                      <div class="d-flex justify-content-between px-4">
                                         <h4  style="color: #8b5cf6;"><i class="bi bi-gear-wide-connected"></i> Wedding</h4>
                                         <?php 
                                           $query = "SELECT * FROM wedding_form WHERE status = 'Completed'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                         <span class="status" style="color: #8b5cf6;"><?php echo $total_completed?></span>
                                      </div>
                                      <div class="d-flex justify-content-around text-dark pt-5">
                                         <?php 
                                           $query = "SELECT * FROM wedding_form WHERE status = 'Approved'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-success"><i class="bi bi-check-lg"></i> Approve: <?php echo $total_completed?></div>
                                        <?php 
                                           $query = "SELECT * FROM wedding_form WHERE status = 'Pending'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-danger"><i class="bi bi-dash-circle-fill"></i> Pending: <?php echo $total_completed?></div>
                                      </div>
                                  </div>
                              </div>


                              <div class="col-4 d-flex justify-content-center mt-2">
                                  <div class="text-white py-5 rounded-4" style="width: 90%;background:#dcfce7;">
                                      <div class="d-flex justify-content-between px-4">
                                         <h4  style="color: #22c55e;"><i class="bi bi-gear-wide-connected"></i> Funeral</h4>
                                         <?php 
                                           $query = "SELECT * FROM funeral_form WHERE status = 'Completed'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                         <span class="status" style="color: #22c55e;"><?php echo $total_completed?></span>
                                      </div>
                                      <div class="d-flex justify-content-around text-dark pt-5">
                                         <?php 
                                           $query = "SELECT * FROM funeral_form WHERE status = 'Approved'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-success"><i class="bi bi-check-lg"></i> Approve: <?php echo $total_completed?></div>
                                        <?php 
                                           $query = "SELECT * FROM funeral_form WHERE status = 'Pending'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-danger"><i class="bi bi-dash-circle-fill"></i> Pending: <?php echo $total_completed?></div>
                                      </div>
                                  </div>
                              </div>
                              </div>
                           </div>

                           <div id="event" class="mt-5">
                           <div class="row" style="font-family: Poppins;">
                             <h2>Events</h2>
                             <!-- 1 -->
                              <div class="col-4 d-flex justify-content-center">
                                  <div class="text-white py-5 rounded-4" style="width: 90%;background:#ffe4e6;">
                                      <div class="d-flex justify-content-between px-4">
                                         <h3  style="color: #f43f5e;">
                                                <i class="bi bi-calendar-event-fill"></i>
                                             Events
                                          </h3>
                                         <?php 
                                           $query = "SELECT * FROM event";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                         <span class="status" style="color: #f43f5e;"><?php echo $total_completed?></span>
                                      </div>
                                      <div class="d-flex justify-content-around text-dark pt-5">
                                         <?php 
                                           $query = "SELECT * FROM event WHERE status = 'Past'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-success"><i class="bi bi-check-lg"></i> Past: <?php echo $total_completed?></div>
                                        <?php 
                                           $query = "SELECT * FROM event WHERE status = 'Upcoming'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-danger"><i class="bi bi-dash-circle-fill"></i> Upcoming: <?php echo $total_completed?></div>
                                      </div>
                                  </div>
                              </div>
 
                           </div>
                       </div>

                       <div id="forum" class="mt-5">
                           <div class="row" style="font-family: Poppins;">
                             <h2>Forum</h2>
                             <!-- 1 -->
                              <div class="col-4 d-flex justify-content-center">
                                  <div class="text-white py-5 rounded-4" style="width: 90%;background:#fae8ff;">
                                      <div class="d-flex justify-content-between px-4">
                                         <h4  style="color: #d946ef;">
                                                <i class="bi bi-calendar-event-fill"></i>
                                             User Account
                                          </h4>
                                         <?php 
                                           $query = "SELECT * FROM user_account";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                         <span class="status" style="color: #d946ef;"><?php echo $total_completed?></span>
                                      </div>
                                      <div class="d-flex justify-content-around text-dark pt-5">
                                         <?php 
                                           $query = "SELECT * FROM user_account WHERE status = 'Verified'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-success"><i class="bi bi-check-lg"></i> Member : <?php echo $total_completed?></div>
                                        <?php 
                                           $query = "SELECT * FROM user_account WHERE status = 'Pending'";
                                           $result = mysqli_query($conn, $query);
                                           $total_completed = mysqli_num_rows($result)
                                         ?>
                                      <div class="status text-danger"><i class="bi bi-dash-circle-fill"></i> Pending: <?php echo $total_completed?></div>
                                      </div>
                                  </div>
                              </div>

 




                   </div>
            </div>
       </div>
        
       </div>
     </div>
      

     <script src="../assets/js/animation.js"></script>
     <script>
        $('.dash-link').addClass('text-primary')
     </script>
</body>
</html>