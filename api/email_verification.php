<?php
session_start();

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['password'] = $_POST['password'];
      $_SESSION['firstname'] = $_POST['firstname'];
      $_SESSION['lastname'] = $_POST['lastname'];
      $_SESSION['ministry'] = $_POST['ministry'];
      $_SESSION['certifcate'] = $_POST['certifcate'];
      $code = rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
      $_SESSION['vcode'] = $code;
}


?>
                    <div id="forgotPassCon" class="shadow rounded-3 bg-white">
                      <h4 class="p-3" style="border-bottom: 1px solid grey;">Email Verification</h4>
                      <div id="forgotFormCon" class="p-4">
                       <h1><?php echo $_SESSION['vcode'] ?? ''?></h1>
                       <form id="forgotForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                           <div id="inputField">
                            <label for="email" class="py-1">Please enter the code we sent to your email <?php echo $_SESSION['email']?></label><br>
                           <input type="text" name="code" id="email" placeholder="Enter the code" class="form-control <?php echo $errors['invalid'] ?? 0 ? 'error': '';?>" validate="required" value="<?php echo $_POST['email'] ?? ''?>">
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
                      </div>
                    </div>
              