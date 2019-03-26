<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $PackingTypeName = $_POST['PackingTypeName'];
  $sql_insert = "INSERT INTO PackingTypeMaster(companyId,PackingType) VALUES($companyId,'$PackingTypeName')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'New Packing Type '.$PackingTypeName.' Added Successfully';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
