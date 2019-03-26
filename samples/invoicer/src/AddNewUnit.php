<?php
include '../config/connection.php';
// session_start();
$companyId = 1;//$_SESSION['companyId'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $UnitName = $_POST['UnitName'];
  $sql_insert = "INSERT INTO UnitMaster(companyId,UnitType) VALUES($companyId,'$UnitName')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'Inserted';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
