<div class="container-fluid h-20 d-flex justify-content-between px-3 py-3 border-bottom bg-primary">
                     <h5 class="text-light">TAYTAY IMMANUEL CHURCH WEB PORTAL</h5>
                    <div class="dropdown text-light">
                       <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                          <span style="font-weight: bold;"><?php echo $row['firstname'].' '.$row['lastname']?></span>
                          <span style="margin-left:5px; font-size:25px">
                            <img src="../assets/uploaded_images/profile/<?php echo $row['profile']?>" style="width: 40px; height: 40px; border-radius: 50%;">
                           </span>
                       </div>
                        <ul class="dropdown-menu">
                          <li><a href="../logout.php" class="dropdown-item"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </div>
            </div>