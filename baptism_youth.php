<?php
require __DIR__ .'/assets/database/connection.php';
 session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit;
}
 
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
$user_data = mysqli_fetch_assoc(mysqli_query($conn, $query));

$month = date('n');
$year = date('Y');
if ($month >= 1 && $month < 4) {
   $day_name =  date('D', strtotime("$year-04-01"));
    if ($day_name === 'Mon') {
        $date = date('l F d, Y', strtotime("$year-04-07"));
        $cal_date = "$year/04/07";
        $input_date = "$year-04-07";
   }
   if ($day_name === 'Tue') {
         $date = date('l F d, Y', strtotime("$year-04-06"));
         $cal_date = "$year/04/06";
         $input_date = "$year-04-06";
   }
   if ($day_name === 'Wed') {
        $date = date('l F d, Y', strtotime("$year-04-05"));
        $cal_date = "$year/04/05";
        $input_date = "$year-04-05";
   }
   if ($day_name === 'Thu') {
         $date = date('l F d, Y', strtotime("$year-04-04"));
         $cal_date = "$year/04/04";
         $input_date = "$year-04-04";
   }
  if ($day_name === 'Fri') {
       $date = date('l F d, Y', strtotime("$year-04-03"));
       $cal_date = "$year/04/03";
       $input_date = "$year-04-03";
  }
  if ($day_name === 'Sat') {
         $date = date('l F d, Y', strtotime("$year-04-02"));
         $cal_date = "$year/04/02";
         $input_date = "$year-04-02";
  }
  if ($day_name === 'Sun') {
         $date = date('l F d, Y', strtotime("$year-04-01"));
         $cal_date = "$year/04/01";
         $input_date = "$year-04-02";
         
  }
}

if ($month >= 4 && $month < 8) {
  $day_name =  date('D', strtotime("$year-08-01"));
  if ($day_name === 'Mon') {
         $date = date('l F d, Y', strtotime("$year-08-07"));
         $cal_date = "$year/08/07";
         $input_date = "$year-08-07";
 }
 if ($day_name === 'Tue') {
       $date = date('l F d, Y', strtotime("$year-08-06"));
       $cal_date = "$year/08/06";
       $input_date = "$year-08-06";
 }
 if ($day_name === 'Wed') {
      $date = date('l F d, Y', strtotime("$year-08-05"));
      $cal_date = "$year/08/05";
      $input_date = "$year-08-05";
 }
 if ($day_name === 'Thu') {
       $date = date('l F d, Y', strtotime("$year-08-04"));
       $cal_date = "$year/08/04";
       $input_date = "$year-08-04";
 }
if ($day_name === 'Fri') {
       $date = date('l F d, Y', strtotime("$year-08-03"));
       $cal_date = "$year/08/03";
       $input_date = "$year-08-03";
}
if ($day_name === 'Sat') {
       $date = date('l F d, Y', strtotime("$year-08-02"));
       $cal_date = "$year/08/02";
       $input_date = "$year-08-02";
}
if ($day_name === 'Sun') {
       $date = date('l F d, Y', strtotime("$year-08-01"));
       $cal_date = "$year/08/01";
       $input_date = "$year-08-01";
}

}
if ($month >= 8 && $month < 12) {
  $day_name =  date('D', strtotime("$year-12-01"));
  if ($day_name === 'Mon') {
         $date = date('l F d, Y', strtotime("$year-12-07"));
         $cal_date = "$year/12/07";
         $input_date = "$year-12-07";
 }
 if ($day_name === 'Tue') {
       $date = date('l F d, Y', strtotime("$year-12-06"));
        $cal_date = "$year/12/06";
        $input_date = "$year-12-06";
      }
 if ($day_name === 'Wed') {
      $date = date('l F d, Y', strtotime("$year-12-05"));
       $cal_date = "$year/12/05";
       $input_date = "$year-12-05";
    }
 if ($day_name === 'Thu') {
       $date = date('l F d, Y', strtotime("$year-12-04"));
        $cal_date = "$year/12/04";
        $input_date = "$year-12-04";
      }
if ($day_name === 'Fri') {
       $date = date('l F d, Y', strtotime("$year-12-03"));
       $cal_date = "$year/12/03";
       $input_date = "$year-12-03";
      }
if ($day_name === 'Sat') {
       $date = date('l F d, Y', strtotime("$year-12-02"));
       $cal_date = "$year/12/02";
       $input_date = "$year-12-02";
      }
if ($day_name === 'Sun') {
       $date = date('l F d, Y', strtotime("$year-12-01"));
       $cal_date = "$year/12/01";
       $input_date = "$year-12-01";
      }

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
    <link href="assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <title>Water Baptism</title>
    <style>
        #pageTitle{
            background-image: url('assets/img/services.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .img-container{
            background-size: cover;
        }
        #trackNum{
            border: none;
            background: white;
            outline: none;
            font-weight: bold;
        }
        .label-head{
            font-weight: bold;
        }
        .ui-datepicker{
          font-family: Poppins;
          border: 1px solid #8c8c8c  !important;
          padding: 0px !important;
          width: 100%;
        }
        .ui-datepicker-header{
          background: #3b82f6;
          color: white;
        }
        .ui-highlight{
          background: #dcfce7 !important;
        }
        .ui-state-default{
	     		background: #dcfce7 !important;
 	        color: #22c55e !important;
          font-weight: bold !important;
          border: none !important;
	       }
        .ui-datepicker td.ui-state-disabled>span{
        background:white !important;
        color: #121212 !important;
        font-weight: bold;
        border: 1px solid #cccccc !important;
        }
       .ui-datepicker td.ui-state-disabled{
        opacity:100;
        }
        .ui-datepicker-week-end{
          color: #ef4444;
        }
        #inputBapDateCon{
            width: 50%;
          }
        @media only screen and (max-width: 765px) {
          #inputBapDateCon{
            width: 100%;
          }
        }
   
    </style>
