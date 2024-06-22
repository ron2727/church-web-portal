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
    <title>Archive | Account</title>
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
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Archived</li>
                    <li class="breadcrumb-item">Account</li>
                   </ol>
               </div>
                   <div style="height:70%">
                       <div class="container-fluid p-0 border bg-white">
                         <div class="border-bottom px-5 py-2 d-flex align-items-center justify-content-between">
                           <div class="text-primary">
                             List of Archived Account
                           </div>
                          </div>

                         <div id="tableContainer" class="px-5 pt-3">
                         <form id="verify" action="pending.php" method="post">
                              <table id="tbBaptism" class="table table-bordered table-sm rounded-2">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Certificate</td>
                                        <td class="py-2 text-center">Email</td>
                                        <td class="py-2 text-center">Firstname</td>
                                        <td class="py-2 text-center">Lastname</td>
                                         <td class="py-2 text-center">Archive</td>
                                    </tr>
                                </thead>
 
                                <tbody id="table">
                                      <?php
                                        $sql = "SELECT * FROM archived_user_account WHERE role='Member' AND status='Pending'";
                                        $result = mysqli_query($conn, $sql);
                                      ?>
                                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                                         <tr>
                                          <td class="text-center certificate" image-name="<?php echo $row['certificate_baptism']?>" data-bs-toggle="modal" data-bs-target="#showImgModal">
                                            <img src="../assets/uploaded_images/certificate_baptism/<?php echo $row['certificate_baptism']?>" alt="" class="prof-img"> 
                                         </td>
                                          <td class="text-center py-3"><?php echo $row['email']?></td>
                                          <td class="text-center py-3"><?php echo $row['firstname']?></td>
                                          <td class="text-center py-3"><?php echo $row['lastname']?></td>
 
                                          <td class="text-center py-3">
                                            <a href="retrieve_account.php?userid=<?php echo $row['user_id']?>" class="nav-link">
                                              <i class="bi bi-recycle text-danger" style="font-size: 1.7rem; cursor:pointer;"></i>
                                            </a> 
                                          </td>
                                        </tr>
                                        <?php endwhile;?>
                                  </tbody>
                               </table>
                               </form>

                         </div>
                       </div>
                   </div>
            </div>
       </div>
        
       </div>
     </div>
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>
     <script type="text/javascript">
        $('.actions').children().hide();
          $(document).ready(function(){
            let cbInput =  document.getElementsByClassName('cbox-verify');
            $('.archived-menus').removeClass('collapse');
              $('.pending-acc').addClass('rounded-3 bg-primary');
              $('#tbBaptism').DataTable({
                    autoWidth: false,
                    columnDefs: [
                                  {
                                   targets: ['_all'],
                                   className: 'mdc-data-table__cell',
                                  },
                                ],
              });
           $('.certificate').click(function(){
              let imgFilename = $(this).attr('image-name');
              $('.certi-img').attr('src', '../assets/uploaded_images/certificate_baptism/' + imgFilename);
              $('#showImgModal').modal('show');
           })
          
                 
             let action = '<?php echo $_GET['action'] ?? ''?>';
              if (action == 'retrieve') {
                toastr.success('Retrieved Successfully', 'Retrieve User Account');
              }
          })
     </script>

</body>
</html>