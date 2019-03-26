<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
$response = [];

$sql = "SELECT COUNT(PersonId) AS Cnt FROM PersonMaster WHERE personTypeId = 1 And companyId = $companyId
UNION ALL
SELECT COUNT(PersonId) AS supCnt FROM PersonMaster WHERE personTypeId = 2 And companyId = $companyId
UNION ALL
SELECT COUNT(PersonId) AS empCnt FROM PersonMaster WHERE personTypeId = 3 And companyId = $companyId
UNION ALL
SELECT COUNT(PersonId) AS usersCnt FROM PersonMaster WHERE personTypeId = 4 And companyId = $companyId";

// echo $sql;
$result = mysqli_query($con,$sql) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0){
  while ($row=mysqli_fetch_array($result)) {
    array_push($response,[
      'Cnt' => $row['Cnt']
]);
}
}
mysqli_close($con);

exit(json_encode($response));

 ?>
