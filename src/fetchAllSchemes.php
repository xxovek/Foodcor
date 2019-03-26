<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];

$sql = "SELECT SCM.SchemeId,SCM.schemeType,SCM.FromDate,SCM.UptoDate,SCM.OnPurchase,SCM.freeQty,
IDM.itemDetailId,IM.ItemName,SM.SizeValue,IM.Unit FROM SchemeMaster SCM 
LEFT JOIN  ItemDetailMaster IDM ON SCM.ItemDetailId = IDM.itemDetailId
LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId
 LEFT JOIN SizeMaster SM ON SM.SizeId = IDM.sizeId  
 WHERE SCM.companyId = $companyId";

$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'SchemeId' => $row['SchemeId'],
        'schemeType' => ucwords($row['schemeType']),
        'FromDate' => $row['FromDate'],
        'UptoDate' => $row['UptoDate'],
        'Item' => ($row['ItemName'].' '.$row['SizeValue'].' '.$row['Unit']),
        'Itemid' => $row['itemDetailId'],
        'OnPurchase' => $row['OnPurchase'],
        'freeQty' => $row['freeQty']
      ]);
    }

    }
  }
mysqli_close($con);
exit(json_encode($response));
  ?>
fet
