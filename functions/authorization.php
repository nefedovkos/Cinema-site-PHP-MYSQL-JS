<?php
session_start();
require_once "connectDB.php";
require_once "functions.php";
$login = $_POST['login'];
$password = $_POST['password'];
$result = mysqli_query($connection_db, "Select * FROM `users` WHERE `login` ='$login' AND `password` = '$password'");
$user = mysqli_fetch_assoc($result);


if ($login == $user['login'] and $password == $user['password']) {
    $_SESSION['user'] = $user['login'];
    $_SESSION['name'] = $user['name'];
} else {
    $_SESSION['msg'] = "Wrong authorization!!! Try again. ";
}

?>
<script>
    setTimeout(function() {
        window.location = "../index.php";
    }, 10);
</script>




