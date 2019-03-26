<?php
include '../config/connection.php';
$response = [];

if(!empty($_REQUEST["email"])) {
  $email = $_REQUEST["email"] ;
  $sql="SELECT count(emailId) FROM UserMaster WHERE emailId='$email'";
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
