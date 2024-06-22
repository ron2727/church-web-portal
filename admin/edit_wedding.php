<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';
use PHPMailer\PHPMailer\PHPMailer;
require '../assets/libs/phpmailer/src/Exception.php';
require '../assets/libs/phpmailer/src/PHPMailer.php';
require '../assets/libs/phpmailer/src/SMTP.php';


if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  $email_to_notif = [
    'bride' => $_POST['brideemail'], 
    'groom' => $_POST['groomemail']];
  if (isset($_POST['submit'])) {
    if (isset($_POST['notification'])) {
      if ($_POST['status'] === 'Approved') {
        foreach ($email_to_notif as $key => $email) {
          if ($key === 'bride') {
            $name = 'Ms.'.$_POST['bridefname']. ' ' .$_POST['bridelname'];
          }else {
            $name = 'Mr.'.$_POST['groomfname']. ' ' .$_POST['groomlname'];
          }
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
          $mail->Subject = 'Wedding service is approved';
          $mail->Body = '
          <div style="background:#ffffff;padding:20px 20px 20px 20px">
             <div style="padding:0px; text-align: center;">
                <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
             </div>
             <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
             <br>
             <p style="color:#355C7D;">Good day '.$name.', </p>
             <p style="color:#355C7D;">&nbsp;&nbsp;&nbsp;&nbsp;This is from Taytay Immanuel Church, We want to congratulate you for your upcoming wedding, your request for our wedding service has been approved your schedule was on <span style="font-weight:bold;">'.date('l F d, Y', strtotime($_POST['sched_date'])).'</span> and the time is '.date('g:i A',strtotime($_POST['from'])).' to '.date('g:i A',strtotime($_POST['to'])).'
              and the date of your rehersal was on <span style="font-weight:bold;">'.date('l F d, Y', strtotime($_POST['sched_redate'])).'</span> and the time is '.date('g:i A',strtotime($_POST['refrom'])).' to '.date('g:i A',strtotime($_POST['reto'])).'
             </p>
             <p style="color:#355C7D;">Please bring your printed Application form</p>
             <p style="color:#355C7D;">You can download your Application form here:</p>
             <p>
               <a href="https://taytayimmanuelchurch.online/admin/print_form.php?attach=true&service=wedding&form_id='.$_POST['form_id'].'" style="text-decoration: none;">Click here to download your Application form</a>
             </p>
             <p style="color:#355C7D;">Thank You!</p>
             <br>
             <br>
          </div>
          ';
           $mail->send();
        }
     } 
     if ($_POST['status'] === 'Completed') {
      foreach ($email_to_notif as $key => $email) {
        if ($key === 'bride') {
          $name = 'Mrs.'.$_POST['bridefname']. ' ' .$_POST['bridelname'];
        }else {
          $name = 'Mr.'.$_POST['groomfname']. ' ' .$_POST['groomlname'];
        }
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
        $mail->Subject = 'Wedding service is complete';
        $mail->Body = '
          <div style="background:#ffffff;padding:20px 50px 20px 50px">
             <div style="padding:0px; text-align: center;">
                <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
             </div>
             <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
             <br>
             <p style="color:#355C7D;">Good day '.$name.', </p>
             <p style="color:#355C7D;">
              This is from Taytay Immanuel Church, Hope you enjoy your wedding here in our church and congratulations again
             </p>
             <p style="color:#355C7D;">Thank You!</p>
             <br>
             <br>
          </div>
          ';
        // $mail->Body = 'Good day! '.$name.' this is from taytay immanuel church, Hope you enjoy your wedding here in our church and congratulations again';
        $mail->send();
      }
     }

     if ($_POST['status'] === 'Cancelled') {
      foreach ($email_to_notif as $key => $email) {
        if ($key === 'bride') {
          $name = 'Mrs.'.$_POST['bridefname']. ' ' .$_POST['bridelname'];
        }else {
          $name = 'Mr.'.$_POST['groomfname']. ' ' .$_POST['groomlname'];
        }
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
        $mail->Subject = 'Wedding service is cancelled';
        $mail->Body = '
          <div style="background:#ffffff;padding:20px 50px 20px 50px">
             <div style="padding:0px; text-align: center;">
                <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
             </div>
             <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
             <br>
             <p style="color:#355C7D;">Good day '.$name.', </p>
             <p style="color:#355C7D;">
              This is from Taytay Immanuel Church, your request for Wedding service was got Cancelled
             </p>
             <p style="color:#355C7D;">Possible reason</p>
               <ul>
                 <li style="color:#355C7D;">Failed to comply the requirements</li>
                 <li style="color:#355C7D;">Cancellation is requested</li>
                 <li style="color:#355C7D;">Not shown at the scheduled date</li>
               </ul>
               <p style="color:#355C7D;">If you have any concerns or questions feel free to ask here just click reply</p>
               <p style="color:#355C7D;">- From Taytay Immanuel Church</p>
             <br>
             <br>
          </div>
          ';
        // $mail->Body = 'Good day! '.$name.' this is from taytay immanuel church, Hope you enjoy your wedding here in our church and congratulations again';
        $mail->send();
      }
     }
   }
   $form_id = $_POST['form_id'];
   $status = $_POST['status'];
   $bride_fname  = $_POST['bridefname'];
   $bride_lname = $_POST['bridelname'];
   $bride_Add = $_POST['brideAdd'];
   $bride_phone = $_POST['bridephone'];
   $bride_email = $_POST['brideemail'];
   $bride_DateOfBap = $_POST['brideDateOfBap'];
   $bride_DenoOfCh = $_POST['brideDenoOfCh'];
   $bride_PreChMem = $_POST['bridePreChMem'];
   $bride_PasName = $_POST['bridePasName'];
   $bride_PasPhone = $_POST['bridePasPhone'];
   $bride_Pasemail = $_POST['bridePasemail'];
   $bride_FatherName = $_POST['brideFatherName'];
   $bride_FatherPhone = $_POST['brideFatherPhone'];
   $bride_MotherName = $_POST['brideMotherName'];
   $bride_MotherPhone = $_POST['brideMotherPhone'];
   $bride_ParentAdd = $_POST['brideParentAdd'];
   $groom_fname = $_POST['groomfname'];
   $groom_lname = $_POST['groomlname'];
   $groom_Add = $_POST['groomAdd'];
   $groom_phone = $_POST['groomphone'];
   $groom_emai = $_POST['groomemail'];
   $groom_DateOfBap = $_POST['groomDateOfBap'];
   $groom_DenoOfCh = $_POST['groomDenoOfCh'];
   $groom_PreChMem = $_POST['groomPreChMem'];
   $groom_PasName = $_POST['groomPasName'];
   $groom_PasPhone = $_POST['groomPasPhone'];
   $groom_Pasemail = $_POST['groomPasemail'];
   $groom_FatherName = $_POST['groomFatherName'];
   $groom_FatherPhone = $_POST['groomFatherPhone'];
   $groom_MotherName = $_POST['groomMotherName'];
   $groom_MotherPhone = $_POST['groomMotherPhone'];
   $groom_ParentAdd = $_POST['groomParentAdd'];
   $PastorPerSer = $_POST['PastorPerSer'];
   $NumOfG = $_POST['NumOfG'];
   $MaidOfHon = $_POST['MaidOfHon'];
   $BestMan = $_POST['BestMan'];
   $Bridemaids = $_POST['Bridemaids'];
   $Groomsmen = $_POST['Groomsmen'];
   $FlowerGirl = $_POST['FlowerGirl'];
   $RingBearer = $_POST['RingBearer'];
   $Candlelighters = $_POST['Candlelighters'];
   $Pianist = $_POST['Pianist'];
   $Soloist = $_POST['Soloist'];
   $OtherMusicians = $_POST['OtherMusicians'];
   $SoundTec = $_POST['SoundTec'];
   $Photographer = $_POST['Photographer'];
   $OtherInfo = $_POST['OtherInfo'];
   
   $query = "UPDATE wedding_form SET
    status = '$status',
    bride_fname = '$bride_fname',
    bride_lname = '$bride_lname',
    bride_address = '$bride_Add',
    bride_phone = '$bride_phone',
    bride_email = '$bride_email',
    bride_date_of_bap = '$bride_DateOfBap',
    bride_deno_of_ch = '$bride_DenoOfCh',
    bride_pres_ch_mem = '$bride_PreChMem',
    bride_pastor_name = '$bride_PasName',
    bride_pastor_phone = '$bride_PasPhone',
    bride_pastor_email = '$bride_Pasemail',
    bride_f_name = '$bride_FatherName',
    bride_f_phone = '$bride_FatherPhone',
    bride_m_name = '$bride_MotherName',
    bride_m_phone = '$bride_MotherPhone',
    bride_parent_add = '$bride_ParentAdd',
    groom_fname = '$groom_fname',
    groom_lname = '$groom_lname',
    groom_address = '$groom_Add',
    groom_phone = '$groom_phone',
    groom_email = '$groom_emai',
    groom_date_of_bap = '$groom_DateOfBap',
    groom_deno_of_ch = '$groom_DenoOfCh',
    groom_pres_ch_mem = '$groom_PreChMem',
    groom_pastor_name = '$groom_PasName',
    groom_pastor_phone = '$groom_PasPhone',
    groom_pastor_email = '$groom_Pasemail',
    groom_f_name = '$groom_FatherName',
    groom_f_phone = '$groom_FatherPhone',
    groom_m_name = '$groom_MotherName',
    groom_m_phone = '$groom_MotherPhone',
    groom_parent_add = '$groom_ParentAdd',
    pastor_perform_ser = '$PastorPerSer',
    number_guests = '$NumOfG',
    maid_of_honor = '$MaidOfHon',
    best_man = '$BestMan',
    bridemaids = '$Bridemaids',
    groomen = '$Groomsmen',
    flower_girl = '$FlowerGirl',
    ring_bearear = '$RingBearer',
    ushers = '$Candlelighters',
    pianist = '$Pianist',
    soloist = '$Soloist',
    other_musicians = '$OtherMusicians',
    sound_technician = '$SoundTec',
    photographer = '$Photographer',
    other_information = '$OtherInfo'
    WHERE id = $form_id";
   mysqli_query($conn, $query);
   header('Location: wedding.php?action=edit');
   exit;
  }

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="310x310" href="../assets/img/tic_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="../assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
    <title>Services | Edit Wedding Form</title>
