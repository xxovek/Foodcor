<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<option data-icon="fa fa-edit" data-toggle="modal" data-target="#CategoryModal" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="Category"> Add New </option>

<?php
    if($result = mysqli_query($con,"SELECT DISTINCT(CategoryName),CategoryId From CategoryMaster where companyId = $companyId"))
    {
      if(mysqli_num_rows($result)>0)
      {
        while($row=mysqli_fetch_array($result))
        {?>
        <option value='<?php echo $row['CategoryId'];?>'><?php echo $row['CategoryName'];?></option>
        <?php
        }
      }
    }
     ?>