</head>
<body>
       <!-- Navigation -->
       <?php include('navigation.php')?>
      <!-- <div class="container-fluid py-3 px-2 bg-white shadow">
      <h6 class="display-6" style="font-family: Poppins;">Funeral Service Planning Form</h6>
      </div> -->
      <!-- Content -->
      <main>
        
            <div class="container-fluid py-5 d-flex justify-content-center" style="margin-top: 100px;">
                <!-- Funeral form -->
           
                <div id="serviceForm" class="shadow bg-white p-4 rounded-4">
                     

                   <div class="container-fluid">
                         <p>Dear applicant,</p>
                         <p>Greetings in Jesus' name!</p>
                         <p>Thank you for your desire to get baptized as Jesus commands us. Please kindly fill out this application form.  The schedule of next baptism was on <span style="font-weight: bold;"><?php echo $date?></span> time 03:00PM to 05:00PM. </p>
                         <br><br><br>
                        <p>God Bless you,</p>
                        <br>
                        <p>Rev Kim Jong Hun</p>
                        <p>Senior Pastor</p>
                        <br><br>
                        <p>Pastor Raffy Ciocon</p>
                        <p>Assistant Pastor</p>
                      </div>
                      <div class="container-fluid mt-5">
                      <form class="service-form" action="submit_form.php" method="POST" enctype="multipart/form-data">
                         
                        <div class="text-danger">
                          Fields with asterisks(*) are required
                      </div>
                        <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                           APPLICATION FOR WATER BAPTISM
                        </div>
                            <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id']?>">
                            <input type="hidden" name="service" id="service" value="Baptism"><br>
                            <input type="hidden" name="type" id="type" value="youth">
                            <input type="hidden" id="schedule" name="baptismDate" value="<?php echo $cal_date?>">
                            <br>
                            <!-- Title -->
                            <div id="selecttitle">
                              <label>Title</label>
                               <select name="appli_title" id="relList" class="form-select" aria-label="Default select example">
                                <option selected>Select Title...</option>
                                <option value="Dr">Dr</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Miss">Miss</option>
                               </select>
                             </div>
                             <br>
                         <!-- name -->
                        <label class="label-head">Applicant's Name</label>
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputFname">
                               <label for="fname">Firstname <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="appli_fname" id="fname" value="<?php echo $user_data['firstname']?>"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputSname">
                                <label for="">Lastname <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="appli_lname" id="lname" value="<?php echo $user_data['lastname']?>"><br>
                               </div>
                            </div>
                        </div>
                          <!--Applicant Address -->
                          <div id="inputappli_add">
                            <label for="appli_add">Address <span class="text-danger">*</span></label><br>
                            <textarea name="appli_add" id="appli_add" class="form-control" validate="required"></textarea>
                         </div>
                         <!-- Email -->
                         <div id="inputappli_email">
                            <label for="appli_email">Email <span class="text-danger">*</span></label><br>
                            <input class="form-control" validate="required" type="text" name="appli_email" id="appli_email" value="<?php echo $user_data['email']?>" readonly><br>
                          </div>
                                                  <!-- Telephone and  Date of Birth-->  
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputFname">
                               <label for="appli_tel">Contact Number <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required|phone" type="text" name="appli_tel" id="appli_tel" ><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputSname">
                                <label for="appli_birthday">Date of Birth <span class="text-danger">*</span></label><br>
                           
                                <input  type="date" class="form-control" validate="required" name="appli_birthday" id="appli_birthday"><br>
                               </div>
                            </div>
                        </div>

                          <!-- Nationality and  Occupation-->  
                          <div class="row">
                            <div class="col-md-6">
                              <div id="inputFname">
                               <label for="appli_nation">Nationality</label><br>
                               <input class="form-control" type="text" name="appli_nation" id="appli_nation"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputSname">
                                <label for="appli_occu">Occupation</label><br>
                                <input class="form-control" type="text" name="appli_occu" id="appli_occu"><br>
                               </div>
                            </div>
                        </div>
                             <!-- marital -->
                           <div id="selectMarital">
                              <label>Marital Status</label>
                               <select name="appli_marital" id="rdList" class="form-select" aria-label="Default select example">
                                <option selected>Select Marital Status...</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Seperated">Seperated</option>
                                <option value="Single Parent">Single Parent</option>
                                <option value="Widowed">Widowed</option>
                               </select>
                             </div>
                               <!-- Name of the Kingdom group  -->
                               <br>
                           <div id="inputkingdom_group">
                                <label for="kingdom_group">Name of the Kingdom group (If applicable): </label><br>
                                <input class="form-control" type="text" name="kingdom_group" id="kingdom_group"><br>
                            </div>
                            <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                              PERSONAL HISTORY  
                            </div>
                            <!-- Date of Salvation  -->
                         <div id="inputappli_date_salv">
                            <label for="appli_date_salv">Date of Salvation (if applicable) </label><br>
                            <input class="form-control" type="date" name="appli_date_salv" id="appli_date_salv"><br>
                          </div>
                            <!-- Attend Worship regularly? and  Starting from -->  
                           <div class="row">
                            <div class="col-md-6">
                            <div id="selectatt_worsh">
                              <label>Attend Worship regularly?</label>
                               <select name="appli_att_worsh" class="form-select" aria-label="Default select example">
                                <option selected></option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                               </select>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputStart_from">
                                <label for="appli_start_from">Starting from </label><br>
                                <input class="form-control" type="date" name="appli_start_from" id="appli_start_from"><br>
                               </div>
                            </div>
                           </div>
                           <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                             PERSONAL TESTIMONY   
                            </div>
                            <!--Applicant TESTIMONY-->
                           <div id="inputappli_testimony">
                             <label for="appli_testimony">Write a short testimony of what Christ has done in your life</label><br>
                             <textarea name="appli_testimony" id="appli_testimony" class="form-control"></textarea>
                           </div>
                           <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                              PRE-REQUISITES FOR WATER BAPTISM    
                            </div>
                            <!-- Pre Req 1 -->
                            <div class="container-fluid">
                            <p>I believe that Jesus Christ died on the cross for my sins and I am appropriating it by faith for my forgiveness, that salavation is by grace through faith (Acts 2:38, Eph. 1:17-18; Ephesians 2:8)</p>
                              <div class="d-flex">
                                   <!-- Yes -->
                            <div class="form-check me-2">
                             <input class="form-check-input" type="radio" name="preReq1" id="radYes" value="Yes">
                             <label class="form-check-label" for="radYes">
                                Yes
                              </label>
                             </div>
                             <!-- No -->
                             <div class="form-check">
                             <input class="form-check-input" type="radio" name="preReq1" id="radNo" value="No">
                             <label class="form-check-label" for="radNo">
                                No
                              </label>
                             </div>
                             </div>
                            </div>
                            <br>
                               <!-- Pre Req 2 -->
                            <div class="container-fluid">
                            <p>The Bible forbids Christians to any form of idolatry (worship of false god).  (Exodus 20:3-4)  Have you renounce all forms of idolatry in your life?  </p>
                              <div class="d-flex">
                                   <!-- Yes -->
                            <div class="form-check me-2">
                             <input class="form-check-input" type="radio" name="preReq2" id="radYes" value="Yes">
                             <label class="form-check-label" for="radYes">
                                Yes
                              </label>
                             </div>
                             <!-- No -->
                             <div class="form-check">
                             <input class="form-check-input" type="radio" name="preReq2" id="radNo" value="No">
                             <label class="form-check-label" for="radNo">
                                No
                              </label>
                             </div>
                             </div>
                            </div>
                            <br>
                            <div id="selectPrevRel">
                              <label class="label-head">PREVIOUS RELIGION (Please Tick Appropriate Box) </label>
                               <select name="appli_prevRel" id="relList" class="form-select" aria-label="Default select example">
                                <option selected>Select Previos Religion...</option>
                                <option value="Iglesia ni Kristo">Iglesia ni Kristo</option>
                                <option value="Ang Dating Daan">Ang Dating Daan</option>
                                <option value="Catholicism">Catholicism</option>
                                <option value="Jehovahs Witnesses">Jehovahs Witnesses</option>
                                <option value="Islam">Islam</option>
                                <option value="Church of Jesus Christ of Latter Day Saints">Church of Jesus Christ of Latter Day Saints</option>
                               </select>
                             </div>
                             <br>
                            <!-- Applicant Photo -->
                                 <div class="imageupload panel panel-default mt-3">
                                       <div class="panel-heading clearfix">
                                       <label for="status">Upload 2 x 2 Picture</label>
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
                             <br>
                            <!-- Pare Consent Form -->
                            <div class="consent-container container-fluid">
                              <div id="consentMessage" class="container-fluid text-danger">Based on your Birthday you are below 18 parent consent is required to submit your form</div>
                               <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                                PARENT'S PARTICULARS     
                              </div>
                              <!-- Father Consent -->
                         <label class="label-head">Father</label>
                         <div class="row">
                         <div class="col-md-4">
                               <div id="inputSname">
                                <label for="">Surname <span class="text-danger">*</span></label><br>
                                <input class="consent-input form-control" type="text" name="appli_Fatherlname" validate="required" id="lname"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Given Name <span class="text-danger">*</span></label><br>
                               <input class="consent-input form-control" type="text" name="appli_FatherGname" validate="required" id="fname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">English Name</label><br>
                               <input class="form-control" type="text" name="appli_FatherEname" id="fname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                          </div>
                         <!-- asdasd -->
                       <div class="row">
                         <div class="col-md-6">
                         <!-- Religion  -->
                         <div id="inputappli_fatherRel">
                            <label for="appli_fatherRel">Religion</label><br>
                            <input class="form-control" type="text" name="appli_fatherRel" id="appli_fatherRel"><br>
                          </div>
                            </div>
                            <div class="col-md-6">
                            
                            <div class="container-fluid">
                            <p>Attending worship regularly?</p>
                              <div class="d-flex">
                                   <!-- Yes -->
                            <div class="form-check me-2">
                             <input class="form-check-input" type="radio" name="father_att_word" id="radYes" value="Yes">
                             <label class="form-check-label" for="radYes">
                                Yes
                              </label>
                             </div>
                             <!-- No -->
                               <div class="form-check">
                               <input class="form-check-input" type="radio" name="father_att_word" id="radNo" value="No">
                               <label class="form-check-label" for="radNo">
                                 No
                                </label>
                               </div>
                              </div>
                             </div>
                            </div>
                          </div>
                         <!-- Other -->
                         <div id="inputappli_fatherother">
                            <label for="appli_fatheromoer">Others</label><br>
                            <input class="form-control" type="text" name="appli_fatherother" id="appli_fatherother"><br>
                          </div>
                          
                          <!-- Father Consent End -->
                            <!-- Mother Consent -->
                         <label class="label-head">Mother</label>
                         <div class="row">
                         <div class="col-md-4">
                               <div id="inputSname">
                                <label for="">Surname <span class="text-danger">*</span></label><br>
                                <input class="consent-input form-control" type="text" name="appli_Motherlname" validate="required" id="lname"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Given Name <span class="text-danger">*</span></label><br>
                               <input class="consent-input form-control" type="text" name="appli_MotherGname" validate="required" id="fname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">English Name</label><br>
                               <input class="form-control" type="text" name="appli_MotherEname" id="fname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                          </div>
                         <!-- asdasd -->
                       <div class="row">
                         <div class="col-md-6">
                         <!-- Religion  -->
                         <div id="inputappli_motherRel">
                            <label for="appli_motherRel">Religion</label><br>
                            <input class="form-control" type="text" name="appli_motherRel" id="appli_motherRel"><br>
                          </div>
                            </div>
                            <div class="col-md-6">
                            
                            <div class="container-fluid">
                            <p>Attending worship regularly?</p>
                              <div class="d-flex">
                                   <!-- Yes -->
                            <div class="form-check me-2">
                             <input class="form-check-input" type="radio" name="mother_att_word" id="radYes" value="Yes">
                             <label class="form-check-label" for="radYes">
                                Yes
                              </label>
                             </div>
                             <!-- No -->
                               <div class="form-check">
                               <input class="form-check-input" type="radio" name="mother_att_word" id="radNo" value="No">
                               <label class="form-check-label" for="radNo">
                                 No
                                </label>
                               </div>
                              </div>
                             </div>
                            </div>
                          </div>
                          <!-- Other -->
                          <div id="inputappli_motherother">
                            <label for="appli_motheromoer">Others</label><br>
                            <input class="form-control" type="text" name="appli_motherother" id="appli_motherother"><br>
                          </div>
                          <div id="inputCnum">
                               <label for="">Contact Number <span class="text-danger">*</span></label><br>
                               <input class="consent-input-cnum form-control" type="text" name="appli_conum" id="cnum" validate="required|phone"><br>
                             </div>
                          <!-- Mother Consent End -->
                       </div>
                       <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                         Requirement
                       </div>
                       <div id="inputImage">
                            <label for="image">Birth Certificate <span class="text-danger">*</span>
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right"
                             title="Certificate of Live Birth from PSA of Local Civil Registrar"></i>
                            </label>
                            <input type="file" name="b_certificate" id="bCertificate" class="form-control" accept="image/*" required>
                          </div>
                          <br>
                         <div class="message-text">
                             <span style="font-weight: bold;">Note:</span>
                             Please be informed that your data disclosed will be protected in compliance with the Data Privacy Act of 2012. By submitting, you confirm that you fully and voluntary give consent to the collection of such data
                        </div>
                          <br>
                          <div class="container-fluid d-flex justify-content-center">
                            <button type="submit" class="btn btn-sub btn-primary px-5">
                              Submit
                            </button>
                         </div>
               
                        <!-- end end end -->
                        </form>
                      </div>
                 </div>
             
            </div>

      </main>
     <!-- footer -->
     <?php include('footer.php')?>

    
 
