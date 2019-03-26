<?php
include '../config/connection.php';

$response = [];
// session_start();
$custid = $_REQUEST['custid'];
$sql = "SELECT  contactAddress, contactNumber, country, CState, city, zipcode FROM ContactMaster WHERE contactId In(SELECT ContactId FROM PersonContact WHERE PersonId='$custid')";
$result = mysqli_query($con,$sql);

 if(mysqli_num_rows($result)>0)
 {
   while($row=mysqli_fetch_array($result))
   {?>
   <option value='<?php echo $row['city'];?>'><?php echo $row['city']?></option>
   <?php
   }
 }

?>
