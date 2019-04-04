<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$TransactionType = $_POST['Ttype'];

 // $sql = "SELECT TM.TransactionId,TM.companyId,CM.companyName,UM.emailId,DATE_FORMAT(TM.DateCreated,'%d %b %Y') AS DateCreated, COALESCE(DATE_FORMAT(TM.DueDate,'%d %b %Y'),'-') as DueDate,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
 // (SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0.00000001))*0.01))) AS TOTAL,COALESCE(TM.TransactionStatus,'-') AS TransactionStatus,
 // (CASE WHEN TM.TransactionStatus = 'Open' THEN COALESCE((SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate*(IFNULL(TD.TaxPercent,0.00000000000001))*0.01))),0)
 // WHEN TM.TransactionStatus IN('Closed','Paid') THEN 0 WHEN TM.TransactionStatus = 'Partial' THEN TM.RemainingAmount ELSE 0 END) AS Balance
 // FROM TransactionMaster TM INNER JOIN TransactionDetails TD ON TD.TransactionId = TM.TransactionId
 // LEFT JOIN CompanyMaster CM ON CM.CompanyId = TM.companyId
 // LEFT JOIN UserMaster UM ON UM.companyId = TM.companyId
 // LEFT JOIN TransactionType TT ON TT.TransactionTypeId =TM.TransactionTypeId
 // where TM.personCompanyId = $companyId AND TM.TransactionTypeId = $TransactionType AND changeStatusFlag = 0
 // GROUP BY TM.TransactionId,TT.TransactionTypeId ORDER BY TM.TransactionId DESC";


 $sql = "SELECT TM.TransactionId,TM.companyId,CM.companyName,UM.emailId,PM.FirstName,PM.lastName,DATE_FORMAT(TM.DateCreated,'%d %b %Y') AS DateCreated, COALESCE(DATE_FORMAT(TM.DueDate,'%d %b %Y'),'-') as DueDate
 ,CONCAT(TM.FinancialYear,'-',TM.TransactionNumber) as InvoiceNumber,
 SUM(TD.BillQty*TD.rate*
 (CASE WHEN TD.itemunitval =1 THEN 1
  WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  ELSE 1 END))+SUM(TD.BillQty*TD.rate*
 (CASE WHEN TD.itemunitval =1 THEN 1
 WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
 WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  ELSE 1 END)*TD.TaxPercent/100) AS TOTAL,
  COALESCE(TM.TransactionStatus,'-') AS TransactionStatus,
 (CASE WHEN TM.TransactionStatus = 'Open' THEN COALESCE( SUM(TD.BillQty*TD.rate*
  (CASE WHEN TD.itemunitval =1 THEN 1
   WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
   WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
   ELSE 1 END))+SUM(TD.BillQty*TD.rate*
  (CASE WHEN TD.itemunitval =1 THEN 1
  WHEN TD.itemunitval=2 THEN (SELECT IDM.SubPacking FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
  WHEN TD.itemunitval=3 THEN (SELECT IDM.PackingQty FROM ItemDetailMaster IDM where IDM.itemDetailId = TD.itemDetailId)
   ELSE 1 END)*TD.TaxPercent/100),0)
 WHEN TM.TransactionStatus IN('Closed','Paid') THEN 0 WHEN TM.TransactionStatus = 'Partial' THEN TM.RemainingAmount ELSE 0 END) AS Balance
 FROM TransactionMaster TM INNER JOIN TransactionDetails TD ON TD.TransactionId = TM.TransactionId
 LEFT JOIN PersonMaster PM ON PM.PersonId = TM.PersonId
 LEFT JOIN CompanyMaster CM ON CM.CompanyId = TM.companyId
 LEFT JOIN UserMaster UM ON UM.companyId = TM.companyId
 LEFT JOIN TransactionType TT ON TT.TransactionTypeId =TM.TransactionTypeId
 where TM.personCompanyId = $companyId AND TM.TransactionTypeId =$TransactionType and TM.changeStatusFlag = 0
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
        'name' => ucwords($row['companyName']),
        'DateCreated' => $row['DateCreated'],
        'status' => $row['TransactionStatus'],
        'DueDate' => $row['DueDate'],
        'companyId' => $row['companyId'],
        'emailId' => $row['emailId']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
