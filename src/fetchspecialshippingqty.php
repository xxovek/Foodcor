<?php
include '../config/connection.php';

$response = [];
session_start();
$companyId = $_SESSION['company_id'];

// $itemunits = $_REQUEST['itemunits'];
// $unitsubpackingqty = $_REQUEST['unitsubpackingqty'];
// $unitpackingqty = $_REQUEST['unitpackingqty'];
$itemid = $_REQUEST['itemid'];
$Quantity = $_REQUEST['itemqty'];

$curDate = date('Y-m-d');
$sql = "SELECT OnPurchase,freeQty,FromDate,UptoDate From SchemeMaster WHERE ItemDetailId =$itemid AND '$curDate' BETWEEN (SELECT FromDate FROM SchemeMaster WHERE ItemDetailId =$itemid) AND (SELECT UptoDate FROM SchemeMaster WHERE ItemDetailId =$itemid)";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// echo $sql;
 $response['BillQty'] = 0;
 if(mysqli_num_rows($result)>0){
     $row = mysqli_fetch_array($result);
     // $Qty = floor($Quantity/$row['OnPurchase']);
     // $offerQty =  $Qty*$row['freeQty'];
     // $BillQty = $Quantity-$offerQty;
     $Billper = (($row['freeQty']*100)/($row['OnPurchase']+$row['freeQty']));
     $BillQty = $Quantity - (($Quantity*$Billper)/100);
     $response['BillQty'] = number_format($BillQty,2);
     // echo "IF".$response['BillQty'];
}

mysqli_close($con);
exit(json_encode($response));
?>
