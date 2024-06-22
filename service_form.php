<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit;
}
if ($_GET['service'] === 'bchild' || $_GET['service'] === 'byouth') {
  if ($_GET['service'] === 'byouth') {
    header("Location: baptism_youth.php?service=byouth");
    exit;
  }
  if ($_GET['service'] === 'bchild') {
    header("Location: baptism_form.php?service=bchild");
    exit;
  }
}
if ($_GET['service'] === 'Funeral') {
     header("Location: funeral_form.php?service=Funeral");
      exit;
}

$query = "SELECT * FROM user_account WHERE user_id = '{$_SESSION['user_id']}'";
$user = mysqli_fetch_assoc(mysqli_query($conn, $query));
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
    <link rel="stylesheet" href="assets/css/duDatepicker-theme.css">
    <link rel="stylesheet" href="assets/css/duDatepicker.css">
    <link href="assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Wedding</title>
    <style>
        #pageTitle{
            background-image: url('assets/img/services.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .img-container{
            background-size: cover;
        }
        /* Date picker design */
        .dudp__date{
          border: 1px solid #f2f2f2 !important;
          background-color: #86efac !important;
          color: #15803d !important;
        }
        .disabled, .current{
          border: none !important;
          background-color: white !important;
          color: #121212 !important;
        }
        .selected{
          background-color: #1d48ed !important;
          /* color: #93c5fd !important; */
        }
        .booked{
          background: #fecaca !important;
          color: #dc2626 !important;
         }
        @media only screen and (max-width: 765px) {
          .time-label{
            margin-top: 20px;
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

                <form class="service-form" action="submit_form.php" method="POST" enctype="multipart/form-data">
                    <div class="text-danger">
                          Fields with asterisks(*) are required
                      </div>
                    <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                         WEDDING APPLICATION FORM
                    </div>
                    <?php if(isset($_GET['error'])):?>
                       <div class="error" style="background: #fee2e2;">
                          <?php if($_GET['error'] === 'wedtime'):?>
                            <p class="text-danger text-center py-2">Please choose your Wedding schedule date and time</p>
                          <?php endif;?>
                          <?php if($_GET['error'] === 'retime'):?>
                            <p class="text-danger text-center py-2">Please choose your Rehersal schedule and time</p>
                          <?php endif;?>
                       </div>
                    <?php endif;?>
                     <!-- Wedding Date -->
                       <div id="inputService">
                            <label for="">Service</label><br>
                            <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id']?>">
                            <input type="text" name="service" id="service" class="form-control" value="Wedding" readonly="true"><br>
                        </div>
                       
                        <div id="inputField">
                            <label for="">Applicant</label><br>
                            <select name="wedding_appli" id="wedding_appli" class="form-select" aria-label="Default select example">
                                <option value="groom">Groom</option>
                                <option value="bride">Bride</option>
                             </select>
                        </div>
                        <br>
                            <hr>
                               <div class="row">
                                  <div class="col-md-6">
                                  <div id="inputDesWedDate">
                                     <label for="DesWedDate" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Desired Wedding Date <span class="text-danger">*</span></label><br>
                                     <input type="text" id="dateSchedule" name="DesWedDate" class="form-control" data-theme="indigo" readonly>
                                   
                                    <div class="mt-2">
                                      <span class="px-3 py-2" style="font-weight:bold;background:#dcfce7; color:#22c55e">
                                        Available 
                                      </span>
                                      <span class="px-3 py-2 ms-2" style="font-weight:bold;background:#fee2e2; color:#ef4444">
                                        Fully Booked
                                      </span>
                                    </div>
                                  </div>
                                  </div>
                               
                                  <div class="col-md-6">
                                     <label for="DesWedDate" class="time-label" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Wedding Time <span class="text-danger">*</span></label><br>  
                                        <div class="time mt-3">          
                                   
                                       </div>
                                   </div>
                               </div>
                               
                               <br>
                               <hr>
                                      <div id="inputDateOfReher">
                                        <label for="DateOfReher" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Date of Rehearsal <span class="text-danger">*</span></label><br>
                                        <input class="form-control" validate="required" type="text" name="DateOfReher" id="dateReSchedule" disabled placeholder="MM/DD/YY"><br>
                                      </div>
                              <hr>
  
                        <!-- groom's info -->
                      <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                      BRIDE INFORMATION
                      </div>
                      <!-- Name -->
                      <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridefname">
                               <label for="bridefname">Firstname <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="bridefname" id="bridefname"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbridelname">
                                <label for="bridelname">Surname <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="bridelname" id="bridelname"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div id="inputbrideAdd">
                            <label for="brideAdd">Address <span class="text-danger">*</span></label><br>
                            <textarea name="brideAdd" id="brideAdd" class="form-control" validate="required"></textarea>
                        </div>
                         <br>
                         <!-- Bride contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbridephone">
                               <label for="bridephone">Bride's Phone Number <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="bridephone" id="bridephone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideemail">
                                <label for="brideemail">Bride's Email <span class="text-danger">*</span></label><br>
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
                         <!-- Bride's Denomination of Church
                         <div id="inputbrideDenoOfCh">
                            <label for="brideDenoOfCh">Bride's Denomination of Church</label><br>
                            <input type="text" name="brideDenoOfCh" id="brideDenoOfCh" class="form-control">
                        </div>
                        <br>
                        Bride’s Present Church Membership 
                        <div id="inputbridePreChMem">
                            <label for="bridePreChMem">Bride's Present Church Membership </label><br>
                            <input type="text" name="bridePreChMem" id="bridePreChMem" class="form-control">
                        </div>
                         <br> -->
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
                               <input class="form-control" type="text" name="bridePasPhone" id="bridephone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbridePasemail">
                                <label for="bridePasemail">Pastor's Email</label><br>
                                <input class="form-control" type="text" name="bridePasemail" id="bridePasemail"><br>
                               </div>
                            </div>
                        </div>
            
                         <!-- Bride's Parent Name -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbrideFatherName">
                               <label for="brideFatherName">Bride's Father Name</label><br>
                               <input class="form-control" type="text" name="brideFatherName" id="brideFatherName"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideMotherName">
                                <label for="brideMotherName">Bride's Mother Name</label><br>
                                <input class="form-control" type="text" name="brideMotherName" id="brideMotherName"><br>
                               </div>
                            </div>
                        </div>
                      <!-- Bride's Parent Contact -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputbrideFatherPhone">
                               <label for="brideFatherPhone">Bride's Father Phone</label><br>
                               <input class="form-control" type="text" name="brideFatherPhone" id="brideFatherPhone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputbrideMotherPhone">
                                <label for="brideMotherPhone">Bride's Mother Phone</label><br>
                                <input class="form-control" type="text" name="brideMotherPhone" id="brideMotherPhone"><br>
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
                               <label for="groomfname">Firstname <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="groomfname" id="groomfname"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomlname">
                                <label for="groomlname">Surname <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="groomlname" id="groomlname"><br>
                               </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div id="inputgroomAdd">
                            <label for="groomAdd">Address <span class="text-danger">*</span></label><br>
                            <textarea name="groomAdd" id="groomAdd" class="form-control" validate="required"></textarea>
                        </div>
                         <br>
                         <!-- groom contact number -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomphone">
                               <label for="groomphone">Groom's Phone Number <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required|phone" type="text" name="groomphone" id="groomphone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomemail">
                                <label for="groomemail">Groom's Email <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required|email" type="text" name="groomemail" id="groomemail"><br>
                               </div>
                            </div>
                        </div>
                        <!-- groom's Date of Christian Baptism -->
                        <div id="inputgroomDateOfBap">
                            <label for="groomDateOfBap">Groom's Date of Christian Baptism </label><br>
                            <input type="date" name="groomDateOfBap" id="groomDateOfBap" class="form-control">
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
                               <input class="form-control" type="text" name="groomPasPhone" id="groomphone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomPasemail">
                                <label for="groomPasemail">Pastor's Email</label><br>
                                <input class="form-control" type="text" name="groomPasemail" id="groomPasemail"><br>
                               </div>
                            </div>
                        </div>
                         <!-- groom's Parent Name -->
                         <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomFatherName">
                               <label for="groomFatherName">Groom's Father Name</label><br>
                               <input class="form-control" type="text" name="groomFatherName" id="groomFatherName"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomMotherName">
                                <label for="groomMotherName">Groom's Mother Name</label><br>
                                <input class="form-control" type="text" name="groomMotherName" id="groomMotherName"><br>
                               </div>
                            </div>
                        </div>
                      <!-- Groom's Parent Contact -->
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputgroomFatherPhone">
                               <label for="groomFatherPhone">Groom's Father Phone</label><br>
                               <input class="form-control" type="text" name="groomFatherPhone" id="groomFatherPhone"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputgroomMotherPhone">
                                <label for="groomMotherPhone">Groom's Mother Phone</label><br>
                                <input class="form-control" type="text" name="groomMotherPhone" id="groomMotherPhone"><br>
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
                               <input class="form-control" type="text" name="FlowerGirl" id="FlowerGirl"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputRingBearer">
                                <label for="RingBearer">RingBearer</label><br>
                                <input class="form-control" type="text" name="RingBearer" id="RingBearer"><br>
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
                                <input class="form-control" type="text" name="Pianist" id="Pianist"><br>
                            </div>
                         <!-- Soloist  -->
                         <div id="inputSoloist">
                                <label for="Soloist">Soloist(s)</label><br>
                                <input class="form-control" type="text" name="Soloist" id="Soloist"><br>
                            </div>
                        <!-- Other Musicians  -->
                         <div id="inputOtherMusicians">
                                <label for="OtherMusicians">Other Musicians</label><br>
                                <input class="form-control" type="text" name="OtherMusicians" id="OtherMusicians"><br>
                            </div>
                          <!-- Sound Technician  -->
                         <div id="inputSoundTec">
                                <label for="SoundTec">Sound Technician</label><br>
                                <input class="form-control" type="text" name="SoundTec" id="SoundTec"><br>
                            </div>
                              <!-- Photographer  -->
                            <div id="inputPhotographer">
                                <label for="Photographer">Photographer</label><br>
                                <input class="form-control" type="text" name="Photographer" id="Photographer"><br>
                            </div>
                       <!-- OTHER INFORMATION  -->
                         <div id="inputOtherInfo">
                            <label for="OtherInfo">OTHER INFORMATION</label><br>
                            <textarea name="OtherInfo" id="OtherInfo" class="form-control"></textarea>
                         </div>
                     <!-- End End End End End End End -->
                        <hr>
                        <!-- Requirements -->

                      <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                      Requirements
                      </div>

                          <div id="inputImage">
                            <label for="image">Marriage License <span class="text-danger">*</span>
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right"
                             title="Valid Marriage License of the partners to be wed from the Local Civil Registrar"></i>
                            </label>
                            <input type="file" name="m_license" id="mLicense" class="form-control" accept="image/*" required>
                          </div>
                         <br>
                          <div id="inputImage">
                            <label for="image">Certificate of Marriage Counseling <span class="text-danger">*</span>
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right"
                             title="Certificate of marriage counseling from a marriage counselor or a pastor"></i>
                            </label>
                            <input type="file" name="m_counseling" id="mCounseling" class="form-control" accept="image/*" required>
                          </div>
                          <br>
                         <div class="message-text">
                             <span style="font-weight: bold;">Note:</span>
                             Please be informed that your data disclosed will be protected in compliance with the Data Privacy Act of 2012. By submitting, you confirm that you fully and voluntary give consent to the collection of such data
                        </div>
                          <br>
 
                       <div class="container-fluid d-flex justify-content-center">
                         <button type="submit" class="btn btn-sub btn-primary px-5">Submit</button>
                       </div>
                    </form>           
                     
                </div>
             
            </div>

      </main>
     <!-- footer -->
     <?php include('footer.php')?>

    
 
</body>
<script src="assets/js/validin.js"></script>
<script src="assets/js/bootstrap-imageupload.js"></script>
<script src="assets/js/duDatepicker.js"></script>

<script>
    console.log('<?php echo date('m/d/Y', strtotime('1 month', strtotime(date('m/d/Y'))))?>')
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })  
</script>
 
