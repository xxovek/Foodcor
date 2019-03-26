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
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="blank, starter">

    <title>Blank page &mdash; TheAdmin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
    <!-- <link href="../select2/select2.min.css" rel="stylesheet" media="all"> -->
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

    <?php include 'mainSidebar.php'; ?>
      <?php include 'mainTopbar.php' ;?>
    <main>
      <div class="main-content">


        <div class="">
          <h2 >
          <span id="cust"></span>
          </h2>
        </div>
        <hr>
        <div class="row">

        <div class="col-sm-5">

        </div>
        <div class="col-sm-5">
      <h6 title="PERSON CONTACT DETAILS"> <strong>PERSON CONTACT DETAILS</strong></h6>
      </div>
        <!-- <div class="col-sm-1">
        <button class="btn btn-info" type="button" data-toggle="modal"  data-target="#myModal" name="button">Edit</button>
      </div> -->

      <div class="col-sm-2">
        <button class="btn btn-info" type="button" data-toggle="modal"  data-target="#myModal" name="button">Edit</button>
        <button class="btn btn-dark" type="button" onclick="history.back(-1);" name="button">Back</button>
      </div>

      <div class="col-md-6 col-lg-4">
  <?php  include 'customerModal.php' ?>
  </div>
      </div>
          <div style="margin-top:50px;" class="container">
            <div class="row">

              <div class="col-sm-6">
              <table class="table" >
                <tbody>
                  <tr>
                    <td style="font-weight:bold">First Name:</td>
                    <td id="pname"></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Middle Name:</td>
                    <td id="pmname"></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Last Name:</td>
                    <td id="plname"></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Email:</td>
                    <td id="pemail"></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Person Type:</td>
                    <td id="ptype"></td>
                  </tr>
                </tbody>

              </table>
              </div>
              <div class="col-sm-6">
                <table class="table">
                  <tbody>
                    <tr>
                      <td style="font-weight:bold">Billing Address:</td>
                      <td id="pbaddr"></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Shipping Address:</td>
                      <td id="psaddr"></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Phone:</td>
                      <td id="pphone"></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">PAN:</td>
                      <td id="pPAN"></td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">GSTIN:</td>
                      <td id="pgstin"></td>
                    </tr>
                  </tbody>

                </table>
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



    <!-- Global quickview -->
    <div id="qv-global" class="quickview" data-url="../assets/data/quickview-global.html">
      <div class="spinner-linear">
        <div class="line"></div>
      </div>
    </div>
    <!-- END Global quickview -->


    <!-- Scripts -->
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
<!-- <script src="../select2/select2.min.js"></script> -->
  </body>
  <script src="../js/customers.js"></script>
  <script src="../js/validations.js"></script>

    <script type="text/javascript">
    app.ready(function(){

      var pid=<?php echo $_REQUEST['pid'] ?>;
      fetchCustomer(pid);
    });

    </script>
</html>
<?php
}
else {
  header("Location:login.php");
}
 ?>
