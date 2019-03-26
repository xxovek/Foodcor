<?php
include '../config/connection.php';
//session_start();
$companyId = 1;//$_SESSION['user_id'];
    if($result = mysqli_query($con,"SELECT DISTINCT(SizeValue),SizeId From SizeMaster where companyId = $companyId"))
    {
      if(mysqli_num_rows($result)>0)
      {
        while($row=mysqli_fetch_array($result))
        {?>
        <option value='<?php echo $row['SizeId'];?>'><?php echo $row['SizeValue'];?></option>
        <?php
        }
      }
    }
     ?>
  <option data-icon="fa fa-edit" data-toggle="modal" data-target="#SizeModal" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="addSize" id="addSize"> Add New </option>
