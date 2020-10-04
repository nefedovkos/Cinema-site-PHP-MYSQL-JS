<?php
session_start();
require_once "../functions/connectDB.php";
require_once "../functions/functions.php";
$movies = getMovies($connection_db);
$gates = getGates($connection_db);
$movieName=$_POST['movieName'];
$haveMovie=0;
foreach ($movies as $movie){
    if($movie['name'] == $movieName){
        $haveMovie=1;
    }
}
if($haveMovie==1){
    $_SESSION['newMovieMSG']= "Movie :  ".$movieName." have already inside DB.";
} else {
    if(isset($_POST['upload'])){
        $img_type = substr($_FILES['img_upload']['type'], 0, 5);
        $img_size = 2*1024*1024;
        if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size){
            $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
            $connection_db->query("INSERT INTO movies (img, `name`) VALUES ('$img','$movieName')");
            $_SESSION['newMovieMSG']= "New Movie :  ".$movieName." is added successfully";
        }
    }
}
?>
<script>
    setTimeout(function()
    {
        window.location = "../newMovie.php";
    }, 10);
</script>
