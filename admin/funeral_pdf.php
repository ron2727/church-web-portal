<?php
require __DIR__ .'/../assets/database/connection.php';
if (isset($_GET['form_id'])) {
  $form_id = $_GET['form_id'];
    $query = "SELECT * FROM funeral_form
              WHERE form_id = $form_id";
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
        body{
           margin-top: 1in;
           margin-bottom: 1in;
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
       td{
        text-align: left;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 12;
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
        <?php //echo $row['']?>
        <span style="font-weight: bold;">FUNERAL SERVICE PLANNING FORM </span><br><br>
        <span style="font-weight: bold;">Deceased Personal Information</span><br><br>
        <span>
          Full Name: <span style="text-decoration: underline;"><?php echo ($row['deceased_fname'] ?? "N/A") ." ".($row['deceased_mname'] ?? "N/A")." ".($row['deceased_lname'] ?? "N/A") ?></span>
       </span>
       <br><br>
        <span>Date and Place of Birth:</span>
        <br>
        <br>
        
             <table style="width: 100%;">
              <tr>
              
                <td><span class="underline"><?php echo date('F d, Y', strtotime($row['deceased_birthday'])) ?? "N/A"?></span></td>
                <td><span class="underline"><?php echo $row['deceased_birthplace_city'] ?? "N/A"?></span></td>
                <td><span class="underline"><?php echo $row['deceased_birthplace_province'] ?? "N/A"?></span></td>
              </tr>
              <tr>
                <td>Date</td>
                <td>City/Municipality</td>
                <td>Province/Region</td>
              </tr>
              <tr>
                <td><span class="underline"><?php echo $row['deceased_birthplace_country'] ?? "N/A"?></span></td>
              </tr>
              <tr>
                <td>
                  Country
                </td>
              </tr>
             </table>
   
        <br>
        <br>
        <span>
          Date of Death: <span class="underline"><?php echo date('F d, Y', strtotime($row['deceased_dateofdeath'])) ?? "N/A"?></span>
        </span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>
           Nature of Death: <span class="underline"><?php echo $row['deceased_natureofdeath'] ?? "N/A"?></span>
          </span>
  
        <!-- <span>
          Deceased Church Denomination : <span class="underline"><?php echo $row['deceased_church_deno'] ?? "N/A"?></span>
        </span>
        <br><br>
        <span>
          Deceased Date of Baptism if available : <span class="underline"><?php echo date('F d, Y', strtotime($row['deceased_dateofbaptism'])) ?? "N/A"?></span>
        <br><br>
        <span>
          Deceased Church Membership prior to death: <span class="underline"><?php echo $row['deceased_church_membership_ptd'] ?? "N/A"?></span>
        </span> -->
        <br>
        <br>
        <br>
        <span class="bold">Applicant Information </span>
        <br>
        <br>
        <span>
          Name: <span class="underline"><?php echo ($row['applicant_fname'] ?? "N/A")." ".($row['applicant_mname'] ?? "N/A")." ".($row['applicant_lname'] ?? "N/A")?></span>
        </span>
        <br>
        <br>
        <span>
          Date of Birth: <span class="underline">  <?php echo date('F d, Y', strtotime($row['applicant_birthday'])) ?? 'N/A'?></span>
        </span>
        <br>
        <br>
        <span>
          Address: <span class="underline"><?php echo $row['applicant_address'] ?? "N/A"?></span>
        </span>
        <br>
        <br>
        <!-- <span>_________________________________________________________</span> -->
        <span>
          Relationship to the deceased: <span class="underline"><?php echo $row['applicant_rttd'] === "Select Relationship to the deceased..." ? "" : $row['applicant_rttd'] ;?></span>
        </span>
        <br>
        <br>
        <span>
          <span class="bold">Preferences For The Body:</span> <span class="underline"><?php echo $row['applicant_pftb'] === "Select Preferences for the body..." ? "" : $row['applicant_pftb']?></span>
        </span>
        <br>
        <br>
        <br>
        <span>
          <!-- <span class="bold">Necrological Service Information:</span>
        </span>
        <br>
        <br>
        <table style="width: 100%;">
              <tr> 
                <td>Place: <span class="underline"><?php echo $row['applicant_ns_place'] ?? "N/A"?></span></td>
                <td>Date: <span class="underline"><?php echo date('F d, Y', strtotime($row['applicant_ns_date'])) ?? "N/A"?></span></td>
                <td>Time: <span class="underline"><?php echo date('g:i A', strtotime($row['applicant_ns_time'])) ?? "N/A"?></span></td>
                
              </tr>
             </table>
        <span>
          <br>
          <br>
        <span>
          <span class="bold">Funeral Service  Information:</span>
        </span>
        <br>
        <br>
        <table style="width: 100%;">
              <tr> 
                <td>Place: <span class="underline"><?php echo $row['applicant_fs_place'] ?? "N/A"?></span></td>
                <td>Date: <span class="underline"><?php echo date('F d, Y', strtotime($row['applicant_fs_date'])) ?? "N/A"?></span></td>
                <td>Time: <span class="underline"><?php echo date('g:i A', strtotime($row['applicant_fs_time'])) ?? "N/A"?></span></td>        
              </tr>
             </table> -->
        <span>
       <br>
        <br>
        <br>
        <br>
        <span>_________________________________</span>
        <br>
        <span>Applicant Signature Over Printed Name</span>
 
</body>
</html>