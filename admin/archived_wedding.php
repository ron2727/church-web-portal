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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../assets/css/notification.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <title>Archived | Wedding Form</title>
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
 
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Archived</li>
                    <li class="breadcrumb-item">Service</li>
                    <li class="breadcrumb-item">Wedding</li>
                  </ol>
               </div>
                   <div class="h-50">
                       <div id="tableContainer" class="container-fluid p-0 border">
                         <div class="text-primary border-bottom px-3 py-2 d-flex justify-content-between">
                           List of Archived Wedding Form
                         </div>
 
                         <div class="px-2 pt-3">
                              <table id="tbWedding" class="table table-striped table-bordered table-sm rounded-2" style="width:100%">
                                <thead>
                                    <tr style="font-weight: bold;">
                                  
                                        <td class="py-2 text-center">Schedule</td>
                                        <td class="py-2 text-center">From</td>
                                        <td class="py-2 text-center">Phone Number</td>
                                        <td>Status</td>
                                        <td>Actions</td>
                                     </tr>
                                </thead>
                                <tbody id="table">
                                      <?php
                                       $sql = "SELECT * FROM wedding_form WHERE archived = 'yes'";
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
                                           <td class="text-center"><?php echo $row['groom_fname']?>&nbsp;<?php echo $row['groom_lname']?></td>
                                          <td class="text-center"><?php echo $row['groom_phone'] ?></td>
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
                                                         <button class="btnDelete btn btn-danger badge rounded-pill" data-bs-toggle="dropdown">
                                                         <i class="bi bi-printer"></i> 
                                                          Print
                                                         </button>
                                                         <ul class="dropdown-menu">
                                                          <li><a class="dropdown-item text-success" href="print_form.php?service=wedding&form_id=<?php echo $row['id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                                           <?php if($row['status'] == 'Completed'):?>
                                                              <li><a class="dropdown-item text-danger" href="wedding_certificate.php?form_id=<?php echo $row['id']?>" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> Certificate</a></li>
                                                           <?php endif;?>
                                                         </ul>
                                                       </div>
                                             <?php if($row['status'] !== 'Completed'):?>
                                               <a href="retrieve_service.php?service=wedding&form_id=<?php echo $row['id']?>">
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
            $('.archived-menus').removeClass('collapse');
             $('.service-archived-menus').removeClass('collapse');
                 $('.arcwedding-link').addClass('rounded-3 bg-primary');
              
                 if (action == 'retrieve') {
                toastr.success('Retrieve Successfully', 'Retrieve Wedding Form');
              }
              $('#tbWedding').DataTable({
                    autoWidth: false,
                    columnDefs: [
                                  {
                                   targets: ['_all'],
                                   className: 'mdc-data-table__cell',
                                  },
                                ],
              });
              $('.btn-copy-text').click(function(){
                new Clipboard(this);
                toastr.options = {
                  "positionClass": "toast-top-left",
                 }
                toastr.success('Copied');
              })
            //   btnCopyText.onclick = function(){
            //   let copyText = document.getElementById('trackNum');
            //   copyText.select();
            //   copyText.setSelectionRange(0, 99999);
            //   navigator.clipboard.writeText(copyText.value);
            //  }
          })
     </script>
</body>
</html>