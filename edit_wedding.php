<?php
require __DIR__ .'/assets/database/connection.php';
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
    <?php include('navigation.php')?>
    <main class=" d-flex justify-content-center">
        <?php 
          $user_id =  $_SESSION['user_id'];
          $form_id =  $_GET['formid'];
          $query = "SELECT * FROM baptism_form WHERE user_id = '$user_id' AND form_id = '$form_id'";
          $result = mysqli_query($conn, $query);
          $row_appli = mysqli_fetch_assoc($result);
        
          $query = "SELECT * FROM baptism_consent WHERE form_id = '$form_id'";
          $result = mysqli_query($conn, $query);
          $row_consent = mysqli_fetch_assoc($result);
        ?>
      <div class="main-container mb-5 bg-white ">
      <div>
                       <div class="container-fluid p-0 border">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                           <h3>Edit Wedding Form</h3>
                         </div>
                  <?php 
                    $form_id = $_GET['formid'];
                    $query = "SELECT * FROM wedding_form WHERE id = $form_id";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                  ?>
          <div id="EditEventContainer" class="px-5 pt-3">
          <?php if(isset($_GET['action'])):?>
          <div class="alert alert-success my-1">
            <strong>Edit save!</strong> 
          </div>
       <?php endif;?>
             <form name="formWedd" id="formWedd" action="edit_form.php" method="POST" enctype="multipart/form-data">   
               <input type="hidden" name="form_id" value="<?php echo $row['id']?>">
               <input type="hidden" name="service" value="Wedding">
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
                     
 
                        <div class="container-fluid my-5">
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Form">      
                              <a href="wedding.php"><button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button></a>
                            </div>
                    </form>
 
                         </div>
                       </div>
                   </div>
      </div>
    </main>
    <?php include('footer.php')?>
</body>
</html>