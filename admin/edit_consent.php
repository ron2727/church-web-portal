<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $form_id = $_POST['form_id'];
    $f_given_name = $_POST['appli_FatherGname']; 
    $f_lastname = $_POST['appli_Fatherlname']; 
    $f_english_name = $_POST['appli_FatherEname'];
    $f_religion = $_POST['appli_fatherRel'];
    $f_attend_worship = $_POST['father_att_word'];
    $f_others = $_POST['appli_fatherother'];
    $m_given_name = $_POST['appli_MotherGname'];
    $m_lastname = $_POST['appli_Motherlname'];
    $m_english_name = $_POST['appli_MotherEname'];
    $m_religion = $_POST['appli_motherRel'];
    $m_attend_worship = $_POST['mother_att_word'];
    $m_others = $_POST['appli_motherother'];
 
 
  $query = "UPDATE baptism_consent SET f_given_name = '$f_given_name', f_lastname = '$f_lastname', f_english_name = '$f_english_name', f_religion = '$f_religion', f_attend_worship = '$f_attend_worship', f_others = '$f_others',
  m_given_name = '$m_given_name', m_lastname = '$m_lastname', m_english_name = '$m_english_name', m_religion = '$m_religion', m_attend_worship = '$m_attend_worship', m_others = '$m_others'
  WHERE form_id = '$form_id'";
  mysqli_query($conn, $query);
  
  header('Location: baptism.php?action=edit-consent');
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
    <title>Baptism | Edit Consent</title>
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
            <div class="container-fluid">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Services</li>
                    <li class="breadcrumb-item">Edit Baptism Consent</li>
                  </ol>
               </div>
                   <div>
                       <div class="container-fluid p-0 border bg-white" style="overflow-y: auto; height:80vh">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                           <h3>Edit Baptism Consent</h3>
                         </div>
                  <?php 
                    $form_id = $_GET['form_id'];
                    $query = "SELECT * 
                              FROM baptism_form
                              INNER JOIN baptism_consent ON baptism_form.form_id = baptism_consent.form_id
                              WHERE baptism_consent.form_id = '$form_id'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                         <div id="EditBaptismContainer" class="px-5 pt-3">
                         <label class="label-head" style="font-size: larger;">Parent consent from <?php echo $row['firstname']?>&nbsp;<?php echo $row['lastname']?></label>
                         <form name="formEditConsent" id="formEditConsent" action="edit_consent.php" method="POST" enctype="multipart/form-data">
                         <div class="container-fluid">
                           
                      <!-- baptism form id -->
                             <input type="hidden" name="form_id" id="eventId" class="form-control" validate="required" readonly="true" value="<?php echo $row['form_id']?>">
                               <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                                PARENT'S PARTICULARS     
                              </div>
                              <!-- Father Consent -->
                         <label class="label-head" style="font-weight:bold;">Father</label>
                         <div class="row">
                         <div class="col-md-4">
                               <div id="inputSname">
                                <label for="">Surname</label><br>
                                <input class="consent-input form-control" type="text" name="appli_Fatherlname" id="lname" value="<?php echo $row['f_lastname']?>"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Given Name</label><br>
                               <input class="consent-input form-control" type="text" name="appli_FatherGname" id="fname" value="<?php echo $row['f_given_name']?>"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">English Name</label><br>
                               <input class="consent-input form-control" type="text" name="appli_FatherEname" id="fname" value="<?php echo $row['f_english_name']?>"><br>
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
                            <input class="consent-input form-control" type="text" name="appli_fatherRel" id="appli_fatherRel" value="<?php echo $row['f_religion']?>"><br>
                          </div>
                            </div>
                            <div class="col-md-6">
                            
                            <div class="container-fluid">
                            <p>Attending worship regularly?</p>
                              <div class="d-flex">
                                   <!-- Yes -->
                            <div class="form-check me-2">
                             <input class="form-check-input" type="radio" name="father_att_word" id="radYes" value="Yes" <?php echo $row['f_attend_worship'] === 'Yes' ? 'checked' : ''?>>
                             <label class="form-check-label" for="radYes">
                                Yes
                              </label>
                             </div>
                             <!-- No -->
                               <div class="form-check">
                               <input class="form-check-input" type="radio" name="father_att_word" id="radNo" value="No" <?php echo $row['f_attend_worship'] === 'No' ? 'checked' : ''?>>
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
                            <input class="form-control" type="text" name="appli_fatherother" id="appli_fatherother" value="<?php echo $row['f_others']?>"><br>
                          </div>
                          <!-- Father Consent End -->
                            <!-- Mother Consent -->
                         <label class="label-head" style="font-weight:bold;">Mother</label>
                         <div class="row">
                         <div class="col-md-4">
                               <div id="inputSname">
                                <label for="">Surname</label><br>
                                <input class="consent-input form-control" type="text" name="appli_Motherlname" id="lname" value="<?php echo $row['m_lastname']?>"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Given Name</label><br>
                               <input class="consent-input form-control" type="text" name="appli_MotherGname" id="fname" value="<?php echo $row['m_given_name']?>"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">English Name</label><br>
                               <input class="consent-input form-control" type="text" name="appli_MotherEname" id="fname" value="<?php echo $row['m_english_name']?>"><br>
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
                            <input class="consent-input form-control" type="text" name="appli_motherRel" id="appli_motherRel" value="<?php echo $row['m_religion']?>"><br>
                          </div>
                            </div>
                            <div class="col-md-6">
                            
                            <div class="container-fluid">
                            <p>Attending worship regularly?</p>
                              <div class="d-flex">
                                   <!-- Yes -->
                            <div class="form-check me-2">
                             <input class="form-check-input" type="radio" name="mother_att_word" id="radYes" value="Yes" <?php echo $row['m_attend_worship'] === 'Yes' ? 'checked' : ''?>>
                             <label class="form-check-label" for="radYes">
                                Yes
                              </label>
                             </div>
                             <!-- No -->
                               <div class="form-check">
                               <input class="form-check-input" type="radio" name="mother_att_word" id="radNo" value="No" <?php echo $row['m_attend_worship'] === 'No' ? 'checked' : ''?>>
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
                            <input class="form-control" type="text" name="appli_motherother" id="appli_motherother" value="<?php echo $row['m_others']?>"><br>
                          </div>
                          <div id="inputCnum">
                               <label for="">Contact Number</label><br>
                               <input class="consent-input form-control" type="text" name="appli_conum" id="cnum" value="<?php echo $row['contact_num']?>"><br>
                             </div>
                             <div class="container-fluid my-5">
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Parent Form">      
                              <a href="baptism.php"><button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button></a>
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
     <script type="text/javascript">
          $(document).ready(function(){
            $('#formEditConsent').validin({
                required_fields_initial_error_message: "",
                form_error_message: "",
              });
          
          })
     </script>

</body>
     
</html>
