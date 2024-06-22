<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';
use PHPMailer\PHPMailer\PHPMailer;
require '../assets/libs/phpmailer/src/Exception.php';
require '../assets/libs/phpmailer/src/PHPMailer.php';
require '../assets/libs/phpmailer/src/SMTP.php';

   

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  if (isset($_POST['submit'])) {
   if (isset($_POST['notification'])) {
    date_default_timezone_set('Asia/Manila');
       $date = date('G');
        if ($date >= 1 && $date <= 11) {
           $date = 'Good Morning';
        }
        if ($date >= 12 && $date <= 17) {
           $date = 'Good Afternoon';
        }
        if ($date >= 18 && $date <= 23) {
            $date = 'Good Evening';
        }

     if ($_POST['status'] === 'Approved') {
      $mail = new PHPMailer(true);

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
      $mail->Password = 'xjthcdxrvlmxchki';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;
      $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
      $mail->addAddress($_POST['Applicantemail']);
      $mail->isHTML(true);
      $mail->Subject = 'Schedule of Funeral';
      $mail->Body = '
      <div style="background:#ffffff;padding:20px 50px 20px 50px">
        <div style="padding:0px; text-align: center;">
          <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
       </div>
       <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
       <br>
       <p style="color:#355C7D;">Good day '.$_POST['Applicantfirstname'].' '.$_POST['Applicantlastname'].', </p>
       <p style="color:#355C7D;">This is from Taytay Immanuel Church,  your request for Funeral service of our church has been approve the schedule was on <span style="font-weight:bold;">'.date('l F d, Y', strtotime($_POST['sched_date'])).'</span> and the time is '.date('g:i A',strtotime($_POST['from'])).' to '.date('g:i A',strtotime($_POST['to'])).'</p>
       <p style="color:#355C7D;">Please bring your printed Application form</p>
       <p style="color:#355C7D;">You can download your Application form here:</p>
        <p>
           <a href="https://taytayimmanuelchurch.online/admin/print_form.php?attach=true&service=funeral&form_id='.$_POST['form_id'].'" style="text-decoration: none;">Click here to download your Application form</a>
        </p>
       <p style="color:#355C7D;">Thank You!</p>
        <br>
        <br>
     </div>
                    ';
       $mail->send();
     } 
     if ($_POST['status'] === 'Completed') {
      $mail = new PHPMailer(true);

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
      $mail->Password = 'xjthcdxrvlmxchki';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;
      $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
      $mail->addAddress($_POST['Applicantemail']);
      $mail->isHTML(true);
      $mail->Subject = 'Funeral service is complete';
      $mail->Body = '
      <div style="background:#ffffff;padding:20px 50px 20px 50px">
        <div style="padding:0px; text-align: center;">
          <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
       </div>
       <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
       <br>
       <p style="color:#355C7D;">'.$date.' '.$_POST['Applicantfirstname'].' '.$_POST['Applicantlastname'].', </p>
       <p style="color:#355C7D;">This is from Taytay Immanuel Church,  your funeral request was completed</p>
       <p style="color:#355C7D;">Thank You!</p>
        <br>
        <br>
     </div>
      ';
      $mail->send();
     }

     if ($_POST['status'] === 'Cancelled') {
      $mail = new PHPMailer(true);

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
      $mail->Password = 'xjthcdxrvlmxchki';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;
      $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
      $mail->addAddress($_POST['Applicantemail']);
      $mail->isHTML(true);
      $mail->Subject = 'Funeral service is cancelled';
      $mail->Body = '
      <div style="background:#ffffff;padding:20px 50px 20px 50px">
        <div style="padding:0px; text-align: center;">
          <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
       </div>
       <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
       <br>
       <p style="color:#355C7D;">'.$date.' '.$_POST['Applicantfirstname'].' '.$_POST['Applicantlastname'].', </p>
       <p style="color:#355C7D;">This is from Taytay Immanuel Church,  your Funeral request was got Cancelled</p>
       <p style="color:#355C7D;">Possible reason</p>
       <ul>
          <li style="color:#355C7D;">Cancellation is requested</li>
         <li style="color:#355C7D;">Not shown at the scheduled date</li>
       </ul>
       <p style="color:#355C7D;">If you have any concerns or questions feel free to ask here just click reply</p>
       <p style="color:#355C7D;">- From Taytay Immanuel Church</p>
     </div>
      ';
      $mail->send();
     }
    
   }
   $form_id = $_POST['form_id'];
   $status = $_POST['status'];
   $dec_fname = $_POST['Deceasedfirstname'];
   $dec_lname = $_POST['Deceasedlastname'];
   $dec_mname = $_POST['Deceasedmiddlename'];
   $dec_birthday = $_POST['DeceasedBirthday'];
   $dec_birthcity = $_POST['DeceasedBirthcity'];
   $dec_birthprov = $_POST['DeceasedBirthprovince'];
   $dec_country = $_POST['DeceasedCountry'];
   $dec_datedeath = $_POST['Deceaseddatedeath'];
   $dec_naturedeath = $_POST['Deceasednaturedeath'];
   $dec_chDeno = $_POST['DecChDeno'];
   $dec_dateBap = $_POST['DecDateOfBap'];
   $dec_Memptd = $_POST['DecChMemptd'];
   $appli_fname = $_POST['Applicantfirstname'];
   $appli_lname = $_POST['Applicantlastname'];
   $appli_mname = $_POST['Applicantmiddlename'];
   $appli_birthday = $_POST['Applicantbirthday'];
   $appli_address  = $_POST['Applicantaddress'];
   $appli_RelDec  = $_POST['ApplicantRelDec'];
   $appli_PrefBody = $_POST['ApplicantPrefBody'];
   $appli_NecroPlace = $_POST['ApplicantNecroPlace'];
   $appli_NecroDate = $_POST['ApplicantNecroDate'];
   $appli_NecroTime = $_POST['ApplicantNecroTime'];
   $appli_FunePlace = $_POST['ApplicantFuneralPlace'];
   $appli_FuneDate = $_POST['ApplicantFuneralDate'];
   $appli_FuneTime = $_POST['ApplicantFuneralTime'];
   $appli_contactNum = $_POST['Applicantcontactnum'];
   $appli_email = $_POST['Applicantemail'];
   
   $query = "UPDATE funeral_form SET
    status = '$status',
    deceased_fname = '$dec_fname',
    deceased_lname = '$dec_lname',
    deceased_mname = '$dec_mname',
    deceased_birthday = '$dec_birthday',
    deceased_birthplace_city = '$dec_birthcity',
    deceased_birthplace_province = '$dec_birthprov',
    deceased_birthplace_country = '$dec_country',
    deceased_dateofdeath = '$dec_datedeath',
    deceased_natureofdeath = '$dec_naturedeath',
    deceased_church_deno = '$dec_chDeno',
    deceased_dateofbaptism = '$dec_dateBap',
    deceased_church_membership_ptd = '$dec_Memptd',
    applicant_fname = '$appli_fname',
    applicant_lname = '$appli_lname',
    applicant_mname = '$appli_mname',
    applicant_birthday = '$appli_birthday',
    applicant_address = '$appli_address',
    applicant_rttd = '$appli_RelDec',
    applicant_pftb = '$appli_PrefBody',
    applicant_ns_place = '$appli_NecroPlace',
    applicant_ns_date = '$appli_NecroDate',
    applicant_ns_time = '$appli_NecroTime',
    applicant_fs_place = '$appli_FunePlace',
    applicant_fs_date = '$appli_FuneDate',
    applicant_fs_time = '$appli_FuneTime',
    applicant_contactnum = '$appli_contactNum',
    applicant_email = '$appli_email' 
    WHERE form_id = $form_id";
   mysqli_query($conn, $query);
   header('Location: funeral.php?action=edit&email='.$emails.'');
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
    <title>Services | Edit Funeral</title>
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
                    <li class="breadcrumb-item">Edit Funeral Form</li>
                  </ol>
               </div>
                   <div>
                       <div class="container-fluid p-0 border">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                           <h3>Edit Funeral Form</h3>
                         </div>
                  <?php 
                    $form_id = $_GET['form_id'];
                    $query = "SELECT * FROM funeral_form WHERE form_id = $form_id";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                  ?>
          <div id="EditEventContainer" class="px-5 pt-3">
             <form name="formEditEvent" id="formEditEvent" action="edit_funeral.php" method="POST" enctype="multipart/form-data">   
                <input type="hidden" name="form_id" value="<?php echo $row['form_id']?>">
                <input type="hidden" name="sched_date" value="<?php echo $row['sched_date']?>">
                <input type="hidden" name="from" value="<?php echo $row['time_from']?>">
                <input type="hidden" name="to" value="<?php echo $row['time_to']?>">
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
                  <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                          DECEASED PERSONAL INFORMATION
                     </div>
                        <!-- name -->
                        <label class="label-head">Name</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Firstname</label><br>
                               <input class="form-control" type="text" name="Deceasedfirstname" id="fname" value="<?php echo $row['deceased_fname']?>"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputSname">
                                <label for="">Surname</label><br>
                                <input class="form-control" type="text" name="Deceasedlastname" id="lname" value="<?php echo $row['deceased_lname']?>"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputMname">
                                <label for="">Middle Name</label><br>
                                <input class="form-control" type="text" name="Deceasedmiddlename" id="mname" value="<?php echo $row['deceased_mname']?>"><br>
                               </div>
                            </div>
                        </div>
                         <!-- date and place of birth -->
                         <label class="label-head">Date and Place of Birth</label>
                          <div class="row">
                            <div class="col-md-3">
                              <div id="inputDatepb">
                               <label for="">Date</label><br>
                               <input class="form-control" type="date" name="DeceasedBirthday" id="ddatepb" value="<?php echo $row['deceased_birthday']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-3">
                               <div id="inputCity">
                                <label for="">City/Municipality</label><br>
                                <input class="form-control" type="text" name="DeceasedBirthcity" id="dcity" value="<?php echo $row['deceased_birthplace_city']?>"><br>
                               </div>
                            </div>
                             <div class="col-md-3">
                               <div id="inputProvince">
                                <label for="">Province/Region</label><br>
                                <input class="form-control" type="text" name="DeceasedBirthprovince" id="dprovince" value="<?php echo $row['deceased_birthplace_province']?>"><br>
                               </div>
                            </div>
                            <div class="col-md-3">
                               <div id="inputCountry">
                                <label for="">Country</label><br>
                                <input class="form-control" type="text" name="DeceasedCountry" id="dcountry" value="<?php echo $row['deceased_birthplace_country']?>"><br>
                               </div>
                            </div>
                        </div>
                        <!-- date death -->
                    
                          <div class="row">
                            <div class="col-md-6">
                              <div id="ddatedeath">
                               <label for="ddatedeath" class="label-head">Date of Death</label><br>
                               <input class="form-control" type="date" name="Deceaseddatedeath" id="ddatedeath" value="<?php echo $row['deceased_dateofdeath']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="dnaturedeath">
                                <label for="dnaturedeath" class="label-head">Nature of Death</label><br>
                                <input class="form-control" type="text" name="Deceasednaturedeath" id="dnaturedeath" value="<?php echo $row['deceased_natureofdeath']?>"><br>
                               </div>
                            </div>
                        </div>
                  
                        <hr>
                        <!-- applicant info -->
                        <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                          APPLICANT INFORMATION
                       </div>
                        <!-- name -->
                        <label class="label-head">Name</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="afirstname">Firstname</label><br>
                               <input class="form-control" type="text" name="Applicantfirstname" id="afirstname" value="<?php echo $row['applicant_fname']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputSname">
                                <label for="alastname">Lastname</label><br>
                                <input class="form-control" type="text" name="Applicantlastname" id="alastname" value="<?php echo $row['applicant_lname']?>"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputMname">
                                <label for="amiddlename">Middle Name</label><br>
                                <input class="form-control" type="text" name="Applicantmiddlename" id="amiddlename" value="<?php echo $row['applicant_mname']?>"><br>
                               </div>
                            </div>
                        </div>
                             <div id="inputMname">
                                <label for="">Date of Birth</label><br>
                                <input class="form-control" type="date" name="Applicantbirthday" id="abirthday" value="<?php echo $row['applicant_birthday']?>"><br>
                            </div>
                            <div id="inputMname">
                                <label for="">Address</label><br>
                                <input class="form-control" type="text" name="Applicantaddress" id="aaddress" value="<?php echo $row['applicant_address']?>"><br>
                            </div>
                            <div class="row">
                             <!-- Relationship to the deceased -->
                            <div class="col-md-6">
                              <div id="selectRtd">
                              <label class="label-head">Relationship to the deceased</label>
                               <select name="ApplicantRelDec" id="rdList" class="form-select" aria-label="Default select example">
                               <option value="<?php echo $row['applicant_rttd']?>" selected><?php echo $row['applicant_rttd']?></option>
                                <option value="Spouse">Spouse</option>
                                <option value="Parent">Parent</option>
                                <option value="Child">Child</option>
                                <option value="Sibling">Sibling</option>
                                <option value="Grandparent">Grandparent</option>
                                <option value="Grandchild">Grandchild</option>
                               </select>
                             </div>
                            </div>
                             <!-- Preferences For The Body -->
                            <div class="col-md-6">
                               <div id="selectPref">
                                <label class="label-head">Preferences For The Body</label>
                                <select name="ApplicantPrefBody" id="rdList" class="form-select" aria-label="Default select example">
                                <option value="<?php echo $row['applicant_pftb']?>" selected><?php echo $row['applicant_pftb']?></option>
                                <option value="Burial">Burial</option>
                                <option value="Cremation">Cremation</option>
                                <option value="Donation to Medical Research">Donation to Medical Research</option>
                               </select>
                               </div>
                            </div>
                        </div>
                         
                      <br>
          
                        <label class="label-head">Contact Information</label>
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputCnum">
                               <label for="">Contact Number</label><br>
                               <input class="form-control" type="text" name="Applicantcontactnum" id="cnum" value="<?php echo $row['applicant_contactnum']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputEmail">
                                <label for="">Email</label><br>
                                <input class="form-control" type="text" name="Applicantemail" id="email" value="<?php echo $row['applicant_email']?>"><br>
                               </div>
                            </div>
                       </div>
                          <div class="form-check">
                            <input class="form-check-input" name="notification" type="checkbox" value="email" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                               Notify Applicant about the status of their request
                            </label>
                          </div>
                         <div class="container-fluid my-5">
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Form">      
                              <a href="funeral.php"><button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button></a>
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
     <script src="../assets/js/validin.js"></script>
     <script type="text/javascript">
          $(document).ready(function(){
            $('#formEditEvent').validin({
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
