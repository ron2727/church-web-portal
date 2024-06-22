             
                     <?php
                       $current_date = date("Y-m-d");
                       $current_time = date("H:i:s");
                       $query = "SELECT * from forum_notification WHERE user_id = '$user_id' AND date = '$current_date' AND time = '$current_time'";
                       $result = mysqli_query($conn, $query)
                     ?>
                     

 
            <?php if(mysqli_num_rows($result) > 1):?>
              <?php
                $row = mysqli_fetch_assoc($result);
                $from = $row['source_id'];
                $query = "SELECT * FROM user_account WHERE user_id = $from";
                $notif_user = mysqli_fetch_assoc(mysqli_query($conn, $query));
              ?>
                <script>
                  $(document).ready(function(){
                $.toast({
                    bgColor: 'white',
                   hideAfter: 3000,
                   loader:false,
                   text: `
                     <div class="toast-notif row px-2 border shadow rounded-3">
                           <div class="text-dark px-2 pt-3" style="font-size: 1rem;font-weight:bold;">New notification</div>
                           <div class="col-sm-3 d-flex align-items-center">
                             <img  id="../assets/uploaded_images/baptism/<?php echo $notif_user['profile']?>" alt="buere">
                           </div>
                           <div class="col-sm-9 py-3" style="font-size: 0.9rem;">
                                   <span class="source-name text-secondary p-0" style="font-weight: bold;"><?php echo $notif_user['firstname'].' '.$notif_user['lastname']?></span>
                                   <span class="float-end"><i class="bi bi-dot text-primary" style="font-size: 3rem;"></i></span>
                                   <br>
                                   <?php if($notif_row['type'] === 'comment'):?>
                                    <span class="notif-type text-dark">commented to your post</span>
                                   <?php endif;?> 
                                   <br> 
                                  <span class="notif-date text-primary p-0 m-0">
                                      few seconds ago  
                                   </span>
                                 
                           </div>
                        </div>
                   `,
                }) 
                 })
                 </script>
              <?php endif;?>   




              <script>
                  $(document).ready(function(){
                   
                $.toast({
                    bgColor: 'white',
                   hideAfter: 3000,
                   loader:false,
                   text: `
                     <div class="toast-notif row px-2 border shadow rounded-3">
                           <div class="text-dark px-2 pt-3" style="font-size: 1rem;font-weight:bold;">New notification</div>
                           <div class="col-sm-3 d-flex align-items-center">
                             <img  id="../assets/uploaded_images/baptism/ " alt="buere">
                           </div>
                           <div class="col-sm-9 py-3" style="font-size: 0.9rem;">
                                   <span class="source-name text-secondary p-0" style="font-weight: bold;"> </span>
                                   <span class="float-end"><i class="bi bi-dot text-primary" style="font-size: 3rem;"></i></span>
                                   <br>
                                 
                                    <span class="notif-type text-dark">commented to your post</span>
                                  
                                   <br> 
                                  <span class="notif-date text-primary p-0 m-0">
                                      few seconds ago  
                                   </span>
                                 
                           </div>
                        </div>
                   `,
                }) 
                 })
                 </script>