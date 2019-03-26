<?php
include '../config/connection.php';
session_start();
$person_id= $_SESSION['person_id'];
$response = [];

$sql = "SELECT  PersonMaster.FirstName,PersonMaster.middleName,PersonMaster.lastName,UserMaster.emailId,UserMaster.upassword FROM PersonMaster,
UserMaster WHERE  UserMaster.PersonId=PersonMaster.PersonId AND UserMaster.PersonId='$person_id'";


if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $response['uemail'] =ucwords($row['emailId']);
    $response['upwd'] =$row['upassword'];
    $response['ufname'] =ucwords($row['FirstName']);
    $response['umname'] =ucwords($row['middleName']);
    $response['ulname'] =ucwords($row['lastName']);

  }
}
mysqli_close($con);
exit(json_encode($response));
?>
