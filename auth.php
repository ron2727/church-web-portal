<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'services') {
        header("Location: service_form.php?service=".$_GET['service']);
        exit;
    }
}

?>