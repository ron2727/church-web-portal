<?php
require __DIR__ .'/../assets/database/connection.php';
if (isset($_GET['form_id'])) {
  $form_id = $_GET['form_id'];
    $query = "SELECT * FROM wedding_form
              WHERE id = $form_id";
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
       table{
        width: 100%;
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
        <p class="underline" style="font-weight: bold;text-align:center;">WEDDING APPLICATION FORM </p>
        <br><br>
        <table>
            <tr>
                <td>Desired Wedding Date : <span class="underline"><?php echo date('F d, Y', strtotime($row['sched_date'])) ?? "N/A"?></span></td>
                <td>Date of Rehearsal: <span class="underline"><?php echo date('F d, Y', strtotime($row['sched_redate'])) ?? "N/A"?></span></td>
             </tr>
           
        </table>
        <br>
        <table>
            <tr>
                <td>Time: <span class="underline"><?php echo date('g:i A', strtotime($row['time_from'])). ' ' .date('g:i A', strtotime($row['time_to']))?></span></td>
                <td>Time: <span class="underline"><?php echo date('g:i A', strtotime($row['time_refrom'])). ' ' .date('g:i A', strtotime($row['time_reto']))?></span></td>
            </tr>
        </table>
        <br>
        <br>
        <!-- Bride info -->
        <span>BRIDE INFORMATION</span>
        <hr>
        <br>
        <table>
           <tr>
             <td>First Name: <span class="underline"><?php echo $row['bride_fname']?></span></td>
             <td>Last Name: <span class="underline"><?php echo $row['bride_lname']?></span></td>
           </tr>
        </table>
        <br>
        <span>Bride's Address: </span><span class="underline"><?php echo $row['bride_address']?></span>
        <br>
        <br>
        <table>
           <tr>
             <td>Bride's Phone Number: <span class="underline"><?php echo $row['bride_phone']?></span></td>
             <td>Bride's Email: <span class="underline"><?php echo $row['bride_email']?></span></td>
           </tr>
        </table>
        <br>
        <span>Bride's Date of Christian Baptism: </span> <span class="underline"><?php echo  $row['bride_date_of_bap'] === '0000-00-00' ? "N/A": date('F d, Y',strtotime($row['bride_date_of_bap']))?></span>
        <br>
        <br>
        <span>Bride's Denomination of Church: </span> <span class="underline"><?php echo $row['bride_deno_of_ch']?></span>
        <br>
        <br>
        <span>Bride's Present Church Membership: </span> <span class="underline"><?php echo $row['bride_pres_ch_mem']?></span>
        <br>
        <br>
        <table>
             <tr>
                <td colspan="1">Name of Bride's Pastor: <span class="underline"><?php echo $row['bride_pastor_name']?></span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>Pastor's Phone: <span class="underline"><?php echo $row['bride_pastor_phone']?></span></td>
                <td>Pastor's Email: <span class="underline"><?php echo $row['bride_pastor_email']?></span></td>
            </tr>
        </table>
        <br>
        <br>
      <!-- Groom Info -->
        <span>GROOM INFORMATION</span>
        <hr>
        <br>
        <table>
           <tr>
             <td>First Name: <span class="underline"><?php echo $row['groom_fname']?></span></td>
             <td>Last Name: <span class="underline"><?php echo $row['groom_lname']?></span></td>
           </tr>
        </table>
        <br>
        <br>
        <span>Groom's Address: </span><span class="underline"><?php echo $row['groom_address']?></span>
        <br>
        <br>
        <table>
           <tr>
             <td>Groom's Phone Number: <span class="underline"><?php echo $row['groom_phone']?></span></td>
             <td>Groom's Email: <span class="underline"><?php echo $row['groom_email']?></span></td>
           </tr>
        </table>
        <br>
        <span>Groom's Date of Christian Baptism: </span> <span class="underline"><?php echo  $row['bride_date_of_bap'] === '0000-00-00' ? "N/A": date('F d, Y',strtotime($row['bride_date_of_bap']))?></span>
        <br>
        <br>
        <span>Groom's Denomination of Church: </span> <span class="underline"><?php echo $row['groom_deno_of_ch']?></span>
        <br>
        <br>
        <span>Groom's Present Church Membership: </span> <span class="underline"><?php echo $row['groom_pres_ch_mem']?></span>
        <br>
        <br>
        <table>
             <tr>
                <td colspan="1">Name of Groom's Pastor: <span class="underline"><?php echo $row['groom_pastor_name']?></span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>Pastor's Phone: <span class="underline"><?php echo $row['groom_pastor_phone']?></span></td>
                <td>Pastor's Email: <span class="underline"><?php echo $row['groom_pastor_email']?></span></td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <span>FAMILY INFORMATION</span>
        <br>
        <br>
        <table>
            <tr>
                <td>Bride's Parent: <span class="underline"><?php echo $row['bride_f_name']?></span></td>
                <td><span class="underline"><?php echo $row['bride_m_name']?></span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>Bride's Parent Phone: <span class="underline"><?php echo $row['bride_f_phone']?></span></td>
                <td><span class="underline"><?php echo $row['bride_m_phone']?></span></td>
            </tr>
        </table>
        <br>
        <span>Bride's Parent Address: </span><span class="underline"><?php echo $row['bride_parent_add']?></span>
        <br>
        <br>
        <table>
            <tr>
                <td>Groom's Parent: <span class="underline"><?php echo $row['groom_f_name']?></span></td>
                <td><span class="underline"><?php echo $row['groom_m_name']?></span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>Groom's Parent Phone: <span class="underline"><?php echo $row['groom_f_phone']?></span></td>
                <td><span class="underline"><?php echo $row['groom_m_phone']?></span></td>
            </tr>
        </table>
        <br>
        <span>Groom's Parent Address: </span><span class="underline"><?php echo $row['groom_parent_add']?></span>
        <br>
        <br>
        <br>
        <!-- Wedding Cere Info -->
        <span>WEDDING CEREMONY INFORMATION</span>
        <hr>
        <br>
        <span>Pastor Performing Service: </span><span class="underline"><?php echo $row['pastor_perform_ser']?></span>
        <br>
        <br>
        <span>Number of Guests: </span><span class="underline"><?php echo $row['number_guests']?></span>
        <br>
        <br>
        <span>Maid of Honor: </span><span class="underline"><?php echo $row['maid_of_honor']?></span>
        <br>
        <br>
        <br>
        <span>Best Man:</span><span class="underline"><?php echo $row['best_man']?></span>
        <br>
        <br>
        <span>Bridemaids: </span><span class="underline"><?php echo $row['bridemaids']?></span>
        <br>
        <br>
        <span>Groomsmen: </span><span class="underline"><?php echo $row['groomen']?></span>
        <br>
        <br>
        <table>
            <tr>
                <td>Flower Girl: <span class="underline"><?php echo $row['flower_girl']?></span></td>
                <td>Ring Bearer: <span class="underline"><?php echo $row['ring_bearear']?></span></td>
            </tr>
        </table>
        <br>
        <span>Ushers/Candlelighters: </span><span class="underline"><?php echo $row['ushers']?></span>
        <br>
        <br>
        <span>Organist/Pianist: </span><span class="underline"><?php echo $row['pianist']?></span>
        <br>
        <br>
        <span>Soloist(s): </span><span class="underline"><?php echo $row['soloist']?></span>
        <br>
        <br>
        <span>Other Musicians: </span><span class="underline"><?php echo $row['other_musicians']?></span>
        <br>
        <br>
        <span>Sound Technician: </span><span class="underline"><?php echo $row['sound_technician']?></span>
        <br>
        <br>
        <span>Photographer: </span><span class="underline"><?php echo $row['photographer']?></span>
        <br><br>
        <br>
        <span>OTHER INFORMATION: </span>
        <br>
        <br>
        <span class="underline"><?php echo $row['other_information']?></span>
</body>
</html>