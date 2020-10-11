<?php
session_start();
require_once "functions/connectDB.php";
require_once "functions/functions.php";
$movies = getMovies($connection_db);
$gates = getGates($connection_db);
$foundMovie=0;
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
    <link rel="stylesheet" href="/css/moviesByGatesPageMenu.css" type="text/css" media="all" />
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
            <div class="moviesByGatesContainer">
                <?php
                    foreach ($gates as $gate){
                ?>

                    <?php
                    $moviesByGates = getMoviesByGate($connection_db,$gate['id']);
                        $foundMovie=0;
                        foreach ($moviesByGates as $moviesByGate){
                            
                            foreach ($movies as $movie){
                                if($moviesByGate['movie_id'] == $movie['id']){
                                    $foundMovie++;
                                    if($foundMovie==1){
                                        ?>
                                        <h1 class="gateName">
                                            <?php
                                            echo "Gate name: ".$gate['name'];
                                            $gateIdToSend=$gate['id'];
                                            ?>
                                        </h1>
                                        <?php
                                    }
                                    ?>

                                    <div class="moviesByGateFlex">
                                        <div class="movieContainer" >
                                            <div class="movieCard">
                                                <div class="movieImageBox">
                                                    <?php
                                                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $movie['img'] ).'"/>';
                                                    ?>
                                                </div>
                                                <div class="contentBox">
                                                    <h2><?php echo $movie['name']; ?></h2>
                                                </div>
                                                <div align="center" class="contentBox">

                                                    <form action="tickets.php" method="post" class="movieForm">
                                                        <input type="hidden" value="<?php echo $movie['id']; ?>" name="movie_id" />
                                                        <input type="hidden" value="<?php echo $gateIdToSend; ?>" name="gate_id" />
                                                        <div class="inputMovieForm">
                                                            <button type="submit" class="buttonMovieForm">Order ticket</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php           
                                }
                            }
                        }
                    }
                                    ?>


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