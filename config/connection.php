<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
// $dbname     = 'Foodcor1';
 $dbname     = 'fastinvo_demo';
$con = new mysqli($servername,$username,$password,$dbname) or die(mysqli_error($con));
?>
