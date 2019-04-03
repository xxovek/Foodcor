<?php
include '../config/connection.php';

$sql = "SELECT TaxId, TaxType, TaxPercent, TaxName, TaxDescription FROM TaxMaster";
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'TaxId' => $row['TaxId'],
        'TaxType' => ucwords($row['TaxType']),
        'Description' => ucwords($row['TaxDescription']),
        'TaxPercent' => number_format($row['TaxPercent'],2),
        'TaxName' => ucwords($row['TaxName'])
      ]);
    }
    }
  }
mysqli_close($con);
exit(json_encode($response));
?>
