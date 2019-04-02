<?php
include '../config/connection.php';
session_start();
// $companyId = $_SESSION['company_id'];
$response  = [];
$scheme    = $_POST['scheme'];
$from      = $_POST['from'];
$upto      = $_POST['upto'];
$item      = $_POST['item'];
$onpurchase= $_POST['onpurchase'];
$freeqty   = $_POST['freeqty'];
if(!empty($_REQUEST['sId']))
{
  $sId=$_REQUEST['sId'];
  $sql_insert = "UPDATE SchemeMaster SET schemeType='$scheme',FromDate='$from',UptoDate='$upto',ItemDetailId='$item',OnPurchase='$onpurchase'
  ,freeQty='$freeqty'  WHERE SchemeId=$sId";
   if(mysqli_query($con,$sql_insert)){
     $response['msg'] = 'Scheme '.$scheme.' Updated Successfully';
   }else {
     $response['msg'] = 'Server Error Please Try again';
   }
}
else {
    $sql_insert = "INSERT INTO SchemeMaster(schemeType,FromDate,UptoDate,ItemDetailId,OnPurchase,freeQty)
     VALUES('$scheme','$from','$upto','$item','$onpurchase','$freeqty')";
     if(mysqli_query($con,$sql_insert)){
       $response['msg'] = ' New  '.$scheme.' Scheme Added Successfully';
     }else {
       $response['msg'] = 'Server Error Please Try again';
     }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
