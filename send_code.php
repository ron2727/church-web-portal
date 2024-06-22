<?php
// session_start();
// use PHPMailer\PHPMailer\PHPMailer;
// require 'assets/libs/phpmailer/src/Exception.php';
// require 'assets/libs/phpmailer/src/PHPMailer.php';
// require 'assets/libs/phpmailer/src/SMTP.php';
$code = rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9);
// $_SESSION['service_code'] = $code;
// if (isset($_POST['submit'])) {
//     $mail = new PHPMailer(true);

//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
//     $mail->Password = 'rkohzkddhnaqswvb';
//     $mail->SMTPSecure = 'ssl';
//     $mail->Port = 465;

//     $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
//     $mail->addAddress($_POST['email']);
//     $mail->isHTML(true);
//     $mail->Subject = 'Verification Code';
//     $mail->Body = 'service'.$code;
//     $mail->send();
//     header("Location: services.php");
//     exit;
// }
?>
                     <!-- <form id="reqForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST"> -->
                           <p>The code is <?php echo $code?></p>
                          <div id="inputField">
                            <label for="email" class="py-1">We send a code to your email <?php echo $_GET['email']?></label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required|email" value="<?php echo $_POST['email'] ?? ''?>">
                          </div>
                          <!-- <div class="text-end">
                           <a href="signin.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-secondary py-2" style="text-decoration: none;">
                               Cancel
                          </button>
                          </a>
                         <button id="btnSubmit" type="submit" class="btn btn-primary py-2">
                           <div id="btnSubSpin"></div> Submit
                         </button>
             
                         </div>
                     </form> -->