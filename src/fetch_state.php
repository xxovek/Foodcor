<?php
include '../config/connection.php';

$user_id = $_REQUEST['user_id'];
?>
<option value=""  disabl1 selected >Select State</option>
 <?php
if($result = mysqli_query($con,"SELECT name,id From states where country_id = '$user_id'"))
{
  if(mysqli_num_rows($result)>0)
  {
    while($row=mysqli_fetch_array($result))
    {?>
    <option value='<?php echo $row['id'];?>'><?php echo $row['name'];?></option>
    <?php
    }
  }
}
 ?>
