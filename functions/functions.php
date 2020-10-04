<?php

      function getMovies($connection_db){
        $query = "SELECT * FROM movies";
        $result = mysqli_query($connection_db,$query);
        $movies = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $movies;
    }

    function getGates($connection_db){
        $query = "SELECT * FROM gates";
        $result = mysqli_query($connection_db,$query);
        $gates = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $gates;
    }
    function getGateMovies($connection_db){
        $query = "SELECT * FROM gatemovies";
        $result = mysqli_query($connection_db,$query);
        $gateMovies = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $gateMovies;
    }
    function getMoviesByGate($connection_db,$gate_id){
        $query = "SELECT * FROM gatemovies WHERE gate_id=".$gate_id;
        $result = mysqli_query($connection_db,$query);
        $moviesByGate = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $moviesByGate;
    }
    function getGatesByMovie($connection_db,$movie_id){
        $query = "SELECT * FROM gatemovies WHERE movie_id=".$movie_id;
        $result = mysqli_query($connection_db,$query);
        $gatesByMovie = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $gatesByMovie;
    }

    function getMovieByID($connection_db, $id){
        $query = "SELECT * FROM movies WHERE id=".$id;
        $result = mysqli_query($connection_db,$query);
        $movieById = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $movieById;
    }


    function getGateById($connection_db,$gate_id){
        $query = "SELECT * FROM gates WHERE id=".$gate_id;
        $result = mysqli_query($connection_db,$query);
        $gateById = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $gateById;
    }



    function getFreePlaces($connection_db,$gate_id,$movie_id){
        $query = "SELECT * FROM gatemovies WHERE gate_id=".$gate_id." AND movie_id=".$movie_id;
        $result = mysqli_query($connection_db,$query);
        $freePlaces = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $freePlaces;
    }


/*Function to order tickets*/

    function orderTickets($connection_db,$freePlaces,$gate_id,$movie_id){
        $query = "UPDATE `gatemovies` SET `free_seats` = ".$freePlaces." WHERE gate_id=".$gate_id." AND movie_id=".$movie_id;
        mysqli_query($connection_db,$query);
        $query = "SELECT * FROM gatemovies WHERE gate_id=".$gate_id." AND movie_id=".$movie_id;
        $result = mysqli_query($connection_db,$query);
        $freePlaces = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $freePlaces;
    }

?>

