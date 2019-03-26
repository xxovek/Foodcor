<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$pId = $_REQUEST['pid'];

$sql = "SELECT TM.TransactionId,TM.DateCreated,TM.TransactionStatus, TT.TransactionType,(SUM(TD.qty*TD.rate*(IFNULL(TD.TaxPercent,0.00000001))*0.01)) as Tax, COALESCE(TM.DueDate,'-') as DueDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
SUM(TD.qty*TD.rate) as TotalBefore,(SUM(TD.qty*TD.rate)+(SUM(TD.qty*TD.rate*(IFNULL(TD.TaxPercent,0.00000001))*0.01))) AS TOTAL
 FROM TransactionMaster TM INNER JOIN TransactionDetails TD ON TD.TransactionId = TM.TransactionId
 LEFT JOIN TransactionType TT ON TT.TransactionTypeId =TM.TransactionTypeId
 where TM.companyId = $companyId AND TM.PersonId = $pId GROUP BY TM.TransactionId,TT.TransactionTypeId";

$bal = 0;
$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      if(empty($row['TransactionStatus']))
        $status = '---';
        else
        $status = $row['TransactionStatus'];

      array_push($response,[
        'InvoiceNumber' => $row['InvoiceNumber'],
        'TId' => $row['TransactionId'],
        'Total' => round($row['TOTAL'],2),
        'Balance' => $bal,
        'DateCreated' => $row['DateCreated'],
        'status' => $status,
        'DueDate' => $row['DueDate'],
        'type' => $row['TransactionType'],
        'totalbefore' => round($row['TotalBefore'],2),
        'tax' => round($row['Tax'],2)

      ]);
    }
  }
}

mysqli_close($con);
exit(json_encode($response));
?>
