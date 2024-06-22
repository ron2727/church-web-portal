<?php
 require __DIR__ .'/../assets/database/connection.php';

  $user_id = $_POST['userid'];
  $date_duration = $_POST['date'];
  $time_duration = $_POST['time'];

  $query = "UPDATE user_account SET status = 'Banned' WHERE user_id = '$user_id'";
  mysqli_query($conn, $query);

  $query = "INSERT INTO ban_duration(user_id, date_duration, time_duration) 
            VALUES('$user_id', '$date_duration', '$time_duration')";
  mysqli_query($conn, $query);

  $query = "DELETE FROM reported_member WHERE user_id = '$user_id'";
  mysqli_query($conn, $query);
?>

                       <div class="modal-header">
                          <h4 class="text-center">Account was successfully banned</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                             <div class="modal-body">
                                <div class="py-3 px-5">
                                     <p class="text-center">
                                       <i class="bi bi-check-circle-fill" style="font-size:2rem;color:#38bdf8;"></i>
                                     </p>
                                     <br>
                                     <h5>Account will be available on</h5>
                                     <p style="font-size:1.1rem">Date: <?php echo date('F d, Y', strtotime($date_duration))?></p>
                                     <p style="font-size:1.1rem">Time: <?php echo date('g:i A', strtotime($time_duration))?></p>
                                 </div>
                            </div>
                           <div class="modal-footer">
                              <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                                 