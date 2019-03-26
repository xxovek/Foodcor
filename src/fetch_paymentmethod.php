<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<?php
if($result = mysqli_query($con,"SELECT paymentTypeId,PaymentType FROM PaymentTypes WHERE  companyId IS NULL or companyId = '$companyId'"))
{
 if(mysqli_num_rows($result)>0)
 {
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['paymentTypeId'];?>'><?php echo $row['PaymentType'];?></option>
   <?php
   }
 }
}
?>
