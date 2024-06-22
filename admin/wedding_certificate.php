<?php
require __DIR__ .'/../assets/database/connection.php';
$form_id = $_GET['form_id'];
$query = "SELECT * FROM wedding_form WHERE id = $form_id";  
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

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
          . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
          . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
header("Access-Control-Allow-Origin: *");

?>


<!DOCTYPE html>
<html>
<head>
	 
	<title> Template </title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
 

	<!--[CSS/JS Files - Start]-->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
  
 	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

 

	<script type="text/javascript">
	$(document).ready(function($) 
	{ 
		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();
			var element = document.getElementById('container_content'); 
			var opt = 
			{
			  margin:       0,
			  filename:     'Marriage-Certificate_<?php echo $row['groom_lname']?>.pdf',
			  image:        { type: 'jpeg', quality: 0.98 },
			  html2canvas:  { scale: 1 },
			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			};
			html2pdf().set(opt).from(element).save();
		});
	});
	</script>
 
 <style>
	@import url('https://fonts.googleapis.com/css2?family=Playball&family=Roboto&display=swap');
    .page{
		padding: 0px 350px 0px 350px;
	}
	.container_content{
		/* border-width: 20px;
        border-style: groove; */
		border: 10px outset #ca8a04;
		border-image: url();
		/* border-bottom: 10px outset #f1c40f; */
		/* border-top: 10px solid #f1c40f;
		border-bottom: 10px solid #f1c40f; */
		background: #ffffff;
	
	}
	.for-border{
		padding: 0px 50px 0px 50px;
	}
	.header h3{
		font-family: 'Playball', cursive;
		/* font-size: 30pt; */
		font-size: 20pt;
		font-weight: bold;
		color: #4a4a4a;
		border-bottom: 1px solid #8b572a;
		text-align: center;
	}
	.date h5{
		color: #4a4a4a;
		font-family: 'Playball', cursive;
		font-weight: bold;
		font-size: 12pt;
	}
	.date h3{
		color: #4a4a4a;
		font-family: 'Playball', cursive;
		font-weight: bold;
		/* font-size: 25pt; */
		font-size: 15pt;
	}
	.date p{
		font-family: Roboto;
	}
	span{
		font-family: Roboto;
		font-weight: bold;
		font-size: 10pt;
	}
	.image{
		background-image: url('../assets/img/ring.png');
		background-position: center;
		background-size: contain;
		background-repeat: no-repeat;
		
	}
    .logo{
		margin-top: 4px;
		margin-left: 4px;
		position: absolute;
		width: 82px;
		height: 38;
	}
	.main-head{
		font-weight: bold;
		font-family: Roboto;
		padding: 0px;
		margin: 0px;
	}
	.title{
		margin-top: 10px;
		font-size: 15pt;
	}
	.sub-title{
		font-size: 7pt;
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
       <div class="container_content shadow" id="container_content">
		 <img class="logo" src="img/tic-logo.jpg" alt="">
		  <p class="main-head title text-center" style="text-transform: uppercase;">Immanuel vision church ministry inc.</p>
		  <p class="main-head sub-title text-center">23 TAGISAN CORNER LIAMZON ST MIDTOWN SUBD. PHASE 2</p>
		  <p class="main-head sub-title text-center">SAN ROQUE MARINKINA CITY</p>
		  <p class="main-head sub-title text-center">SEC REGISTRATION CN201312848</p>
		 <div class="for-border"> 
          <div class="header container-fluid mt-3">
	    	  <h3>
		    	 Certificate of Marriage
			  </h3>
	      </div>
		 <div class="date container-fluid mt-1">
			 <p class="text-center">
				This certify that
			 </p>
			  <h3 class="text-center">
                   <?php echo $row['groom_fname']?> and <?php echo $row['bride_fname']?>
			  </h3>
			  <p class="text-center">
				were united in marriage at Taytay Immanuel Church and Honesty on 
			  </p>
	    	  <h5 class="text-center">
				 <?php if($row['sched_date'] === '0000-00-00'):?>
			        N/A
				 <?php else:?>
					<?php echo date('F d, Y',strtotime($row['sched_date']))?>
				 <?php endif;?>
			  </h5>
	     </div>
         
		 <div class="row mt-5 mb-5">
			<div class="col-4">
				<div class="text-center">
					<span>Groom</span><br>
					<span class="name"><?php echo $row['groom_fname']?>&nbsp;<?php echo $row['groom_lname']?></span>
				</div>
				<div class="px-3">
					<hr>
				</div>
			</div>

			<div class="col-4 image">
               
			</div>

			<div class="col-4">
			   <div class="text-center">
					<span>Bride</span><br>
					<span class="name"><?php echo $row['bride_fname']?>&nbsp;<?php echo $row['bride_lname']?></span>
				</div>
				<div class="px-3">
					<hr>
				</div>
			</div>
		 </div>
	</div>
       </div>
	</div>



</body>
</html>