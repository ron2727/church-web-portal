<?php
require __DIR__ .'/assets/database/connection.php';
$months = ['01' => 'January','02' =>  'February','03' =>  'March','04' =>  'April','05' =>  'May','06' =>  'June','07' =>  'July','08' =>  'August','09' =>  'September','10' =>  'October','11' =>  'November','12' =>  'December'];
if (!isset($_GET['event_id'])) {
    header("Location: event.php");
}else {
    $event_id = $_GET['event_id'];
}
$query = "SELECT * FROM event WHERE event_id = $event_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$date = explode('-', $row['date']);
[$year, $month, $day] = $date;

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="310x310" href="assets/img/tic_logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Event</title>
    <style>
   
        #pageTitle{
            background-image: url('assets/img/event.jpg');
            background-size:cover;
            background-repeat: no-repeat;

        }
        .event-image{
            width: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .event-des{
            font-size: 1.2rem;
        }
      
    </style>
</head>
<body>
         <!-- Navigation -->
         <?php include('navigation.php')?>

        <!-- Content -->
        <main>
            
<!-- Upcoming events content -->
            <div class="container-fluid pb-5 bg-white d-flex justify-content-center" style="margin-top: 100px;">
               
                <div id="viewEventCon" class="container mt-5" style="font-family: 'Lato', sans-serif;">
                 <h1 style="font-weight: bold;"><?php echo $row['title']?></h1>
                 <div class="date-status my-2">
                   <span class=" rounded-pill px-3 py-1 bg-primary text-white"><?php echo $row['status']?></span>
                   <span class="date" style="font-weight: bold;"><?php echo date('F d, Y', strtotime($row['date']))?></span>
                 </div>
                      <div class="event-image container-fluid bg-white mb-5" style="background-image: url('assets/uploaded_images/event/<?php echo $row['image'] ?? ''?>');">      
                     </div>
                     <div class="event-des">    
                        <?php if(!empty($row['description'])):?>
                           <?php echo $row['description']?>
                        <?php else:?>
                            <h5 class="text-center py-5 my-5">
                              No Description
                            </h5>
                        <?php endif;?>
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
        })
    </script>
    
</body>
</html>