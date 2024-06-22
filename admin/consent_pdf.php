<?php
require __DIR__ .'/../assets/database/connection.php';
if (isset($_GET['form_id'])) {
  $form_id = $_GET['form_id'];
    $query = "SELECT * 
              FROM baptism_form
              INNER JOIN baptism_consent ON baptism_form.form_id = baptism_consent.form_id
              WHERE baptism_form.form_id = '$form_id'";
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
      .father-info{
        border: 1px solid #121212;
        padding: 10px;
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
         <span>I hereby consent to my child </span><span class="underline"><?php echo $row['firstname'] ?? 'N/A'?> <?php echo $row['lastname'] ?? 'N/A'?></span><span> being water baptised</span>
        <br><br><br><br><br><br><br><br>
        <span>Yours Sincerely,</span>
        <br><br><br>
        <table>
          <tr>
            <td>_____________________</span></td>
            <td><span class="underline"><?php echo $row['m_given_name'] ?? 'N/A'?>&nbsp;<?php echo $row['m_lastname'] ?? 'N/A'?></span></td>
            <td><span class="underline"><?php echo date('d, F Y', strtotime($row['date']))?></span></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parent’s Signature</td>
            <td>Parent’s Name</td>
            <td>Date</td>
          </tr>
        </table>
 
</body>
</html>