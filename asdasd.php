<div class="dropdown-menu" aria-labelledby="dropdown01">
                <?php
                  $query = "SELECT * from `notifications` order by `date` DESC";
                  $result = mysqli_query($conn, $query);
                 ?>
                 <?php if(mysqli_num_rows($result)>0):?>
                <?php while ($i = mysqli_fetch_assoc($result)):?>
              <a style =" <?php $i['status']=='unread' ? "font-weight:bold;":''?>
                 
                         " class="dropdown-item" href="view.php?id=<?php echo $i['id'] ?>">
                <small><i><?php echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                  <?php 
                  
                if($i['type']=='comment'){
                    echo "Payment Successful!";
                }else if($i['type']=='like'){
                    echo ucfirst($i['name'])." liked your post.";
                }
                  
                  ?>
                </a>
              <div class="dropdown-divider"></div>
              <?php endwhile;?>
                <?php else:?>
                     echo "No Records yet.";
               <?php endif;?>
            </div>




            <li class="nav-item dropdown">
            <a class="nav-link text-dark " href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications 
                <?php
                $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
                $result = mysqli_query($conn, $query);
                 ?>
                 <?php if(mysqli_num_rows($result)>0):?>
                <span class="badge badge-danger"><?php echo count(fetchAll($query)); ?></span>
              <?php endif;?>
              </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
                <?php
                $query = "SELECT * from `notifications` order by `date` DESC";
                $result = mysqli_query($conn, $query);
                      
                ?>
                <?php  if(mysqli_num_rows($result)>0):?>
                    <?php while($i = mysqli_fetch_assoc($result)):?>
              <a style ="
                         <?php
                            if($i['status']=='unread'){
                                echo "font-weight:bold;";
                            }
                         ?>
                         " class="dropdown-item" href="view.php?id=<?php echo $i['id'] ?>">
                <small><i><?php echo date('F j, Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                  <?php 
                  
                if($i['type']=='comment'){
                    echo "Payment Successful!";
                }else if($i['type']=='like'){
                    echo ucfirst($i['name'])." liked your post.";
                }
                  
                  ?>
                </a>
              <div class="dropdown-divider"></div>
              <?php endwhile;?>
                <?php else:?>
                     <?php echo "No Records yet.";?>
                 <?php endif;?>
            </div>
          </li>