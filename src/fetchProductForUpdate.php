<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$ItemId = $_GET['productId'];
$sql = "SELECT IM.ItemId,IM.ItemName,IM.SKU,IM.HSN,IM.Unit,IM.CategoryId,IM.Description,ID.sizeId,
ID.PackingTypeId,PM.FirstName,PM.lastName,
ID.PackingQty,ID.SubPacking,ID.Quantity,ID.ReorderLabel,IT.TaxId,IP.price,IP.fromDate,ID.itemDetailId
FROM ItemMaster IM LEFT JOIN ItemDetailMaster ID ON IM.ItemId = ID.ItemId
LEFT JOIN ItemTax IT ON IT.ItemDetailId = ID.itemDetailId
LEFT JOIN SuplierItem SI ON SI.ItemId = IM.ItemId
LEFT JOIN PersonMaster PM ON PM.PersonId = SI.PersonId
LEFT JOIN ItemPrice IP ON IP.ItemDetailId = ID.itemDetailId WHERE IM.ItemId = $ItemId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
        $response['ItemId']      = $row['ItemId'];
        $response['itemDetailId'] = $row['itemDetailId'];
        $response['ItemName']    = $row['ItemName'];
        $response['SKU']         = $row['SKU'];
        $response['HSN']         = $row['HSN'];
        $response['Unit']        = $row['Unit'];
        $response['Description'] = $row['Description'];
        $response['sizeId']      = $row['sizeId'];
        $response['PackingTypeId'] = $row['PackingTypeId'];
        $response['CategoryId']    = $row['CategoryId'];
        $response['PackingQty']    = $row['PackingQty'];
        $response['SubPacking'] = $row['SubPacking'];
        $response['price']         = $row['price'];
        $response['Quantity']      = $row['Quantity'];
        $response['ReorderLabel']  = $row['ReorderLabel'];
        $response['TaxId']         = $row['TaxId'];
        $response['fromDate']      = $row['fromDate'];
        $response['SupplierName']  = $row['FirstName'].' '.$row['lastName'];
    }
  }
mysqli_close($con);
exit(json_encode($response));
  ?>
