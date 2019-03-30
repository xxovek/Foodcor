<?php
include '../config/connection.php';
 session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $TaxType = $_POST['TaxType'];
  $TaxPercent = $_POST['TaxPercent'];
  $sql_insert = "INSERT INTO TaxMaster(TaxType,TaxPercent) VALUES('$TaxType','$TaxPercent')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'New Tax Type '.$TaxType.'has value  '.$TaxPercent.' Added';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
