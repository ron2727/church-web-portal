<?php
require __DIR__ . '/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit;
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="310x310" href="assets/img/tic_logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/animation.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <style>
    .nav-link {
      cursor: pointer;
    }

    .active-link {
      border-bottom: 3px solid blue;
      color: #2563eb;
    }

    .main-container {
      width: 70%;
      margin-top: 8rem;
    }

    @media only screen and (max-width: 765px) {
      .main-container {
        width: 100%;
        margin-top: 8rem;
      }
      .nav-link, .title{
        font-size: 0.8rem;
      }
      .details, .status, .view-link, .edit-link{
        font-size: 0.7rem;
      }
    }
  </style>
  <title>Services</title>

</head>

<body>
  <!-- Navigation -->
  <?php include('navigation.php') ?>

  <!-- Content -->
  <main class=" d-flex justify-content-center">
    <div class="main-container bg-white border mb-5">
      <nav class="navbar navbar-expand">
        <div class="container-fluid py-2 border-bottom">
          <ul class="navbar-nav">
            <li id="navPending" class="nav-item">
              <a class="post-nav nav-link active-link" style="font-weight:bold">Pending</a>
            </li>
            <li id="navApproved" class="nav-item">
              <a class="post-nav nav-link" style="font-weight:bold">Approved</a>
            </li>
            <li id="navCompleted" class="nav-item">
              <a class="post-nav nav-link" style="font-weight:bold">Completed</a>
            </li>
            <!-- <li id="navCancelled" class="nav-item">
                           <a class="post-nav nav-link" style="font-weight:bold">Cancelled</a>
                        </li> -->
          </ul>
        </div>
      </nav>
      <div class="services-items">

      </div>

    </div>
  </main>
  <!-- Footer -->
  <?php include('footer.php') ?>



  <script>
    let userId = '<?php echo $_SESSION['user_id'] ?>'
    let statusForm = 'Pending';



    $(document).ready(function() {
      $('.nav-link').click(function() {
        $('.nav-link').each((key, elem) => {
          elem.classList.remove('active-link')
        })
        $(this).addClass('active-link')
      });

      (function() {
        $('.services-items').html(`
         <div class="loading">
           <div class="d-flex justify-content-center py-4">
             <div class="spinner-border spinner-border-sm text-primary"></div>
           </div>
         </div>
        `)
        $.ajax({
          url: 'ajax/pages/pending.php',
          method: 'GET',
          data: {
            user_id: userId,
            status: statusForm
          },
          success: function(data) {
            $('.services-items').html(data)
          }
        })
      })();

      $('#navPending').click(function() {
        $('.services-items').html(`
         <div class="loading">
           <div class="d-flex justify-content-center py-4">
             <div class="spinner-border spinner-border-sm text-primary"></div>
           </div>
         </div>
        `)
        statusForm = 'Pending'
        $.ajax({
          url: 'ajax/pages/pending.php',
          method: 'GET',
          data: {
            user_id: userId,
            status: statusForm
          },
          success: function(data) {
            $('.services-items').html(data)
          }
        })

      })

      $('#navApproved').click(function() {
        $('.services-items').html(`
         <div class="loading">
           <div class="d-flex justify-content-center py-4">
             <div class="spinner-border spinner-border-sm text-primary"></div>
           </div>
         </div>
        `)
        statusForm = 'Approved'
        $.ajax({
          url: 'ajax/pages/pending.php',
          method: 'GET',
          data: {
            user_id: userId,
            status: statusForm
          },
          success: function(data) {
            $('.services-items').html(data)
          }
        })

      })

      $('#navCompleted').click(function() {
        $('.services-items').html(`
         <div class="loading">
           <div class="d-flex justify-content-center py-4">
             <div class="spinner-border spinner-border-sm text-primary"></div>
           </div>
         </div>
        `)
        statusForm = 'Completed'
        $.ajax({
          url: 'ajax/pages/pending.php',
          method: 'GET',
          data: {
            user_id: userId,
            status: statusForm
          },
          success: function(data) {
            $('.services-items').html(data)
          }
        })

      })





    })
  </script>

</body>

</html>