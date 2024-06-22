<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    if (isset($_POST['profimage'])) {
        $data = $_POST['profimage'];
        $user_id = $_SESSION['user_id'];
   
        $image1 = explode(';', $data);
        $image2 = explode(',', $image1[1]);
       $img_new_name = uniqid("PROFILE-IMG", false).'.png';
       $img_name = base64_decode($image2[1]);
       $image_name = 'assets/uploaded_images/profile/'.$img_new_name.'';
       file_put_contents($image_name, $img_name);    
    
       $query = "UPDATE user_account SET profile = '$img_new_name' WHERE user_id = '$user_id'";
       mysqli_query($conn, $query);
       header("Location: user_settings.php");
       exit;
   }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/textarea.css">
    <link rel="stylesheet" href="assets/css/crop.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Navigation</title>
    <style>

       img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
       }
       #date{
        color: #6c6c6c;
       }
       #userName{
        font-weight: bold;
       }
       #userName .name{
           font-size: 2rem;
         }
       #postedDate span{
        color: #8c8c8c;
        font-size: 0.8rem;
       }
       #btnReport:hover, #reportType p:hover{
        background-color: #f2f2f2;
       }

       @media only screen and (max-width: 765px) {
        #mainContainer{
            margin-top: 10px;
        }
         #userInfoContainer{
         /* padding: 0px; */
         padding-top: 5px;
       }
    
       #userGroup,#position{
         font-size: 0.3rem;
        }
         #profileImg{
            width: 50px;
            height: 50px;
            border-radius: 50%;
         }
       
         #userName .name{
           font-size: 1rem;
         }
         #userBio{
            font-size: 0.6rem;
         }
         .acc-nav{
            font-size: 0.6rem;
         }
        
         #img2{
          width: 35px;
          height: 35px;
          border-radius: 50%;
        }
         #groupName{
          font-size: 0.5rem;
        }
        
       .user-setting div{
         font-size: 0.5rem;
       }
       label{
        font-size: 0.8rem;
       }
       input[type=text], input[type=password]{
        height: 35px;
        font-size: 0.8rem;
       }
       }    
    </style>
