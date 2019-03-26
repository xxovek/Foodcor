<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<?php
if($result = mysqli_query($con,"SELECT distinct(PaytermType) as Paytermval FROM PaymentTerms WHERE companyId='$companyId'"))
{
 if(mysqli_num_rows($result)>0)
 {
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['Paytermval'];?>'>NET - <?php echo $row['Paytermval'];?></option>
   <?php
   }
 }
}
?>
