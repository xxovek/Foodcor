<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$MonthDate = $_REQUEST['month'];
$TransactionType = $_REQUEST['TransactionType'];

$sql = "SELECT TM.TransactionId as Tid,COALESCE(DATE_FORMAT(TM.DateCreated,'%d %b %Y'),'-') as InvDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
TT.TransactionType,TM.TransactionNumber as TransactionNumber,TM.TransactionTypeId,CONCAT(PM.FirstName,' ',PM.lastName) as personName, COALESCE(DATE_FORMAT(TM.DueDate,'%d %b %Y'),'-') as dueDate,COALESCE(TM.TransactionStatus,'-') AS TransactionStatus,
SUM(TD.BillQty*TD.rate*
 (CASE WHEN TD.itemunitval =1 THEN 1
  WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  ELSE 1 END))+SUM(TD.BillQty*TD.rate*
 (CASE WHEN TD.itemunitval =1 THEN 1
 WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  ELSE 1 END)*TD.TaxPercent/100) AS Total,
  SUM(TD.BillQty*TD.rate*
 (CASE WHEN TD.itemunitval =1 THEN 1
 WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  ELSE 1 END)) AS TotalBeforeTax
FROM TransactionMaster TM LEFT JOIN TransactionDetails TD ON TD.TransactionId = TM.TransactionId
LEFT JOIN PersonMaster PM ON PM.PersonId = TM.PersonId
LEFT JOIN TransactionType TT ON TT.TransactionTypeId = TM.TransactionTypeId
WHERE TM.companyId =$companyId AND DATE_FORMAT(TM.DateCreated,'%Y-%m') = '$MonthDate' AND TM.TransactionTypeId = $TransactionType GROUP BY TM.TransactionId ORDER BY TM.TransactionId DESC";

$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'InvoiceNumber'=> $row['InvoiceNumber'],
        'TranNo' => $row['TransactionNumber'],
        'TotalBeforeTax' => $row['TotalBeforeTax'],
        'Total' => $row['Total'],
        'TotalGST' => $row['Total']-$row['TotalBeforeTax'],
        'CGST' => ($row['Total']-$row['TotalBeforeTax'])/2,
        'SGST' => ($row['Total']-$row['TotalBeforeTax'])/2,
        'name' => ucwords($row['personName']),
        'DateCreated' => $row['InvDate'],
        'status' => $row['TransactionStatus']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
