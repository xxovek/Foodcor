<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$aId = $_REQUEST['aid'];

$sql = "SELECT TT.TransactionType,TM.TransactionId,PM.FirstName,PM.lastName,TM.DateCreated, COALESCE(TM.DueDate,'-') as DueDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
(SUM(TD.qty*TD.rate)+(SUM(TD.qty*TD.rate*(IFNULL(TD.TaxPercent,0.00000001))*0.01))) AS TOTAL
 FROM TransactionMaster TM INNER JOIN TransactionDetails TD ON TD.TransactionId = TM.TransactionId
 LEFT JOIN PersonMaster PM ON PM.PersonId = TM.PersonId
 LEFT JOIN TransactionType TT ON TT.TransactionTypeId =TM.TransactionTypeId
 where TM.companyId =$companyId  AND TM.`AccountId` =$aId
 GROUP BY TM.TransactionId,TT.TransactionTypeId";
// echo $sql;
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'DateCreated' => $row['DateCreated'],
        'InvoiceNumber' => $row['InvoiceNumber'].'<br>'.$row['TransactionType'],
        'payee' =>$row['FirstName'].' '.$row['lastName'],
        'TOTAL' => round($row['TOTAL'],2),
        'DueDate' => $row['DueDate']
      ]);
    }
    }
  }
  // print_r($response);
mysqli_close($con);
exit(json_encode($response));
  ?>
