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
    <link href="../assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/textarea/ui/trumbowyg.min.css">
    <title>Reported | Member</title>
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
 
 
 
 <!-- Optional: Place to the bottom of scripts -->
 <script>
  const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
 
 </script>
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
 

            <!-- Modal Change Pass -->
            <div id="modalChangePass" class="modal fade">
              <div class="modal-dialog">
              <form name="banAccForm" id="banAccForm" method="POST">
                 <div class="modal-content">
                      <div class="modal-header">
                            <h4>Ban Account</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                          <div class="modal-con">
                            <div class="modal-body">
                            </div>
                           <div class="modal-footer">
                              <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Ban account">
                           </div>
                         </div>
                   </div>
                </form>

              </div>
             </div>
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Forum</li>
                    <li class="breadcrumb-item">Reported Member</li>
                   </ol>
               </div>
                   <div style="height:70%">
                       <div class="container-fluid p-0 border bg-white">
                         <div class="text-primary border-bottom px-3 py-2 d-flex justify-content-between">
                              List of Member
                          </div>

                         <div id="tableContainer" class="px-5 pt-3">
                              <table id="tbBaptism" class="table table-bordered table-sm rounded-2">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Image</td>
                                        <td class="py-2 text-center">Firstname</td>
                                        <td class="py-2 text-center">Lastname</td>
                                        <td class="py-2 text-center">Banned Post</td>
                                        <td class="py-2 text-center">Banned Comment</td>
                                        <td class="py-2 text-center">Actions</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                      <?php
                                         $sql = "SELECT * FROM user_account WHERE role='Member' AND status='Verified'";
                                         $result = mysqli_query($conn, $sql);
                                      ?>
                                      <?php while($row = mysqli_fetch_assoc($result)): ?>

                                       <?php
                                          $user_id = $row['user_id'];
                                          $sql = "SELECT * FROM reported_member WHERE user_id = '$user_id'";
                                          $total_user = mysqli_query($conn, $sql);
                                       ?>
                                      <?php if(mysqli_num_rows($total_user) > 0):?>
                                        <tr>
                                          <td class="text-center certificate">
                                            <img src="../assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" class="prof-img"> 
                                         </td>
                                          <td class="text-center py-3"><?php echo $row['firstname']?></td>
                                          <td class="text-center py-3"><?php echo $row['lastname']?></td>
                                          <td class="text-center py-3">
                                              <?php
                                                 $sql = "SELECT * FROM reported_member WHERE user_id = '$user_id' AND type = 'post'";
                                                 $total_repost = mysqli_num_rows(mysqli_query($conn, $sql));
                                                 echo $total_repost;
                                              ?>
                                          </td>
                                          <td class="text-center py-3">
                                              <?php
                                                 $sql = "SELECT * FROM reported_member WHERE user_id = '$user_id' AND type = 'comment'";
                                                 $total_recom = mysqli_num_rows(mysqli_query($conn, $sql));
                                                 echo $total_recom;
                                               ?>
                                          </td>
                                          <td class="text-center py-3">
                                                        <div class="dropdown">
                                                        <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                                          Action
                                                        </button>
                                                         <ul class="dropdown-menu">
                                                            <li  class="btn-change-pass dropdown-item text-danger" user-id="<?php echo $row['user_id']?>"><i class="bi bi-person-fill-slash"></i> Ban </li>
                                                           </ul>
                                                        </div>
                                                     </td>
                                        </tr>
                                        <?php endif;?>
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
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>
     <script src="../assets/js/notification.js"></script>
     <script type="text/javascript">
        
          $(document).ready(function(){
            $('.forum-menus').removeClass('collapse');
            $('.reported-menus').removeClass('collapse');
             $('.ban_member-link').addClass('rounded-3 bg-primary');
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
              if (action == 'add') {
                toastr.success('Account has been created successfully', 'Create Account');
              }
              if (action == 'changepass') {
                toastr.success('Change Password Successfully', 'Change Password');
              }
              if (action == 'error') {
                toastr.error('Creating an account failed', 'Create Account');
              }
              $('#events').addClass('dropdown').removeClass('dropup');
              $('#formAddEvent').validin({
                required_fields_initial_error_message: "",
                form_error_message: "",
              });
          })
     </script>


<script>


             $('.btn-change-pass').click(function(){
                let userID = $(this).attr('user-id');
                $('#modalChangePass').modal('show');
                $('.modal-body').html(`
                                  <div class="text-center py-5">
                                     <div class="spinner-border text-primary"></div>
                                  </div>
                              `)
               
                 $.ajax({
                  url: '../ajax/get_duration.php',
                  method: 'GET',
                  data: {userid: userID},
                  success: function(data){
                      $('.modal-content').html(data)
                  }
                })
              })
              
              $('#banAccForm').submit(function(e){
                  e.preventDefault();
                  $.ajax({
                  url: '../ajax/ban_account.php',
                  method: 'POST',
                  data: $(this).serialize(),
                  success: function(data){
                      $('.modal-content').html(data)
                  }
                })

              })
</script>

</body>
</html>