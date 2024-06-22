<?php
require __DIR__ .'/assets/database/connection.php';
date_default_timezone_set('Asia/Manila');
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit;
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
$user_data = mysqli_fetch_assoc(mysqli_query($conn, $query));

$tracking_number = 'TIC'.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9).''.rand(1, 9);

$current_month = date('m');
$current_year = date('Y');
$current_day = date('d');
$max_date = $current_month + 9;

if ($max_date > 12) {
  $current_month = $max_date - 12;
  $current_year = $current_year - 1;
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
    <link rel="stylesheet" href="assets/css/duDatepicker-theme.css">
    <link rel="stylesheet" href="assets/css/duDatepicker.css">
    <link href="assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Child Dedication</title>
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
        /* Date picker design */
        .dudp__date{
          background-color: #86efac !important;
          color: #15803d !important;
        }
        .disabled, .current{
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
                     
                    
                      <div class="container-fluid mt-5">
                      <form class="service-form" action="submit_form.php" method="POST" enctype="multipart/form-data">
                        <div id="inputTrackNum d-none">
                           <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id']?>">
                        </div>
                       
                        <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                           APPLICATION FOR CHILD DEDICATION
                        </div>
                        <div class="text-danger">
                          Fields with asterisks(*) are required
                      </div>
                        <div class="error" style="background: #fee2e2;">
                            <?php if(isset($_GET['error'])):?>
                              <p class="text-danger text-center py-2">Please choose your schedule and time</p>
                            <?php endif;?>
                        </div>
                        <div id="inputService">
                            <label for="">Service</label><br>
                            <input type="text" name="service" id="service" class="form-control" value="Baptism" readonly="true"><br>
                            <input type="text" name="type" id="type" class="form-control" value="child" readonly="true">
                        </div>
                         
                               <div class="row">
                                  <div class="col-md-6 border-bottom border-top py-2">
                                  <div id="inputDesWedDate">
                                     <label for="DesWedDate" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Baptism Schedule <span class="text-danger">*</span></label><br>
                                     <input type="text" id="schedule" name="baptismDate" class="form-control" data-theme="indigo" readonly>
                                      
                                    <div class="mt-2">
                                      <span class="indicator px-3 py-2" style="font-weight:bold;background:#dcfce7; color:#22c55e">
                                        Available 
                                      </span>
                                      <span class="indicator px-3 py-2 ms-2" style="font-size:0.8rem;font-weight:bold;background:#fee2e2; color:#ef4444">
                                         Fully Booked
                                      </span>
                                    </div>
                                  </div>
                                  </div>

                                   <div class="col-md-6 border-bottom border-top py-2">
                                   <label for="DesWedDate" class="time-label" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Baptism Time <span class="text-danger">*</span></label><br>
                                        <div class="time mt-3">          
                                          <h6 class="small text-muted text-center">Please select date first and available time will show here</h6>
                                       </div>
                                   </div>
                               </div>
                               <br>
                 

                         <div id="input" class="my-2">
                            <label for="relationship">Relationship to a child <span class="text-danger">*</span></label><br>
                             <select name="relationship" id="relationship" class="form-control">
                                 <option value="mother">Mother</option>
                                 <option value="father">Father</option>
                             </select>
                         </div>
                         <!-- name -->
                        <label class="label-head">Applicant's Name</label>
                        <div class="row">
                            <div class="col-md-6">
                              <div id="inputFname">
                               <label for="fname">Firstname <span class="text-danger">*</span></label><br>
                               <input class="form-control" validate="required" type="text" name="appli_fname" id="fname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div id="inputSname">
                                <label for="">Lastname <span class="text-danger">*</span></label><br>
                                <input class="form-control" validate="required" type="text" name="appli_lname" id="lname"><br>
                               </div>
                            </div>
                        </div>
                          <!--Applicant Address -->
                          <div id="inputappli_add">
                            <label for="appli_add">Address <span class="text-danger">*</span></label><br>
                            <textarea name="appli_add" id="appli_add" class="form-control" validate="required"></textarea>
                         </div>
                          <br>
                           <div id="inputSname">
                                <label for="appli_birthday">Date of Birth <span class="text-danger">*</span></label><br>
                                 <input type="date" class="form-control" min="2022-01-01" validate="required" name="appli_birthday" id="appli_birthday"><br>
                               </div>
                         
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
                             <br><br>
                            <!-- Pare Consent Form -->
                            <div class="consent-container container-fluid">
                                <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                                PARENT'S PARTICULARS     
                              </div>
                              <!-- Father Consent -->
                         <label class="label-head">Father</label>
                         <div class="row">
                         <div class="col-md-4">
                               <div id="inputSname">
                                <label for="">Surname <span class="text-danger">*</span></label><br>
                                <input validate="required" class="consent-input form-control" type="text" name="appli_Fatherlname" id="appli_Fatherlname"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Given Name <span class="text-danger">*</span></label><br>
                               <input validate="required" class="consent-input form-control" type="text" name="appli_FatherGname" id="appli_FatherGname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">English Name</label><br>
                               <input class="consent-input form-control" type="text" name="appli_FatherEname" id="fname"><br>
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
                            <input class="consent-input form-control" type="text" name="appli_fatherRel" id="appli_fatherRel"><br>
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
                                <input validate="required" class="consent-input form-control" type="text" name="appli_Motherlname" id="appli_Motherlname"><br>
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">Given Name <span class="text-danger">*</span></label><br>
                               <input validate="required" class="consent-input form-control" type="text" name="appli_MotherGname" id="appli_MotherGname"><br>
                               <small class="error"></small>
                             </div>
                            </div>
                            <div class="col-md-4">
                              <div id="inputFname">
                               <label for="fname">English Name</label><br>
                               <input class="consent-input form-control" type="text" name="appli_MotherEname" id="fname"><br>
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
                            <input class="consent-input form-control" type="text" name="appli_motherRel" id="appli_motherRel"><br>
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
                               <input validate="required|phone" class="consent-input form-control" type="text" name="appli_conum" id="cnum"><br>
                             </div>
                             <div id="inputappli_email">
                            <label for="appli_email">Email</label><br>
                            <input class="form-control" validate="required" type="text" name="appli_email" id="appli_email" value="<?php echo $user_data['email']?>" readonly><br>
                          </div>
                          <!-- Mother Consent End -->
                       </div>
                       <br>
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
                       <hr>
                      
                          <div class="container-fluid d-flex justify-content-center">
                            <button type="submit" class="btn btn-sub btn-primary px-5">Submit</button>
                         </div>
                     
                        <!-- end end end -->
                        </form>
                        </div>
                      </div>
  
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
 
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })  
</script>
 
