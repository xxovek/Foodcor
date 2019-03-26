<?php
include '../config/connection.php';
$method = $_SERVER['REQUEST_METHOD'];
$response = [];
if($method == "DELETE")
{
parse_str(file_get_contents("php://input"), $_DELETE);
$ItemId = $_DELETE['productId'];
$sql = "DELETE FROM ItemMaster WHERE ItemId = $ItemId";
if(mysqli_query($con,$sql)){
  $response['msg'] = 'Inventory Removed Successfully';
}else {
    $response['msg'] = 'Server Error Please Try Again';
}
}
mysqli_close($con);
exit(json_encode($response));
?>
