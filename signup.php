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

if (isset($_SESSION['email']) || isset($_SESSION['vcode'])) {
    unset($_SESSION['email']);
    unset($_SESSION['vcode']);
}
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    
       $email = $_POST['email'];
       $sql = "SELECT * FROM user_account where email = '$email'";
       $result = mysqli_query($conn, $sql);
        if(!$row = mysqli_fetch_assoc($result)){
            $code = rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
            $_SESSION['vcode'] = $code;
            $_SESSION['email'] = $email;

         
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
            $mail->Subject = 'Email Verification';
            $mail->Body = "Verification Code is <span style='font-size: 20px; font-weight:bold;'>$code</span>";
            $mail->send();
          
            header("Location: email_verification.php");
            exit;
        }else{
          $errors['invalid'] = '<p class="error text-center text-danger py-2" style="background:#fee2e2;">This email is already taken</p>';
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
    <title>Sign Up</title>
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
 
      .nav-menus a:nth-child(2){
        padding: 3px 15px 3px 15px;
       }
       .sigin-con{
        padding: 30px 40px 30px 40px;
       }
      @media only screen and (max-width: 765px) {
        .nav-menus{
        padding: 0px 10px 0px 10px;
       }
       .nav-menus a{
        font-size: 0.6rem;
       }
       .sigin-con{
        padding: 10px 20px 10px 20px;
       }
       label{
        font-size: 0.8rem;
       }
       input{
        height: 35px;
        font-size: 0.8rem;
       }
       #forgotLink{
        font-size: 0.8rem;
       }
       #btnSubmit{
        height: 35px;
        font-size: 0.8rem;
       }
       .signup-link{
        font-size: 0.8rem;
       }
       .nav-title{
        display: none;
       }
      }
    </style>
</head>
<body>
    <!-- Navigation -->
     <nav class="navbar navbar-expand-md" style="background: #343a40;">
        <div class="nav-menus container-fluid d-flex justify-content-between">
            <div class="navbar-brand text-light">
              <a href="index.php" class="navbar-brand text-white">
               <img src="assets/img/tic_logo.png" alt="logo" style="width: 60px; height: 60px; border-radius: 50%">
               <span class="nav-title">Taytay Immanuel Church</span>
              </a>
            </div>
            <a href="signup.php" class="navbar-brand border border-white text-light">Sign Up</a>
        </div>
      </nav>
      <main>
            <div class="container mt-5">
                <div class="row">
                    <div id="loginImg" class="col-md-7">
                        <h4 id="signinText" class="display-5">Create your Account</h4>
                        <h5 id="signinText1" class="p-5">
                        Welcome to Taytay Immanuel Church Group
                        </h5>
                    </div>

                    <div class="sigin-con col-md-5 border bg-white">
                    <?php echo $errors['invalid'] ?? ''?>
                    <div class="px-3 pb-4 text-center">  
                           <h3>Sign Up</h3>
                         </div>
                        <form id="forgotForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                          <div id="inputEmail">
                            <label for="email">Email</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required|email" value="<?php echo $_POST['email'] ?? ''?>">
                          </div>
                          <br>
                       
                         
                         <button id="btnSubmit" type="submit" class="btn btn-primary form-control">
                           <div id="btnSubSpin"></div> Submit
                         </button>
                         <br>
                         <br>
                          <span class="signup-link">Already have an account? <a href="signin.php" style="text-decoration: none;">Sign In</a></span>
                        
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