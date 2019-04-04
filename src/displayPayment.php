<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$TransactionType = $_POST['Ttype'];
 $sql = "SELECT TM.TransactionId,PM.FirstName,PM.lastName,DATE_FORMAT(TM.DateCreated,'%d %b %Y') AS DateCreated, 
 COALESCE(DATE_FORMAT(TM.DueDate,'%d %b %Y'),'-') as DueDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
 TM.AmountRecieved AS Balance,TM.TransactionStatus
 FROM TransactionMaster TM 
  LEFT JOIN PersonMaster PM ON PM.PersonId = TM.PersonId
  LEFT JOIN TransactionType TT ON TT.TransactionTypeId =TM.TransactionTypeId
  where TM.companyId = $companyId AND TM.TransactionTypeId = $TransactionType
  GROUP BY TM.TransactionId ORDER BY TM.TransactionId DESC";

$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'InvoiceNumber' => $row['InvoiceNumber'],
        'TId' => $row['TransactionId'],
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
