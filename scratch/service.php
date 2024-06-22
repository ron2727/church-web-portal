<div class="container-fluid d-flex flex-wrap justify-content-center">

<div class="card m-2">
  <div class="card-body p-0">
      <div class="img-container w-100" style="background-image:url('assets/img/baptism.jpg');height:100%"></div>
  </div>
  <div class="card-footer bg-white py-3">
  <h5 class="card-title text-center text-grey">Baptism</h5>
      <div class="container d-flex justify-content-center">
      <a href="service_form.php"><button class="btn btn-secondary px-5">Proceed</button></a>
      </div>
  </div>
 </div>
 
 <div class="card m-2">
  <div class="card-body p-0">
      <div class="img-container w-100" style="background-image:url('assets/img/alden.jpg');height:100%"></div>
  </div>
  <div class="card-footer bg-white py-3">
  <h5 class="card-title text-center text-grey">Wedding</h5>
      <div class="container d-flex justify-content-center">
      <a href="service_form.php"><button class="btn btn-secondary px-5">Proceed</button></a>
      </div>
  </div>
 </div>

 <div class="card m-2">
  <div class="card-body p-0">
      <div class="img-container w-100" style="background-image:url('assets/img/alden2.jpg');height:100%"></div>
  </div>
  <div class="card-footer bg-white py-3">
  <h5 class="card-title text-center text-grey">Funeral</h5>
      <div class="container d-flex justify-content-center">
      <a href="service_form.php"><button class="btn btn-secondary px-5">Proceed</button></a>
      </div>
  </div>
 </div>

 <div class="card m-2">
  <div class="card-body p-0">
      <div class="img-container w-100" style="background-image:url('assets/img/alden2.jpg');height:100%"></div>
  </div>
  <div class="card-footer bg-white py-3">
  <h5 class="card-title text-center text-grey">Confirmation</h5>
      <div class="container d-flex justify-content-center">
      <a href="service_form.php"><button class="btn btn-secondary px-5">Proceed</button></a>
      </div>
  </div>
 </div>

 <div class="card m-2">
  <div class="card-body p-0">
      <div class="img-container w-100" style="background-image:url('assets/img/alden2.jpg');height:100%"></div>
  </div>
  <div class="card-footer bg-white py-3">
  <h5 class="card-title text-center text-grey">Holiday</h5>
      <div class="container d-flex justify-content-center">
      <a href="service_form.php"><button class="btn btn-secondary px-5">Proceed</button></a>
      </div>
  </div>
 </div>


 
</div>


