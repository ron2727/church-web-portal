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
          $error = 'Please select Rehersal date and time';
        }
        if (!isset($_POST['DesWedDate']) || !isset($_POST['schedTime'])) {
         $error = 'Please select Wedding date and time';
       }
      
    }
    else {
        $email_to_notif = [
            'bride' => $_POST['groom_email'], 
            'groom' => $_POST['bride_email']
        ];
     $desired_date = $_POST['DesWedDate'];
     $sched_time = $_POST['schedTime'];
     $rehersal_date = $_POST['DateOfReher'];
     $sched_retime = $_POST['schedTime1'];
     if ($sched_time === '1012') {
        $time_from = '09:00';
        $time_to = '12:00';
     }
     if ($sched_time === '0103') {
        $time_from = '13:00';
        $time_to = '16:00';
     }
     if ($sched_retime === '1012') {
        $time_refrom = '10:00';
        $time_reto = '12:00';
     }
     if ($sched_retime === '0103') {
        $time_refrom = '13:00';
        $time_reto = '15:00';
     }
     if (isset($_POST['requested'])) {
        $query = "UPDATE reschedule_wedding SET status = 'approved' WHERE tracking_number = '$track_num'";
        mysqli_query($conn, $query);
     }
     $query = "UPDATE wedding_form SET sched_date = '$desired_date', time_from = '$time_from', time_to = '$time_to', sched_redate = '$rehersal_date', time_refrom = '$time_refrom', time_reto = '$time_reto'
               WHERE tracking_number = '$track_num'";
     mysqli_query($conn, $query);
     
     foreach($email_to_notif as $key => $email){
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
     $mail->Subject = 'Rescheduling Request';
     $mail->Body = '
           <div style="background:#ffffff;padding:20px 20px 20px 20px">
             <div style="padding:0px; text-align: center;">
                <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
             </div>
             <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
             <br>
             <p style="color:#355C7D;">Good day </p>
             <p style="color:#355C7D;">
                Your Wedding schedule from Taytay Immanuel Church has been updated, your tracking number here '.$track_num.'
             </p>
             
             <p style="color:#355C7D;">You can check your updated schedule here:</p>
              <div>
                 <a href="https://taytayimmanuelchurch.online/track.php" style="text-decoration:none;padding:10px 20px 10px 20px;font-weight:bold;background:#0275d8;color:#ffffff;">
                   Track Request
                 </a>
              </div>
             <p style="color:#355C7D;">Thank You!</p>
             <br>
             <br>
          </div>
                   ';
         
     $mail->send();
    }
  }
}



if ($service === 'child') {
    if (!isset($_POST['baptismDate']) || !isset($_POST['schedTime'])) {
     
        if (!isset($_POST['baptismDate'])) {
          $error = 'You forgot to select schedule date';
        }
        if (!isset($_POST['schedTime'])) {
          $error = 'Please select schedule date and time';
        }
    
      
    }
    else {
     $email_to_notif = $_POST['appli_email'];
     $baptism_date = $_POST['baptismDate'];
     $sched_time = $_POST['schedTime'];
    
      if ($sched_time === '0910') {
           $time_from = '09:00';
           $time_to = '10:00';;
      }
      if ($sched_time === '1011') {
           $time_from = '10:00';
           $time_to = '11:00';
      }
     if (isset($_POST['requested'])) {
        $query = "UPDATE reschedule_child SET status = 'approved' WHERE tracking_number = '$track_num'";
        mysqli_query($conn, $query);
     }
     $query = "UPDATE baptism_form SET sched_date = '$baptism_date', time_from = '$time_from', time_to = '$time_to'
               WHERE tracking_number = '$track_num'";
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
     $mail->addAddress($email_to_notif);
     $mail->isHTML(true);
     $mail->Subject = 'Rescheduling Request';
     $mail->Body = '
           <div style="background:#ffffff;padding:20px 20px 20px 20px">
             <div style="padding:0px; text-align: center;">
                <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
             </div>
             <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
             <br>
             <p style="color:#355C7D;">Good day </p>
             <p style="color:#355C7D;">
                Your Child Dedication schedule from Taytay Immanuel Church has been updated, your tracking number here '.$track_num.'
             </p>
             
             <p style="color:#355C7D;">You can check your updated schedule here:</p>
              <div>
                 <a href="https://taytayimmanuelchurch.online/track.php" style="text-decoration:none;padding:10px 20px 10px 20px;font-weight:bold;background:#0275d8;color:#ffffff;">
                   Track Request
                 </a>
              </div>
             <p style="color:#355C7D;">Thank You!</p>
             <br>
             <br>
          </div>
                   ';
         
     $mail->send();
    
  }
}
?>


<?php if(isset($error)):?>
  <div class="py-5 px-2">
      <h1 class="text-center"><i class="bi bi-x-octagon-fill text-danger"></i></h1>
     <h5 class="text-center text-danger py-2" style="background: #fee2e2;"><?php echo $error?></h5>
  </div>
<?php else:?>
<div class="py-5">
    <h4 class="text-center" style="font-weight: bold; font-size: 3rem"><i class="bi bi-check-circle-fill text-success"></i></h4>
    <h5 class="text-center">Schedule has been successfully updated</h5>
 
</div>
<?php endif;?>