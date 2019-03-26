<?php
include '../config/connection.php';
session_start();
$company_id= $_SESSION['company_id'];
$sql ="SELECT logo FROM CompanyMaster WHERE CompanyId ='$company_id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
if(empty($row['logo']))
{
  $logo='default.jpg';
}
else
  $logo=$row['logo'];
?>
<header class="topbar">
  <div class="topbar-left">
    <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
    <a class="logo d-lg-none" href="index.html"><img src="assets/img/<?php echo $logo?>" alt="logo"></a>


  </div>

  <div class="topbar-right">

    <ul class="topbar-btns">
      <li class="dropdown">
        <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="assets/img/<?php echo $logo?>" alt="..."></span>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- <a class="dropdown-item" href="#"><i class="ti-user"></i> Profile</a> -->
          <a class="dropdown-item" href="logout.php"><i class="ti-power-off"></i> Logout</a>
        </div>
      </li>
    </ul>

  </div>
</header>
