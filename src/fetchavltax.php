<?php
include '../config/connection.php';
// $companyId = 1;

session_start();
$response = [];
$companyId = $_SESSION['company_id'];
$TaxPercent = $_REQUEST['TaxPercent'];


$sql = "SELECT count(TaxId) as taxcount  FROM TaxMaster WHERE TaxPercent='$TaxPercent' and companyId=$companyId";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$response['count'] = $row['taxcount'];
mysqli_close($con);
exit(json_encode($response));
?>
