<?php
include '../config/connection.php';
$response=[];
$fdate=$_REQUEST['fromDate'];
$item=$_REQUEST['item'];
$sql="SELECT SUM(qty) as O_BAL FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
  WHERE `itemDetailId`='$item' AND date(TM.`DateCreated`)<= '$fdate'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
if($row['O_BAL']=='')
$row['O_BAL']=0;
$response['O_BAL'] =$row['O_BAL'];

mysqli_close($con);
exit(json_encode($response));
 ?>
