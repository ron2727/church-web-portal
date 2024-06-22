<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
$errors = array();
if (isset($_SESSION['user_id'])) {
  header("Location: forum.php");
  exit; 
}
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
       $email = $_POST['email'];
       $password = $_POST['password'];
       $sql = "SELECT * FROM user_account where email = '$email' AND password = '$password'";
       $result = mysqli_query($conn, $sql);
       $row = mysqli_fetch_assoc($result);
      //  if (!$result) {
      //     mysqli_error($conn);
      //  }
       if(mysqli_num_rows($result) > 0){
          if ($row['status'] === 'Pending') {
            header("Location: confirmation.php?confirmation=signup");
            exit;
          }elseif ($row['status'] === 'Banned') {
            header('Location: confirmation.php?confirmation=banned&id='.$row['user_id'].'');
            exit;
          }
           else {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['role'];
              
             if ($_SESSION['user_role'] === 'Admin') {
             header("Location: admin/index.php");
             exit;
            }
            header("Location: index.php");
             exit;
          }
        
       }else{
         $errors['invalid'] = '<p class="error text-center text-danger py-2" style="background:#fee2e2;">Please check your email and password and try again </p>';
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
    <title>Signin</title>
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
      .success{
        font-size: 15px;
        font-family: Poppins;
        border: 1px solid green;
      }
 
      .nav-menus{
        padding: 20px 30px 20px 30px;
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
       #loginImg{
        padding: 20px 40px 20px 40px;
       }
       #loginImg h4{
         font-size: 1.5rem;
       }
       #loginImg h5{
         font-size: 1.1rem;
       }
        label{
        font-size: 0.8rem;
       }
       input[type=text], input[type=password]{
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
            <div class="main-con container mt-5">
                 <div class="row">
                    <div id="loginImg" class="col-md-7">
                        <h4 id="signinText" class="display-5">Sign In to Forums</h4>
                        <h5 id="signinText1">
                            The Christian experience, from start to finish, is a journey of faith.
                        </h5>
                    </div>

                    <div class="sigin-con col-md-5 shadow rounded-3 bg-white">
                       <?php echo $errors['invalid'] ?? ''?> <!-- error if account does not exist -->
                     <form class="signin-form" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                          <div id="inputEmail">
                            <label for="email">Email</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required|email" value="<?php echo $_POST['email'] ?? ''?>">
                           
                          </div>
                          <br>
                          <div id="inputPassword">
                            <label for="password">Password</label><br>
                            <input type="password" name="password" id="password" placeholder="Enter your Password" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required">
                          </div>
                          <div id="forgotLink" class="d-flex justify-content-end">
                            <a href="forgotpassword.php" class="nav-link text-primary">Forgot password?</a>
                          </div>
                          <br>
                         <button id="btnSubmit" type="submit" class="btn btn-primary form-control py-2">
                            Sign In
                         </button>
                     </form>
                        <span class="signup-link">Don't have an account? <a href="signup.php" style="text-decoration: none;">Sign Up</a></span>
                    </div>
                </div>             
             </div>
     </main>
  
  <!-- Footer -->
      <!-- <footer class="bg-light text-center text-lg-start">
             <hr>
             <div id="footerText" class="text-center p-3">
                 © <?php echo date('Y')?> Copyright: Taytay Immanuel Church
              </div>
     </footer> -->

     <script src="assets/js/validin.js"></script>
     <script>
         $(document).ready(function(){
         $('.signin-form').validin({
            // validation_tests: {
            //   'email_novalue': {
            //   'regex': /^$|^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/,
            //   'error_message': "Please input your email"
            // }
            // }
         });
       


         })
     </script>
</body>
</html>