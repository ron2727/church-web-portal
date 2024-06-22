<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="310x310" href="../assets/img/tic_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <title>Archived | Funeral Form</title>
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
     <div class="container-fluid">
      <div class="row">
       <div id="sideNav" class="col-sm-2 bg-dark p-0" style="overflow-y: auto;height:100vh;">
            <div id="navTitle" class="border-bottom text-white p-4">
                 <h3 class="text-center">Admin</h3>
            </div>
            <!-- Menu -->
             <?php 
              include('navigation.php')
              ?>
  
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
                        <form name="formAddEvent" id="formAddEvent">
                         <div class="modal-body">
                             <div class="mx-3">
                                <label for="questionid">Question ID</label>
                                <input type="text" name="questionid" id="questionID" class="form-control">
                             </div>
                             <div class="mx-3">
                                <label for="topicid">Topic ID</label>
                                <input type="text" name="topicid" id="topicID" class="form-control">
                             </div>
                             <div class="mx-3">
                                <label for="semester">Semester</label>
                                <input type="text" name="semester" id="semester" class="form-control">
                             </div>
                             <div class="mx-3">
                                <label for="question">Question</label>
                                <input type="text" name="question" id="question" class="form-control">
                             </div>
                             <div class="mx-3">
                                <label for="answer">Answer</label>
                                <input type="text" name="answer" id="answer" class="form-control">
                             </div>
                         </div>
                         <div class="modal-footer">
                            <button id="btnDelete" class="btn btn-primary" type="submit">Delete</button>
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
                    <li class="breadcrumb-item">Archived</li>
                    <li class="breadcrumb-item">Service</li>
                    <li class="breadcrumb-item">Funeral Form</li>
                  </ol>
               </div>
                   <div class="h-50">
                       <div id="tableContainer" class="container-fluid p-0 border">
                         <div class="text-primary border-bottom px-3 py-2 d-flex justify-content-between">
                           List of Archived Funeral Form
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
 
                         <div class="px-1 pt-3">
                        
                              <table id="tbFuneral" class="table table-striped table-bordered table-sm rounded-2" style="width:100%">
                                <thead>
                                    <tr style="font-weight: bold;">
 
                                        <td class="py-2 text-center">Schedule</td>
                                        <td class="py-2 text-center">Requested by</td>
                                        <td class="py-2 text-center">Contact Number</td>
                                        <td class="py-2 text-center">Email</td>
                                        <td class="py-2 text-center">Status</td>
                                        <td class="py-2 text-center">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                
                                      <?php
                                       $sql = "SELECT * FROM funeral_form WHERE archived = 'yes'";
                                       $result = mysqli_query($conn, $sql);
                                      ?>
                                      <?php while($row = mysqli_fetch_assoc($result)): ?>
                                        <?php
                                          if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                                              $bg_color = '#fee2e2';
                                          }elseif ($row['status'] === 'Approved') {
                                              $bg_color = '#fef3c7';
                                          }else {
                                              $bg_color = '#dcfce7';
                                          }
                                         ?>
                                        <tr style="background:<?php echo $bg_color?>;">
                                           <td class="text-center"><?php echo date("F d, Y", strtotime($row['sched_date']))?></td>
                                          <td class="text-center"><?php echo $row['applicant_fname']?>&nbsp;<?php echo $row['applicant_lname']?></td>
                                          <td class="text-center"><?php echo $row['applicant_contactnum'] ?></td>
                                          <td class="text-center"><?php echo $row['applicant_email'] ?></td>
                                          <td class="text-center">
                                            <?php 
                                              if ($row['status'] === 'Pending' || $row['status'] === 'Cancelled') {
                                                echo '<span class="text-white bg-danger badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Approved') {
                                                echo '<span class="text-white bg-warning badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                              if ($row['status'] === 'Completed') {
                                                echo '<span class="text-white bg-success badge rounded-pill">'.$row['status'].'</span>';
                                              }
                                            ?>
                                          </td>
                                          <td class="d-flex justify-content-around">
                                            <div class="dropdown">
                                              <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                                 <i class="bi bi-search"></i>    
                                                  View
                                              </button>
                                              <ul class="dropdown-menu">
                                                 <li><a class="dropdown-item text-success" href="print_form.php?service=funeral&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                              </ul>
                                             </div>
                                             <?php if($row['status'] !== 'Completed'):?>
                                              <a href="retrieve_service.php?service=funeral&form_id=<?php echo $row['form_id']?>">
                                                <button class="btnEdit btn btn-danger badge rounded-pill"><i class="bi bi-recycle"></i> Retrieve</button>
                                             </a> 
                                            <?php endif;?>
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
     <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
     <script src="../assets/js/notification.js"></script>
     <script src="../assets/js/animation.js"></script>
     <script type="text/javascript">
          $(document).ready(function(){
            let action = '<?php echo $_GET['action'] ?? ''?>';
            if (action == 'edit') {
                toastr.success('Edit Successfully', 'Edit Funeral Form');
              }
              if (action == 'retrieve') {
                toastr.success('Retrieve Successfully', 'Retrieve Funeral Form');
              }
               $('.archived-menus').removeClass('collapse');
               $('.service-archived-menus').removeClass('collapse');
               $('.arcfuneral-link').addClass('rounded-3 bg-primary');
              
             
              $('#tbFuneral').DataTable({
                    autoWidth: false,
        columnDefs: [
            {
                targets: ['_all'],
                className: 'mdc-data-table__cell',
            },
        ],
                   });
          })
          $('.btn-copy-text').click(function(){
                new Clipboard(this);
                toastr.options = {
                  "positionClass": "toast-top-left",
                 }
                toastr.success('Copied');
              })
     </script>
</body>
</html>