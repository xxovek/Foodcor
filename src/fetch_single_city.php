<?php
include '../config/connection.php';

if($result = mysqli_query($con,"SELECT name,id From cities "))
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
