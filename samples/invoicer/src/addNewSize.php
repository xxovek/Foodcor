<?php
include '../config/connection.php';
// session_start();
$companyId = 1;//$_SESSION['companyId'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $SizeValue = $_POST['SizeValue'];
  $sql_insert = "INSERT INTO SizeMaster(companyId,SizeValue) VALUES($companyId,'$SizeValue')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'Inserted';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
