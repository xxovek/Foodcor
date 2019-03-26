<?php
include '../config/connection.php';
 session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $itemname = $_POST['itemname'];
  $itemquantity = $_POST['itemquantity'];

  $ssql_insert = "INSERT INTO ItemMaster(companyId,ItemName) VALUES('$companyId','$itemname')";

  if(mysqli_query($con,$ssql_insert)){
    $id = mysqli_insert_id($con);
    $ssql_insert1 = "INSERT INTO ItemDetailMaster(ItemId,Quantity) VALUES('$id','$itemquantity')";
    mysqli_query($con,$ssql_insert1);

    $response['msg'] = 'Inserted';
  }
  else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
