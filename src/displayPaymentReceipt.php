<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$customerid = $_REQUEST['custid'];
$sql = "SELECT TM.TransactionId,PM.FirstName,PM.lastName,TM.DateCreated, COALESCE(TM.DueDate,'-') as DueDate,
CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,SUM(COALESCE(TM.AmountRecieved,0)+TM.RemainingAmount) as TOTAL,TM.RemainingAmount as RemainingAmount
 FROM TransactionMaster TM LEFT JOIN PersonMaster PM ON PM.PersonId = TM.PersonId

 where TM.companyId =$companyId AND TM.TransactionTypeId =1 AND TM.TransactionStatus IN ('Open','Partial') AND TM.PersonId =$customerid
 GROUP BY TM.TransactionId";

$bal = 0;
$status = '-';
$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'InvoiceNumber' => $row['InvoiceNumber'],
        'TId' => $row['TransactionId'],

        'Total' =>   number_format($row['TOTAL'], 2, '.', ''),
        'RemainingAmount' =>  number_format($row['RemainingAmount'], 2, '.', ''),
        'Balance' => $bal,
        'name' => ucwords($row['FirstName'].' '.$row['lastName']),
        'DateCreated' => $row['DateCreated'],
        'status' => $status,
        'DueDate' => $row['DueDate']
      ]);
    }
  }
}


mysqli_close($con);
exit(json_encode($response));
?>
