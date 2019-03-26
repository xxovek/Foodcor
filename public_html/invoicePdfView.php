<?php
$t_id=$_REQUEST['tid'];
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. Display a receipt to the customers should not be a cumbersome task. Samples are ready to help you out through these process.">
    <meta name="keywords" content="invoice, receipt">

    <title>Invoice | View Of Invoice</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="../assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
<style media="screen">

@media print {
      body, html, #printableArea {
          width: 100%;
      }
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
  <?php include 'mainTopbar.php'; ?>
    <!-- Main container -->
    <main>
      <div class="main-content" id="printableArea"  style=" overflow : auto; ">
        <div class="card">

          <h5 class="card-title card-title-bold text-muted">Invoice #<span id="invoiceNo"><span></h5>

          <div class="card-body printing-area">

            <div class="row gap-y">
              <div class="col-md-3">
                <span id="caddr"></span>
              </div>

              <div class="col-md-3 ml-md-auto text-md-right">
                <h4 class="text-dark">To:</h4>
                <span id="paddr"></span>
                <br><br>
                <span id="invdate"></span>
                <br>
                <span id="duedate"></span>

                <br><br><br><br><br>
              </div>
            </div>

            <table class="table table-hover table-responsive">
              <thead >
                <tr >
                  <th class="text-center">#</th>
                  <th class="text-center">Description</th>
                  <th class="text-center">Shipping Quantity</th>
                  <th class="text-center">Billing Quantity</th>
                  <th class="text-center">Unit Cost</th>
                  <th class="text-center">Discount</th>
                  <th class="text-center">Amount</th>
                  <th class="text-center">Tax</th>

                </tr>
              </thead>
              <tbody  id="loadtable">
              </tbody>
            </table>


            <br><br>
            <div class="row">
              <div class="col-md-6">
                <h5>Notes</h5>
                <p class="text-muted" id="notes"></p>
              </div>

              <div class="col-md-4 ml-md-auto text-right">
                <table class="table table-stripped">
                  <!-- <tr>
                    <td>Amount:</td>
                    <td id="amt"></td>
                  </tr> -->
                  <tbody id="taxcal">

                  </tbody>
                </table>
                <br>
                <span class="bt-1 d-inline-block pt-10 pl-40">
                  Sub - Total amount: <span id="subtotal"></span>
                  <br>
                  Total: <span id="total"></span>
                </span>
                <br>Discount Value: <span id="discounttotal"></span>
                <br>
                <p class="fs-30 text-primary">Total: <span id="finaltotal"></span></p>
                <br>
              </div>
            </div>


            <hr>

            <div class="text-right" id="btnhide">
              <button type="submit" class="btn btn-primary">Proceed to payment</button>
              <button type="button" class="btn btn-secondary" onclick="printPage('printableArea');">Print</button>
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
  <script type="text/javascript">
    $(document).ready(function(){
     
      companyBasics();
      invoiceDetails();
      itemDetails();
    });
    function companyBasics() {
      $.ajax({
        url:'../src/invoicePdf.php',
        data:{tid:'<?php echo $t_id ?>'},
        success:function(data){
          var response=JSON.parse(data);
          $("#caddr").html('<address><span id="clogo"></span><br><br><strong>'+response[0]['cName']+'.</strong><br>'+response[0]['addr']+'<br>'+response[0]['ccountry']+'<br><abbr title="Email">E:</abbr> billing@thetheme.io<br><abbr title="Phone">P:</abbr> '
          +response[0]['phone']+'<br><abbr title="Fax">F:</abbr> (123) 456-0987<br><abbr title="GSTIN">GSTIN:</abbr>27BTNPC3346N1ZA </address>');
          $("#clogo").html('<img class="rounded-circle" width="100px" height="100px" src="assets/img/'+response[0]['logo']+'" alt="logo">');
          $("#paddr").html('<address><strong>'+response[0]['pName']+'.</strong><br>'+response[0]['paddr']+'<br>'+response[0]['pcountry']+'<br><abbr title="Email">E:</abbr> '+
          response[0]['pemail']+'<br><abbr title="Phone">P:</abbr>'+response[0]['pphone']+'</address>');
        }
      });
    }
    function invoiceDetails() {
      $.ajax({
        url:'../src/transaction.php',
          data:{tid:'<?php echo $t_id ?>'},
        success:function(data){
          var response=JSON.parse(data);
          $("#invoiceNo").html(response[0]['f_year']+'-'+response[0]['invoiceNo']);
          $("#notes").html(response[0]['note']);
          $("#invdate").html('<strong>Invoice Date:</strong> '+response[0]['dateFrom']+'');
          $("#duedate").html('<strong>Due Date:</strong>'+response[0]['dateDue']+'');
        }
      });
    }
    function itemDetails() {
      var amt1=0;
      $.ajax({
        url:'../src/invoiceItems.php',
          data:{tid:'<?php echo $t_id ?>'},
        success:function(data){
          var subtotal=0;
          var response=JSON.parse(data);
          var count=Object.keys(response).length;
          for (var i = 0; i < count; i++) {
            subtotal+=response[i]['total'];
            $("#loadtable").append('<tr class="text-center"><td>'+(i+1)+'</td><td>'+response[i]['iname']+'</td><td>'+response[i]['qty']+
            '</td><td>'+response[i]['BillQty']+'</td><td>'+response[i]['rate']+'</td><td>'+response[i]['discountAmount']+'</td><td>'+response[i]['total'].toFixed(2)+'</td><td>'+response[i]['tax']+'</td></tr>')
          }
          $("#subtotal").html(subtotal.toFixed(2));
          tryied(response[0]['TransactionId'],response[0]['discount']);
         
        }
      });
    }
    function tryied(TransactionId,discount) {
        if(discount==0.00 || isNaN(discount)){
            discount = 0.0000000000001;
        }
      $.ajax({
        url:'../src/invoiceItemsTax2.php',
        data:{TransactionId:TransactionId},
        dataType:'json',
        success:function(response){
          var count=response.length;
          
          var FinalTotal = response[count-1].FinalTotal;
          for (var i = 0; i < count; i++) {
            $("#taxcal").append('<tr class="text-center"><td>CGST @</td><td>'+response[i]['GST']+
            '% on</td><td>'+response[i]['Total_before_tax']+'</td><td>'+response[i]['Tax']+'</td></tr><tr class="text-center"><td>SGST @</td><td>'+response[i]['GST']+
            '% on</td><td>'+response[i]['Total_before_tax']+'</td><td>'+response[i]['Tax']+'</td></tr>');
          }
          $("#total").html(FinalTotal);
          var discounttotal=(parseFloat(FinalTotal)*parseFloat(discount))/100;
          
          //var finaltotal=FinalTotal-discounttotal;
          $("#discounttotal").html(discounttotal.toFixed(2));
          $("#finaltotal").html(FinalTotal);
        }
      });
    }
    function printPage(id)
  {
    $("#btnhide").hide();
     var html="<html>";
     html+= document.getElementById(id).innerHTML;

     html+="</html>";

     var printWin = window.open('','','left=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status  =0');
     printWin.document.write(html);
     printWin.document.close();
     printWin.focus();
     printWin.print();
     printWin.close();
  }
  </script>
</html>
