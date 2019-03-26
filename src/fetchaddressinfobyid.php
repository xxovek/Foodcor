<?php
include '../config/connection.php';

$response = [];
session_start();
$companyId = $_SESSION['company_id'];
$custid = $_REQUEST['custid'];


$sql = "SELECT  contactId,contactAddress, contactNumber, country, CState, city, zipcode FROM ContactMaster WHERE contactId In(SELECT ContactId FROM PersonContact WHERE PersonId='$custid')";
$result = mysqli_query($con,$sql);


$row = mysqli_fetch_array($result);
$response['contactId'] = $row['contactId'];
$response['contactAddress'] = $row['contactAddress'];
$response['contactNumber'] = $row['contactNumber'];
$response['country'] = $row['country'];
$response['CState'] = $row['CState'];
$response['city'] = $row['city'];
$response['zipcode'] = $row['zipcode'];

$sql1 = "SELECT sum(COALESCE(RemainingAmount,0)) as RemainingAmount from TransactionMaster where PersonId=$custid and companyId=$companyId and TransactionTypeId=3 and TransactionStatus IN('Partial','Unapplied')";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_array($result1);
$response['RemainingAmount'] = $row1['RemainingAmount'];
if($response['RemainingAmount']==null){
  // $row1 = mysqli_fetch_array($result1);
  $response['RemainingAmount'] = '0';
}
mysqli_close($con);
exit(json_encode($response));
?>