</body>
<script src="assets/js/validin.js"></script>
<script src="assets/js/bootstrap-imageupload.js"></script>

 
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })  
</script>

 
<script>
     $(document).ready(function(){
      $('.services-link').removeClass('text-white');
     $('.services-link').addClass('text-dark border rounded-pill px-4 bg-white');
     $('.m-services-link').removeClass('text-white');
     $('.m-services-link').addClass('text-dark border px-4 bg-white');
 
          $('.imageupload').imageupload({
                allowedFormats: [ "jpg", "jpeg"],
                maxFileSizeKb: 10000
            });
         $('.service-form').validin({
 
         });
         $('#inputService').hide();
         $('.consent-container').hide();
         $('#appli_birthday').change(function(){
          let age = (new Date().getFullYear()) - (new Date($(this).val()).getFullYear());
          if (age < 18) {
            $('.consent-input').attr('validate', 'required');
            $('.consent-input').removeAttr('required');
            $('.consent-input-cnum').attr('validate', 'required|phone');
            $('.consent-input-cnum').removeAttr('required');
            $('.service-form').validin({});
            $('.consent-container').show();
            
          }else{
            $('.consent-input').attr('validate', '');
            $('.consent-input').removeAttr('required');
            $('.consent-input-cnum').attr('validate', '');
            $('.consent-input-cnum').removeAttr('required');
            $('.consent-container').hide();
          }
         })
     })
     btnCopyText.onclick = function(){
        let copyText = document.getElementById('trackNum');
         copyText.select();
         copyText.setSelectionRange(0, 99999);
         navigator.clipboard.writeText(copyText.value);
     }

     $('.service-form').submit(function(){
      $('.btn-sub').attr("disabled", "true");
         $('.btn-sub').html(`
                    <div class="py-1 px-3">
                      <span class='spinner-border spinner-border-sm'></span>
                    </div>
         `)
     })

