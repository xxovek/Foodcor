<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$sql = "SELECT PersonMaster.PersonId,UserMaster.emailId,PersonMaster.FirstName,PersonMaster.lastName,ContactMaster.contactNumber FROM UserMaster,PersonMaster,ContactMaster,PersonContact WHERE
 UserMaster.companyId = PersonMaster.companyId AND UserMaster.PersonId = PersonMaster.PersonId AND PersonMaster.personTypeId =4 AND PersonMaster.PersonId = PersonContact.PersonId
  AND PersonContact.ContactId=ContactMaster.contactId AND UserMaster.companyId='$companyId'";
$response = [];

if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'pid' => $row['PersonId'],
        'name' => ucwords($row['FirstName']).' '.$row['lastName'],
        'email' => $row['emailId'],
        'phone' => $row['contactNumber'],
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
  ?>
