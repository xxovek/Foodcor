<?php
include '../config/connection.php';
session_start();
$companyId   = $_SESSION['company_id'];

$item=$_POST['item'];
$fromDate = $_POST['fromDate'];
$toDate =   $_POST['toDate'];
$Obal =   $_POST['Obal'];

  $sql = "SELECT TD.itemDetailId ,TM.`TransactionId`,TM.TransactionTypeId ,TM.FinancialYear,TM.TransactionNumber,TD.qty,TD.rate,(TD.qty*TD.rate) as Total,TM.DateCreated,PM.FirstName FROM TransactionDetails TD INNER JOIN  TransactionMaster TM ON TM.TransactionId = TD.TransactionId
    LEFT JOIN PersonMaster PM ON TM.PersonId = PM.PersonId WHERE TM.companyId = '$companyId' AND TM.DateCreated BETWEEN '$fromDate' AND '$toDate' AND TD.`itemDetailId`='$item' AND (TM.TransactionTypeId = 2  OR TM.TransactionTypeId = 1)";
$val=$Obal;
$response = [];
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
  if($row['TransactionTypeId']==2)
  {
    $val+=$row['qty'];
    $type='Purchase';
  }
  else if($row['TransactionTypeId']==1)
  {
    $val-=$row['qty'];
    $type='Invoice';
  }
  array_push($response,[
    'Quantity' => $row['qty'],
    'tNo' => $row['FinancialYear'].'-'.$row['TransactionNumber'],
      'type' => $type,
    'Rate' => number_format($row['rate'],2),
      'DateCreated' => $row['DateCreated'],
    'supplierName' => ucfirst($row['FirstName']),
    'stock' => $val,
  ]);
}
 }
 else {
   $response['msg'] = 'There Are No Records Available';
 }
 // echo $sql;
mysqli_close($con);
exit(json_encode($response));
 ?>
