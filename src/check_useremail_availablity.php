<?php
include '../config/connection.php';
$response = [];
session_start();
$companyId = $_SESSION['company_id'];
if(!empty($_REQUEST["user_email"])) {
  $email = $_REQUEST["user_email"];
  $sql="SELECT count(UM.emailId) FROM UserMaster UM LEFT JOIN CompanyMaster CM ON  CM.CompanyId = UM.companyId WHERE emailId='$email' AND flag=1 AND UM.companyId = $companyId";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $user_count = $row[0];
  if($user_count>0) {
$response['msg'] =1 ;
  }else{
    $response['msg'] =0 ;
  }
}
exit(json_encode($response));
mysqli_close($con);
?>
