<?php
function scheme($itemDetailId,$Quantity){
    require_once('config/connection.php');
    $BillQty = $Quantity;
    $curDate = date('Y-m-d');
    $sql = "SELECT OnPurchase,freeQty,FromDate,UptoDate From SchemeMaster WHERE ItemDetailId =$itemDetailId AND '$curDate' BETWEEN (SELECT FromDate FROM SchemeMaster WHERE ItemDetailId =$itemDetailId) AND (SELECT UptoDate FROM SchemeMaster WHERE ItemDetailId =$itemDetailId)";
    $result = mysqli_query($con,$sql) or die(mysqli_error($con));
     if(mysqli_num_rows($result)>0){
         $row = mysqli_fetch_array($result);
         $Qty = floor($Quantity/$row['OnPurchase']);
         $offerQty =  $Qty*$row['freeQty'];
         $BillQty = $Quantity-$offerQty;
   }
  return $BillQty;
}
?>