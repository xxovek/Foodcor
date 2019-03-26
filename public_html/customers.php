<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['company_id']))
{
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. Stylized tables to allow audience grabs the information in a glance.">
    <meta name="keywords" content="table, toolbar">

    <title>Customers | Customer Information</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
    <!-- <link href="../select2/select2.min.css" rel="stylesheet" media="all"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
  </head>

  <body class="sidebar-folded">

    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>
    <?php require_once('mainSidebar.php');?>
    <?php require_once('mainTopbar.php');?>
    <main>

      <header class="header bg-ui-general">
        <div class="header-action">
          <nav class="nav">
            <!-- <a class="nav-link " href="allSales.php">All Sales</a>
            <a class="nav-link" href="invoices.php">Invoices</a>
              <a class="nav-link" href="purchase.php">Purchase</a>
                <a class="nav-link" href="purchaseorder.php">Purchase Order</a> -->
            <a class="nav-link active" href="customers.php">Customers</a>
            <!-- <a class="nav-link" href="products.php">Products and Services</a> -->
          </nav>
        </div>
      </header><!--/.header -->

      <div class="main-content">
        <div class="row">

        <!-- <div class="col-md-6 col-lg-4"> -->
          <?php  include 'customerModal.php' ?>
        <!-- </div> -->
        <div class="col-6 col-lg-3">
          <div class="card card-body" style="background:#21abf6">
            <div class="flexbox" >
              <div data-provide="sparkline" data-width="100" data-fill-color="false" data-line-width="2">1,4,3,7,6,4,8,9,6,8,12</div>
              <div class="text-right">
                <span class="fw-400">Customers</span><br>
                <span>
                  <i class="ti-angle-up text-success"></i>
                  <span class="fs-18 ml-1" id="custCnt"></span>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="card card-body" style="background:#ff8000">
            <div class="flexbox">
              <div data-provide="sparkline" data-type="bar" data-bar-color="#f2a654">1,4,7,6,4,8,6,12</div>
              <div class="text-right">
                <span class="fw-400">Suppliers</span><br>
                <span>
                  <i class="ti-angle-up text-success"></i>
                  <span class="fs-18 ml-1" id="suppCnt"></span>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-lg-3">
          <div class="card card-body" style="background:#babec5">
            <div class="flexbox">
              <div data-provide="sparkline" data-type="discrete" data-width="50" data-line-color="#926dde">1,4,3,7,6,4,8,9,6,8,12</div>
              <div class="text-right">
                <span class="fw-400">Employees</span><br>
                <span>
                  <i class="ti-angle-up text-success"></i>
                  <span class="fs-18 ml-1" id="empCnt"></span>
                </span>
              </div>
            </div>
          </div>
        </div>

                  <div class="col-6 col-lg-3">
                    <div class="card card-body" style="background:#7fd000">
                      <div class="flexbox">
                        <div data-provide="sparkline" data-type="discrete" data-width="50" data-line-color="#926dde">1,4,3,7,6,4,8,9,6,8,12</div>
                        <div class="text-right">
                          <span class="fw-400">Users</span><br>
                          <span>
                            <i class="ti-angle-up text-success"></i>
                            <span class="fs-18 ml-1" id="usersCnt"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
          <div class="col-lg-12">
            <div class="card">
                <h4 class="card-title"><strong>Customers</strong></h4>

              <div class="card-body table-responsive">
              <table class="table table-stripped table-bordered" cellspacing="0" id="example1">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th >Customer</th>
                      <th >GST Registration Type</th>
                      <th >Email</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody id="tabledata"></tbody>
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

          <div class="c    <!--  -->ol-md-6">
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
    </main>
    <div class="fab fab-fixed">
      <a class="btn btn-float btn-primary" href="#myModal" title="New Customer" data-provide="tooltip" data-toggle="modal" id="newproduct"><i class="ti-plus"></i></a>
    </div>
    <!-- Global quickview -->

    <!-- Scripts -->
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
    <script src="../datatables/buttons.print.min.js"></script>
    <script src="../datatables/buttons.colVis.min.js"></script>
    <script src="../js/customers.js"></script>
    <script src="../js/validations.js"></script>
    <script type="text/javascript">
    $("#myModal").on("hidden.bs.modal",function()
    {
    myform.reset();
    });
    app.ready(function(){
      myform.reset();
      $("#check1").prop("checked", false);

    });
    </script>
    <!-- <script src="../select2/select2.min.js"></script> -->
  </body>


</html>
<?php
}
else {
  header("Location:login.php");
}
 ?>
