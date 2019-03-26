<?php
include '../config/connection.php';
 session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
// echo $method;

$response =[];
if($method === "POST"){
  $TaxId = $_POST['TaxId'];
  $TaxName = $_POST['TaxName'];
  $TaxDesc = $_POST['TaxDescription'];
  $TaxType = $_POST['TaxType'];
  $TaxPercent = $_POST['TaxPercent'];

  if(!empty($_REQUEST['TaxId'])){
    //update Query
    $sql_update = "UPDATE TaxMaster SET TaxType='$TaxType',TaxPercent='$TaxPercent',TaxName='$TaxName',TaxDescription='$TaxDesc' WHERE TaxId = $TaxId AND companyId = $companyId";
// echo $sql_update;
    if(mysqli_query($con,$sql_update)or die(mysqli_error($con))){
      $response['msg'] = 'New Tax Type '.$TaxType.'has value  '.$TaxPercent.' Updated';
    }else {
      $response['msg'] = 'Server Error Please Try again';
    }

  }else {
    $sql_insert = "INSERT INTO TaxMaster(companyId,TaxType,TaxPercent,TaxName,TaxDescription) VALUES($companyId,'$TaxType','$TaxPercent','$TaxName','$TaxDesc')";
    // echo $sql_insert;
    if(mysqli_query($con,$sql_insert)or die(mysqli_error($con))){
      $response['msg'] = 'New Tax Type '.$TaxType.'has value  '.$TaxPercent.' Added';
    }else {
      $response['msg'] = 'Server Error Please Try again';
    }
  }
// INSERT INTO TaxMaster(companyId,TaxType,TaxPercent,TaxName,TaxDescription) VALUES(3,'Swachh Bharat Cess','20.20','PUCS','PUCS tax entered');
// echo $sql_insert;
  // if(mysqli_query($con,$sql_insert)){
  //   $response['msg'] = 'New Tax Type '.$TaxType.'has value  '.$TaxPercent.' Added';
  // }else {
  //   $response['msg'] = 'Server Error Please Try again';
  // }
}
else{

}
mysqli_close($con);
exit(json_encode($response));
 ?>
