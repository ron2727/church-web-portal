<?php
require __DIR__. '/../assets/database/connection.php';
$track = $_GET['tracknum'];
$query = "SELECT * FROM reschedule_wedding WHERE tracking_number = '$track'";
$request = mysqli_query($conn, $query);
$request_data = mysqli_fetch_assoc($request);
?>
<?php if(mysqli_num_rows($request) > 0):?>
  <?php if($request_data['status'] === 'pending'):?>
       <?php $requested = true?>
      <h5>
        Requested Date
     </h5>
     <div class="row">
         <div class="col-md-6">
            <p style="font-weight: bold;">Wedding</p>
            <p>Date: <span style="font-weight: bold;"><?php echo date('F d, Y', strtotime($request_data['wedding_date']))?></span></p>
            <p>Time: <span style="font-weight: bold;"><?php echo $request_data['time_from']. ' to ' .$request_data['time_to']?></span></p>
         </div>
       <div class="col-md-6">
            <p style="font-weight: bold;">Rehersal</p>
            <p>Date: <span style="font-weight: bold;"><?php echo date('F d, Y', strtotime($request_data['rehersal_date']))?></span></p>
            <p>Time: <span style="font-weight: bold;"><?php echo $request_data['time_refrom']. ' to ' .$request_data['time_reto']?></span></p>
       </div>
     </div>
  <?php endif;?>
<?php endif;?>
<?php 
 $query = "SELECT * FROM wedding_form WHERE tracking_number = '$track'";
 $email = mysqli_fetch_assoc(mysqli_query($conn, $query));
?>
 <?php if(isset($requested)):?>
  <input type="hidden" name="requested" value="true">
 <?php endif;?>
 <input type="hidden" name="groom_email" value="<?php echo $email['groom_email']?>">
 <input type="hidden" name="bride_email" value="<?php echo $email['bride_email']?>">
 <input type="hidden" name="tracknum" value="<?php echo $track?>">
 <input type="hidden" name="service" value="wedding">
               <div class="row">
                     <div class="col-md-6">
                             <div class="text-center">
                                  <div id="inputDesWedDate">
                                     <label for="DesWedDate" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Select Wedding Date <span class="text-danger">*</span></label><br>
                                     <input type="text" id="alternate" size="30" disabled style="color: #121212;">
                                     <!-- <input validate="required" class="form-control" type="text" name="DesWedDate" id="dateSchedule" autocomplete="off"> -->
                                     <input type="hidden" id="schedule" name="DesWedDate">
                                     <div id="dateSchedule" class="d-flex justify-content-center"></div>
                                    <div class="mt-2">
                                      <span class="px-3 py-2" style="font-weight:bold;background:#dcfce7; color:#22c55e">
                                        Available 
                                      </span>
                                      <span class="px-3 py-2 ms-2" style="font-weight:bold;background:#fee2e2; color:#ef4444">
                                        Unavailable/Fully Booked
                                      </span>
                                    </div>
                                  </div>
                                  <br>
                                  <div class="wedtime-con">
                                     <label for="DesWedDate" class="time-label" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Wedding Time <span class="text-danger">*</span></label><br>  
                                        <div class="time mt-3 px-4">          
                                   
                                       </div>
                                   </div> 
                             </div>  
                        </div>      
                        <div class="col-md-6">
                             <div class="row" id="inputDateOfReher">
                               <p class="text-center" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Select Date of Rehearsal <span class="text-danger">*</span></p><br>
                             </div>
                        </div>
                </div>
<script>
        
          
        <?php 
          $query = "SELECT * FROM wedding_form";
          $result = mysqli_query($conn, $query);
        ?>
        var dates = [];
        <?php while($row = mysqli_fetch_assoc($result)):?>
             <?php
               $date = $row['sched_date'];
               $query = "SELECT * FROM wedding_form WHERE sched_date = '$date' AND  
                        (time_from = '09:00' AND time_to = '12:00' OR  time_from = '13:00' AND time_to = '16:00')";  
               $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
             <?php if ($total_rows === 2):?>
                  dates.push("<?php echo $row['sched_date']?>");
             <?php endif;?>

        <?php endwhile;?>
        
         function DisableDates(date) {
             var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
             return [dates.indexOf(string) == -1, "", "fully-booked"];
         }

        var today = new Date();
        var startingMonth = today.getMonth();
        var numOfDays = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
        var future_day = today.getDate() + 30;
        if (future_day > numOfDays) {
            future_day = future_day - numOfDays;
            startingMonth  = startingMonth + 1;
        }
        // alert('Month: ' + startingMonth + ' Day: ' + future_day);
        var dd = String(future_day).padStart(2, '0');
        var mm = String(startingMonth + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
 
        today = yyyy + '-' + mm + '-' + dd;
 
        $('#dateSchedule').datepicker({
            beforeShowDay: DisableDates,
            minDate: new Date(today),
            altField: "#alternate",
            altFormat: "DD, d MM, yy"
            // showAnim: "fold",
           })

 
</script>

<script>
    $('.spinner').hide();
      $(document).ready(function(){

         $('#dateSchedule').change(function(){
            $('#schedule').val($(this).val());
            $('.time').html(`
                       <div class="text-center py-5">
                           <div class='spinner spinner-border spinner-border-sm'></div>
                        </div>
            `);
            $('#dateReSchedule').prop('disabled', 'true');
            //  setTimeout(function() {
                $.ajax({
                 url: '../ajax/load_time.php',
                 method: 'GET',
                 data: {date: $('#dateSchedule').val()},
                 success: function(data){
                   $('.time').html(data);

                   $.ajax({
                   url: 'load_rehertime1.php',
                   method: 'GET',
                   data: {
                     stm: startingMonth,
                     ddd: today, 
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