<script>
  let fName = '<?php echo $user_data['firstname']?>'
  let lName = '<?php echo $user_data['lastname']?>'
  let email = '<?php echo $user_data['email']?>'
  
  $('#appli_Motherlname').val(lName);
  $('#appli_MotherGname').val(fName);
  $('#appli_Motherlname').attr('readonly', '');
  $('#appli_MotherGname').attr('readonly', '');

  $('#relationship').change(function(){
     if ($(this).val() == 'mother') {
      $('#appli_Motherlname').val(lName);
      $('#appli_MotherGname').val(fName);
      $('#appli_Motherlname').attr('readonly', '');
      $('#appli_MotherGname').attr('readonly', '');
      $('#appli_Fatherlname').val('');
      $('#appli_FatherGname').val('');
      $('#appli_Fatherlname').removeAttr('readonly');
      $('#appli_FatherGname').removeAttr('readonly');
     }
     if ($(this).val() == 'father') {
      $('#appli_Fatherlname').val(lName);
      $('#appli_FatherGname').val(fName);
      $('#appli_Fatherlname').attr('readonly', '');
      $('#appli_FatherGname').attr('readonly', '');
      $('#appli_Motherlname').val('');
      $('#appli_MotherGname').val('');
      $('#appli_Motherlname').removeAttr('readonly');
      $('#appli_MotherGname').removeAttr('readonly');
     }
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

<script>
    $('.spinner').hide();
      $(document).ready(function(){

         $('#schedule').change(function(){
          $('#schedule').val($(this).val());
            $('.time').html(`
                  <div class="text-center py-5">
                      <div class='spinner spinner-border spinner-border-sm'></div>
                  </div>
                 `);
                 $.ajax({
                 url: 'ajax/baptism_time.php',
                 method: 'GET',
                 data: {date: $('#schedule').val()},
                 success: function(data){
                   $('.time').html(data);
                 } 
              })
          })

      })
</script>

<?php
$query = "SELECT * FROM baptism_form";
$result = mysqli_query($conn, $query);
$booked_dates = [];
while ($row = mysqli_fetch_assoc($result)) {
  $date = $row['sched_date'];
  $query = "SELECT * FROM baptism_form WHERE baptism_type='child' AND sched_date = '$date' AND  
  (time_from = '09:00' AND time_to = '10:00' OR time_from = '10:00' AND time_to = '11:00')";  
  if (strtotime(date('m/d/Y')) <= strtotime($date)) {
    $total_rows = mysqli_num_rows(mysqli_query($conn, $query)); 
    if ($total_rows == 4) {
        array_push($booked_dates, $date);
    }
  }
}
?>

<script>
        let dates = <?php echo json_encode(array_unique($booked_dates));?>;
        duDatepicker('#schedule', {
           range: false,
           clearBtn:true,
           minDate:'today',
           disabledDates: dates,
           disabledDays: ['Monday', 'Tuesday', 'Wednesday', 'Thu', 'Fri', 'Sun'],
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
  
    
        
     
 
</script>



 
</html>