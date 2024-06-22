<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';
use PHPMailer\PHPMailer\PHPMailer;
require '../assets/libs/phpmailer/src/Exception.php';
require '../assets/libs/phpmailer/src/PHPMailer.php';
require '../assets/libs/phpmailer/src/SMTP.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $form_id = $_POST['form_id'] ?? '';
    $status = $_POST['status'] ?? '';
    $title = $_POST['appli_title'] ?? '';
    $firstname = $_POST['appli_fname'] ?? '';
    $lastname = $_POST['appli_lname'] ?? '';
    $address = $_POST['appli_add'] ?? '';
    $email = $_POST['appli_email'] ?? '';
    $telephone = $_POST['appli_tel'] ?? '';
    $nationality = $_POST['appli_nation'] ?? '';
    $occupation = $_POST['appli_occu'] ?? '';
    $marital_status = $_POST['appli_marital'] ?? '';
    $kingdom_group = $_POST['kingdom_group'] ?? '';
    $date_of_baptism = $_POST['sched_date'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    if ($_POST['type'] === 'child') {
        $type = 'Child Dedication';
    }
    if ($_POST['type'] === 'youth') {
        $type = 'Water Baptism';
    }
  $message = '
  <div style="background:#ffffff;padding:20px 50px 20px 50px">
  <div style="padding:0px; text-align: center;">
    <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
 </div>
 <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
 <br>
 <p style="color:#355C7D;">Good day </p>
 <p style="color:#355C7D;">This is from Taytay Immanuel Church, your request for '.$type.' to our church has been approve the schedule was on <span style="font-weight:bold;">'.date('l F d, Y', strtotime($date_of_baptism)).'</span> and the time is '.date('g:i A',strtotime($from)).' to '.date('g:i A',strtotime($to)).'</p>
 <p style="color:#355C7D;">Please bring your printed Application form</p>
 <p style="color:#355C7D;">You can download your Application form here:</p>
 <p>
   <a href="https://taytayimmanuelchurch.online/admin/print_form.php?attach=true&type='.$_POST['type'].'&service=baptism&form_id='.$form_id.'" style="text-decoration: none;">Click here to download your Application form</a>
 </p>
 <p style="color:#355C7D;">Thank You!</p>
  <br>
  <br>
</div>
  ';
  $query = "SELECT baptism_form.baptism_type 
            FROM baptism_form
            INNER JOIN baptism_consent ON baptism_form.form_id = baptism_consent.form_id
            WHERE baptism_type = 'youth' AND baptism_consent.form_id = '$form_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $message = '
    <div style="background:#ffffff;padding:20px 50px 20px 50px">
    <div style="padding:0px; text-align: center;">
      <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
   </div>
   <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
   <br>
   <p style="color:#355C7D;">Good day </p>
   <p style="color:#355C7D;">This is from Taytay Immanuel Church, your request for '.$type.' to our church has been approve the schedule was on <span style="font-weight:bold;">'.date('l F d, Y', strtotime($date_of_baptism)).'</span> and the time is '.date('g:i A',strtotime($from)).' to '.date('g:i A',strtotime($to)).'</p>
   <p style="color:#355C7D;">Please bring the following</p>
         <ul>
          <li style="color:#355C7D;">Your printed Application form</li>
          <li style="color:#355C7D;">Your consent, since you are below 18 years old</li>
        </ul>
   <p style="color:#355C7D;">You can download your Application form here:</p>
   <p>
     <a href="https://taytayimmanuelchurch.online/admin/print_form.php?attach=true&type='.$_POST['type'].'&service=baptism&form_id='.$form_id.'" style="text-decoration: none;">Click here to download your Application form</a>
   </p>
   <p style="color:#355C7D;">You can download your Consent form here:</p>
   <p>
     <a href="https://taytayimmanuelchurch.online/admin/print_form.php?attach=true&service=consent&form_id='.$form_id.'" style="text-decoration: none;">Click here to download your Consent form</a>
   </p>
   <p style="color:#355C7D;">Thank You!</p>
    <br>
    <br>
  </div>
    ';
  }
  
  if (isset($_POST['notification'])) {
    //  Status Approved
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
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Schedule of Baptism';
      $mail->Body = $message;
      // Good day! '.$firstname.' '.$lastname.' this is from Taytay Immanuel Church, your request for '.$type.' to our church has been approve the schedule was on '.date('l F d, Y', strtotime($date_of_baptism)).' and the time is '.date('g:i A',strtotime($from)).' to '.date('g:i A',strtotime($to)).'
      $mail->send();
     } 
     //  Status Completed
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
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Baptism service is complete';
      $mail->Body = '
      <div style="background:#ffffff;padding:20px 50px 20px 50px">
        <div style="padding:0px; text-align: center;">
          <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
       </div>
       <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
       <br>
       <p style="color:#355C7D;">Good day '.$firstname.' '.$lastname.', </p>
       <p style="color:#355C7D;">This is from taytay immanuel church, your request for '.$type.' was completed</p>

       <p style="color:#355C7D;">Thank You!</p>
        <br>
        <br>
     </div>
      ';
      // Good day! this is from taytay immanuel church, your request was completed
      
      $mail->send();
     }
    //  Status Cancelled
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
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Baptism service was cancelled';
      $mail->Body = '
      <div style="background:#ffffff;padding:20px 50px 20px 50px">
        <div style="padding:0px; text-align: center;">
          <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
       </div>
       <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
       <br>
       <p style="color:#355C7D;">Good day '.$firstname.' '.$lastname.', </p>
       <p style="color:#355C7D;">This is from taytay immanuel church, your request for '.$type.' was got Cancelled</p>
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
      // Good day! this is from taytay immanuel church, your request was completed
      
      $mail->send();
     }
   }  
   
  
  if (!empty($_FILES['image']['tmp_name'])) {
  $image_tmpname = $_FILES['image']['tmp_name'];
  $img_name = $_FILES['image']['name'];
  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
  $image_new_name = uniqid("BAP-IMG", false). '.' .$img_ex;
  $image_upload_path = '../assets/uploaded_images/baptism/' .$image_new_name;
  move_uploaded_file($image_tmpname, $image_upload_path);
  }
  if (empty($image_new_name)) {
    $query = "SELECT * FROM baptism_form WHERE form_id = '$form_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $image_new_name = $row['image'];
}
  $query = "UPDATE baptism_form SET status = '$status', title = '$title', firstname = '$firstname', lastname = '$lastname', address = '$address', email = '$email', telephone = '$telephone', nationality = '$nationality', occupation = '$occupation', marital_status = '$marital_status', kingdom_group = '$kingdom_group', image = '$image_new_name'
  WHERE form_id = '$form_id'";
  mysqli_query($conn, $query);
  
  if ($_POST['type'] === 'child') {
    header('Location: baptism.php?action=edit-baptism');
  }
  if ($_POST['type'] === 'youth') {
    header('Location: baptism_youth.php?action=edit-baptism');
  }
  exit;
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
    <title>Baptism | Edit Child Dedication</title>
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
       <div class="col-sm-10 p-0">
           <!-- Top nav -->
           <?php 
              include('top_navigation.php')
              ?>

            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Services</li>
                    <li class="breadcrumb-item">Edit <?php echo $_GET['type'] === 'child' ? 'Child Dedication' : 'Water Baptism'?></li>
                  </ol>
               </div>
                   <div>
                       <div class="container-fluid p-0 border bg-white">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                           <h3>Edit <?php echo $_GET['type'] === 'child' ? 'Child Dedication' : 'Water Baptism'?></h3>
                         </div>
                  <?php 
                    $form_id = $_GET['form_id'];
                    $query = "SELECT * FROM baptism_form WHERE form_id = '$form_id'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                  ?>
                         <div id="EditBaptismContainer" class="px-5 pt-3">

                         <form name="formEditBaptism" id="formEditBaptism" action="edit_baptism.php" method="POST" enctype="multipart/form-data">
                         <div class="container-fluid">
                                 <!-- baptism form id -->
                                <input type="hidden" name="form_id" value="<?php echo $row['form_id']?>">
                                <input type="hidden" name="type" value="<?php echo $row['baptism_type']?>">
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
                         
                          <?php if($_GET['type'] === 'youth'):?>
                            <br>
                             <div id="selecttitle">
                              <label>Title</label>
                               <select name="appli_title" id="relList" class="form-select" aria-label="Default select example">
                                <option value="<?php echo $row['title']?>" selected><?php echo $row['title']?></option>
                                <option value="Dr">Dr</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Miss">Miss</option>
                               </select>
                             </div>
                          <?php endif?> 
                             
                             <br>
                         <!-- name -->
                        <label style="font-weight: bold;">Applicant's Name</label>
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputFname">
                               <label for="fname">Firstname</label><br>
                               <input class="form-control" type="text" name="appli_fname" id="fname" value="<?php echo $row['firstname']?>"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputSname">
                                <label for="">Lastname</label><br>
                                <input class="form-control" type="text" name="appli_lname" id="lname" value="<?php echo $row['lastname']?>"><br>
                               </div>
                            </div>
                        </div>
                          <!--Applicant Address -->
                          <div id="inputappli_add">
                            <label for="appli_add">Address</label><br>
                            <textarea name="appli_add" id="appli_add" class="form-control"><?php echo $row['address']?></textarea>
                         </div>
                         <!-- Email -->
                         <div id="inputappli_email">
                            <label for="appli_email">Email</label><br>
                            <input class="form-control" type="text" name="appli_email" id="appli_email" value="<?php echo $row['email']?>"><br>
                          </div>
                      <?php if($_GET['type'] === 'youth'):?>  
                         <!-- Telephone and  Date of Birth-->  
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputFname">
                               <label for="appli_tel">Telephone</label><br>
                               <input class="form-control" type="text" name="appli_tel" id="appli_tel" value="<?php echo $row['telephone']?>"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-6">
                             <div id="inputFname">
                               <label for="appli_nation">Nationality</label><br>
                               <input class="form-control" type="text" name="appli_nation" id="appli_nation" value="<?php echo $row['nationality']?>"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                        </div>
                        <div id="inputSname">
                                <label for="appli_occu">Occupation</label><br>
                                <input class="form-control" type="text" name="appli_occu" id="appli_occu" value="<?php echo $row['occupation']?>"><br>
                               </div>
                    
                             <!-- marital -->
                           <div id="selectMarital">
                              <label>Marital Status</label>
                               <select name="appli_marital" id="rdList" class="form-select" aria-label="Default select example">
                                <option value="<?php echo $row['marital_status']?>" selected><?php echo $row['marital_status']?></option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Seperated">Seperated</option>
                                <option value="Single Parent">Single Parent</option>
                                <option value="Widowed">Widowed</option>
                               </select>
                             </div>
                             <br>
                               <!-- Name of the Kingdom group  -->
                           <div id="inputkingdom_group">
                                <label for="kingdom_group">Name of the Kingdom group (If applicable): </label><br>
                                <input class="form-control" type="text" name="kingdom_group" id="kingdom_group" value="<?php echo $row['kingdom_group']?>"><br>
                            </div>
                            <?php endif;?> 
                             <div class="mx-3">
                                <!-- <label for="image">Image</label> -->
                                <!-- <input type="file" name="image" id="image" class="form-control" accept="image/*"> -->
                                  <div class="imageupload panel panel-default mt-3">
                                       <div class="panel-heading clearfix">
                                       <label for="status">Applicant Photo</label>
                                         </div>
                                       <div class="file-tab panel-body">
                                        <br>
                                     <label class="btn btn-primary btn-file btn-info text-white">
                                        <span>Browse</span>
                                     <!-- The file is stored here. -->
                                      <input type="file" id="image" name="image">
                                     </label>
                                     <button type="button" class="btn btn-default active">Remove</button>
                                   </div>
                                </div>
                             </div>
                             <br>
                              <div class="form-check">
                                 <input class="form-check-input" name="notification" type="checkbox" value="email" id="flexCheckDefault">
                                 <label class="form-check-label" for="flexCheckDefault">
                                   Notify Applicant about the status of their request
                                 </label>
                               </div>
                             <div class="container-fluid my-5">
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Baptism">      
                              <a href="<?php echo ($_GET['type'] === 'child' ? 'baptism.php':'baptism_youth.php')?>"><button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button></a>
                             </div>
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
     <script src="../assets/js/notification.js"></script>
     <script src="../assets/js/bootstrap-imageupload.js"></script>
     <script type="text/javascript">
          $(document).ready(function(){
            $('.imageupload').imageupload({
                allowedFormats: [ "jpg", "jpeg"],
                maxFileSizeKb: 10000
            });
            $('#formEditBaptism').validin({
                required_fields_initial_error_message: "",
                form_error_message: "",
              });
          
          })
     </script>

</body>
     
</html>
