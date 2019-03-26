<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $SizeValue = $_POST['SizeValue'];
  $sql_insert = "INSERT INTO SizeMaster(companyId,SizeValue) VALUES($companyId,'$SizeValue')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'New Size Value-'.$SizeValue.' added successfully';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
