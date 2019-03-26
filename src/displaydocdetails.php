<?php
include '../config/connection.php';

session_start();
$person_id = $_SESSION['person_id'];
$sql = "SELECT DocumentId,DocumentNumber FROM ContactDocument cd LEFT JOIN PersonMaster p ON p.PersonId = cd.personId WHERE p.PersonId =$person_id";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_array($result)){
    array_push($response,[
      'DocumentId' => $row['DocumentId'],
      'DocumentNumber' => $row['DocumentNumber']
        ]);
  }
}
}
mysqli_close($con);
exit(json_encode($response));
?>
