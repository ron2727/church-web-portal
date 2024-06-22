<?php
require __DIR__ .'/../assets/database/connection.php';

$pastor_id = $_GET['pastorid'];
// $privacy = $_GET['privacy'];
$query = "SELECT * FROM pastor WHERE id = $pastor_id";
$row = mysqli_fetch_assoc(mysqli_query($conn, $query));
$privacy = $row['privacy'];
if ($privacy == 'visible') {
    $query = "UPDATE pastor SET privacy = 'hidden' WHERE id = $pastor_id";
}
if ($privacy == 'hidden') {
    $query = "UPDATE pastor SET privacy = 'visible' WHERE id = $pastor_id";
}
mysqli_query($conn, $query);

$query = "SELECT * FROM pastor WHERE id = $pastor_id";
$row = mysqli_fetch_assoc(mysqli_query($conn, $query));
 ?>


                                            <?php if($row['privacy'] === 'visible'):?>
                                                    Show
                                                  <i class="bi bi-eye"></i>
                                                <?php endif;?>
                                               <?php if($row['privacy'] === 'hidden'):?>
                                                    Hide
                                                  <i class="bi bi-eye-slash"></i>
                                                <?php endif;?>