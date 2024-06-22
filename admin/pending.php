<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';
use PHPMailer\PHPMailer\PHPMailer;
require '../assets/libs/phpmailer/src/Exception.php';
require '../assets/libs/phpmailer/src/PHPMailer.php';
require '../assets/libs/phpmailer/src/SMTP.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
         $list_of_email = $_POST;
         $total_emails = count($list_of_email);
         foreach ($list_of_email as $email) {
            echo $email;
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
            $mail->Password = 'xjthcdxrvlmxchki';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
  
            $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Verification for forum';
            $mail->Body = "Good day! your account for the forum from taytayimmanuelchurch has been verified you can now login";
            $mail->send();
         }
       echo "<script>toastr.success('$total_emails has been verified', 'Verify Account');</script>";    
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
    <title>User Account | Pending</title>
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
  .certi-img{
     width:400px;
     height:400px;
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
                    <li class="breadcrumb-item">User Account</li>
                    <li class="breadcrumb-item">Pending</li>
                   </ol>
               </div>
                   <div style="height:70%">
                       <div class="container-fluid p-0 border bg-white">
                         <div class="border-bottom px-5 py-2 d-flex align-items-center justify-content-between">
                           <div class="text-primary">
                             List For Verification Account
                           </div>
                            <div class="actions d-flex align-items-center">
                                <button id="btnVerify" class="btn btn-primary me-3">
                                  <span id="loading"></span> <i class="bi bi-person-check"></i> Verify
                               </button>
                               <span class="me-2">Select All</span>
                                
                                <div class="form-check align">
                                   <input class="form-check-input" type="checkbox" id="cbSelAll" style="height:25px;width:25px;">
                                </div>
                                 
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
                                        <td class="py-2 text-center">Actions</td>
                                        <td class="py-2 text-center">Archive</td>
                                    </tr>
                                </thead>
 
                                <tbody id="table">
                                      <?php
                                        $sql = "SELECT * FROM user_account WHERE role='Member' AND status='Pending'";
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
                                                   <input class="cbox-verify form-check-input" type="checkbox" name="email<?php echo $row['user_id']?>" value="<?php echo $row['email']?>" id="cbVerify" style="width:25px; height:25px;">
                                          </td>
                                          <td class="text-center py-3">
                                             <a href="archive_user.php?userid=<?php echo $row['user_id']?>" class="nav-link"><i class="bi bi-archive-fill text-danger" style="font-size: 1.7rem;"></i></a>
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
      <script type="text/javascript">
        $('.actions').children().hide();
          $(document).ready(function(){
            let cbInput =  document.getElementsByClassName('cbox-verify');
             $('.user-menus').removeClass('collapse');
             $('.pending-link').addClass('rounded-3 bg-primary');
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
            })
           $('#btnVerify').click(function(){
            $('#loading').addClass('spinner-border spinner-border-sm text-light');
              let emaiList = [];
             for(let i = 0;i < cbInput.length; i++){
                    if (cbInput[i].checked) {
                        emaiList.push(cbInput[i].value);
                    }
               }
                  $.ajax({
                        url: 'verify_account.php',
                        type: 'POST',
                        data: {email: emaiList},
                        success: function(data){
                            $('#table').html(data);
                            $('#loading').removeClass();
                        }
                    })
           });
           
            $('.cbox-verify').click(function(){
                 let cbChecked = false;
                 $('#cbSelAll').prop('checked', false);
                 
               for(let i = 0;i < cbInput.length; i++){
                    if (cbInput[i].checked) {
                        cbChecked = true;
                     }
               }

                if (cbChecked) {
                  $('.actions').children().show();
                }else{
                  $('.actions').children().hide();
                }
            
            })
          
            let cbSelAll = document.getElementById('cbSelAll');
            
            $('#cbSelAll').click( function(){
              let isAllCbChecked = true;
                 $('.cbox-verify').prop('checked', 'checked');
                  if (!cbSelAll.checked) {
                         for(let i = 0;i < cbInput.length; i++){
                          if (!cbInput[i].checked) {
                             isAllCbChecked = false;
                           }
                         }
                      if (isAllCbChecked) {
                        for(let i = 0;i < cbInput.length; i++){
                            cbInput[i].checked = false;
                         }
                         $('.actions').children().hide();
                      }
                    }
                  //  if (!$(this).checked) {
                  //       $('.cbox-verify').prop('checked', 'checked');
                  //  }else{
                  //   alert('ASASD');
                  //  }
                  
               }
             )
                let action = '<?php echo $_GET['action'] ?? ''?>';
              if (action == 'archived') {
                toastr.success('Archived Successfully', 'Archive User Account');
              }
 
       
          })
     </script>

</body>
</html>