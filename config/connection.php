<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$dbname = 'fastinvodemo';
// $dbname     = 'Foodcor1';
$con = new mysqli($servername,$username,$password,$dbname) or die(mysqli_error($con));
?>
