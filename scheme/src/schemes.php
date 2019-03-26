<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];

$scheme=$_REQUEST['scheme'];
$from=$_REQUEST['from'];
$upto=$_REQUEST['upto'];
$item=$_REQUEST['item'];
$onpurchase=$_REQUEST['onpurchase'];
$freeqty=$_REQUEST['freeqty'];

$response=[];
  $sql_insert = "INSERT INTO SchemeMaster(companyId,schemeType,FromDate,UptoDate,ItemDetailId,OnPurchase,freeQty)
   VALUES($companyId,'$scheme','$from','$upto','$item','$onpurchase','$freeqty')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = ' New Scheme Added Successfully';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
mysqli_close($con);
exit(json_encode($response));
 ?>
