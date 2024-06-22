<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$name = $_POST['username'];
 
		$pass = $_POST['password'];


		$sql="select * from users where username='".$name."' AND password='".$pass."'  ";

		$result=mysqli_query($data,$sql);

		$row=mysqli_fetch_assoc($result);


       if (mysqli_num_rows($result) > 0) {
        # code...
      
		if($row["role"]=="Admin")
		{

			$_SESSION['username']=$name;

			$_SESSION['role']="Admin";

			header("location: dash.php");
		}

		if($row["role"]=="WaterTender")
		{	
			$_SESSION['username']=$name;

			$_SESSION['role']="WaterTender";

			header("location:watbillsum.php");
		}
    if($row["role"]=="Staff")
		{	
			$_SESSION['username']=$name;

			$_SESSION['role']="Staff";

			header("location:adstaff.php");
		}

    }else{
        $_SESSION['loginMessage']=$message;
        // echo "Email or Password is Incorrect!";
        $error['error'] = '<div class="text-center text-danger">Email or Password is Incorrect!</div>';
        
        header("location:lgn.php?error=error");
        exit;

    }


	}


?>

