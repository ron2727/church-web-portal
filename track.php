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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <title>Track Request</title>
    <style>
        #pageTitle{
            background-image: url('assets/img/services.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .card{
            width: 400px;
            height: 450px;
        }
        .img-container{
            background-size: cover;
        }
        #serviceImage{
            background-size: cover;
            background-repeat: no-repeat;
        }
        span{
          font-family: 'Oswald', sans-serif;
        }
        /* Date Picker */
        .ui-datepicker{
          font-family: Poppins;
          border: 1px solid #f2f2f2 !important;
          padding: 0px !important;
          width: 90%;
        }
        .ui-datepicker-header{
          /* background: #3b82f6; */
          background: #6d28d9;
          color: white;
         }
        .ui-highlight{
          background: #dcfce7 !important;
          
        }
        .ui-state-default{
	     		/* background: #dcfce7 !important; */
 	        color: #22c55e !important;
          font-weight: bold !important;
          border: none !important;
          height: 40px;
	       }
      
        .ui-datepicker td.ui-state-disabled>span{
        background:#fee2e2 !important;
        color: #ef4444 !important;
        font-weight: bold;
        border: none;
        }
       .ui-datepicker td.ui-state-disabled{
        opacity:100;
        }
        .ui-datepicker-week-end{
          color: #ef4444;
        }

        /* Animations */

        .loading-word{
          display: block;
          animation-name: word-anim;
          animation-duration: 2s;
          animation-iteration-count: infinite;
         }
 

        @keyframes word-anim {
          from {opacity: 1;}
          to {opacity: 0;}
        }
 
    
    </style>
