<?php
include '../config/connection.php';
session_start();
$companyid = $_SESSION['company_id'];

$response = [];

if(!empty($companyid )) {
 // $companyid = $_SESSION['company_id'] ;

  $sql ="SELECT  flag  FROM UserMaster WHERE companyId = '$companyid' ";
//   echo $sql;
  $result = mysqli_query($con,$sql);
 
  if(mysqli_num_rows($result)>0) {
    $row = mysqli_fetch_array($result);
    if($row['flag'] === '1'){
        $response['msg'] = true ;
    }
    else{
        $response['msg'] = false ;
  }
  }
}

mysqli_close($con);
exit(json_encode($response));

?>
