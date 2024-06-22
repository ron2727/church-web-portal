<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';


// if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
//   if ($_POST['submit'] === 'Create an acccount') {
//        $user_id = uniqid();
//        $email = $_POST['email'];
//        $fname = $_POST['firstname'];
//        $lname = $_POST['lastname'];
//        $ministry = $_POST['ministry'];
//        $password = $_POST['password'];
//        $query = "SELECT email FROM user_account WHERE email = '$email'";
//        $result = mysqli_query($conn, $query);
//        if ($row = mysqli_fetch_assoc($result)) {
//         header("Location: member.php?action=error");
//         exit;
//        }else{
//        $query = "INSERT INTO user_account(user_id, status, email, firstname, lastname, ministry, password) 
//        VALUES('$user_id', 'Verified', '$email', '$fname', '$lname', '$ministry', '$password')";
//        mysqli_query($conn, $query);
//        header("Location: member.php?action=add");
//        exit;
//        }
//   }
//   if ($_POST['submit'] === 'Change Password') {
//     $user_id = $_POST['userid'];
//     $password = $_POST['password'];
//     $query = "UPDATE user_account SET password = '$password' WHERE user_id = '$user_id'";
     
//     mysqli_query($conn, $query);
//     header("Location: member.php?action=changepass");
//     exit;
//  }

// }
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
    <title>Reported | Comment</title>
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
   .prof-img, .post-from-img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
       }
       .check-post{
        cursor: pointer;
       }
       .check-post:hover{
        text-decoration: underline;
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
        
            <!-- Modal Change Pass -->
            <div id="modalViewRepDetails" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                       <div class="modal-header">
                            <h4>Report Details</h4>
                        </div>
                         <div class="modal-bancon py-2">
                             <div id="modalBody" class="modal-body">
                        
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="button" id="btnBan">Ban Comment</button>
                            </div>
                          </div>
                 </div>
              </div>
             </div>
            <!-- Table Section -->
            <div class="container-fluid h-80">
              <div class="py-2" aria-labelledby="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Forum</li>
                    <li class="breadcrumb-item">Reported Comment</li>
                   </ol>
               </div>
             
                   <div style="height:70%">
                       <div class="container-fluid p-0 border bg-white">
                         <div class="border-bottom px-3 py-2 d-flex justify-content-between">
                         <div class="text-primary px-3 py-2 d-flex justify-content-between">
                           List of Reported Comment
                         </div>
                          </div>

                         <div id="tableContainer" class="px-5 pt-3">
                              <table id="tbBaptism" class="table table-bordered table-sm rounded-2">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td class="py-2 text-center">Owner</td>
                                        <td class="py-2 text-center">Reported by</td>
                                        <td class="py-2 text-center">Reason</td>
                                         <td class="py-2 text-center">Action</td>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                        
                                <?php
                       $query = "SELECT comment_id, user_id, post_id FROM comment WHERE status != 'Banned'";
                       $result = mysqli_query($conn, $query);
                     ?>
                     <?php while($comment = mysqli_fetch_assoc($result)):?>
                            <?php
                             $post_id = $comment['post_id'];
                             $comment_id = $comment['comment_id'];
                             $com_userid = $comment['user_id'];
                             $query = "SELECT * FROM reported_comment
                                        WHERE comment_id = '$comment_id'";
                             $comment_reported = mysqli_query($conn, $query);
                             ?>
                            <?php if(mysqli_num_rows($comment_reported) > 0):?>
                                 <?php 
                                   $query = "SELECT firstname, lastname FROM user_account WHERE user_id = '$com_userid'";
                                   $created_by = mysqli_fetch_assoc(mysqli_query($conn, $query));
                                 ?>
                            <tr>   
                                <td class="text-center py-3"><?php echo $created_by['firstname']. ' ' .$created_by['lastname']?></td>
                                <?php 
                                  $query = "SELECT reported_by FROM reported_comment WHERE comment_id = '$comment_id'";
                                  $list_of_reporter = mysqli_query($conn, $query);
                                 ?>
                                <td class="text-center py-3">       
                                       <?php while($reported_by = mysqli_fetch_assoc($list_of_reporter)){
                                           $user_id = $reported_by['reported_by'];
                                           $query = "SELECT firstname, lastname FROM user_account WHERE user_id = '$user_id'";
                                           $name = mysqli_fetch_assoc(mysqli_query($conn, $query));

                                           echo $name['firstname']. ' ' .$name['lastname']. ', ';
                                       }?>
                                </td>
                                <?php 
                                  $query = "SELECT reason FROM reported_comment WHERE comment_id = '$comment_id'";
                                  $reasons = mysqli_query($conn, $query);
                                 ?>
                                <td class="text-center py-3">       
                                       <?php while($reason = mysqli_fetch_assoc($reasons)){
                                          echo $reason['reason']. ', ';
                                       }?>
                                </td>
                                <td class="text-center py-3">
                                      <div class="dropdown">
                                          <button class="btnEdit btn btn-primary badge rounded-pill" data-bs-toggle="dropdown"> 
                                             Actions
                                          </button>
                                             <ul class="dropdown-menu">
                                               <li><a class="dropdown-item text-info" href="../view_post.php?post_id=<?php echo $post_id?>" target="_blank"><i class="bi bi-search"></i> View Comment</a></li>
                                               <li class="open-modal" post-id="<?php echo $post_id?>" comment-id = "<?php echo $comment_id?>"  com-userid = "<?php echo $com_userid?>" data-bs-toggle="modal" data-bs-target="#modalViewRepDetails"><a class="dropdown-item text-info"><i class="bi bi-search"></i> Report Details</a></li>
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
              let commentID = 0;
              let comUserID = '';
              let postID = 0;
            //   $('#modalViewRepDetails').modal('show');
             $('.forum-menus').removeClass('collapse');
             $('.reported-menus').removeClass('collapse');
             $('.reported_topic-link').addClass('rounded-3 bg-primary');
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
              $('.open-modal').click(function(){
                 postID = $(this).attr('post-id');
                 commentID = $(this).attr('comment-id');
                 comUserID = $(this).attr('com-userid');
                 $.ajax({
                        url: 'report_details.php',
                        type: 'POST',
                        data: {commentid: commentID},
                        success: function(data){
                            $('#modalBody').html(data);
                            $
                         }
                    })
              })
              $('#btnBan').click(function(){
                   $.ajax({
                        url: 'ban_post.php',
                        type: 'POST',
                        data: {
                               postid: postID,
                               commentid: commentID,
                               com_userid: comUserID,
                             },
                        success: function(data){
                            $('.modal-bancon').html(data);
                            $
                         }
                    })
              })
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

</body>
</html>