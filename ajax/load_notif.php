<?php
require __DIR__ . '/../assets/database/connection.php';
session_start();
$user_id = $_SESSION['user_id'];
$number_of_notif = $_GET['limit'];
?>
<?php
date_default_timezone_set('Asia/Manila');
$current_date =  date("Y-m-d");

$current_time = date("H:i:s");
$query = "SELECT * FROM forum_notification WHERE user_id = '$user_id' AND date = '$current_date' AND time = '$current_time'";
$notif = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($notif);
?>


<?php
$query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<?php if (mysqli_num_rows($result) > 0) : ?>
  <!-- New -->
  <?php
  $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'
                                    ORDER BY date DESC, time DESC
                                    LIMIT 3";
  $new_notif = mysqli_query($conn, $query);
  ?>
  <div class="px-3" style="font-weight: bold;">New</div>
  <?php while ($notif_row = mysqli_fetch_assoc($new_notif)) : ?>
    <a href="view_notification.php?notif_id=<?php echo $notif_row['notification_id'] ?>&post_id=<?php echo $notif_row['post_id'] ?>" class="nav-link">
      <div class="row px-3 py-2">
        <div class="col-sm-2 d-flex align-items-center">
          <?php
          $query = 'SELECT profile, firstname, lastname FROM user_account WHERE user_id = "' . $notif_row['source_id'] . '"';
          $profile = mysqli_fetch_assoc(mysqli_query($conn, $query));
          ?>
          <img id="notifProfileImg" src="assets/uploaded_images/profile/<?php echo $profile['profile'] ?>" alt="buere">
        </div>
        <div class="col-sm-10 py-1 px-3" style="font-size: 0.9rem;">
          <div class="source-con">
            <span class="source-name text-secondary" style="font-weight: bold;"><?php echo $profile['firstname'] . ' ' . $profile['lastname'] ?></span>
            <?php if ($notif_row['type'] === 'comment') : ?>
              <span class="notif-type">commented to your post: </span>
            <?php endif; ?>
            <?php if ($notif_row['type'] === 'banned1') : ?>
              <span class="notif-type text-danger">Ban your post: </span>
            <?php endif; ?>
            <?php if ($notif_row['type'] === 'banned2') : ?>
              <span class="notif-type text-danger">Ban your topic: </span>
            <?php endif; ?>
            <?php if ($notif_row['type'] === 'banned3') : ?>
              <span class="notif-type text-danger">Ban your comment: </span>
            <?php endif; ?>
            <?php if ($notif_row['view'] === 'no') : ?>
              <span class="float-end"><i class="bi bi-dot text-primary" style="font-size: 3rem;"></i></span>
            <?php endif; ?>
          </div>
          <div class="content-con">
            <?php
            $query = 'SELECT text FROM post WHERE post_id = ' . $notif_row['post_id'] . '';
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
            <?php if ($notif_row['view'] === 'no') : ?>
              <span class="text-primary"><?php echo date('F d, Y', strtotime($notif_row['date'])) ?></span>
              <span class="text-primary"><?php echo date('g:i A', strtotime($notif_row['time'])) ?></span>
            <?php else : ?>
              <span><?php echo date('F d, Y', strtotime($notif_row['date'])) ?></span>
              <span><?php echo date('g:i A', strtotime($notif_row['time'])) ?></span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </a>
  <?php endwhile; ?>
  <!-- Old  -->
  <?php
  $query = "SELECT * FROM forum_notification WHERE user_id = '$user_id'
                                    ORDER BY date DESC, time DESC
                                    LIMIT 3, $number_of_notif";
  $old_notif = mysqli_query($conn, $query);
  ?>
  <?php if (mysqli_num_rows($old_notif) > 0) : ?>
    <div class="px-3" style="font-weight: bold;">Old</div>
    <?php while ($notif_row = mysqli_fetch_assoc($old_notif)) : ?>
      <a href="view_notification.php?notif_id=<?php echo $notif_row['notification_id'] ?>&post_id=<?php echo $notif_row['post_id'] ?>" class="nav-link">
        <div class="row px-3 py-2">
          <div class="col-sm-2 d-flex align-items-center">
            <?php
            $query = 'SELECT profile, firstname, lastname FROM user_account WHERE user_id = "' . $notif_row['source_id'] . '"';
            $profile = mysqli_fetch_assoc(mysqli_query($conn, $query));
            ?>
            <img id="notifProfileImg" src="assets/uploaded_images/profile/<?php echo $profile['profile'] ?>" alt="buere">
          </div>
          <div class="col-sm-10 py-1 px-3" style="font-size: 0.9rem;">
            <div class="source-con">
              <span class="source-name text-secondary" style="font-weight: bold;"><?php echo $profile['firstname'] . ' ' . $profile['lastname'] ?></span>
              <?php if ($notif_row['type'] === 'comment') : ?>
                <span class="notif-type">commented to your post: </span>
              <?php endif; ?>
              <?php if ($notif_row['type'] === 'banned1') : ?>
                <span class="notif-type text-danger">Ban your post: </span>
              <?php endif; ?>
              <?php if ($notif_row['type'] === 'banned2') : ?>
                <span class="notif-type text-danger">Ban your topic: </span>
              <?php endif; ?>

              <?php if ($notif_row['view'] === 'no') : ?>
                <span class="float-end"><i class="bi bi-dot text-primary" style="font-size: 3rem;"></i></span>
              <?php endif; ?>
            </div>
            <div class="content-con">
              <?php
              $query = 'SELECT text FROM post WHERE post_id = ' . $notif_row['post_id'] . '';
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
              <?php if ($notif_row['view'] === 'no') : ?>
                <span class="text-primary" style="font-weight: bold;"><?php echo date('F d, Y', strtotime($notif_row['date'])) ?></span>
                <span class="text-primary" style="font-weight: bold;"><?php echo date('g:i A', strtotime($notif_row['time'])) ?></span>
              <?php else : ?>
                <span><?php echo date('F d, Y', strtotime($notif_row['date'])) ?></span>
                <span><?php echo date('g:i A', strtotime($notif_row['time'])) ?></span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </a>
    <?php endwhile; ?>
  <?php endif; ?>
  <!-- <div id="floaderCon" class="container-fluid text-center py-3">
                         <div id="fspin" class="spinner-border text-primary"></div>
                         <button id="fbtnLoadMore" class="btn btn-primary">
                          Load more
                         </button>
                        </div> -->
