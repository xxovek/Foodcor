<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$transactionno=$_REQUEST['transactionno'];
// $sql = "SELECT IDM.ItemId, TD.itemDetailId,TD.itemunitval,TD.qty,TD.rate,TD.TaxType,TD.TaxPercent,TD.discountAmount,TD.description,TM.discount,TM.TransactionId,TM.PaytermsId,TM.FinancialYear,TM.TransactionNumber,TM.DueDate,TM.DateCreated,TM.remarks,TM.PersonId,TM.contactId
// FROM TransactionDetails TD
// LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
// LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
// WHERE TM.TransactionId = '$transactionno'";
$sql1 = "SELECT companyId FROM TransactionMaster WHERE TransactionId=$transactionno";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_array($result1);
$currentcompanyId = $row1['companyId'];
$response = [];
if($currentcompanyId===$companyId)
{
  $sql = "SELECT IDM.ItemId, TD.itemDetailId,TD.itemunitval,TM.PersonId,TM.companyId,IDM.PackingQty,IDM.SubPacking,PS.TotalQty,PS.Quantity,
          TD.qty,TD.rate,TD.TaxType,TD.BillQty,TD.TaxPercent,TD.discountAmount,TD.description,
          TM.discount,TM.TransactionId,TM.PaytermsId,TM.FinancialYear,TM.TransactionNumber,
          TM.DueDate,TM.DateCreated,TM.remarks,TM.contactId FROM TransactionDetails TD
          LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
          LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
          LEFT JOIN ProductStock PS ON IDM.itemDetailId = PS.itemDetailId
          WHERE TM.TransactionId = $transactionno and TM.companyId= PS.companyId";
}
else {
  $sql = "SELECT IDM.ItemId,PM.PersonId, TD.itemDetailId,IDM.PackingQty,IDM.SubPacking,PS.TotalQty,PS.Quantity,
          TD.itemunitval,TM.companyId,
          TD.qty,TD.rate,TD.TaxType,TD.BillQty,TD.TaxPercent,TD.discountAmount,TD.description,
          TM.discount,TM.TransactionId,TM.PaytermsId,TM.FinancialYear,TM.TransactionNumber,
          TM.DueDate,TM.DateCreated,TM.remarks,TM.contactId FROM TransactionDetails TD
          LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
          LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
          LEFT JOIN ProductStock PS ON IDM.itemDetailId = PS.itemDetailId
          LEFT JOIN PersonMaster PM ON PM.PersonCompanyId = TM.companyId
          WHERE TM.TransactionId = $transactionno and PM.personTypeId=1 and PM.companyId=$companyId and PM.PersonCompanyId=$currentcompanyId AND PS.companyId =$companyId ";
}

// echo $sql;
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
    // $row = mysqli_fetch_array($result);
      while($row=mysqli_fetch_array($result)){
      array_push($response,[
        'itemDetailId' => $row['itemDetailId'],
        'qty' => $row['qty'],
        'BillQty' => $row['BillQty'],
        'rate' => $row['rate'],
        'itemunitval' => $row['itemunitval'],
        'TaxType' => $row['TaxType'],
        'TaxPercent' => $row['TaxPercent'],
        'itemdiscount' => $row['discountAmount'],
        'description' => $row['description'],
        'TransactionId' => $row['TransactionId'],
        'discount' => $row['discount'],
        'FinancialYear' => $row['FinancialYear'],
        'TransactionNumber' => $row['TransactionNumber'],
        'DateCreated' => $row['DateCreated'],
        'DueDate' => $row['DueDate'],
        'PersonId' => $row['PersonId'],
        'itemid' => $row['ItemId'],
        'remarks' => $row['remarks'],
        'contactId' => $row['contactId'],
        'PaytermsId' => $row['PaytermsId'],
        'PackingQty' => $row['PackingQty'],
        'SubPacking' => $row['SubPacking'],
        'TotalQty' => $row['TotalQty'],
        'PoNumber' => $row['FinancialYear'].'-'.$row['TransactionNumber'],
        'Quantity' => $row['Quantity']
      ]);
    }
  }

mysqli_close($con);
exit(json_encode($response));
?>
