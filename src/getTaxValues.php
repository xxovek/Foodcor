<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<option data-icon="fa fa-edit" data-toggle="modal" data-target="#TaxModal" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="Tax"> Add New </option>
<?php
$sql = "SELECT TaxId,concat(TaxType,'(',TaxPercent,'%)') as tax FROM TaxMaster WHERE companyId = $companyId";
    if($result = mysqli_query($con,$sql) )
    {
      if(mysqli_num_rows($result)>0)
      {
        while($row=mysqli_fetch_array($result))
        {?>
        <option value='<?php echo $row['TaxId'];?>'><?php echo $row['tax'];?></option>
        <?php
        }
      }
    }
     ?>
