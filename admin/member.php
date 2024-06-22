<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';


if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  if ($_POST['submit'] === 'Create an acccount') {
       $user_id = uniqid();
       $email = $_POST['email'];
       $fname = $_POST['firstname'];
       $lname = $_POST['lastname'];
       $ministry = $_POST['ministry'];
       $password = $_POST['password'];
       $query = "SELECT email FROM user_account WHERE email = '$email'";
       $result = mysqli_query($conn, $query);
       if ($row = mysqli_fetch_assoc($result)) {
        header("Location: member.php?action=error");
        exit;
       }else{
       $query = "INSERT INTO user_account(user_id, status, email, firstname, lastname, ministry, password) 
       VALUES('$user_id', 'Verified', '$email', '$fname', '$lname', '$ministry', '$password')";
       mysqli_query($conn, $query);
       header("Location: member.php?action=add");
       exit;
       }
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
    <link href="../assets/css/bootstrap-imageupload.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/textarea/ui/trumbowyg.min.css">
    <title>User Account | Member</title>
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
    
            <!-- Modal Create New Acc -->
            <div id="modalAddAcc" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                <form name="formAddAcc" id="formAddAcc" action="member.php" method="POST">
                      <div class="modal-header">
                            <h4>Add an account</h4>
                        </div>
                         <div class="modal-body">
                          <?php if(isset($_GET['action'])):?>
                            <?php if($_GET['action'] === 'error'):?>
                              <p class="error text-center text-danger py-2" style="background:#fee2e2;">Email is already taken </p>
                            <?php endif;?>
                          <?php endif;?>

                         <form id="addAccForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                          <div id="inputField">
                            <label for="email">Email</label><br>
                           <input type="text" name="email" id="email" placeholder="Enter your Email" class="form-control" validate="required|email" value="<?php echo $email ?? ''?>">
                           <small></small>
                          </div>
                          <br>
                          <div id="inputField">
                            <label for="firstName">Firstname</label><br>
                           <input type="text" name="firstname" id="fname" placeholder="Enter your Firstname" class="form-control" validate="required|alpha" value="<?php echo $fname ?? ''?>">
                           <small></small>
                          </div>
                          <br>
                          <div id="inputField">
                            <label for="lastName">Lastname</label><br>
                           <input type="text" name="lastname" id="lname" placeholder="Enter your Lastname" class="form-control" validate="required|alpha" value="<?php echo $lname ?? ''?>">
                           <small></small>
                          </div>
                          <br>
                          <div id="select_ministry">
                              <label>Church Ministry / Group</label>
                               <select name="ministry" id="minList" class="form-select" aria-label="Default select example">
                                <option selected>Select Title...</option>
                                <option value="Kids">Kids</option>
                                <option value="Youth">Youth</option>
                                <option value="Adult">Adult</option>
                                <option value="Music Team">Music Team</option>
                               </select>
                             </div>
                          <br>
                          <div id="inputField">
                            <label for="password">Password</label><br>
                            <input type="password" name="password" id="password" placeholder="Enter your Password" class="must_match form-control" validate="required|min_length:8">
                            <small></small>
                          </div>
                          <br>
                           </div>
                          <div class="modal-footer">
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Create an acccount">
                             <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                         </div>
                       </form>
                </div>
              </div>
             </div>

            <!-- Modal Change Pass -->
            <div id="modalChangePass" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                            <h4>Change Password</h4>
                      </div>
                      <form name="formChangePass" id="formChangePass" method="POST">
                        <div class="modal-maincon">
                         <div class="modal-body">
                         </div>
                          <div class="modal-footer d-none">
                             <button class="btn btn-cancel btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Change Password">
                         </div>
                       </div>
                     </form>
                </div>
              </div>
             </div>

             <!-- Modal Change Group -->
            <div id="modalChangeGroup" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <h4>Change Ministry/Group</h4>
                      </div>
                      <form name="formChangeGroup" id="formChangeGroup" method="POST">
                        <div class="modal-maincon">
                         <div class="modal-body">
                         </div>
                          <div class="modal-footer d-none">
                             <button class="btn btn-cancel btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                             <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Change Group">
                         </div>
                       </div>
                     </form>
                </div>
              </div>
             </div>
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">User Account</li>
                    <li class="breadcrumb-item">Member</li>
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
                                        <td class="py-2 text-center">Email</td>
                                        <td class="py-2 text-center">Firstname</td>
                                        <td class="py-2 text-center">Lastname</td>
                                        <td class="py-2 text-center">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
 
                                      <?php
                                        $sql = "SELECT * FROM user_account WHERE role='Member' AND status= 'Verified' OR status = 'Banned'";
                                        $result = mysqli_query($conn, $sql);
                                      ?>
                                      <?php while($row = mysqli_fetch_assoc($result)): ?>
                                        
                                        <tr>
                                          <td class="text-center certificate">
                                            <img src="../assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="" class="prof-img"> 
                                         </td>
                                          <td class="text-center py-3"><?php echo $row['email']?></td>
                                          <td class="text-center py-3"><?php echo $row['firstname']?></td>
                                          <td class="text-center py-3"><?php echo $row['lastname']?></td>
                                           
                                          <td class="text-center py-3">
                                                        <div class="dropdown">
                                                        <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                                          Actions
                                                        </button>
                                                         <ul class="dropdown-menu">
                                                            <li  class="btn-change-pass dropdown-item text-danger" user-id="<?php echo $row['user_id']?>" data-bs-toggle="modal" data-bs-target="#modalChangePass"><i class="bi bi-key-fill"></i>  Change Password</li>
                                                            <li  class="btn-change-group dropdown-item text-primary" user-id="<?php echo $row['user_id']?>" data-bs-toggle="modal" data-bs-target="#modalChangeGroup"><i class="bi bi-people-fill"></i>  Change Group</li>
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


    
     <script src="../assets/js/animation.js"></script>
     <script src="../assets/js/validin.js"></script>
     <script src="../assets/js/notification.js"></script>
     <script>
            // CHANGE PASS
             $('.btn-change-pass').click(function(){
                let userID = $(this).attr('user-id');
                //  $('#userId').val(userID);
                $('.modal-body').html(`
                      <div class="text-center py-5">
                        <div class='spinner spinner-border spinner-border-lg'></div>
                      </div>
                `);
                   $.ajax({
                   url: 'ajax/get_change_password.php',
                   method: 'GET',
                   data: {userid: userID},
                   success: function(data){
                      $('.modal-footer').removeClass('d-none');  
                      $('.modal-body').html(data);
                   }
                 })
             
              })

              // CHANGE GROUP
              $('.btn-change-group').click(function(){
                let userID = $(this).attr('user-id');
                //  $('#userId').val(userID);
                $('.modal-body').html(`
                      <div class="text-center py-5">
                        <div class='spinner spinner-border spinner-border-lg'></div>
                      </div>
                `);
                   $.ajax({
                   url: 'ajax/get_change_group.php',
                   method: 'GET',
                   data: {userid: userID},
                   success: function(data){
                      $('.modal-footer').removeClass('d-none');  
                      $('.modal-body').html(data);
                   }
                 })
              })


              $('#formChangePass').submit(function(e){
                 e.preventDefault();
                 let formData = $(this).serialize();
                       $.ajax({
                       url: 'ajax/change_password.php',
                       method: 'POST',
                       data: formData,
                       success: function(data){
                          $('.modal-footer').addClass('d-none');
                          $('.modal-body').html(data);
                        }
                     })
               
              })

              $('#formChangeGroup').submit(function(e){
                 e.preventDefault();
                 let formData = $(this).serialize();
                       $.ajax({
                       url: 'ajax/change_group.php',
                       method: 'POST',
                       data: formData,
                       success: function(data){
                          $('.modal-footer').addClass('d-none');
                          $('.modal-body').html(data);
                        }
                     })
               
              })
 
              $('.btn-cancel').click(function(){
                $(this).parent().addClass('d-none')
              })
     </script>


     <script type="text/javascript">
        
          $(document).ready(function(){
             $('.user-menus').removeClass('collapse');
             $('.member-link').addClass('rounded-3 bg-primary');
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
           
          })
     </script>

</body>
</html>