<?php
include '../config/connection.php';
$response = [];

if(!empty($_REQUEST["company"])) {
  $cname = $_REQUEST["company"] ;

  $sql ="SELECT companyName FROM CompanyMaster cm WHERE  cm.companyName='$cname'";
  $result = mysqli_query($con,$sql);

  if(mysqli_num_rows($result)>0) {
      $response['msg'] =1 ;
  }else{
        $response['msg'] =0 ;
  }
}
exit(json_encode($response));
mysqli_close($con);

?>
