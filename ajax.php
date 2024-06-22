<?php

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    echo "<label for='password'>Password</label><br>
         <input type='text' name='password' id='password' placeholder='Enter your Password' class='form-control' value='$password' validate='required'>";
}

?>