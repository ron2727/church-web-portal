<?php
require __DIR__ . '/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
   header("Location: signin.php");
   exit;
}

?>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" sizes="310x310" href="assets/img/tic_logo.png">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="assets/css/responsive.css">
   <link rel="stylesheet" href="assets/css/animation.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
   <title>Edit form</title>
   <style>
      .main-container {
         width: 60%;
         margin-top: 8rem;
      }

      @media only screen and (max-width: 765px) {
         .main-container {
            width: 100%;
         }
      }
   </style>
</head>

<body>
   <?php include('navigation.php') ?>
   <main class=" d-flex justify-content-center">
      <div class="main-container mb-5 bg-white">
         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
            <h3>Edit Funeral Form</h3>
         </div>
         <?php
         $form_id = $_GET['formid'];
         $query = "SELECT * FROM funeral_form WHERE form_id = $form_id";
         $result = mysqli_query($conn, $query);
         $row = mysqli_fetch_assoc($result);
         ?>
         <div id="EditEventContainer" class="px-5 pt-3">
            <form name="formEditEvent" id="formEditEvent" action="edit_form.php" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="form_id" value="<?php echo $row['form_id'] ?>">
               <input type="hidden" name="service" value="Funeral">
               <?php if (isset($_GET['action'])) : ?>
                  <div class="alert alert-success my-1">
                     <strong>Edit save!</strong>
                  </div>
               <?php endif; ?>
               <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                  DECEASED PERSONAL INFORMATION
               </div>
               <!-- name -->
               <label class="label-head">Name</label>
               <div class="row">
                  <div class="col-md-4">
                     <div id="inputFname">
                        <label for="fname">Firstname</label><br>
                        <input class="form-control" type="text" name="Deceasedfirstname" id="fname" value="<?php echo $row['deceased_fname'] ?>"><br>
                        <small class="error"></small>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div id="inputSname">
                        <label for="">Surname</label><br>
                        <input class="form-control" type="text" name="Deceasedlastname" id="lname" value="<?php echo $row['deceased_lname'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div id="inputMname">
                        <label for="">Middle Name</label><br>
                        <input class="form-control" type="text" name="Deceasedmiddlename" id="mname" value="<?php echo $row['deceased_mname'] ?>"><br>
                     </div>
                  </div>
               </div>
               <!-- date and place of birth -->
               <label class="label-head">Date and Place of Birth</label>
               <div class="row">
                  <div class="col-md-3">
                     <div id="inputDatepb">
                        <label for="">Date</label><br>
                        <input class="form-control" type="date" name="DeceasedBirthday" id="ddatepb" value="<?php echo $row['deceased_birthday'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div id="inputCity">
                        <label for="">City/Municipality</label><br>
                        <input class="form-control" type="text" name="DeceasedBirthcity" id="dcity" value="<?php echo $row['deceased_birthplace_city'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div id="inputProvince">
                        <label for="">Province/Region</label><br>
                        <input class="form-control" type="text" name="DeceasedBirthprovince" id="dprovince" value="<?php echo $row['deceased_birthplace_province'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div id="inputCountry">
                        <label for="">Country</label><br>
                        <input class="form-control" type="text" name="DeceasedCountry" id="dcountry" value="<?php echo $row['deceased_birthplace_country'] ?>"><br>
                     </div>
                  </div>
               </div>
               <!-- date death -->

               <div class="row">
                  <div class="col-md-6">
                     <div id="ddatedeath">
                        <label for="ddatedeath" class="label-head">Date of Death</label><br>
                        <input class="form-control" type="date" name="Deceaseddatedeath" id="ddatedeath" value="<?php echo $row['deceased_dateofdeath'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div id="dnaturedeath">
                        <label for="dnaturedeath" class="label-head">Nature of Death</label><br>
                        <input class="form-control" type="text" name="Deceasednaturedeath" id="dnaturedeath" value="<?php echo $row['deceased_natureofdeath'] ?>"><br>
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
                        <input class="form-control" type="text" name="Applicantfirstname" id="afirstname" value="<?php echo $row['applicant_fname'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div id="inputSname">
                        <label for="alastname">Lastname</label><br>
                        <input class="form-control" type="text" name="Applicantlastname" id="alastname" value="<?php echo $row['applicant_lname'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div id="inputMname">
                        <label for="amiddlename">Middle Name</label><br>
                        <input class="form-control" type="text" name="Applicantmiddlename" id="amiddlename" value="<?php echo $row['applicant_mname'] ?>"><br>
                     </div>
                  </div>
               </div>
               <div id="inputMname">
                  <label for="">Date of Birth</label><br>
                  <input class="form-control" type="date" name="Applicantbirthday" id="abirthday" value="<?php echo $row['applicant_birthday'] ?>"><br>
               </div>
               <div id="inputMname">
                  <label for="">Address</label><br>
                  <input class="form-control" type="text" name="Applicantaddress" id="aaddress" value="<?php echo $row['applicant_address'] ?>"><br>
               </div>
               <div class="row">
                  <!-- Relationship to the deceased -->
                  <div class="col-md-6">
                     <div id="selectRtd">
                        <label class="label-head">Relationship to the deceased</label>
                        <select name="ApplicantRelDec" id="rdList" class="form-select" aria-label="Default select example">
                           <option value="<?php echo $row['applicant_rttd'] ?>" selected><?php echo $row['applicant_rttd'] ?></option>
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
                           <option value="<?php echo $row['applicant_pftb'] ?>" selected><?php echo $row['applicant_pftb'] ?></option>
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
                        <input class="form-control" type="text" name="Applicantcontactnum" id="cnum" value="<?php echo $row['applicant_contactnum'] ?>"><br>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div id="inputEmail">
                        <label for="">Email</label><br>
                        <input class="form-control" type="text" name="Applicantemail" id="email" value="<?php echo $row['applicant_email'] ?>"><br>
                     </div>
                  </div>
               </div>
               <div class="container-fluid my-5">
                  <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Form">
                  <a href="funeral.php"><button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button></a>
               </div>
            </form>

         </div>

      </div>
   </main>
   <?php include('footer.php') ?>
</body>

</html>