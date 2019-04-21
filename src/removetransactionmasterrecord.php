<?php
include '../config/connection.php';
session_start();
  $companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
$response = [];
$formid = $_REQUEST['formid'];
$transactionId = $_REQUEST['transactionId'];
$getitem ="SELECT IDM.ItemId, TD.itemDetailId,TD.qty,TD.itemunitval,TM.TransactionId,TM.TransactionNumber,IDM.PackingQty,IDM.SubPacking,PS.Quantity,PS.TotalQty FROM TransactionDetails TD
           LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
           LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
           LEFT JOIN ProductStock PS ON IDM.itemDetailId = PS.itemDetailId
           WHERE TM.TransactionId = '$transactionId' and TM.companyId=PS.companyId";
$resultgetitem = mysqli_query($con,$getitem);
if(mysqli_num_rows($resultgetitem)>0){
       while($row=mysqli_fetch_array($resultgetitem))
       {
         $itemdetailid = $row['itemDetailId'];
         $itemidno = $row['ItemId'];
         $quantityval = $row['qty'];
         $itemunitval = $row['itemunitval'];
         $PackingQty = $row['PackingQty'];
         $SubPacking = $row['SubPacking'];
         $Quantity = $row['Quantity'];
         $TotalQty1 = $row['TotalQty'];
         $totalqty = 1;

         switch ($itemunitval) {
           case 1:
               $totalqty = $quantityval;
               break;
           case 2:
               $totalqty = $quantityval*$SubPacking;
               break;
           case 3:
               $totalqty = $quantityval*$PackingQty;
               break;
           default:
               $totalqty = $quantityval;
             }
           if($formid==1){
             $setqty  = ($TotalQty1+$totalqty)/$PackingQty;
             $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=$setqty,ProductStock.TotalQty=ProductStock.TotalQty+$totalqty  WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";

             // $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity+$quantityval WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
             mysqli_query($con,$sqlup);
             // echo $sqlup."</br>";
           }
           if($formid==2)
           {
             $setqty  = ($TotalQty1-$totalqty)/$PackingQty;
             $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=$setqty,ProductStock.TotalQty=ProductStock.TotalQty-$totalqty  WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";

             // $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity-$quantityval WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
             mysqli_query($con,$sqlup);
             // echo $sqlup."</br>";
           }
       }
}
$deltrans = "DELETE FROM TransactionMaster WHERE TransactionId=$transactionId";
mysqli_query($con,$deltrans);

mysqli_close($con);
exit(json_encode($response));
?>
