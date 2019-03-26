<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<?php
if($result = mysqli_query($con,"SELECT TaxId,TaxType, TaxPercent FROM TaxMaster WHERE companyId='$companyId'"))
{
 if(mysqli_num_rows($result)>0)
 {
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['TaxPercent'];?>'><?php echo $row['TaxPercent'];?>% <?php echo $row['TaxType'];?>(<?php echo $row['TaxPercent'];?>)</option>
   <?php
   }
 }
}
?>
