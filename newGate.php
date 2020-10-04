<?php
session_start();
require_once "functions/connectDB.php";
require_once "functions/functions.php";
$movies = getMovies($connection_db);
$gates = getGates($connection_db);

if (!$_SESSION['user']) {
    ?>
    <script>
        setTimeout(function() {
            window.location = "../index.php";
        }, 10);
    </script>
    <?php
} else {
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
    <link rel="stylesheet" href="/css/newGateSubPageMenu.css" type="text/css" media="all" />
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
    <div class="subMenu">
        <div class="pageName">
            <div class="menuButtons">
                <a href="newGate.php" class="newGatePageMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Make new GATE
                </a>
                <a href="newMovie.php" class="newMoviePageMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Make new MOVIE
                </a>
                <a href="movieToGate.php" class="movieToGatePageMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Add movie to Gate
                </a>
                <a href="mapOfSeats.php" class="mapOfSeatsPageMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Map Gates
                </a>
            </div>
        </div>
    </div>
        <div class="contentDiv" >
            <form action="admin/newGate.php" method="post" class="form">
                <h1><?php
                    if($_SESSION['newGateMSG']){
                        echo $_SESSION['newGateMSG'];
                    }
                    unset($_SESSION['newGateMSG']);
                    ?></h1>
                <h1>Make new GATE</h1>
                <div class="input-form">
                    <input type="text" placeholder="Enter gate name" name="gateName" required>
                </div>
                <div class="input-form">
                    <input type="number" placeholder="Enter quantity of sections" name="sections" required>
                </div>
                <div class="input-form">
                    <input type="number" placeholder="Enter quantity of rows" name="rows" required>
                </div>
                <div class="input-form">
                    <input type="number" placeholder="Enter quantity of seats" name="seats" required>
                </div>
                <div class="input-form">
                    <button type="submit" name="button">Make new GATE</button>
                </div>
            </form>
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
<?php
}
?>