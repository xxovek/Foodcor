<?php
session_start();
if(isset($_SESSION['company_id']))
{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TheAdmin - Responsive Bootstrap 4 Admin, Dashboard &amp; WebApp Template">
    <meta name="keywords" content="dashboard, index, main">

    <title>Foodkor | Accounts</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i|Dosis:300,500" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">

    <!--  Open Graph Tags -->
    <meta property="og:title" content="The Admin Template of 2018!">
    <meta property="og:description" content="TheAdmin is a responsive, professional, and multipurpose admin template powered with Bootstrap 4.">
    <meta property="og:image" content="http://thetheme.io/theadmin/assets/img/og-img.jpg">
    <meta property="og:url" content="http://thetheme.io/theadmin/">
    <meta name="twitter:card" content="summary_large_image">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      <header class="header bg-ui-general">
        <div class="header-action">
          <nav class="nav">
            <a class="nav-link active" href="#">Chart of Accounting</a>

          </nav>
        </div>
      </header>


      <div class="main-content">
        <div class="row">

            <div class="col-lg-12"><br>
        <div class="card">
          <h4 class="card-title"><strong>Accounting</strong>  Information</h4>
          <!-- <h4 class="card-title"><strong>Products</strong> Services</h4> -->


          <div class="card-body table-responsive">
            <div id="tbl">
            <table class="table table-striped table-bordered" cellspacing="0"   id="tblData">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th > Name</th>
                  <th > Type</th>
                  <th>Tax Rate</th>
                  <th >Balance</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="tblDatabody">

              </tbody>

            </table>
          </div>
            <table class="table table-striped table-bordered" cellspacing="0" style="display:none"  id="tblData1">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th > Date</th>
                  <th >Ref No.Type</th>
                  <th>Payee Memo</th>
                  <th >Charge/Credit</th>
                  <th >Payment Due Date</th>
                  <th >Open Balance</th>
                </tr>
              </thead>
              <tbody id="tblDatabody1">

              </tbody>

            </table>
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
                <a class="nav-link" href="help/articles.html">Documentation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="help/faq.html">FAQ</a>
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
    <div id="qv-global" class="quickview" data-url="../assets/data/quickview-global-for-index.html">
      <div class="spinner-linear">
        <div class="line"></div>
      </div>
    </div>
    <!-- END Global quickview -->

    <!-- Scripts -->
    <script src="../js/accounting.js"></script>
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>

    <script src="../datatables/jquery.dataTables.min.js"></script>
    <script src="../datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../datatables/dataTables.buttons.min.js"></script>
    <script src="../datatables/buttons.bootstrap4.min.js"></script>
    <script src="../datatables/jszip.min.js"></script>
    <script src="../datatables/pdfmake.min.js"></script>
    <script src="../datatables/vfs_fonts.js"></script>
    <script src="../datatables/buttons.html5.min.js"></script>
    <!-- <script src="../datatables/buttons.print.min.js"></script> -->
    <script src="../datatables/buttons.colVis.min.js"></script>
  </body>

</html>
<?php
}
else {
  header("Location:login.php");
}
 ?>
