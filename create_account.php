<?php
require __DIR__ .'/assets/database/connection.php';
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
 


if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
       $user_id = uniqid();
       $email = $_POST['email'];
       $password = $_POST['password'];
       $firstname = $_POST['firstname'];
       $lastname = $_POST['lastname'];
       $ministry = $_POST['ministry'];

       $image_tmpname = $_FILES['certificate']['tmp_name'];
       $img_name = $_FILES['certificate']['name'];
       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
       $image_new_name = uniqid("CERBAP-IMG", false). '.' .$img_ex;
       $image_upload_path = 'assets/uploaded_images/certificate_baptism/' .$image_new_name;
       move_uploaded_file($image_tmpname, $image_upload_path);
       $query = "INSERT INTO user_account(user_id, email, password, firstname, lastname, ministry, certificate_baptism)
               VALUES('$user_id', '$email', '$password', '$firstname', '$lastname', '$ministry', '$image_new_name')";
       mysqli_query($conn, $query);
       unset($_SESSION['email']);        
       header("Location: confirmation.php?confirmation=signup");
       exit;
 
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
      .validation{
        margin: .4em 0 1em;
	      color: red;
      	font-size: 1em;
        font-family: 'Roboto', sans-serif;
      }
     
      .nav-menus div a:nth-child(2){
        padding: 3px 15px 3px 15px;
       }
       .message-text{
        margin-bottom: 10px;
       }
      @media only screen and (max-width: 765px) {
        .nav-menus div{
        padding: 0px 10px 0px 10px;
       }
       .nav-menus div a{
        font-size: 0.6rem;
       }
       .message-text{
        font-size: 0.7rem;
       }
       label{
        font-size: 0.7rem;
       }
       input[type=text], input[type=password], input[type=file],#btnSubmit{
        height: 30px;
        font-size: 10px;
       }
       select{
        height: 30px;
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
            <a href="signup.php" class="navbar-brand border border-white text-light">Sign Up</a>
        </div>
      </nav>

     <main>
            <div class="container-fluid py-5 d-flex justify-content-center align-items-center">
                   <div id="forgotPassCon" class="shadow rounded-3 bg-white">
                       <div id="forgotFormCon" class="p-4">
                       <form id="signupForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                       <div class="message-text">
                            <span style="font-weight: bold;">Note:</span>
                            After you registered, your account will be temporary unavailable, we will verified your account first if you are a member or contact us taytayemmanuelchurchportal@gmail.com
                        </div>
                          <div id="inputField">
                            <label for="email">Email</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control" validate="required|email" value="<?php echo $_SESSION['email']?>" readonly>
                           <small></small>
                          </div>
                          <br>
                          <div id="inputField">
                            <label for="firstName">Firstname</label><br>
                           <input type="text" name="firstname" id="fname" placeholder="Enter your Firstname" class="form-control" validate="required">
                           <small></small>
                          </div>
                          <br>
                          <div id="inputField">
                            <label for="lastName">Lastname</label><br>
                           <input type="text" name="lastname" id="lname" placeholder="Enter your Lastname" class="form-control" validate="required">
                           <small></small>
                          </div>
                          <br>
                            <div id="select_ministry">
                              <label>Church Ministry / Group</label>
                               <select name="ministry" type="text" id="minList" class="form-select" aria-label="Default select example">
                                <optgroup>
                                  <option selected>Select Ministry/Group...</option>
                                   <option value="Youth">Youth</option>
                                  <option value="Adult">Adult</option>
                                  <option value="Music Team">Music Team</option>
                                <optgroup>
                               </select>
                             </div>
                          <br>
                          <div id="inputField">
                            <label for="password">Password</label><br>
                            <input type="password" name="password" id="password" placeholder="Enter your Password" class="must_match form-control" validate="required|min_length:8">
                            <small></small>
                          </div>
                          <br>
                          <div id="inputField">
                            <label for="confirm">Confirm Password</label><br>
                            <input type="password" name="confirm" id="confirm" placeholder="Enter your Password" class="form-control" validate="match:.must_match">
                            <small></small>
                          </div>
                          <br>
                          <div id="inputImage">
                            <label for="image">Certicate of baptism 
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right"
                             title="We need your certificate of your baptism from Taytay Immanuel Church to verify if you are a member of the church"></i>
                            </label>
                            <input type="file" name="certificate" id="certificate" class="form-control" accept="image/*" required>
                          </div>
                          <br>
                         <button id="btnSubmit" type="submit" class="btn btn-primary form-control py-2">
                            Create an account
                         </button>
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
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})     

      $(document).ready(function(){
        $('#signupForm').validin({
             custom_tests: {
              'match': {
		              	'regex': null,
			              'error_message': "This not match to your password"
	            	},
                'alpha': {
		               	'regex': /[a-zA-Z]*/,
		              	'error_message': "Please enter letters only"
	            	}
             }
         });
     
      })
    </script>
</body>
</html>