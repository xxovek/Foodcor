<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$TransactionType = $_POST['Ttype'];

 $sql = "SELECT TM.TransactionId,PM.FirstName,PM.lastName,DATE_FORMAT(TM.DateCreated,'%d %b %Y') AS DateCreated, COALESCE(DATE_FORMAT(TM.DueDate,'%d %b %Y'),'-') as DueDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
 (SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0.00000001))*0.01))) AS TOTAL,COALESCE(TM.TransactionStatus,'-') AS TransactionStatus,
 (CASE WHEN TM.TransactionStatus = 'Open' THEN COALESCE((SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0.00000000000001))*0.01))),0)
 WHEN TM.TransactionStatus IN('Closed','Paid') THEN 0 WHEN TM.TransactionStatus = 'Partial' THEN TM.RemainingAmount ELSE 0 END) AS Balance
 FROM TransactionMaster TM INNER JOIN TransactionDetails TD ON TD.TransactionId = TM.TransactionId
 LEFT JOIN PersonMaster PM ON PM.PersonId = TM.PersonId
 LEFT JOIN TransactionType TT ON TT.TransactionTypeId =TM.TransactionTypeId
 where TM.companyId = $companyId AND TM.TransactionTypeId =$TransactionType
 GROUP BY TM.TransactionId,TT.TransactionTypeId ORDER BY TM.TransactionId DESC";

$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'InvoiceNumber' => $row['InvoiceNumber'],
        'TId' => $row['TransactionId'],
        'Total' => $row['TOTAL'],
        'Balance' => $row['Balance'],
        'name' => ucwords($row['FirstName'].' '.$row['lastName']),
        'DateCreated' => $row['DateCreated'],
        'status' => $row['TransactionStatus'],
        'DueDate' => $row['DueDate']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
