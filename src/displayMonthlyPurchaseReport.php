<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$MonthDate = $_REQUEST['month'];
$TransactionType = $_REQUEST['TransactionType'];

$sql = "SELECT TM.TransactionId as Tid,COALESCE(DATE_FORMAT(TM.DateCreated,'%d %b %Y'),'-') as InvDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
TT.TransactionType,TM.TransactionNumber as TransactionNumber,TM.TransactionTypeId,CONCAT(PM.FirstName,' ',PM.lastName) as personName, COALESCE(DATE_FORMAT(TM.DueDate,'%d %b %Y'),'-') as dueDate,
COALESCE(SUM(TD.BillQty*TD.rate),0) AS TotalBeforeTax,COALESCE((SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0))*0.01)),0) AS TotalGST,COALESCE((SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0))*0.01)/2),0) AS CGST,COALESCE((SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0))*0.01)/2),0) AS SGST,
COALESCE((SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0.00000000000001))*0.01))),0)  AS Total,COALESCE(TM.TransactionStatus,'-') AS TransactionStatus
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
        'TotalGST' => $row['TotalGST'],
        'CGST' => $row['CGST'],
        'SGST' => $row['SGST'],
        'Total' => $row['Total'],
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
