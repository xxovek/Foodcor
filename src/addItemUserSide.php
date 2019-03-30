<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$response = [];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "PUT"){
  parse_str(file_get_contents("php://input"), $_PUT);
//   $ItemId              = $_PUT['ItemId'];
  $ItemName     = mysqli_real_escape_string($con,$_PUT['ItemName']);
  $packingQty          = $_PUT['ItemSizeQty'];
  $ItemQty             = $_PUT['ItemQuantity'];
  $ItemReorderLabel  = $_PUT['ItemReorderLabel'];
  $totalQty            =  $packingQty * $ItemQty;
  $ItemDetailId = $_PUT['ItemDetailId'];

  // $qty = $ItemQty;
  // $sql_qty_chk = "SELECT IF(Quantity <> $qty, $qty = Quantity + $qty , $qty = $ItemQty ) From ProductStock 
  // WHERE itemdetailId = '$ItemDetailId' AND companyId = $companyId;";
  // mysqli_query($con,$sql_qty_chk);

$sql = "UPDATE ProductStock
SET ReorderLabel = $ItemReorderLabel 
WHERE itemdetailId = '$ItemDetailId' AND companyId = $companyId";

if(mysqli_query($con,$sql) or die(mysqli_error($con))){
  $response['msg'] = 'Inventory '.$ItemName.' Information Updated Successfully';
}else {
  $response['msg'] = 'Server Error Please Try Again';
  }

$sql_update_item = "UPDATE ProductStock SET 
 Quantity = Quantity + $ItemQty,TotalQty =  $totalQty
 WHERE Quantity <> $ItemQty AND itemdetailId = '$ItemDetailId' AND companyId = $companyId ";

if(mysqli_query($con,$sql_update_item) or die(mysqli_error($con))){
    $response['msg'] = 'Inventory '.$ItemName.' Information Updated Successfully';
}else {
$response['msg'] = 'Server Error Please Try Again';
}

}

mysqli_close($con);
exit(json_encode($response));
?>