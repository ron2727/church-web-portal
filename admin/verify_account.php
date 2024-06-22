<?php
require __DIR__ .'/../assets/database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
require '../assets/libs/phpmailer/src/Exception.php';
require '../assets/libs/phpmailer/src/PHPMailer.php';
require '../assets/libs/phpmailer/src/SMTP.php';
$total_emails = count($_POST['email']);
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $list_of_email = $_POST['email'];
    $total_emails = count($list_of_email);
    foreach ($list_of_email as $email) {
        $mail = new PHPMailer(true);

       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = true;
       $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
       $mail->Password = 'rkohzkddhnaqswvb';
       $mail->SMTPSecure = 'ssl';
       $mail->Port = 465;

       $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
       $mail->addAddress($email);
       $mail->isHTML(true);
       $mail->Subject = 'Verification for forum';
       $mail->Body = '
        <div style="background:#ffffff;padding:20px 50px 20px 50px">
             <div style="padding:0px; text-align: center;">
               <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
             </div>
             <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
              <br>
              <p style="color:#355C7D;font-size:1.2rem">Good day!</p>
              <p style="color:#355C7D;font-size:1.2rem">Your account for the forum from taytayimmanuelchurch has been verified you can now login</p>
              <p style="color:#355C7D;font-size:1.2rem">Thank You!</p>
               <br>
              <p style="font-weight:bold;color:#355C7D;font-size:1.2rem">You can login here:</p>
             <br>
              <div>
                        <a href="https://taytayimmanuelchurch.online/forum_guest.php" style="text-decoration:none;padding:20px 40px 20px 40px;font-weight:bold; font-size: 1.5rem;background:#0275d8;color:#ffffff;">
                            FORUM
                        </a>
               </div>
          </div>
       ';
       $mail->send();
       
       $query = "UPDATE user_account SET status = 'Verified' WHERE email = '$email'";
       mysqli_query($conn, $query);
    }
 }
?>
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
                                        </tr>
                                        <?php endwhile;?>


<script>

     toastr.success('<?php echo $total_emails?> accounts has been verified successfully', 'Verify Account');
    $('#btnVerify').attr('disabled', 'true');
    $('.cbox-verify').click(function(){

                 let cbChecked = false;
                    let cbInput =  document.getElementsByClassName('cbox-verify');

               for(let i = 0;i < cbInput.length; i++){
                    if (cbInput[i].checked) {
                        cbChecked = true;
                    }
               }
                if (cbChecked) {
                     $('#btnVerify').removeAttr('disabled');
                }else{
                    $('#btnVerify').attr('disabled', 'true');
                }
            
            })
</script>