<?php
require __DIR__. '/../assets/database/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
require '../assets/libs/phpmailer/src/Exception.php';
require '../assets/libs/phpmailer/src/PHPMailer.php';
require '../assets/libs/phpmailer/src/SMTP.php';

$service = $_POST['service'];
$track_num = $_POST['tracknum'];
if ($service === 'wedding') {
   
    
   if (!isset($_POST['DesWedDate']) || !isset($_POST['schedTime']) || !isset($_POST['DateOfReher']) || !isset($_POST['schedTime1'])) {
       if (!isset($_POST['DateOfReher']) || !isset($_POST['schedTime1'])) {
         $error = 'Please select your Rehersal date and time';
       }
       if (!isset($_POST['DesWedDate']) || !isset($_POST['schedTime'])) {
        $error = 'Please select your Wedding date and time';
      }
     
   }
   else {
    $groom_name =  $_POST['groom'];
    $bride_name = $_POST['bride'];
    $desired_date = $_POST['DesWedDate'];
    $sched_time = $_POST['schedTime'];
    $rehersal_date = $_POST['DateOfReher'];
    $sched_retime = $_POST['schedTime1'];
    if ($sched_time === '1012') {
        $time_from = '09:00 AM';
        $time_to = '12:00 PM';
    }
    if ($sched_time === '0103') {
        $time_from = '01:00 PM';
        $time_to = '04:00 PM';
    }
    if ($sched_retime === '1012') {
        $time_refrom = '10:00 AM';
        $time_reto = '12:00 PM';
    }
    if ($sched_retime === '0103') {
        $time_refrom = '01:00 PM';
        $time_reto = '03:00 PM';
    }

    $query = "INSERT INTO reschedule_wedding(tracking_number, wedding_date, time_from, time_to, rehersal_date, time_refrom, time_reto)
    VALUES('$track_num', '$desired_date', '$time_from', '$time_to', '$rehersal_date', '$time_refrom', '$time_reto')";
    mysqli_query($conn, $query);
    
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
    $mail->Subject = 'Rescheduling Request';
    $mail->Body = '
    <p>Service: <span style="font-weight: bold;">'.ucfirst($service).'</span></p>
    <p>Tracking Number: <span style="font-weight: bold;">'.$track_num.'</span></p>
    <p>Groom Name: <span style="font-weight: bold;">'.$groom_name.'</span></p>
    <p>Bride Name: <span style="font-weight: bold;">'.$bride_name.'</span></p>
    <br>
    <p>Requested Schedule:</p>
    <p>Date: <span style="font-weight: bold;">'.date('F d, Y',strtotime($desired_date)).'</span></p>
    <p>Time: <span style="font-weight: bold;">'.$time_from.' to '.$time_to.'</span></p>
    <p>Rehersal Date: <span style="font-weight: bold;">'.date('F d, Y',strtotime($rehersal_date)).'</span></p>
    <p>Time: <span style="font-weight: bold;">'.$time_refrom.' to '.$time_reto.'</span></p>
                  ';
    $mail->send();
    
   }    
}

if ($service === 'child') {
    if (!isset($_POST['baptismDate']) || !isset($_POST['schedTime'])) {
     
        if (!isset($_POST['baptismDate'])) {
          $error = 'You forgot to select your schedule date';
        }
        if (!isset($_POST['schedTime'])) {
          $error = 'Please select your schedule date and time';
        }
    
      
    }
    else {
     $appli_name =  $_POST['applicant'];
     $baptism_date = $_POST['baptismDate'];
     $sched_time = $_POST['schedTime'];
      if ($_POST['schedTime'] === '0910') {
        $time_from = '09:00 AM';
        $time_to = '10:00 AM';
       
      }
      if ($_POST['schedTime'] === '1011') {
        $time_from = '10:00 AM';
        $time_to = '11:00 AM';
      }
    $query = "INSERT INTO reschedule_child(tracking_number, baptism_date, time_from, time_to)
    VALUES('$track_num', '$baptism_date', '$time_from', '$time_to')";
    mysqli_query($conn, $query);
 
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
     $mail->Subject = 'Rescheduling Request';
     $mail->Body = '
     <p>Service: <span style="font-weight: bold;">'.ucfirst($service).'</span></p>
     <p>Tracking Number: <span style="font-weight: bold;">'.$track_num.'</span></p>
     <p>Applicant Name: <span style="font-weight: bold;">'.$appli_name.'</span></p>
    
     <br>
     <p>Requested Schedule:</p>
     <p>Date: <span style="font-weight: bold;">'.date('F d, Y',strtotime($baptism_date)).'</span></p>
     <p>Time: <span style="font-weight: bold;">'.$time_from.' to '.$time_to.'</span></p> 
                   ';
     $mail->send();
    
    }    
}

?>

 
 




<?php if(isset($error)):?>
  <div class="py-5 px-2">
     <h5 class="text-center text-danger py-2" style="background: #fee2e2;"><?php echo $error?></h5>
  </div>
<?php else:?>
<div class="py-5">
    <h4 class="text-center" style="font-weight: bold;">Request Schedule for <?php echo ucfirst($service)?> Sent <i class="bi bi-envelope-check-fill text-success"></i></h4>
    <h5 class="text-center">We will notify you through your email if your request has been approved</h5>
    <h5 class="text-center">Thank You!</h5>
</div>
<?php endif;?>