<?php
$query = "SELECT * FROM wedding_form";
$result = mysqli_query($conn, $query);
$booked_dates = [];
while ($row = mysqli_fetch_assoc($result)) {
  $date = $row['sched_date'];
  $query = "SELECT * FROM wedding_form WHERE sched_date = '$date' AND  
           (time_from = '09:00' AND time_to = '12:00' OR  time_from = '13:00' AND time_to = '16:00')";
  if (strtotime(date('m/d/Y')) <= strtotime($date)) {
    $total_rows = mysqli_num_rows(mysqli_query($conn, $query)); 
    if ($total_rows == 2) {
        array_push($booked_dates, $date);
    }
  }
}
?>
<script>
    $('.spinner').hide();
      $(document).ready(function(){
        let dates = <?php echo json_encode(array_unique($booked_dates));?>;
        duDatepicker('#dateSchedule', {
           range: false,
           clearBtn:true,
           minDate:'<?php echo date('m/d/Y', strtotime('1 month', strtotime(date('m/d/Y'))))?>',
           disabledDates: dates,
          disabledDays: ['Sun'],
           events: {
      	      shown: function () {
                let occupiedDates = []
                for (let date of dates) {
                    date = date.split('/')
                    occupiedDates.push([parseInt(date[0] - 1), parseInt(date[1])])
                }
                $('.dudp__date').each((key, elem) => {
                 for (const dateTaken of occupiedDates) {
                   let month = elem.getAttribute('data-month')
                   let day = elem.getAttribute('data-date')
                   if (month == dateTaken[0] && day == dateTaken[1]) {
                     elem.classList.add('booked')
                   }
                 }
                })

              },
           }

        });

      })
