<?php
  include '../config/connection.php';
  session_start();
  $companyId = $_SESSION['company_id'];
  $formid = $_REQUEST['formid'];

  $sql ="SELECT PersonId, FirstName, middleName, lastName FROM PersonMaster
  WHERE  companyId =$companyId and personTypeId=$formid ";
  if($result = mysqli_query($con,$sql))
  {
   if(mysqli_num_rows($result)>0)
   {
     while($row=mysqli_fetch_array($result))
     {?>
     <option value='<?php echo $row['PersonId'];?>'><?php echo ucwords($row['FirstName']).' '.ucwords($row['lastName']);?></option>
     <?php
     }
   }
  }
?>
