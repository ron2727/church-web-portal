<?php
   require __DIR__ .'/../assets/database/connection.php';
   

   if (isset($_GET['date']) && isset($_GET['status'])) {
    $date = date('m/d/Y',strtotime($_GET['date']));
    $status = $_GET['status'];

    $query = "SELECT * FROM wedding_form WHERE sched_date = '$date' AND archived = 'no' AND status = '$status'";
   }
   if (isset($_GET['status']) && !isset($_GET['date'])) {
    $status = $_GET['status'];
    $query = "SELECT * FROM wedding_form WHERE archived = 'no' AND status = '$status'";
   }
   $result = mysqli_query($conn, $query);
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
                                          <td class="text-center"><span id="trackNum<?php echo $row['id']?>"><?php echo $row['tracking_number']?></span>&nbsp;<span class="btn-copy-text text-white bg-info badge rounded-pill" style="cursor:pointer;" data-clipboard-target="#trackNum<?php echo $row['id']?>">copy</span></td>
                                          <td class="text-center"><?php echo $row['sched_date'] === '0000-00-00' ? '<span class="text-danger">N/A</span>':date('F d, Y',strtotime($row['sched_date']));?></td>
                                          <td class="text-center"><?php echo date('g:i A',strtotime($row['time_from'])). ' ' .date('g:i A',strtotime($row['time_to']))?></td>
                                          <td class="text-center"><?php echo $row['groom_fname']?>&nbsp;<?php echo $row['groom_lname']?></td>
                                          <td class="text-center"><?php echo $row['groom_phone'] ?></td>
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
                                                         <?php
                                                           $query = 'SELECT * FROM reschedule_wedding WHERE tracking_number = "'.$row['tracking_number'].'"';
                                                           $requested =  mysqli_query($conn, $query);
                                                           $request = mysqli_fetch_assoc($requested);
                                                          ?>
                                                       
                                                        <div class="dropdown">
                                                        <?php if($row['status'] !== 'Completed'):?>
                                                            <?php if(mysqli_num_rows($requested) > 0):?>
                                                                <?php if($request['status'] === 'pending'):?>
                                                                  <button class="btnEdit btn badge rounded-pill" data-bs-toggle="dropdown" style="background:#EC2049;"> 
                                                                     <i class="bi bi-search"></i>    
                                                                      View
                                                                  </button>
                                                                <?php endif;?>
                                                             <?php else:?>
                                                              <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                                                <i class="bi bi-search"></i>    
                                                                View
                                                              </button>
                                                            <?php endif;?>
                                                       <?php else:?> 
                                                            <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                                                <i class="bi bi-search"></i>    
                                                                View
                                                           </button>
                                                       <?php endif;?>
                                                       
                                                         <ul class="dropdown-menu">
                                                           <li><a class="dropdown-item text-success" href="print_form.php?service=wedding&form_id=<?php echo $row['id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_wedding.php?form_id=<?php echo $row['id']?>"><i class="bi bi-pencil-fill"></i> Edit</a></li>
                                                           <li><a class="dropdown-item text-danger"  href="archived_service.php?service=wedding&form_id=<?php echo $row['id']?>"><i class="bi bi-archive-fill"></i> Archive</a></li>
                                                              <?php if($row['status'] !== 'Completed'):?>
                                                                  <?php if(mysqli_num_rows($requested) > 0):?>
                                                                    <?php if($request['status'] === 'pending'):?>
                                                                      <li><a class="dropdown-item text-danger"><i class="bi bi-calendar-plus"></i> Reschedule</a></li>
                                                                    <?php endif;?>
                                                                  <?php endif;?>
                                                              <?php endif;?>
                                                          </ul>
                                                        </div>
                                                      
                                                         <div class="dropdown">
                                                         <button class="btnDelete btn btn-danger badge rounded-pill" data-bs-toggle="dropdown">
                                                         <i class="bi bi-printer"></i> 
                                                          Print
                                                         </button>
                                                         <ul class="dropdown-menu">
                                                          <li><a class="dropdown-item text-success" href="print_form.php?service=wedding&form_id=<?php echo $row['id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                                          <li><a class="dropdown-item text-danger" href="wedding_certificate.php?form_id=<?php echo $row['id']?>" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> Certificate</a></li>
                                                         </ul>
                                                         </div>

                                                         <div>

                                                      
                                                         </div>
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