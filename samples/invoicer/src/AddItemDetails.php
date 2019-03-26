<?php
include '../config/connection.php';
// session_start();
$companyId = 1;//$_SESSION['companyId'];
$response = [];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
$ItemName     = $_POST['ItemName'];
$ItemSKU      = $_POST['ItemSKU'];
$ItemHSN      = $_POST['ItemHSN'];
$ItemUnit     = $_POST['ItemUnit'];
$ItemCategory = $_POST['ItemCategory'];
$ItemDescription = $_POST['ItemDescription'];

$ItemSizeId        = $_POST['ItemSize'];
$PackingTypeId     = $_POST['PackingTypeId'];
$packingQty        = $_POST['ItemSizeQty'];
$ItemQty           = $_POST['ItemQuantity'];
$ItemReorderLabel  = $_POST['ItemReorderLabel'];

$ItemPrice       = $_POST['ItemPrice'];
$ItemTax         = $_POST['ItemTax'];

$ItemCategory = !empty($ItemCategory) ? "'$ItemCategory'" : "NULL";
$ItemSizeId  = !empty($ItemSizeId) ? "'$ItemSizeId'" : "NULL";
$PackingTypeId = !empty($PackingTypeId) ? "'$PackingTypeId'" : "NULL";
$ItemTax = !empty($ItemTax) ? "'$ItemTax'" : "NULL";

$sql_insert = "INSERT INTO ItemMaster(companyId, ItemName, SKU, HSN, Unit,CategoryId, Description) VALUES($companyId,
'$ItemName','$ItemSKU','$ItemHSN','$ItemUnit',$ItemCategory,'$ItemDescription')";

if(mysqli_query($con,$sql_insert) or die(mysqli_error($con))){
  $item_id = mysqli_insert_id($con);

$sql_insert_details = "INSERT INTO ItemDetailMaster(ItemId,SizeId,PackingTypeId,PackingQty,Quantity,ReorderLabel) VALUES(
  $item_id,$ItemSizeId,$PackingTypeId,'$packingQty',$ItemQty,'$ItemReorderLabel')";
  if(mysqli_query($con,$sql_insert_details) or die(mysqli_error($con))){
    $itemDetailId = mysqli_insert_id($con);
    $date = date("Y-m-d");
    $sql_insert_price = "INSERT INTO ItemPrice(ItemDetailId,price,fromDate) VALUES('$itemDetailId','$ItemPrice','$date')";
    mysqli_query($con,$sql_insert_price) or die(mysqli_error($con));
    $sql_insert_tax = "INSERT INTO ItemTax(ItemDetailId,TaxId,fromDate) VALUES($itemDetailId,$ItemTax,'$date')";
    mysqli_query($con,$sql_insert_tax) or die(mysqli_error($con));
  }else {
    $response['msg'] = 'Error while inserting in Details Master';
  }
  $response['msg'] = 'Inventory '.$ItemName.' Added Successfully';
}else {
  $response['msg'] = "Error while Adding";
}
mysqli_close($con);
exit(json_encode($response));
}

 ?>
