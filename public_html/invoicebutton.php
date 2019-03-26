
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. Theadmin provides streamlined, but flexible, dialog prompts with the minimum required functionality and smart defaults.">
    <meta name="keywords" content="dialog, modal, popup">

    <title>Foodkor</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
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

  <body>

    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>

    <main>




      <div class="main-content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <h4 class="card-title"><strong>Modal types</strong></h4>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 col-lg-4">

          <button type="button" class="btn btn-float btn-sm btn-primary" data-toggle="modal" data-target="#modal-invoice">
            <i class="ti-plus"></i>
          </button>
          <!-- <button type="button" class="btn btn-float btn-sm btn-primary" data-toggle="modal" data-target="#modal-purchase">
            <i class="ti-plus"></i>
          </button> -->
          <?php include "invoicemodal.php"; ?>

                  </div>

                </div>
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



    <?php include "paytermmodel.php"?>
    <?php include "customermodel.php"?>
    <?php include "taxmodalinvoice.php"?>
    <!-- Scripts -->
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>

    <!-- <script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script> -->
    <script src="../js/invoicetable.min.js"></script>
    <script src="../js/invoice.js"></script>

    <script>
    getcustomer();
    getpayterms();
    setcurrentdate();
    
    // getplaceofsupply();
    $('#DyanmicTable').SetEditable({ $addButton: $('#addNewRow')});

    </script>


  </body>
</html>
