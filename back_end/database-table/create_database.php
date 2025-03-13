<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'payroll';
    //connect using the info above.
    $con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS);
    if(!$con){
    die('Could not Connect My Sql:' .$con->error);
    }
    date_default_timezone_set("Africa/Nairobi");

$sql = "CREATE DATABASE IF NOT EXISTS payroll"; 

if (!$con->query($sql)) {
  echo $con->error;
  
} 
?>