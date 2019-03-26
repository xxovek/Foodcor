<?php
include '../config/connection.php';
$method = $_SERVER['REQUEST_METHOD'];
$response = [];
$formid = $_REQUEST['formid'];
$transactionId = $_REQUEST['transactionId'];
$getitem ="SELECT IDM.ItemId, TD.itemDetailId,TD.qty,TM.TransactionId,TM.TransactionNumber FROM TransactionDetails TD
           LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
           LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
           WHERE TM.TransactionId = '$transactionId'";
$resultgetitem = mysqli_query($con,$getitem);
if(mysqli_num_rows($resultgetitem)>0){
       while($row=mysqli_fetch_array($resultgetitem))
       {

         $itemidno = $row['ItemId'];
         $quantityval = $row['qty'];
           if($formid==1){
             $sqlup = "UPDATE ItemDetailMaster SET Quantity = Quantity + $quantityval where ItemId=$itemidno";
             // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity -$qty where ItemDetailMaster.itemDetailId=$itemdetailid";
             mysqli_query($con,$sqlup);
             // echo $sqlup."</br>";
           }
           if($formid==2)
           {
             $sqlup = "UPDATE ItemDetailMaster SET Quantity = Quantity - $quantityval where ItemId=$itemidno";
             // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity +$qty where ItemDetailMaster.itemDetailId=$itemdetailid";
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
