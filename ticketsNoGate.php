<?php
session_start();
require_once "functions/connectDB.php";
require_once "functions/functions.php";
$movies = getMovies($connection_db);
$gates = getGates($connection_db);
if(!$_POST['movie_id']){
    $movie_id=$_SESSION['movie_id'];
} else {
    $movie_id = $_POST['movie_id'];
}
$movieById = getMovieByID($connection_db,$movie_id);
$gatesByMovie = getGatesByMovie($connection_db,$movie_id);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/myStyle.css" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="css/img/Cinema-icon.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500|Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="/css/signUP.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/movieStyle.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/indexPageMenu.css" type="text/css" media="all" />
    <title>Cinema</title>
</head>

<body>





<div class="containerOfAllSite">
    <div class="allSiteDiv">




        <div class="loginDiv">
            <div class="containerSignUpForm">
                <?php
                if (!$_SESSION['user']) {
                    ?>

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


                    <?php
                }
                ?>




            </div>


            <div class="loginMessage">
                <?php
                if (!$_SESSION['user']) {
                    ?>
                    <p class="loginTextMSG" style="box-shadow: none"><?php
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
            <div class="logoTextForLogo" style="
                text-shadow: 0 0 5px black,
                             0 0 25px black,
                             0 0 100px black,
                             0 0 200px black;">
                <h1 class="comingSoon">COMING SOON</h1>
                <h3>ON</h3>
                <h1 class="logoHyperactive">HYPERACTIVE CINEMA</h1>
                <h3>BEST MOVIE FOR BEST PEOPLE</h3>
            </div>
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
		
		
		
            <div class="ticketOrder">
                <form action="tickets.php" method="post" class="form">

                    <h1>
                        <?php
                        if($_SESSION['errorMsg']){
                            echo "".$_SESSION['errorMsg'];
                        }
                        unset($_SESSION['errorMsg']);
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

                    <h1>Please choose gate</h1>


                    <h1>

                        <?php
                        for($i=0; $i<=count($gatesByMovie); $i++){

                            foreach ($gates as $gate){
                                if($gatesByMovie[$i]['gate_id'] == $gate['id']){
                                    ?>
                                    <br>
                                    <input type="radio"  value="<?php echo $gate['id']; ?>" name="gate_id">
                                    <?php
                                    echo "Gate name: ".$gate['name'];
                                }

                            }


                        }
                        ?>
                    </h1>
                    <div class="input-form">
                        <input type="hidden" value="<?php echo $movie_id; ?>" name="movie_id" />
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