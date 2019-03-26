<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$sql = "SELECT PM.PersonId,PM.FirstName,COALESCE(PM.middleName,' ') middleName,PM.lastName,COALESCE(PM.EmailId,' ') EmailId,PT.PersonType FROM PersonMaster PM INNER JOIN
PersonType PT ON PT.personTypeId = PM.personTypeId WHERE PM.companyId = $companyId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'pid' => $row['PersonId'],
        'ptype' => $row['PersonType'],
        'name' => ucwords($row['FirstName']).' '.$row['lastName'],
        'email' => $row['EmailId']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
