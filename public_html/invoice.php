<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. Stylized tables to allow audience grabs the information in a glance.">
    <meta name="keywords" content="table, toolbar">

    <title>Foodkor | Invoices</title>

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
     th ,tr{
      height: 0.2px;
    }
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
            <a class="nav-link " href="allSales.php">All Sales</a>
            <a class="nav-link active" href="invoice.php">Invoices</a>
            <a class="nav-link" href="customers.php">Customers</a>
            <a class="nav-link" href="products.php">Products and Services</a>
          </nav>
        </div>
      </header><!--/.header -->

      <div class="main-content">
        <div class="row">

                    <div class="card col-lg-6">
                        <h6>
                          <span class="text-uppercase">Total Revenue</span>
                        </h6>
                        <br>
                        <p class="fs-28 fw-100"><b>$21,642</b></p>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 35%; height: 20px;background:#ff8000;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="card col-md-6 col-lg-6">
                        <h6>
                          <span class="text-uppercase">Orders</span>
                        </h6>
                        <br>
                        <p class="fs-28 fw-100"><b>653</b></p>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 95%; height: 20px;background :#7cd200;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

          <div class="col-lg-12"><br>
            <div class="card">
              <div class="card-title row">
                 <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown">Batch Actions</button>
                <div class="dropdown-menu col-sm-2">
                  <a class="dropdown-item" href="#">Send Invoices</a>
                  <a class="dropdown-item" href="#">Print Invoices</a>
                </div>
                <div class="col-sm-9">
                </div>
                <button class="btn" style="background:#2ca01c;color:white" type="button">New Invoice</button>
              </div>

              <div class="card-body table-responsive">
              <table class="table " cellspacing="0" data-provide="datatables" >
                  <thead class="text-center thead1" >
                    <tr>
                      <th>#</th>
                      <th>INVOICE</th>
                      <th>CUSTOMER</th>
                      <th>DATE</th>
                      <th>DUE DATE</th>
                      <th>BALANCE</th>
                      <th>TOTAL</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody class="text-center" >
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>
                        <button class=" btn-link dropdown-toggle"  data-toggle="dropdown">Recieve Payment</button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Print</a>
                          <a class="dropdown-item" href="#">Send</a>
                          <a class="dropdown-item" href="#">View/Edit</a>
                          <a class="dropdown-item" href="#">Send Reminder</a>
                          <a class="dropdown-item" href="#">Print delivery challan</a>
                          <a class="dropdown-item" href="#">Copy</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <a class="dropdown-item" href="#">Void</a>
                          <a class="dropdown-item" href="#">Share invoice link</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                      <td>@mdo</td>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>Otto</td>
                      <td>
                        <button class=" btn-link dropdown-toggle" type="button" data-toggle="dropdown">Recieve Payment</button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Print</a>
                          <a class="dropdown-item" href="#">Send</a>
                          <a class="dropdown-item" href="#">View/Edit</a>
                          <a class="dropdown-item" href="#">Send Reminder</a>
                          <a class="dropdown-item" href="#">Print delivery challan</a>
                          <a class="dropdown-item" href="#">Copy</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <a class="dropdown-item" href="#">Void</a>
                          <a class="dropdown-item" href="#">Share invoice link</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                      <td>@mdo</td>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>Otto</td>
                      <td>
                        <button class=" btn-link dropdown-toggle" type="button" data-toggle="dropdown">Recieve Payment</button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Print</a>
                          <a class="dropdown-item" href="#">Send</a>
                          <a class="dropdown-item" href="#">View/Edit</a>
                          <a class="dropdown-item" href="#">Send Reminder</a>
                          <a class="dropdown-item" href="#">Print delivery challan</a>
                          <a class="dropdown-item" href="#">Copy</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <a class="dropdown-item" href="#">Void</a>
                          <a class="dropdown-item" href="#">Share invoice link</a>
                        </div>
                      </td>
                    </tr>
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

  </body>

      <script>
        app.ready(function(){

          /*
          |--------------------------------------------------------------------------
          | Individual column searching
          |--------------------------------------------------------------------------
          */
          // Setup - add a text input to each footer cell
          $('#example-1 tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'">' );
          });

          // DataTable
          var table = $('#example-1').DataTable({
            'ajax': '../assets/data/json/datatables.json',
            'scrollX': true,
          });

          // Apply the search
          table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
              if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
              }
            });
          });




        });
      </script>

</html>
