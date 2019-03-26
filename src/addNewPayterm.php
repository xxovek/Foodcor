<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $PaytermValue = $_POST['PaytermValue'];
  $sql_insert = "INSERT INTO PaymentTerms(companyId,PaytermType) VALUES($companyId,'$PaytermValue')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = true;
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
