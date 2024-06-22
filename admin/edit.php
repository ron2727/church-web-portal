<?php
require __DIR__ .'/../assets/database/connection.php';
?>
<?php
// if (isset($_POST['submit'])) {
//     if ($_POST['submit'] === 'Add Event') {
        foreach ($_FILES as $key => $value) {
            echo $key. ':  ' .$value. '<br>'; 
        }
         $title = $_POST['title'];
         $place = $_POST['place'];
         $date = $_POST['date'];
         $time = $_POST['time'];
         $description = $_POST['description'];
         $status = $_POST['status'];
         
         $image_tmpname = $_FILES['image']['tmp_name'];
         $img_name = $_FILES['image']['name'];
         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
         $image_new_name = uniqid("EVENT-IMG", false). '.' .$img_ex;
         $image_upload_path = '../assets/uploaded_images/event/' .$image_new_name;
         move_uploaded_file($image_tmpname, $image_upload_path);
         $query = "INSERT INTO event(title, place, date, time, description, status, image) 
         VALUES('$title', '$place', '$date', '$time', '$description', '$status', '$image_new_name')";
         mysqli_query($conn, $query);
         $query = "SELECT * FROM event";
         $result = mysqli_query($conn, $query);
//     }
// }
?>
              