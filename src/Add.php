<?php
include '../config/connection.php';

$response = [];

  $ItemName     = 'Thumsup';//mysqli_real_escape_string($con,$_POST['ItemName']);
  $ItemSKU      = '123456';//$_POST['ItemSKU'];
  $ItemHSN      = '1234567';$_POST['ItemHSN'];
  $ItemUnit     = '';//$_POST['ItemUnit'];
  $ItemCategory = $_POST['ItemCategory'];
  $ItemDescription = $_POST['ItemDescription'];

  $ItemSizeId        = $_POST['ItemSize'];
  $PackingTypeId     = $_POST['PackingTypeId'];
  $packingQty        = $_POST['ItemSizeQty'];
  $packingSubQty        = $_POST['ItemSizeSubQty'];
  $ItemQty           = $_POST['ItemQuantity'];
  $ItemReorderLabel  = $_POST['ItemReorderLabel'];

  $ItemPrice       = $_POST['ItemPrice'];
  $ItemTax         = $_POST['ItemTax'];
  $asondate        = date("Y-m-d");
  $SupplierId      = $_POST['SupplierId'];

  $ItemCategory = !empty($ItemCategory) ? $ItemCategory : "NULL";
  $ItemSizeId  = !empty($ItemSizeId) ? $ItemSizeId : "NULL";
  $PackingTypeId = !empty($PackingTypeId) ? $PackingTypeId : "NULL";
  $ItemTax = !empty($ItemTax) ? $ItemTax : "NULL";
  $SupplierId = !empty($SupplierId) ? $SupplierId : "NULL";
  $packingSubQty = !empty($packingSubQty) ? $packingSubQty : 1;
  $ItemReorderLabel = !empty($ItemReorderLabel) ? $ItemReorderLabel : "NULL";
 $packingQty = !empty($packingQty) ? $packingQty : 1;
$totalQty =  $packingQty*$ItemQty;
$sql_insert = "INSERT INTO ItemMaster(companyId, ItemName, SKU, HSN, Unit,CategoryId,Description) VALUES($companyId,
'$ItemName','$ItemSKU','$ItemHSN','$ItemUnit',$ItemCategory,'$ItemDescription')";

if(mysqli_query($con,$sql_insert) or die(mysqli_error($con))){
  $item_id = mysqli_insert_id($con);

$sql_insert_details = "INSERT INTO ItemDetailMaster(ItemId,SizeId,PackingTypeId,PackingQty,Quantity,totalqty,SubPacking,ReorderLabel) VALUES(
  $item_id,$ItemSizeId,$PackingTypeId,$packingQty,$ItemQty,$totalQty,$packingSubQty,$ItemReorderLabel)";
  // echo $sql_insert_details;
  if(mysqli_query($con,$sql_insert_details) or die(mysqli_error($con))){
    $itemDetailId = mysqli_insert_id($con);
    // $asondate = date("Y-m-d");
    $sql_insert_price = "INSERT INTO ItemPrice(ItemDetailId,price,fromDate) VALUES('$itemDetailId','$ItemPrice','$asondate')";
    mysqli_query($con,$sql_insert_price) or die(mysqli_error($con));
    $sql_insert_tax = "INSERT INTO ItemTax(ItemDetailId,TaxId,fromDate) VALUES($itemDetailId,$ItemTax,'$asondate')";
    mysqli_query($con,$sql_insert_tax) or die(mysqli_error($con));
    $sql_insert_supplier = "INSERT INTO SuplierItem(PersonId,ItemId) VALUES($SupplierId,$item_id)";
      mysqli_query($con,$sql_insert_supplier) or die(mysqli_error($con));
  }else {
    $response['msg'] = 'Error while inserting in Details Master';
  }
  $response['msg'] = 'Inventory '.$ItemName.' Added Successfully';
}else {
  $response['msg'] = "Error while Adding";
}
?>