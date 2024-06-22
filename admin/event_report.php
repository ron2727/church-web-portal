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
    <title>Report | Events</title>
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
                    <li class="breadcrumb-item">Report</li>
                    <li class="breadcrumb-item">Event</li>
                  </ol>
               </div>
                   <div class="h-50">
                       <div id="tableContainer" class="container-fluid p-0 border">
                         <div class="border-bottom px-3 pt-4 d-flex justify-content-between">
                           <form id="searchForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
                             <div id="searchInput" class="d-flex align-items-center" style="width: 600px;">

                                    <label for="">Date</label>
                                    <input type="month" name="date" id="inputSearch" placeholder="Search.." required class="form-control border-none" value="<?php echo $_GET['date'] ?? ''?>">
                                    &nbsp;&nbsp;
                                 
                                 <button type="submit" class="btn btn-primary d-flex align-items-center" style="height: 40px;"><i class="bi bi-graph-up-arrow me-2"></i> Generate</button>
                                 <a href="print_form.php?report=event&date=<?php echo $_GET['date'] ?? ''?>" target="_blank" id="btnPrint" class="nav-link px-3 py-2 border bg-danger text-white rounded-3"><div class="d-flex align-items-center"><i class="bi bi-filetype-pdf me-2"></i> Print</div></a>

                                  
                                <!-- <div class="input-group">
                                  <input type="text" name="search" id="inputSearch" placeholder="Search.." class="form-control border-none">
                                  <button id="btnSearch" class="btn btn-primary">
                                    <i class="bi bi-search text-light"></i>
                                  </button>
                                </div> -->
                            </div>
                          </form>
                         </div>

                      
 
                         <div class="px-5 pt-3">
                        
                              <table id="tbFuneral" class="table table-striped table-bordered table-sm rounded-2" style="width:100%">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Date</td>
                                        <td class="py-2 text-center">Title</td>
                                        <td class="py-2 text-center">Place</td>
                                        <td class="py-2 text-center">Time</td>
                                        <td class="py-2 text-center">Status</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                   <?php $is_data_exist = 0;?>
                                   <?php if(isset($_GET['date'])):?>
                                            <?php
                                            $report_search = date('F Y', strtotime($_GET['date']));
                                            $sql = "SELECT * FROM event WHERE status = 'Past'";
                                            $result = mysqli_query($conn, $sql);
                                           ?>
                                            <?php while($row = mysqli_fetch_assoc($result)):?>
                                                <?php $form_date = date('F Y', strtotime($row['date']))?>
                                                <?php if($report_search === $form_date):?>
                                                  <?php $is_data_exist = 1;?>  
                                                <tr>
                                                <td class="text-center"><?php echo date('F d, Y', strtotime($row['date']))?></td>
                                                <td class="text-center"><?php echo $row['title']?></td>
                                                <td class="text-center"><?php echo $row['place']?></td>
                                                <td class="text-center"><?php echo date('g:i A', strtotime($row['time']))?></td>
                                                <td class="text-center"><span class="text-white bg-success badge rounded-pill"><?php echo $row['status']?></span></td>
                                                 
                                                </tr>
                                                <?php endif;?>
                                            <?php endwhile;?>    
                                       



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
              $('.ev-report-link').addClass('rounded-3 bg-primary')
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