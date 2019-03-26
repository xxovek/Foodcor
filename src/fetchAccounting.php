<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];

$sql = "SELECT TM.AccountId,AM.subCategory,AM.mainCategory,IFNULL(SUM(TD.TaxPercent),0) as TAX, IFNULL(SUM(TD.qty*TD.rate),0)
as BALANCE FROM AccountMaster AM LEFT JOIN TransactionMaster TM
 ON AM.AccountId=TM.AccountId LEFT JOIN TransactionDetails TD ON TM.TransactionId=TD.TransactionId AND
TM.companyId =$companyId GROUP BY AM.`AccountId`";
// echo $sql;
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      if(!empty($row['AccountId']))
      {
      array_push($response,[
        'aid' => $row['AccountId'],
        'subCategory' => $row['subCategory'],
        'mainCategory' =>$row['mainCategory'],
        'TAX' => round($row['TAX'],2),
        'BALANCE' => round($row['BALANCE'],2)
      ]);
    }
    }
  }
}
  // print_r($response);
mysqli_close($con);
exit(json_encode($response));
  ?>
