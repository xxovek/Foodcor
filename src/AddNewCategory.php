<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $CategoryName = $_POST['CategoryName'];
  $sql_insert = "INSERT INTO CategoryMaster(companyId,CategoryName) VALUES($companyId,'$CategoryName')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = $CategoryName.' Category Added Successfully';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
