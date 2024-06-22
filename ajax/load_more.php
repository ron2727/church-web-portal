<?php
require __DIR__ .'/../assets/database/connection.php';
session_start();
$user_id = $_SESSION['user_id'];
$query = 'SELECT ministry FROM user_account WHERE user_id = "'.$user_id.'"';
$ministry = mysqli_fetch_assoc(mysqli_query($conn, $query));
$user_group = $ministry['ministry'];
?>

      <?php if($_GET['page'] === 'forum'):?>
           <?php
            $start_from = $_GET['start'];
            $limit = 5;
            $num = $start_from;
            $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time,topics.topic_id, topics.topic, post.privacy, post.text, post.post_id, post.views 
                                     FROM user_account 
                                     INNER JOIN post ON post.user_id = user_account.user_id 
                                     INNER JOIN topics ON post.topic_id = topics.topic_id
                                     WHERE post.status != 'Banned' AND post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group'
                                     ORDER BY date DESC, time DESC
                                     LIMIT $start_from, $limit";
            if ($_GET['filter'] === 'latest') {
               $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time,topics.topic_id, topics.topic, post.privacy, post.text, post.post_id, post.views 
                   FROM user_account 
                   INNER JOIN post ON post.user_id = user_account.user_id 
                   INNER JOIN topics ON post.topic_id = topics.topic_id
                   WHERE post.status != 'Banned' AND post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group'
                   ORDER BY date DESC, time DESC
                   LIMIT $start_from, $limit";
              }
              if ($_GET['filter'] === 'top') {
               $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time,topics.topic_id, topics.topic, post.privacy, post.text, post.post_id, post.views 
                   FROM user_account 
                   INNER JOIN post ON post.user_id = user_account.user_id 
                   INNER JOIN topics ON post.topic_id = topics.topic_id
                   WHERE post.status != 'Banned' AND post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group'
                   ORDER BY views DESC
                   LIMIT $start_from, $limit";
              }
             $result = mysqli_query($conn, $query);
            ?>
              <?php while($row = mysqli_fetch_assoc($result)):?>
                 <a href="view_post.php?post_id=<?php echo $row['post_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex align-items-center">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill">Admin</span>
                              <?php endif;?>
                                 </div>
                                
                                <div id="date" class="text-grey" style="font-size: 0.8rem;">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                     <i class="bi bi-dot"></i>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i>
                               <?php endif;?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 m-auto">
                            <div>
                            <?php
                       $query = 'SELECT status FROM topics WHERE topic_id = '.$row['topic_id'].'';
                       $status = mysqli_fetch_assoc(mysqli_query($conn, $query));
                     ?>
                     <?php if($status['status'] === 'Banned'):?>
                        <h4 class="topic text-dark">[Unavailable]</h4>
                     <?php else:?>
                          <h4 class="topic text-dark"> <?php echo $row['topic']?></h4>
                      <?php endif;?>  
                             </div>
                        </div>

                        <div class="col-md-2 d-flex align-items-center">
                              <?php 
                                $post_id = $row['post_id'];
                                $query = "SELECT comment.comment
                                          FROM comment
                                          INNER JOIN post ON comment.post_id = post.post_id
                                          WHERE post.post_id = $post_id";
                                $total_comments = mysqli_num_rows(mysqli_query($conn, $query)); 
                              ?>
                                 <div id="reaction">
                                   <div>
                                   <i id="btnHeart" class="bi bi-heart"></i>&nbsp;
                                     <?php
                                      $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
                                      $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
                                     ?>
                                      <?php echo $total_likes?>
                                   </div>
                                   <div>
                                   <i class="bi bi-chat-left"></i>&nbsp;
                                   <span id="like"><?php echo $total_comments?></span>
                                   </div>
                                   <div>
                                  
                                   <i class="bi bi-eye"></i></i>&nbsp;
                                   <span id="like"><?php echo $row['views']?></span>
                                   </div> 
                                 </div>
                        </div>
                     </div>
                 </a>
               <?php endwhile;?>
                    
       <?php endif;?>      

       <?php if($_GET['page'] === 'view_topic'):?>
          <?php
              $topic_id = $_GET['topic_id'];
              $start_from = $_GET['start'];
              $limit = 3;
              $num = $start_from;
              $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
              $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
              $user_group = $group['ministry'];

              $topic_id = $_GET['topic_id'];
              $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, topics.topic,post.privacy, post.text, post.post_id, post.views, user_account.user_id 
              FROM user_account 
              INNER JOIN post ON post.user_id = user_account.user_id 
              INNER JOIN topics ON post.topic_id = topics.topic_id
              WHERE topics.topic_id = $topic_id AND post.status != 'Banned'
              AND (post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group')
              LIMIT $start_from, $limit";
              $result = mysqli_query($conn, $query);
              $total_post = mysqli_num_rows($result)
             ?>
                  <?php while($row = mysqli_fetch_assoc($result)):?>
                 <a href="view_post.php?post_id=<?php echo $row['post_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex align-items-center">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill ms-2">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill ms-2">Pastor</span>
                              <?php endif;?>
                                 </div>
                                
                                <div id="date" class="text-grey" style="font-size: 0.9rem;">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                    <i class="bi bi-dot"></i>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i>
                               <?php endif;?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 m-auto">
                            <div>
                            <h5 class="post-topic"><?php echo $row['topic']?></h5>
                             <!-- <div>
                                <span id="tagName" class="badge rounded-pill bg-warning">Thankful</span>
                                <span id="tagName" class="badge rounded-pill bg-info ms-2">Feeling Blessed</span>
                             </div> -->
                            </div>
                        </div>

                             <div class="col-md-2 d-flex align-items-center">
                              <?php 
                                $post_id = $row['post_id'];
                                $query = "SELECT comment.comment
                                          FROM comment
                                          INNER JOIN post ON comment.post_id = post.post_id
                                          WHERE post.post_id = $post_id";
                                $total_comments = mysqli_num_rows(mysqli_query($conn, $query)); 
                              ?>
                                 <div id="reaction">
                                   <div>
                                   <i id="btnHeart" class="bi bi-heart"></i>&nbsp;
                                     <?php
                                      $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
                                      $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
                                     ?>
                                      <?php echo $total_likes?>
                                   </div>
                                   <div>
                                   <i class="bi bi-chat-left"></i>&nbsp;
                                   <span id="like"><?php echo $total_comments?></span>
                                   </div>
                                   <div>
                                  
                                   <i class="bi bi-eye"></i></i>&nbsp;
                                   <span id="like"><?php echo $row['views']?></span>
                                   </div> 
                                 </div>
                        </div>
                     </div>
                 </a>
               <?php endwhile;?>
       <?php endif;?>


       <?php if($_GET['page'] === 'view_profile'):?>
          <?php
              $start_from = $_GET['start'];
              $limit = 3;
              $num = $start_from;
    
              if ($user_id === $_GET['user_id']) {
                 $user_id = $_GET['user_id'];
                 $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, post.views, post.privacy, topics.topic_id, topics.topic, post.text, post.post_id, user_account.user_id 
                           FROM user_account 
                           INNER JOIN post ON post.user_id = user_account.user_id 
                           INNER JOIN topics ON post.topic_id = topics.topic_id
                           WHERE user_account.user_id = '$user_id'
                           LIMIT $start_from, $limit";
               }else{
                  $user_id = $_GET['user_id'];
                  $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, post.views, post.privacy, topics.topic_id, topics.topic, post.text, post.post_id, user_account.user_id 
                            FROM user_account 
                            INNER JOIN post ON post.user_id = user_account.user_id 
                            INNER JOIN topics ON post.topic_id = topics.topic_id
                            WHERE user_account.user_id = '$user_id'
                            AND (post.privacy = 'Anyone' OR post.privacy = 'Locked' OR post.privacy = '$user_group')
                            LIMIT $start_from, $limit";
                }
                    $result = mysqli_query($conn, $query);
              ?>
              <?php while($row = mysqli_fetch_assoc($result)):?>
                 <a href="view_post.php?post_id=<?php echo $row['post_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex align-items-center">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill ms-2">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill ms-2">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill ms-2">Admin</span>
                              <?php endif;?>
                                 </div>
                                
                                <div id="date" class="text-grey" style="font-size: 0.9rem;">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                    <i class="bi bi-dot"></i>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i>
                               <?php endif;?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 m-auto">
                            <div>
                            <?php
                       $query = 'SELECT status FROM topics WHERE topic_id = '.$row['topic_id'].'';
                       $status = mysqli_fetch_assoc(mysqli_query($conn, $query));
                     ?>
                     <?php if($status['status'] === 'Banned'):?>
                        <h4 class="topic text-dark">[Unavailable]</h4>
                     <?php else:?>
                          <h4 class="topic text-dark"> <?php echo $row['topic']?></h4>
                      <?php endif;?>  
                             </div>
                        </div>

                        
                        <div class="col-md-2 d-flex align-items-center">
                              <?php 
                                $post_id = $row['post_id'];
                                $query = "SELECT comment.comment
                                          FROM comment
                                          INNER JOIN post ON comment.post_id = post.post_id
                                          WHERE post.post_id = $post_id";
                                $total_comments = mysqli_num_rows(mysqli_query($conn, $query)); 
                              ?>
                                 <div id="reaction">
                                   <div>
                                   <i id="btnHeart" class="bi bi-heart"></i>&nbsp;
                                     <?php
                                      $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
                                      $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
                                     ?>
                                      <?php echo $total_likes?>
                                   </div>
                                   <div>
                                   <i class="bi bi-chat-left"></i>&nbsp;
                                   <span id="like"><?php echo $total_comments?></span>
                                   </div>
                                   <div>
                                  
                                   <i class="bi bi-eye"></i></i>&nbsp;
                                   <span id="like"><?php echo $row['views']?></span>
                                   </div> 
                                 </div>
                        </div>
                     </div>
                 </a>
               <?php endwhile;?>
     
       <?php endif;?>


       <?php if($_GET['page'] === 'view_profile_topic'):?>
             <?php
                $user_id = $_GET['start'];
                $start_from = $_GET['start'];
                $limit = 3;


                if ($_SESSION['user_id'] === $_GET['user_id']) {
                  $user_id = $_GET['user_id'];
                  $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, user_account.user_id, topics.topic_id, topics.topic, topics.description, topics.date, topics.time, topics.privacy
                  FROM user_account
                  INNER JOIN topics ON user_account.user_id = topics.user_id
                  WHERE topics.user_id = '$user_id'
                  LIMIT $start_from, $limit";
                }else {
                  $user_id = $_GET['user_id'];
                  $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, user_account.user_id, topics.topic_id, topics.topic, topics.description, topics.date, topics.time, topics.privacy
                  FROM user_account
                  INNER JOIN topics ON user_account.user_id = topics.user_id
                  WHERE topics.user_id = '$user_id' AND topics.privacy = 'Anyone' OR topics.privacy = '$user_group'
                  LIMIT $start_from, $limit";
                }
                $result = mysqli_query($conn, $query);
              ?>

            <?php if($row = mysqli_num_rows($result)):?>
               <div id="topicList">
             <?php while($row = mysqli_fetch_assoc($result)):?>  
                 <a href="view_topic.php?topic_id=<?php echo $row['topic_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill ms-2">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill ms-2">Pastor</span>
                              <?php endif;?>
                                 </div>
                                
                                <div id="date" class="text-grey" style="font-size: 0.8rem;">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                    <i class="bi bi-dot"></i>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i>
                               <?php endif;?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 py-3 d-flex align-items-center">
                            <div>
                            <h5 class="post-topic"><?php echo $row['topic']?></h5>
                            <p><?php echo $row['description']?></p>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex align-items-center justify-content-end">
                              <?php
                                $topic_id = $row['topic_id'];
                                $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, topics.topic, post.text, post.post_id, user_account.user_id 
                                FROM user_account 
                                INNER JOIN post ON post.user_id = user_account.user_id 
                                INNER JOIN topics ON post.topic_id = topics.topic_id
                                WHERE topics.topic_id = '$topic_id'";
                                $total_post = mysqli_num_rows(mysqli_query($conn, $query));
                              ?>
                            <div class="p-3">
                              <i class="bi bi-chat-left-quote"></i> <?php echo $total_post?>
                            </div>
                        </div>
 
                     </div>
                 </a>
                <?php endwhile;?>
              <?php endif;?>
 
     
       <?php endif;?>




       <?php if($_GET['page'] === 'topics'):?>
          <?php
              $filter = $_GET['filter'];
              $start_from = $_GET['start'];
              $limit = 5;
              $num = $start_from;
                if ($filter === 'Anyone' || $filter === 'Group') {
                  if ($filter === 'Anyone') {
                     $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, topics.date, topics.privacy, topics.time, topics.topic, topics.description, topics.topic_id 
                     FROM user_account 
                     INNER JOIN topics ON user_account.user_id = topics.user_id
                     WHERE topics.status != 'Banned'
                     AND topics.privacy = 'Anyone'
                     ORDER BY date DESC, time DESC
                     LIMIT $start_from, $limit";
                 }
                 if ($filter === 'Group') {
                     $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, topics.date, topics.privacy, topics.time, topics.topic, topics.description, topics.topic_id 
                     FROM user_account 
                     INNER JOIN topics ON user_account.user_id = topics.user_id
                     WHERE topics.status != 'Banned'
                     AND topics.privacy = '$user_group'
                     ORDER BY date DESC, time DESC
                     LIMIT $start_from, $limit";
                 }
                }else {
                    $query = "SELECT user_account.profile,user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, topics.date, topics.privacy, topics.time, topics.topic, topics.description, topics.topic_id 
                         FROM user_account 
                         INNER JOIN topics ON user_account.user_id = topics.user_id
                         WHERE topics.status != 'Banned'
                         AND topics.privacy = 'Anyone' OR topics.privacy = '$user_group'
                         ORDER BY date DESC, time DESC
                         LIMIT $start_from, $limit";
                }
               
               $result = mysqli_query($conn, $query);
              ?>
           
           <?php while($row = mysqli_fetch_assoc($result)):?>  
                 <a href="view_topic.php?topic_id=<?php echo $row['topic_id']?>" class="nav-link mb-2">
                     <div class="row" style="border: 1px solid #d9d9d9; border-left: 4px solid #FD5825;">
                        <div class="col-md-5 py-4 d-flex">
                            <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" id="img2">
                            <div class="ms-3">
                                <div id="userName"><?php echo $row['firstname']. ' ' .$row['lastname']?>
                                <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill ms-2">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill ms-2">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill">Admin</span>
                              <?php endif;?>
                                 </div>
                                
                                <div id="date" class="text-grey" style="font-size: 0.8rem;">
                                    <?php echo date('F d, Y',strtotime($row['date']))?>
                                    &nbsp;
                                    <?php echo date('g:i A',strtotime($row['time']))?>
                                    <i class="bi bi-dot"></i>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i>
                               <?php endif;?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 py-3 d-flex align-items-center">
                            <div>
                            <h5 class="post-topic"><?php echo $row['topic']?></h5>
                            <p><?php echo $row['description']?></p>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex align-items-center justify-content-end">
                              <?php
                                $topic_id = $row['topic_id'];
                                $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, post.date, post.time, topics.topic, post.text, post.post_id, user_account.user_id 
                                FROM user_account 
                                INNER JOIN post ON post.user_id = user_account.user_id 
                                INNER JOIN topics ON post.topic_id = topics.topic_id
                                WHERE topics.topic_id = '$topic_id' AND post.status != 'Banned'";
                                $total_post = mysqli_num_rows(mysqli_query($conn, $query));
                              ?>
                            <div class="p-3">
                              <i class="bi bi-chat-left-quote"></i> <?php echo $total_post?>
                            </div>
                        </div>
 
                     </div>
                 </a>
                <?php endwhile;?>
       <?php endif;?>

       <?php if($_GET['page'] === 'all_notification'):?>
                       <?php
                       $start_from = $_GET['start'];
                       $limit = 5;
                          $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'
                                    ORDER BY date DESC, time DESC
                                    LIMIT $start_from, $limit";
                          $result = mysqli_query($conn, $query);
                        ?>
                    <?php while($notif_row = mysqli_fetch_assoc($result)):?>
                       <a href="view_notification.php?notif_id=<?php echo $notif_row['notification_id']?>&post_id=<?php echo $notif_row['post_id']?>" class="nav-link">  
                        <div class="notif-con row">
                           <div class="col-2 d-flex align-items-center">
                              <?php
                                 $query = 'SELECT profile, firstname, lastname FROM user_account WHERE user_id = "'.$notif_row['source_id'].'"';
                                 $profile = mysqli_fetch_assoc(mysqli_query($conn, $query));
                              ?>
                             <img class="notif-profile-img" src="assets/uploaded_images/profile/<?php echo $profile['profile']?>" alt="buere">
                           </div>
                           <div class="col-10 py-1 px-3" style="font-size: 0.9rem;">
                               <div class="source-con">
                                  <span class="source-name text-secondary" style="font-weight: bold;"><?php echo $profile['firstname'].' '.$profile['lastname']?></span>
                                  <?php if($notif_row['type'] === 'comment'):?>
                                  <span class="notif-type">commented to your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned1'):?>
                                  <span class="notif-type text-danger">Ban your post: </span>
                                  <?php endif;?>
                                  <?php if($notif_row['type'] === 'banned2'):?>
                                  <span class="notif-type text-danger">Ban your topic: </span>
                                  <?php endif;?>
                                  
                                  <?php if($notif_row['view'] === 'no'):?>
                                  <span class="float-end"><i class="bi bi-dot text-primary"></i></span>
                                  <?php endif;?>  
                               </div>
                               <div class="content-con">
                                      <?php
                                       $query = 'SELECT text FROM post WHERE post_id = '.$notif_row['post_id'].'';
                                       $text = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                     ?>
                                        <span>
                                              <?php 
                                               $post_text = filter_var($text['text'], FILTER_SANITIZE_STRING);
                                                echo "''$post_text''";
                                              ?>
                                        </span>
                                 </div>
                                <div class="notif-date">
                                     <?php
                                    $time_past = strtotime($notif_row['date_time']);
                                     ?>
                                     <?php if($notif_row['view'] === 'no'):?>
                                       <span class="text-primary"><?php echo date('F d, Y', strtotime($notif_row['date']))?></span>
                                       <span class="text-primary"><?php echo date('g:i A',strtotime($notif_row['time']))?></span>
                                     <?php else:?> 
                                        <span><?php echo date('F d, Y', strtotime($notif_row['date']))?></span>
                                       <span><?php echo date('g:i A',strtotime($notif_row['time']))?></span>
                                     <?php endif;?>
                                </div>
                           </div>
                        </div>
                       </a>
                       <?php endwhile;?>
           
            
       <?php endif;?>



       <?php if($_GET['page'] === 'search'):?>
                   <?php
                      $start_from = $_GET['start'];
                      $limit = 2;
                      $search = $_GET['search'];
                      $query = "SELECT user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,post.status, post.date, post.time, topics.topic, post.text,post.views, post.post_id,post.privacy, user_account.user_id, topics.topic_id 
                      FROM user_account 
                      INNER JOIN post ON post.user_id = user_account.user_id 
                      INNER JOIN topics ON post.topic_id = topics.topic_id
                      WHERE post.status != 'Banned' AND (post.text LIKE '%$search%' OR topics.topic LIKE '%$search%' OR user_account.firstname LIKE '%$search%' OR user_account.lastname LIKE '%$search%')
                      LIMIT $start_from, $limit;";
                      $result = mysqli_query($conn, $query);
                      $row = mysqli_fetch_assoc($result);
                    ?>
                     
                     <?php while($row = mysqli_fetch_assoc($result)):?>
              <?php $post_id = $row['post_id'];?> 
              <a href="view_post.php?post_id=<?php echo $post_id?>" target="_blank" class="nav-link">
              <div class="border mt-3">
              <div id="post">
               <div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">  
                   <div id="userInfo" class="d-flex">    
                        <div id="imgContainer">
                           <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="<?php $row['profile']?>">
                        </div>
                        <div id="userNameContainer" class="ms-3">
                           <div id="userName">
                              <span><?php echo $row['firstname']. ' ' .$row['lastname']?></span>
                               <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill ms-2">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill ms-2">Pastor</span>
                              <?php endif;?>
                           </div>
                           <div id="postedDate" style="font-size: 0.9rem;">
                              <?php echo date('F d, Y',strtotime($row['date']))?>
                               &nbsp;at&nbsp; 
                              <?php echo date('g:i A',strtotime($row['time']))?>
                                     <i class="bi bi-dot"></i>
                               <?php 
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
                                $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                $user_group = $group['ministry'];
                               ?>
                              <?php if($row['privacy'] === 'Anyone'):?> 
                                     <i class="bi bi-globe-americas"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === $user_group):?> 
                                 <i class="bi bi-people-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Locked'):?> 
                                 <i class="bi bi-lock-fill"></i>
                              <?php endif;?>
                              <?php if($row['privacy'] === 'Private'):?> 
                                 <i class="bi bi-incognito"></i>
                               <?php endif;?>
                            </div>
                         </div>
                      
                    </div>
                 
                  </div>
              </div>

              <div id="postContentContainer" class="px-4">
                  <div id="postTopic">
                     <?php
                       $query = 'SELECT status FROM topics WHERE topic_id = '.$row['topic_id'].'';
                       $status = mysqli_fetch_assoc(mysqli_query($conn, $query));
                     ?>
                     <?php if($status['status'] === 'Banned'):?>
                        <h4 class="topic text-dark">[Unavailable]</h4>
                     <?php else:?>
                          <h4 class="topic text-dark"> <?php echo $row['topic']?></h4>
                      <?php endif;?>  
                  </div>
                   <div class="text">
                     <?php echo $row['text']?>
                   </div>
              </div>
            
              <div id="reactionInfo" class="container d-flex justify-content-around mt-2 py-3 border-top border-bottom">
                   <?php
                    $post_id = $row['post_id'];
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM forum_like WHERE user_id = '$user_id' AND post_id = $post_id";
                    $is_post_hearted = mysqli_query($conn, $query);
                   ?>
                     <span id="totalLikes" postid="<?php echo $post_id?>">
                      <?php if(mysqli_num_rows($is_post_hearted) > 0):?>
                        <i id="btnHeart" class="bi bi-heart-fill text-danger" style="cursor:pointer"></i>
                       <?php else:?> 
                        <i id="btnHeart" class="bi bi-heart" status='' style="cursor:pointer"></i>
                      <?php endif;?>
                      <?php
                         $query = "SELECT * FROM forum_like WHERE post_id = $post_id";
                         $total_likes = mysqli_num_rows(mysqli_query($conn, $query));
                      ?>
                         <?php echo $total_likes?> 
                     </span>
                     <?php 
                       $post_id = $row['post_id'];
                       $query = "SELECT comment.comment
                                 FROM comment
                                 INNER JOIN post ON comment.post_id = post.post_id
                                 WHERE post.post_id = $post_id";
                        $total_comments = mysqli_num_rows(mysqli_query($conn, $query)); 
                      ?>
                    <span id="totalComments" class="ms-2">
                      <i class="bi bi-chat-left"></i> 
                       <?php echo $total_comments?>
                    </span>
                    <span id="totalViews" class="ms-2">
                      <i class="bi bi-eye"></i>
                      <?php echo $row['views']?>
                    </span>
              </div>
              </div>
              </a>
              
              <?php endwhile;?>
            
       <?php endif;?>


       <?php if($_GET['page'] === 'comment'):?>
                   <?php
                      $start_from = $_GET['start'];
                      $limit = 5;
                      $post_id = $_GET['postid'];
                      $query = "SELECT user_account.user_id,user_account.role, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry,comment.comment_id, comment.date, comment.time, comment.comment
                      FROM user_account
                      INNER JOIN comment ON user_account.user_id = comment.user_id
                      WHERE comment.post_id = $post_id
                      LIMIT $start_from, $limit";
                      $result = mysqli_query($conn, $query); 
                    ?>
                    <?php while($row = mysqli_fetch_assoc($result)):?>
                     <li>
                   <a href="view_profile.php?user_id=<?php echo $row['user_id']?>" class="nav-link">  
                     <div id="userComment" class="container-fluid py-1">
                       <div id="userInfo" class="d-flex">
                          <div id="imgContainer">
                           <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
                          </div>
                          <div id="userNameContainer" class="ms-2">
                             <div id="userName">
                               <span><?php echo $row['firstname']. ' ' .$row['lastname']?></span> 
                               <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="position" class="bg-info badge rounded-pill">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="position" class="badge rounded-pill" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="position" class="badge rounded-pill" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span id="position" class="bg-primary badge rounded-pill">Admin</span>
                              <?php endif;?>
                             </div>
                             <div id="postedDate">
                             <?php echo date('F d, Y',strtotime($row['date']))?>
                               &nbsp;at&nbsp; 
                              <?php echo date('g:i A',strtotime($row['time']))?>
                              </div>
                          </div>
                        </div>  
                       </div>     
                     </a>
                       <div id="comment-con" class="px-4">
                           <div style="border-left: 1px solid #121212;">
                            <div class="comment px-3 py-1">
                              <?php echo $row['comment']?>
                             </div>
                              <div class="action-con px-3">
                                <span class="btn-reply rounded-5 px-3 py-1" style="cursor: pointer;">
                                 <i class="bi bi-reply"></i> Reply
                                </span> 
                                  <div class="reply-container">
                                       <div class="reply-input py-2 d-flex align-items-center">
                                         <input type="hidden" id="comment_userid" value="<?php echo $row['user_id']?>">
                                         <input type="hidden" id="commentId" value="<?php echo $row['comment_id']?>">
                                         <input type="text" name="reply" id="reply" placeholder="Add a Reply..." class="replay-input form-control rounded-5" style="width: 80%;">
                                         <button class="btn-add-reply btn btn-primary ms-2 py-2 px-3 rounded-5" disabled>Reply</button> 
                                      </div> 
                                  </div>
                                   <div class="reply-list-con pt-2">
                                           <div class="text-start">
                                                <?php 
                                                   $comment_id = $row['comment_id'];
                                                   $query = "SELECT * FROM reply WHERE comment_id = '$comment_id'";
                                                   $total_replies = mysqli_num_rows(mysqli_query($conn, $query));
                                                ?>
                                                <?php if($total_replies > 0):?>
                                                  <span comment-id="<?php echo $comment_id?>" class="btn-view-replies text-primary rounded-5"><?php echo $total_replies?> replie/s</span>
                                                 <?php endif;?>
                                           </div>
                                        
                                            <div class="reply-list">
                                                <ul id="repList" class="p-0 mt-3" style="list-style: none;">
                                              
                                                </ul>
                                             </div>
                                             
                                     </div> 
                             </div>
                        </div>
                      </div>
                        </li>

                  
                  <?php endwhile;?> 
 
           <?php exit?>
       <?php endif;?>









       <?php if($_GET['page'] === 'reply'):?>
         <?php
         $start_from = $_GET['start'];
         $limit = 3;
         $comment_id = $_GET['comment_id'];

