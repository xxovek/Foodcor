<?php
include '../config/connection.php';

// session_start();
$invoice_number = $_REQUEST['tid'];
$sql = "SELECT * FROM `TransactionMaster` WHERE TransactionId=$invoice_number";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    array_push($response,[
        'f_year' => $row['FinancialYear'],
        'invoiceNo' => $row['TransactionNumber'],
        'discount' => $row['discount'],
        'dateFrom' => date('M d, Y', strtotime($row['DateCreated'])),
        'dateDue' => date('M d, Y', strtotime($row['DueDate'])),
        'note' => $row['remarks']

        ]);
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
