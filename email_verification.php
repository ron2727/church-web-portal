<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
 
if (!isset($_SESSION['email']) || !isset($_SESSION['vcode'])) {
    header("Location: signup.php");
    exit;
}
if (!isset($_SESSION['vcode'])) {
   header("Location: signup.php");
  exit;
}
   
 
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        $code= $_POST['code'];
        if($_SESSION['vcode'] === $code){
            unset($_SESSION['vcode']);
            header("Location: create_account.php");
            exit;
        }else{
          $errors['invalid'] = '<p class="error text-center text-danger py-2" style="background:#fee2e2;">Invalid Code</p>';
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
  

      @media only screen and (max-width: 765px) {
        .nav-menus div{
        padding: 0px 10px 0px 10px;
       }
       .nav-menus div a{
        font-size: 0.6rem;
       }
       .nav-title{
        display: none;
       }
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
     <!-- <nav class="navbar navbar-expand-md bg-dark" >
        <div class="container-fluid d-flex justify-content-between p-3">
            <a class="navbar-brand text-light">Taytay Immanuel Church</a>
            <a href="signup.php" class="navbar-brand border border-white text-light me-5 px-4">Sign Up</a>
        
        </div>
      </nav> -->

     <main>
            <div class="container-fluid py-5 d-flex justify-content-center align-items-center">
                   <div id="forgotPassCon" class="shadow rounded-3 bg-white">
                      <h4 class="p-3" style="border-bottom: 1px solid grey;">Email Verification</h4>
                       <div id="forgotFormCon" class="p-4">
                       <?php echo $errors['invalid'] ?? ''?> <!-- error if account does not exist -->
                      <form id="forgotForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                           <div id="inputField">
                            <label for="code" class="py-1">Please enter the code we sent to your email <?php echo $_SESSION['email']?></label><br>
                           <input type="text" name="code" id="code" placeholder="Enter the code" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required" value="<?php echo $_POST['email'] ?? ''?>">
                          </div>
                          <br>
                         <div class="text-end">
                  
                           <a href="signup.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-secondary py-2" style="text-decoration: none;">
                               Cancel
                          </button>
                          </a>
                         <button id="btnSubmit" type="submit" class="btn btn-primary py-2">
                           <div id="btnSubSpin"></div> Verify
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
        //     $
           
        //  })


         })
     </script>
</body>
</html>