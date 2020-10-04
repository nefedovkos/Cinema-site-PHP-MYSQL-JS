<?php
session_start();
require_once "../functions/connectDB.php";
require_once "../functions/functions.php";
$gateName=$_POST['gateName'];
$sections=$_POST['sections'];
$rows=$_POST['rows'];
$seats=$_POST['seats'];
$totalSeats=$sections*$rows*$seats;

function newGate($connection_db, $gateName, $sections, $rows, $seats, $totalSeats){
    $query = "INSERT INTO `gates` (`id`, `name`, `sections`, `rows`, `seats`, `total_seats`) VALUES (NULL, '$gateName', '$sections', '$rows', '$seats', '$totalSeats')";
    mysqli_query($connection_db,$query);

    $_SESSION['newGateMSG']= "New Gate :  ".$gateName." is added successfully";
    ?>
    <script>
        setTimeout(function()
        {
            window.location = "../newGate.php";
        }, 10);
    </script>
    <?php

}
newGate($connection_db, $gateName, $sections, $rows, $seats, $totalSeats);
?>