<?php
include '../config/connection.php';
session_start();
$person_id= $_SESSION['person_id'];

$fname=$_REQUEST['uname'];
$mname=$_REQUEST['umname'];
$lname=$_REQUEST['ulname'];
$email=$_REQUEST['uemail'];
// $pwd=$_REQUEST['upwd'];

$response=[];

$sql="UPDATE UserMaster,PersonMaster SET UserMaster.emailId='$email',FirstName='$fname',middleName='$mname',lastName='$lname',
PersonMaster.EmailId='$email' WHERE  UserMaster.PersonId=PersonMaster.PersonId AND UserMaster.PersonId='$person_id'";
$result=mysqli_query($con,$sql);
if($result)
$response['true']=true;
else
$response['false']=false;

mysqli_close($con);
exit(json_encode($response));
 ?>
