<?php
  include '../config/connection.php';
  session_start();
  $companyId = $_SESSION['company_id'];
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

  $sql1= "SELECT PS.Quantity,PS.TotalQty FROM ProductStock PS WHERE PS.itemdetailId=$itemdetailid  and PS.companyId=$companyId";
  $result1 = mysqli_query($con,$sql1);
  $row1= mysqli_fetch_array($result1);
  $Quantity = $row1['Quantity'];
  $TotalQty1 = $row1['TotalQty'];
  // echo $sql1;
  $totalqty = 1;
  switch ($itemunits) {
    case 1:
        $totalqty = $qty;
        break;
    case 2:
        $totalqty = $qty*$unitsubpackingqty;
        break;
    case 3:
        $totalqty = $qty*$unitpackingqty;
        break;
    default:
        $totalqty = $qty;
      }
  // echo "The Total Quantity".$totalqty."\n";
  // $totalqty = $totalqty*$qty;
  // $remaintotqty = $unitremainqty -$totalqty;
  // $remqty = floor($hiddenqtyonhand-($remaintotqty/$unitpackingqty));

  $tax = $_REQUEST['tax'];

  $sql = "SELECT TaxType,TaxPercent FROM TaxMaster WHERE  TaxPercent='$tax'";
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
      if($formtype==="U"){
        if($formid==1){
          $setqty  = ($TotalQty1-$totalqty)/$unitpackingqty;
          // echo $setqty;
          $sqlup ="UPDATE ProductStock SET  ProductStock.Quantity=$setqty,ProductStock.TotalQty=ProductStock.TotalQty-$totalqty WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
          // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity -$remqty ,ItemDetailMaster.totalqty=ItemDetailMaster.totalqty-$totalqty where ItemDetailMaster.itemDetailId=$itemdetailid";
          // echo $sqlup;
           mysqli_query($con,$sqlup);
        }
        if($formid==2)
        {
          // echo "TotalQty ".$totalqty."\n";
          // echo "TotalQty1 ".$TotalQty1."\n";
          $setqty  = ($TotalQty1+$totalqty)/$unitpackingqty;
          // echo "SETQty ".$setqty."\n";
           $sqlup ="UPDATE ProductStock SET  ProductStock.Quantity=$setqty,ProductStock.TotalQty=ProductStock.TotalQty+$totalqty WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
          // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity +$remqty ,ItemDetailMaster.totalqty=ItemDetailMaster.totalqty+$totalqty where ItemDetailMaster.itemDetailId=$itemdetailid";
          // echo $sqlup."\n";
          mysqli_query($con,$sqlup);
        }
      }
      else{


    if($formid==1){
        $setqty  = ($TotalQty1-$totalqty)/$unitpackingqty;
        $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=$setqty,ProductStock.TotalQty=ProductStock.TotalQty-$totalqty WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";

      // $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity-$remqty,ProductStock.TotalQty=ProductStock.TotalQty-$totalqty WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
      // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity -$remqty ,ItemDetailMaster.totalqty=ItemDetailMaster.totalqty-$totalqty where ItemDetailMaster.itemDetailId=$itemdetailid";
      // echo $sqlup;
      mysqli_query($con,$sqlup);
    }
    if($formid==2)
    {
        $setqty  = ($TotalQty1+$totalqty)/$unitpackingqty;
        $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=$setqty,ProductStock.TotalQty=ProductStock.TotalQty+$totalqty WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";

      // $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity+$remqty,ProductStock.TotalQty=ProductStock.TotalQty+$totalqty WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
      // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity +$remqty ,ItemDetailMaster.totalqty=ItemDetailMaster.totalqty+$totalqty where ItemDetailMaster.itemDetailId=$itemdetailid";
      mysqli_query($con,$sqlup);
    }
  }

  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
// }
mysqli_close($con);
exit(json_encode($response));
 ?>