</script>

<script>
    $('.spinner').hide();
      $(document).ready(function(){
         $('#dateSchedule').change(function(){
            $('.time').html(`
                       <div class="text-center py-5">
                           <div class='spinner spinner-border spinner-border-sm'></div>
                        </div>
            `);
            $('#dateReSchedule').prop('disabled', 'true');
            //  setTimeout(function() {
                $.ajax({
                 url: 'ajax/load_time.php',
                 method: 'GET',
                 data: {date: $('#dateSchedule').val()},
                 success: function(data){
                   $('.time').html(data);
                   $.ajax({
                   url: 'ajax/load_rehertime.php',
                   method: 'GET',
                   data: {
                     date: $('#dateSchedule').val()
                   },
                   success: function(data){
                     $('#inputDateOfReher').html(data);
                   }
                  });
                   
                 }
              });

 
            //  }, 3000)

         })

     
      

      })
</script>
 
 
<script>
     $(document).ready(function(){
      $('.services-link').removeClass('text-white');
     $('.services-link').addClass('text-dark border rounded-pill px-4 bg-white');
     $('.m-services-link').removeClass('text-white');
     $('.m-services-link').addClass('text-dark border px-4 bg-white');
      $('#wedding_appli').change(function(){
         let weddingAppli = $(this).val();
         if (weddingAppli === 'groom') {
            $('#groomemail').val('<?php echo $user['email']?>');
            $('#groomemail').attr('readonly', 'true');
            $('#brideemail').removeAttr('readonly');
            $('#brideemail').val('');
         }
         if (weddingAppli === 'bride') {
            $('#brideemail').val('<?php echo $user['email']?>');
            $('#brideemail').attr('readonly', 'true');
            $('#groomemail').removeAttr('readonly');
            $('#groomemail').val('');
         }
      })
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
            $('.service-form').validin({});
            $('.consent-container').show();
          }else{
            $('.consent-input').attr('validate', '');
            $('.consent-input').removeAttr('required');
            $('.consent-container').hide();
          }
         })
     })
   
     $('.service-form').submit(function(){
      $('.btn-sub').attr("disabled", "true");
         $('.btn-sub').html(`
                    <div class="py-1 px-3">
                      <span class='spinner-border spinner-border-sm'></span>
                    </div>
         `)
     })

</script>
</html>