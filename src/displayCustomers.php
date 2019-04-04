<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['company_id'])){
  $companyId = $_SESSION['company_id'];
}else{
  $companyId = $_POST['company_id'];
}
$sql = "SELECT PT.personTypeId,PM.PersonId,PM.FirstName,COALESCE(PM.middleName,' ') middleName,PM.lastName,COALESCE(PM.EmailId,' ') EmailId,PT.PersonType,COALESCE(PM.CompanyName,'-') CompanyName
FROM PersonMaster PM INNER JOIN PersonType PT ON PT.personTypeId = PM.personTypeId
WHERE PM.companyId =  $companyId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'pid' => $row['PersonId'],
        'ptype' => $row['PersonType'],
        'personTypeId'=>$row['personTypeId'],
        'name' => ucwords($row['FirstName']).' '.$row['lastName'],
        'email' => $row['EmailId'],
        'CompanyName' =>$row['CompanyName']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
