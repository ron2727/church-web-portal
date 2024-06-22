<?php
require __DIR__ . '/assets/database/connection.php';
session_start();
$months = [
  '01' => 'January',
  '02' => 'February',
  '03' => 'March',
  '04' => 'April',
  '05' => 'May',
  '06' => 'June',
  '07' => 'July',
  '08' => 'August',
  '09' => 'September',
  '10' => 'October',
  '11' => 'November',
  '12' => 'December'
];
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="310x310" href="assets/img/tic_logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/animation.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <title>Home</title>
  <style>
    #main {
      backdrop-filter: blur(500);
      background-image: url('assets/img/service.jpg');
      background-size: cover;
      background-attachment: fixed;
      background-repeat: no-repeat;
    }

    .display-2 {
      color: white;
      font-weight: bold;
    }

    .display-6 {
      color: white;
      font-weight: bold;
    }

    img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
    }

    #eventImage {
      background-size: cover;
      background-repeat: no-repeat;
    }

    .section {
      font-family: Poppins;
    }

    .social-item,
    .social-link {
      display: inline;
    }

    .ser-icon {
      text-align: center;
      font-size: 3rem;
    }

    .search-field p {
      width: 55%;
      word-wrap: break-word;
    }

    .search-form {
      margin-top: 40px;
    }

    input[type='text']#tracknum {
      width: 70%;
      border: 1px solid #cccccc;
      height: 40px;
      outline: none;
      padding-left: 10px;
    }

    #btnSearch {
      padding: 8px 17px 8px 17px;
      margin-left: 10px;
    }

    @media only screen and (max-width: 765px) {
      .search-field p {
        font-size: 0.8rem;
        width: 100%;
        word-wrap: break-word;
      }

      input[type='text']#tracknum {
        width: 70%;
        height: 35px;
        font-size: 0.9rem;
      }

      #btnSearch {
        font-size: 0.8rem;
      }
    }
  </style>
</head>

