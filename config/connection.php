<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$dbname     = 'Foodcor1';
// $dbname     = 'fastinvofoodcor';
$con = new mysqli($servername,$username,$password,$dbname) or die(mysqli_error($con));
?>
