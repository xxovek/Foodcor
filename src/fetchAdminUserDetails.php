<?php
include '../config/connection.php';
session_start();
$person_id= $_REQUEST['pid'];
$companyId = $_SESSION['company_id'];

$response = [];

$sql = "SELECT UserMaster.emailId,PersonMaster.FirstName,PersonMaster.middleName,PersonMaster.lastName,ContactMaster.contactNumber FROM UserMaster,PersonMaster,ContactMaster,
PersonContact WHERE UserMaster.companyId = PersonMaster.companyId AND UserMaster.PersonId = PersonMaster.PersonId AND PersonMaster.personTypeId =4 AND
PersonMaster.PersonId = PersonContact.PersonId AND PersonContact.ContactId=ContactMaster.contactId AND UserMaster.companyId='$companyId' AND UserMaster.PersonId='$person_id'";

if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $response['uemail'] =ucwords($row['emailId']);
    $response['ufname'] =ucwords($row['FirstName']);
    $response['umname'] =ucwords($row['middleName']);
    $response['ulname'] =ucwords($row['lastName']);
    $response['ucontactno'] =ucwords($row['contactNumber']);
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
