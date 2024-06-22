<?php
require __DIR__ .'/../../assets/database/connection.php';
 
 
 $user_id = $_POST['userid'];
 $ministry = $_POST['ministry'];

 
 $query = "UPDATE user_account SET ministry = '$ministry' WHERE user_id = '$user_id'";
 mysqli_query($conn, $query);
?>


<h2 class="text-center"><i class="bi bi-check-circle-fill text-success"></i></h2>
<p class="text-center" style="font-weight: bold;">Change Group Successfully</p>

<div class="text-end px-3">
       <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
</div>