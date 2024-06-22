<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';
?>
<!-- Algorith to check if there completed form, if so then move them in archive -->
<?php
  $query = "UPDATE baptism_form SET archived = 'yes' WHERE status = 'Completed'";
  mysqli_query($conn, $query);
?>
<?php
$year = date("Y");
$april = date('D', strtotime("$year-04-01"));
$august = date('D', strtotime("$year-08-01"));
$december = date('D', strtotime("$year-12-01"));

   if ($april  === 'Mon') {
           $april_date = date('m/d/Y',strtotime("$year/04/07"));
    }
   if ($april === 'Tue') {
          $april_date = date('m/d/Y',strtotime("$year/04/06"));
 
   }
   if ($april === 'Wed') {
          $april_date = date('m/d/Y',strtotime("$year/04/05"));;
         
   }
   if ($april === 'Thu') {
          $april_date = date('m/d/Y',strtotime("$year/04/04"));
   }
  if ($april === 'Fri') {
          $april_date = date('m/d/Y',strtotime("$year/04/03"));
  }
  if ($april === 'Sat') {
          $april_date = date('m/d/Y',strtotime("$year/04/02"));
  }
  if ($april === 'Sun') {
          $april_date = date('m/d/Y',strtotime("$year/04/01"));
  }

  if ($august  === 'Mon') {
    $august_date = date('m/d/Y',strtotime("$year/08/07"));
}
if ($august === 'Tue') {
   $august_date = date('m/d/Y',strtotime("$year/08/06"));

}
if ($august === 'Wed') {
   $august_date = date('m/d/Y',strtotime("$year/08/05"));;
  
}
if ($august === 'Thu') {
   $august_date = date('m/d/Y',strtotime("$year/08/04"));
}
if ($august === 'Fri') {
   $august_date = date('m/d/Y',strtotime("$year/08/03"));
}
if ($august === 'Sat') {
   $august_date = date('m/d/Y',strtotime("$year/08/02"));
}
if ($august === 'Sun') {
   $august_date = date('m/d/Y',strtotime("$year/08/01"));
}

