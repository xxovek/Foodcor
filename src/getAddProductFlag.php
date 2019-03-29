<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$response = [];

$sql = "SELECT flag FROM UserMaster WHERE companyId=$companyId";
if($result = mysqli_query($con,$sql)){
  $row = mysqli_fetch_array($result);
  $flag = $row['flag'];
  if($flag == 1){
    $response['msg'] = 1;
  }else{
    $response['msg'] = 0; 
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
