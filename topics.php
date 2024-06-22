<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: forum_guest.php");
    exit;
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Navigation</title>
    <style>

       img{
        width: 40px;
        height: 40px;
        border-radius: 50%;
       }
       #date{
        color: #6c6c6c;
       }
       #userName{
        font-weight: bold;
       }
       /* responsive */
       .main-con{
        width: 60%;
       }
       #date{
            font-size: 0.8rem;
          }
       @media only screen and (max-width: 765px) {
          .main-con{
            width: 100%;
          }
          .header{
            margin-top: 5px;
          }
          .header h3{
            font-size: 1rem;
          }
          .filter-con i{
            font-size: 0.8rem;
          }
          .filter-con{
            font-size: 0.8rem;
          }
          .header div ul li a{
            font-size: 0.6rem;
          }
          #date{
            font-size: 0.6rem;
          }
        }
    </style>
</head>
<body class="bg-white">
      <!-- Navigation -->
        <?php include('forum_nav.php')?>
      

      <main>
        <!-- topic list -->
          <div class="container-fluid bg-white d-flex justify-content-center">
               <div class="main-con">
                 <div class="header container-fluid d-flex justify-content-between align-items-center p-2 px-3 border mb-2">
                       <h3>Topics</h3>
                        <div class="dropdown" style="cursor: pointer;">
                           <div class="filter-con border px-3 dropdown-toggle" data-bs-toggle="dropdown">
                             <i class="bi bi-funnel-fill"></i>
                                Filter
                            </div>
                             <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="topics.php?filter=Anyone"><i class="bi bi-globe-americas"></i> Anyone</a></li>
                              <li><a class="dropdown-item" href="topics.php?filter=Group"><i class="bi bi-people-fill"></i> Group</a></li>
                            </ul>
                        </div>
                  </div>    
          

             <div id="postList" class="container">
              <?php 
              $user_id = $_SESSION['user_id'];
              $query = "SELECT ministry FROM user_account WHERE user_id = '$user_id'";
              $group = mysqli_fetch_assoc(mysqli_query($conn, $query));
              $user_group = $group['ministry'];
              if (isset($_GET['filter'])) {
                    $filter = $_GET['filter'];
                     if ($filter === 'Anyone') {
                        $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, topics.date, topics.privacy, topics.time, topics.topic, topics.description, topics.topic_id 
                        FROM user_account 
                        INNER JOIN topics ON user_account.user_id = topics.user_id
                        WHERE topics.status != 'Banned'
                        AND topics.privacy = 'Anyone'
                        ORDER BY date DESC, time DESC
                        LIMIT 5";
                    }
                    if ($filter === 'Group') {
                        $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, topics.date, topics.privacy, topics.time, topics.topic, topics.description, topics.topic_id 
                        FROM user_account 
                        INNER JOIN topics ON user_account.user_id = topics.user_id
                        WHERE topics.status != 'Banned'
                        AND topics.privacy = '$user_group'
                        ORDER BY date DESC, time DESC
                        LIMIT 5";
                    }
              }else {
                $query = "SELECT user_account.profile, user_account.role, user_account.firstname, user_account.lastname, user_account.ministry, topics.date, topics.privacy, topics.time, topics.topic, topics.description, topics.topic_id 
                         FROM user_account 
                         INNER JOIN topics ON user_account.user_id = topics.user_id
                         WHERE topics.status != 'Banned'
                         AND topics.privacy = 'Anyone' OR topics.privacy = '$user_group'
                         ORDER BY date DESC, time DESC
                         LIMIT 5";
              }
              
               $result = mysqli_query($conn, $query);          
              ?>
             <?php if(mysqli_num_rows($result)):?> 
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
                                
                                <div id="date" class="text-grey">
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
                 </div>
                   <?php if(mysqli_num_rows($result) > 5):?>
                      <div id="loaderCon" class="container-fluid text-center py-3">
                         <div id="spin" class="spinner-border text-primary"></div>
                         <button id="btnLoadMore" class="btn btn-primary">
                            Load more
                        </button>
                      </div>
                   <?php endif?>
              <?php else:?>
                 <div class="text-center py-5">
                     No post here
                </div>     
             <?php endif?>
             </div> 
  
           


          
      </main>



          <!-- Footer -->
          <footer class="bg-light text-center text-lg-start">
             <hr>
             <div id="footerText" class="text-center p-3">
                 © <?php echo date('Y')?> Copyright: Taytay Immanuel Church
              </div>
     </footer>


     <script>
         $(document).ready(function(){
                let pageNum = 5;
                   $('#spin').hide();
                  $('#btnLoadMore').click(function(){
                      $('#spin').show();
                      $('#btnLoadMore').hide();
                    setTimeout(() => {
                        $.ajax({
                        url: 'ajax/load_more.php',
                        method: 'GET',
                        data: {
                           filter: '<?php echo $filter ?? ''?>',
                           start: pageNum,
                           page: 'topics',
                        },
                        success: function(data){
                             if (!$.trim(data)) {
                              $('#spin').hide();
                              $('#btnLoadMore').hide();
                              $('#postList').append('<p class="text-center">No More Topics</p>');
                             
                             }else{
                              $('#postList').append(data);
                              $('#spin').hide();
                              $('#btnLoadMore').show();
                             }
                        }
                      })
                      pageNum = pageNum + 5;
                    }, 1000);
                      
                  })
         })
       </script>
 </body>
</html>