<?php else : ?>
  <li>
    <div class="text-center py-5">
      <i class="bi bi-bell-slash" style="font-size: 9rem;"></i>
      <br>
      <br>
      <span>
        No Notification
      </span>
    </div>
  </li>
<?php endif; ?>





<?php if (mysqli_num_rows($notif)) : ?>

  <?php
  $from = $row['source_id'];
  $query = "SELECT * FROM user_account WHERE user_id = '$from'";
  $notif_user = mysqli_fetch_assoc(mysqli_query($conn, $query));
  ?>
  <script>
    $(document).ready(function() {
      $.toast({
        bgColor: 'white',
        hideAfter: 5000,
        loader: false,
        text: `
                     <div class="toast-notif row px-2 border shadow rounded-3 bg-white">
                           <div class="text-dark px-2 pt-3" style="font-size: 1rem;font-weight:bold;">New notification</div>
                           <div class="col-sm-3 d-flex align-items-center">
                             <img id="notifProfileImg" src="assets/uploaded_images/profile/<?php echo $notif_user['profile'] ?>" alt="buere">
                           </div>
                           <div class="col-sm-9 py-3" style="font-size: 0.9rem;">
                                   <span class="source-name text-secondary p-0" style="font-weight: bold;"><?php echo $notif_user['firstname'] . ' ' . $notif_user['lastname'] ?></span>
                                   <span class="float-end"><i class="bi bi-dot text-primary" style="font-size: 3rem;"></i></span>
                                   <br>
                                   <?php if ($row['type'] === 'comment') : ?>
                                    <span class="notif-type text-dark">commented to your post</span>
                                   <?php endif; ?> 
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
<?php endif; ?>