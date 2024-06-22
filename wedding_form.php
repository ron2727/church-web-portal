<?php
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit;
}
$tracking_number = 'TIC'.rand(1, 99999).rand(1,999999);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Home</title>
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
    </style>
</head>
<body>
       <!-- Navigation -->
       <nav class="navbar navbar-expand-md bg-dark">
        <div class="container-fluid d-flex justify-content-between py-3 ps-5">
            <a class="navbar-brand text-white">
               Taytay Immanuel Church
               <!-- <img src="assets/img/alden3.jpg" alt=""> -->
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navMenu" class="collapse navbar-collapse">
               <ul class="navbar-nav">
                  <li class="nav-item px-2"><a href="index.php" class="nav-link text-white">Home</a></li>
                  <li class="nav-item px-2"><a href="services.php" class="nav-link text-dark border rounded-pill px-4 bg-white">Services</a></li>
                  <li class="nav-item px-2"><a href="event.php" class="nav-link text-white">Events</a></li>
                  <li class="nav-item px-2"><a href="aboutus.php" class="nav-link text-white">About Us</a></li>
                  <li class="nav-item px-2"><a href="track.php.php" class="nav-link text-white">Track Request</a></li>
                  <li class="nav-item px-2"><a href="forum_guest.php" class="nav-link text-white">Forum</a></li>
              </ul>
            </div>
        </div>
      </nav>  
      <!-- <div class="container-fluid py-3 px-2 bg-white shadow">
      <h6 class="display-6" style="font-family: Poppins;">Funeral Service Planning Form</h6>
      </div> -->
      <!-- Content -->
      <main>
        
            <div class="container-fluid py-5 d-flex justify-content-center">
                <!-- Funeral form -->
           
                <div id="serviceForm" class="shadow bg-white p-4 rounded-4">
                <form class="service-form" action="submit_form.php" method="POST">
                  <div id="inputTrackNum">
                         <label for="trackNum">Tracking Number</label>
                         <input type="text" name="tracknum" id="trackNum" value="<?php echo $tracking_number?>" readonly="true" style="text-align:right;">
                         <button type="button" id="btnCopyText" class="btn btn-none">COPY</button>
                    </div>
                    <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                         WEDDING APPLICATION FORM
                    </div>

                     <!-- Wedding Date -->
                       <div id="inputService">
                            <label for="">Service</label><br>
                            <input type="text" name="service" class="form-control" value="Wedding" readonly="true"><br>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputDesWedDate">
                               <label for="DesWedDate">Desired Wedding Date </label><br>
                               <input class="form-control" validate="required" type="date" name="DesWedDate" id="DesWedDate"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputDateOfReher">
                                <label for="DateOfReher">Date of Rehearsal</label><br>
                                <input class="form-control" validate="required" type="date" name="DateOfReher" id="DateOfReher"><br>
                               </div>
                            </div>
                        </div>
                      <!-- Wedding Time -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputDesWedTime">
                               <label for="DesWedTime">Time</label><br>
                               <input class="form-control" validate="required" type="time" name="DesWedTime" id="DesWedTime"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputTimeOfReher">
                                <label for="TimeOfReher">Time</label><br>
                                <input class="form-control" validate="required" type="time" name="TimeOfReher" id="TimeOfReher"><br>
                               </div>
                            </div>
                        </div>
                        <!-- groom's info -->
                      <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                      BRIDE INFORMATION
                      </div>
                      <!-- Name -->
                      <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridefname">
                               <label for="bridefname">Firstname</label><br>
                               <input class="form-control" validate="required" type="text" name="bridefname" id="bridefname"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbridelname">
                                <label for="bridelname">Surname</label><br>
                                <input class="form-control" validate="required" type="text" name="bridelname" id="bridelname"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div id="inputbrideAdd">
                            <label for="brideAdd">Address</label><br>
                            <textarea name="brideAdd" id="brideAdd" class="form-control"></textarea>
                        </div>
                         <br>
                         <!-- Bride contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridephone">
                               <label for="bridephone">Bride's Phone Number</label><br>
                               <input class="form-control" validate="required" type="text" name="bridephone" id="bridephone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideemail">
                                <label for="brideemail">Bride's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="brideemail" id="brideemail"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Bride's Date of Christian Baptism -->
                        <div id="inputbrideDateOfBap">
                            <label for="brideDateOfBap">Bride's Date of Christian Baptism </label><br>
                            <input type="date" name="brideDateOfBap" id="brideDateOfBap" class="form-control">
                        </div>
                         <br>
                         <!-- Bride's Denomination of Church -->
                         <div id="inputbrideDenoOfCh">
                            <label for="brideDenoOfCh">Bride's Denomination of Church</label><br>
                            <input type="text" name="brideDenoOfCh" id="brideDenoOfCh" class="form-control">
                        </div>
                        <br>
                        <!-- Bride’s Present Church Membership  -->
                        <div id="inputbridePreChMem">
                            <label for="bridePreChMem">Bride's Present Church Membership </label><br>
                            <input type="text" name="bridePreChMem" id="bridePreChMem" class="form-control">
                        </div>
                         <br>
                         <!-- Name of Bride’s Pastor  -->
                        <div id="inputbridePasName">
                            <label for="bridePasName">Name of Bride's Pastor</label><br>
                            <input type="text" name="bridePasName" id="bridePasName" class="form-control">
                        </div>
                         <br>
                             <!-- Bride pastor contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridePasPhone">
                               <label for="bridePasPhone">Pastor's Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="bridePasPhone" id="bridephone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbridePasemail">
                                <label for="bridePasemail">Pastor's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="bridePasemail" id="bridePasemail"><br>
                               </div>
                            </div>
                        </div>
            
                         <!-- Bride's Parent Name -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbrideFatherName">
                               <label for="brideFatherName">Bride's Father Name</label><br>
                               <input class="form-control" validate="required" type="date" name="brideFatherName" id="brideFatherName"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideMotherName">
                                <label for="brideMotherName">Bride's Mother Name</label><br>
                                <input class="form-control" validate="required" type="date" name="brideMotherName" id="brideMotherName"><br>
                               </div>
                            </div>
                        </div>
                      <!-- Bride's Parent Contact -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbrideFatherPhone">
                               <label for="brideFatherPhone">Bride's Father Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="brideFatherPhone" id="brideFatherPhone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideMotherPhone">
                                <label for="brideMotherPhone">Bride's Mother Phone</label><br>
                                <input class="form-control" validate="required" type="text" name="brideMotherPhone" id="brideMotherPhone"><br>
                               </div>
                            </div>
                        </div>
                        <!--Bride's Parent Address -->
                        <div id="inputbrideParentAdd">
                            <label for="brideParentAdd">Bride's Parent Address</label><br>
                            <textarea name="brideParentAdd" id="brideParentAdd" class="form-control"></textarea>
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
                               <input class="form-control" validate="required" type="text" name="groomfname" id="groomfname"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomlname">
                                <label for="groomlname">Surname</label><br>
                                <input class="form-control" validate="required" type="text" name="groomlname" id="groomlname"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div id="inputgroomAdd">
                            <label for="groomAdd">Address</label><br>
                            <textarea name="groomAdd" id="groomAdd" class="form-control"></textarea>
                        </div>
                         <br>
                         <!-- groom contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomphone">
                               <label for="groomphone">Groom's Phone Number</label><br>
                               <input class="form-control" validate="required" type="text" name="groomphone" id="groomphone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomemail">
                                <label for="groomemail">Groom's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="groomemail" id="groomemail"><br>
                               </div>
                            </div>
                        </div>
                        <!-- groom's Date of Christian Baptism -->
                        <div id="inputgroomDateOfBap">
                            <label for="groomDateOfBap">Groom's Date of Christian Baptism </label><br>
                            <input type="date" name="groomDateOfBap" id="groomDateOfBap" class="form-control">
                        </div>
                         <br>
                         <!-- groom's Denomination of Church -->
                         <div id="inputgroomDenoOfCh">
                            <label for="groomDenoOfCh">Groom's Denomination of Church</label><br>
                            <input type="text" name="groomDenoOfCh" id="groomDenoOfCh" class="form-control">
                        </div>
                        <br>
                        <!-- groom’s Present Church Membership  -->
                        <div id="inputgroomPreChMem">
                            <label for="groomPreChMem">Groom's Present Church Membership </label><br>
                            <input type="text" name="groomPreChMem" id="groomPreChMem" class="form-control">
                        </div>
                         <br>
                         <!-- Name of groom’s Pastor  -->
                        <div id="inputgroomPasName">
                            <label for="groomPasName">Name of Groom's Pastor</label><br>
                            <input type="text" name="groomPasName" id="groomPasName" class="form-control">
                        </div>
                         <br>
                             <!-- groom pastor contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomPasPhone">
                               <label for="groomPasPhone">Pastor's Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="groomPasPhone" id="groomphone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomPasemail">
                                <label for="groomPasemail">Pastor's Email</label><br>
                                <input class="form-control" validate="required" type="text" name="groomPasemail" id="groomPasemail"><br>
                               </div>
                            </div>
                        </div>
                         <!-- groom's Parent Name -->
                         <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomFatherName">
                               <label for="groomFatherName">Groom's Father Name</label><br>
                               <input class="form-control" validate="required" type="text" name="groomFatherName" id="groomFatherName"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomMotherName">
                                <label for="groomMotherName">Groom's Mother Name</label><br>
                                <input class="form-control" validate="required" type="text" name="groomMotherName" id="groomMotherName"><br>
                               </div>
                            </div>
                        </div>
                      <!-- Groom's Parent Contact -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomFatherPhone">
                               <label for="groomFatherPhone">Groom's Father Phone</label><br>
                               <input class="form-control" validate="required" type="text" name="groomFatherPhone" id="groomFatherPhone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomMotherPhone">
                                <label for="groomMotherPhone">Groom's Mother Phone</label><br>
                                <input class="form-control" validate="required" type="text" name="groomMotherPhone" id="groomMotherPhone"><br>
                               </div>
                            </div>
                        </div>
                        <!--Groom's Parent Address -->
                        <div id="inputgroomParentAdd">
                            <label for="groomParentAdd">Groom's Parent Address</label><br>
                            <textarea name="groomParentAdd" id="groomParentAdd" class="form-control"></textarea>
                        </div>
                          <!-- WEDDING CEREMONY INFORMATION info -->
                      <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                        WEDDING CEREMONY INFORMATION
                      </div>
                           <!-- Pastor Performing Service  -->
                         <div id="inputPastorPerSer">
                            <label for="PastorPerSer">Pastor Performing Service</label><br>
                            <input type="text" name="PastorPerSer" id="PastorPerSer" class="form-control">
                         </div>
                          <br>
                         <!-- Pastor Performing Service  -->
                         <div id="inputNumOfG">
                            <label for="NumOfG">Number of Guests</label><br>
                            <input type="text" name="NumOfG" id="NumOfG" class="form-control">
                         </div>
                          <br>
                           <!-- Maid of Honor  -->
                         <div id="inputMaidOfHon">
                            <label for="MaidOfHon">Maid of Honor</label><br>
                            <input type="text" name="MaidOfHon" id="MaidOfHon" class="form-control">
                         </div>
                          <br>
                         <!-- Best Man  -->
                         <div id="inputBestMan">
                            <label for="BestMan">Best Man</label><br>
                            <input type="text" name="BestMan" id="BestMan" class="form-control">
                         </div>
                          <br>
                         <!-- Bridemaids  -->
                         <div id="inputBridemaids">
                            <label for="Bridemaids">Bridemaids</label><br>
                            <textarea name="Bridemaids" id="Bridemaids" class="form-control"></textarea>
                         </div>
                         <br>
                        <!-- Groomsmen  -->
                        <div id="inputGroomsmen">
                            <label for="Groomsmen">Groomsmen</label><br>
                            <textarea name="Groomsmen" id="Groomsmen" class="form-control"></textarea>
                         </div>
                         <br>
                         <!-- Flower Girl and RingBearer -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputFlowerGirl">
                               <label for="FlowerGirl">Flower Girl</label><br>
                               <input class="form-control" validate="required" type="text" name="FlowerGirl" id="FlowerGirl"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputRingBearer">
                                <label for="RingBearer">RingBearer</label><br>
                                <input class="form-control" validate="required" type="text" name="RingBearer" id="RingBearer"><br>
                               </div>
                            </div>
                        </div>
                         <!-- Candlelighters  -->
                         <div id="inputCandlelighters">
                            <label for="Candlelighters">Ushers/Candlelighters</label><br>
                            <textarea name="Candlelighters" id="Candlelighters" class="form-control"></textarea>
                         </div>
                         <br>
                         <!-- Pianist  -->
                         <div id="inputPianist">
                                <label for="Pianist">Pianist</label><br>
                                <input class="form-control" validate="required" type="text" name="Pianist" id="Pianist"><br>
                            </div>
                         <!-- Soloist  -->
                         <div id="inputSoloist">
                                <label for="Soloist">Soloist(s)</label><br>
                                <input class="form-control" validate="required" type="text" name="Soloist" id="Soloist"><br>
                            </div>
                        <!-- Other Musicians  -->
                         <div id="inputOtherMusicians">
                                <label for="OtherMusicians">Other Musicians</label><br>
                                <input class="form-control" validate="required" type="text" name="OtherMusicians" id="OtherMusicians"><br>
                            </div>
                          <!-- Sound Technician  -->
                         <div id="inputSoundTec">
                                <label for="SoundTec">Sound Technician</label><br>
                                <input class="form-control" validate="required" type="text" name="SoundTec" id="SoundTec"><br>
                            </div>
                              <!-- Photographer  -->
                         <div id="inputPhotographer">
                                <label for="Photographer">Photographer</label><br>
                                <input class="form-control" validate="required" type="text" name="Photographer" id="Photographer"><br>
                            </div>
                       <!-- OTHER INFORMATION  -->
                         <div id="inputOtherInfo">
                            <label for="OtherInfo">OTHER INFORMATION</label><br>
                            <textarea name="OtherInfo" id="OtherInfo" class="form-control"></textarea>
                         </div>
                     <!-- End End End End End End End -->
                        <hr>
 
                       <div class="container-fluid d-flex justify-content-center">
                         <button type="submit" class="btn btn-primary px-5">Submit</button>
                       </div>
                    </form>
                </div>
             
            </div>

      </main>
      <!-- Footer -->
      <footer class="bg-light text-center text-lg-start">
             <hr>
             <div id="footerText" class="text-center p-3">
                 © <?php echo date('Y')?> Copyright: Taytay Immanuel Church
              </div>
     </footer>
</body>
<script src="assets/js/validin.js"></script>
<script>
     $(document).ready(function(){
         $('.service-form').validin({
          validation_tests: {
              'select_rtd': {
              'regex': /[A-Z]/,
              'error_message': "Please Select your relatioship to the deceased"
            }
            }
         });
     })
     btnCopyText.onclick = function(){
        let copyText = document.getElementById('trackNum');
         copyText.select();
         copyText.setSelectionRange(0, 99999);
         navigator.clipboard.writeText(copyText.value);
     }


</script>
</html>