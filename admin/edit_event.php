<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  [$month, $year] = explode(' ', date('F Y', strtotime($_POST['date'])));
  $event_id = $_POST['event_id'];
  $title = $_POST['title'];
  $place = $_POST['place'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $description = $_POST['description'];
  $status = $_POST['status'];
  
  if (!empty($_FILES['image']['tmp_name'])) {
  $image_tmpname = $_FILES['image']['tmp_name'];
  $img_name = $_FILES['image']['name'];
  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
  $image_new_name = uniqid("EVENT-IMG", false). '.' .$img_ex;
  $image_upload_path = '../assets/uploaded_images/event/' .$image_new_name;
  move_uploaded_file($image_tmpname, $image_upload_path);
  $query = "UPDATE event 
  SET title = '$title', place = '$place', date = '$date', time = '$time', description = '$description', status = '$status', image = '$image_new_name', month = '$month', year = '$year'
  WHERE event_id = $event_id";
  }else {
  $query = "UPDATE event SET title = '$title', place = '$place', date = '$date', time = '$time', description = '$description', status = '$status', month = '$month', year = '$year'
  WHERE event_id = $event_id";
  }
  mysqli_query($conn, $query);
  
  header('Location: events.php?status='.strtolower($status).'&action=edit');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="../assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
     <link rel="stylesheet" href="../assets/libs/textarea/ui/trumbowyg.min.css">
    <title>Events | Edit Event</title>
</head>
<style>
   ul li{
    cursor: pointer;
   }
   ul li a:hover{
    background-color: #0275d8;
   }
 
</style>

<body>
     <div class="container-fluid bg-white">
      
      <div class="row">
       <div id="sideNav" class="col-sm-2 bg-dark p-0" style="overflow-y: auto;">
            <div id="navTitle" class="border-bottom text-white p-4">
                 <h3 class="text-center">Admin</h3>
            </div>
            <!-- Menu -->
            <?php include('navigation.php')?>
            
       </div>
       <!-- Main content -->
       <div class="col-sm-10 p-0" style="overflow-y: auto;">
          <!-- Top nav -->
             <?php 
              include('top_navigation.php')
              ?>

            <!-- Table Section -->
            <div class="container-fluid h-80" >
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Events</li>
                  </ol>
               </div>
                   <div>
                       <div class="container-fluid p-0 border">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                           <h3>Edit Event</h3>
                         </div>
                  <?php 
                    $event_id = $_GET['event_id'];
                    $query = "SELECT * FROM event WHERE event_id = $event_id";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                  ?>
                         <div id="EditEventContainer" class="px-5 pt-3">
                         <form name="formEditEvent" id="formEditEvent" action="edit_event.php" method="POST" enctype="multipart/form-data">
                         <div class="container-fluid">
                            <div class="input-eventId mx-3">
                                <label for="event_id">Event ID</label>
                                <input type="text" name="event_id" id="eventId" class="form-control" validate="required" readonly="true" value="<?php echo $row['event_id']?>">
                             </div>
                             <div class="mx-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" validate="required" value="<?php echo $row['title']?>">
                             </div>
                             <div class="mx-3">
                                <label for="place">Place</label>
                                <input type="text" name="place" id="place" class="form-control" validate="required" value="<?php echo $row['place']?>">
                             </div>
                             <div class="mx-3">
                                <label for="description">Description</label>
                               <textarea name="description" id="description" class="form-control"><?php echo $row['description']?></textarea>
                             </div>
                             <div class="mx-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" validate="required" value="<?php echo $row['date']?>">
                             </div>
                             <div class="mx-3">
                                <label for="time">Time</label>
                                <input type="time" name="time" id="time" class="form-control" validate="required" value="<?php echo $row['time']?>">
                             </div>
                             <div class="mx-3">
                                <!-- <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control" readonly="true" value=" "/> -->
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select" validate="required">
                                <?php if($row['status'] === 'Upcoming'):?>
                                <option value="Upcoming" selected>Upcoming</option>
                                <option value="Past">Past</option>
                                <?php else:?>
                                <option value="Past" selected>Past</option>
                                <option value="Upcoming">Upcoming</option>
                                <?php endif;?>
                               </select>
                             </div>
                             <div class="mx-3">
                                <!-- <label for="image">Image</label> -->
                                <!-- <input type="file" name="image" id="image" class="form-control" accept="image/*"> -->
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
                             <div class="container-fluid my-5">
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Event">      
                              <a href="events.php?status=<?php echo $row['status']?>"><button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button></a>
                             </div>
                         </div>
                     
                       </form>
                         </div>
                       </div>
                   </div>

                   
            </div>
       </div>
        
       </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>
     <script src="../assets/js/notification.js"></script>
     <script src="../assets/js/bootstrap-imageupload.js"></script>
     <script src="../assets/libs/textarea/trumbowyg.min.js"></script>
     <script type="text/javascript">
          $(document).ready(function(){
            $('.imageupload').imageupload({
                allowedFormats: [ "jpg", "jpeg", "png"],
                maxFileSizeKb: 10000
            });
            $('#formEditEvent').validin({
                required_fields_initial_error_message: "",
                form_error_message: "",
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
              $('.input-eventId').hide();
            //  $('.events-menus').removeClass('collapse')
            //   if (eventStatus == 'upcoming') {
            //    $('.upcoming-link').addClass('rounded-3 bg-primary')
            //   }else{
            //    $('.past-link').addClass('rounded-3 bg-primary')
            //   }
          
          })
     </script>

</body>
     
</html>
