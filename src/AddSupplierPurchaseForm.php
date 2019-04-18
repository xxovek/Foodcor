<?php
include '../config/connection.php';
session_start();
$companyId       = $_SESSION['company_id'];
$PersonCompanyId = $_REQUEST['companyId'];
$EmailId         = $_REQUEST['EmailId'];

$check_sql = "SELECT PM.FirstName,PM.lastName,PM.middleName,PM.EmailId,CM.companyName,COM.AddressId,COM.contactAddress,
COM.contactNumber,COM.country,COM.CState,COM.city,COM.zipcode FROM PersonMaster PM 
LEFT JOIN CompanyMaster CM ON PM.companyId = CM.CompanyId
LEFT JOIN ContactMaster COM ON COM.contactId = CM.contactId WHERE PM.companyId = $PersonCompanyId AND PM.EmailId = '$EmailId'";

if($result = mysqli_query($con,$check_sql) or die(mysqli_error('1'))){
    $row = mysqli_fetch_array($result);
    $FirstName      = $row['FirstName'];
    $middleName     = $row['middleName'];
    $lastName       = $row['lastName'];
    $EmailId_1      = $row['EmailId'];
    $companyName    = $row['companyName'];
    $AddressId      = $row['AddressId'];
    $contactAddress = $row['contactAddress'];
    $contactNumber  = $row['contactNumber'];
    $country        = $row['country'];
    $CState         = $row['CState'];
    $city           = $row['city'];
    $zipcode        = $row['zipcode'];
}
$i = 0;
$sql_person = "INSERT INTO PersonMaster(companyId,personTypeId,FirstName,middleName,lastName,EmailId,CompanyName,PersonCompanyId)
               VALUES($companyId,2,'$FirstName','$middleName','$lastName','$EmailId_1','$companyName',$PersonCompanyId)";

if(mysqli_query($con,$sql_person)){
  $personid = mysqli_insert_id($con);
  $i++;

  $sql_contact_1 = "INSERT INTO ContactMaster(AddressId,contactNumber,country,CState,city,contactAddress,zipcode) 
        VALUES(1,'$contactNumber','$country','$CState','$city','$contactAddress','$zipcode')";
  if(mysqli_query($con,$sql_contact_1)){
    $contactid = mysqli_insert_id($con);
    $i++;

  $sql3="INSERT INTO PersonContact (ContactId,PersonId) VALUES($contactid,$personid)";
  if(mysqli_query($con,$sql3)){
    $i++;

    $sql_contact_2 = "INSERT INTO ContactMaster(AddressId,contactNumber,country,CState,city,contactAddress,zipcode) 
    VALUES(2,'$contactNumber','$country','$CState','$city','$contactAddress','$zipcode')";
   
  if(mysqli_query($con,$sql_contact_2)){
    $contactid1=mysqli_insert_id($con);
    $i++;

    $sql7="INSERT INTO PersonContact (ContactId,PersonId) VALUES($contactid1,$personid)";
  if(mysqli_query($con,$sql7)){
    $i++;

    $sql4="INSERT INTO ContactDocument (DocumentId,PersonId) VALUES(4,$personid)";
  if(mysqli_query($con,$sql4)){
    $i++;

    $sql5="INSERT INTO ContactDocument (DocumentId,PersonId) VALUES(1,$personid)";
if(mysqli_query($con,$sql5)){
  $i++;
}
  }
}
  }
}
  }
}
if($i == 7){
    $response['msg'] = 'Supplier '.$companyName.' Added SuccessFully';
}else{
    $response['msg'] = 'Error While Adding';
}
mysqli_close($con);
exit(json_encode($response));
?>
