<?php
require __DIR__ .'/assets/database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;
require 'assets/libs/phpmailer/src/Exception.php';
require 'assets/libs/phpmailer/src/PHPMailer.php';
require 'assets/libs/phpmailer/src/SMTP.php';
session_start();
$errors = array();
if(isset($_SESSION['admin_id']) || isset($_SESSION['user_id']) ){
   if(isset($_SESSION['admin_id'])){
    header("Location: admin/index.php");
    exit;
   }
   if(isset($_SESSION['user_id'])){
    header("Location: forum.php");
    exit;
   }
}
if(isset($_SESSION['vcode']) || isset($_SESSION['vuser_id'])){
    unset($_SESSION['vcode']);
    unset($_SESSION['vuser_id']);
  }
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    if(isset($_SESSION['vcode']) && $_SESSION['vuser_id']){
        unset($_SESSION['vcode']);
        unset($_SESSION['vuser_id']);
      }
       $email = $_POST['email'];
        $sql = "SELECT * FROM user_account where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
            $code = rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
            $_SESSION['vcode'] = $code;
            $_SESSION['vuser_id'] = $row['user_id'];
            
         
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
            $mail->Password = 'xjthcdxrvlmxchki';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Forgot Password';
            $mail->Body = '
            <div style="background:#ffffff;padding:20px 50px 20px 50px">
            <div style="padding:0px; text-align: center;">
              <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
            </div>
            <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
             <br>
              <p style="color:#355C7D;">Hello, to forgot your password please enter the verification of your email</p>
               <br>
             <p style="font-weight:bold;color:#355C7D;">Your verification code:</p>
      
             <div style="padding:15px 0px 15px 0px;text-align: center;background:#f2f2f2;font-weight:bold; font-size: 2.5rem;letter-spacing: 2rem;">
                        '.$code.'
              </div>
         </div>
                ';
            $mail->send();
          
            header("Location: verify.php");
            exit;
        }else{
          $errors['invalid'] = '<p class="error text-center text-danger py-2" style="background:#fee2e2;">The email that you have entered does not exist</p>';
        }
      

}
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {

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
    <title>Forgot Password</title>
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
     <!-- Navigation -->
     <nav class="navbar navbar-expand-md" style="background: #343a40;">
        <div class="nav-menus container-fluid d-flex justify-content-between">
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
                   <div id="forgotPassCon" class="shadow rounded-3 bg-white">
                      <h4 class="p-3" style="border-bottom: 1px solid grey;">Forgot password</h4>
                      <div id="forgotFormCon" class="p-4">
                      <?php echo $errors['invalid'] ?? ''?> <!-- error if account does not exist -->
                      <form id="forgotForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                          <div id="inputField">
                            <label for="email" class="py-1">To forgot your password please enter you email below</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required|email" value="<?php echo $_POST['email'] ?? ''?>">
                          </div>
                          <br>
                         <div class="text-end">
                  
                           <a href="signin.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-secondary py-2" style="text-decoration: none;">
                               Cancel
                          </button>
                          </a>
                         <button id="btnSubmit" type="submit" class="btn btn-primary py-2">
                           <div id="btnSubSpin"></div> Submit
                         </button>
             
                         </div>
                     </form>
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
         $('#forgotForm').validin({
            // validation_tests: {
            //   'email_novalue': {
            //   'regex': /^$|^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/,
            //   'error_message': "Please input your email"
            // }
            // }
         });
        //  $('#forgotForm').submit(function(e){
        //     e.preventDefault();
        //     $('#btnSubSpin').addClass('spinner-border text-light spinner-border-sm');
        //     $.ajax({
        //         url: 'check_email.php',
        //         method: 'POST',
        //         data: $(this).serialize(),
        //         success: function(data){
        //            $('#forgotFormCon').html(data)
        //            $('#btnSubSpin').removeClass();
        //         }
        //     })
        //  })


         })
     </script>
</body>
</html>