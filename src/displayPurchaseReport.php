<?php
include '../config/connection.php';
session_start();
$companyId   = $_SESSION['company_id'];
$transactionTypePurchase = 2;//for purchase

$fromDate = $_POST['fromDate'];
$toDate =   $_POST['toDate'];

if($fromDate === "" && $toDate === ""){
  $sql = "SELECT concat(IM.ItemName,' ',SM.SizeValue,' ',IM.Unit) as productName,IM.Description,TD.qty,TD.rate,(TD.qty*TD.rate) as Total,TM.DateCreated,PM.FirstName FROM TransactionDetails TD LEFT JOIN ItemDetailMaster IDM ON TD.itemDetailId = IDM.itemDetailId
  LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId LEFT JOIN SizeMaster SM ON SM.SizeId = IDM.sizeId LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
  LEFT JOIN PersonMaster PM ON TM.PersonId = PM.PersonId WHERE TM.companyId = $companyId AND TM.TransactionTypeId = $transactionTypePurchase";
}
else{
  $sql = "SELECT concat(IM.ItemName,' ',SM.SizeValue,' ',IM.Unit) as productName,IM.Description,TD.qty,TD.rate,(TD.qty*TD.rate) as Total,TM.DateCreated,PM.FirstName FROM TransactionDetails TD LEFT JOIN ItemDetailMaster IDM ON TD.itemDetailId = IDM.itemDetailId
  LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId LEFT JOIN SizeMaster SM ON SM.SizeId = IDM.sizeId LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
  LEFT JOIN PersonMaster PM ON TM.PersonId = PM.PersonId WHERE TM.companyId = $companyId AND TM.DateCreated BETWEEN '$fromDate' AND '$toDate' AND TM.TransactionTypeId = $transactionTypePurchase";
}

$response = [];
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
  array_push($response,[
    'ProductName' => $row['productName'],
    'Description' => $row['Description'],
    'Quantity' => $row['qty'],
    'Rate' => number_format($row['rate'],2),
    'Total' => number_format($row['Total'],2),
    'DateCreated' => $row['DateCreated'],
    'supplierName' => ucfirst($row['FirstName']),
  ]);
}
 }
 else {
   $response['msg'] = 'There Is No Records Available';
 }
mysqli_close($con);
exit(json_encode($response));
 ?>
