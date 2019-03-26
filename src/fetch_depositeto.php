<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<?php
if($result = mysqli_query($con,"SELECT AccountId, subCategory, mainCategory FROM AccountMaster"))
{
 if(mysqli_num_rows($result)>0)
 {
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['AccountId'];?>'><?php echo $row['subCategory'];?> <?php echo $row['mainCategory'];?></option>
   <?php
   }
 }
}
?>
