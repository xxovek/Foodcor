<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
// $personTypeId = 1;

$method = $_SERVER['REQUEST_METHOD'];
if($method == "POST")
{
  $personTypeId = $_POST['formid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $sql_insert = "INSERT INTO PersonMaster(companyId,personTypeId,FirstName,lastName) VALUES($companyId,$personTypeId,'$firstname','$lastname')";

  if(mysqli_query($con,$sql_insert)){
    $response['msg'] = 'Inserted';
    $personid=mysqli_insert_id($con);

    $sql2="INSERT into ContactMaster (AddressId) values(1)";
    mysqli_query($con,$sql2);
    $contactid=mysqli_insert_id($con);
    $sql3="INSERT into PersonContact (ContactId,PersonId) values($contactid,$personid)";
    mysqli_query($con,$sql3) or die(mysqli_error($con));

    $sql6="INSERT into ContactMaster (AddressId) values(2)";
    mysqli_query($con,$sql6);
    $contactid1=mysqli_insert_id($con);

    $sql7="INSERT into PersonContact (ContactId,PersonId) values($contactid1,$personid)";
    mysqli_query($con,$sql7) or die(mysqli_error($con));

    $sql4="INSERT into ContactDocument (DocumentId,PersonId) values(4,$personid)";
    mysqli_query($con,$sql4) or die(mysqli_error($con));
    $sql5="INSERT into ContactDocument (DocumentId,PersonId) values(1,$personid)";
    $result5=mysqli_query($con,$sql5) or die(mysqli_error($con));
    if($result5){
        $response['true']=true;
        $response['firstname']=$firstname;
    }
    else
    {
    $response['false']=false;
    }


  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
}
mysqli_close($con);
exit(json_encode($response));
 ?>
