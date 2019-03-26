<?php
include '../config/connection.php';
// session_start();
$company_id= $_SESSION['company_id'];
$sql ="SELECT logo FROM CompanyMaster WHERE CompanyId ='$company_id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
if(empty($row['logo']))
{
  $logo='default-logo.png';
}
else
  $logo=$row['logo'];
?>
<header class="topbar">
  <div class="topbar-left">
    <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>

    <a class="topbar-btn d-none d-md-block" href="#" data-provide="fullscreen tooltip" title="Fullscreen">
      <i class="material-icons fullscreen-default">fullscreen</i>
      <i class="material-icons fullscreen-active" >fullscreen_exit</i>
    </a>

    <div class="dropdown d-none d-md-block">
      <span class="topbar-btn" data-toggle="dropdown">
        <a class="topbar-btn d-none d-md-block" href="#" data-provide="Menu tooltip" title="Shortacts Menu Icons">
          <i class="ti-layout-grid3-alt"></i></a></span>
      <div class="dropdown-menu dropdown-grid">
        <a class="dropdown-item" href="dashboard.php">
          <span data-i8-icon="home"></span>
          <span class="title">Dashboard</span>
        </a>
        <a class="dropdown-item" href="allSales.php">
          <span data-i8-icon="stack_of_photos"></span>
          <span class="title">Sales</span>
        </a>
        <a class="dropdown-item" href="invoices.php">
          <span data-i8-icon="search"></span>
          <span class="title">Invoice</span>
        </a>
        <a class="dropdown-item" href="invoices.php">
          <span data-i8-icon="calendar"></span>
          <span class="title">Purchase</span>
        </a>
        <a class="dropdown-item" href="products.php">
          <span data-i8-icon="sms"></span>
          <span class="title">Products</span>
        </a>
        <a class="dropdown-item" href="settings.php">
          <span data-i8-icon="invite"></span>
          <span class="title">Settings</span>
        </a>
      </div>
    </div>

    <div class="topbar-divider d-none d-md-block"></div>
  </div>

  <div class="topbar-right">
    <a class="topbar-btn" href="#qv-global" data-toggle="quickview"><i class="ti-align-right"></i></a>

    <div class="topbar-divider"></div>

    <ul class="topbar-btns">
      <li class="dropdown">
        <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="assets/img/<?php echo $logo?>" alt="..."></span>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- <a class="dropdown-item" href="page/profile.html"><i class="ti-user"></i> Profile</a> -->
          <a class="dropdown-item" href="settings.php"><i class="ti-settings"></i>Settings</a>
          <a class="dropdown-item" href="logout.php"><i class="ti-power-off"></i> Logout</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>

    </ul>

  </div>
</header>
