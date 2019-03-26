<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$response = [];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $ItemName     = mysqli_real_escape_string($con,$_POST['ItemName']);
  $ItemSKU      = $_POST['ItemSKU'];
  $ItemHSN      = $_POST['ItemHSN'];
  $ItemUnit     = $_POST['ItemUnit'];
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
}
if($method == "PUT")
{
  parse_str(file_get_contents("php://input"), $_PUT);
  $ItemId       = $_PUT['ItemId'];
  $ItemDetailId = $_PUT['ItemDetailId'];
  $ItemName     = mysqli_real_escape_string($con,$_PUT['ItemName']);
  $ItemSKU      = $_PUT['ItemSKU'];
  $ItemHSN      = $_PUT['ItemHSN'];
  $ItemUnit     = $_PUT['ItemUnit'];
  $ItemCategory = $_PUT['ItemCategory'];
  $ItemDescription = $_PUT['ItemDescription'];

  $ItemSizeId        = $_PUT['ItemSize'];
  $PackingTypeId     = $_PUT['PackingTypeId'];
  $packingQty        = $_PUT['ItemSizeQty'];
  $packingSubQty        = $_PUT['ItemSizeSubQty'];
  $ItemQty           = $_PUT['ItemQuantity'];
  $ItemReorderLabel  = $_PUT['ItemReorderLabel'];

  $ItemPrice       = $_PUT['ItemPrice'];
  $ItemTax         = $_PUT['ItemTax'];
  $asondate        = date("Y-m-d");
  $SupplierId      = $_PUT['SupplierId'];

  $ItemCategory = !empty($ItemCategory) ? $ItemCategory : "NULL";
  $ItemSizeId  = !empty($ItemSizeId) ? $ItemSizeId : "NULL";
  $PackingTypeId = !empty($PackingTypeId) ? $PackingTypeId : "NULL";
  $ItemTax = !empty($ItemTax) ? $ItemTax : "NULL";
  $SupplierId = !empty($SupplierId) ? $SupplierId : "NULL";
  $packingSubQty = !empty($packingSubQty) ? $packingSubQty : 1;
  $ItemReorderLabel = !empty($ItemReorderLabel) ? $ItemReorderLabel : "NULL";
  $packingQty = !empty($packingQty) ? $packingQty : 1;
  $totalQty =  $packingQty*$ItemQty;
  $sql_update = "UPDATE ItemMaster SET ItemName = '$ItemName',SKU = '$ItemSKU',HSN = '$ItemHSN',Unit = '$ItemUnit',
  CategoryId = $ItemCategory,Description = '$ItemDescription' WHERE ItemId = $ItemId";

  $sql_update_item = "UPDATE ItemDetailMaster SET totalqty= $totalQty ,SizeId = $ItemSizeId,PackingTypeId= $PackingTypeId,PackingQty=$packingQty,
   SubPacking=$packingSubQty,Quantity = $ItemQty,ReorderLabel = $ItemReorderLabel WHERE ItemId = $ItemId";

  $sql_update_price = "UPDATE ItemPrice SET price = '$ItemPrice' WHERE ItemDetailId = $ItemDetailId";

  $sql_update_tax = "UPDATE ItemTax SET TaxId = $ItemTax WHERE ItemDetailId = $ItemDetailId";

  $sql_update_supplier = "UPDATE SuplierItem SET PersonId = $SupplierId where ItemId = $ItemId";
  if(mysqli_query($con,$sql_update) or die(mysqli_error($con))){
    mysqli_query($con,$sql_update_item) or die(mysqli_error($con));
    mysqli_query($con,$sql_update_price) or die(mysqli_error($con));
    mysqli_query($con,$sql_update_tax) or die(mysqli_error($con));
    mysqli_query($con,$sql_update_supplier) or die(mysqli_error($con));
    $response['msg'] = 'Inventory '.$ItemName.' Information Updated Successfully';
  }else {
  $response['msg'] = 'Server Error Please Try Again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
