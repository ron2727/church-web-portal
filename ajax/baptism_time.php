<?php
 require __DIR__ .'/../assets/database/connection.php';

$date = $_GET['date'];
?>


    <div>
       <!-- 09-00 AM - 10:00PM -->
       <div class="form-check d-flex justify-content-between py-2">
          <?php
                $query = "SELECT * FROM baptism_form WHERE  sched_date = '$date'AND  
                time_from = '09:00' AND time_to = '10:00'";  
                $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
          <?php if($total_rows > 0):?>
            <?php if($total_rows < 2):?>
               <div class="mt-1">
                 <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="0910">
                 <label class="form-check-label text-success" for="schedTime1" style="font-weight: bold;">
                    09:00 AM - 10:00PM
                 </label>
               </div>
               <div class="text-success" style="font-weight: bold;font-size:1rem">
                 Available(<?php echo 2 - $total_rows?> Slot)
               </div>
            <?php endif;?>
            <?php if($total_rows === 2):?>
              <div class="mt-1">
                <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="0910" disabled>
                <label class="form-check-label text-danger" for="schedTime1" style="font-weight: bold;">
                   09:00 AM - 10:00PM 
                </label>
              </div>
              <div class="text-danger" style="font-weight: bold;font-size:1rem">
                   Fully Booked
              </div>
            <?php endif;?>
           
            <?php endif;?>

            <?php if($total_rows === 0):?>
               <div>
                  <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="0910">
                  <label class="form-check-label text-success" for="schedTime1" style="font-weight: bold;">
                   09:00 AM - 10:00PM 
                  </label>
              </div>
              <div class="text-success" style="font-weight: bold;font-size:1rem">
                   Available
              </div>
          <?php endif;?>
          
       </div>

       <div class="form-check d-flex justify-content-between py-2">
          <?php
                $query = "SELECT * FROM baptism_form WHERE  sched_date = '$date'AND  
                time_from = '10:00' AND time_to = '11:00'";  
                $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
          <?php if($total_rows > 0):?>
            <?php if($total_rows < 2):?>
               <div class="mt-1">
                  <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="1011">
                  <label class="form-check-label text-success" for="schedTime1" style="font-weight: bold;">
                    10:00 AM - 11:00PM
                  </label>
               </div>
               <div class="text-success" style="font-weight: bold;font-size:1rem">
                  Available(<?php echo 2 - $total_rows?> Slot)
               </div>
            <?php endif;?>
            <?php if($total_rows === 2):?>
               <div class="mt-1">
                  <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="1011" disabled>
                  <label class="form-check-label text-danger" for="schedTime1" style="font-weight: bold;">
                    10:00 AM - 11:00PM
                  </label>
               </div>
               <div class="text-danger" style="font-weight: bold;font-size:1rem">
                   Fully Booked
               </div>
            <?php endif;?>
           
            <?php endif;?>

            <?php if($total_rows === 0):?>
               <div class="mt-1">
                  <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="1011">
                  <label class="form-check-label text-success" for="schedTime1" style="font-weight: bold;">
                    10:00 AM - 11:00PM 
                 </label>
               </div> 
               <div class="text-success" style="font-weight: bold;font-size:1rem">
                  Available
               </div>
          <?php endif;?>
          
       </div>
 
  </div>