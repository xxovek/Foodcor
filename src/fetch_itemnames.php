<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];


$sql ="SELECT IM.ItemId,IM.ItemName,SM.SizeValue,IM.Unit  FROM ItemMaster IM
LEFT JOIN ItemDetailMaster ID ON IM.ItemId = ID.ItemId
LEFT JOIN SizeMaster SM ON SM.SizeId = ID.sizeId WHERE IM.companyId = $companyId ORDER BY IM.ItemId DESC";
if($result = mysqli_query($con,$sql))
{
 if(mysqli_num_rows($result)>0)
 {
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['ItemId'];?>'><?php echo ucfirst($row['ItemName']).' '.$row['SizeValue'].' '.$row['Unit'];?></option>
   <?php
   }
 }
}
?>
