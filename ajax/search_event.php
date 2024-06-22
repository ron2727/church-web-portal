<?php
require __DIR__. '/../assets/database/connection.php';

$event_search = date('F Y', strtotime($_GET['s']));
$is_event_exist = false;

$query = "SELECT * FROM event WHERE status='Past'";
$result = mysqli_query($conn, $query); 
?>
                 <!-- Event -->
               
                 <!-- Itong code nato ay para mapagsamasama yung lahat ng event by month -->

                 <!-- while para isa isahing icheck bawat month ng row -->
                  <?php while($row = mysqli_fetch_assoc($result)):?>
                     <?php $event_date = date('F Y', strtotime($row['date']))?>                
                            <!-- isa isahin ng icheck bawat month kung anong month -->
                            <?php if($event_search == $event_date):?>
                              <?php $is_event_exist = true; ?>
                     <div class="container-fluid bg-white mb-5">       
                       <div class="row">
                            <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <span class="text-info display-6"><?php echo $event_date?></span>
                             <div class="border border-primary bg-primary flex-grow-1" style="height:5px"></div>
                            </div>
                        </div>
                             <?php
                               $query = "SELECT * FROM event WHERE status='Past'";
                               $result = mysqli_query($conn, $query);
                             ?>
                             <!-- once nakapili na ng month ichecheck lahat ng event na kaparehong month sa nakapili-->
                            <?php while($row = mysqli_fetch_assoc($result)):?>
                              <?php $event_date = date('F Y', strtotime($row['date']))?> 
                              <!-- once nakaparehas isasama na sya sa list ng month na nakapili -->
                         <?php if ($event_search == $event_date):?>
                     <div class="container-fluid d-flex">
                        <div class=" px-4 pt-5 border border-end-0 border-top-0 border-bottom-0 border-5 border-primary">
                            <h4 class="text-center"><?php echo date('D', strtotime($row['date']))?></h4>
                            <h4 class="text-center display-6"><?php echo date('d', strtotime($row['date']))?></h4>
                        </div>
                       <div class="container-fluid">
                         <div class="row p-1 mb-3">
                            <div id="eventImage" class="col-md-4 rounded-3" style="background-image: url(assets/uploaded_images/event/<?php echo $row['image']?>);">        
                            </div>
                            <div id="eventBody" class="col-md-8 p-3 d-flex flex-wrap align-items-between">
                                <div>
                                <h1 class="event-title text-primary"><?php echo $row['title']?></h1>
                                <p class="event-place"><?php echo "@ ".$row['place']?></p>
                                <p class="event-date"><?php echo date('F d, Y', strtotime($row['date']))?></p>
                                <p class="event-time"><?php echo date('g:i A', strtotime($row['time']))?></p>
                                </div>
                                <div id="eventFooter" class="container-fluid d-flex justify-content-end">
                                  <a href="view_event.php?event_id=<?php echo $row['event_id']?>" class="nav-link">
                                  <button class="btn py-1 px-2 btn-primary">
                                  Read More
                                  </button>
                                  </a>
                               </div>
                            </div>
                         
                          </div>
                        </div>
                       </div> 

                                 <?php endif;?>
                            <?php endwhile;?>  
                            </div>
                         <?php endif;?>
                    
                  <?php endwhile;?>
                  <?php if(!$is_event_exist):?>
                    <div class="container-fluid d-flex justify-content-center">
                      <div>
                            There's no events that happened in this month
                      </div>
                   </div> 
                    <?php endif;?>
                
                 <!-- <div class="container-fluid d-flex justify-content-center">
                      <div>
                            To view past events you can search it by month
                      </div>
                </div>  -->
 