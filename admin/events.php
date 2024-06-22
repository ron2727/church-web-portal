<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';
date_default_timezone_set('Asia/Manila');
  $query = "SELECT * FROM event WHERE status = 'Upcoming'";
 $result = mysqli_query($conn, $query);
 $current_date = date('Y-m-d');
 $current_hours  = date('G');
 $current_mins = date('i');
 $current_month = date('n');
 $current_year = date('Y');
 $current_day = date('j');
 //  echo $current_year;
 while($time = mysqli_fetch_assoc($result)){
    $event_hours = date('G', strtotime($time['time']));
   $event_mins = date('i', strtotime($time['time']));
   $event_month = date('n', strtotime($time['date']));
   $event_year = date('Y', strtotime($time['date']));
   $event_day = date('j', strtotime($time['date']));
      if ($current_year > $event_year) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
      mysqli_query($conn, $query);
    }
    if ($current_year === $event_year && $current_month > $event_month) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
      mysqli_query($conn, $query);
    }
    if ($current_year === $event_year && $current_month === $event_month && $current_day > $event_day) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
       mysqli_query($conn, $query);
    }
    if ($current_date == $time['date'] && $current_hours > $event_hours) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
       mysqli_query($conn, $query);
    }
    if ($current_date == $time['date'] && $current_hours >= $event_hours && $current_mins >= $event_mins) {
       $query = 'UPDATE event SET status = "Past" WHERE event_id = '.$time['event_id'].'';
       mysqli_query($conn, $query);
    }
    // 
 }
$events_status =  $_GET['status']?? '';
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  [$month, $year] = explode(' ', date('F Y',strtotime($_POST['date'])));
  $title = $_POST['title'];
  $place = $_POST['place'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $description = $_POST['description'];
  $status = $_POST['status'];
 
  $image_tmpname = $_FILES['image']['tmp_name'];
  $img_name = $_FILES['image']['name'];
  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
  $image_new_name = uniqid("EVENT-IMG", false). '.' .$img_ex;
  $image_upload_path = '../assets/uploaded_images/event/' .$image_new_name;
  move_uploaded_file($image_tmpname, $image_upload_path);
  $query = "INSERT INTO event(title, place, date, time, description, status, image, month, year) 
  VALUES('$title', '$place', '$date', '$time', '$description', '$status', '$image_new_name', '$month', '$year')";
  mysqli_query($conn, $query);
  
  header('Location: events.php?status='.strtolower($status).'&action=add');
  exit;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="310x310" href="../assets/img/tic_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <link href="../assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/textarea/ui/trumbowyg.min.css">
    <title>Events | <?php echo ucfirst($_GET['status'])?></title>
</head>
<style>
   ul li{
    cursor: pointer;
   }
   ul li a:hover{
    background-color: #0275d8;
   }
   #tableContainer{
    height: 100%;
    overflow: auto;
   }
</style>

