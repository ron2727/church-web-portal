<?php
   require __DIR__ .'/../assets/database/connection.php';
   if (isset($_GET['date']) && isset($_GET['time'])) {
     $date = date('m/d/Y',strtotime($_GET['date']));
     $time = $_GET['time'];
     if ($time === '09') {
      $time_from = "09:00";
      $time_to = "10:00";
       }
     if ($time === '10') {
         $time_from = "10:00";
         $time_to = "11:00";
       }
       $sql = "SELECT * FROM baptism_form WHERE baptism_type = 'child' AND archived = 'no' AND
       sched_date = '$date' AND time_from = '$time_from' AND time_to = '$time_to'";
   }
   if (isset($_GET['date']) && isset($_GET['time']) && isset($_GET['status'])) {
       $status = $_GET['status'];
       $date = date('m/d/Y',strtotime($_GET['date']));
       if ($time === '09') {
        $time_from = "09:00";
        $time_to = "10:00";
         }
       if ($time === '10') {
           $time_from = "10:00";
           $time_to = "11:00";
         }
         $sql = "SELECT * FROM baptism_form WHERE baptism_type = 'child' AND archived = 'no' AND
         sched_date = '$date' AND time_from = '$time_from' AND time_to = '$time_to' AND status = '$status'";
   }
   if (isset($_GET['status']) && !isset($_GET['date']) && !isset($_GET['time'])) {
      $status = $_GET['status'];
   
      $sql = "SELECT * FROM baptism_form WHERE baptism_type = 'child' AND archived = 'no' AND status = '$status'";
}
   
   $result = mysqli_query($conn, $sql);
?> 
                    <?php if(mysqli_num_rows($result) > 0):?>
                                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                                         <?php
                                          if ($row['status'] === 'Pending') {
                                              $bg_color = '#fee2e2';
                                          }elseif ($row['status'] === 'Approved') {
                                              $bg_color = '#fef3c7';
                                          }else {
                                              $bg_color = '#dcfce7';
                                          }
                                         ?>
                                        <tr style="background:<?php echo $bg_color?>;">
                                          <td class="text-center"><span id="trackNum<?php echo $row['form_id']?>"><?php echo $row['tracking_number']?></span>&nbsp;<span class="btn-copy-text text-white bg-info badge rounded-pill" style="cursor:pointer;" data-clipboard-target="#trackNum<?php echo $row['form_id']?>">copy</span></td>
                                          <td class="text-center"><?php echo date("F d, Y", strtotime($row['sched_date']))?></td>
                                          <td class="text-center"><?php echo $row['firstname']?>&nbsp;<?php echo $row['lastname']?></td>
                                          <td class="text-center"><?php echo date('g:i A',strtotime($row['time_from'])). ' ' .date('g:i A',strtotime($row['time_to']))?></td>
                                            <td class="text-center">
                                            <?php 
                                              if ($row['status'] === 'Pending') {
                                                echo '<span class="text-white bg-danger badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Approved') {
                                                echo '<span class="text-white bg-warning badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Completed') {
                                                echo '<span class="text-white bg-success badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                            ?>
                                          </td>
                                          <td class="d-flex justify-content-around">
                                                        <div class="dropdown">
                                                        <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                                        <i class="bi bi-search"></i>    
                                                         View
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                         <?php if($row['age'] < 18):?>
                                                           <li><h3 class="dropdown-header"><i class="bi bi-clipboard2-fill"></i>Form</h3></li>
                                                           <li><a class="dropdown-item text-muted" href="print_form.php?type=child&service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank">Baptism</a></li>
                                                            <li><h5 class="dropdown-header text-primary"><i class="bi bi-pencil-fill"></i> Edit</h5></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_baptism.php?type=child&service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank">Baptism</a></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_consent.php?type=child&service=consent&form_id=<?php echo $row['form_id']?>" target="_blank">Parent</a></li>
                                                          <?php else:?>
                                                           <li><a class="dropdown-item text-muted" href="print_form.php?service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_baptism.php?type=child&form_id=<?php echo $row['form_id']?>"><i class="bi bi-pencil-fill"></i> Edit</a></li>
                                                          <?php endif;?>
                                                           <li><a class="dropdown-item text-danger" href="archived_service.php?service=baptism&form_id=<?php echo $row['form_id']?>"><i class="bi bi-archive-fill"></i> Archive</a></li>
                                                         </ul>
                                                        </div>
                                                      
                                                         <div class="dropdown">
                                                         <button class="btnDelete btn btn-danger badge rounded-pill" data-bs-toggle="dropdown">
                                                         <i class="bi bi-printer"></i> 
                                                          Print
                                                         </button>
                                                         <ul class="dropdown-menu">
                                                          <li><a class="dropdown-item text-success"  href="print_form.php?type=child&service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                                          <li><a class="dropdown-item text-danger" href="baptism_certificate.php?type=child&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> Certificate</a></li>
                                                         </ul>
                                                         </div>
                                                         <!-- <a class="dropdown-item text-danger" href="#"><i class="bi bi-archive-fill"></i> Archive</a> -->
                                        </td>
                                        </tr>
                                        <?php endwhile;?>

                     <?php else:?>
                        <tr>
                          <td colspan="7" class="text-center py-3">
                             No <?php echo ucfirst($status)?> request
                          </td>
                        </tr>
                    <?php endif;?>