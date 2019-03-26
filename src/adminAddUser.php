<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$person_id= $_SESSION['person_id'];

$response=[];
$adminuname = $_REQUEST['adminuname'];
$adminumname = $_REQUEST['adminumname'];
$adminulname = $_REQUEST['adminulname'];
$adminuemail = $_REQUEST['adminuemail'];
$usercontactno = $_REQUEST['usercontactno'];

if(empty($_REQUEST['adminuserid']))
{
$sql_insert_usercontact = "INSERT INTO ContactMaster(contactNumber) VALUES('$usercontactno')";
mysqli_query($con, $sql_insert_usercontact) or die(mysqli_error($con));
$contact_id = mysqli_insert_id($con);

$sql_insert_addperson = "INSERT INTO PersonMaster(companyId,personTypeId,FirstName,middleName,lastName) VALUES('$companyId',4,'$adminuname','$adminumname','$adminulname')";
mysqli_query($con, $sql_insert_addperson) or die(mysqli_error($con));
$person_id = mysqli_insert_id($con);


$sql_insert_personcontact="INSERT into PersonContact (ContactId,PersonId) values('$contact_id','$person_id')";
mysqli_query($con,$sql_insert_personcontact) or die(mysqli_error($con));

$sql_insert_user = "INSERT INTO UserMaster(emailId,upassword,companyId,PersonId,flag) VALUES('$adminuemail','12345','$companyId','$person_id',1)";
$res=mysqli_query($con, $sql_insert_user) or die(mysqli_error($con));
}
else
{
  $newuser = $_REQUEST['adminuserid'];
$sql_update_adminusers="UPDATE UserMaster um,PersonMaster pm,ContactMaster cm,PersonContact pc SET um.emailId='$adminuemail',pm.FirstName='$adminuname',
pm.middleName='$adminumname',pm.lastName='$adminulname',cm.contactNumber='$usercontactno' WHERE um.companyId = pm.companyId AND um.PersonId = pm.PersonId AND pm.personTypeId =4 AND
pm.PersonId = pc.PersonId AND pc.ContactId=cm.contactId AND um.companyId='$companyId' AND pm.PersonId='$newuser'";
$res=mysqli_query($con,$sql_update_adminusers) or die(mysqli_error($con));
}

if($res)
$response['true'] = true;
else
$response['false'] = false;

mysqli_close($con);
exit(json_encode($response));


 ?>
