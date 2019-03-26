<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $UnitName = $_POST['UnitName'];
  $sql_insert = "INSERT INTO UnitMaster(companyId,UnitType) VALUES($companyId,'$UnitName')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = $UnitName.' New Unit Added Successfully';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