</head>
<style>
   ul li{
    cursor: pointer;
   }
   ul li a:hover{
    background-color: #0275d8;
   }
 
</style>

<body>
     <div class="container-fluid">
      
      <div class="row">
       <div id="sideNav" class="col-sm-2 bg-dark p-0" style="overflow-y: auto;">
            <div id="navTitle" class="border-bottom text-white p-4">
                 <h3 class="text-center">Admin</h3>
            </div>
            <!-- Menu -->
            <?php include('navigation.php')?>
            
       </div>
       <!-- Main content -->
       <div class="col-sm-10 p-0 bg-white">
           <!-- Top nav -->
              <?php 
              include('top_navigation.php')
              ?>

            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Service</li>
                    <li class="breadcrumb-item">Edit Wedding Form</li>
                  </ol>
               </div>
                   <div>
                       <div class="container-fluid p-0 border">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                           <h3>Edit Wedding Form</h3>
                         </div>
                  <?php 
                    $form_id = $_GET['form_id'];
                    $query = "SELECT * FROM wedding_form WHERE id = $form_id";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                  ?>
                         <div id="EditEventContainer" class="px-5 pt-3">
             <form name="formWedd" id="formWedd" action="edit_wedding.php" method="POST" enctype="multipart/form-data">   
               <input type="hidden" name="form_id" value="<?php echo $row['id']?>">
               <input type="hidden" name="sched_date" value="<?php echo $row['sched_date']?>">
               <input type="hidden" name="from" value="<?php echo $row['time_from']?>">
               <input type="hidden" name="to" value="<?php echo $row['time_to']?>">
               <input type="hidden" name="sched_redate" value="<?php echo $row['sched_redate']?>">
               <input type="hidden" name="refrom" value="<?php echo $row['time_refrom']?>">
               <input type="hidden" name="reto" value="<?php echo $row['time_reto']?>">
               <div id="selectStatus">
                    <label class="label-head">Status</label>
                      <select name="status" id="rdList" class="form-select" aria-label="Default select example">
                       <option value="<?php echo $row['status']?>" selected><?php echo $row['status']?></option>
                       <option value="Cancelled">Cancelled</option>
                       <option value="Pending">Pending</option>
                       <option value="Approved">Approved</option>
                       <option value="Completed">Completed</option>
                       </select>
                    </div>
                    <!-- date of schedule
                    <div id="inputDesWedDate">
                               <label for="wedding_date">Date of Schedule</label><br>
                               <input class="form-control" validate="required" type="date" name="wedding_date" id="wedding_date" value="<?php echo $row['date_of_wedding']?>"><br>
                             </div> -->
                    <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                         WEDDING APPLICATION FORM
                    </div>
                     <!-- Wedding Date
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputDesWedDate">
                               <label for="DesWedDate">Desired Wedding Date </label><br>
                               <input class="form-control" validate="required" type="date" name="DesWedDate" id="DesWedDate" value="<?php echo $row['desired_wed_date']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputDateOfReher">
                                <label for="DateOfReher">Date of Rehearsal</label><br>
                                <input class="form-control" validate="required" type="date" name="DateOfReher" id="DateOfReher" value="<?php echo $row['rehearsal_date']?>"><br>
                               </div>
                            </div>
                        </div>
                      Wedding Time
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputDesWedTime">
                               <label for="DesWedTime">Time</label><br>
                               <input class="form-control" validate="required" type="time" name="DesWedTime" id="DesWedTime" value="<?php echo $row['desired_wed_time']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputTimeOfReher">
                                <label for="TimeOfReher">Time</label><br>
                                <input class="form-control" validate="required" type="time" name="TimeOfReher" id="TimeOfReher" value="<?php echo $row['rehearsal_time']?>"><br>
                               </div>
                            </div>
                        </div> -->
                        <!-- groom's info -->
                      <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                      BRIDE INFORMATION
                      </div>
                      <!-- Name -->
                      <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridefname">
                               <label for="bridefname">Firstname</label><br>
                               <input class="form-control" validate="required" type="text" name="bridefname" id="bridefname" value="<?php echo $row['bride_fname']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbridelname">
                                <label for="bridelname">Lastname</label><br>
                                <input class="form-control" validate="required" type="text" name="bridelname" id="bridelname" value="<?php echo $row['bride_lname']?>"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div id="inputbrideAdd">
                            <label for="brideAdd">Address</label><br>
                            <textarea name="brideAdd" id="brideAdd" class="form-control"><?php echo $row['bride_address']?></textarea>
                        </div>
                         <br>
                         <!-- Bride contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridephone">
                               <label for="bridephone">Bride's Phone Number</label><br>
                               <input class="form-control" validate="required" type="text" name="bridephone" id="bridephone" value="<?php echo $row['bride_phone']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideemail">
                                <label for="brideemail">Bride's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="brideemail" id="brideemail" value="<?php echo $row['bride_email']?>"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Bride's Date of Christian Baptism -->
                        <div id="inputbrideDateOfBap">
                            <label for="brideDateOfBap">Bride's Date of Christian Baptism </label><br>
                            <input type="date" name="brideDateOfBap" id="brideDateOfBap" class="form-control" value="<?php echo $row['bride_date_of_bap']?>">
                        </div>
                         <br>
                         <!-- Bride's Denomination of Church -->
                         <div id="inputbrideDenoOfCh">
                            <label for="brideDenoOfCh">Bride's Denomination of Church</label><br>
                            <input type="text" name="brideDenoOfCh" id="brideDenoOfCh" class="form-control" value="<?php echo $row['bride_deno_of_ch']?>">
                        </div>
                        <br>
                        <!-- Bride’s Present Church Membership  -->
                        <div id="inputbridePreChMem">
                            <label for="bridePreChMem">Bride's Present Church Membership </label><br>
                            <input type="text" name="bridePreChMem" id="bridePreChMem" class="form-control" value="<?php echo $row['bride_pres_ch_mem']?>">
                        </div>
                         <br>
                         <!-- Name of Bride’s Pastor  -->
                        <div id="inputbridePasName">
                            <label for="bridePasName">Name of Bride's Pastor</label><br>
                            <input type="text" name="bridePasName" id="bridePasName" class="form-control" value="<?php echo $row['bride_pastor_name']?>">
                        </div>
                         <br>
                             <!-- Bride pastor contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridePasPhone">
                               <label for="bridePasPhone">Pastor's Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="bridePasPhone" id="bridephone" value="<?php echo $row['bride_pastor_phone']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbridePasemail">
                                <label for="bridePasemail">Pastor's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="bridePasemail" id="bridePasemail" value="<?php echo $row['bride_pastor_email']?>"><br>
                               </div>
                            </div>
                        </div>
            
                         <!-- Bride's Parent Name -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbrideFatherName">
                               <label for="brideFatherName">Bride's Father Name</label><br>
                               <input class="form-control" validate="required" type="text" name="brideFatherName" id="brideFatherName" value="<?php echo $row['bride_f_name']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideMotherName">
                                <label for="brideMotherName">Bride's Mother Name</label><br>
                                <input class="form-control" validate="required" type="text" name="brideMotherName" id="brideMotherName" value="<?php echo $row['bride_m_name']?>"><br>
                               </div>
                            </div>
                        </div>
                      <!-- Bride's Parent Contact -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbrideFatherPhone">
                               <label for="brideFatherPhone">Bride's Father Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="brideFatherPhone" id="brideFatherPhone" value="<?php echo $row['bride_f_phone']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideMotherPhone">
                                <label for="brideMotherPhone">Bride's Mother Phone</label><br>
                                <input class="form-control" validate="required" type="text" name="brideMotherPhone" id="brideMotherPhone" value="<?php echo $row['bride_m_phone']?>"><br>
                               </div>
                            </div>
                        </div>
                        <!--Bride's Parent Address -->
                        <div id="inputbrideParentAdd">
                            <label for="brideParentAdd">Bride's Parent Address</label><br>
                            <textarea name="brideParentAdd" id="brideParentAdd" class="form-control"><?php echo $row['bride_parent_add']?></textarea>
                        </div>

                      <!-- Groom's info -->
                      <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                      GROOM INFORMATION
                      </div>
                      <!-- Name -->
                      <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomfname">
                               <label for="groomfname">Firstname</label><br>
                               <input class="form-control" validate="required" type="text" name="groomfname" id="groomfname" value="<?php echo $row['groom_fname']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomlname">
                                <label for="groomlname">Surname</label><br>
                                <input class="form-control" validate="required" type="text" name="groomlname" id="groomlname" value="<?php echo $row['groom_lname']?>"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div id="inputgroomAdd">
                            <label for="groomAdd">Address</label><br>
                            <textarea name="groomAdd" id="groomAdd" class="form-control"><?php echo $row['groom_address']?></textarea>
                        </div>
                         <br>
                         <!-- groom contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomphone">
                               <label for="groomphone">Groom's Phone Number</label><br>
                               <input class="form-control" validate="required" type="text" name="groomphone" id="groomphone" value="<?php echo $row['groom_phone']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomemail">
                                <label for="groomemail">Groom's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="groomemail" id="groomemail" value="<?php echo $row['groom_email']?>"><br>
                               </div>
                            </div>
                        </div>
                        <!-- groom's Date of Christian Baptism -->
                        <div id="inputgroomDateOfBap">
                            <label for="groomDateOfBap">Groom's Date of Christian Baptism </label><br>
                            <input type="date" name="groomDateOfBap" id="groomDateOfBap" class="form-control" value="<?php echo $row['groom_date_of_bap']?>">
                        </div>
                         <br>
                         <!-- groom's Denomination of Church -->
                         <div id="inputgroomDenoOfCh">
                            <label for="groomDenoOfCh">Groom's Denomination of Church</label><br>
                            <input type="text" name="groomDenoOfCh" id="groomDenoOfCh" class="form-control" value="<?php echo $row['groom_deno_of_ch']?>">
                        </div>
                        <br>
                        <!-- groom’s Present Church Membership  -->
                        <div id="inputgroomPreChMem">
                            <label for="groomPreChMem">Groom's Present Church Membership </label><br>
                            <input type="text" name="groomPreChMem" id="groomPreChMem" class="form-control" value="<?php echo $row['groom_pres_ch_mem']?>">
                        </div>
                         <br>
                         <!-- Name of groom’s Pastor  -->
                        <div id="inputgroomPasName">
                            <label for="groomPasName">Name of Groom's Pastor</label><br>
                            <input type="text" name="groomPasName" id="groomPasName" class="form-control" value="<?php echo $row['groom_pastor_name']?>">
                        </div>
                         <br>
                             <!-- groom pastor contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomPasPhone">
                               <label for="groomPasPhone">Pastor's Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="groomPasPhone" id="groomphone" value="<?php echo $row['groom_pastor_phone']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomPasemail">
                                <label for="groomPasemail">Pastor's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="groomPasemail" id="groomPasemail" value="<?php echo $row['groom_pastor_email']?>"><br>
                               </div>
                            </div>
                        </div>
                         <!-- groom's Parent Name -->
                         <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomFatherName">
                               <label for="groomFatherName">Groom's Father Name</label><br>
                               <input class="form-control" validate="required" type="text" name="groomFatherName" id="groomFatherName" value="<?php echo $row['groom_f_name']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomMotherName">
                                <label for="groomMotherName">Groom's Mother Name</label><br>
                                <input class="form-control" validate="required" type="text" name="groomMotherName" id="groomMotherName" value="<?php echo $row['groom_m_name']?>"><br>
                               </div>
                            </div>
                        </div>
                      <!-- Groom's Parent Contact -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomFatherPhone">
                               <label for="groomFatherPhone">Groom's Father Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="groomFatherPhone" id="groomFatherPhone" value="<?php echo $row['groom_f_phone']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomMotherPhone">
                                <label for="groomMotherPhone">Groom's Mother Phone</label><br>
                                <input class="form-control" validate="required" type="text" name="groomMotherPhone" id="groomMotherPhone" value="<?php echo $row['groom_m_phone']?>"><br>
                               </div>
                            </div>
                        </div>
                        <!--Groom's Parent Address -->
                        <div id="inputgroomParentAdd">
                            <label for="groomParentAdd">Groom's Parent Address</label><br>
                            <textarea name="groomParentAdd" id="groomParentAdd" class="form-control"><?php echo $row['groom_parent_add']?></textarea>
                        </div>
                          <!-- WEDDING CEREMONY INFORMATION info -->
                      <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                        WEDDING CEREMONY INFORMATION
                      </div>
                           <!-- Pastor Performing Service  -->
                         <div id="inputPastorPerSer">
                            <label for="PastorPerSer">Pastor Performing Service</label><br>
                            <input type="text" name="PastorPerSer" id="PastorPerSer" class="form-control" value="<?php echo $row['pastor_perform_ser']?>">
                         </div>
                          <br>
                         <!-- Pastor Performing Service  -->
                         <div id="inputNumOfG">
                            <label for="NumOfG">Number of Guests</label><br>
                            <input type="text" name="NumOfG" id="NumOfG" class="form-control" value="<?php echo $row['number_guests']?>">
                         </div>
                          <br>
                           <!-- Maid of Honor  -->
                         <div id="inputMaidOfHon">
                            <label for="MaidOfHon">Maid of Honor</label><br>
                            <input type="text" name="MaidOfHon" id="MaidOfHon" class="form-control" value="<?php echo $row['maid_of_honor']?>">
                         </div>
                          <br>
                         <!-- Best Man  -->
                         <div id="inputBestMan">
                            <label for="BestMan">Best Man</label><br>
                            <input type="text" name="BestMan" id="BestMan" class="form-control" value="<?php echo $row['best_man']?>">
                         </div>
                          <br>
                         <!-- Bridemaids  -->
                         <div id="inputBridemaids">
                            <label for="Bridemaids">Bridemaids</label><br>
                            <textarea name="Bridemaids" id="Bridemaids" class="form-control"><?php echo $row['bridemaids']?></textarea>
                         </div>
                         <br>
                        <!-- Groomsmen  -->
                        <div id="inputGroomsmen">
                            <label for="Groomsmen">Groomsmen</label><br>
                            <textarea name="Groomsmen" id="Groomsmen" class="form-control"><?php echo $row['groomen']?></textarea>
                         </div>
                         <br>
                         <!-- Flower Girl and RingBearer -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputFlowerGirl">
                               <label for="FlowerGirl">Flower Girl</label><br>
                               <input class="form-control" validate="required" type="text" name="FlowerGirl" id="FlowerGirl" value="<?php echo $row['flower_girl']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputRingBearer">
                                <label for="RingBearer">RingBearer</label><br>
                                <input class="form-control" validate="required" type="text" name="RingBearer" id="RingBearer" value="<?php echo $row['ring_bearear']?>"><br>
                               </div>
                            </div>
                        </div>
                         <!-- Candlelighters  -->
                         <div id="inputCandlelighters">
                            <label for="Candlelighters">Ushers/Candlelighters</label><br>
                            <textarea name="Candlelighters" id="Candlelighters" class="form-control"><?php echo $row['ushers']?></textarea>
                         </div>
                         <br>
                         <!-- Pianist  -->
                         <div id="inputPianist">
                                <label for="Pianist">Pianist</label><br>
                                <input class="form-control" validate="required" type="text" name="Pianist" id="Pianist" value="<?php echo $row['pianist']?>"><br>
                            </div>
                         <!-- Soloist  -->
                         <div id="inputSoloist">
                                <label for="Soloist">Soloist(s)</label><br>
                                <input class="form-control" validate="required" type="text" name="Soloist" id="Soloist" value="<?php echo $row['soloist']?>"><br>
                            </div>
                        <!-- Other Musicians  -->
                         <div id="inputOtherMusicians">
                                <label for="OtherMusicians">Other Musicians</label><br>
                                <input class="form-control" validate="required" type="text" name="OtherMusicians" id="OtherMusicians" value="<?php echo $row['other_musicians']?>"><br>
                            </div>
                          <!-- Sound Technician  -->
                         <div id="inputSoundTec">
                                <label for="SoundTec">Sound Technician</label><br>
                                <input class="form-control" validate="required" type="text" name="SoundTec" id="SoundTec" value="<?php echo $row['sound_technician']?>"><br>
                            </div>
                              <!-- Photographer  -->
                         <div id="inputPhotographer">
                                <label for="Photographer">Photographer</label><br>
                                <input class="form-control" validate="required" type="text" name="Photographer" id="Photographer" value="<?php echo $row['photographer']?>"><br>
                            </div>
                       <!-- OTHER INFORMATION  -->
                         <div id="inputOtherInfo">
                            <label for="OtherInfo">OTHER INFORMATION</label><br>
                            <textarea name="OtherInfo" id="OtherInfo" class="form-control"><?php echo $row['other_information']?></textarea>
                         </div>
                     <!-- End End End End End End End -->
                        <hr>
                         <div class="form-check">
                            <input class="form-check-input" name="notification" type="checkbox" value="email" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                               Notify Applicant about the status of their request
                            </label>
                          </div>
 
                        <div class="container-fluid my-5">
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Form">      
                              <a href="wedding.php"><button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button></a>
                            </div>
                    </form>
 
                         </div>
                       </div>
                   </div>

                   
            </div>
       </div>
        
       </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>s
     <script type="text/javascript">
          $(document).ready(function(){
            $('#formWeddForm').validin({
                required_fields_initial_error_message: "",
                form_error_message: "",
              });
             //  $('.events-menus').removeClass('collapse')
            //   if (eventStatus == 'upcoming') {
            //    $('.upcoming-link').addClass('rounded-3 bg-primary')
            //   }else{
            //    $('.past-link').addClass('rounded-3 bg-primary')
            //   }
          
          })
     </script>

</body>
     
</html>
