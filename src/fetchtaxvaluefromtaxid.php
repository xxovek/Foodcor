<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$response = [];
// session_start();
$taxid = $_REQUEST['taxid'];


$sql = "SELECT TaxType,TaxPercent from TaxMaster where TaxId=$taxid and companyId=$companyId";
if($result = mysqli_query($con,$sql) or die(mysqli_error($con))){
  $row = mysqli_fetch_array($result);
  $response['TaxType'] = $row['TaxType'];
  $response['TaxPercent'] = $row['TaxPercent'];

}


mysqli_close($con);
exit(json_encode($response));
?>
