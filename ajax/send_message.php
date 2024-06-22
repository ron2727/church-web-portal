<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../assets/libs/phpmailer/src/Exception.php';
require '../assets/libs/phpmailer/src/PHPMailer.php';
require '../assets/libs/phpmailer/src/SMTP.php';

$email = $_POST['email'];
$name = $_POST['name'];
$message = $_POST['message'];

      $mail = new PHPMailer(true);

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
      $mail->Password = 'rkohzkddhnaqswvb';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;
      $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
      $mail->addAddress('taytayimmanuelchurchportal@gmail.com');
      $mail->isHTML(true);
      $mail->Subject = 'Message';
      $mail->Body = '
      <p><span style="font-weight: bold;">Name: </span>'.$name.'</p>
      <p><span style="font-weight: bold;">Email: </span>'.$email.'</p>
      <br>
      <p>Message:</p>
      <p>'.$message.'</p>
                    ';
      $mail->send();

?>


            <div>
              <h5>Message Sent <i class="bi bi-envelope-check-fill text-success"></i></h5>
              <h5>Thank You!</h5>
            </div>