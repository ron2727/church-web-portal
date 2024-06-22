<?php
require __DIR__ .'/../assets/database/connection.php';
session_start();
     $user_id = $_SESSION['user_id'];
       
     if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
       $bio = $_POST['bio'];
       $query = "UPDATE user_account SET bio = '$bio' WHERE user_id = '$user_id'";
       mysqli_query($conn, $query);
       $success['success'] = '<p class="error text-center text-success py-2" style="background:#86efac;">Saved</p>';
     }
     $query = "SELECT bio FROM user_account WHERE user_id = '$user_id'";
     $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
 ?>


              <div class="modal-body">
                    <div id="editBioFormCon" class="p-4">
                       <?php echo $success['success'] ?? ''?>
                           <div id="inputField">
                            <label for="password" class="py-1">Edit Bio</label><br>
                            <textarea name="bio" id="bio" row="10" class="form-control"><?php echo $row['bio']?></textarea>
                           </div>
                           <!-- <div class="limit-text"><span class="current">0</span>/<span class="limit">50</span></div> -->
                     </div>
               </div>

               <script>
            // let bioLenght = '<?php echo $row['bio']?>';
            //  let limit = bioLenght.length;
            //  $('.current').text(limit);
          
            //       $('#bio').keyup(function(){
                 
            //      if (limit === 50) {
            //        $('#bio').attr('readonly', 'true');
            //      }else{
            //       limit = limit + 1;
            //      $('.current').text(limit);
            //       $('#bio').removeAttr('readonly');
            //      }
            //  })
 
              
               </script>
