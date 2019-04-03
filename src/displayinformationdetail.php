<?php
include '../config/connection.php';
session_start();
$company_id= $_SESSION['company_id'];
$response = [];

$sql ="SELECT CM.companyName,CN.contactNumber,CN.contactAddress,CN.country
,CN.CState,CN.city,CN.zipcode,UM.emailId FROM CompanyMaster CM ,
ContactMaster CN ,UserMaster UM WHERE UM.companyId='$company_id' and CN.contactId='$company_id' and CM.CompanyId ='$company_id'";

 // $sql ="SELECT C.companyName,C.logo,CM.contactAddress,CM.contactNumber,CM.country,CM.CState,CM.city,CM.zipcode FROM CompanyMaster C
 // LEFT JOIN ContactMaster CM ON C.contactId = CM.contactId WHERE C.CompanyId ='$company_id'";

if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $response['cName'] =ucwords($row['companyName']);
    $response['phone'] =$row['contactNumber'];
    $response['addr'] =ucwords($row['contactAddress']);
    $response['country'] =$row['country'];
    $response['state'] =ucwords($row['CState']);
    $response['city'] =$row['city'];
    $response['zip'] =ucwords($row['zipcode']);
    $response['emailId'] =ucwords($row['emailId']);
    // $response['logo'] =$row['logo'];
    // $response['cid'] =$company_id;
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
