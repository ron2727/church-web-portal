<?php
require __DIR__. '/../assets/database/connection.php';
$track = $_GET['tracknum'];
$query = "SELECT * FROM reschedule_child WHERE tracking_number = '$track'";
$request = mysqli_query($conn, $query);
$request_data = mysqli_fetch_assoc($request);
?>
<?php if(mysqli_num_rows($request) > 0):?>
  <?php if($request_data['status'] === 'pending'):?>
       <?php $requested = true?>
      <h5>
        Requested Date
     </h5> 
            <p>Date: <span style="font-weight: bold;"><?php echo date('F d, Y', strtotime($request_data['baptism_date']))?></span></p>
            <p>Time: <span style="font-weight: bold;"><?php echo $request_data['time_from']. ' to ' .$request_data['time_to']?></span></p>
     </div>
  <?php endif;?>
<?php endif;?>
<?php 
 $query = "SELECT * FROM baptism_form WHERE tracking_number = '$track'";
 $email = mysqli_fetch_assoc(mysqli_query($conn, $query));
?>
 <?php if(isset($requested)):?>
  <input type="hidden" name="requested" value="true">
 <?php endif;?>
 <input type="hidden" name="appli_email" value="<?php echo $email['email']?>">
 <input type="hidden" name="tracknum" value="<?php echo $track?>">
 <input type="hidden" name="service" value="child">
 
                               <div class="row">
                                  <div class="col-md-6 py-2">
                                  <div id="inputDesWedDate">
                                     <label for="DesWedDate" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Baptism Schedule <span class="text-danger">*</span></label><br>
                                     <input type="text" id="alternate" class="form-control text-dark" size="30" disabled>
                                     <!-- <input validate="required" class="form-control" type="text" name="DesWedDate" id="dateSchedule" autocomplete="off"> -->
                                     <input type="hidden" id="schedule" name="baptismDate">
                                     <div id="baptismDate"></div>
                                    <div class="mt-2">
                                      <span class="indicator px-3 py-2" style="font-weight:bold;background:#dcfce7; color:#22c55e">
                                        Available 
                                      </span>
                                      <span class="indicator px-3 py-2 ms-2" style="font-weight:bold;background:#fee2e2; color:#ef4444">
                                        Unavailable/Fully Booked
                                      </span>
                                    </div>
                                  </div>
                                  </div>

                                   <div class="col-md-6 py-2">
                                   <label for="DesWedDate" class="time-label" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Baptism Time <span class="text-danger">*</span></label><br>
                                        <div class="time mt-3">          
                                   
                                       </div>
                                   </div>
                               </div>



<script>
    $('.spinner').hide();
      $(document).ready(function(){

         $('#baptismDate').change(function(){
          $('#schedule').val($(this).val());
            $('.time').html(`
                  <div class="text-center py-5">
                      <div class='spinner spinner-border spinner-border-sm'></div>
                  </div>
                 `);
                 $.ajax({
                 url: '../ajax/baptism_time.php',
                 method: 'GET',
                 data: {date: $('#baptismDate').val()},
                 success: function(data){
                   $('.time').html(data);
                 } 
              })
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
               $query = "SELECT * FROM baptism_form WHERE  sched_date = '$date' AND  
               (time_from = '09:00' AND time_to = '10:00' OR time_from = '10:00' AND time_to = '11:00')";  
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
            // minDate: new Date(today),
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                return [date.getDay() === 6 && dates.indexOf(string) == -1, 'dateDis', 'tooltip text'];
            }

        })
     
        
     
 
</script>