<body>
     <div class="container-fluid">
      <div class="row">
       <div id="sideNav" class="col-sm-2 bg-dark p-0" style="overflow-y: auto;height:100vh;">
            <div id="navTitle" class="border-bottom text-white p-4">
                 <h3 class="text-center">Admin</h3>
            </div>
            <!-- Menu -->
            <?php include('navigation.php')?>
            
       </div>
       <!-- Main content -->
       <div class="col-sm-10 p-0" style="height: 100vh;">
           <!-- Top nav -->
              <?php 
              include('top_navigation.php')
              ?>
    
            <!-- Modal Add New -->
            <div id="modalAddEvent" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                            <h4>Add Event</h4>
                        </div>
                        <form name="formAddEvent" id="formAddEvent" action="events.php" method="POST" enctype="multipart/form-data">
                         <div class="modal-body">
                             <div class="mx-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="place">Place</label>
                                <input type="text" name="place" id="place" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="description">Description</label>
                               <textarea name="description" id="description" class="form-control"></textarea>
                             </div>
                             <div class="mx-3">
                                <label for="date">Date</label>
                                <?php
                                  $current_month = date('m');
                                  $current_year = date('Y');
                                  $current_day = date('d') + 1;
                                  $max_date = $current_day + 1;

                                  if ($max_date > 30) {
                                     $current_day = 1;
                                     $current_month + 1;
                                  }
                                ?>
                                <?php if($_GET['status'] === 'upcoming'):?>
                                  <input type="date" name="date" id="date" min="<?php echo date("Y-m-d", strtotime("$current_year-$current_month-$current_day"))?>" class="form-control" validate="required">
                                <?php else:?>  
                                  <input type="date" name="date" id="date" class="form-control" validate="required">
                                <?php endif;?>
                             </div>
                             <div class="mx-3">
                                <label for="time">Time</label>
                                <input type="time" name="time" id="time" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control <?php echo $events_status === 'past' ? 'text-success': 'text-danger';?>" value="<?php echo ucfirst($events_status)?>" readonly="true"/>
                                <!-- <select name="status" id="status" class="form-select" validate="required">
                                <option selected></option>
                                <option value="Upcoming" validate="required">Upcoming</option>
                                <option value="Past">Past</option>
                               </select> -->
                             </div>
                             <div class="mx-3">
                                <!-- <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*"> -->
                                <div class="imageupload panel panel-default mt-3">
                                       <div class="panel-heading clearfix">
                                       <label for="status">Image</label>
                                         </div>
                                       <div class="file-tab panel-body">
                                        <br>
                                     <label class="btn btn-primary btn-file btn-info text-white">
                                        <span>Browse</span>
                                     <!-- The file is stored here. -->
                                      <input type="file" id="image" name="image">
                                     </label>
                                     <button type="button" class="btn btn-default active">Remove</button>
                                   </div>
                                </div>
                             </div>
                         </div>
                          <div class="modal-footer">
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Add Event">
                              
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                         </div>
                       </form>
                </div>
              </div>
             </div>
              <!-- Modal Edit -->
            <div id="modalEditEvent" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                            <h4>Edit Event</h4>
                        </div>
                        <form name="formEditEvent" id="formEditEvent" action="events.php" method="POST" enctype="multipart/form-data">
                         <div class="modal-body">
                             <div class="mx-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="place">Place</label>
                                <input type="text" name="place" id="place" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="description">Description</label>
                               <textarea name="description" id="description" class="form-control"></textarea>
                             </div>
                             <div class="mx-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="time">Time</label>
                                <input type="time" name="time" id="time" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control <?php echo $events_status === 'past' ? 'text-success': 'text-danger';?>" value="<?php echo ucfirst($events_status)?>" readonly="true"/>
                                <!-- <select name="status" id="status" class="form-select" validate="required">
                                <option selected></option>
                                <option value="Upcoming" validate="required">Upcoming</option>
                                <option value="Past">Past</option>
                               </select> -->
                             </div>
                             <div class="mx-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                             </div>
                         </div>
                          <div class="modal-footer">
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Event">
                              
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                         </div>
                       </form>
                </div>
              </div>
             </div>
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Events</li>
        
                  </ol>
               </div>
                   <div style="height: 60%;">
                       <div class="container-fluid p-0 border bg-white">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddEvent">
                            <i class="bi bi-plus"></i> Add New
                            </button>
                            <!-- <div id="searchInput">
                                <div class="input-group">
                                  <input type="text" name="search" id="inputSearch" placeholder="Search.." class="form-control border-none">
                                  <button id="btnSearch" class="btn btn-primary">
                                    <i class="bi bi-search text-light"></i>
                                  </button>
                                </div>
                            </div> -->
                         </div>

                         <!-- <div class="px-5 py-3 d-flex justify-content-end">
                           <div class="dropdown">
                           <div class="border px-3 dropdown-toggle" data-bs-toggle="dropdown">
                             <i class="bi bi-funnel-fill"></i>
                                Filter
                            </div>
                             <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Pending</a></li>
                              <li><a class="dropdown-item" href="#">Approve</a></li>
                            </ul>
                           </div> 
                         </div> -->
 
                         <div id="tableContainer" class="px-5 pt-3">
                        
                              <table id="tbBaptism" class="table table-bordered table-sm rounded-2">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Title</td>
                                        <td class="py-2 text-center">Place</td>
                                        <td class="py-2 text-center">Date</td>
                                        <td class="py-2 text-center">Time</td>
                                        <td class="py-2 text-center">Status</td>
                                        <td class="py-2 text-center">Actions</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                
                                      <?php
                                       $sql = "SELECT * FROM event WHERE status='$events_status'";
                                       $result = mysqli_query($conn, $sql);
                                      ?>
                                      <?php while($row = mysqli_fetch_assoc($result)): ?>
                                      <?php
                                        $date = explode('-', $row['date']);
                                        [$year, $month, $day] = $date;
                                        ?>
                                        <tr>
                                          <td class="text-center"><?php echo $row['title'] ?></td>
                                          <td class="text-center"><?php echo $row['place'] ?></td>
                                          <td class="text-center"><?php echo date('F d, Y', strtotime($row['date']))?></td>
                                          <td class="text-center"><?php echo date('g:i A', strtotime($row['time']))?></td>
                                          <td class="text-center">
                                            <?php 
                                              $status = $row['status'] ?? 'Past';
                                              if ($status === 'Past') {
                                                echo '<span class="text-white bg-success badge rounded-pill">'.$status.'</span>';
                                              }else {
                                                echo '<span class="text-white bg-danger badge rounded-pill">Upcoming</span>';
                                              }
                                            ?>
                                          </td>
                                          <td class="d-flex justify-content-around">
                                                        <div class="dropdown">
                                                        <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                                       
                                                          Actions
                                                        </button>
                                                         <ul class="dropdown-menu">
                                                           <li><a class="dropdown-item text-info" href="../view_event.php?event_id=<?php echo $row['event_id']?>" target="_blank"><i class="bi bi-search"></i> View</a></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_event.php?event_id=<?php echo $row['event_id']?>"><i class="bi bi-pencil-fill"></i> Edit</a></li>
                                                           <!-- <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-archive-fill"></i> Archive</a></li> -->
                                                          </ul>
                                                        </div>
                                                     </td>
                                        </tr>
                                        <?php endwhile;?>
                               
                                 
                                </tbody>
                              </table>
                         </div>
                       </div>
                   </div>
            </div>
       </div>
        
       </div>
     </div>
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>
     <script src="../assets/js/notification.js"></script>
     <script src="../assets/js/bootstrap-imageupload.js"></script>
     <script src="../assets/libs/textarea/trumbowyg.min.js"></script>
     <script type="text/javascript">
          $(document).ready(function(){
             let eventStatus = '<?php echo $events_status?>';
             let action = '<?php echo $_GET['action'] ?? ''?>';
             $('#tbBaptism').DataTable({
                    autoWidth: false,
                    columnDefs: [
                                  {
                                   targets: ['_all'],
                                   className: 'mdc-data-table__cell',
                                  },
                                ],
              });
             $('.imageupload').imageupload({
                allowedFormats: [ "jpg", "jpeg", "png"],
                maxFileSizeKb: 10000
            });
            $('#description').trumbowyg({
                  btns: [
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['unorderedList', 'orderedList'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']
                 ],
             });
             $('.events-menus').removeClass('collapse')
              if (eventStatus == 'upcoming') {
               $('.upcoming-link').addClass('rounded-3 bg-primary')
              }else{
               $('.past-link').addClass('rounded-3 bg-primary')
              }
              if (action == 'add') {
                toastr.success('Added Successfully', 'Add Event');
              }
              if (action == 'edit') {
                toastr.success('Edit Successfully', 'Edit Event');
              }
              $('#events').addClass('dropdown').removeClass('dropup');
              $('#formAddEvent').validin({
                required_fields_initial_error_message: "",
                form_error_message: "",
              });
          })
     </script>

</body>
</html>