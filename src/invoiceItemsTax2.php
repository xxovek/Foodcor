<?php
include '../config/connection.php';
$Tid = $_REQUEST['TransactionId'];
$response = [];
// $sql = "SELECT TD.TransactionId,TD.TaxType,TD.TaxPercent,TD.TaxPercent/2 AS IGST,SUM(TD.BillQty*TD.rate) AS Total_before_tax,
// ((SUM(TD.BillQty*TD.rate)*TD.TaxPercent)/100)/2 AS Tax,SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate)*TD.TaxPercent)/100 AS Total_after_tax
// FROM TransactionDetails TD WHERE TD.TransactionId = $Tid GROUP BY TD.TaxPercent,TD.TransactionId";

$sql = "SELECT TD.TransactionId,TD.TaxType,TD.TaxPercent,TD.TaxPercent/2 AS IGST,
SUM(TD.BillQty*TD.rate*
(CASE WHEN TD.itemunitval =1 THEN 1
 WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 ELSE 1 END)) as Total_before_tax ,
SUM(TD.BillQty*TD.rate*
(CASE WHEN TD.itemunitval =1 THEN 1
WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 ELSE 1 END)*TD.TaxPercent/100)/2 as Tax,
SUM(TD.BillQty*TD.rate*
(CASE WHEN TD.itemunitval =1 THEN 1
 WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 ELSE 1 END))+SUM(TD.BillQty*TD.rate*
(CASE WHEN TD.itemunitval =1 THEN 1
WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 ELSE 1 END)*TD.TaxPercent/100) AS Total_after_tax
FROM TransactionDetails TD WHERE TD.TransactionId = $Tid GROUP BY TD.TaxPercent,TD.TransactionId";

$result = mysqli_query($con,$sql);
$subtotal = 0;
$finalTotal = 0;
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    $subtotal +=$row['Total_before_tax'];
    $finalTotal +=$row['Total_after_tax'];
    array_push($response,[
      'GST' => $row['IGST'],
      'Total_before_tax' => number_format($row['Total_before_tax'],2),
      'Tax' => number_format($row['Tax'],2),
      'FinalTotal' => number_format($finalTotal,2)
    ]);
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
