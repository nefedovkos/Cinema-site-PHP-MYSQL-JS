<?php
session_start();
require_once "../functions/connectDB.php";
require_once "../functions/functions.php";
$movies = getMovies($connection_db);
$gates = getGates($connection_db);
$gate_id=$_POST['gate_id'];
$movie_id=$_POST['movie_id'];
$freeSeats=$_POST['freeSeats'];
$gateMovies=getGateMovies($connection_db);
$haveMovie = 0;
$haveGate = 0;
$foundSame = 0;
$totalSeatsProblem=0;
foreach ($gates as $gate){
    if($gate['id'] == $gate_id){
        if($gate['total_seats']<$freeSeats){
            $_SESSION['movieToGateMSG']= "Have not enough seats, please check TOTAL SEATS for this gate";
            $totalSeatsProblem=1;
        }
        $haveGate=1;
    }
}
foreach ($movies as $movie){
    if($movie['id'] == $movie_id){
        $haveMovie=1;
    }
}
foreach($gateMovies as $gateMovie){
    if($gateMovie['movie_id'] == $movie_id and $gateMovie['gate_id'] == $gate_id){
        $foundSame=1;
    }
}
if($haveMovie == 0){
    $_SESSION['movieToGateMSG']= "Wrong input movie ID, try again.";
}
if($haveGate == 0){
    $_SESSION['movieToGateMSG']= "Wrong input gate ID, try again.";
}
if($foundSame == 1){
    $_SESSION['movieToGateMSG']= "You have already this movie in the gate, try other one.";
}
function addMovieToGate($connection_db, $gate_id, $movie_id, $freeSeats,$totalSeatsProblem, $haveMovie, $haveGate, $foundSame){

    if($haveMovie == 1 and  $haveGate == 1 and $foundSame==0 and $totalSeatsProblem==0){
        $query = "INSERT INTO `gatemovies` (`id`, `gate_id`, `movie_id`, `free_seats`) VALUES (NULL, '$gate_id', '$movie_id', '$freeSeats')";
        mysqli_query($connection_db,$query);
        $_SESSION['movieToGateMSG']= "To gate : ".$gate_id."  added movie : ".$movie_id." successfully";
    }
}
addMovieToGate($connection_db, $gate_id, $movie_id, $freeSeats,$totalSeatsProblem, $haveMovie, $haveGate, $foundSame);
?>
    <script>
        setTimeout(function() {
            window.location = "../movieToGate.php";
        }, 100);
    </script>