$query = "SELECT user_account.user_id, user_account.profile, user_account.firstname, user_account.lastname, user_account.ministry, reply.reply, reply.date, reply.time
                       FROM user_account
                       INNER JOIN reply ON user_account.user_id = reply.user_id
                       WHERE reply.comment_id = '$comment_id'
                       LIMIT $start_from, $limit";
$result = mysqli_query($conn, $query);

?>
                 <?php while($row = mysqli_fetch_assoc($result)):?>
                  <li>
                  <a href="view_profile.php?user_id=<?php echo $row['user_id']?>" class="nav-link">  
                    <div id="userComment" class="container-fluid">
                      <div id="userInfo" class="d-flex">
                         <div id="imgContainer">
                          <img src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
                         </div>
                         <div id="userNameContainer" class="ms-3">
                            <div id="userName">
                              <span><?php echo $row['firstname']. ' ' .$row['lastname']?></span> 
                              <?php if($row['ministry'] === 'Youth'):?> 
                                 <span id="groupName" class="badge rounded-pill bg-warning">&nbsp;Youth</span>
                             <?php endif;?>
                             <?php if($row['ministry'] === 'Kids'):?> 
                                <span id="position" class="bg-info badge rounded-pill ms-2">Kids</span>
                             <?php endif;?>
                             <?php if($row['ministry'] === 'Adult'):?> 
                                <span id="position" class="badge rounded-pill ms-2" style="background: #FC913A;">Adult</span>
                             <?php endif;?>
                             <?php if($row['ministry'] === 'Music Team'):?> 
                                <span id="position" class="badge rounded-pill ms-2" style="background: #FF4E50;">Music Team</span>
                             <?php endif;?>
                             <?php if($row['ministry'] === 'Pastor'):?> 
                                <span id="position" class="bg-primary badge rounded-pill ms-2">Pastor</span>
                             <?php endif;?>
                            </div>
                            <div id="postedDate">
                            <?php echo date('F d, Y',strtotime($row['date']))?>
                              &nbsp;at&nbsp; 
                             <?php echo date('g:i A',strtotime($row['time']))?>
                             
                             </div>
                         </div>
                       </div>  
                      </div>     
                    </a>
                      <div id="comment-con" class="px-3 py-2">
                          <div style="border-left: 1px solid #121212;">
                           <div class="comment px-3 py-1">
                             <?php echo $row['reply']?>
                            </div>
                       </div>
                     </div>
                       </li>
                 <?php endwhile;?>  
       <?php endif;?>