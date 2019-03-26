<?php
include '../config/connection.php';
// session_start();
$companyId = 1;//$_SESSION['companyId'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $TaxType = $_POST['TaxType'];
  $TaxPercent = $_POST['TaxPercent'];
  $sql_insert = "INSERT INTO TaxMaster(companyId,TaxType,TaxPercent) VALUES($companyId,'$TaxType','$TaxPercent')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'Inserted';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
