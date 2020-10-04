<?php
session_start();
require_once "functions/connectDB.php";
require_once "functions/functions.php";

if(!$_POST['gate_id']){
    $_SESSION['movie_id']=$_POST['movie_id'];
    ?>
    <script>
        setTimeout(function()
        {
            window.location = "ticketsNoGate.php";
        }, 100);
    </script>
    <?php

}

$movies = getMovies($connection_db);
$gates = getGates($connection_db);
$gate_id = $_POST['gate_id'];
$movie_id = $_POST['movie_id'];
$gateById = getGateById($connection_db,$gate_id);
$movieById = getMovieByID($connection_db,$movie_id);
$freePlaces=getFreePlaces($connection_db,$gate_id,$movie_id);
$fullPlaces=$gateById[0]['total_seats']-$freePlaces[0]['free_seats'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/myStyle.css" type="text/css" media="all" />
    <link rel="shortcut icon" href="css/img/Cinema-icon.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500|Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="/css/signUP.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/comingSoon.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/movieStyle.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/indexPageMenu.css" type="text/css" media="all" />
    <title>Cinema</title>
</head>

<body>

<div class="containerOfAllSite">
    <div class="allSiteDiv">
        <div class="loginDiv">
            <div class="logoTextForLogo" style="position: absolute; top:5px; left: 26%; background: none; color: white !important;
                text-shadow: 0 0 5px black,
                             0 0 25px black,
                             0 0 100px black,
                             0 0 200px black; font-size: 30px">
                <h1 class="comingSoon">COMING SOON</h1>
                <h3>ON</h3>
                <h1 class="logoHyperactive">HYPERACTIVE CINEMA</h1>
                <h3>BEST MOVIE FOR BEST PEOPLE</h3>
            </div>
            <?php
            if (!$_SESSION['user']) {
                ?>
                <div class="containerSignUpForm">
                    <div class="banner">
                        <h1 class="loginText">Press for login</h1>
                        <div class="arrow">
                            <i class="fas fa-arrow-down2">&#9759;</i>
                        </div>
                        <button class="bannerButton">LOGIN</button>
                    </div>
                    <div class="formContainer" >
                        <form action="/functions/authorization.php" method="post" class="signUpForm">
                            <input type="text" class="formInput" placeholder="LOGIN" name="login">
                            <input type="password" class="formInput" placeholder="PASSWORD" name="password">
                            <button type="submit" name="signUP">Sign Up</button>
                        </form>
                        <div class="x-button"> &#10006; </div>
                    </div>
                    <script src="/js/signUp.js"></script>
                </div>
                <?php
            }
            ?>
            <div class="loginMessage">
                <?php
                if (!$_SESSION['user']) {
                    ?>
                    <p class="loginTextMSG"><?php
                        if ($_SESSION['msg']) {
                            echo "" . $_SESSION['msg'];
                        }
                        ?>
                    </p>
                    <?php
                } else {
                    ?>
                    <div class="banner" >
                        <h1 class="loginText">
                            <?php
                            echo "Hello " . $_SESSION['name'] ;
                            ?>
                        </h1>
                        <div class="arrow">
                            <i class="fas fa-arrow-down2">&#9759;</i>
                        </div>
                        <form action="functions/logout.php">
                            <button type="submit" class="bannerButton">LOG OUT</button>
                        </form>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
        <div class="logoDiv">
            <div class="sliderComingSoon"></div>
        </div>

        <div class="pageMenu">


            <div class="menuButtons">
                <a href="index.php" class="indexPageMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    all movies
                </a>
                <a href="moviesByGates.php" class="moviesByGatesPageMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    movies by gates
                </a>
                <?php
                if ($_SESSION['user']) {
                    ?>
                    <a href="admin.php" class="adminPageMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        administrator menu
                    </a>
                    <?php
                }
                ?>
            </div>



        </div>
        <div class="contentDiv">

            <h1 class="ticketOrder">
                <form action="order.php" method="post" class="form">
                    <h1>
                        <?php
                        echo "".$gateById[0]['name'];
                        ?>
                    </h1>
                    <h1>
                        <?php
                        echo "".$movieById[0]['name'];
                        ?>
                    </h1>
                    <div class="ticketMoviePic" align="center">
                        <?php
                        echo '<img width="139.95" height="192.9" src="data:image/jpeg;base64,'.base64_encode( $movieById[0]['img'] ).'"/>';
                        ?>
                    </div>
                    <?php $freePlaces=getFreePlaces($connection_db,$gate_id,$movie_id); ?>
                    <h1>
                        <?php
                        echo 'Free tickets: '.$freePlaces[0]['free_seats'];
                        ?>
                    </h1>

                    <div class="input-form">
                        <input type="text" placeholder="Enter name" name="name" required>
                    </div>
                    <div class="input-form">
                        <input type="number" placeholder="Enter quantity of tickets" name="tickets" required>
                    </div>

                    <div class="input-form">
                        <input type="hidden" name="gate_id" value="<?php echo $gate_id;?>" />
                        <input type="hidden" name="gate_name" value="<?php echo $gateById[0]['name'];?>" />
                        <input type="hidden" name="movie_id" value="<?php echo $movie_id;?>" />
                        <input type="hidden" name="movie_name" value="<?php echo $movieById[0]['name'];?>" />
                        <input type="hidden" name="freePlaces" value="<?php echo $freePlaces[0]['free_seats'];?>" />
                        <input type="hidden" name="fullPlaces" value="<?php echo $fullPlaces;?>" />
                        <input type="hidden" name="id" value="<?php echo $freePlaces[0]['id'];?>" />
                        <input type="hidden" name="sections" value="<?php echo $gateById[0]['sections'];?>" />
                        <input type="hidden" name="rows" value="<?php echo $gateById[0]['rows'];?>" />
                        <input type="hidden" name="seats" value="<?php echo $gateById[0]['seats'];?>" />
                        <button type="submit" name="button">Order</button>
                    </div>
                </form>
				
				
				
				
				
				
				
				
            </div>
			
			
			
			
			
			
			
        </div>
        <div class="footerDiv">
            <div class="footer">
                Copyright &copy;
                <?php echo date("Y")." "; ?>
                All Rights Reserved by <a href="https://talpiot-hitech.com/" target="_blank" class="footerLink">HYPERACTIVE</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>