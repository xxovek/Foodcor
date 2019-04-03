<?php
$response=[];
include '../config/connection.php';
$contactNumber  = $_REQUEST['phone'];
$companyName    = mysqli_real_escape_string($con,$_REQUEST['cname']);
$firstName      = $_REQUEST['fname'];
$lastName       = $_REQUEST['lname'];
$EmailId        = $_REQUEST['email'];
$upassword      = $_REQUEST['pwd'];
$mname          = $_REQUEST['mname'];
$mname          = !empty($mname) ? $mname : "NULL";
// echo $contactNumber;
$i=0;
$sql_insert_contact = "INSERT INTO ContactMaster(contactNumber) VALUES('$contactNumber')";
if(mysqli_query($con, $sql_insert_contact)){
  $i++;
  $contact_id = mysqli_insert_id($con);
  $sql_insert_company = "INSERT INTO CompanyMaster(companyName,contactId) VALUES('$companyName','$contact_id')";
  if(mysqli_query($con, $sql_insert_company)){
    $i++;
    $company_id = mysqli_insert_id($con);
    $sql_insert_person = "INSERT INTO PersonMaster(companyId,personTypeId,FirstName,middleName,lastName,EmailId,CompanyName) VALUES('$company_id',4,'$firstName','$mname','$lastName','$EmailId','$companyName')";
  if(mysqli_query($con, $sql_insert_person)){
    $i++;
    $person_id = mysqli_insert_id($con);
    $sql_insert_user = "INSERT INTO UserMaster(emailId,upassword,companyId,PersonId,flag) VALUES('$EmailId','$upassword','$company_id','$person_id',0)";
    if(mysqli_query($con, $sql_insert_user)){
    $i++;

    $check_company_id = "SELECT itemDetailId FROM ItemDetailMaster";
    if($result_1 = mysqli_query($con,$check_company_id)){
      if(mysqli_num_rows($result_1)>0){
        while($row = mysqli_fetch_array($result_1)){
          $itemDetailId = $row['itemDetailId'];
          $sql_insert_PStock = "INSERT INTO ProductStock(itemdetailId,companyId) VALUES($itemDetailId,$company_id)";
          mysqli_query($con,$sql_insert_PStock) or die(mysqli_error($con));
        }
      }
    }
      }
    } 
  }
}
if($i==4)
$response['true'] = true;
else
$response['false'] = false;

mysqli_close($con);
exit(json_encode($response));
?>