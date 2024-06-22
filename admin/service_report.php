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
    <title>Report | Service</title>
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
                         <div class="border-bottom px-3 pt-4 d-flex justify-content-between">
                           <form id="searchForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
                             <div id="searchInput" class="d-flex align-items-end" style="width: 700px;">
                                     <div id="selService" class="me-1">
                                      <label for="">Service</label>
                                      <select name="service" id="service" class="form-select">
                                        <?php if(isset($_GET['service'])):?>
                                           <option value="<?php echo $_GET['service']?>" selected><?php echo ucfirst($_GET['service'])?></option>
                                           <option value="funeral">Funeral</option>
                                           <option value="wedding">Wedding</option>
                                           <option value="baptism">Baptism</option>
                                        <?php else:?>
                                            <option value="funeral">Funeral</option>
                                            <option value="wedding">Wedding</option>
                                            <option value="baptism">Baptism</option>
                                        <?php endif;?>
                                      </select>
                                     </div>
                                     <div id="selType" class="me-1">
                                      
                                     </div>

                                
                                     &nbsp; 
                                 
                                    <div id="inputDate">
                                     <label for="">Date</label>
                                     <input type="month" name="date" id="date" placeholder="Search.." required class="form-control border-none" value="<?php echo $_GET['date'] ?? ''?>">
                                    </div>
                                    &nbsp;&nbsp;
                                 
                                 <button type="submit" class="btn btn-primary d-flex align-items-center" style="height: 40px;"><i class="bi bi-graph-up-arrow me-2"></i> Generate</button>
                                 <a href="print_form.php?report=<?php echo $_GET['service'] ?? ''?>&date=<?php echo $_GET['date'] ?? ''?>&bapType=<?php echo $_GET['bapType'] ?? ''?>" target="_blank" id="btnPrint" class="nav-link px-3 py-2 border bg-danger text-white rounded-3"><div class="d-flex align-items-center"><i class="bi bi-filetype-pdf me-2"></i> Print</div></a>

                            </div>
                          </form>
                         </div>

                      
 
                         <div class="px-5 pt-3">
                        
                              <table id="tbFuneral" class="table table-striped table-bordered table-sm rounded-2" style="width:100%">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Date</td>
                                        <td class="py-2 text-center">Name</td>
                                        <td class="py-2 text-center">Service</td>
                                        <td class="py-2 text-center">Status</td>
                                        <td class="py-2 text-center">Contact Number</td>
                                        <td class="py-2 text-center">Email</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                   <?php $is_data_exist = 0;?>
                                   <?php if(isset($_GET['service'])):?>
                                      <!-- Funeral -->
                                      <?php if($_GET['service'] === 'funeral'):?>
                                          <?php
                                            $report_search = date('F Y', strtotime($_GET['date']));
                                            $sql = "SELECT * FROM funeral_form WHERE status = 'Completed'";
                                            $result = mysqli_query($conn, $sql);
                                           ?>
                                            <?php while($row = mysqli_fetch_assoc($result)):?>
                                                <?php $form_date = date('F Y', strtotime($row['sched_date']))?>
                                                <?php if($report_search === $form_date):?>
                                                  <?php $is_data_exist = 1;?>  
                                                <tr>
                                                <td class="text-center"><?php echo date('F d, Y', strtotime($row['sched_date']))?></td>
                                                <td class="text-center"><?php echo $row['applicant_fname']. ' ' .$row['applicant_lname']?></td>
                                                <td class="text-center"><?php echo $row['service'] ?></td>
                                                <td class="text-center">
                                                    <?php
                                                      if ($row['status'] === 'Pending') {
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
                                                <td class="text-center"><?php echo $row['applicant_contactnum'] ?></td>
                                                <td class="text-center"><?php echo $row['applicant_email'] ?></td>
                                                </tr>
                                                <?php endif;?>
                                            <?php endwhile;?>    
                                       <?php endif;?>
                                     
                                     <!-- Wedding -->
                                       <?php if($_GET['service'] === 'wedding'):?>
                                          <?php
                                            $report_search = date('F Y', strtotime($_GET['date']));
                                            $sql = "SELECT * FROM wedding_form WHERE status = 'Completed'";
                                            $result = mysqli_query($conn, $sql);
                                           ?>
                                            <?php while($row = mysqli_fetch_assoc($result)):?>
                                                <?php $form_date = date('F Y', strtotime($row['sched_date']))?>
                                                <?php if($report_search === $form_date):?>
                                                  <?php $is_data_exist = 1;?>  
                                                <tr>
                                                <td class="text-center"><?php echo date('F d, Y', strtotime($row['sched_date']))?></td>
                                                <?php if($row['applicant'] === 'groom'):?>
                                                      <td class="text-center"><?php echo $row['groom_fname']. ' ' .$row['groom_lname']?></td>
                                                   <?php endif;?>
                                                   <?php if($row['applicant'] === 'bride'):?>
                                                      <td class="text-center"><?php echo $row['groom_fname']. ' ' .$row['bride_lname']?></td> 
                                                   <?php endif;?>
                                                <td class="text-center"><?php echo $row['service'] ?></td>
                                                <td class="text-center">
                                                    <?php
                                                      if ($row['status'] === 'Pending') {
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
                                                   <?php if($row['applicant'] === 'groom'):?>
                                                      <td class="text-center"><?php echo $row['groom_phone'] ?></td>
                                                      <td class="text-center"><?php echo $row['groom_email'] ?></td>
                                                   <?php endif;?>
                                                   <?php if($row['applicant'] === 'bride'):?>
                                                      <td class="text-center"><?php echo $row['bride_phone'] ?></td>
                                                      <td class="text-center"><?php echo $row['bride_email'] ?></td>
                                                   <?php endif;?>
                                                </tr>
                                                <?php endif;?>
                                            <?php endwhile;?>    
                                       <?php endif;?>

                                       <!-- baptism -->
                                       <?php if($_GET['service'] === 'baptism'):?>
                                          <?php
                                            $type = $_GET['bapType'];
                                            $report_search = date('F Y', strtotime($_GET['date']));
                                            $sql = "SELECT * FROM baptism_form WHERE status = 'Completed' AND baptism_type = '$type'";
                                            $result = mysqli_query($conn, $sql);
                                           ?>
                                            <?php while($row = mysqli_fetch_assoc($result)):?>
                                                <?php $form_date = date('F Y', strtotime($row['sched_date']))?>
                                                <?php if($report_search === $form_date):?>
                                                  <?php $is_data_exist = 1;?>  
                                                <tr>
                                                <td class="text-center"><?php echo date('F d, Y', strtotime($row['sched_date']))?></td>
                                                <td class="text-center"><?php echo $row['firstname']. ' ' .$row['lastname']?></td>
                                                <td class="text-center"><?php echo $row['service'] ?></td>
                                                <td class="text-center">
                                                    <?php
                                                      if ($row['status'] === 'Pending') {
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
                                                       <td class="text-center"><?php echo $row['telephone'] ?></td>
                                                      <td class="text-center"><?php echo $row['email'] ?></td>
                                                     
                                                </tr>
                                                <?php endif;?>
                                            <?php endwhile;?>    
                                       <?php endif;?>



                                    <?php endif;?>
                                    
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
             let isReportExist = <?php echo $is_data_exist?>;
             $('#btnPrint').hide(); 
             if (isReportExist) {
                 $('#btnPrint').show();
             }else{
                 $('#btnPrint').hide();
             }
          
             let action = '<?php echo $_GET['action'] ?? ''?>';
            if (action == 'edit') {
                toastr.success('Edit Successfully', 'Edit Funeral Form');
              }
            $('#services').addClass('dropdown').removeClass('dropup');
              $('.report-menus').removeClass('collapse')
              $('.ser-report-link').addClass('rounded-3 bg-primary')
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

        // $('#selType').hide();
       <?php if(isset($_GET['bapType'])):?>
        $('#selType').html(`
                                      <label for="">Type</label>
                                       <select name="bapType" id="bapType" class="form-select">
                                       <?php if(isset($_GET['bapType'])):?>
                                           <option value="<?php echo $_GET['bapType']?>" selected><?php echo $_GET['bapType'] === 'child' ? 'Child Dedication' : 'Water Baptism'?></option>
                                           <option value="child">Child Dedication</option>
                                            <option value="youth">Water Baptism</option>
                                        <?php else:?>
                                          <option value="child">Child Dedication</option>
                                            <option value="youth">Water Baptism</option>
                                        <?php endif;?>
                                       </select>
            `);
       <?php endif?>

       $('#service').change(function(){
          let service = $(this).val();
          if (service === 'baptism') {
            $
            $('#selType').html(`
                                      <label for="">Type</label>
                                       <select name="bapType" id="bapType" class="form-select">
                                            <option value="child">Child Dedication</option>
                                            <option value="youth">Water Baptism</option>
                                        </select>
            `);
            $('#bapType').Attr('required', 'true');

             // $('#date').removeAttr('required');
          }else{
            $('#selType').html('');
           }
       })
      //  $('#service').change(function(){
      //     let service = $(this).val();
      //     if (service === 'baptism') {
      //       $('#selType').show();
      //       $('#bapType').Attr('required', 'true');

      //       $('#inputDate').hide();
      //       // $('#date').removeAttr('required');
      //     }else{
      //       $('#inputDate').show();
      //        $('#selType').hide();
      //      }
      //  })

      //  $('#bapType').change(function(){
      //     let bapType = $(this).val();
      //     if (bapType === 'youth') {
      //       $('#inputDate').hide();
      //       $('#selDate').show();
      //      }else{
      //       $('#inputDate').show();
      //       $('#selDate').hide();
      //      }
      //  })
     </script>
</body>
</html>