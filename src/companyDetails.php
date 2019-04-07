<?php
include '../config/connection.php';
session_start();
$company_id= $_SESSION['company_id'];
$response = [];

 // $sql ="SELECT C.companyName,C.logo,CM.contactAddress,CM.contactNumber,CM.country,CM.CState,CM.city,CM.zipcode FROM CompanyMaster C
 // LEFT JOIN ContactMaster CM ON C.contactId = CM.contactId WHERE C.CompanyId ='$company_id'";

$sql ="SELECT C.companyName,C.logo,St.id as stateid,Ct.id as cityid,Con.id as countryid,CM.contactAddress,CM.contactNumber,CM.country,CM.CState,CM.city,CM.zipcode	 FROM CompanyMaster C
 LEFT JOIN ContactMaster CM ON C.contactId = CM.contactId
 LEFT JOIN countries Con  ON Con.name =CM.country
 LEFT JOIN states St ON St.name = CM.CState
 LEFT JOIN cities Ct ON Ct.name = CM.city
 WHERE C.CompanyId =$company_id";
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
    $response['logo'] =$row['logo'];
    $response['cid'] =$company_id;
    $response['bcountryid'] = $row['countryid'];
    $response['bstateid'] = $row['stateid'];
    $response['bcityid'] = $row['cityid'];
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
