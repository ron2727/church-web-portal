<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';




if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
         if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $position = $_POST['position'];
            $description = $_POST['description'];
  
            if (!empty($_FILES['image']['tmp_name'])) {
                  $image_tmpname = $_FILES['image']['tmp_name'];
                  $img_name = $_FILES['image']['name'];
                  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                  $image_new_name = uniqid("EVENT-IMG", false). '.' .$img_ex;
                  $image_upload_path = '../assets/uploaded_images/event/' .$image_new_name;
                  move_uploaded_file($image_tmpname, $image_upload_path);
                  $query = "UPDATE pastor 
                  SET name = '$name', position = '$position', description = '$description', image = '$image_new_name'
                  WHERE id = $id";
               }else {
                  $query = "UPDATE pastor SET name = '$name', position = '$position', description = '$description'
                  WHERE id = $id";
               }
               mysqli_query($conn, $query);
               header('Location: pages.php?status='.strtolower($status).'&action=edit');
               exit;
        }else{
           $name = $_POST['name'];
           $position = $_POST['position'];
           $description = $_POST['description'];
  
           $image_tmpname = $_FILES['image']['tmp_name'];
           $img_name = $_FILES['image']['name'];
           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
           $image_new_name = uniqid("PROF-IMG", false). '.' .$img_ex;
           $image_upload_path = '../assets/uploaded_images/profile/' .$image_new_name;
           move_uploaded_file($image_tmpname, $image_upload_path);
           $query = "INSERT INTO pastor(name, position, description, image) 
           VALUES('$name', '$position', '$description', '$image_new_name')";
           mysqli_query($conn, $query);
  
           header('Location: pages.php?status='.strtolower($status).'&action=add');
           exit;
      }
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
    <script src="../assets/js/notification.js"></script>
    <link href="../assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/textarea/ui/trumbowyg.min.css">
    <title>Edit Pastor</title>
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
   .prof-img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
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
         <!-- Modal Modal Modal Modal Modal Modal Modal Modal -->
                  <!-- Modal Modal Modal Modal Modal Modal Modal Modal -->

                           <!-- Modal Modal Modal Modal Modal Modal Modal Modal -->


                       <!-- Modal Add New -->
              <div id="modalAddEvent" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                            <h4>Add Pastor</h4>
                        </div>
                        <form name="formAddEvent" id="formAddEvent" action="pages.php" method="POST" enctype="multipart/form-data">
                         <div class="modal-body">
                              <input type="hidden" name="page" value="pastor">
                             <div class="mx-3">
                                <label for="title">Name</label>
                                <input type="text" name="name" id="title" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="place">Position</label>
                                <input type="text" name="position" id="place" class="form-control" validate="required">
                             </div>
                             <div class="mx-3">
                                <label for="description">Description</label>
                               <textarea name="description" id="description" class="form-control"></textarea>
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
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Add Pastor">
                              
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                         </div>
 
                       </form>
                </div>
              </div>
             </div>


             <!-- Modal Edit -->
             <div id="modalEditPastor" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                            <h4>Edit Pastor</h4>
                        </div>
                        <form name="formEditEvent" id="formAddEvent" action="pages.php" method="POST" enctype="multipart/form-data">
                        <div id="editPastorform">
                           <div class="text-center py-5">
                              <span class="spinner spinner-border text-primary"></span>
                            </div>
                          </div>
                          <div class="mf-edit modal-footer">
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Edit Pastor">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                         </div>
                       </form>
                </div>
              </div>
             </div>
                      <!-- Modal Modal Modal Modal Modal Modal Modal Modal -->
         <!-- Modal Modal Modal Modal Modal Modal Modal Modal -->

                  <!-- Modal Modal Modal Modal Modal Modal Modal Modal -->




            <!-- Table Section -->
            <div class="container-fluid h-80 bg-white">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Edit Pastor</li>
                    <li class="breadcrumb-item">
                       Pastor
                    </li>
                   </ol>
               </div>
                   <div style="height:70%">
                        
        <style>
          #profileImg{
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: aqua;
          }
        </style>
                         <div id="tableContainer" class="px-5 pt-3">
                             <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddEvent">
                            <i class="bi bi-plus"></i> Add New
                            </button>
                         </div>
                              <div class="row">
                                <?php 
                                  $query = "SELECT * FROM pastor";
                                  $result = mysqli_query($conn, $query);
                                ?>
                                 <?php while($row = mysqli_fetch_assoc($result)):?>
                                  <div class="col-4 p-0 bg-white px-3">
                                    <div class="container-fluid shadow py-3 px-3">
                                          <div class="text-end" style="cursor:pointer">
                                               <span pastor-id="<?php echo $row['id']?>" class="edit-pastor text-primary" data-bs-toggle="modal" data-bs-target="#modalEditPastor">
                                                 Edit
                                                 <i class="bi bi-pencil-square text-primary"></i>
                                               </span>
                                               &nbsp;
                                               <span pastor-id="<?php echo $row['id']?>" privacy="<?php echo $row['privacy']?>" class="hide-pastor text-danger">
                                                <?php if($row['privacy'] === 'visible'):?>
                                                     Show
                                                    <i class="bi bi-eye"></i>
                                                  <?php endif;?>
                                                  <?php if($row['privacy'] === 'hidden'):?>
                                                     Hide
                                                    <i class="bi bi-eye-slash"></i>
                                                  <?php endif;?>
                                               </span>

                                           </div>
                                         <!-- <div id="cardProfile" class="container-fluid card border-0 bg-info shadow py-2 px-3"> -->
                                            <div class="d-flex">
                                             
                                            <div class="card-header bg-white border-0 d-flex justify-content-center">
                                                 <img id="profileImg" src="../assets/uploaded_images/profile/<?php echo $row['image']?>" alt="a">
                                            </div>
                                            <div class="card-body d-flex align-items-center">
                                                   <div class="px-3">
                                                   <span id="pastorName" style="font-weight:bold;"><?php echo $row['name']?></span><br>
                                                   <span id="pastorPos" class="text-secondary"><?php echo $row['position']?></span>
                                                   </div>
                                            </div>
                                            </div>
                                            <div class="details p-3">
                                              <?php echo $row['description'] === '' ? 'N/A' :$row['description'];?>
                                            </div>
                                         <!-- </div> -->
                                     </div>
                                  </div>    
                                <?php endwhile;?>    
                              </div>
               
                         </div>
                       </div>
                   </div>
            </div>
       </div>
        
       </div>
     </div>
     <script src="../assets/js/bootstrap-imageupload.js"></script>
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>
     <script type="text/javascript">
        
          $(document).ready(function(){
            let action = '<?php echo $_GET['action'] ?? ''?>';
             $('.pages-menus').removeClass('collapse');
              $('.pastor-link').addClass('rounded-3 bg-primary');
             if (action == 'add') {
                toastr.success('Added Successfully', 'Add Pastor');
              }
              if (action == 'edit') {
                toastr.success('Edit Successfully', 'Edit Pastor');
              }
            
              $('#tbBaptism').DataTable({
                    autoWidth: false,
                    columnDefs: [
                                  {
                                   targets: ['_all'],
                                   className: 'mdc-data-table__cell',
                                  },
                                ],
              });

              $('.edit-pastor').click(function(){
                let pastorId = $(this).attr('pastor-id');
                $.ajax({
                  url: '../ajax/edit_pastor.php',
                  method: 'GET',
                  data: {pastorid: pastorId},
                  success: function(data){
                      $('#editPastorform').html(data);
                  }
                })
              })

              $('.hide-pastor').click(function(){
                let pastorId = $(this).attr('pastor-id');
                let pasprivacy = $(this).attr('privacy');
                let btnPrivacy = $(this);
                $(this).html('<span class="text-danger">Loading...</span>')
                $.ajax({
                  url: '../ajax/privacy.php',
                  method: 'GET',
                  data: {
                    privacy: pasprivacy,
                    pastorid: pastorId
                    },
                  success: function(data){
                      btnPrivacy.html(data);
 
                  }
                })
              })
       
          })
     </script>
     
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