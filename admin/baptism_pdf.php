<?php
require __DIR__ .'/../assets/database/connection.php';
if (isset($_GET['form_id'])) {
  $form_id = $_GET['form_id'];
    $query = "SELECT * FROM baptism_form
              WHERE form_id = '$form_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Pdf</title>
    <style>
        p{
          font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        body{
           margin-top: 0.5in;
           margin-bottom: 0.5in;
           margin-left: 0.5in;
           margin-right: 0.5in;
           /* padding-top: 1in;
           padding-bottom: 1in;
           padding-left: 53px;
           padding-right: 53px; */
        }
       #head{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 11;
        padding: 0px;
        margin: 0px;
       }
       table{
        width: 100%;
       }
       td{
        text-align: left;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 12;
       }
       .table-image{
        height: 144px;
       }
       .table-image tr td{
        height: 48px;
       }
 
       span{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 0px;
        margin: 0px;
        font-size: 12;

       }
       #titleHeader{
        position: absolute;
       }
 
      img{
        height: 54px;
        width: 158px;
      }
      .bold{
        font-weight: bold;
      }
      .underline{
        text-decoration: underline;
      }
      p.header{
        font-size: 16;
        font-weight: bold;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      }
    </style>
</head>
<body>

          
           <img style="display: inline;" src="img/tic-logo.jpg" alt="">
        <div id="titleHeader">
              <span id="head" style="font-weight: bold; font-size: 12;">TAYTAY IMMANUEL CHURCH</span><br>
              <span id="head">Road 20, Siwang San Juan Taytay Rizal</span><br>
              <span id="head">Tel. 87153967; Email: immanuelchurch22@gmail.com</span>
        </div>
        <hr>
        <br>
        <br>
     <?php if($_GET['type'] === 'youth'):?>
      <p class="header" style="font-weight: bold;text-align:center;">APPLICATION FOR WATER BAPTISM</p>
        <br><br>
        <table class="table-image">
            <tr>
                <td>Date of Application: <span class="underline"><?php echo date('F d, Y', strtotime($row['date_of_application']))?></span></td>
                <!-- <td rowspan="3" class="app-img">
                 <img src="img/buere.jpg" alt="" style="height: 144px; width:154px; float:right;">  
               </td> -->
               <td rowspan="3" class="app-img">
                <?php if(!empty($row['image'])):?>
                  <img src="../assets/uploaded_images/baptism/<?php echo $row['image']?>" alt="2x2" style="height: 144px; width:154px; float:right;"> 
                  <?php else:?>
                 <div style="height: 144px; text-align:center; width:154px; float:right; border:1px solid #121212;">
                   <br><br> Affix <br> Photo <br> Here 
                 </div>
                 <?php endif;?>
               </td>
            </tr>
            <tr>
                <td>Title: <span class="underline"><?php echo $row['title']?></td>
            </tr>
            <tr>
                <td>Applicant's Name: <span class="underline"><?php echo $row['firstname']?>&nbsp;<?php echo $row['lastname']?></span></td>
            </tr>
        </table>
        <br>
        <span>Address: </span><span class="underline"><?php echo $row['address']?></span>
        <br><br>
        <span>Email: </span><span class="underline"><?php echo $row['email']?></span>
        <br><br>
        <table>
            <tr>
                <td>Telephone: <span class="underline"><?php echo $row['telephone']?></span></td>
                <td>Date of Birth: <span class="underline"><?php echo date('F d, Y', strtotime($row['date_of_birth'])) ?? "N/A"?></span></td>
             </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>Nationality: <span class="underline"><?php echo $row['nationality']?></span></td>
                <td>Occupation: <span class="underline"><?php echo $row['occupation']?></span></td>
             </tr>
        </table>
        <br>
        <span>Marital Status: </span><span class="underline"><?php echo $row['marital_status']?></span>
        <br><br>
        <br>
        <span>Name of the Kingdom group (If applicable): </span><span class="underline"><?php echo $row['kingdom_group']?></span>
        <br><br>
        <p class="header" style="text-align:center;">PERSONAL HISTORY </p>
        <br>
        <span>Date of Salvation if applicable (DD/MM/YY): </span><span class="underline"><?php echo $row['date_of_salvation'] === '0000-00-00' ?  "N/A" : date('d, F Y', strtotime($row['date_of_salvation']))?></span>
        <br><br>
        <table>
            <tr>
                <td>
                Attend Worship regularly?
             <span style="position:relative; bottom: -5">
            <?php if($row['attend_worship'] === 'Yes'):?>
            <sup><input type="checkbox" checked style="font-size: 20px;">Yes</sup>
            <sup><input type="checkbox" style="font-size: 20px;">No</sup>
            <?php else:?>
            <sup><input type="checkbox" style="font-size: 20px;">Yes</sup>
            <sup><input type="checkbox" checked style="font-size: 20px;">No</sup>
              <?php endif;?>
          </span>    
              </td>
                <td>Starting from (DD/MM/YY): <span class="underline"><?php echo $row['starting_from'] === '0000-00-00' ?  "N/A" : date('d, F Y', strtotime($row['starting_from']))?></span></td>
             </tr>
        </table>
        <br><br>
        <p class="header" style="text-align:center;">PERSONAL TESTIMONY</p>
        <br>
        <span>Write a short testimony of what Christ has done in your life. <br> </span><span class="underline"><?php echo $row['testimony']?></span>
        <br><br>
        <p class="header" style="text-align:center;">PRE-REQUISITES FOR WATER BAPTISM</p>
        <br>
        <table>
          <tr>
            <td><span style="float: left;">1.</span></td>
            <td>I believe that Jesus Christ died on the cross for my sins and I am appropriating it by faith for my forgiveness, that salavation is by grace through faith <br> (Acts 2:38, Eph. 1:17-18; Ephesians 2:8)
            <span style="position:relative; bottom: -5">
            <?php if($row['pre_req1'] === 'Yes'):?>
            <sup><input type="checkbox" checked style="font-size: 20px;">Yes</sup>
            <sup><input type="checkbox" style="font-size: 20px;">No</sup>
            <?php else:?>
            <sup><input type="checkbox" style="font-size: 20px;">Yes</sup>
            <sup><input type="checkbox" checked style="font-size: 20px;">No</sup>
              <?php endif;?>
            </span>
          </td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td><span style="float: left;">2.</span></td>
            <td>The Bible forbids Christians to any form of idolatry (worship of false god) <br>  (Acts 2:38, Eph. 1:17-18; Ephesians 2:8)
            <span style="position:relative; bottom: -5">
            <?php if($row['pre_req1'] === 'Yes'):?>
            <sup><input type="checkbox" checked style="font-size: 20px;">Yes</sup>
            <sup><input type="checkbox" style="font-size: 20px;">No</sup>
            <?php else:?>
            <sup><input type="checkbox" style="font-size: 20px;">Yes</sup>
            <sup><input type="checkbox" checked style="font-size: 20px;">No</sup>
              <?php endif;?>
            </span>  
            <br>
          </td>
          </tr>
        </table>
        <br>
        <p class="header" style="font-size:12">PREVIOUS RELIGION (Please Tick Appropriate Box)</p>
        <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['prev_religion'] ===  'Iglesia ni Kristo' ? 'checked': ''?>>Iglesia ni Kristo</sup>
        <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['prev_religion'] ===  'Ang Dating Daan' ? 'checked': ''?>>Ang Dating Daan</sup>
        <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['prev_religion'] ===  'Catholicism' ? 'checked': ''?>>Catholicism</sup>
        <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['prev_religion'] ===  'Jehovahs Witnesses' ? 'checked': ''?>>Jehovahs Witnesses</sup>
        <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['prev_religion'] ===  'Islam' ? 'checked': ''?>>Islam</sup>
        <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['prev_religion'] ===  'Church of Jesus Christ of Latter Day Saints (Mormons)' ? 'checked': ''?>>Church of Jesus Christ of Latter Day Saints (Mormons)</sup>
        <br>
        <br>
        <table>
          <tr>
            <td>_____________________</td>
            <td><span class="underline"><?php echo date('F d, Y', strtotime($row['date_of_application']))?></span></td>
          </tr>
          <tr>
            <td>Signature of Applicant</td>
            <td>Date</td>
          </tr>
        </table>
        <br>
        <p class="header" style="font-size:12;text-align:center;">        -------------------------------CHURCHOFFICE USE ONLY----------------------------- </p>
        <br>
        <span>Date of Baptism: </span><span class="underline"><?php echo date('d, F Y', strtotime($row['sched_date']))?></span>
        <br><br>
        <br>
         <br><br>
     <?php endif;?>









        <?php if($_GET['type'] === 'child'):?>
          <?php
            $query = "SELECT * 
            FROM baptism_form
            INNER JOIN baptism_consent ON baptism_form.form_id = baptism_consent.form_id
            WHERE baptism_form.form_id = '$form_id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
            ?>
          <p class="header" style="font-weight: bold;text-align:center;">APPLICATION FOR CHILD DEDICATION</p>
        <br><br>
        <table class="table-image">
            <tr>
                <td>Date of Application: <span class="underline"><?php echo date('F d, Y', strtotime($row['date_of_application']))?></span></td>
                <!-- <td rowspan="3" class="app-img">
                 <img src="img/buere.jpg" alt="" style="height: 144px; width:154px; float:right;">  
               </td> -->
               <td rowspan="3" class="app-img">
                <?php if(!empty($row['image'])):?>
                  <img src="../assets/uploaded_images/baptism/<?php echo $row['image']?>" alt="2x2" style="height: 144px; width:154px; float:right;"> 
                  <?php else:?>
                 <div style="height: 144px; text-align:center; width:154px; float:right; border:1px solid #121212;">
                   <br><br> Affix <br> Photo <br> Here 
                 </div>
                 <?php endif;?>
               </td>
            </tr>
 
            <tr>
                <td>Applicant's Name: <span class="underline"><?php echo $row['firstname']?>&nbsp;<?php echo $row['lastname']?></span></td>
            </tr>
        </table>
        <br>
        <span>Address: </span><span class="underline"><?php echo $row['address']?></span>
        <br>
        <br>
         <span>Date of Birth:</span> <span class="underline"><?php echo date('F d, Y', strtotime($row['date_of_birth'])) ?? "N/A"?></span></td>

        <p class="header" style="text-align:center;">PARENT’S PARTICULARS</p>
         <br><br>
        <!-- father info -->
         <div class="father-info">     
        <table>
          <tr>
            <td rowspan="2"><span style="float: left;">Father</span></td>
            <td><span class="underline"><?php echo $row['f_lastname'] ?? 'N/A'?></span></td>
            <td><span class="underline"><?php echo $row['f_given_name'] ?? 'N/A'?></span></td>
            <td><span class="underline"><?php echo $row['f_english_name'] ?? 'N/A'?></span></td>
          </tr>
          <tr>
            <td>(Surname)</td>
            <td>(Given Name/s)</td>
            <td>(English Name)</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Religion: <span class="underline"><?php echo $row['f_religion'] ?? 'N/A'?></span></td>
            <td>Attending worship regularly?
            <span style="position:relative; bottom: -5">
            <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['f_attend_worship'] === 'Yes' ? 'checked':''?>>Yes</sup>
            <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['f_attend_worship'] === 'No' ? 'checked':''?>>No</sup>
            </span>  
           </td>
          </tr>
        </table>
        <br><br><br>
        <span>Others: </span><span class="underline"><?php echo $row['f_others'] ?? '_________________________________________________'?></span>
         </div>
         <!-- father info  end -->
         <br><br>
         <!-- mother info -->
         <div class="father-info">     
        <table>
          <tr>
            <td rowspan="2"><span style="float: left;">Mother</span></td>
            <td><span class="underline"><?php echo $row['m_lastname'] ?? 'N/A'?></span></td>
            <td><span class="underline"><?php echo $row['m_given_name'] ?? 'N/A'?></span></td>
            <td><span class="underline"><?php echo $row['m_english_name'] ?? 'N/A'?></span></td>
          </tr>
          <tr>
            <td>(Surname)</td>
            <td>(Given Name/s)</td>
            <td>(English Name)</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Religion: <span class="underline"><?php echo $row['m_religion'] ?? 'N/A'?></span></td>
            <td>Attending worship regularly?
            <span style="position:relative; bottom: -5">
            <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['m_attend_worship'] === 'Yes' ? 'checked':''?>>Yes</sup>
            <sup><input type="checkbox" style="font-size: 20px;" <?php echo $row['m_attend_worship'] === 'No' ? 'checked':''?>>No</sup>
            </span>  
           </td>
          </tr>
        </table>
        <br><br><br>
        <span>Others: </span><span class="underline"><?php echo $row['m_others'] ?? '_________________________________________________'?></span>
         </div>
         <!-- mother info -->
         <br>
         <!-- <span>I hereby consent to my child </span><span class="underline"><?php echo $row['firstname'] ?? 'N/A'?> <?php echo $row['lastname'] ?? 'N/A'?></span><span> being water baptised</span>
        <br><br><br><br><br><br><br><br>
        <span>Yours Sincerely,</span>
        <br><br><br> -->
        <table>
          <tr>
            <td>_____________________</span></td>
            <td>
                <span class="underline">
                  <?php echo $row['m_given_name'] ?? 'N/A'?>&nbsp;<?php echo $row['m_lastname'] ?? 'N/A'?>
                   <br>
                  <?php echo $row['f_given_name'] ?? 'N/A'?>&nbsp;<?php echo $row['f_lastname'] ?? 'N/A'?>
                </span>
            </td>
            <td><span class="underline"><?php echo date('d, F Y', strtotime($row['date']))?></span></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parent’s Signature</td>
            <td>Parent’s Name</td>
            <td>Date</td>
          </tr>
        </table>
 
 
        <p class="header" style="font-size:12;text-align:center;">        -------------------------------CHURCHOFFICE USE ONLY----------------------------- </p>
        <br>
        <span>Date of Baptism: </span><span class="underline"><?php echo date('d, F Y', strtotime($row['sched_date']))?></span>
        <br><br>
        <br>
         <br><br>
        <?php endif;?>
</body>
</html>