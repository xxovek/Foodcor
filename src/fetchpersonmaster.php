<?php
include '../config/connection.php';
session_start();
$companyId = $_REQUEST['companyId'];

$sql = "SELECT PM.PersonId,PM.FirstName,PM.middleName,PM.lastName
,PM.EmailId,PM.CompanyName,PM.companyId,PT.PersonType from PersonMaster PM , PersonType PT
where PM.companyId =$companyId and PM.PersonCompanyId NOT IN('4') and PM.personTypeId = PT.personTypeId";


$response = [];
if($result = mysqli_query($con,$sql)or die(mysqli_error($con))){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'PersonId' => $row['PersonId'],
        'FirstName' => $row['FirstName'],
        'middleName' => $row['middleName'],
        'lastName' => $row['lastName'],
        'EmailId' => $row['EmailId'],
        'CompanyName' => $row['CompanyName'],
        'PersonType' => $row['PersonType'],
        'companyId' => $row['companyId']

      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
