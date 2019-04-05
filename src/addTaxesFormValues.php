<?php
include '../config/connection.php';
$method = $_SERVER['REQUEST_METHOD'];
$response =[];
if($method === "POST"){
  $TaxId = $_POST['TaxId'];
  $TaxName = $_POST['TaxName'];
  $TaxDesc = $_POST['TaxDescription'];
  $TaxType = $_POST['TaxType'];
  $TaxPercent = $_POST['TaxPercent'];

  if(!empty($_REQUEST['TaxId'])){
    //update Query
    $sql_update = "UPDATE TaxMaster SET TaxType='$TaxType',TaxPercent='$TaxPercent',TaxName='$TaxName',TaxDescription='$TaxDesc' WHERE TaxId = $TaxId ";
// echo $sql_update;
    if(mysqli_query($con,$sql_update)or die(mysqli_error($con))){
      $response['msg'] = 'New Tax Type '.$TaxType.'has value  '.$TaxPercent.' Updated';
    }else {
      $response['msg'] = 'Server Error Please Try again';
    }
  }else {
    $sql_insert = "INSERT INTO TaxMaster(TaxType,TaxPercent,TaxName,TaxDescription) VALUES('$TaxType','$TaxPercent','$TaxName','$TaxDesc')";
    // echo $sql_insert;
    if(mysqli_query($con,$sql_insert)or die(mysqli_error($con))){
      $response['msg'] = 'New Tax Type '.$TaxType.'has value  '.$TaxPercent.' Added';
    }else {
      $response['msg'] = 'Server Error Please Try again';
    }
  }

}
else{
  $response['msg'] = 'Server Error Please Try again';
}
mysqli_close($con);
exit(json_encode($response));
?>
