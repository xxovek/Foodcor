<?php
include '../config/connection.php';
session_start();
// $fromDate = '2019/02/07';//$_POST['fromdate'];
// $toDate = '2019/02/10';//$_POST['uptodate'];
$fromDate = $_POST['fromDate'];
$toDate =   $_POST['toDate'];
$companyId   = $_SESSION['company_id'];

$response = [];
$sql = "SELECT IM.ItemId,IM.itemDetailId,IT.ItemName,COALESCE(q.openingB,0) openingB,COALESCE(p.TotalPurchase,0) TotalPurchase,
COALESCE(s.TotalSold,0) TotalSold,
COALESCE(p.TotalPurchase,0)-COALESCE(s.TotalSold,0) BalanceStock
FROM ItemDetailMaster IM LEFT JOIN ItemMaster IT ON IT.ItemId = IM.ItemId
LEFT JOIN (SELECT TD.itemDetailId,SUM(TD.qty) openingB FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId WHERE TM.TransactionTypeId = 2 AND TM.DateCreated < '$fromDate'
           GROUP BY TD.TransactionId) q ON q.itemDetailId = IM.itemDetailId
LEFT JOIN (SELECT TD.itemDetailId,SUM(TD.qty) TotalSold FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId WHERE TM.TransactionTypeId = 1 AND TM.DateCreated BETWEEN '$fromDate' AND '$toDate'
           GROUP BY TD.TransactionId) s ON s.itemDetailId = IM.itemDetailId
LEFT JOIN (SELECT TD.itemDetailId,SUM(TD.qty) TotalPurchase FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId WHERE TM.TransactionTypeId = 2 AND TM.DateCreated BETWEEN '$fromDate' AND '$toDate'
           GROUP BY TD.TransactionId) p ON p.itemDetailId = IM.itemDetailId
WHERE IT.companyId = $companyId";

if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'ProductName' => $row['ItemName'],
        'OpeningBal' => $row['openingB'],
        'PurchaseBal' => $row['TotalPurchase'],
        'Sale' => $row['TotalSold'],
        'ClosingBal' => $row['BalanceStock']
      ]);
    }
  }
  else {
    $response['msg'] = 'Error while Fetching Details';
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
