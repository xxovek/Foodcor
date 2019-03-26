<?php
include 'connection.php';
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
$ItemCategory = $_REQUEST['ItemCategory'];


$ItemDescription = $_POST['ItemDescription'];


$ItemSizeId        = $_POST['ItemSize'];
$PackingTypeId     = $_POST['PackingTypeId'];
$packingQty        = $_POST['ItemSizeQty'];
$ItemQty           = $_POST['ItemQuantity'];
$ItemReorderLabel  = $_POST['ItemReorderLabel'];

$ItemPrice       = $_POST['ItemPrice'];
$ItemTax         = $_POST['ItemTax'];

$sql_insert = "INSERT INTO ItemMaster(companyId, ItemName, SKU, HSN, Unit, CategoryId, Description) VALUES($companyId,
'$ItemName','$ItemSKU','$ItemHSN','$ItemUnit',$ItemCategory,'$ItemDescription')";
echo $sql_insert;
if(mysqli_query($con,$sql_insert) or die(mysqli_error($con))){
  $item_id = mysqli_insert_id($con);
  echo $item_id;
$sql_insert_details = "INSERT INTO ItemDetailMaster(ItemId,SizeId,PackingTypeId,PackingQty,Quantity,ReorderLabel) VALUES(
  $item_id,$ItemSizeId,$PackingTypeId,$packingQty,$ItemQty,$ItemReorderLabel)";
  if(mysqli_query($con,$sql_insert_details) or die(mysqli_error($con))){
    $itemDetailId = mysqli_insert_id($con);
    $date = date("Y-m-d");
    $sql_insert_price = "INSERT INTO ItemPrice(ItemDetailId,price,fromDate) VALUES('$itemDetailId','$ItemPrice','$date')";
    mysqli_query($con,$sql_insert_price);
    $sql_insert_tax = "INSERT INTO ItemTax(ItemDetailId,TaxId,fromDate) VALUES('$itemDetailId','$ItemTax','$date')";
    mysqli_query($con,$sql_insert_tax);
  }else {
    $response['msg'] = 'Error while inserting in Details Master';
  }
  $response['msg'] = 'Inserted';
}else {
  $response['msg'] = "Error while Adding";
}
mysqli_close($con);
exit(json_encode($response));
}

 ?>
