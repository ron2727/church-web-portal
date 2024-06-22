<?php require __DIR__ . '/../../assets/database/connection.php'; ?>
<?php
$user_id = $_GET['user_id'];
$status_form = $_GET['status'];
?>
<style>
  #serviceImage {
    background-size: cover;
    background-repeat: no-repeat;
  }
</style>
<div class="container-fluid my-3" style="font-family: Montserrat;">
  <!-- Wedding -->
  <?php
  $query = "SELECT * FROM wedding_form WHERE user_id = '$user_id' AND status = '$status_form'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  ?>
  <?php if (mysqli_num_rows($result)) : ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="container-fluid border my-2">
        <div class="row">
          <div id="serviceImage" class="col-md-4" style="background-image: url(assets/img/wedding.jpg);"></div>
          <div id="eventBody" class="col-md-8 p-3">
            <div class="d-flex justify-content-between">
              <h3 class="title pb-3" style="font-weight: bold;">
                <?php echo $row['service'] ?>
              </h3>
              <a href="admin/print_form.php?service=wedding&form_id=<?php echo $row['id'] ?>" target="_blank" class="view-link my-2 text-danger text-decoration-none">
                View <i class="bi bi-eye"></i>
              </a>
            </div>
            <div class="details">
              <p>
                <span style="font-weight: bold;">Requested by:&nbsp;</span> <span id="from"><?php echo $row['groom_fname'] . ' ' . $row['groom_lname'] ?></span>
              </p>
              <div class="row">
                <div class="col-md-6">
                  <p>
                    <span style="font-weight: bold;">Scheduled:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_date'])) ?></span>
                  </p>
                  <p>
                    <span style="font-weight: bold;">Time:&nbsp;</span> <span id="schedDate"><?php echo date('g:i A', strtotime($row['time_from'])) . ' ' . date('g:i A', strtotime($row['time_to'])) ?></span>
                  </p>
                </div>
                <div class="col-md-6">
                  <p>
                    <span style="font-weight: bold;">Rehersal:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_redate'])) ?></span>
                  </p>
                  <p>
                    <span style="font-weight: bold;">Time:&nbsp;</span> <span id="schedDate"><?php echo date('g:i A', strtotime($row['time_refrom'])) . ' ' . date('g:i A', strtotime($row['time_reto'])) ?></span>
                  </p>
                </div>
              </div>
            </div>


            <p class="status">
              <span style="font-weight: bold;">Status:&nbsp;</span>
              <?php
              if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                echo '<span class="text-white bg-danger badge rounded-pill">' . $row['status'] . '</span>';
              }
              if ($row['status'] === 'Approved') {
                echo '<span class="text-white bg-warning badge rounded-pill">' . $row['status'] . '</span>';
              }
              if ($row['status'] === 'Completed') {
                echo '<span class="text-white bg-success badge rounded-pill">' . $row['status'] . '</span>';
              }
              ?>
            </p>
            <div class=" text-end">
              <a href="edit_wedding.php?formid=<?php echo $row['id'] ?>" class="edit-link text-primary text-decoration-none">
                Edit <i class="bi bi-pencil-square text-primary"></i>
              </a>
            </div>

          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    <?php $wedding = "no-data" ?>
  <?php endif; ?>
  <!-- Funeral -->
  <?php
  $query = "SELECT * FROM funeral_form WHERE user_id = '$user_id' AND status = '$status_form'";
  $result = mysqli_query($conn, $query);
  ?>
  <?php if (mysqli_num_rows($result)) : ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="container-fluid border my-2">
        <div class="row">
          <div id="serviceImage" class="col-md-4" style="background-image: url(assets/img/Funeral.jpg);"></div>
          <div id="eventBody" class="col-md-8 p-3">
            <div class="d-flex justify-content-between">
              <h3 class="title pb-3" style="font-weight: bold;">
                <?php echo $row['service'] ?>
              </h3>
              <a href="admin/print_form.php?service=funeral&form_id=<?php echo $row['form_id'] ?>" target="_blank" class="view-link my-2 text-danger text-decoration-none">
                View <i class="bi bi-eye"></i>
              </a>
            </div>

            <div class="details">
              <p>
                <span style="font-weight: bold;">Requested by:&nbsp;</span> <span id="from"><?php echo $row['applicant_fname'] . ' ' . $row['applicant_lname'] ?></span>
              </p>
              <p>
                <span style="font-weight: bold;">Schedule:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_date'])) ?></span>
              </p>
              <p>
                <span style="font-weight: bold;">Time:&nbsp;</span> <span id="from"><?php echo date('h:iA', strtotime($row['time_from'])) . ' - ' . date('h:iA', strtotime($row['time_to'])) ?></span>
              </p>
            </div>
            <p class="status">
              <span style="font-weight: bold;">Status:&nbsp;</span>
              <?php
              if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                echo '<span class="text-white bg-danger badge rounded-pill">' . $row['status'] . '</span>';
              }
              if ($row['status'] === 'Approved') {
                echo '<span class="text-white bg-warning badge rounded-pill">' . $row['status'] . '</span>';
              }
              if ($row['status'] === 'Completed') {
                echo '<span class="text-white bg-success badge rounded-pill">' . $row['status'] . '</span>';
              }

              ?>
            </p>
            <div class=" text-end">
              <a href="edit_funeral.php?formid=<?php echo $row['form_id'] ?>" class="edit-link text-primary text-decoration-none">
                Edit <i class="bi bi-pencil-square text-primary"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    <?php $funeral = "no-data" ?>
  <?php endif; ?>
  <!-- Baptism  -->
  <?php
  $query = "SELECT * FROM baptism_form WHERE user_id = '$user_id' AND status = '$status_form'";
  $result = mysqli_query($conn, $query);
  ?>
  <?php if (mysqli_num_rows($result)) : ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="container-fluid border my-2">
        <div class="row">
          <div class="col-md-4" id="serviceImage" style="background-image: url(assets/img/<?php echo $row['baptism_type'] === 'child' ? 'baptism2.jpg' : 'baptism.jpg' ?>);"></div>
          <!-- <div class="col-md-4"></div> -->
          <div id="eventBody" class="col-md-8">
            <div class="d-flex justify-content-between">
              <h3 id="serviceName" class="title py-2" style="font-weight:bold">
                <?php echo $row['baptism_type'] === 'child' ? 'Child Dedication' : 'Water Baptism' ?>
              </h3>
              <?php
              if ($row['baptism_type'] == "child") {
                $link = 'admin/print_form.php?type=child&service=baptism&form_id=' . $row['form_id'];
              } else {
                $link = 'admin/print_form.php?type=youth&service=baptism&form_id=' . $row['form_id'];
              }
              ?>
              <a href="<?php echo $link ?>" target="_blank" class="view-link my-2 text-danger text-decoration-none">
                View <i class="bi bi-eye"></i>
              </a>
            </div>
            <div class="details">
              <p>
                <span style="font-weight: bold;">Schedule:&nbsp;</span> <span id="schedDate"><?php echo date("l F d, Y", strtotime($row['sched_date'])) ?></span>
                <!-- <span id="schedTime">11:00am - 1:00pm</span> -->
              </p>
              <p>
                <span style="font-weight: bold;">Time:&nbsp;</span> <span id="from"><?php echo date('h:iA', strtotime($row['time_from'])) . ' - ' . date('h:iA', strtotime($row['time_to'])) ?></span>
              </p>
            </div>
            <p class="status">
              <span style="font-weight: bold;">Status:&nbsp;</span>
              <?php
              if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                echo '<span class="text-white bg-danger badge rounded-pill">' . $row['status'] . '</span>';
              }
              if ($row['status'] === 'Approved') {
                echo '<span class="text-white bg-warning badge rounded-pill">' . $row['status'] . '</span>';
              }
              if ($row['status'] === 'Completed') {
                echo '<span class="text-white bg-success badge rounded-pill">' . $row['status'] . '</span>';
              }
              ?>
            </p>
            <div class=" text-end">
              <a href="edit_baptism.php?formid=<?php echo $row['form_id'] ?>&type=<?php echo $row['baptism_type'] ?>" class="edit-link text-primary text-decoration-none">
                Edit <i class="bi bi-pencil-square text-primary"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    <?php $baptism = "no-data" ?>
  <?php endif; ?>
  <?php if (isset($wedding) && isset($funeral) && isset($baptism)) : ?>
    <div>
      <h6 class=" text-center text-muted py-5 my-5">No <?php echo $status_form ?> booking</h6>
    </div>
  <?php endif; ?>
</div>