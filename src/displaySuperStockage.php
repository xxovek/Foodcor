<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$sql = "SELECT PM.companyId,PM.FirstName,PM.lastName,PM.CompanyName,CM.companyName,COUNT(PM.PersonId) AS Distributor,UM.created_at FROM UserMaster UM LEFT JOIN  PersonMaster PM ON PM.companyId = UM.companyId
LEFT JOIN CompanyMaster CM ON CM.CompanyId = UM.companyId
WHERE UM.flag = 1 GROUP BY UM.companyId";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'companyId' => $row['companyId'],
        'companyName' => ucwords($row['companyName']),
        'PersonName' => ucwords($row['FirstName']).' '.$row['lastName'],
        'Distributor' => $row['Distributor']-1,
        'Registered' => $row['created_at']
      ]);
    }
  }
}
mysqli_close($con);
exit(json_encode($response));
?>
