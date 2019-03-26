<aside class="sidebar sidebar-expand-lg sidebar-light sidebar-sm sidebar-color-info">

  <header class="sidebar-header bg-info">
    <!-- <span class="logo">
      <a href="#">Foodkor</a>
    </span> -->
    <!-- <ul>
    <li class="menu-item">
      <a class="menu-link" href="#">
        <span class="icon fa fa-dashboard"></span>
        <span class="title">Khajana</span>
      </a>
    </li>
  </ul> -->
    <span class="sidebar-toggle-fold"></span>

  </header>

  <nav class="sidebar-navigation">
    <ul class="menu menu-sm menu-bordery">
      <!-- <li class="menu-item">
        <a class="menu-link" href="#">
          <span class="icon fa fa-dashboard"></span>
          <span class="title">Khajana</span>
        </a>
      </li> -->
      <li class="menu-item">
        <a class="menu-link" href="index.php">
          <span class="icon fa fa-home"></span>
          <span class="title">Dashboard</span>
        </a>
      </li>


      <li class="menu-item active">
        <a class="menu-link" href="settings.php">
          <span class="icon ti-settings"></span>
          <span class="title">Settings</span>
        </a>
      </li>
            <li class="menu-item active" id="userstab">
              <a class="menu-link" href="#" onclick="displayusers();">
                <span class="icon ti-user"></span>
                <span class="title">Users</span>
              </a>
            </li>
    </ul>
  </nav>

</aside>
<script type="text/javascript">
function displayusers()
{
  $("#companyinfotab").hide();
  $("#companyinfo").hide();
$("#usertable").show();
}

</script>