</head>
<body class="bg-white">
   
  
       <?php include('forum_nav.php')?>
       
       <?php include('modal.php')?>
       
      <main>
      <div class="container-fluid">
      <div id="mainContainer" class="container border">
      <?php
     $user_id = $_SESSION['user_id'];
     $query = "SELECT * FROM user_account
     WHERE user_id = '$user_id'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
     ?>
             <div id="userInfoContainer" class="container-fluid py-3 d-flex justify-content-between align-items-center">
                    <div id="userInfo" class="d-flex align-items-center">
                        <div id="imgContainer">
                          <img id="profileImg" src="assets/uploaded_images/profile/<?php echo $row['profile']?>" alt="buere">
                        </div>
                        <div id="userNameContainer" class="ms-2">
                           <div id="userName">
                              <span class="name">
                                <?php echo $row['firstname']. ' ' .$row['lastname']?>
                              </span>
                              <?php if($row['ministry'] === 'Youth'):?> 
                                  <span id="groupName" class="badge rounded-pill bg-warning ms-1">&nbsp;Youth</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Kids'):?> 
                                 <span id="groupName" class="bg-info badge rounded-pill ms-1">Kids</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Adult'):?> 
                                 <span id="groupName" class="badge rounded-pill ms-1" style="background: #FC913A;">Adult</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Music Team'):?> 
                                 <span id="groupName" class="badge rounded-pill ms-1" style="background: #FF4E50;">Music Team</span>
                              <?php endif;?>
                              <?php if($row['ministry'] === 'Pastor'):?> 
                                 <span id="groupName" class="bg-primary badge rounded-pill ms-1">Pastor</span>
                              <?php endif;?>
                              <?php if($row['role'] === 'Admin'):?> 
                                 <span id="groupName" class="bg-primary badge rounded-pill ms-1">Admin</span>
                              <?php endif;?>
                           </div>
                           <div id="userBio">
                             <?php echo $row['bio']?> 
                           </div>
                        </div>
                    </div>
             </div>

            <nav class="navbar navbar-expand">
                <div class="container-fluid py-2 border-top border-bottom">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                           <a href="" class="acc-nav nav-link active" style="border-bottom:2px solid #121212">Account</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main container-fluid p-0" style="font-family: Poppins;">
         
                  <div class="user-setting container-fluid d-flex justify-content-between align-items-center py-3">
                      <div>Firstname</div>
                      <br>
                      <div class="text-secondary"><?php echo $row['firstname']?></div>
                   </div>
                   <div class="user-setting container-fluid d-flex justify-content-between align-items-center py-3">
                      <div>Lastname</div>
                      <br>
                      <div class="text-secondary"><?php echo $row['lastname']?></div>
                   </div>
                   <div class="user-setting container-fluid d-flex justify-content-between align-items-center py-3">
                      <div>Email</div>
                      <br>
                      <div class="text-secondary"><?php echo $row['email']?></div>
                   </div>

                  <div class="user-setting container-fluid d-flex justify-content-between align-items-center py-3">
                      <div>Change Profile Picture</div>
                      <div class="action">
                        <form id="profimgForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                          <input class="form-control-file" type="file" id="file">
                          <input type="hidden" name="profimage" id="profImage">
                          <input type="hidden" name="userid" id="userId" value="<?php echo $_SESSION['user_id']?>">
                        </form>
                      </div>
                      <div class="btn-change-prof border border-dark rounded-5 py-2 px-3" style="cursor: pointer;">Change</div>
                  </div>

                  <div class="user-setting container-fluid d-flex justify-content-between align-items-center py-3">
                      <div>Bio</div>
                      <div id="btnEditBio" class="btn-edit border border-dark rounded-5 py-2 px-3" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#EditBioModal">Change</div>
                  </div>

                  <div class="user-setting container-fluid d-flex justify-content-between align-items-center py-3">
                      <div>Change Password</div>
                      <div id="changePass" class="btn-changep border border-dark rounded-5 py-2 px-3" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#ChangePassModal">Change</div>
                  </div>

            </div>
      </div>
      </div>
        
      </main>


         <!-- Footer -->
         <footer class="bg-light text-center text-lg-start">
             <hr>
             <div id="footerText" class="text-center p-3">
                 © <?php echo date('Y')?> Copyright: Taytay Immanuel Church
              </div>
     </footer>
     <script src="assets/js/cropbox.js"></script>
     <script src="assets/js/validin.js"></script>
     <script>
                $('.action').hide();
    $(window).load(function() {
        $('.btn-change-prof').click(function(){
            $('#file').click();
        })
        $()
        var options =
        {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            // imgSrc: 'avatar.png'
        }
        var cropper = $('.imageBox').cropbox(options);
        $('#file').on('change', function(){
            $('#modalUpload').modal('show');
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = $('.imageBox').cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        })
        $('#btnCrop').on('click', function(){
            var img = cropper.getDataURL();
            $('#myImg').attr('src', img);
            $('#profImage').val(img);
            $('#profimgForm').submit()
            // $.ajax({
            //     url: 'ajax/change_profile.php',
            //     type: 'POST',
            //     data: {image: img},
            //     success: function(data){
            //          $('#fileName').html(data);
            //     }
            // })
             
        })
        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        })
        $('#btnZoomOut').on('click', function(){
            cropper.zoomOut();
        })
    });
</script>
     <script>
         $(document).ready(function(){
              $('#arrow').click(function(){
                   if ($('#arrowIcon').hasClass('down')) {
                    $('#arrowIcon').removeClass('down');
                    $('#arrowIcon').addClass('up');
                   }else{
                    $('#arrowIcon').removeClass('up');
                    $('#arrowIcon').addClass('down');
                   }
              })

              $('#changePassForm').validin({
                custom_tests: {
              'match': {
		              	'regex': null,
			              'error_message': "This not match to your password"
	            	},
              
             }
             });

       
            
             $('.btn-edit').click(function(){
                $.ajax({
                    url: 'ajax/edit_bio.php',
                    method: 'GET',
                    success: function(data){
                         $('#editBioCon').html(data);
                    }
                })
             })
             $('#editBioForm').submit(function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                    $('#editBioFormCon').html(`<div  class="text-center py-5">
                                                  <span class="spinner-border spinner-border-lg text-primary"></span>
                                                 </div>`);
                 $.ajax({
                    url: 'ajax/edit_bio.php',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                         $('#editBioCon').html(data);
                    }
                })
             })
        




             $('#changePass').click(function(){
                $.ajax({
                    url: 'ajax/change_password.php',
                    method: 'GET',
                    success: function(data){
                         $('#changePassCon').html(data);
                    }
                })
             })
             $('#changePassForm').submit(function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                    $('#changePassFormCon').html(`<div  class="text-center py-5">
                                                  <span class="spinner-border spinner-border-lg text-primary"></span>
                                                 </div>`);
                 $.ajax({
                    url: 'ajax/change_password.php',
                    method: 'POST',
                    data: formData,
                    success: function(data){
                         $('#changePassCon').html(data);
                    }
                })
             })

             
          })
     </script>
</body>
</html>