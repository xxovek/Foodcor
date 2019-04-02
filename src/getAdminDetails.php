<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$sql = "SELECT UserId FROM UserMaster WHERE companyId = $companyId AND isAdmin = 1";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
   $response['msg'] = true;
  }else{
    $response['msg'] = false;
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
