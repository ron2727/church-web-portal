<?php
session_start();
if (!isset($_GET['service'])) {
  header("Location: services.php");
  exit;
}
if (isset($_SESSION['appli_email'])) {
   unset($_SESSION['appli_email']);
}
use PHPMailer\PHPMailer\PHPMailer;
require 'assets/libs/phpmailer/src/Exception.php';
require 'assets/libs/phpmailer/src/PHPMailer.php';
require 'assets/libs/phpmailer/src/SMTP.php';
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
  
        if (!isset($_POST['code'])) {
          $code = rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9);
          $_SESSION['vcode'] = $code;
          $email = $_POST['email'];
           
          $mail = new PHPMailer(true);

          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
          $mail->Password = 'rkohzkddhnaqswvb';
          $mail->SMTPSecure = 'ssl';
          $mail->Port = 465;

          $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
          $mail->addAddress($email);
          $mail->isHTML(true);
          $mail->Subject = 'Verification for Service';
          $mail->Body = '
           <div style="background:#ffffff;padding:20px 50px 20px 50px">
             <div style="padding:0px; text-align: center;">
               <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
             </div>
             <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
              <br>
              <p style="color:#355C7D;">Hello!</p>
              <p style="color:#355C7D;">Thank you for the desire to avail our service, but before you proceed please enter the code below for the verification of your email</p>
              <p style="color:#355C7D;">Thank You!</p>
               <br>
              <p style="font-weight:bold;color:#355C7D;">Your verification code:</p>
       
              <div style="padding:15px 0px 15px 0px;text-align: center;background:#f2f2f2;font-weight:bold; font-size: 2.5rem;letter-spacing: 2rem;">
                         '.$code.'
               </div>
          </div>
                        ';
          $mail->send();
        }else{
           $input_code = $_POST['code'];
          if ($input_code === $_SESSION['vcode']) {
              $service = $_GET['service'];
              $_SESSION['appli_email'] = $_POST['email'];
              unset($_SESSION['vcode']);
              header("Location: service_form.php?service=$service");
              exit;
          }else{
            $error['invalid'] = '<p class="error text-center text-danger py-2" style="background:#fee2e2;">The code you have entered was incorrect</p>';
          }
        }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Request Service</title>
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
      .error{
        font-size: 15px;
        font-family: Poppins;
        border: 1px solid red;
      }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-menus navbar navbar-expand-md" style="background: #343a40;">
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
            <div class="container-fluid py-5 d-flex justify-content-center align-items-center">
                   <div id="reqCon" class="shadow rounded-3 bg-white">
                       <div id="reqFormCon" class="p-4">
                     <?php if(strtoupper($_SERVER['REQUEST_METHOD']) === 'GET'):?>    
                          
                       <form id="reqForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                           <div id="inputField">
                            <label for="email" class="py-1">Plese enter your email below to continue</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required|email" value="<?php echo $_POST['email'] ?? ''?>">
                          </div>
                          <br>
                         <div class="text-end">
                           <a href="services.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-secondary py-2" style="text-decoration: none;">
                               Cancel
                          </button>
                          </a>
                         <button id="btnSubmit" type="submit" class="btn btn-primary py-2">
                           <div id="btnSubSpin"></div> Submit
                         </button>
             
                         </div>
                     </form>
                    <?php endif;?> 
                    <?php if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'):?>    
                       <form id="reqForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                           <?php echo $error['invalid'] ?? ''?>
                           <input type="hidden" name="email" value="<?php echo $_POST['email']?>">
                          <div id="inputField">
                            <label for="email" class="py-1">We sent a code to your email <?php echo $_POST['email']?></label><br>
                           <input type="text" name="code" id="code" placeholder="Enter the code" class="form-control <?php echo $error['invalid'] ?? 0 ? 'error': '';?>" validate="required">
                          </div>
                          <br>
                         <div class="text-end">
                           <a href="services.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-secondary py-2" style="text-decoration: none;">
                               Cancel
                          </button>
                          </a>
                         <button id="btnSubmit" type="submit" class="btn btn-primary py-2">
                           <div id="btnSubSpin"></div> Submit
                         </button>
             
                         </div>
                     </form>
                    <?php endif;?> 
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
     <script>
         $(document).ready(function(){
         $('#reqForm').validin({
            // validation_tests: {
            //   'email_novalue': {
            //   'regex': /^$|^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/,
            //   'error_message': "Please input your email"
            // }
            // }
         });
        //  $('#reqForm').submit(function(e){
        //     e.preventDefault();
        //     let formData = $(this).serialize()
        //     $('#btnSubSpin').addClass('spinner-border text-light spinner-border-sm');
 
        //     setTimeout(function(){
        //       $.ajax({
        //         url: 'send_code.php',
        //         method: 'GET',
        //         data: formData,
        //         success: function(data){
        //            $('#inputField').html(data)
        //            $('#btnSubSpin').removeClass();
        //         }
        //     })
        //     }, 3000);
          
        //  })


         })
     </script>

  
</body>
</html>