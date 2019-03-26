<?php
include '../config/connection.php';
session_start();
if(isset($_SESSION['company_id']))
{
$flag =$_SESSION['company_flag'];

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TheAdmin - Responsive admin and web application ui kit">
    <meta name="keywords" content="admin, dashboard, web app, sass, ui kit, ui framework, bootstrap">

    <title>Settings &mdash; Foodkor</title>

    <!-- Styles -->
    <link href="../assets/css/core.min.css" rel="stylesheet">
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../datatables/CSS/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="../datatables/CSS/dataTables.bootstrap4.min.css" />
    <!-- <link href="../select2/select2.min.css" rel="stylesheet" media="all"> -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">

    <style media="screen">
    option[value=""][disabl1] {
display: none;
}
.highlight-error {
  border-color: red;
}
    </style>
  </head>

  <body class="sidebar-folded">
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>

    <!-- Sidebar -->
  <?php include 'sidebar.php' ?>
    <!-- END Sidebar -->
    <!-- Topbar -->
<?php include 'navbar.php'; ?>
    <!-- END Topbar -->
    <!-- Main container -->
    <main>
      <div class="main-content">
        <div class="col-lg-12" id="usertable" style="display:none">
          <div class="card">
            <div class="card-body table-responsive">
            <table class="table table-stripped table-bordered" cellspacing="0" id="userdata">
                <thead>
                  <tr>
                    <th >User Id</th>
                    <th >Full Name</th>
                    <th >Email</th>
                    <th >Contact Number</th>
                    <th >Action</th>
                  </tr>
                </thead>
                <tbody id="usertabledata"></tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3" id="companyinfotab" >
            <div class="card">
              <ul class="nav nav-lg nav-pills flex-column">
                <li class="nav-item active" data-toggle="tab" data-target="#tab1">
                  <a class="nav-link" href="#" id="addcompanytab">Company Details</a>
                </li>
                <li class="nav-item" data-toggle="tab" data-target="#tab2">
                  <a class="nav-link" href="#">User Details</a>
                </li>
                <li class="nav-item" data-toggle="tab" data-target="#tab3">

                  <a class="nav-link" href="#" onclick="displaydocdetails();">Document Details</a>
                </li>
                <li class="nav-item" data-toggle="tab" data-target="#tab4" >
                  <a class="nav-link" href="#" id="addusertab">Add Users</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-9 tab-content" id="companyinfo">
            <div class="card form-type-material tab-pane fade active show" id="tab1">
            <form  method="post" id="imgtab" enctype="multipart/form-data">
              <h4 class="card-title fw-400">Company Details</h4>
              <div class="card-body">
                <div class="flexbox gap-items-4">
                  <span id="logo1"></span>
                  <div class="flex-grow">
                    <div class="row">
                    <div class="col-sm-3">
                      <h5>TheTheme</h5>
                    </div>
                    <img id="blah"  alt="" />
                  </div>
                    <div class="d-flex flex-column flex-sm-row gap-y gap-items-2 mt-16">
                      <!-- <div class="file-group file-group-inline"> -->
                        <!-- <button class="btn btn-sm btn-w-lg btn-bold btn-secondary file-browser" type="button">Change Picture</button>
                        <input type="file"> -->
                        <input type='file' name="image" onchange="readURL(this);" required/>
                      <!-- </div> -->
                       <button class="btn btn-w-lg  btn-info" type="submit">Save</button>
                      <!-- <a class="btn btn-sm btn-w-lg btn-bold btn-danger" href="#">Delete Picture</a> -->
                    </div>
                  </div>
                </div>
              </form>
                <hr>
                  <form id="compForm" data-provide="validation" data-disable="false">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" id="cid" name="cid">
                      <input class="form-control" type="text" id="cname" name="cname" placeholder="Company Name" data-provide="tooltip" data-placement="top" title="Company Name Example:Xxovek Web Solutions pvt ltd" autocomplete="off" required>
                      <!-- <label>Name</labels> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" id="caddr" name="caddr" data-provide="tooltip" data-placement="top" title="Company's Address Example:Shivajinagar,Pune"  placeholder="Company Address"  autocomplete="off" required>
                      <!-- <label>VAT Number</label> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" id="cphone" name="cphone" data-provide="tooltip" data-placement="top" title="Company's Contact Number Example:9898989898"  onkeypress="return isNumberKey(event)" maxlength="10" onblur="phonenumber(this);" placeholder="Contact Number"  autocomplete="off" required>
                      <span id="msgid"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select data-live-search="true" class="form-control" data-provide="selectpicker"  onchange="getState(this.value)" data-provide="tooltip" data-placement="top" title="Company Country Example:India"  id="ccountry" name="ccountry" title="Please select a country ..." required>
                        <!-- <option value=""  disabl1 selected >Select Country</option> -->
                        <?php
                       if($result = mysqli_query($con,"SELECT name,id From countries"))
                       {
                         if(mysqli_num_rows($result)>0)
                         {
                           while($row=mysqli_fetch_array($result))
                           {?>
                           <option value='<?php echo $row['id'];?>'><?php echo $row['name'];?></option>
                           <?php
                           }
                         }
                       }
                        ?>
                        </select>
                        <span id="setcountry"></span>
                      <!-- <input class="form-control" type="text" id="ccountry" name="ccountry" placeholder="Country" required> -->
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <span id="stt"></span>
                      <!-- <label>Country</label> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <span id="ctt"></span>
                      <!-- <label>City</label> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" id="czip" data-provide="tooltip" data-placement="top" title="Company PIN code Example:411007"  name="czip" minlength="6" maxlength="6"  autocomplete="off" onkeypress="return isNumberKey(event)"  placeholder="Zipcode" required>
                  <!-- <label>Address</label> -->
                </div>
              </div>
              </div>
              <footer class="card-footer text-right">
                <button type="submit" class="btn btn-label btn-primary" >
                    <label><i class="ti-check"></i></label>
                    Save Changes
                  </button>
                <!-- <button class="btn btn-flat btn-primary" type="submit">Save Changes</button> -->
              </footer>
            </form>
          </div>

            <form class="card form-type-material tab-pane fade" data-provide="validation" id="tab2">
              <h4 class="card-title fw-400">User Details</h4>

              <div class="card-body">
                <div class="flexbox gap-items-4">
                  <!-- <img class="avatar avatar-xl" src="assets/img/avatar/2.jpg" alt="..."> -->
                  <div class="flex-grow">
                    <h5 id="uname1"></h5>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" id="uname" onkeypress="return AlphaBets(event,this);" data-provide="tooltip" data-placement="top" title="User's First Name Example:John" autocomplete="off" name="uname" placeholder="First Name" required>
                      <!-- <label>First name</label> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" id="umname" onkeypress="return AlphaBets(event,this);" name="umname" placeholder="Middle Name" data-provide="tooltip" data-placement="top" autocomplete="off" title="User's middle name Example:smith"  required>
                      <!-- <label>First name</label> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" id="ulname" onkeypress="return AlphaBets(event,this);" name="ulname" data-provide="tooltip" data-placement="top" title="User's last name Example:Doe"  autocomplete="off" placeholder="Last Name" required>
                      <!-- <label>Last name</label> -->
                    </div>
                  </div>
                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" type="password"   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="upwd" name="upwd" data-provide="tooltip" data-placement="top" autocomplete="off" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  placeholder="Password" required>
                  </div>
              </div> -->
            </div>
              <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="email" id="uemail" data-provide="tooltip" data-placement="bottom" title="User's EmailId Example:johndoe@gmail.com"  name="uemail" autocomplete="off" placeholder="Email" required>
                  <!-- <label>Email</label> -->
                </div>
              </div>
            </div>
            </div>

              <footer class="card-footer text-right">
                <button type="submit" class="btn btn-label btn-primary" >
                    <label><i class="ti-check"></i></label>
                    Save Changes
                  </button>
                <!-- <button class="btn btn-flat btn-primary" type="submit">Save Changes</button> -->
              </footer>
            </form>

            <form class="card form-type-material tab-pane fade" data-provide="validation" id="tab3">
              <h4 class="card-title fw-400">Company Document Details</h4>
              <div class="card-body">
              <!-- pan adhar passport -->
                <br>
                <input type="hidden" name="documentdetails" id="documentdetails"/>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" name="cinno" id="cinno" data-provide="tooltip" data-placement="top" title="Enter Company Identification Number Containing 21 Alphanumeric Characters " autocomplete="off" maxlength="21" onchange="alphanumeric();" placeholder="Enter Company Identification Number" >
                      <span id="msgid5"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" name="PAN" id="PAN" data-provide="tooltip" data-placement="top" maxlength="10"  title="Pan Number Example:AAAPL1234C" autocomplete="off" onchange="ValidatePAN();" placeholder="Enter PAN Number" >
                      <span id="msgid1"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" name="companyadhar" id="companyadhar" data-provide="tooltip" data-placement="top" title="Enter 12 or 16 Digit Adhar Number.   Example:1234-5678-9878" autocomplete="off" placeholder="Enter ADHAR Number" data-type="adhaar-number" maxLength="19" >
                      <span id="msgid2"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" name="companypassport" id="companypassport" data-provide="tooltip" data-placement="top" title="Enter Passport Number Example: A12 34567" maxlength="9" autocomplete="off" onchange="validatePASSPORT();" placeholder="Enter PASSPORT Number" >
                      <span id="msgid3"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" name="GSTIN" id="GSTIN" data-provide="tooltip" data-placement="top" title="GSTIN Number Example:29ASDFG6767G2Z5" autocomplete="off" maxlength="15" onchange="validateGSTIN();" placeholder="Enter GSTIN Number" >
                      <span id="msgid4"></span>
                    </div>
                  </div>
                </div>
              </div>
              <footer class="card-footer text-right">
                <button type="button" id="btn" class="btn btn-label btn-primary" >
                    <label><i class="ti-check"></i></label>
                    Save Changes
                  </button>
                <!-- <button class="btn btn-flat btn-primary" type="button" id="btn">Save Changes</button> -->
              </footer>
            </form>
            <form class="card form-type-material tab-pane  fade active" data-provide="validation" id="tab4">
              <h4 class="card-title fw-400">Add Users</h4>

              <div class="card-body">
                <div class="flexbox gap-items-4">
                  <!-- <img class="avatar avatar-xl" src="assets/img/avatar/2.jpg" alt="..."> -->
                  <div class="flex-grow">
                    <h5 id="adminusername"></h5>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" id="adminuserid" name="adminuserid">
                      <input class="form-control" type="text" id="adminuname" onkeypress="return AlphaBets(event,this);" data-provide="tooltip" data-placement="top" title="User's First Name Example:John" autocomplete="off" name="adminuname" placeholder="First Name" required>
                      <!-- <label>First name</label> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" id="adminumname" onkeypress="return AlphaBets(event,this);" name="adminumname" placeholder="Middle Name" data-provide="tooltip" data-placement="top" autocomplete="off" title="User's middle name Example:smith"  required>
                      <!-- <label>First name</label> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" type="text" id="adminulname" onkeypress="return AlphaBets(event,this);" name="adminulname" data-provide="tooltip" data-placement="top" title="User's last name Example:Doe"  autocomplete="off" placeholder="Last Name" required>
                      <!-- <label>Last name</label> -->
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" type="email" id="adminuemail" data-provide="tooltip" data-placement="bottom" title="User's EmailId Example:johndoe@gmail.com" onchange="checkUserEmailAvailabilityAdmin(this.value)" name="adminuemail" autocomplete="off" placeholder="Email" required>
                    <span id="check_uemail_availablity"></span>
                  </div>
              </div>
            </div>

              <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <!-- <label>Email</label> -->
                  <input class="form-control" type="password" value="12345"  id="adminupwd" name="adminupwd" data-provide="tooltip" data-placement="top" autocomplete="off" placeholder="Password" readonly required>

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" id="usercontactno" name="usercontactno" data-provide="tooltip" data-placement="top" title="Company's Contact Number Example:9898989898"  onkeypress="return isNumberKey(event)" maxlength="10" onblur="phonenumber(this);" placeholder="Contact Number"  autocomplete="off" required>
                  <span id="usermsgid"></span>
                </div>
            </div>
            </div>


            </div>

              <footer class="card-footer text-right">
                <button type="submit"  class="btn btn-label btn-primary" >
                    <label><i class="ti-check"></i></label>
                    Save Changes
                  </button>
                <!-- <button class="btn btn-flat btn-primary" type="submit">Save Changes</button> -->
              </footer>
            </form>

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
    <script src="assets/js/script.js"></script>
    <!-- <script src="../select2/select2.min.js"></script> -->
  </body>
  <script src="../js/settings.js"></script>
  <script src="../js/validations.js"></script>

  <!-- <script src="../select2/select2.min.js"></script> -->
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

<script type="text/javascript">
  $(document).ready(function(){
    displayAdminUsersTable(<?php echo $flag ?>);

$("#stt").html('<select data-live-search="true" class="form-control " data-provide="selectpicker"   onchange="getCity(this.value)" id="cstate" name="cstate" title="Please select a State ..." required></select>');
$("#ctt").html('<select data-live-search="true" class="form-control " data-provide="selectpicker"   id="ccity" name="ccity" title="Please select a City ..." required>');
  });

  function getState(country)
  {
    var a='';
    a+='<select data-live-search="true" class="form-control " data-provide="selectpicker"   onchange="getCity(this.value)" id="cstate" name="cstate" title="Please select a State ..." required>';

  $.ajax({
      type: "POST",
      url: "../src/fetch_state.php",
      data: ({
          user_id:country
      }),
      success: function(msg) {
        a+=msg;
          $("#stt").html(a+'</select>');
      }
  });
  }

  function getCity(state)
  {
    var b='';
    b+='<select data-live-search="true" class="form-control " data-provide="selectpicker"   id="ccity" name="ccity" title="Please select a City ..." required>';

    $.ajax({
        type: "POST",
        url: "../src/fetch_city.php",
        data: ({
            user_id:state
        }),
        success: function(msg) {
          b+=msg;
            $("#ctt").html(b+'</select>');

        }
    });
  }

  function readURL(input) {
    // alert(input);
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#blah')
                       .attr('src', e.target.result)
                       .width(80)
                       .height(80);
               };

               reader.readAsDataURL(input.files[0]);
           }
       }
$("#imgtab").on('submit',function(e){
  e.preventDefault();
  $.ajax({
    url:'../src/addLogo.php',
    type: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success:function(data){
      window.location.reload();
    }
  });
});


</script>
</html>
<?php
}
else {
  header("Location:login.php");
}
 ?>
