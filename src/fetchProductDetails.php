<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];

$sql = "SELECT IM.Description,IM.ItemId,IM.ItemName,IM.SKU,IM.HSN,IM.Unit,SM.SizeValue,PS.Quantity,PS.TotalQty,PS.ReorderLabel,IP.price,ID.SubPacking
FROM ItemMaster IM
LEFT JOIN ItemDetailMaster ID ON IM.ItemId = ID.ItemId LEFT JOIN ItemPrice IP ON IP.ItemDetailId = ID.itemDetailId
LEFT JOIN ProductStock PS ON PS.itemdetailId = ID.itemDetailId
LEFT JOIN SizeMaster SM ON SM.SizeId = ID.sizeId WHERE PS.companyId = $companyId ORDER BY IM.ItemId DESC";
// echo $sql;
$response = [];
if($result = mysqli_query($con,$sql)){
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
      array_push($response,[
        'ItemId' => $row['ItemId'],
        'ItemName' => ucfirst($row['ItemName'].' '.$row['SizeValue'].' '.$row['Unit']),
        'SKU' => $row['SKU'],
        'HSN' => $row['HSN'],
        'SubPacking' => $row['SubPacking'],
        'Description' => ucwords($row['Description']),
        'price' => number_format($row['price'],2),
        'Quantity' => $row['Quantity'],
        'ReorderLabel' => $row['ReorderLabel']
      ]);
    }

    }
  }
mysqli_close($con);
exit(json_encode($response));
?>