</head>
<body>
       <!-- Navigation -->
       <?php include('navigation.php')?>  
      
      <!-- Content -->

          <div id="modalResched" class="modal fade">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                      <div class="modal-header">
                            <h4>Request new schedule</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                     <div class="success-message">
                        <form name="formResched" id="formResched" action="member.php" method="POST">
                          <div class="modal-body">
                           </div>
                          <div class="modal-footer">
                             <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Submit">
                         </div>
                       </form>
                    </div>
                </div>
              </div>
             </div>

      <main>
          <div class="d-flex align-items-center" style="margin-top: 100px;">
            <div class="container-fluid mt-5 d-flex justify-content-center">
                <div id="trackMainCon" class="container-fluid shadow bg-white p-4 rounded-4 mb-5">
                   <p class="text-center">You can search here or know what the schedule of the service that you avail in our church</p>
                    <form class="search-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                      <br>
     
                       <div id="searchInput">
                            <label for="tracknum">Form Tracking Number</label>
                                <div class="input-group">
                                  <input type="text" name="tracknum" id="inputSearch" class="form-control border-none" placeholder="Search.." value="<?php echo $_GET['tracknum'] ?? ''?>" required>
                                  <button id="btnSearch" class="btn btn-primary">
                                    Search
                                  </button>
                                </div>
                            </div>
                    </form>

                    <nav class="navbar navbar-expand">
                        <div class="container-fluid py-2 border-top border-bottom">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a href="" class="nav-link active">Result</a>
                            </li>
                          </ul>
                        </div>
                    </nav>
                    <h1 class="test"></h1>
                     <!-- main content -->
                    <div class="container-fluid" style="font-family: Montserrat;">
                     <?php if(isset($_GET['tracknum'])):?>
                             <?php
                                $track_num = $_GET['tracknum'];
                                $tables = array('wedding_form', 'funeral_form', 'baptism_form');
                                foreach ($tables as $table) {
                                  $query = "SELECT * FROM $table WHERE tracking_number = '$track_num'";
                                  $result = mysqli_query($conn, $query);
                              
                                   if (mysqli_num_rows($result)) {
                                     $table_name = $table;
                                     break;
                                   }
                                }
                              ?>
                             <?php if(!empty($table_name)):?>
                                 <?php if($table_name === 'wedding_form'):?>
                                      <?php
                                          $query = "SELECT * FROM $table_name WHERE tracking_number = '$track_num'";
                                          $result = mysqli_query($conn, $query);
                                          $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="container-fluid border">
                                           <div class="row">
                                              <div id="serviceImage" class="col-md-4" style="background-image: url(assets/img/wedding.jpg);"></div>
                                              <div id="eventBody" class="col-md-8 p-3">
                                                <div class="container-fluid d-flex justify-content-end">
                                                  <span id="trackNum"><?php echo $row['tracking_number']?></span>
                                                </div>
                                                <h6 class="display-6 pb-3">
                                                  <span style="font-weight: bold;">Service:&nbsp;</span> <span id="serviceName"><?php echo $row['service']?></span>
                                                </h6>
                                                 <p>
                                                   <span style="font-weight: bold;">Requested by:&nbsp;</span> <span id="from"><?php echo $row['groom_fname'].' '.$row['groom_lname']?></span> 
                                                 </p>


                                                 <div class="row">
                                                    <div class="col-md-6">
                                                         <p>
                                                             <span style="font-weight: bold;">Scheduled:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_date']))?></span>
                                                         </p>
                                                          <p>
                                                               <span style="font-weight: bold;">Time:&nbsp;</span> <span id="schedDate"><?php echo date('g:i A', strtotime($row['time_from'])). ' ' .date('g:i A', strtotime($row['time_to']))?></span>
                                                          </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                       <p>
                                                          <span style="font-weight: bold;">Rehersal:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_redate']))?></span>
                                                       </p>
                                                        <p>
                                                           <span style="font-weight: bold;">Time:&nbsp;</span> <span id="schedDate"><?php echo date('g:i A', strtotime($row['time_refrom'])). ' ' .date('g:i A', strtotime($row['time_reto']))?></span>
                                                         </p>
                                                    </div>
                                                 </div>
                                               
                                              
                                                 <p>
                                                   <span style="font-weight: bold;">Status:&nbsp;</span>
                                                   <?php 
                                              if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                                                echo '<span class="text-white bg-danger badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Approved') {
                                                echo '<span class="text-white bg-warning badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Completed') {
                                                echo '<span class="text-white bg-success badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                            ?>
                                                 </p>
                                                    <?php if($row['status'] !== 'Completed'):?>
                                                      <?php
                                                         $query = 'SELECT * FROM reschedule_wedding WHERE tracking_number = "'.$row['tracking_number'].'"';
                                                         $requested =  mysqli_query($conn, $query);
                                                         $request = mysqli_fetch_assoc($requested);
                                                      ?>
                                                      <?php if(mysqli_num_rows($requested) > 0):?>
                                                         <?php if($request['status'] === 'pending'):?>
                                                           <div class="text-end">
                                                             <button class="btn btn-danger">Reschedule request sent</button>
                                                           </div>
                                                         <?php endif;?>
                                                         <?php if($request['status'] === 'approved'):?>
                                                           <div class="text-end">
                                                             <button class="btn btn-success">Schedule updated</button>
                                                           </div>
                                                         <?php endif;?>
                                                      <?php else:?>
                                                        <div class="text-end">
                                                          <button class="btnResched btn btn-primary" tracking-number="<?php echo $row['tracking_number']?>" service="wedding" data-bs-toggle="modal" data-bs-target="#modalResched" >Reschedule my request</button>
                                                        </div>
                                                      <?php endif;?> 
                                                      
                                                    <?php endif;?>  
                                              </div>
                                            </div>
                                         </div>
                                  <?php elseif($table_name === 'funeral_form'):?>
                                       <?php
                                          $query = "SELECT * FROM $table_name WHERE tracking_number = '$track_num'";
                                          $result = mysqli_query($conn, $query);
                                          $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="container-fluid border">
                                           <div class="row">
                                              <div id="serviceImage" class="col-md-4" style="background-image: url(assets/img/Funeral.jpg);"></div>
                                              <div id="eventBody" class="col-md-8 p-3">
                                                <div class="container-fluid d-flex justify-content-end">
                                                  <span id="trackNum"><?php echo $row['tracking_number']?></span>
                                                </div>
                                                <h6 class="display-6 pb-3">
                                                  <span>Service:&nbsp;</span> <span id="serviceName"><?php echo $row['service']?></span>
                                                </h6>
                                                <p>
                                                   <span style="font-weight: bold;">Requested by:&nbsp;</span> <span id="from"><?php echo $row['applicant_fname'].' '.$row['applicant_lname']?></span> 
                                                 </p>
                                                 <p>
                                                   <span style="font-weight: bold;">Schedule:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_date']))?></span>
                                                  </p>
                                                  <p>
                                                   <span style="font-weight: bold;">Time:&nbsp;</span> <span id="from"><?php echo date('h:iA', strtotime($row['time_from'])). ' - ' .date('h:iA', strtotime($row['time_to']))?></span> 
                                                 </p>
                                                 <p>
                                                   <span style="font-weight: bold;">Status:&nbsp;</span>
                                                   <?php 
                                              if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                                                echo '<span class="text-white bg-danger badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Approved') {
                                                echo '<span class="text-white bg-warning badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Completed') {
                                                echo '<span class="text-white bg-success badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                            
                                            ?>
                                                 </p>
                                              </div>
                                            </div>
                                         </div>
                                  <?php elseif($table_name === 'baptism_form'):?>      
                                    <?php
                                          $query = "SELECT * FROM $table_name WHERE tracking_number = '$track_num'";
                                          $result = mysqli_query($conn, $query);
                                          $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="container-fluid border">
                                           <div class="row">
                                              <div id="serviceImage" class="col-md-4" style="background-image: url(assets/img/<?php echo $row['baptism_type'] === 'child' ? 'baptism2.jpg' : 'baptism.jpg'?>);"></div>
                                              <div id="eventBody" class="col-md-8 p-3">
                                                <div class="container-fluid d-flex justify-content-end">
                                                  <span id="trackNum"><?php echo $row['tracking_number']?></span>
                                                </div>
                                                <h6 class="display-6 pb-3">
                                                  <span>Service:&nbsp;</span> <span id="serviceName"><?php echo $row['baptism_type'] === 'child' ? 'Child Dedication' : 'Water Baptism'?></span>
                                                </h6>
                                                <p>
                                                   <span style="font-weight: bold;">Applicant:&nbsp;</span> <span id="from"><?php echo $row['firstname'].' '.$row['lastname']?></span> 
                                                 </p>
                                                 <p>
                                                   <span style="font-weight: bold;">Schedule:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_date']))?></span>
                                                   <!-- <span id="schedTime">11:00am - 1:00pm</span> -->
                                                 </p>
                                                 <p>
                                                   <span style="font-weight: bold;">Time:&nbsp;</span> <span id="from"><?php echo date('h:iA', strtotime($row['time_from'])). ' - ' .date('h:iA', strtotime($row['time_to']))?></span> 
                                                 </p>
                                                 <p>
                                                   <span style="font-weight: bold;">Status:&nbsp;</span>
                                                   <?php 
                                              if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                                                echo '<span class="text-white bg-danger badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Approved') {
                                                echo '<span class="text-white bg-warning badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Completed') {
                                                echo '<span class="text-white bg-success badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                            
                                            ?>
                                                 </p>
                                                    <?php if($row['baptism_type'] === 'child'):?>
                                                       <?php if($row['status'] !== 'Completed'):?>
                                                        <?php
                                                         $query = 'SELECT * FROM reschedule_child WHERE tracking_number = "'.$row['tracking_number'].'"';
                                                         $requested =  mysqli_query($conn, $query);
                                                         $request = mysqli_fetch_assoc($requested);
                                                       ?>
                                                      <?php if(mysqli_num_rows($requested) > 0):?>
                                                         <?php if($request['status'] === 'pending'):?>
                                                           <div class="text-end">
                                                             <button class="btn btn-danger">Reschedule request sent</button>
                                                           </div>
                                                         <?php endif;?>
                                                         <?php if($request['status'] === 'approved'):?>
                                                           <div class="text-end">
                                                             <button class="btn btn-success">Schedule updated</button>
                                                           </div>
                                                         <?php endif;?>
                                                      <?php else:?>
                                                          <div class="text-end">
                                                             <button class="btnResched btn btn-primary" tracking-number="<?php echo $row['tracking_number']?>" service="child" data-bs-toggle="modal" data-bs-target="#modalResched" >Reschedule my request</button>
                                                          </div>
                                                      <?php endif;?>
                                                           
                                                       <?php endif;?>   
                                                    <?php endif;?>  
                                              </div>
                                            </div>
                                         </div>
                                  <?php endif;?>
                          <?php else:?>
                                    <div class="container-fluid d-flex justify-content-center py-5">
                                          <div><i class="bi bi-emoji-frown"></i> The Tracking Number you have entered does not exist</div>
                                     </div>
                          <?php endif;?>
                      
                     <?php else:?>
                               <div class="container-fluid d-flex justify-content-center py-5">
                                  <div><i class="bi bi-emoji-smile"></i> Please paste the tracking number of your form above</div>
                               </div>
                     <?php endif;?>
                    </div>
                </div>
            </div>
         </div>
      </main>
      <!-- Footer -->
     <!-- footer -->
     <?php include('footer.php')?>
                   

                  
   <script>
      $(document).ready(function(){
          $('.track-link').removeClass('text-white');
          $('.track-link').addClass('text-dark border rounded-pill px-4 bg-white');
          $('.m-track-link').removeClass('text-white');
          $('.m-track-link').addClass('text-dark border px-4 bg-white');
        })
   </script>

   <script>
       
         $('.btnResched').click(function(){
              let service = $(this).attr('service');
              let trackNum = $(this).attr('tracking-number');
              $('.test').html(service + ' ' + trackNum);
          
              if (service === 'wedding') {
                  $.ajax({
                    url: 'ajax/resched_wedding.php',
                    method: 'GET',
                    data: {tracknum: trackNum},
                    success: function(data){
                       $('.modal-body').html(data);
                    }
                  })
              }
              if (service === 'child') {
                  $.ajax({
                    url: 'ajax/resched_child.php',
                    method: 'GET',
                    data: {tracknum: trackNum},
                    success: function(data){
                       $('.modal-body').html(data);
                    }
                  })
              }


         })

         $('#formResched').submit(function(e){
             e.preventDefault();
             let formData = $(this).serialize();
               $('.success-message').html(`
                   <div class="text-center py-5">
                       <div class='spinner spinner-border spinner-border-lg'></div>
                       <h5 class="text-center py-3 loading-word" style="font-weight: bold;">Sending Reschedule Request
                       </h5>
                    </div>
               `);
        
             $.ajax({
              url: 'ajax/reschedule_message.php',
              method: 'POST',
              data: formData,
              success: function(data){
                  $('.success-message').html(data);
              }
             })

         })
   </script>
</body>
</html>