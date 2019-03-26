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
    <meta name="description" content="Responsive admin dashboard and web application ui kit. Stylized tables to allow audience grabs the information in a glance.">
    <meta name="keywords" content="table, toolbar">

    <title>Invoice | Invoice Data</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
    <style>
     th ,tr{
      height: 0.2px;
    }
    </style>
    <style>
    .modal {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      overflow: hidden;
    }

    .modal-dialog {
      position: fixed;
      margin: 0;
      width: 100%;
      height: 100%;
      padding: 0;
    }

    .modal-content {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;

      border-radius: 0;
      box-shadow: none;
    }

    .modal-header {
      position: absolute;

    }

    .modal-title {
      font-weight: 300;
      font-size: 2em;
      color: #fff;
      line-height: 30px;
    }

    .modal-body {
      position: absolute;
      top: 50px;
      bottom: 60px;
      width: 100%;
      font-weight: 300;
      overflow: auto;
    }

    .modal-footer {
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      height: 60px;
      padding: 10px;
      background: #f1f3f5;
    }

    /* .dropdown-menu{

      height:300px;
      overflow:scroll;
    } */
    </style>
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
    <!-- Main container -->
    <main>

      <header class="header bg-ui-general">
        <div class="header-action">
          <nav class="nav">
            <!-- <a class="nav-link " href="allSales.php">All Sales</a> -->
            <a class="nav-link active" href="#">Invoices</a>
              <!-- <a class="nav-link" href="purchase.php">Purchase</a>
                <a class="nav-link" href="purchaseorder.php">Purchase Order</a>
            <a class="nav-link" href="customers.php">Customers</a>
            <a class="nav-link" href="products.php">Products and Services</a> -->
          </nav>
        </div>
      </header><!--/.header -->
      <?php include "invoicemodal.php"; ?>
      <div class="main-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="card-title" style="float:right;">
               <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown">New Transaction</button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#modal-invoice"  data-formid="1" data-formtype="N" data-transactionid="0"  data-toggle="modal">New Invoices</a>
                <a class="dropdown-item" href="#modal-invoice"  data-formid="2" data-formtype="N" data-transactionid="0"  data-toggle="modal">New Purchase</a>
                <a class="dropdown-item" href="#modal-invoice"  data-formid="5" data-formtype="N" data-transactionid="0"  data-toggle="modal">Purchase Order</a>
                <a class="dropdown-item" href="#modal-payment"  data-formid="3" data-formtype="N" data-transactionid="0"  data-toggle="modal">Payment </a>
              </div>
            </div>
          </div>


                    <div class="col-6 col-lg-6">
                      <div class="flexbox flex-justified text-center bg-white">
                        <div class="no-shrink">
                          <h6>
                            <!-- <span class="text-uppercase">Total Revenue</span><p class="fs-28 fw-100"><b>₹21,642</b></p> -->
                            <span class="fs-20" >Total Revenue</span><strong> ₹<span class="fs-28 fw-100" style="color: #ff8000" id="totalRevenue"></strong></span>

                          </h6>
                          <div class="card-body">
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: 35%; height: 20px;background:#ff8000;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-6 col-lg-6">
                      <!-- pe-7s-junk -->
                      <!-- fa fa-times-circle -->
                      <div class="flexbox flex-justified text-center bg-white">
                        <div class="no-shrink">

                          <h6>
                            <span class="fs-20" >Orders</span><strong> <span class="fs-28 fw-100" style="color: #ff8000" id="totalOrders"></strong></span>
                          </h6>
                          <div class="card-body">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 95%; height: 20px;background :#7cd200;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>


                      </div>

                      </div>
                    </div>

          <div class="col-lg-12"><br>
            <div class="card">
              <h4 class="card-title"><strong>Invoices</strong></h4>

              <div class="card-body table-responsive">
              <table  id="invoiceTbl" class="table table-striped table-bordered" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>#</th>
                      <th>Invoice</th>
                      <th>Customer</th>
                      <th>Date</th>
                      <th>Due Date</th>
                      <th>Balance</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody  id="invoiceTblBody"></tbody>
                </table>

              </div>
            </div>
          </div>

        </div>

      </div>
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
    <?php include "paymentmodal.php"; ?>
    <?php include "paymentmethod.php"; ?>
    <?php include "paytermmodel.php"?>
    <?php include "customermodel.php"?>
    <?php include "taxmodalinvoice.php"?>
    <?php include "AddNewItemModal.php"?>
    <!-- Scripts -->
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
    <script src="../js/invoices.js"></script>

    <script src="../js/invoice.js"></script>

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
      <script src="../js/invoicetable.min.js"></script>
        <script src="../js/setpaymentmethod.js"></script>
  </body>

      <script>
      $('#modal-invoice').on('show.bs.modal', function(e) {
         var formid = $(e.relatedTarget).data('formid');
         var formtype = $(e.relatedTarget).data('formtype');
         var transactionid = $(e.relatedTarget).data('transactionid');
         clearmodalfields();
         if(transactionid==0){
           // alert(transactionid);
           $("#hiddenformid").val(formid);
           $("#hiddenformtype").val(formtype);
           $("#hiddentransactionid").val(transactionid);
           // setcurrentdate();
             getcustomer();
             getpayterms();
             // setcurrentdate();
         }
         else{
            if(typeof(transactionid) === "undefined"){
            }
            else
            {
              $("#hiddenformid").val(formid);
              $("#hiddenformtype").val(formtype);
              $("#hiddentransactionid").val(transactionid);
              // setcurrentdate();
              getcustomer();
              getpayterms();
              setTimeout(function()
              {
              editappenditemtable(transactionid);
              },500);
            }
         }

      });
      $('#DyanmicTable').SetEditable({ $addButton: $('#addNewRow')});
      // Add For Payment Receipt modal
      $('#modal-payment').on('show.bs.modal', function(e) {
         var formid = $(e.relatedTarget).data('formid');
         var formtype = $(e.relatedTarget).data('formtype');
         var transactionid = $(e.relatedTarget).data('transactionid');
         // alert(transactionid);
         //* clearmodalfields();
         if(transactionid==0){
           // alert(transactionid);
           $("#phiddenformid").val(formid);
           $("#phiddenformtype").val(formtype);
           $("#phiddentransactionid").val(transactionid);
           // setcurrentdate();
              getdepositeto();
              getcustomerpayment();
              getpaymethodmethod();
                $("#paymentTblBody").empty();
              // displayPaymentTblData();
              setTimeout(function()
              {
                $("#paymentmethod").val("1").trigger("change");
                $("#paymentdepositeto").val("23").trigger("change");
             },500);

         }
         // else{
         //    if(typeof(transactionid) === "undefined"){
         //    }
         //    else
         //    {
         //      $("#hiddenformid").val(formid);
         //      $("#hiddenformtype").val(formtype);
         //      $("#hiddentransactionid").val(transactionid);
         //      // setcurrentdate();
         //      getcustomer();
         //      getpayterms();
         //      setTimeout(function()
         //      {
         //      editappenditemtable(transactionid);
         //      },500);
         //    }
         // }

      });
      // getplaceofsupply();

      </script>

</html>
<?php
}
else {
  header("Location:login.php");
}
 ?>
