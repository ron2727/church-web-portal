<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
$months = ['01' => 'January','02' =>  'February','03' =>  'March','04' =>  'April','05' =>  'May','06' =>  'June','07' =>  'July','08' =>  'August','09' =>  'September','10' =>  'October','11' =>  'November','12' =>  'December'];
date_default_timezone_set('Asia/Manila');
  $query = "SELECT * FROM event WHERE status = 'Upcoming'";
 $result = mysqli_query($conn, $query);
 $current_date = date('Y-m-d');
 $current_hours  = date('G');
 $current_mins = date('i');
 $current_month = date('n');
 $current_year = date('Y');
 $current_day = date('j');
 //  echo $current_year;
 while($time = mysqli_fetch_assoc($result)){
    $event_hours = date('G', strtotime($time['time']));
   $event_mins = date('i', strtotime($time['time']));
   $event_month = date('n', strtotime($time['date']));
   $event_year = date('Y', strtotime($time['date']));
   $event_day = date('j', strtotime($time['date']));
   echo $event_day;
     if ($current_year > $event_year) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
      mysqli_query($conn, $query);
    }
    if ($current_year === $event_year && $current_month > $event_month) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
      mysqli_query($conn, $query);
    }
    if ($current_year === $event_year && $current_month === $event_month && $current_day > $event_day) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
       mysqli_query($conn, $query);
    }
    if ($current_date == $time['date'] && $current_hours > $event_hours) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
       mysqli_query($conn, $query);
    }
    if ($current_date == $time['date'] && $current_hours >= $event_hours && $current_mins >= $event_mins) {
      $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
      mysqli_query($conn, $query);
   }
    // 
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
    <title>Events</title>
    <style>
    
        #pageTitle{
            background-image: url('assets/img/event.jpg');
            background-size:cover;
            background-repeat: no-repeat;
            height:300px
        }

        #eventImage{
            background-size: cover;
            background-repeat: no-repeat;

        }
       
    </style>
</head>
<body>
 
    
       <!-- Navigation -->
       <?php include('navigation.php')?>
        <!-- Content -->
        <main>
             <div id="pageTitle" class="container-fluid p-5 shadow mb-5 bg-white d-flex align-items-end">
                <p class="title-text display-3 text-light">Events</p>
             </div>
       <!-- Upcoming events content -->
            <div class="container-fluid pb-5 bg-white my-5">
                <p class="display-6 py-3 mb-3 text-center">
                    <span class="py-3" style="border-bottom:3px solid #121212">Upcoming Events</span>
                </p>
                <div class="container mt-5" style="font-family:Poppins;">
                     
                                        <!-- Event -->
            <?php
               $query = "SELECT * FROM event WHERE status = 'Upcoming'";
               $result = mysqli_query($conn, $query);
              ?>         
     <?php if(mysqli_num_rows($result) > 0):?>
        <?php foreach($months as $month):?>
          <?php
               $query = "SELECT * FROM event WHERE status = 'Upcoming' AND month = '$month'";
               $result = mysqli_query($conn, $query);
               $row = mysqli_fetch_assoc($result);   
             ?>   
             <?php if(mysqli_num_rows($result) > 0):?>
                     <div class="container-fluid bg-white mb-5">       
                       <div class="row">
                            <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <div class="text-info display-6 px-3"><?php echo date('F Y',strtotime($row['date']))?></div>
                             <div class="border border-primary bg-primary flex-grow-1" style="height:5px"></div>
                            </div>
                        </div>
                    <?php
                     $query = "SELECT * FROM event WHERE status = 'Upcoming' AND month = '$month'";
                     $result = mysqli_query($conn, $query);
                   ?>  
                   <?php while($row = mysqli_fetch_assoc($result)):?>
                     <div class="container-fluid d-flex">
                        <div class=" px-4 pt-5 border border-end-0 border-top-0 border-bottom-0 border-5 border-primary">
                            <h4 class="text-center"><?php echo date('D',strtotime($row['date']))?></h4>
                            <h4 class="text-center display-6 text-dark"><?php echo date('d',strtotime($row['date']))?></h4>
                        </div>
                       <div class="container-fluid">
                         <div class="row p-1 mb-3">
                            <div id="eventImage" class="col-md-4 rounded-3" style="background-image: url(assets/uploaded_images/event/<?php echo $row['image']?>);">        
                            </div>
                            <div id="eventBody" class="col-md-8 p-3 d-flex flex-wrap align-items-between">
                                <div>
                                <h1 class="event-title text-primary"><?php echo $row['title']?></h1>
                                <p class="event-place"><?php echo "@ ".$row['place']?></p>
                                <p class="event-date"><?php echo date('F d, Y',strtotime($row['date']))?></p>
                                <p class="event-time"><?php echo date('g:i A',strtotime($row['time']))?></p>
                                </div>
                                <div id="eventFooter" class="container-fluid d-flex justify-content-end">
                                  <a href="view_event.php?event_id=<?php echo $row['event_id']?>" class="nav-link">
                                  <button class="btn py-1 px-2 btn-primary">
                                  Read More
                                  </button>
                                  </a>
                               </div>
                            </div>
                         
                          </div>
                        </div>
                       </div> 
                     <?php endwhile;?> 
                  </div>       
               <?php endif;?>    
        <?php endforeach;?>
      <?php else:?>
        <div class="text-center py-5">
          No upcoming events yet
        </div>
     <?php endif;?>      

                </div>
            </div>
         <!-- Search field past -->
          <div class="container bg-white border p-0 mb-5">
            
             <p class="p-3 border-bottom">Search Past Events</p>
          <form id="formSearchEv" action="event.php" method="get">
             <div class="container pb-3 d-flex">
                  <input type="month" name="search" id="inputDate" class="form-control" value="<?php echo $_GET['search'] ?? ''?>">
                  <!-- <button type="submit" class="btn btn-primary ml-3">Search</button> -->
             </div>
           </form>
                   
            </div>
            <!-- Past Events Content -->
            <div class="container-fluid pb-5 bg-white my-5">
                <p class="display-6 py-3 mb-3 text-center">
                    <span class="py-3" style="border-bottom:3px solid #121212">Past Events</span>
                </p>
                
                <div id="event" class="container">

               
                
                  <div class="container-fluid d-flex justify-content-center">
                       <div>
                             To view past events you can search it by month
                       </div>
                  </div>
                    
               </div>
          </div>
    
      </main>
      

      <!-- footer -->
      <?php include('footer.php')?>


    <script>
       $(document).ready(function(){
          $('.events-link').removeClass('text-white');
          $('.events-link').addClass('text-dark border rounded-pill px-4 bg-white');
          $('.m-events-link').removeClass('text-white');
          $('.m-events-link').addClass('text-dark border px-4 bg-white');
          
          $('#inputDate').change(function(e){
               let search = $(this).val();
                $('#event').html(`<div class="container-fluid text-center py-5">
                                    <span class="spinner spinner-border spinner-border-lg text-primary"></span>
                                  </div>`);
                    $.ajax({
                    url: 'ajax/search_event.php', 
                    method: 'GET',
                    data: {s: search},
                    success: function(data){
                    $('#event').html(data);
                }
                
               })
              
          })

        })
    </script>
</body>
</html>