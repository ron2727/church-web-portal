<?php
require __DIR__ .'/../assets/database/connection.php';
session_start();

     if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
     $user_id = $_SESSION['user_id'];
     $old_password = $_POST['oldpassword'] ?? '';
     $new_password = $_POST['newpassword'] ?? '';
     
     $query = "SELECT * FROM user_account WHERE user_id = '$user_id' AND password = '$old_password'";
     $result = mysqli_query($conn, $query);

     if (mysqli_num_rows($result) > 0) {
        $query = "UPDATE user_account SET password = '$new_password' WHERE user_id = '$user_id'";
        mysqli_query($conn, $query);
        $success['success'] = '<p class="error text-center text-success py-2" style="background:#86efac;">Password successfully change</p>';
     }else{
        $error['incorrect'] = "<div class='text-danger'>Incorrect Password</div>";
     }
     }

 ?>
    
             <div class="modal-body">
                    <div id="changePassFormCon" class="p-1">
                    <?php echo $success['success'] ?? ''?>
                          <div id="inputField">
                            <label for="password" class="py-1">Old Password</label><br>
                           <input type="password" name="oldpassword" id="password" placeholder="Enter your new password" class="form-control" validate="required">
                            <?php echo $error['incorrect'] ?? ''?> 
                          </div>
                          <br>
                          <div id="inputField">
                            <label for="password" class="py-1">New password</label><br>
                           <input type="password" name="newpassword" id="password" placeholder="Enter your new password" class="match form-control" validate="required|min_length:8">
                          </div>
                          <div id="inputField">
                            <label for="repassword" class="py-1">Re-enter New password</label><br>
                           <input type="password" name="repassword" id="repassword" placeholder="Re-enter your new password" class="form-control" validate="match:.match">
                         </div>
                     </div>
             </div>

   
 
<script>
    $('#changePassForm').validin({
                custom_tests: {
              'match': {
		              	'regex': null,
			              'error_message': "This not match to your password"
	            	},
              
             }
             });
   
 </script>
                        

