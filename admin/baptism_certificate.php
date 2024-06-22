<?php
require __DIR__ .'/../assets/database/connection.php';
$form_id = $_GET['form_id'];
$query = "SELECT * FROM baptism_form WHERE form_id = '$form_id'";  
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
//--->get app url > start

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $ssl = 'https';
}
else {
  $ssl = 'http';
}
 
$app_url = ($ssl  )
          . "://".$_SERVER['HTTP_HOST']
          //. $_SERVER["SERVER_NAME"]
          . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
          . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

//--->get app url > end

header("Access-Control-Allow-Origin: *");

?>


<!DOCTYPE html>
<html>
<head>
	 
	<title> Template </title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
 

	<!--[CSS/JS Files - Start]-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://www.dafontfree.net/embed/dml2YWxkaS1yZWd1bGFyJmRhdGEvMjgvdi8xNDc4NjAvdml2YWxkaS50dGY" rel="stylesheet" type="text/css"/>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 


	<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
  
 	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

 

	<script type="text/javascript">
	$(document).ready(function($) 
	{ 

		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();

			//credit : https://ekoopmans.github.io/html2pdf.js
			
			var element = document.getElementById('container_content'); 
 
			var opt = 
			{
			  margin:       0,
			  filename:     'Baptism-Certificate.pdf',
			  image:        { type: 'jpeg', quality: 0.98 },
			  html2canvas:  { scale: 1 },
			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			};

			// New Promise-based usage:
			html2pdf().set(opt).from(element).save();

			 
		});

 
 
	});
	</script>
 <style>
    
    @font-face {
        font-family: vivaldi;
        src: url('/vivaldi.ttf');
    }
    @font-face {
        font-family: algerian;
        src: url('/Algerian-Regular.ttf');
    }
     .page{
		display: flex;
        justify-content: center;
	}
 
    .container_content{
        height: 520px;
        width: 710px;
 		background: #ffffff;
 
	}
   .bg{
    background-image: url('../assets/img/<?php echo $_GET['type'] === 'youth' ? 'byouth_cer.png': 'bchild_cer.png'?>');
    background-size: contain;
    background-repeat: no-repeat;
    width: 100%;
    height: 100%;
   }
   .content{
    margin-top: 220px;
   }
   .bd{
    font-family: 'vivaldi';
    font-weight: bold;
    color: black;
   }
   .name{
    text-transform: uppercase;
    font-family: 'algerian';
    font-weight: bold;
    color: black;
    font-size: 1.5rem;
   }
   .content1{
    margin-top: 220px;
    padding: 0px 200px 0px 200px;
   }
   .name1{
    text-transform: uppercase;
    font-family: 'algerian';
    font-weight: bold;
    color: #4d7c0f;
    font-size: 1.5rem;
    border-bottom: 1px solid #121212;
   }
   .text{
    padding: 0px;
    margin: 0px;
    font-family: 'vivaldi';
    font-weight: bold;
    color: black;
    font-weight: lighter;
   }
</style>
</head>
<body>

<div class="d-flex justify-content-center py-5">
	<div class="btn_print text-white bg-danger px-3 py-2 rounded-3" id="rep" style="cursor: pointer;">
    	<i class="bi bi-file-earmark-pdf-fill"></i> Print
	</div>
</div>
    <div class="page">
       <div class="container_content d-flex justify-content-center" id="container_content">
        <div class="bg">
          <?php if($_GET['type'] === 'youth'):?>
               <div class="content">
                   <p class="name text-center"><?php echo $row['firstname']. ' ' .$row['lastname']?></p>
                   <p class="bd text-center">Who was born in the <?php echo date('jS', strtotime($row['date_of_birth']))?> day of June <?php echo date('F, Y', strtotime($row['date_of_birth']))?></p>
               </div>
          <?php endif;?>
          <?php if($_GET['type'] === 'child'):?>
 
               <div class="content1">
                   <p class="name1 text-center"><?php echo $row['firstname']. ' ' .$row['lastname']?></p>
                   <p class="text text-center">who was born on the <?php echo date('jS', strtotime($row['date_of_birth']))?> day of <?php echo date('F, Y', strtotime($row['date_of_birth']))?></p>
                   <?php 
                     $query = "SELECT baptism_consent.f_given_name, baptism_consent.f_lastname, baptism_consent.m_given_name, baptism_consent.m_lastname
                              FROM baptism_form
                              INNER JOIN baptism_consent ON baptism_form.form_id = baptism_consent.form_id
                              WHERE baptism_consent.form_id = '$form_id'";
                     $parent = mysqli_fetch_assoc(mysqli_query($conn, $query));
                   ?>
                   <p class="text text-center">to <?php echo $parent['f_given_name']. ' ' .$parent['f_lastname']?> and <?php echo $parent['m_given_name']. ' ' .$parent['m_lastname']?></p>
                   <p class="text text-center">was dedicated to  the Lord on the </p>
                   <p class="text text-center"><?php echo date('jS', strtotime($row['sched_date']))?>  day of <?php echo date('F, Y', strtotime($row['sched_date']))?></p>
                   <p class="text text-center">In accordance with the faith and practice of</p>
               </div>
         <?php endif;?>
         </div>
       </div>
	</div>
</body>
</html>