<?php
include '../config/connection.php';
session_start();
$response = [];
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $paymentmethod = $_POST['paymentmethod'];
  $sql_insert = "INSERT INTO PaymentTypes( companyId, PaymentType) VALUES ($companyId,'$paymentmethod')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = true;
    $response['paytype'] = $paymentmethod;
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
