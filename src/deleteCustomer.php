<?php
include '../config/connection.php';

 $pid = $_REQUEST['cid'];
$sql="Delete From PersonMaster where PersonId= '$pid' ";
$resut=mysqli_query($con,$sql);
 ?>
