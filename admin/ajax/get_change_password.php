<?php
require __DIR__ .'/../../assets/database/connection.php';

$user_id = $_GET['userid'];

$query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
$name = mysqli_fetch_assoc(mysqli_query($conn, $query));
?>                
                


                             <input id="userId" type="hidden" name="userid" value="<?php echo $user_id?>">
                                <div id="inputField">
                                   <label for="password">Name</label><br>
                                  <input class="border-0" type="text" value="<?php echo $name['firstname']. ' ' .$name['lastname']?>" readonly>
                                </div>
                                 <div id="inputField">
                                  <label for="password">New Password</label><br>
                                   <div class="d-flex align-items-center">
                                      <input required name="password" class="form-control password" id="password" type="password" placeholder="Enter your Password">
                                       <i class="show-pass bi bi-eye-slash" style="font-size: 1.2rem; position:absolute; right:30"></i>
                                   </div>
                                 </div>
                              <br>
                           </div>


<script>
      $('.show-pass').click(function(){
         if ($(this).hasClass('bi-eye-slash')) {
             $('.password').attr('type', 'text');
             $(this).removeClass('bi-eye-slash');
             $(this).addClass('bi-eye');
         }else{
            $('.password').attr('type', 'password');
             $(this).removeClass('bi-eye');
             $(this).addClass('bi-eye-slash');
         }
         $('.text').text($('.password').attr('type'));
      })
</script>