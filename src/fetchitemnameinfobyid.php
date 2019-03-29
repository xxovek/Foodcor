<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$response = [];
// session_start();
$itemid = $_REQUEST['itemname'];


$sql = "SELECT IM.HSN,IM.Description,ID.PackingQty,ID.SubPacking,PS.Quantity,PS.totalqty,IT.TaxId,IP.price,ID.itemDetailId,PS.ReorderLabel FROM ItemMaster IM
LEFT JOIN ItemDetailMaster ID ON IM.ItemId = ID.ItemId LEFT JOIN ProductStock PS ON PS.itemdetailId = ID.itemDetailId
LEFT JOIN ItemTax IT ON IT.ItemDetailId = ID.itemDetailId LEFT JOIN ItemPrice IP ON IP.ItemDetailId = ID.itemDetailId
WHERE IM.ItemId = $itemid and PS.companyId =$companyId";
if($result = mysqli_query($con,$sql) or die(mysqli_error($con))){
  $row = mysqli_fetch_array($result);
  $response['HSN'] = $row['HSN'];
  $response['Description'] = $row['Description'];
  $response['Quantity'] = $row['Quantity'];
  $response['TaxId'] = $row['TaxId'];
  $response['price'] = $row['price'];
  $response['itemDetailId'] = $row['itemDetailId'];
  $response['ReorderLabel'] = $row['ReorderLabel'];
  $response['PackingQty'] = $row['PackingQty'];
  $response['SubPacking'] = $row['SubPacking'];
  $response['totalqty'] = $row['totalqty'];
}


mysqli_close($con);
exit(json_encode($response));
?>
