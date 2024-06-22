<?php
require __DIR__ .'/../assets/database/connection.php';

$date = $_GET['date'];
?>


       <div>
       <div class="d-flex justify-content-between mb-3">
          <?php
                $query = "SELECT * FROM wedding_form WHERE  sched_redate = '$date' AND  
                         time_refrom = '10:00' AND time_reto = '12:00'";  
               $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
          <?php if($total_rows > 0):?>
            <div>
              <input class="form-check-input" type="radio" name="schedTime1" id="schedTime2" value="1012" disabled>
               <label class="form-check-label text-danger" for="schedTime2" style="font-weight: bold;">
                 10:00 AM - 12:00 PM 
               </label>
            </div>
             
            <div class="text-danger" style="font-weight: bold;font-size:1rem">
               Already Booked
            </div>
          <?php else:?>
            <div>
              <input class="form-check-input" type="radio" name="schedTime1" id="schedTime2" value="1012">
              <label class="form-check-label text-dark" for="schedTime2" style="font-weight: bold;">
                 10:00 AM - 12:00 PM 
              </label>
            </div>

            <div class="text-success" style="font-weight: bold;font-size:1rem">
               Available
            </div>
          <?php endif;?>
          
       </div>

       <div class="d-flex justify-content-between mb-3">
           <?php
                $query = "SELECT * FROM wedding_form WHERE  sched_redate = '$date' AND  
                          time_refrom = '13:00' AND time_reto = '15:00'";  
                 $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
          <?php if($total_rows > 0):?>
            <div>
              <input class="form-check-input" type="radio" name="schedTime1" id="schedTime2" value="0103" disabled>
              <label class="form-check-label text-danger" for="schedTime2" style="font-weight: bold;">
                 01:00 PM - 03:00 PM 
              </label>
            </div>

            <div class="text-danger" style="font-weight: bold;font-size:1rem">
               Already Booked
            </div>
          <?php else:?>
             <div>
               <input class="form-check-input" type="radio" name="schedTime1" id="schedTime2" value="0103">
               <label class="form-check-label text-dark" for="schedTime2" style="font-weight: bold;">
                 01:00 PM - 03:00 PM 
               </label>
             </div>

             <div class="text-success" style="font-weight: bold;font-size:1rem">
                  Available
             </div>
          <?php endif;?>
      
       </div>
       </div>

 