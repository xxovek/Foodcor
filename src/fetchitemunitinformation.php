<?php
include '../config/connection.php';

$response = [];
session_start();
$companyId = $_SESSION['company_id'];
$itemunitid = $_REQUEST['itemunitid'];
$itemnameid = $_REQUEST['itemnameid'];

$sql = "SELECT PackingQty,SubPacking,Quantity FROM ItemDetailMaster  WHERE itemDetailId='$itemnameid'";
// echo $sql;
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
 $response['PackingQty'] = 0;
  $response['SubPacking'] = 0;
 if(mysqli_num_rows($result)>0){
     $row = mysqli_fetch_array($result);
     // $Qty = floor($Quantity/$row['OnPurchase']);
     // $offerQty =  $Qty*$row['freeQty'];
     // $BillQty = $Quantity-$offerQty;
     // $Billper = (($row['freeQty']*100)/$row['OnPurchase']);
     // $BillQty = $Quantity - (($Quantity*$Billper)/100);
     $response['Quantity'] = $row['Quantity'];
     $response['SubPacking'] = $row['SubPacking'];
     $response['PackingQty'] = $row['PackingQty'];
}

mysqli_close($con);
exit(json_encode($response));
?>
