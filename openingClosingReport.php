<?php
include '../config/connection.php';
// session_start();
$fromDate = '2019/02/07';//$_POST['fromdate'];
$toDate = '2019/02/10';//$_POST['uptodate'];
$companyId   = 1;//$_SESSION['companyId'];
$transactionTypePurchase = 2;//for purchase
$transactionTypeInvoice = 1;//for purchase
$response = [];
$sql = "SELECT ID.itemDetailId,ID.ItemId,IM.ItemName FROM ItemDetailMaster ID
LEFT JOIN ItemMaster IM ON IM.ItemId = ID.ItemId WHERE IM.companyId = $companyId";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){

    //Fetch all the items in items table
    $id = $row['itemDetailId'];
    $sql_1 = "SELECT IFNULL(SUM(TD.qty),0) AS OB FROM TransactionDetails TD
    LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
    WHERE TM.DateCreated < '$fromDate' AND TD.itemDetailId = $id
    AND TM.TransactionTypeId = $transactionTypePurchase";
    $result_1 = mysqli_query($con,$sql_1) or die(mysqli_error($con));
    $row1 = mysqli_fetch_array($result_1);


$sql_2 = "SELECT IFNULL(SUM(TD.qty),0) AS PurchaseBal FROM TransactionDetails TD
LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
WHERE TM.DateCreated BETWEEN '$fromDate' AND '$toDate' AND TD.itemDetailId = $id
 AND TM.TransactionTypeId = $transactionTypePurchase";
$result_2 = mysqli_query($con,$sql_2) or die(mysqli_error($con));
$row2 = mysqli_fetch_array($result_2);
 //echo 'Purchase '.$row2['PurchaseBal'].'<br>';

 $sql_3 = "SELECT IFNULL(SUM(TD.qty),0) AS Sale FROM TransactionDetails TD
 LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
 WHERE TM.DateCreated BETWEEN '$fromDate' AND '$toDate' AND TD.itemDetailId = $id
 AND TM.TransactionTypeId = $transactionTypeInvoice";
 $result_3 = mysqli_query($con,$sql_3) or die(mysqli_error($con));
 $row3 = mysqli_fetch_array($result_3);
  //echo 'Sale '.$row3['Sale'].'<br>';
  $closing_bal = ($row1['OB'] + $row2['PurchaseBal'])-$row3['Sale'];
   //echo 'close bal '.$closing_bal.'<br>';

   array_push($response,[
     'ProductName' => $row['ItemName'],
     'OpeningBal' => $row1['OB'],
     'PurchaseBal' => $row2['PurchaseBal'],
     'Sale' => $row3['Sale'],
     'ClosingBal' => $closing_bal
   ]);
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
