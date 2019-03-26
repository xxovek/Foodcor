<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
  <header class="sidebar-header">
    <a class="logo-icon" href="index.php">Foodkor</a>
    <!-- <span class="logo">
      <a href="index.html"><img src="../assets/img/logo-light.png" alt="logo"></a>
    </span> -->
    <span class="sidebar-toggle-fold"></span>
  </header>

  <nav class="sidebar-navigation">
    <ul class="menu">

      <li class="menu-category">Preview</li>

      <li class="menu-item active">
        <a class="menu-link" href="dashboard.php">
          <span class="icon fa fa-home"></span>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <li class="menu-item">
        <a class="menu-link" href="#">
          <span class="icon fa fa-money"></span>
          <span class="title">Sales</span>
          <span class="arrow"></span>
        </a>

        <ul class="menu-submenu">
          <li class="menu-item">
            <a class="menu-link" href="allSales.php">
              <span class="dot"></span>
              <span class="title">All Sales</span>
            </a>
          </li>

          <li class="menu-item">
            <a class="menu-link" href="invoices.php">
              <span class="dot"></span>
              <span class="title">Invoices</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="purchase.php">
              <span class="dot"></span>
              <span class="title">Purchase</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="purchaseorder.php">
              <span class="dot"></span>
              <span class="title">Purchase Order</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="customers.php">
              <span class="dot"></span>
              <span class="title">Customers</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="products.php">
              <span class="dot"></span>
              <span class="title">Products And Services</span>
            </a>
          </li>

        </ul>
      </li>

<li class="menu-category">Taxes</li>
<li class="menu-item">
  <a class="menu-link" href="taxes.php">
    <span class="icon fa fa-percent"></span>
    <span class="title">Taxes</span>
  </a>
</li>

<li class="menu-category">Schemes</li>
<li class="menu-item">
  <a class="menu-link" href="schemes.php">
    <span class="icon pe-7s-note"></span>
    <span class="title">Schemes</span>
  </a>
</li>
<li class="menu-category">Account Chart</li>
<li class="menu-item">
  <a class="menu-link" href="accounting.php">
    <span class="icon pe-7s-note"></span>
    <span class="title">Account Chart</span>
  </a>
</li>
      <li class="menu-category">Reports</li>


      <li class="menu-item">
        <a class="menu-link" href="#">
          <span class="icon ti-layout"></span>
          <span class="title">Reports</span>
          <span class="arrow"></span>
        </a>

        <ul class="menu-submenu">
          <li class="menu-item">
            <a class="menu-link" href="openingclosingReport.php">
              <span class="dot"></span>
              <span class="title">Stock Report</span>
            </a>
          </li>

          <li class="menu-item">
            <a class="menu-link" href="purchaseReport.php">
              <span class="dot"></span>
              <span class="title">Purchase Report</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="stockLedger.php">
              <span class="dot"></span>
              <span class="title">Stock Ledger Report</span>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>

</aside>
<!-- END Sidebar -->


  <script type="text/javascript">
  $('li').removeClass('active');

    var regex = /[A-Za-z _]+.php/g;
    var input = location.pathname;

    if(regex.test(input)) {
       var matches = input.match(regex);
       $('a[href="'+matches[0]+'"]').closest('li').addClass('menu-item active');
       $('a[href="'+matches[0]+'"]').closest('ul').closest('li').addClass('menu-item active');
    }
  </script>
