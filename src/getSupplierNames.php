<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<option value=""></option>
<!-- <option data-icon="fa fa-edit" data-toggle="modal" data-target="#supplierModal" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="s"> Add New </option> -->
<?php
$sql = "SELECT PM.FirstName,PM.lastName,PM.PersonId FROM PersonMaster PM LEFT JOIN PersonType PT ON PM.personTypeId = PT.personTypeId WHERE PT.PersonType = 'Supplier' AND PM.companyId = $companyId";
    if($result = mysqli_query($con,$sql) )
    {
      if(mysqli_num_rows($result)>0)
      {
        while($row=mysqli_fetch_array($result))
        {?>
        <option value='<?php echo $row['PersonId'];?>'><?php echo $row['FirstName'].' '.$row['lastName'];?></option>
        <?php
        }
      }
    }
     ?>
