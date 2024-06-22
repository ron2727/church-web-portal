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
    <script src="assets/js/duDatepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
 
    <title>Funeral</title>
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
            .indicator{
              font-size: 0.8rem;
            }
            .form-check-label{
              font-size: 0.9rem;
            }
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
                 <form class="service-form" action="submit_form.php" method="POST">
                    <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id']?>">
                    <div class="text-danger">
                         Fields with asterisks(*) are required
                    </div>
                    <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                         FUNERAL SERVICE PLANNING FORM
                    </div>
                     <div class="error" style="background: #fee2e2;">
                            <?php if(isset($_GET['error'])):?>
                              <p class="text-danger text-center py-2">Please choose your schedule and time</p>
                            <?php endif;?>
                      </div>
                               <div class="row">
                                  <div class="col-md-6 border-bottom border-top py-2">
                                  <div id="inputDesWedDate">
                                     <label for="DesWedDate" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Schedule <span class="text-danger">*</span></label><br>
                                     <input type="text" id="funeralDate" name="funeralDate" class="form-control" data-theme="indigo" readonly>
                                    <div class="mt-2">
                                      <span class="indicator px-3 py-2" style="font-weight:bold;background:#dcfce7; color:#22c55e">
                                        Available 
                                      </span>
                                      <span class="indicator px-3 py-2 ms-2" style="font-weight:bold;background:#fee2e2; color:#ef4444">
                                        Fully Booked
                                      </span>
                                    </div>
                                  </div>
                                  </div>

                                 <div class="col-md-6 border-bottom border-top py-2">
                                   <label for="DesWedDate" class="time-label" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Time <span class="text-danger">*</span></label><br>
                                    <!-- <div class="d-flex justify-content-center" style="height: 100%;"> -->
                                       <div class="time mt-3">          
                                   
                                       </div>
                                    <!-- </div> -->
                                  </div>
                               </div>
                              
                    <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                          DECEASED PERSONAL INFORMATION
                     </div>
                     
                       <div id="inputService">
                            <label for="">Service</label><br>
                            <input type="text" name="service" id="service" class="form-control" value="Funeral" readonly="true"><br>
                        </div>
                       
                        <!-- name -->
                        <label class="label-head">Name</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Firstname <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="Deceasedfirstname" id="fname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputSname">
                                <label for="">Surname <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="Deceasedlastname" id="lname"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputMname">
                                <label for="">Middle Name</label><br>
                                <input class="form-control" type="text" name="Deceasedmiddlename" id="mname"><br>
                               </div>
                            </div>
                        </div>
                         <!-- date and place of birth -->
                         <label class="label-head">Date and Place of Birth</label>
                          <div class="row">
                            <div class="col-md-3">
                              <div id="inputDatepb">
                               <label for="">Date <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="date" name="DeceasedBirthday" id="ddatepb"><br>
                             </div>
                            </div>
                            <div class="col-md-3">
                               <div id="inputCity">
                                <label for="">City/Municipality <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="DeceasedBirthcity" id="dcity"><br>
                               </div>
                            </div>
                             <div class="col-md-3">
                               <div id="inputProvince">
                                <label for="">Province/Region <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="DeceasedBirthprovince" id="dprovince"><br>
                               </div>
                            </div>
                            <div class="col-md-3">
                               <div id="inputCountry">
                                <label for="">Country</label><br>
                                <input class="form-control" type="text" name="DeceasedCountry" id="dcountry"><br>
                               </div>
                            </div>
                        </div>
                        <!-- date death -->
                    
                          <div class="row">
                            <div class="col-md-6">
                              <div id="ddatedeath">
                               <label for="ddatedeath" class="label-head">Date of Death <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="date" name="Deceaseddatedeath" id="ddatedeath"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="dnaturedeath">
                                <label for="dnaturedeath" class="label-head">Nature of Death</label><br>
                                <input class="form-control" type="text" name="Deceasednaturedeath" id="dnaturedeath"><br>
                               </div>
                            </div>
                        </div>
                
                        <hr>
                        <!-- applicant info -->
                        <div class="container-fluid py-3" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;" class="label-head">
                          APPLICANT INFORMATION
                       </div>
                         <label class="label-head">Name</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="afirstname">Firstname <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="Applicantfirstname" id="afirstname"><br>
                             </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputSname">
                                <label for="alastname">Lastname <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="Applicantlastname" id="alastname"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div id="inputMname">
                                <label for="amiddlename">Middle Name</label><br>
                                <input class="form-control" type="text" name="Applicantmiddlename" id="amiddlename"><br>
                               </div>
                            </div>
                        </div>
                             <div id="inputMname">
                                <label for="">Date of Birth <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="date" name="Applicantbirthday" id="abirthday"><br>
                            </div>
                            <div id="inputMname">
                                <label for="">Address <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="Applicantaddress" id="aaddress"><br>
                            </div>
                            <div class="row">
                             <!-- Relationship to the deceased -->
                            <div class="col-md-6">
                              <div id="selectRtd">
                              <label class="label-head">Relationship to the deceased</label>
                               <select name="ApplicantRelDec" id="rdList" class="form-select" aria-label="Default select example">
                                <option selected>Select Relationship to the deceased...</option>
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
                                <option selected>Select Preferences for the body...</option>
                                <option value="Burial" validate="required">Burial</option>
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
                               <label for="">Contact Number <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="Applicantcontactnum" id="cnum"><br>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputEmail" validate="required">
                                <label for="">Email <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="Applicantemail" id="email" value="<?php echo $user['email']?>" readonly><br>
                               </div>
                            </div>
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

    
 

<script src="assets/js/validin.js"></script>
<script src="assets/js/bootstrap-imageupload.js"></script>


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
            $('.service-form').validin({});
            $('.consent-container').show();
          }else{
            $('.consent-input').attr('validate', '');
            $('.consent-input').removeAttr('required');
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

         $('#funeralDate').change(function(){
          $('#schedule').val($(this).val());
            $('.time').html(`
                      <div class="text-center py-5">
                         <div class='spinner spinner-border spinner-border-sm'></div>
                      </div> 
            `);
                 $.ajax({
                 url: 'ajax/funeral_time.php',
                 method: 'GET',
                 data: {date: $('#funeralDate').val()},
                 success: function(data){
                   $('.time').html(data);
                 } 
              })
          })

      })
</script>
<?php
$query = "SELECT * FROM funeral_form";
$result = mysqli_query($conn, $query);
$booked_dates = [];
while ($row = mysqli_fetch_assoc($result)) {
  $date = $row['sched_date'];
  $query = "SELECT * FROM funeral_form WHERE  sched_date = '$date' AND  
  (time_from = '09:00' AND time_to = '10:00' OR time_from = '10:00' AND time_to = '11:00' OR time_from = '11:00' AND time_to = '12:00')";
  if (strtotime(date('m/d/Y')) <= strtotime($date)) {
    $total_rows = mysqli_num_rows(mysqli_query($conn, $query)); 
    if ($total_rows == 3) {
        array_push($booked_dates, $date);
    }
  }
}
?>
<script>
    $('.spinner').hide();
      $(document).ready(function(){
        let dates = <?php echo json_encode(array_unique($booked_dates));?>;
        duDatepicker('#funeralDate', {
           range: false,
           clearBtn:true,
           minDate:'<?php echo date('m/d/Y', strtotime('1 day', strtotime(date('m/d/Y'))))?>',
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
</body>

</html>