if ($december === 'Mon') {
    $december_date = date('m/d/Y',strtotime("$year/12/07"));
}
if ($december === 'Tue') {
   $december_date = date('m/d/Y',strtotime("$year/12/06"));

}
if ($december === 'Wed') {
   $december_date = date('m/d/Y',strtotime("$year/12/05"));;
  
}
if ($december === 'Thu') {
   $december_date = date('m/d/Y',strtotime("$year/12/04"));
}
if ($december === 'Fri') {
   $december_date = date('m/d/Y',strtotime("$year/12/03"));
}
if ($december === 'Sat') {
   $december_date = date('m/d/Y',strtotime("$year/12/02"));
}
if ($december === 'Sun') {
   $december_date = date('m/d/Y',strtotime("$year/12/01"));
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
    <title>Baptism | Water Baptism</title>
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
   .certi-img{
     width:100%;
     height:100%;
     object-fit: contain;
 }
</style>

<body>
     <div class="container-fluid">
      <div class="row">
       <div id="sideNav" class="col-sm-2 bg-dark p-0" style="overflow-y: auto;height:100vh;">
            <div id="navTitle" class="border-bottom text-white p-4">
                 <h3 class="text-center">Admin</h3>
            </div>
            <!-- Main nav -->
             <?php 
              include('navigation.php')
              ?>
  
       </div>
  <!-- View Image Modal -->
  <div class="modal" id="showImgModal">
               <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">View Certificate</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                     <!-- Modal body -->
                    <div class="modal-body text-center">
                       <img class="certi-img" src="" alt="certificate">
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
               </div>
            </div>
       <!-- Main content -->
       <div class="col-sm-10 p-0" style="height: 100vh; overflow:auto;">
            <!-- Top nav -->
              <?php 
              include('top_navigation.php')
              ?>
 
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Service</li>
                    <li class="breadcrumb-item">Baptism Form</li>
                  </ol>
               </div>
                   <div class="h-50">
                       <div id="tableContainer" class="container-fluid p-0 border">
                         <div class="text-primary border-bottom px-3 py-2 d-flex justify-content-between">
                           List of Baptism for youth request
                         </div>
                          <div>
                             <div class="px-5 py-3 d-flex justify-content-end">
                              <!-- <div style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#filter">
                                 <div class="border px-3" data-bs-toggle="dropdown">
                                 <i class="bi bi-funnel-fill"></i>
                                   Filter
                                </div>
                              </div>  -->
                            </div>
                             <div class="collapse pb-2" id="filter">
                                <div class="d-flex justify-content-end align-items-center">
                                     <div class="w-25 px-2 py-2">
                                        Date
                                       <select id="bapDate" class="form-select" aria-label="Default select example">
                                          <option value="<?php echo date('Y/m/d', strtotime($april_date))?>"><?php echo date('l F d, Y', strtotime($april_date))?></option>
                                         <option value="<?php echo date('Y/m/d', strtotime($august_date))?>"><?php echo date('l F d, Y', strtotime($august_date))?></option>
                                         <option value="<?php echo date('Y/m/d', strtotime($december_date))?>"><?php echo date('l F d, Y', strtotime($december_date))?></option>
                                       </select>
                                     </div>

                                     <div class="w-25">
                                     Status
                                     <select id="bapStatus" class="form-select" aria-label="Default select example">
                                         <option value="Pending" class="text-danger">Pending</option>
                                         <option value="Approved" class="text-warning">Approved</option>
                                         <option value="Completed" class="text-success">Completed</option>
                                     </select>
                                   </div>
                                  </div>
                                 </div>
                                  
                           </div>
 
                         <div class="px-2 pt-3">
                        
                              <table id="tbBaptism" class="table table-striped table-bordered table-sm rounded-2" style="width:100%">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Date of Baptism</td>
                                        <td class="py-2 text-center">Applicant's Name</td>
                                        <td class="py-2 text-center">Time</td>
                                        <td class="py-2 text-center">Telephone</td>
                                        <td class="py-2 text-center">Status</td>
                                        <td class="py-2 text-center">Action</td>
                                        
                                    </tr>
                                </thead>
 
                                <tbody id="table">
                                      <?php
                                       $sql = "SELECT * FROM baptism_form WHERE baptism_type = 'youth' AND archived = 'no'";
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
                                          <td class="text-center"><?php echo $row['firstname']?>&nbsp;<?php echo $row['lastname']?></td>
                                          <td class="text-center"><?php echo date('g:i A',strtotime($row['time_from'])). ' ' .date('g:i A',strtotime($row['time_to']))?></td>
                                          <td class="text-center"><?php echo $row['telephone'] ?></td>
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
                                                        <?php if($row['age'] < 18):?>
                                                           <li><h3 class="dropdown-header"><i class="bi bi-clipboard2-fill"></i>Form</h3></li>
                                                           <li><a class="dropdown-item text-muted" href="print_form.php?type=youth&service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank">Baptism</a></li>
                                                           <li><a class="dropdown-item text-muted" href="print_form.php?service=consent&form_id=<?php echo $row['form_id']?>" target="_blank">Consent</a></li>
                                                           <li><h5 class="dropdown-header text-primary"><i class="bi bi-pencil-fill"></i> Edit</h5></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_baptism.php?type=youth&service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank">Baptism</a></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_consent.php?service=consent&form_id=<?php echo $row['form_id']?>" target="_blank">Consent</a></li>
                                                          <?php else:?>
                                                           <li><a class="dropdown-item text-muted" href="print_form.php?type=youth&service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                                           <li><a class="dropdown-item text-primary" href="edit_baptism.php?type=youth&form_id=<?php echo $row['form_id']?>"><i class="bi bi-pencil-fill"></i> Edit</a></li>
                                                          <?php endif;?>
                                                          <li><a class="dropdown-item certificate text-info" image-name="<?php echo $row['birth_certificate']?>" data-bs-toggle="modal" data-bs-target="#showImgModal"><i class="bi bi-card-checklist"></i> PSA</a></li>
                                                           <li><a class="dropdown-item text-danger" href="archived_service.php?service=baptism&form_id=<?php echo $row['form_id']?>"><i class="bi bi-archive-fill"></i> Archive</a></li>
                                                         </ul>
                                                        </div>
                                                      
                                                         <div class="dropdown">
                                                         <button class="btnDelete btn btn-danger badge rounded-pill" data-bs-toggle="dropdown">
                                                         <i class="bi bi-printer"></i> 
                                                          Print
                                                         </button>
                                                         <ul class="dropdown-menu">
                                                          <li><a class="dropdown-item text-success" href="print_form.php?type=youth&service=baptism&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-clipboard2-fill"></i> Form</a></li>
                                                          <?php if($row['status'] == 'Completed'):?>
                                                            <li><a class="dropdown-item text-danger" href="baptism_certificate.php?type=youth&form_id=<?php echo $row['form_id']?>" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> Certificate</a></li>
                                                          <?php endif;?>
                                                            
                                                         </ul>
                                                         </div>
                                                         <!-- <a class="dropdown-item text-danger" href="#"><i class="bi bi-archive-fill"></i> Archive</a> -->
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
     <script>
            $('.certificate').click(function(){
              let imgFilename = $(this).attr('image-name');
               $('.certi-img').attr('src', '../assets/uploaded_images/birth_certificate/' + imgFilename);
             })
     </script>
     <script type="text/javascript">
          $(document).ready(function(){
            let action = '<?php echo $_GET['action'] ?? ''?>';
            if (action == 'edit-baptism') {
                toastr.success('Edit Successfully', 'Edit Baptism Form');
              }
              if (action == 'edit-consent') {
                toastr.success('Edit Successfully', 'Edit Baptism Consent Form');
              }
              if (action == 'archived') {
                toastr.success('Archived Successfully', 'Archived Baptism Form');
              }
              
             $('#services').addClass('dropdown').removeClass('dropup');
              $('.service-menus').removeClass('collapse')
              $('.bap-menus').removeClass('collapse')
              $('.youth-link').addClass('rounded-3 bg-primary')
              $('#tbBaptism').DataTable({
                    autoWidth: false,
                    columnDefs: [
                                  {
                                   targets: ['_all'],
                                   className: 'mdc-data-table__cell',
                                  },
                                ],
              });
             
            

              $('#bapDate').change(function(){
                  let bapDate = $(this).val();
                  let bapStatus = $("#bapStatus").val();
                  if (bapDate !== '') {
                  $('#table').html(`
                    <tr>
                       <td class="text-center py-5" colspan="7">
                         <div class='spinner spinner-border spinner-border-lg'></div>
                      </td>
                   </tr>
                 `);
                     $.ajax({
                      url: '../ajax/baptism_yfilter.php',
                      method: 'GET',
                      data: {
                           date: bapDate,
                           status: bapStatus
                         },
                      success: function(data){
                        $('#table').html(data)
                      }
                     })
                 }
              })

              $('#bapStatus').change(function(){
                  let bapStatus = $(this).val();
                  let bapDate = $("#bapDate").val();
                  if (bapDate !== '' && bapStatus !=='') {
                  $('#table').html(`
                    <tr>
                       <td class="text-center py-5" colspan="7">
                         <div class='spinner spinner-border spinner-border-lg'></div>
                      </td>
                   </tr>
                 `);
                     $.ajax({
                      url: '../ajax/baptism_yfilter.php',
                      method: 'GET',
                      data: {
                           date: bapDate,
                           status: bapStatus
                         },
                      success: function(data){
                        $('#table').html(data)
                      }
                     })
                 }
              })

 



          })
     </script>
 

</body>
</html>