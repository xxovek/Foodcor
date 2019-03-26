<?php
include '../config/connection.php';
$response = [];
$email     = trim($_REQUEST['uname']);
$upassword = trim($_REQUEST['pwd']);


$sql = "SELECT flag,PersonId,companyId FROM UserMaster WHERE emailId='$email' AND upassword='$upassword'";
$result = mysqli_query($con,$sql) ;
if(mysqli_num_rows($result)==1){
    $response['msg'] = 1;
    $row = mysqli_fetch_array($result);
    session_start();
    $_SESSION['person_id']  = $row['PersonId'];
    $_SESSION['company_id'] = $row['companyId'];
    $_SESSION['company_flag'] = $row['flag'];

    // echo $_SESSION['comapnyId'];
}else{
    $response['msg'] = 0;
}
mysqli_close($con);
exit(json_encode($response));
?>
