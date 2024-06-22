<?php
require __DIR__ .'/assets/database/connection.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Home</title>
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Secular+One&display=swap');
     @import url('https://fonts.googleapis.com/css2?family=Roboto');
      #signinText{
        font-family: 'Secular One', sans-serif;
      }
      #signinText1{
        font-family: 'Secular One', sans-serif;
        text-transform: uppercase;
      }
      label, #btnSubmit{
        font-family: 'Roboto', sans-serif;
      }
     
    </style>
</head>
<body>
    <!-- Navigation -->
     <nav class="navbar navbar-expand-md" style="background: #343a40;">
        <div class="container-fluid d-flex justify-content-between">
           <div class="navbar-brand text-light">
              <a href="index.php" class="navbar-brand text-white">
               <img src="assets/img/tic_logo.png" alt="logo" style="width: 60px; height: 60px; border-radius: 50%">
               <span class="nav-title">Taytay Immanuel Church</span>
              </a>
            </div>
        </div>
      </nav>

     <main>
         <?php if ($_GET['confirmation'] === 'signup'): ?>
            <div class="container-fluid h-75 d-flex justify-content-center align-items-center">
                  <div class="confirm-container p-5 bg-white border">
                    <h4>Successfully Register</h4>
                    <p class="py-3">We will notify you through your email after verifying your account</p>
                    <a href="index.php" class="navbar-brand border border-dark me-5 px-4 py-2">Home</a>
                  </div>
            </div>
         <?php endif;?>

         <?php if ($_GET['confirmation'] === 'service'): ?>
            <div class="container-fluid h-75 d-flex justify-content-center align-items-center">
                  <div class="confirm-container p-5 bg-white border">
                    <h4>Form received</h4>
                     <p>You can track your request in My Booking</p>
                    <p>Thank you!</p>
                    <a href="index.php" class="navbar-brand border border-dark me-5 px-4 py-2">Home</a>
                  </div>
            </div>
         <?php endif;?>

         <?php if ($_GET['confirmation'] === 'change'): ?>
            <div class="container-fluid h-75 d-flex justify-content-center align-items-center">
                  <div class="confirm-container p-5 bg-white border">
                    <h4>Password Changed</h4>
                    <p class="py-2">Your password has been successfully change, you can now sigin</p>
                     <p>Thank you!</p>
                    <a href="signin.php" class="navbar-brand border border-dark me-5 px-4 py-2">Signin</a>
                  </div>
            </div>
         <?php endif;?>

         <?php if ($_GET['confirmation'] === 'banned'): ?>
          
              <?php  
                date_default_timezone_set('Asia/Manila');
                $user_id = $_GET['id'];
                $query = "SELECT * FROM ban_duration WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                   
               if (mysqli_num_rows($result) > 0) {
                    $user_id = $row['user_id'];
                    $current_hours  = date('G');
                    $current_mins = date('i');
                  
                    $ban_hours = date('G', strtotime($row['time_duration']));
                    $ban_mins = date('i', strtotime($row['time_duration']));

                    $days_left =  date('z', strtotime($row['date_duration'])) - date('z');
                    $hours_left = $ban_hours - $current_hours;
                    $mins_left = $ban_mins - $current_mins;
                    if($days_left <= 0 && $hours_left <= 0 && $mins_left <=0){
                        $query = "UPDATE user_account SET status = 'Verified' WHERE user_id = '$user_id'";
                        mysqli_query($conn, $query);
                        $query = "DELETE FROM ban_duration WHERE user_id = '$user_id'";
                        mysqli_query($conn, $query);
                    }

                 }
                       
               ?>
          <?php
              $query = "SELECT * FROM ban_duration WHERE user_id = '$user_id'";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
            ?>
          <?php if (mysqli_num_rows($result) > 0): ?>
               <div class="container-fluid h-75 d-flex justify-content-center align-items-center">
                  <div class="confirm-container p-5 bg-white border">
                    <h2 class="text-center"><i class="bi bi-exclamation-triangle-fill"></i></h2>
                    <h4 class="text-center">Your Account has been Banned</h4>
                    <p class="py-2 text-center">Your forum account has been ban, since you often violates our forum rules</p>
                    <p>Your account will be available on</p>
                    <?php
                       $current_hours  = date('G');
                       $current_mins = date('i');
                      
                       $ban_hours = date('G', strtotime($row['time_duration']));
                       $ban_mins = date('i', strtotime($row['time_duration']));
 
                       $days_left =  date('z', strtotime($row['date_duration'])) - date('z');
                       $hours_left = $ban_hours - $current_hours;
                       $mins_left = $ban_mins - $current_mins;
                    ?>
                     <div>
                         
                                
                                  <div id="timer">
                                  <h4 class="d-inline">TimeLeft</h4>
                                  <h4 class="day d-inline text-white px-1" style="background: #474747;"></h4>
                                  <h4 class="hours d-inline text-white px-1" style="background: #474747;"></h4>
                                  <h4 class="mins d-inline text-white px-1" style="background: #474747;"></h4>
                                  <h4 class="sec d-inline text-white px-1" style="background: #474747;"></h4>
                                  </div>
                                         
                            <script>
                                   // Set the date we're counting down to
                              var countDownDate = new Date("<?php echo date('M j, Y', strtotime($row['date_duration']))?> <?php echo date('H:i:s', strtotime($row['time_duration']))?>").getTime();

                                  // Update the count down every 1 second
                              var x = setInterval(function() {

                                  // Get today's date and time
                                   var now = new Date().getTime();

                                  // Find the distance between now and the count down date
                                   var distance = countDownDate - now;

                                  // Time calculations for days, hours, minutes and seconds
                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                     // Display the result in the element with id="demo"

                                    $('.day').text(days + "d");
                                    $('.hours').text(hours + "h");
                                    $('.mins').text(minutes + "m");
                                    $('.sec').text(seconds + "s")
 

                                   // If the count down is finished, write some text
                                  if (distance < 0) {
                                        clearInterval(x);
                                        document.getElementById("timer").innerHTML = `
                                        <p class="">You can now sigin</p>
                                        <a href="signin.php" class="navbar-brand border border-dark me-5 px-4 py-2">Signin</a>
                                          `;
                                   }
                         }, 1000);
</script>
                
                     </div>
                     <div>
                     </div>
                  </div>
               </div>
             <?php else:?>
              <div class="container-fluid h-75 d-flex justify-content-center align-items-center">
                  <div class="confirm-container p-5 bg-white border">
                     <h4 class="text-center">Ban duration is finished</h4>
                     <p>Your account is available now, please follow the rules to not get banned again</p>
                    <p class="">You can now sigin</p>
                    <a href="signin.php" class="navbar-brand border border-dark me-5 px-4 py-2">Signin</a>
                  </div>
              </div>
            <?php endif;?>
         <?php endif;?>
     </main>
     <?php
                                // $query = "UPDATE user_account SET status = 'Verified' WHERE user_id = '$user_id'";
                                // mysqli_query($conn, $query);
                                // $query = "DELETE FROM ban_duration WHERE user_id = '$user_id'";
                                // mysqli_query($conn, $query);
                              ?>
  <!-- Footer -->
      <footer class="bg-light text-center text-lg-start">
             <hr>
             <div id="footerText" class="text-center p-3">
                 © <?php echo date('Y')?> Copyright: Taytay Immanuel Church
              </div>
     </footer>


</body>
</html>