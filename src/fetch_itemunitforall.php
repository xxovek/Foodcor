<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<?php
if($result = mysqli_query($con,"SELECT PackingId,PackingType FROM InvoicePackingType WHERE companyId='$companyId' OR companyId IS NULL"))
{
 if(mysqli_num_rows($result)>0)
 {
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['PackingId'];?>'><?php echo $row['PackingType'];?></option>
   <?php
   }
 }
}
?>
