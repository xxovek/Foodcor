<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$method = $_SERVER['REQUEST_METHOD'];
$response = [];
if($method == "DELETE")
{
parse_str(file_get_contents("php://input"), $_DELETE);
$sId = $_DELETE['sId'];
$sql = "DELETE FROM SchemeMaster WHERE SchemeId = $sId and companyId = $companyId";
// echo $sql;

if(mysqli_query($con,$sql)){
  $response['msg'] = 'Scheme Removed Successfully';
}else {
    $response['msg'] = 'Server Error Please Try Again';
}
}
mysqli_close($con);
exit(json_encode($response));
?>
