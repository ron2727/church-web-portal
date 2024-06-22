<?php
require __DIR__ .'/../assets/database/connection.php';

$date = $_GET['date'];
$today = $_GET['ddd'];
$starting_month = $_GET['stm'];
?>

<!-- <label for="DateOfReher">Date of Rehearsal</label><br>
 <input class="form-control" validate="required" type="text" name="DateOfReher" id="dateReSchedule" autocomplete="off"><br>
 <div id="dateReSchedule"></div>
 <div class="rehertime d-flex justify-content-center">          
                                    
  </div>
   -->

             <div class="text-center">
                  <label for="DateOfReher" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Date of Rehearsal<span class="text-danger">*</span></label><br>
                  <input type="text" id="realternate" size="30" disabled style="color: #121212;">
                  <input type="hidden" id="ReSchedule" name="DateOfReher">
                  <div id="dateReSchedule" class="d-flex justify-content-center"></div>
                  <div class="mt-2">
                     <span class="px-3 py-2" style="font-weight:bold;background:#dcfce7; color:#22c55e">
                          Available 
                     </span>
                     <span class="px-3 py-2 ms-2" style="font-weight:bold;background:#fee2e2; color:#ef4444">
                        Unavailable/Fully Booked
                     </span>
                  </div>
                  <br>
             </div>
    
                   <p class="text-center" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Rehersal Time<span class="text-danger">*</span></p>
                   <div class="rehertime container-fluid px-5">          
                                    
                   </div>
   
 

 <script>

        var $startingMonth = "<?php echo $starting_month?>";
        var desDate = "<?php echo $date?>";
        var today = new Date();
        var maximumDate = '';
        var month, day, year;
          var selectedDate = desDate.split('/');
          [month, day, year] = selectedDate;
          mxday = day - 5;
          mnday = day - 10;
          
           maximumDate = month + "/" + mxday + "/" + year;
           if (mxday < 0) {
            mxmonth = month - 1;
            var days = new Date(today.getFullYear(), mxmonth, 0).getDate();
            mxday = days + mxday;
            maximumDate = mxmonth + "/" + mxday + "/" + year;
          }
          minimumDate = month + "/" + mnday + "/" + year;
          if (mnday < 0) {
            mnmonth = month - 1;
            var days = new Date(today.getFullYear(), mnmonth, 0).getDate();
            mnday = days + mnday;
            minimumDate = mnmonth + "/" + mnday + "/" + year;
          }
          
        //   minimumDate = desDate;
         
         //   alert("Month: " + month + " Day: " + day + " Year: " + year + " Date: ");
         $('#dateReSchedule').datepicker({
               dateFormat: "mm/dd/yy",
               altField: "#realternate",
               altFormat: "DD, d MM, yy",
               beforeShowDay: DisableDatesRe1,
               minDate: new Date(minimumDate),
               maxDate: new Date(maximumDate),
          })
 </script>

 <script>
         $('#dateReSchedule').change(function(){
           $('#ReSchedule').val($(this).val());
            $('.rehertime').html(`
                <div class="text-center py-4">
                   <div class='spinner spinner-border spinner-border-sm'></div>
                 </div>
            `);
              // setTimeout(function() {
                $.ajax({
                 url: 'ajax/get_rehertime.php',
                 method: 'GET',
                 data: {date: $('#dateReSchedule').val()},
                 success: function(data){
                   $('.rehertime').html(data);
                   
                 }
              });


 
            //  }, 3000)

         })

 </script>
 
 <script>
         <?php 
          $query = "SELECT * FROM wedding_form";
          $result = mysqli_query($conn, $query);
        ?>
        var dates1 = [];
        <?php while($row = mysqli_fetch_assoc($result)):?>
             <?php
               $date = $row['sched_redate'];
               $query = "SELECT * FROM wedding_form WHERE sched_redate = '$date' AND  
                        (time_refrom = '10:00' AND time_reto = '12:00' OR  time_refrom = '13:00' AND time_reto = '15:00')";  
               $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
             <?php if ($total_rows === 2):?>
                  dates1.push("<?php echo $row['sched_redate']?>");
             <?php endif;?>

        <?php endwhile;?>
        
         function DisableDatesRe1(date) {
             var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
             return [dates1.indexOf(string) == -1];
         }
  
 </script>