<style>
  #profileImg3,
  #profileImg2 {
    width: 40px;
    height: 40px;
    border-radius: 50%;
  }

  .m-profile {
    font-size: 1rem;
    font-weight: bold;
    color: white;
  }

  #m-profileImg2 {
    height: 60px;
    width: 60px;
    border-radius: 50%;
  }
 
</style>
<div class="mobile-nav offcanvas offcanvas-start offcanvas-md p-0 m-0" id="navMenu" style="width:100%; font-family:Poppins;background: #343a40;">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title text-white">TIC</h1>
    <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body p-0 m-0">
    <ul class="navbar-nav">
      <li class="nav-item px-2"><a href="index.php" class="m-home-link nav-link text-white text-center" style="font-size: 1.5rem;">Home</a></li>
      <li class="nav-item px-2"><a href="services.php" class="m-services-link nav-link text-white text-center" style="font-size: 1.5rem;">Services</a></li>
      <li class="nav-item px-2"><a href="event.php" class="m-events-link nav-link text-white text-center" style="font-size: 1.5rem;">Events</a></li>
      <li class="nav-item px-2"><a href="aboutus.php" class="m-about-link nav-link text-white text-center" style="font-size: 1.5rem;">About Us</a></li>
      <!-- <li class="nav-item px-2"><a href="track.php" class="m-track-link nav-link text-white text-center" style="font-size: 1.5rem;">Track Request</a></li> -->
      <li class="nav-item px-2"><a href="forum_guest.php" class="m-forum-link nav-link text-white text-center" style="font-size: 1.5rem;">Forum</a></li>
    </ul>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] !== 'Admin') : ?>
      <?php
      $user_id = $_SESSION['user_id'];
      $query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      ?>
      <ul class=" navbar-nav d-flex flex-column align-items-center">
        <li class="m-profile nav-item mb-3 d-flex flex-column align-items-center">
          <img id="m-profileImg2" src="assets/uploaded_images/profile/<?php echo $row['profile'] ?>" >
          <?php echo $row['firstname'] . ' ' . $row['lastname'] ?>
        </li>
        <li><a class="nav-link text-white" href="booking.php" style="font-size: 1rem;">My Booking</a></li>
        <li><a class="nav-link text-white" href="user_settings.php?user_id=<?php echo $row['user_id'] ?>" style="font-size: 1rem;">User Settings</a></li>
        <li><a class="nav-link text-white" href="logout.php">Logout</a></li>
      </ul>
    <?php endif ?>
  </div>
</div>
<!-- <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navMenu">
    Open Offcanvas Sidebar
  </button> -->

<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background: #343a40;">
  <div class="container-fluid d-flex justify-content-between ps-5 text-white">
    <a href="index.php" class="navbar-brand">
      <img src="assets/img/tic_logo.png" alt="logo" style="width: 60px; height: 60px; border-radius: 50%">
      <span class="nav-title">Taytay Immanuel Church</span>
    </a>
    <button class="btn btn-dark d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button> -->
    <div id="navMenu" class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item px-2"><a href="index.php" class="home-link nav-link text-white">Home</a></li>
        <li class="nav-item px-2"><a href="services.php" class="services-link nav-link text-white">Services</a></li>
        <li class="nav-item px-2"><a href="event.php" class="events-link nav-link text-white">Events</a></li>
        <li class="nav-item px-2"><a href="aboutus.php" class="about-link nav-link text-white">About Us</a></li>
        <!-- <li class="nav-item px-2"><a href="track.php" class="track-link nav-link text-white">Track Request</a></li> -->
        <li class="nav-item px-2"><a href="forum_guest.php" class="forum-link nav-link text-white">Forum</a></li>
        <?php if (isset($_SESSION['user_role'])) : ?>
          <?php if ($_SESSION['user_role'] === 'Admin') : ?>
            <li class="nav-item px-2"><a href="admin/index.php" class="forum-link nav-link text-white">Admin</a></li>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] !== 'Admin') : ?>
          <li>
            <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div id="profile" class="dropdown dropstart d-flex align-items-center" style="cursor: pointer;">
              <img id="profileImg3" src="assets/uploaded_images/profile/<?php echo $row['profile'] ?>" data-bs-toggle="dropdown" alt="buere">
              <ul class="dropdown-menu">
                <li class="text-center">
                  <img id="profileImg3" src="assets/uploaded_images/profile/<?php echo $row['profile'] ?>" alt="profile">
                  <p><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></p>
                </li>
                <li>
                  <hr class="dropdown-divider">
                  </hr>
                </li>
                <li><a class="dropdown-item" href="booking.php"><i class="bi bi-calendar2-event"></i></i>&nbsp; My Booking</a></li>
                <li><a class="dropdown-item" href="user_settings.php?user_id=<?php echo $row['user_id'] ?>"><i class="bi bi-gear"></i>&nbsp; User Settings</a></li>
                <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i>&nbsp; Logout</a></li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>