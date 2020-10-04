<?php

  $connection_db = mysqli_connect('localhost','root','root','cinemaDB');
  if(mysqli_connect_errno()){
    echo 'Error to connection DB ('.mysqli_connect_errno().'): '.mysqli_connect_error();
    exit();
  }
  ?>



