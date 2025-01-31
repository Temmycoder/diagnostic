<?php
  session_start();
  
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'diagnostic_db';
  $success="";
  $error="";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if($conn->connect_error){
    die("Connection error on server". $conn->connect_error);
  }
?>