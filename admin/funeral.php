<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';

?>
<?php
  $query = "UPDATE funeral_form SET archived = 'yes' WHERE status = 'Completed'";
  mysqli_query($conn, $query);
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <title>Service | Funeral</title>
</head>
<style>
   ul li{
    cursor: pointer;
   }
   ul li a:hover{
    background-color: #0275d8;
   }
   tr{
    font-family: 'Poppins', sans-serif;
    font-size: 0.8rem;
   }
   #table tr td{
    border: none;
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
                    <li class="breadcrumb-item">Service</li>
                    <li class="breadcrumb-item">Funeral Form</li>
                  </ol>
               </div>
                   <div class="h-50">
                       <div id="tableContainer" class="container-fluid p-0 border">
                         <div class="text-primary border-bottom px-3 py-2 d-flex justify-content-between">
                           List of Funeral Request
                         </div>
                         <div class="px-5 py-3 d-flex justify-content-end">
                              <!-- <div style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#filter">
                                 <div class="border px-3" data-bs-toggle="dropdown">
                                 <i class="bi bi-funnel-fill"></i>
                                   Filter
                                </div>
                              </div>  -->
                            </div>
                             <div class="collapse pb-2 px-2" id="filter">
                                <div class="d-flex justify-content-end align-items-center">
                                     <div class="w-25 px-2 py-2">
                                         <label for="">Date</label>
                                         <input type="date" name="funeDate" id="funeDate" class="form-control">
                                     </div>

                                     <div class="w-25">
                                     Status
                                     <select id="funeStatus" class="form-select" aria-label="Default select example">
                                         <option value="Pending" class="text-danger">Pending</option>
                                         <option value="Approved" class="text-warning">Approved</option>
                                         <option value="Completed" class="text-success">Completed</option>
                                     </select>
                                   </div>
                                  </div>
                                 </div>
                    
 
                         <div class="px-2 pt-3">
                        
                              <table id="tbFuneral" class="table table-striped table-bordered table-sm rounded-2" style="width:100%">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Schedule</td>
                                        <td class="py-2 text-center">Time</td>
                                        <td class="py-2 text-center">Requested by</td>
                                        <td class="py-2 text-center">Contact Number</td>
                                        <td class="py-2 text-center">Email</td>
                                        <td class="py-2 text-center">Status</td>
                                        <td class="py-2 text-center">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                
                                      <?php
                                       $sql = "SELECT * FROM funeral_form WHERE archived = 'no'";
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
                                           <td class="text-center"><?php echo date('F d, Y',strtotime($row['sched_date']))?></td>
                                          <td class="text-center"><?php echo date('g:i A',strtotime($row['time_from'])). '-' .date('g:i A',strtotime($row['time_to']))?></td>
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
                                                           <li><a class="dropdown-item text-primary" href="edit_funeral.php?form_id=<?php echo $row['form_id']?>"><i class="bi bi-pencil-fill"></i> Edit</a></li>
                                                           <li><a class="dropdown-item text-danger"  href="archived_service.php?service=funeral&form_id=<?php echo $row['form_id']?>"><i class="bi bi-archive-fill"></i> Archive</a></li>
                                                          </ul>
                                                        </div>
                                                      
                                                         <div class="dropdown">
                                                         <button class="btnDelete btn btn-danger badge rounded-pill" data-bs-toggle="dropdown">
                                                         <i class="bi bi-printer"></i> 
                                                          Print
                                                         </button>
                                                         <ul class="dropdown-menu">
                                                         <li><a class="dropdown-item text-success" href="print_form.php?service=funeral&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
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
     <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
     <script src="../assets/js/notification.js"></script>
     <script src="../assets/js/animation.js"></script>
     <script type="text/javascript">
          $(document).ready(function(){
            let action = '<?php echo $_GET['action'] ?? ''?>';
            if (action == 'edit') {
                toastr.success('Edit Successfully', 'Edit Funeral Form');
              }
              if (action == 'archived') {
                toastr.success('Archived Successfully', 'Archived Funeral Form');
              }
            $('#services').addClass('dropdown').removeClass('dropup');
              $('.service-menus').removeClass('collapse')
              $('.funeral-link').addClass('rounded-3 bg-primary')
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


   <script>
              $('#funeDate').change(function(){
                  let funeStatus = $("#funeStatus").val();
                  let funeDate = $(this).val();
                  if (funeDate !== '' && funeStatus !=='') {
                  $('#table').html(`
                    <tr>
                       <td class="text-center py-5" colspan="7">
                         <div class='spinner spinner-border spinner-border-lg'></div>
                      </td>
                   </tr>
                 `);
                     $.ajax({
                      url: '../ajax/funeral_filter.php',
                      method: 'GET',
                      data: {
                           date: funeDate,
                           status: funeStatus
                         },
                      success: function(data){
                        $('#table').html(data)
                      }
                     })
                 }
              })

              $('#funeStatus').change(function(){
                  let funeStatus = $(this).val();
                  let funeDate = $("#funeDate").val();
                  if (funeDate !== '' && funeStatus !=='') {
                  $('#table').html(`
                    <tr>
                       <td class="text-center py-5" colspan="7">
                         <div class='spinner spinner-border spinner-border-lg'></div>
                      </td>
                   </tr>
                 `);
                     $.ajax({
                      url: '../ajax/funeral_filter.php',
                      method: 'GET',
                      data: {
                           date: funeDate,
                           status: funeStatus
                         },
                      success: function(data){
                        $('#table').html(data)
                      }
                     })
                 }

                 if (funeDate === '' && funeStatus !=='') {
                  $('#table').html(`
                    <tr>
                       <td class="text-center py-5" colspan="7">
                         <div class='spinner spinner-border spinner-border-lg'></div>
                      </td>
                   </tr>
                 `);
                     $.ajax({
                      url: '../ajax/funeral_filter.php',
                      method: 'GET',
                      data: {
                            status: funeStatus
                         },
                      success: function(data){
                        $('#table').html(data)
                      }
                     })
                 }
              })
   </script>
</body>
</html>