<?php
require __DIR__ .'/../assets/database/connection.php';

$date = $_GET['date'];
?>

       <div>
        <div class="form-check d-flex justify-content-between py-2">
          <?php
                $query = "SELECT * FROM funeral_form WHERE  sched_date = '$date' AND  
                         time_from = '09:00' AND time_to = '10:00'";  
               $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
          <?php if($total_rows > 0):?>
            <div class="mt-1">
              <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="0910" disabled>
              <label class="form-check-label text-danger" for="schedTime1" style="font-weight: bold;">
                09:00AM - 10:00AM 
              </label>
            </div>
            <div class="text-danger" style="font-weight: bold;font-size:1rem">
                Already Booked
            </div>
             
          <?php else:?>
            <div class="mt-1">
              <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="0910">
              <label class="form-check-label text-dark" for="schedTime1" style="font-weight: bold;">
                 09:00AM - 10:00AM
              </label>
            </div>
            <div class="text-success" style="font-weight: bold;font-size:1rem;">
                 Available
            </div>
          <?php endif;?>
          
       </div>

       <div class="form-check d-flex justify-content-between py-2">
   
          <?php
                $query = "SELECT * FROM funeral_form WHERE  sched_date = '$date' AND  
                         time_from = '10:00' AND time_to = '11:00'";  
               $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
          <?php if($total_rows > 0):?>
            <div class="mt-1">
              <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="1011" disabled>
              <label class="form-check-label text-danger" for="schedTime1" style="font-weight: bold;">
                 10:00AM - 11:00AM
              </label>
            </div>  
            <div class="text-danger" style="font-weight: bold;font-size:1rem">
                Already Booked
            </div>
          <?php else:?>
            <div class="mt-1">
              <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="1011">
              <label class="form-check-label text-dark" for="schedTime1" style="font-weight: bold;">
                10:00AM - 11:00AM
              </label>
            </div>
            <div class="text-success" style="font-weight: bold;font-size:1rem">
                 Available
            </div>
          <?php endif;?>
      
       </div>

       <div class="form-check d-flex justify-content-between py-2">
           <?php
                $query = "SELECT * FROM funeral_form WHERE  sched_date = '$date' AND  
                         time_from = '11:00' AND time_to = '12:00'";  
               $total_rows = mysqli_num_rows(mysqli_query($conn, $query));         
             ?>
          <?php if($total_rows > 0):?>
            <div class="mt-1">
              <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="1112" disabled>
              <label class="form-check-label text-danger" for="schedTime1" style="font-weight: bold;">
                11:00AM - 12:00PM
              </label>
            </div>
            <div class="text-danger" style="font-weight: bold;font-size:1rem">
                Already Booked
            </div>
          <?php else:?>
            <div class="mt-1">
              <input class="form-check-input" type="radio" name="schedTime" id="schedTime1" value="1112">
              <label class="form-check-label text-dark" for="schedTime1" style="font-weight: bold;">
                11:00AM - 12:00PM
              </label>
            </div>
            <div class="text-success" style="font-weight: bold;font-size:1rem">
                 Available
            </div>
            
          <?php endif;?>
      
       </div>
       </div>



