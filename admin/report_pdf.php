<?php
require __DIR__ .'/../assets/database/connection.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Pdf</title>
    <style>
       *{
        font-family: Arial, Helvetica, sans-serif;
       }
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
        border-collapse: collapse;
       }
       td{
        text-align: center;
        padding: 5px 0px 5px 0px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 12;
       
        
       }
    
       thead tr td{
        color: white;
        background: #0275d8;
        font-weight: bold;
        border: 1px solid white;
       }
       tbody tr:nth-child(even){
         background: #f2f2f2;
       }
       tbody tr td{
        font-size: 0.8rem;
        border: 1px solid #f2f2f2;
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
        <?php if($_GET['report'] === 'baptism'):?>
          <h2 style="text-align:center;">Report for <?php echo $_GET['bapType'] === 'child' ? 'Child Dedication': 'Water Baptism'?> Service</h2>
        <?php else:?>
          <h2 style="text-align:center;">Report for <?php echo ucfirst($_GET['report'])?> Service</h2>
        <?php endif;?>
        
        <!-- Funeral Report -->
        <?php if($_GET['report'] === 'funeral'):?>
          
          <?php 
                $report_search = date('F Y', strtotime($_GET['date']));
                $query = "SELECT * FROM funeral_form WHERE status = 'Completed'
                          ORDER BY sched_date ASC, time_from ASC";
                $result = mysqli_query($conn, $query);
                $total_applicant = 0;
         ?>
         <h3>Date Covered: <?php echo date('F Y', strtotime($_GET['date']))?></h3>
         <table style="width:100%;">
            <thead>
                <tr>
                 <td>Date</td>
                 <td>Time</td>
                 <td>Name</td>
                 <td>Contact Number</td>
                 <td>Email</td>
                </tr>
            </thead>
            <tbody>
                   <?php while($row = mysqli_fetch_assoc($result)):?>
                                                 <?php $form_date = date('F Y', strtotime($row['sched_date']))?>
                                                <?php if($report_search === $form_date):?>
                                                  <?php $total_applicant = ($total_applicant + 1);?>  
                                                <tr>
                                                <td><?php echo $row['sched_date']?></td>
                                                <td><?php echo date('G:i A', strtotime($row['time_from'])). '-' .date('G:i A', strtotime($row['time_to']))?></td>
                                                <td><?php echo $row['applicant_fname']. ' ' .$row['applicant_lname']?></td>
                                            
                                                <td class="text-center"><?php echo $row['applicant_contactnum'] ?></td>
                                                <td class="text-center"><?php echo $row['applicant_email'] ?></td>
                                                </tr>
                                                <?php endif;?>
                  <?php endwhile;?>  
          </tbody>      
         </table>
         <h3>Total Applicant<?php echo $total_applicant > 1 ? 's':''?>: <?php echo $total_applicant?></h3>
        <?php endif;?>  
 
        <!-- Wedding Report -->
        <?php if($_GET['report'] === 'wedding'):?>
          
          <?php 
                $report_search = date('F Y', strtotime($_GET['date']));
                $query = "SELECT * FROM wedding_form WHERE status = 'Completed'
                          ORDER BY sched_date ASC, time_from ASC";
                $result = mysqli_query($conn, $query);
                $total_applicant = 0;
         ?>
         <h3>Date Covered: <?php echo date('F Y', strtotime($_GET['date']))?></h3>
         <table style="width:100%;">
            <thead>
                <tr>
                 <td>Date</td>
                 <td>Time</td>
                 <td>Name</td>
                 <td>Contact Number</td>
                 <td>Email</td>
                </tr>
            </thead>
            <tbody>
                   <?php while($row = mysqli_fetch_assoc($result)):?>
                                                 <?php $form_date = date('F Y', strtotime($row['sched_date']))?>
                                                <?php if($report_search === $form_date):?>
                                                  <?php $total_applicant = ($total_applicant + 1);?>  
                                                <tr>
                                                     <td><?php echo $row['sched_date']?></td>
                                                     <td><?php echo date('h:iA', strtotime($row['time_from'])). '-' .date('h:i A', strtotime($row['time_to']))?></td>
                                                   <?php if($row['applicant'] === 'groom'):?>
                                                      <td><?php echo $row['groom_fname']. ' ' .$row['groom_lname']?></td>
                                                      <td class="text-center"><?php echo $row['groom_phone'] ?></td>
                                                      <td class="text-center"><?php echo $row['groom_email'] ?></td>
                                                   <?php endif;?>
                                                   <?php if($row['applicant'] === 'bride'):?>
                                                      <td><?php echo $row['groom_fname']. ' ' .$row['bride_lname']?></td>
                                                      <td class="text-center"><?php echo $row['bride_phone'] ?></td>
                                                      <td class="text-center"><?php echo $row['bride_email'] ?></td>
                                                   <?php endif;?>
                                                </tr>
                                                <?php endif;?>

                  <?php endwhile;?>  
          </tbody>      
         </table>
         <h3>Total Applicant<?php echo $total_applicant > 1 ? 's':''?>: <?php echo $total_applicant?></h3>
        <?php endif;?>
        

              <!-- Baptism Report -->
              <?php if($_GET['report'] === 'baptism'):?>
                
          <?php 
                $type = $_GET['bapType'];
                $report_search = date('F Y', strtotime($_GET['date']));
                $query = "SELECT * FROM baptism_form WHERE status = 'Completed' AND baptism_type = '$type'
                          ORDER BY sched_date ASC, time_from ASC";
                $result = mysqli_query($conn, $query);
                $total_applicant = 0;
         ?>
         <h3>Date Covered: <?php echo date('F Y', strtotime($_GET['date']))?></h3>
         <table style="width:100%;">
            <thead>
                <tr>
                 <td>Date</td>
                 <td>Time</td>
                 <td>Name</td>
                 <td>Contact Number</td>
                 <td>Email</td>
                </tr>
            </thead>
            <tbody>
                   <?php while($row = mysqli_fetch_assoc($result)):?>
                                                 <?php $form_date = date('F Y', strtotime($row['sched_date']))?>
                                                <?php if($report_search === $form_date):?>
                                                  <?php $total_applicant = ($total_applicant + 1);?>  
                                                <tr>
                                                     <td><?php echo date('m-d-Y', strtotime($row['sched_date']))?></td>
                                                     <td><?php echo date('h:iA', strtotime($row['time_from'])). '-' .date('h:i A', strtotime($row['time_to']))?></td>
                                                      <td><?php echo $row['firstname']. ' ' .$row['lastname']?></td>
                                                      <td><?php echo $row['telephone'] ?></td>
                                                      <td><?php echo $row['email'] ?></td>
                                                 
                                                </tr>
                                                <?php endif;?>

                  <?php endwhile;?>  
          </tbody>      
         </table>
         <h3>Total Applicant<?php echo $total_applicant > 1 ? 's':''?>: <?php echo $total_applicant?></h3>
        <?php endif;?>


        <!-- Events Report -->
        <?php if($_GET['report'] === 'event'):?>
          
          <?php 
                $report_search = date('F Y', strtotime($_GET['date']));
                $query = "SELECT * FROM event WHERE status = 'Past'
                          ORDER BY date ASC, time ASC";
                $result = mysqli_query($conn, $query);
                $total_applicant = 0;
         ?>
         <h3>Date Covered: <?php echo date('F Y', strtotime($_GET['date']))?></h3>
         <table style="width:100%;">
            <thead>
              <tr style="font-weight: bold;">
                 <td>Date</td>
                 <td>Title</td>
                 <td>Place</td>
                 <td>Time</td>
               </tr>
            </thead>
            <tbody>
                   <?php while($row = mysqli_fetch_assoc($result)):?>
                                                 <?php $event_date = date('F Y', strtotime($row['date']))?>
                                                <?php if($report_search === $event_date):?>
                                                  <?php $total_applicant = ($total_applicant + 1);?>  
                                                  <tr>
                                                     <td class="text-center"><?php echo date('F d, Y', strtotime($row['date']))?></td>
                                                     <td class="text-center"><?php echo $row['title']?></td>
                                                     <td class="text-center"><?php echo $row['place']?></td>
                                                     <td class="text-center"><?php echo date('g:i A', strtotime($row['time']))?></td>
                                                   </tr>
                                                <?php endif;?>

                  <?php endwhile;?>  
          </tbody>      
         </table>
         <h3>Total Event<?php echo $total_applicant > 1 ? 's':''?>: <?php echo $total_applicant?></h3>
        <?php endif;?>

        
</body>
</html>