<body class="bg-white">

  <h1 class="head fixed-top text-danger"></h1>
  <!-- Navigation -->
  <?php include('navigation.php') ?>



  <div id="main" class="container-fluid p-5 h-100 d-flex justify-content-start align-items-center">
    <div>
      <h1 class="title-text display-6">Welcome to</h1>
      <h1 class="title-text display-2">Taytay</h1>
      <h1 class="title-text display-2">Immanuel</h1>
      <h1 class="title-text display-2">Church</h1>
      <p class="title-text text-light">You can now avail the services of our church online</p>
      <div class="w-100">
        <a href="services.php"><button class="btn text-dark rounded-5 px-5" style="background: white; font-size:1.3rem; font-weight:bold;">Services</button></a>
      </div>
    </div>
  </div>
  <!-- service section -->
  <div id="section-services" class="section container my-5">
    <h1 class="display-6 text-dark py-3"><span class="text-danger">Our</span> Services</h1>
    <div class="service-con container d-flex justify-content-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 p-1">
            <div class="card rounded-0 p-3" style="height: min-content;">
              <div class="card-header border-0 bg-white">
                <p class="ser-icon"><i class="bi bi-gear-wide-connected text-primary"></i></p>
                <h4 class="text-center">Baptism</h4>
              </div>
              <div class="card-body border-0 bg-white">
                <p>Come and celebrate this special occasion by our side. A Baptism is an important rite of passage, and one that should be shared with loved ones. Don’t hesitate to contact us.</p>
              </div>
              <div class="card-footer border-0 text-center bg-white py-4">
                <a href="services.php" class="bg-secondary text-white my-3 py-2 px-4" style="text-decoration: none;">More Info</a>
              </div>
            </div>

          </div>
          <div class="col-md-4 p-1">
            <div class="card rounded-0 p-3" style="height: min-content;">
              <div class="card-header border-0 bg-white">
                <p class="ser-icon"><i class="bi bi-gear-wide-connected text-primary"></i></p>
                <h4 class="text-center">Wedding</h4>
              </div>
              <div class="card-body border-0 bg-white">
                <p> We are so excited to celebrate our special day with family and friends. Don’t hesitate to contact us with questions or requests, and keep reading for wedding day details, registry information and more.</p>
              </div>
              <div class="card-footer border-0 text-center bg-white py-4">
                <a href="services.php" class="bg-secondary text-white my-3 py-2 px-4" style="text-decoration: none;">More Info</a>
              </div>
            </div>
          </div>

          <div class="col-md-4 p-1">
            <div class="card rounded-0 p-3" style="height: min-content;">
              <div class="card-header border-0 bg-white">
                <p class="ser-icon"><i class="bi bi-gear-wide-connected text-primary"></i></p>
                <h4 class="text-center">Funeral</h4>
              </div>
              <div class="card-body border-0 bg-white">
                <p>Funeral is a ceremony connected with the final disposition of a corpse, such as a burial or cremation, with the attendant observances, our church offer a funeral service</p>
              </div>
              <div class="card-footer border-0 text-center bg-white py-4">
                <a href="services.php" class="bg-secondary text-white my-3 py-2 px-4" style="text-decoration: none;">More Info</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- events section -->
  <div id="section-services" class="container mt-5 bg-white">
    <h1 class="display-6 text-dark py-3"><span class="text-danger">Events</span> of the Church</h1>
    <!-- Upcoming events content -->
    <div class="container-fluid pb-5 bg-white my-5">
      <div class="container mt-5" style="font-family:Poppins;">
        <!-- Event -->

        <?php foreach ($months as $month) : ?>
          <?php
          $query = "SELECT * FROM event WHERE status = 'Upcoming' AND month = '$month'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          ?>
          <?php if (!empty($row)) : ?>
            <div class="container-fluid bg-white mb-5">
              <div class="row">
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                  <div class="text-info display-6 px-3"><?php echo date('F Y', strtotime($row['date'])) ?></div>
                  <div class="border border-primary bg-primary flex-grow-1" style="height:5px"></div>
                </div>
              </div>
              <?php
              $query = "SELECT * FROM event WHERE status = 'Upcoming' AND month = '$month'";
              $result = mysqli_query($conn, $query);
              ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="container-fluid d-flex">
                  <div class=" px-4 pt-5 border border-end-0 border-top-0 border-bottom-0 border-5 border-primary">
                    <h4 class="text-center"><?php echo date('D', strtotime($row['date'])) ?></h4>
                    <h4 class="text-center display-6 text-dark"><?php echo date('d', strtotime($row['date'])) ?></h4>
                  </div>
                  <div class="container-fluid">
                    <div class="row p-1 mb-3">
                      <div id="eventImage" class="col-md-4 rounded-3" style="background-image: url(assets/uploaded_images/event/<?php echo $row['image'] ?>);">
                      </div>
                      <div id="eventBody" class="col-md-8 p-3 d-flex flex-wrap align-items-between">
                        <div>
                          <h1 class="event-title text-primary"><?php echo $row['title'] ?></h1>
                          <p class="event-place"><?php echo "@ " . $row['place'] ?></p>
                          <p class="event-date"><?php echo date('F d, Y', strtotime($row['date'])) ?></p>
                          <p class="event-time"><?php echo date('g:i A', strtotime($row['time'])) ?></p>
                        </div>
                        <div id="eventFooter" class="container-fluid d-flex justify-content-end">
                          <a href="event.php" class="nav-link">
                            <button class="btn py-1 px-2 btn-primary">
                              View More
                            </button>
                          </a>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php else : ?>
            <p class="text-center text-hidden">No upcoming events</p>
            <?php break; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <?php include('footer.php') ?>



  <script>
    // $('.navbar').hide();
    $('.navbar').css('background-color', '')
    $(document).ready(function() {
      // $(window).on('scroll', function () {
      //    $('.main-nav').css('background', '#343a40')
      // })
      $('.home-link').removeClass('text-white');
      $('.home-link').addClass('text-dark border rounded-pill px-4 bg-white');
      $('.m-home-link').removeClass('text-white');
      $('.m-home-link').addClass('text-dark border px-4 bg-white');


      $(window).scroll(function() {
        // $(".head").text($('#main').height());
        //  $(".head").text($(window).scrollTop());
        if ($(window).scrollTop() >= $('#main').height()) {
          $('.navbar').css('background-color', '#343a40')
          // $('.navbar').slideDown();
        } else {
          $('.navbar').fadeIn();
          $('.navbar').css('background-color', '')
        }
      });
    })
  </script>
</body>

</html>