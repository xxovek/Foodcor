<?php
include '../config/connection.php';
// session_start();
$companyId = 1;//$_SESSION['companyId'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $CategoryName = $_POST['CategoryName'];
  $sql_insert = "INSERT INTO CategoryMaster(companyId,CategoryName) VALUES($companyId,'$CategoryName')";
  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'Inserted';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