<main>
            <div class="container mt-5">
                <div class="row">
                    <div id="loginImg" class="col-md-7">
                        <h4 id="signinText" class="display-5">Sign In to Forums</h4>
                        <h5 id="signinText1" class="p-5">
                            The Christian experience, from start to finish, is a journey of faith.
                        </h5>
                    </div>

                    <div class="col-md-5 border p-5 bg-white">
                      <?php echo $errors['invalid'] ?? ''?> <!-- error if account does not exist -->
                     <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                          <div id="inputField">
                            <label for="email">Email</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control <?php echo ($errors['email'] ?? 0 ? 'is-invalid':'')?>" value="<?php echo $_POST['email'] ?? ''?>">
                           <small class="text-danger"><?php echo $errors['email'] ?? ''?></small>
                          </div>
                          <br>
                          <div id="inputField">
                            <label for="password">Password</label><br>
                            <input type="password" name="password" id="password" placeholder="Enter your Password" class="form-control <?php echo ($errors['password'] ?? 0 ? 'is-invalid':'')?>">
                            <small class="text-danger"><?php echo $errors['password'] ?? ''?></small>
                          </div>
                          <br>
                         <button id="btnSubmit" type="submit" class="btn btn-primary form-control py-2">
                            Sign In
                         </button>
                     </form>
                    </div>
                </div>
            </div>
     </main>





     <div class="container mt-5" style="font-family:Poppins;">
                        <!-- Event -->

                        
                        <?php
                        $query = "SELECT * FROM event WHERE status='Upcoming'";
                        $result = mysqli_query($conn, $query); 
                        ?>
                      <?php while($row = mysqli_fetch_assoc($result)):?>
                      <?php
                        $date = explode('-', $row['date']);
                        [$year, $month, $day] = $date;
                        ?>  
                      <div class="container-fluid bg-white mb-5">      
                       <div class="row">
                            <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <span class="text-info display-6"><?php echo $months[$month]." $year"?></span>
                             <div class="border border-primary bg-primary" style="width: 70%; height:5px"></div>
                            </div>
                        </div>
                        <!-- Events -->
                       <div class="container-fluid d-flex py-2">
                        <div class=" px-4 pt-5 border border-end-0 border-top-0 border-bottom-0 border-5 border-primary">
                            <h4 class="text-center"><?php echo date('D', strtotime($row['date']))?></h4>
                            <h4 class="text-center display-6"><?php echo $day?></h4>
                        </div>
                       <div class="container-fluid">
                         <div class="row p-1 mb-3">
                            <div id="eventImage" class="col-md-4 rounded-3" style="background-image: url(assets/uploaded_images/event/<?php echo $row['image']?>);">        
                            </div>
                            <div id="eventBody" class="col-md-8 p-3 d-flex flex-wrap align-items-between">
                                <div>
                                <h4 class="display-6"><?php echo $row['title']?></h4>
                                <p><?php echo $row['place']?></p>
                                <p><?php echo $row['description']?></p>
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

                    </div>
                  <?php endwhile;?>
                </div>














                     <div class="container-fluid border">
                          <div class="row">
                            <div id="serviceImage" class="col-md-4" style="background-image: url(assets/img/<?php echo $row['service']?>.jpg);">        
                            </div>
                            <div id="eventBody" class="col-md-8 p-3">
                                <div class="container-fluid d-flex justify-content-end">
                                  <span id="trackNum"><?php echo $row['track_number']?></span>
                                </div>
                                <h6 class="display-6 pb-3">
                                  <span>Service:&nbsp;</span> <span id="serviceName"><?php echo $row['service']?></span>
                                </h6>
                                <p>
                                  <span>Requested by:&nbsp;</span> <span id="from"><?php echo $row['applicant_fname'].' '.$row['applicant_lname']?></span> 
                                </p>
                                 <p>
                                  <span>Scheduled:&nbsp;</span> <span id="schedDate">January 11 2023 @</span><span id="schedTime">11:00am - 1:00pm</span>
                                 </p>
                                 <p>
                                  <span>Status:&nbsp;</span><span id="status" class="text-danger">Pending</span>
                                 </p>
                            </div>
                          </div>
                        </div>





                        <?php if(!empty(($_GET['search']))):?>
                <!-- Event -->
                    <?php $event_search = date('F Y', strtotime($_GET['search']))?>
                    <?php $is_event_exist = false; ?>
                        <?php
                        $query = "SELECT * FROM event WHERE status='Past'";
                        $result = mysqli_query($conn, $query); 
                        ?>
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
                
             <?php else:?>
                <div class="container-fluid d-flex justify-content-center">
                      <div>
                            To view past events you can search it by month
                      </div>
                </div> 
                    <?php endif;?>

                    
            </div>



            <nav id="mainNav" class="navbar navbar-expand-md" style="background-color: #3F4359;opacity: 0.8">
        <div class="container-fluid d-flex justify-content-between p-3">
            <a id="logo" class="navbar-brand text-light">Taytay Immanuel Church</a>
               <ul class="navbar-nav">
                  <li class="nav-item"><a href="index.php" class="nav-link text-light">Home</a></li>
                  <li class="nav-item"><a href="services.php" class="nav-link text-light">Services</a></li>
                  <li class="nav-item"><a href="event.php" class="nav-link text-light">Events</a></li>
                  <li class="nav-item"><a href="aboutus.php" class="nav-link text-light">About Us</a></li>
                  <li class="nav-item"><a href="forum.php" class="nav-link text-light" style="font-weight: bold;">Forum</a></li>
              </ul>        
        </div>
      </nav>
       <!-- Arrow down -->
       <div id="arrow" class="container-fluid btn text-center" data-bs-toggle="collapse" data-bs-target="#mainNav"> 
         <div id="arrowIcon" class="down">
           <i class="bi bi-chevron-down"></i>
         </div>
      </div>
        
      <nav class="navbar navbar-expand-sm">
       <div class="container-fluid shadow-sm px-5 pb-3 mb-5">
           <a href="" class="navbar-brand" style="font-size: 1.5rem;">Forum</a>
           <div id="profile" class="dropdown d-flex align-items-center" data-bs-toggle="dropdown" data-bs-target="#profile" style="cursor: pointer;">
                <img src="assets/img/alden3.jpg" alt="buere">
               <span class="px-2">
                John Ron Buere
               </span>
               <ul class="dropdown-menu">
                 <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i>&nbsp; My Profile</a></li>
                 <li><a class="dropdown-item" href="user_settings.php"><i class="bi bi-gear"></i>&nbsp; User Settings</a></li>
                 <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left"></i>&nbsp; Logout</a></li>
              </ul>
           </div>
       </div>
      </nav>




      $query = "SELECT user_account.user_id, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, comment.date, comment.time, comment.comment
                        FROM user_account
                        INNER JOIN comment ON user_account.user_id = comment.user_id
                        WHERE comment.post_id = $post_id
                        ORDER BY comment.date ASC;";
               $result = mysqli_query($conn, $query); 











                           <!-- <script>
                $('.reply-container').hide();
                $('.btn-reply').click(function(){
                 $(this).parent().children('div.reply-container').show();
              })
               $('.btn-reply').click(function(){
                   let commentUserId = $(this).parent().children('input#comment_userid').val();
                 let commentID = $(this).parent().children('input#commentId').val();
                 let reply = $(this).parent().children('input#reply').val();
                 $(this).parent().children('input#reply').val('');
                 $.ajax({
                url: 'ajax/reply.php',
                method: 'POST',
                data: {
                  comment_userid: commentUserId,
                  comment_id: commentID,
                  reply: reply,
                 },
                success: function(data){
                  //  $('#commentContainer').prepend(data)
                  //  $('#btnComment').attr('disabled', 'true');
                  //  $('#comment').val('');
                 }
             })
           })

           $('.btn-view-replies').click(function(){
                 let commentId = $(this).attr('comment-id');
                 let elem = $(this)
                 elem.attr('disabled', true);
                $.ajax({
                  url: 'ajax/get_replies.php',
                  method: 'GET',
                  data:{comment_id: commentId},
                  success: function(data){
                    elem.parent().siblings().html(data)
                  }
                })
           })
            </script> -->