<?php
session_start();
require_once "functions/connectDB.php";
require_once "functions/functions.php";
$movies = getMovies($connection_db);
$gates = getGates($connection_db);

$name = $_POST['name'];
$tickets = $_POST['tickets'];
$gate_id=$_POST['gate_id'];
$gate_name=$_POST['gate_name'];
$movie_id=$_POST['movie_id'];
$movie_name=$_POST['movie_name'];
$id=$_POST['id'];
$freePlaces=$_POST['freePlaces'];
$sections=$_POST['sections'];
$rows=$_POST['rows'];
$seats=$_POST['seats'];
$fullPlaces=$_POST['fullPlaces'];
$canPrint=false;







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
		
		
		
		
 <div class="printContainer">
     <?php
     if($freePlaces<$tickets){
         $_SESSION['errorMsg']='Have not enough tickets,  you can buy maximum '.$freePlaces.' tickets';
         $_SESSION['movie_id']=$movie_id;
         ?>
         <script>
             setTimeout(function()
             {
                 window.location = "../ticketsNoGate.php";
             }, 10);
         </script>
         <?php
     } else {
         orderTickets($connection_db, $freePlaces - $tickets, $gate_id, $movie_id);
         $canPrint = true;
     }
     ?>
            <div class="printFunction">
                <?php
                if($canPrint){
                $counter=1;
                ?>
                <div class="ticketPrint">
                    <?php
                    for($sec=1; $sec<=$sections;$sec++){
                    for($row=1; $row<=$rows;$row++){
                    for($seat=1; $seat<=$seats;$seat++){
                    if($counter == $fullPlaces+1 AND $tickets>0){

                    ?>
                    <div class="ticketInfo">
                        <div class="printInfo">
                            Name:   <?php echo $name; ?>
                        </div>
                        <div class="printInfo">
                            Gate :  <?php echo $gate_name; ?>
                        </div>
                        <div class="printInfo">
                            Movie : <?php echo $movie_name; ?>
                        </div>
                        <div class="printInfo" style="text-align: center; justify-content: center; display: grid; grid-template-columns: 70px 70px 70px;">
                            <div>Section </div>
                            <div>Row </div>
                            <div>Seat</div>
                            <div><?php echo " ".$sec; ?></div>
                            <div><?php echo " ".$row; ?></div>
                            <div><?php echo " ".$seat; ?></div>
                        </div>

                    </div>
                        <?php
                        $fullPlaces++;
                        $tickets--;
                    }
                    ?>
                    <?php
                        $counter++;
                        }
                        }
                        }
                    ?>
                </div>
                <?php
                }
            ?>


            </div>
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