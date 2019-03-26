<?php
session_start();
if(isset($_SESSION['company_id'])){
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit.">
    <meta name="keywords" content="dashboard, index, main">

    <title>Dashboard</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">
    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
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
    <?php require_once('mainTopbar.php');?>

    <!-- Main container -->
    <main>

      <div class="main-content">
        <div class="row">

          <div class="col-md-4">
            <div class="card card-body">
              <div class="flexbox">
                <div data-provide="sparkline" data-width="100" data-fill-color="false" data-line-width="2">1,4,3,7,6,4,8,9,6,8,12</div>
                <div class="text-right">
                  <span class="fw-400">New Users</span><br>
                  <span>
                    <i class="ti-angle-up text-success"></i>
                    <span class="fs-18 ml-1">113</span>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-body">
              <div class="flexbox">
                <div data-provide="sparkline" data-type="bar" data-bar-color="#f2a654">1,4,7,6,4,8,6,12</div>
                <div class="text-right">
                  <span class="fw-400">Monthly Sale</span><br>
                  <span>
                    <i class="ti-angle-up text-success"></i>
                    <span class="fs-18 ml-1">%80</span>
                  </span>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-4">
            <div class="card card-body">
              <div class="flexbox">
                <div data-provide="sparkline" data-type="discrete" data-width="50" data-line-color="#926dde">1,4,3,7,6,4,8,9,6,8,12</div>
                <div class="text-right">
                  <span class="fw-400">Impressions</span><br>
                  <span>
                    <i class="ti-angle-up text-success"></i>
                    <span class="fs-18 ml-1">%80</span>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><strong>Monthly Sales Report :<?php  echo date("Y"); ?></strong></h5>
                <a class="btn btn-xs btn-secondary" href="invoices.php">Invoices</a>
              </div>

              <div class="card-body">
                <ul class="list-inline text-center gap-items-4 mb-30">
                  <li class="list-inline-item">
                    <span class="badge badge-lg badge-dot mr-1" style="background-color: #848b93"></span>
                    <span>Invoices</span>
                  </li>
                  <li class="list-inline-item">
                    <span class="badge badge-lg badge-dot mr-1" style="background-color: #01c4cc"></span>
                    <span>Total Amount</span>
                  </li>
                </ul>
                <canvas id="chart-area-2" height="130" data-provide="chartjs"></canvas>

                <!-- <canvas id="chart-js-2" height="130" data-provide="chartjs"></canvas> -->
              </div>
            </div>
          </div>


          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><strong>Invoices</strong></h5></div>
              <div class="card-body card-body">
                  <div class="col-md-12">
                <header>
                <h6><span ><strong><span>₹958.34</span>&nbsp;&nbsp;<span>UNPAID</span></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><span><small>LAST 365 DAYS</small></span></span></h6>
                </header>

               <div class="" style="float:left"><span>₹214.82</span></div>
               <div class=""style="float:right"><span>₹743.52</span></div><br>
               <div class=""style="float:left"><span>OVERDUE</span></div>
              <div class=""style="float:right"><span>NOT DUE YET</span></div>
              <br>
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%; height: 30px;background-color:#ff8000;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                      </div>
                    </div>

                    <br>

                    <div class="col-md-12">
                  <header>
                  <h6><span ><strong><span>₹1958.34</span>&nbsp;&nbsp;<span>PAID</span></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><span><small>LAST 365 DAYS</small></span></span></h6>
                  </header>

                 <div class="" style="float:left"><span>₹214.82</span></div>
                 <div class=""style="float:right"><span>₹743.52</span></div><br>
                 <div class=""style="float:left"><span>NOT DEPOSITED</span></div>
                <div class=""style="float:right"><span>DEPOSITED</span></div>
                <br>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 50%; height: 30px;background-color:#7cd200;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                        </div>
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
                <a class="nav-link" href="https://themeforest.net/item/theadmin-responsive-bootstrap-4-admin-dashboard-webapp-template/20475359?license=regular&open_purchase_for_item_id=20475359&purchasable=source&ref=thethemeio">Purchase Now</a>
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
    <!-- <script src="../js/dashboard.js"></script> -->


    <script>
      app.ready(function(){

            $.ajax({
               url:"../src/displayInvoice.php",
               method:"POST",
               dataType:"json",
               success: function(responce){

           			var Total_invAmt = new Array(11).fill(0);
                var inv_count = new Array(11).fill(0) ;
                var currYear = "<?php  echo date("Y"); ?>";

                 var len = responce.length;
                 if(len > 0){
                   for (var i = 0; i < len; i++) {

                   var m = new Date(responce[i].DateCreated);
                    var n = m.getMonth();
                    var y = m.getFullYear();

                if(y === currYear){

                    switch(n){
                      case 0:
                             inv_count[0]++;
                             Total_invAmt[0] =  parseInt(Total_invAmt[0]) + parseInt(responce[i].Total);
                             // Total_invAmt[0] = invAmtSum;
                        break;
                      case 1:inv_count[1]++;
                               Total_invAmt[1] = parseInt(Total_invAmt[1]) + parseInt(responce[i].Total);

                        break;
                        case 2:inv_count[2]++;
                         Total_invAmt[2] = parseInt(Total_invAmt[2]) + parseInt(responce[i].Total);

                          break;
                          case 3:inv_count[3]++;
                           Total_invAmt[3] = parseInt(Total_invAmt[3]) + parseInt(responce[i].Total);

                            break;
                            case 4:inv_count[4]++;
                             Total_invAmt[4] = parseInt(Total_invAmt[4]) + parseInt(response[i].Total);

                              break;
                              case 5:inv_count[5]++;
                               Total_invAmt[5] = parseInt(Total_invAmt[5]) + parseInt(responce[i].Total);

                                break;
                                case 6:inv_count[6]++;
                                 Total_invAmt[6] = parseInt(Total_invAmt[6]) + parseInt(responce[i].Total);

                                  break;
                                  case 7:inv_count[7]++;
                                   Total_invAmt[7] = parseInt(Total_invAmt[7]) + parseInt(responce[i].Total);

                                    break;
                                    case 8:inv_count[8]++;
                                     Total_invAmt[8] = parseInt(Total_invAmt[8]) + parseInt(responce[i].Total);

                                      break;
                                      case 9:inv_count[9]++;
                                       Total_invAmt[9] = parseInt(Total_invAmt[9]) + parseInt(responce[i].Total);

                                        break;
                                        case 10:inv_count[10]++;
                                         Total_invAmt[10] = parseInt(Total_invAmt[10]) + parseInt(responce[i].Total);

                                          break;
                                          case 11:inv_count[11]++;
                                           Total_invAmt[11] = parseInt(Total_invAmt[11]) + parseInt(responce[i].Total);

                                            break;
                    }
                  }
                  else{

                  }


                 }


                 $('#chat-content').scrollToEnd();

                 // ==============================================
                 // Area chart 2
                 //
                 new Chart($("#chart-area-2"), {
                   type: 'line',

                   data: {
                     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],

                     datasets: [
                       {
                         label: "Total Invoices",
                         backgroundColor: "rgba(128,128,128,0.6)",
                         borderColor: "rgba(0,0,0,0)",
                         pointBackgroundColor: "rgba(128,128,128,0.6)",
                         pointBorderColor: "#fff",
                         pointHoverBackgroundColor: "#fff",
                         pointHoverBorderColor: "rgba(128,128,128,0.6)",
                         data: inv_count
                       },
                       {
                         label: "Invoice Total Amount",
                         backgroundColor: "rgba(51,202,185,0.7)",
                         borderColor: "rgba(0,0,0,0)",
                         pointBackgroundColor: "rgba(51,202,185,0.7)",
                         pointBorderColor: "#fff",
                         pointHoverBackgroundColor: "#fff",
                         pointHoverBorderColor: "rgba(51,202,185,0.7)",
                         data: Total_invAmt
                       }
                     ]
                   },

                   options: {
                     legend: {
                       display: false
                     },
                   }
                 });

                 },
}
               error: function(data) {
                   console.log(data);
                 }
        });

      });
    </script>

  </body>
</html>
<?php }else {
  // echo $_SESSION['company_id'];
   header('Location:login.php');
} ?>
