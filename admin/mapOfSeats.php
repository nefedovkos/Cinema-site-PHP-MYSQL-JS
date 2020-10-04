<?php
require_once "../functions/connectDB.php";
require_once "../functions/functions.php";
$movies = getMovies($connection_db);
$gates = getGates($connection_db);

?>

<div class="allContent">
    <?php
    foreach ($gates as $gate){
        ?>
        <div class="showGates">

            <h1 class="gateName">
                <?php
                echo "Gate name: ".$gate['name'];
                ?>
            </h1>
        </div>

        <?php
        $moviesByGates = getMoviesByGate($connection_db,$gate['id']);
        foreach ($moviesByGates as $moviesByGate){
            ?>
            <div class="showMovies" style="display: inline-block">
                <?php
                foreach ($movies as $movie){
                    if($moviesByGate['movie_id'] == $movie['id']){
                            $gate_id=$gate['id'];
                            $movie_id=$movie['id'];
                            $sections=$gate['sections'];
                            $rows=$gate['rows'];
                            $seats=$gate['seats'];
                            $totalSeats=$gate['total_seats'];
                            $freeSeats=getFreePlaces($connection_db,$gate_id,$movie_id);
                            $seatsToUse=$totalSeats-$freeSeats[0]['free_seats'];






                        ?>
                        <div class="showMovieName" align="center">
                            <?php
                            echo $movie['name'];
                            ?>
                        </div>
                        <div class="printMovieMap" >


                            <?php
                            $counter=1;
                            for($sec=1; $sec<=$sections;$sec++){
                                ?><br><?php
                                echo "Section ".$sec;
                                ?><br><?php
                                echo "........seat......";
                                for($seat=1; $seat<=$seats;$seat++)
                                    echo " .".$seat.". ";
                                for($row=1; $row<=$rows;$row++){

                                    ?><br><?php
                                        if($row<10)
                                        echo "Row ".$row."_____";
                                        else echo "Row ".$row."____";
                                    for($seat=1; $seat<=$seats;$seat++){
                                        if($seat <10 ){
                                            if($counter == $seatsToUse+1){
                                                echo " .0. ";
                                                $seatsToUse++;
                                            } else{
                                                echo " .x. ";
                                            }
                                        } else{if($counter == $seatsToUse+1){
                                            echo " ..0..";
                                            $seatsToUse++;
                                        } else{
                                            echo " ..x..";
                                        }


                                        }

                                    $counter++;
                                    }
                                 }
                            }
                            ?>

                        </div>
            </div>


                        <?php
                    }
                }
                ?>

                <br>
            </div>
            <?php
        }
    }
    ?>
</div>



