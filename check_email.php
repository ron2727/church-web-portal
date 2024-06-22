<?php
require __DIR__ .'/assets/database/connection.php';
     $email = $_POST['email'];
     $sql = "SELECT * FROM member where email = '$email'";
     $result = mysqli_query($conn, $sql);
?>
<?php if(!$row = mysqli_fetch_assoc($result)):?>
                    <p class="error text-center text-danger py-2" style="background:#fee2e2;">The email that have entered does not exist</p>
                      <form id="forgotForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                          <div id="inputField">
                            <label for="email" class="py-1">To forgot your password please enter you email below</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control error" validate="required|email" value="<?php echo $_POST['email'] ?? ''?>">
                         </div>
                          <br>
                         <div class="text-end">
                  
                           <a href="signin.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-secondary py-2" style="text-decoration: none;">
                               Cancel
                          </button>
                          </a>
                         <button id="btnSubmit" type="submit" class="btn btn-primary py-2">
                           <div id="btnSubSpin"></div> Submit
                         </button>
             
                         </div>
                     </form>
<?php else:?>
                      <form id="forgotForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                          <div id="inputField">
                            <label for="email" class="py-1">We sent a verification code to your email <?php $email?></label><br>
                           <input type="text" name="email" id="email" placeholder="Enter the code" class="form-control" validate="required">
                         </div>
                          <br>
                         <div class="text-end">
                  
                           <a href="signin.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-secondary py-2" style="text-decoration: none;">
                               Cancel
                          </button>
                          </a>
                         <button id="btnSubmit" type="submit" class="btn btn-primary py-2">
                           <div id="btnSubSpin"></div> Verify
                         </button>
             
                         </div>
                     </form>
<?php endif;?>