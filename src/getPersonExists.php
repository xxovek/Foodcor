<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$EmailId   = $_REQUEST['EmailId'];
$sql = "SELECT PersonId FROM PersonMaster WHERE EmailId = '$EmailId' AND companyId = $companyId AND personTypeId = 2";

$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)==1){
    $response['msg'] = 1;
  }
  else{
    $response['msg'] = 0;
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
