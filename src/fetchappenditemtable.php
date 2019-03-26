<?php
include '../config/connection.php';
$transactionno=$_REQUEST['transactionno'];
$sql = "SELECT IDM.ItemId, TD.itemDetailId,TD.itemunitval,TD.qty,TD.rate,TD.TaxType,TD.TaxPercent,TD.discountAmount,TD.description,TM.discount,TM.TransactionId,TM.PaytermsId,TM.FinancialYear,TM.TransactionNumber,TM.DueDate,TM.DateCreated,TM.remarks,TM.PersonId,TM.contactId
FROM TransactionDetails TD
LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
WHERE TM.TransactionId = '$transactionno'";
$response = [];

$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
    // $row = mysqli_fetch_array($result);
       while($row=mysqli_fetch_array($result)){
      array_push($response,[
        'itemDetailId' => $row['itemDetailId'],
        'qty' => $row['qty'],
        'rate' => $row['rate'],
        'itemunitval' => $row['itemunitval'],
        'TaxType' => $row['TaxType'],
        'TaxPercent' => $row['TaxPercent'],
        'itemdiscount' => $row['discountAmount'],
        'description' => $row['description'],
        'TransactionId' => $row['TransactionId'],
        'discount' => $row['discount'],
        'FinancialYear' => $row['FinancialYear'],
        'TransactionNumber' => $row['TransactionNumber'],
        'DateCreated' => $row['DateCreated'],
        'DueDate' => $row['DueDate'],
        'PersonId' => $row['PersonId'],
        'itemid' => $row['ItemId'],
        'remarks' => $row['remarks'],
        'contactId' => $row['contactId'],
        'PaytermsId' => $row['PaytermsId']
      ]);
    }
  }

mysqli_close($con);
exit(json_encode($response));
?>
