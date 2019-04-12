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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">

    <!--  Open Graph Tags -->
    <meta property="og:title" content="The Admin Template of 2018!">
    <meta property="og:description" content="TheAdmin is a responsive, professional, and multipurpose admin template powered with Bootstrap 4.">
    <meta property="og:image" content="http://thetheme.io/theadmin/assets/img/og-img.jpg">
    <meta property="og:url" content="http://thetheme.io/theadmin/">
    <meta name="twitter:card" content="summary_large_image">
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
            <!-- <a class="nav-link active" href="#">All Salers</a> -->

          </nav>
        </div>
      </header>


      <div class="main-content">
       
      <div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center"> # </th>
            <th class="text-center"> Product Code</th>
            <th class="text-center"> Product Name</th>
            <th class="text-center"> Price </th>
            <th class="text-center"> Quantity </th>
            <th class="text-center"> Tax </th>
            <th class="text-center"> Total </th>
          </tr>
        </thead>
        <tbody id="tdata">
          <tr>
	<td><input class="case" type="checkbox"/></td>
	<td><input type="text" data-type="productCode" name="itemNo[]" id="itemNo_0" class="form-control autocomplete_txt" autocomplete="off"></td>
	<td><select class="form-control" id="itemName_0"><option value="1">Option 1</option><option value="2">Option 2</option></select></td>
	<td><input type="text" name="price[]" id="price_0" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
	<td><input type="text" name="quantity[]" id="quantity_0" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
  <td><div class="input-group mb-2 mb-sm-0"><select  name="tax[]" id="tax_0" class="form-control changestax" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><option value="10">10%</option><option value="20">20%</option><div class="input-group-addon">%</div></div></td>
  <td><input type="text" name="total[]" id="total_0" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
	</tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12">
      <button id="add_row" class="btn btn-default pull-left addmore">Add Row</button>
      <button id='delete_row' class="pull-right btn btn-default delete">Delete Row</button>
    </div>
  </div>
 
  <div class="row clearfix" style="margin-top:20px">
    <div class="pull-right col-md-4">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody id="tdata1">
          <tr>
            <th class="text-center">Sub Total</th>
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Tax</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" id="tax" placeholder="0">
                <div class="input-group-addon">%</div>
              </div></td>
          </tr>
          <tr>
            <th class="text-center">Tax Amount</th>
            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Grand Total</th>
            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
</div>  

    </div><!--/.main-content -->

     
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
    
    <script src="demoJ.js"></script>
    <!-- <script src="../js/outlets.js"></script> -->
    <script src="../assets/js/core.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
  </body>

</html>