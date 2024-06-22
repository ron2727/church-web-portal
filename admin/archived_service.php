<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';

if (isset($_GET['service'])) {
        $form_id = $_GET['form_id'];
    if ($_GET['service'] === 'baptism') {

        $query = "SELECT * FROM baptism_consent WHERE form_id = '$form_id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
             $sql = "UPDATE baptism_consent SET archived = 'yes' WHERE form_id = '$form_id'";
             mysqli_query($conn, $sql);  
        }
        $sql = "UPDATE baptism_form SET archived = 'yes' WHERE form_id = '$form_id'";
                mysqli_query($conn, $sql);
    
                if (isset($_GET['type'])) {
                    header("Location: baptism.php?type=".$_GET['type']."&action=archived");
                    exit;
                }else {
                    header("Location: baptism_youth.php?action=archived");
                    exit;
                }
       
        
    }
    if ($_GET['service'] === 'wedding') {

        $sql = "UPDATE wedding_form SET archived = 'yes' WHERE id = '$form_id'";
                mysqli_query($conn, $sql);

       header("Location: wedding.php?action=archived");
       exit;
    }
    if ($_GET['service'] === 'funeral') {

        $sql = "UPDATE funeral_form SET archived = 'yes' WHERE form_id = $form_id";
                mysqli_query($conn, $sql);

        header("Location: funeral.php?action=archived");
        exit;
    }
}

?>