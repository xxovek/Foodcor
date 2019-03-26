<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];

$sql = "SELECT TM.TransactionId as Tid,COALESCE(DATE_FORMAT(TM.DateCreated,'%d %b %Y'),'-') as InvDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
TT.TransactionType,TM.TransactionNumber as TransactionNumber,TM.TransactionTypeId,CONCAT(PM.FirstName,' ',PM.lastName) as personName, COALESCE(DATE_FORMAT(TM.DueDate,'%d %b %Y'),'-') as dueDate,
COALESCE(SUM(TD.BillQty*TD.rate),0) AS TotalBeforeTax,COALESCE((SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0))*0.01)),0) AS Tax,
(CASE WHEN TM.TransactionTypeId = 3 THEN TM.AmountRecieved ELSE
COALESCE((SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0.00000000000001))*0.01))),0) END) AS Total,COALESCE(TM.TransactionStatus,'-') AS TransactionStatus,
(CASE WHEN TM.TransactionStatus = 'Open' THEN COALESCE((SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0.00000000000001))*0.01))),0)
 WHEN TM.TransactionStatus IN('Closed','Paid') THEN 0 WHEN TM.TransactionStatus = 'Partial' THEN TM.RemainingAmount  WHEN TM.TransactionStatus = 'Unapplied' THEN TM.AmountRecieved ELSE 0 END) AS Balance
FROM TransactionMaster TM LEFT JOIN TransactionDetails TD ON TD.TransactionId = TM.TransactionId
LEFT JOIN PersonMaster PM ON PM.PersonId = TM.PersonId
LEFT JOIN TransactionType TT ON TT.TransactionTypeId = TM.TransactionTypeId
WHERE TM.companyId = $companyId GROUP BY TM.TransactionId,TT.TransactionTypeId ORDER BY TM.TransactionId DESC";

$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'InvoiceNumber'=> $row['InvoiceNumber'],
        'TId' => $row['Tid'],
        'tranType' => $row['TransactionType'],
        'TransactionTypeId' =>$row['TransactionTypeId'],
        'TranNo' => $row['TransactionNumber'],
        'TotalBeforeTax' => number_format($row['TotalBeforeTax'],2),
        'Tax' => number_format($row['Tax'],2),
        'Total' => number_format($row['Total'],2),
        'name' => ucwords($row['personName']),
        'DateCreated' => $row['InvDate'],
        'DueDate' => $row['dueDate'],
          'status' => $row['TransactionStatus'],
        'Balance' => $row['Balance']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
