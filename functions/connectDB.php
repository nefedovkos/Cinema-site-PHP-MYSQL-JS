<?php

  $connection_db = mysqli_connect('eu-cdbr-west-03.cleardb.net:3306','b52b000f6f17e5','dec7c083','heroku_303afcb7eb079bc');
  if(mysqli_connect_errno()){
    echo 'Error to connection DB ('.mysqli_connect_errno().'): '.mysqli_connect_error();
    exit();
  }
  ?>



