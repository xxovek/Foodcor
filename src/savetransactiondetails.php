<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
// $method = $_SERVER['REQUEST_METHOD'];
// if($method == "POST")
// {
  $formid = $_REQUEST['formid'];
  $formtype = $_REQUEST['formtype'];
  $hidetransactionid = $_REQUEST['hidetransactionid'];
  $transactionId = $_REQUEST['transactionId'];
  $itemdetailid = $_REQUEST['itemdetailid'];
  // $desc = $_REQUEST['desc'];

  $qty = $_REQUEST['qty'];
  $billingqty = $_REQUEST['billingqty'];
  $rate = $_REQUEST['rate'];
  $itemdiscount = $_REQUEST['itemdiscount'];
  $itemunits = $_REQUEST['itemunits'];
  $unitsubpackingqty = $_REQUEST['unitsubpackingqty'];
  $unitpackingqty = $_REQUEST['unitpackingqty'];
  $unitremainqty = $_REQUEST['unitremainqty'];
  $hiddenqtyonhand = $_REQUEST['hiddenqtyonhand'];


  $totalqty = 1;
  switch ($itemunits) {
    case 1:
        $totalqty = 1;
        break;
    case 2:
        $totalqty = 1*$unitsubpackingqty;
        break;
    case 3:
        $totalqty = 1*$unitpackingqty;
        break;
    default:
        $totalqty = 1;
      }
  $totalqty = $totalqty*$qty;
  $remaintotqty = $unitremainqty -$totalqty;
  $remqty = floor($hiddenqtyonhand-($remaintotqty/$unitpackingqty));

  $tax = $_REQUEST['tax'];

  $sql = "SELECT TaxType,TaxPercent FROM TaxMaster WHERE companyId=$companyId and TaxPercent='$tax'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $TaxType = $row['TaxType'];
  $TaxPercent = $row['TaxPercent'];

  $sql_insert = "INSERT INTO TransactionDetails( TransactionId, itemDetailId,itemunitval, qty,BillQty,rate,discountAmount, TaxType, TaxPercent)
  VALUES ($transactionId,$itemdetailid,$itemunits,$qty,$billingqty,$rate,$itemdiscount,'$TaxType','$TaxPercent')";
  // echo $sql_insert;
  if(mysqli_query($con,$sql_insert)){
      $item_id = mysqli_insert_id($con);
    $response['msg'] = 'Inserted';
    $response['ItemDetailId'] =  $item_id;
    if($formid==1){
      $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity -$remqty ,ItemDetailMaster.totalqty=ItemDetailMaster.totalqty-$totalqty where ItemDetailMaster.itemDetailId=$itemdetailid";
      // echo $sqlup;
      mysqli_query($con,$sqlup);
    }
    if($formid==2)
    {
      $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity +$remqty ,ItemDetailMaster.totalqty=ItemDetailMaster.totalqty+$totalqty where ItemDetailMaster.itemDetailId=$itemdetailid";
      mysqli_query($con,$sqlup);
    }

  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
// }
mysqli_close($con);
exit(json_encode($response));
 ?>
