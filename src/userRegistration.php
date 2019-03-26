<?php
$response=[];
include '../config/connection.php';
$contactNumber = $_REQUEST['phone'];
$companyName = $_REQUEST['cname'];
$firstName = $_REQUEST['fname'];
$lastName  =$_REQUEST['lname'];
$EmailId   = $_REQUEST['email'];
$upassword = $_REQUEST['pwd'];
$mname = $_REQUEST['mname'];

// echo $contactNumber;
$sql_insert_contact = "INSERT INTO ContactMaster(contactNumber) VALUES('$contactNumber')";
mysqli_query($con, $sql_insert_contact);
$contact_id = mysqli_insert_id($con);

$sql_insert_company = "INSERT INTO CompanyMaster(companyName,contactId) VALUES('$companyName','$contact_id')";
mysqli_query($con, $sql_insert_company);
$company_id = mysqli_insert_id($con);

$sql_insert_person = "INSERT INTO PersonMaster(companyId,FirstName,lastName) VALUES('$company_id','$firstName','$lastName')";
mysqli_query($con, $sql_insert_person);
$person_id = mysqli_insert_id($con);

$sql_insert_user = "INSERT INTO UserMaster(emailId,upassword,companyId,PersonId,flag) VALUES('$EmailId','$upassword','$company_id','$person_id',0)";
$res=mysqli_query($con, $sql_insert_user);
if($res)
$response['true'] = true;
else
$response['false'] = false;

mysqli_close($con);
exit(json_encode($response));
 ?>