</script>

<script>
    $('.spinner').hide();
      $(document).ready(function(){

         $('#baptismDate').change(function(){
          $('#schedule').val($(this).val());
            $('.time').html("<div class='spinner spinner-border spinner-border-sm'></div>");
             setTimeout(function() {
                $.ajax({
                 url: 'ajax/baptism_time.php',
                 method: 'GET',
                 data: {date: $('#baptismDate').val()},
                 success: function(data){
                   $('.time').html(data);
                 } 
              })
             }, 3000)
         })

      })
</script>

<script>
           <?php 
          $query = "SELECT * FROM baptism_form";
          $result = mysqli_query($conn, $query);
        ?>
        var dates = [];
        <?php while($row = mysqli_fetch_assoc($result)):?>
             <?php
               $date = $row['sched_date'];
               $query = "SELECT * FROM baptism_form WHERE  sched_date = '$date'";  
               $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
             <?php if ($total_rows === 4):?>
                  dates.push("<?php echo $row['sched_date']?>");
             <?php endif;?>

        <?php endwhile;?>
        var str = jQuery.datepicker.formatDate('mm/dd/yy');
         function DisableDates(date) {
             var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
              return [dates.indexOf(string) == -1];
         }
         
         var today = new Date();
        var startingMonth = today.getMonth();
        // var numOfDays = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
        // var future_day = today.getDate() + 14;
        // if (future_day > numOfDays) {
        //     future_day = future_day - numOfDays;
        //     startingMonth  = startingMonth + 1;
        // }
        // alert('Month: ' + startingMonth + ' Day: ' + future_day);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
 
        today = yyyy + '-' + mm + '-' + dd;
  
        $('#baptismDate').datepicker({
            altFormat: "DD, d MM, yy",
            altField: "#alternate",
            dateFormat: 'mm/dd/yy',
            minDate: new Date(today),
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                return [date.getDay() === 0 && dates.indexOf(string) == -1, 'dateDis', 'tooltip text'];
            }

        })
     
        
     
 
</script>



<script>
    var baptismDate = ["<?php echo $cal_date?>"];
    $('#baptismDateYouth').datepicker({
            altFormat: "DD, d MM, yy",
            altField: "#alternate",
            dateFormat: 'mm/dd/yy',
            minDate: new Date(baptismDate[0]),
            maxDate: new Date(baptismDate[0]),
            beforeShowDay: function(date){
              var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
              return [baptismDate.indexOf(string) == -1];
            }
        })
</script>
</html>