<?php
include '../config/connection.php';
$invoice_number = $_REQUEST['tid'];
// $sql = "SELECT IDM.ItemId,IM.ItemName,TD.rate, TD.itemDetailId,TD.qty,TD.TaxType,TD.TaxPercent,TM.discount,TD.description,TM.TransactionId,TM.FinancialYear,TM.TransactionNumber,TM.DueDate,TM.DateCreated,TM.PersonId,TM.contactId
// FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
// LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
// LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId
// WHERE TM.TransactionId =  $invoice_number";
// $sql="SELECT IDM.ItemId,IM.ItemName,SM.SizeValue,IM.Unit,TD.rate,
// TD.itemDetailId,TD.qty,TD.BillQty,TD.TaxType,TD.TaxPercent,TM.discount,
// IFNULL(TD.discountAmount,0) as discountAmount,TD.description,TM.TransactionId,TM.FinancialYear,TM.TransactionNumber,TM.DueDate,TM.DateCreated,TM.PersonId,TM.contactId
//  FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
// LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
// LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId
// LEFT JOIN   SizeMaster SM ON SM.SizeId = IDM.sizeId
// WHERE  TM.TransactionId =  $invoice_number";
$sql="SELECT IDM.ItemId,IM.ItemName,SM.SizeValue,IM.Unit,TD.rate,(CASE WHEN TD.itemunitval = 1 THEN (TD.BillQty*TD.rate) WHEN TD.itemunitval=2
THEN (IDM.SubPacking*TD.BillQty*TD.rate) WHEN TD.itemunitval=3 THEN (IDM.PackingQty*TD.BillQty*TD.rate) ELSE TD.BillQty*TD.rate END) AS BillingQty, TD.itemDetailId,TD.itemunitval,TD.qty,TD.BillQty,TD.TaxType,TD.TaxPercent,TM.discount,IFNULL(TD.discountAmount,0) as discountAmount,TD.description,TM.TransactionId,TM.FinancialYear,TM.TransactionNumber,TM.DueDate,TM.DateCreated,TM.PersonId,TM.contactId
FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId
LEFT JOIN   SizeMaster SM ON SM.SizeId = IDM.sizeId WHERE  TM.TransactionId = $invoice_number";
$response = [];

$amt=0;
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result))
    {
      $total=($row['BillQty']*$row['rate'])-(($row['BillQty']*$row['rate'])*(($row['discountAmount']/100)));
      if($row['TaxType']=='GST')

    array_push($response,[
        'iname' => $row['ItemName'].' '.$row['SizeValue'].' '.$row['Unit'],
          'itemunitval' => $row['itemunitval'],
        'qty' => $row['qty'],
        'BillQty' => $row['BillQty'],
        'rate' => $row['rate'],
        'total' => $total,
        'tax' => $row['TaxPercent'].'% '.$row['TaxType'],
        'amt' =>round($row['BillingQty'],2),
        'name' =>$row['TaxType'],
        'discount' =>$row['discount'],
        'discountAmount' =>$row['discountAmount'],
        'taxpercent' =>$row['TaxPercent'],
        'TransactionId'=>$row['TransactionId']
        ]);
  }
}
}

mysqli_close($con);
exit(json_encode($response));
?>
