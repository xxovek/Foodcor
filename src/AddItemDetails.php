<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$response = [];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $ItemName            = mysqli_real_escape_string($con,$_POST['ItemName']);
  $ItemSKU             = $_POST['ItemSKU'];
  $ItemHSN             = $_POST['ItemHSN'];
  $ItemUnit            = $_POST['ItemUnit'];
  $ItemCategory        = $_POST['ItemCategory'];
  $ItemDescription     = $_POST['ItemDescription'];
  $ItemSizeId          = $_POST['ItemSize'];
  $PackingTypeId       = $_POST['PackingTypeId'];
  $packingQty          = $_POST['ItemSizeQty'];
  $packingSubQty       = $_POST['ItemSizeSubQty'];
  $ItemQty             = $_POST['ItemQuantity'];
  $ItemReorderLabel    = $_POST['ItemReorderLabel'];
  $ItemPrice           = $_POST['ItemPrice'];
  $ItemTax             = $_POST['ItemTax'];
  $asondate            = date("Y-m-d");
  $SupplierId          = $_POST['SupplierId'];
  $ItemCategory        = !empty($ItemCategory) ? $ItemCategory : "NULL";
  $ItemSizeId          = !empty($ItemSizeId) ? $ItemSizeId : "NULL";
  $PackingTypeId       = !empty($PackingTypeId) ? $PackingTypeId : "NULL";
  $ItemTax             = !empty($ItemTax) ? $ItemTax : "NULL";
  $SupplierId          = !empty($SupplierId) ? $SupplierId : "NULL";
  $packingSubQty       = !empty($packingSubQty) ? $packingSubQty : 1;
  $ItemReorderLabel    = !empty($ItemReorderLabel) ? $ItemReorderLabel : "NULL";
  $packingQty          = !empty($packingQty) ? $packingQty : 1;
  $totalQty            =  $packingQty * $ItemQty;

$sql_insert = "INSERT INTO ItemMaster(ItemName,SKU,HSN,Unit,CategoryId,Description) VALUES('$ItemName','$ItemSKU','$ItemHSN','$ItemUnit',$ItemCategory,'$ItemDescription')";
$i=0;
if(mysqli_query($con,$sql_insert)){ 
  $item_id = mysqli_insert_id($con);
  $i++;
  $sql_insert_details = "INSERT INTO ItemDetailMaster(ItemId,SizeId,PackingTypeId,PackingQty,SubPacking) VALUES($item_id,$ItemSizeId,$PackingTypeId,$packingQty,$packingSubQty)";
  if(mysqli_query($con,$sql_insert_details)){
    $i++;
    $itemDetailId = mysqli_insert_id($con);
    $sql_insert_PStock = "INSERT INTO ProductStock(itemdetailId,companyId,Quantity,TotalQty,ReorderLabel) VALUES($itemDetailId,$companyId,$ItemQty,$totalQty,$ItemReorderLabel)";
     mysqli_query($con,$sql_insert_PStock) or die(mysqli_error($con));
     $check_company_id = "SELECT CompanyId FROM CompanyMaster WHERE CompanyId <> $companyId";
    if($result_1 = mysqli_query($con,$check_company_id)){
      if(mysqli_num_rows($result_1)>0){
        while($row = mysqli_fetch_array($result_1)){
          $CompanyId = $row['CompanyId'];
          $sql_insert_PStock = "INSERT INTO ProductStock(itemdetailId,companyId) VALUES($itemDetailId,$CompanyId)";
          mysqli_query($con,$sql_insert_PStock) or die(mysqli_error($con));
        }
      }
    }
    $sql_insert_price = "INSERT INTO ItemPrice(ItemDetailId,price,fromDate) VALUES('$itemDetailId','$ItemPrice','$asondate')";
    if(mysqli_query($con,$sql_insert_price)){
      $i++;
      $sql_insert_tax = "INSERT INTO ItemTax(ItemDetailId,TaxId,fromDate) VALUES($itemDetailId,$ItemTax,'$asondate')";
    if(mysqli_query($con,$sql_insert_tax) ){
      $i++;
      $sql_insert_supplier = "INSERT INTO SuplierItem(PersonId,ItemId) VALUES($SupplierId,$item_id)";
      if(mysqli_query($con,$sql_insert_supplier)){
        $i++;
      }
    }
    } 
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
  $totalQty =  $packingQty * $ItemQty;
  
  $sql_update = "UPDATE ItemMaster SET ItemName = '$ItemName',SKU = '$ItemSKU',HSN = '$ItemHSN',Unit = '$ItemUnit',
  CategoryId = $ItemCategory,Description = '$ItemDescription' WHERE ItemId = $ItemId";

  $sql_update_item = "UPDATE ItemDetailMaster SET SizeId = $ItemSizeId,
  PackingTypeId= $PackingTypeId,PackingQty=$packingQty,
   SubPacking=$packingSubQty WHERE ItemId = $ItemId";
  
  $sql_update_stock = "UPDATE ProductStock SET ReorderLabel = $ItemReorderLabel 
  WHERE itemdetailId = '$ItemDetailId' AND companyId = $companyId";

  $update_only_qty_stock = "UPDATE ProductStock SET Quantity = Quantity + $ItemQty,
  TotalQty =  $totalQty
  WHERE Quantity <> $ItemQty AND itemdetailId = '$ItemDetailId' AND companyId = $companyId";

  $sql_update_price = "UPDATE ItemPrice SET price = '$ItemPrice' WHERE ItemDetailId = $ItemDetailId";

  $sql_update_tax = "UPDATE ItemTax SET TaxId = $ItemTax WHERE ItemDetailId = $ItemDetailId";

  $sql_update_supplier = "UPDATE SuplierItem SET PersonId = $SupplierId where ItemId = $ItemId";
  if(mysqli_query($con,$sql_update) or die(mysqli_error($con))){
    mysqli_query($con,$sql_update_item) or die(mysqli_error($con));
    mysqli_query($con,$sql_update_stock) or die(mysqli_error($con));
    mysqli_query($con,$update_only_qty_stock) or die(mysqli_error($con));
    mysqli_query($con,$sql_update_price) or die(mysqli_error($con));
    mysqli_query($con,$sql_update_tax) or die(mysqli_error($con));
    mysqli_query($con,$sql_update_supplier) or die(mysqli_error($con));
    $response['msg'] = 'Inventory '.$ItemName.' Information Updated Successfully';
  }else {
  $response['msg'] = 'Server Error Please Try Again';
  }
}
// function AddProduct($itemDetailId,$companyId){
//   $check_company_id = "SELECT CompanyId FROM CompanyMaster WHERE CompanyId <> $companyId";
//     if($result_1 = mysqli_query($con,$check_company_id)){
//       if(mysqli_num_rows($result_1)>0){
//         while($row = mysqli_fetch_array($result)){
//           $CompanyId = $row['CompanyId'];
//           $sql_insert_PStock = "INSERT INTO ProductStock(itemdetailId,companyId) VALUES($itemDetailId,$CompanyId)";
//           mysqli_query($con,$sql_insert_PStock) or die(mysqli_error($con));
//         }
//       }
//     }
// }
mysqli_close($con);
exit(json_encode($response));
 ?>
