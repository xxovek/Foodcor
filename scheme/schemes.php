<?php
session_start();
include '../config/connection.php';
if(isset($_SESSION['company_id']))
{
  $companyId = $_SESSION['company_id'];
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. Stylized tables to allow audience grabs the information in a glance.">
    <meta name="keywords" content="table, toolbar">

    <title>Reports | Stock Ledger Report</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">

  </head>

  <body class="sidebar-folded">

    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>
    <?php require_once('mainSidebar.php');?>
    <!-- Topbar -->
    <?php require_once('mainTopbar.php');?>
    <!-- END Topbar -->
    <!-- Main container -->
    <main>

      <div class="main-content">
        <div class="row">
          <div class="col-sm-2">

          </div>
          <div class="col-lg-8">
            <div class="card">
          <div class="card-body">
          <form class="validation" id="schemes">
          <div class="row">

          <div class="col-md-6">
          <div class="form-group">
              <label class="require">Item Name</label>
            <select data-live-search="true" class="form-control" data-provide="selectpicker"  id="item" name="item" title="Please select a item ..." required>
              <?php
              $sql ="SELECT IDM.`itemDetailId`,IM.ItemName,SM.SizeValue,IM.Unit FROM ItemDetailMaster IDM
              LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId LEFT JOIN SizeMaster SM ON SM.SizeId = IDM.sizeId WHERE IM.companyId =$companyId";
                 if($result = mysqli_query($con,$sql))
                   {
                     if(mysqli_num_rows($result)>0)
                       {
                         while($row=mysqli_fetch_array($result))
                           {?>
                             <option value='<?php echo $row['itemDetailId'];?>'><?php echo $row['ItemName'].' '.$row['SizeValue'].' '.$row['Unit'];?></option>
                             <?php
                               }
                                 }
                                 }
                              ?>
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                  <label class="require">Scheme Name</label>
                    <input type="text" class="form-control" name="scheme" id="scheme" required autocomplete="off">
                </div>
              </div>
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label class="require">From Date</label>
                  <input type="text" class="form-control" id="fromDate"  name="fromDate" data-placement="left" data-provide="datepicker" autocomplete="off" required>
                </div>
              </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label class="require">To Date</label>
                  <input type="text" class="form-control" id="toDate"  name="toDate" data-placement="right" data-provide="datepicker" autocomplete="off" required>
                </div>
              </div>

          </div>
          <div class="row">
          <div class="col-sm-6">
            <label class="require">On purchase</label>
              <input type="text" class="form-control" name="onpurchase" id="onpurchase" autocomplete="off" required>
            </div>
            <div class="col-sm-6">
              <label class="require">Free Quantity</label>
              <input type="text" class="form-control" name="freeqty" id="freeqty" autocomplete="off" required>
            </div>
          </div>
          <div class="row">
          <div class="col-sm-10"></div>
          <div class="col-sm-2">
              <div class="form-group">
                <div class="h-30px"></div>
                  <button class="btn btn-label  btn-primary" type="submit"><label><i class="ti-search fs-20"></i></label> Submit</button>
              </div>
          </div>
        </div>
          </form>
          </div>
        </div>
        </div>
        </div>
      </div><!--/.main-content -->

      <!-- Footer -->
      <footer class="site-footer">
        <div class="row">
          <div class="col-md-6">
            <p class="text-center text-md-left">Copyright © 2017 <a href="http://thetheme.io/theadmin">TheAdmin</a>. All rights reserved.</p>
          </div>

          <div class="col-md-6">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
              <li class="nav-item">
                <a class="nav-link" href="../help/articles.html">Documentation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../help/faq.html">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://themeforest.net/item/theadmin-responsive-bootstrap-4-admin-dashboard-webapp-template/20475359?license=regular&amp;open_purchase_for_item_id=20475359&amp;purchasable=source&amp;ref=thethemeio">Purchase Now</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
      <!-- END Footer -->

    </main>
    <!-- END Main container -->
    <div id="qv-global" class="quickview" data-url="../assets/data/quickview-global.html">
      <div class="spinner-linear">
        <div class="line"></div>
      </div>
    </div>

    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
    <script src="../assets/vendor/moment/moment.min.js"></script>
    <script src="../js/schemes.js"></script>

  </body>
</html>
<?php
}
else {
  header("Location:login.php");
}
 ?>
