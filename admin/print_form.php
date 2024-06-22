<?php 
require __DIR__ .'/../assets/database/connection.php';
require '../assets/libs/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// $id = $_GET['id'];
// $sql = mysqli_query($con,"SELECT * FROM questiontb WHERE questionID='$id'");
// $user = mysqli_fetch_assoc($sql);

// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();
if (isset($_GET['service'])) {
     if ($_GET['service'] === 'funeral') {
        require('funeral_pdf.php');
     }
     if ($_GET['service'] === 'wedding') {
       require('wedding_pdf.php');
     }
     if ($_GET['service'] === 'baptism') {
      require('baptism_pdf.php');
     }
     if ($_GET['service'] === 'consent') {
      require('consent_pdf.php');
     }
}
if (isset($_GET['report'])) {
       require('report_pdf.php');
} 
$html =ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
if (isset($_GET['service'])) {
  $service = ucfirst($_GET['service']);
  if (isset($_GET['attach'])) {
    $dompdf->stream("$service-Form.pdf",['Attachment'=>true]);
  }else{
    $dompdf->stream("$service-Form.pdf",['Attachment'=>false]);
  }
  
}
if (isset($_GET['report'])) {
  $report = ucfirst($_GET['report']);
  if ($report === 'Baptism') {
      if ($_GET['bapType'] === 'child') {
         $report = 'Child Dedication';
      }else {
        $report = 'Water Baptism';
      }
  }
  $date = $_GET['date'];
  $dompdf->stream("$report-Report_$date.pdf",['Attachment'=>false]);
}


