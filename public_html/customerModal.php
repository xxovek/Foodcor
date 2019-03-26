<div class="modal modal-center fade " id="myModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="titlepage"></span></h4>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  data-provide="validation" data-disable="false" id="myform" method="post">
      <div class="modal-body">
          <div class="row">

            <div class="col-sm-3" >
              <div class="form-group">
              <label for="ctype" class="require">Registration Type </label>
              <select data-live-search="true" class="form-control form-control-sm" data-provide="selectpicker" id="ctype" name="ctype" title="select type" onchange="getPersonType();" required>
              <?php
              $sql = "SELECT personTypeId,PersonType FROM PersonType";
              if($result = mysqli_query($con,$sql))
              {
               if(mysqli_num_rows($result)>0)
               {
                 while($row=mysqli_fetch_array($result))
                 {?>
                 <option value='<?php echo $row['personTypeId'];?>'><?php echo $row['PersonType'];?></option>
                 <?php
                 }
               }
              }
              ?>
            </select>
            </div>
                <div class="invalidfeedback1">
                </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="fname" class="require">First Name</label>
                <input type="hidden" name="personid" id="personid">
                <input class="form-control form-control-sm" type="text" tabindex="1" placeholder="First Name" data-provide="tooltip" data-placement="top" title="Customers first name Example:Anjali" name="fname" id="fname" autocomplete="off" onkeypress="return AlphaBets(event,this);" required>
                <div class="invalidfeedback"></div>
            </div>
              </div>
            <div class="col-sm-3">
              <div class="form-group">
                  <label for="mname">Middle Name</label>
                  <input type="text" autocomplete="off" class="form-control form-control-sm" tabindex="2" placeholder="Middle Name" name="mname" id="mname" data-provide="tooltip" data-placement="top" data-original-title="Customers middle name Example:Rahul"  value="" onkeypress="return AlphaBets(event,this);" >
            </div>
              </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" autocomplete="off" name="lname" class="form-control form-control-sm" placeholder="Last Name" tabindex="3" id="lname" data-provide="tooltip" data-placement="top" data-original-title="Customers last name Example:Pawar" value="" onkeypress="return AlphaBets(event,this);">
              </div>
            </div>
        </div>

         <!-- <div class="h-20px"></div> -->
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
        <label for="email">Email</label>
        <input type="email" autocomplete="off" class="form-control form-control-sm" placeholder="Email"  data-provide="tooltip" data-placement="top" data-original-title="Customers EmailId Example:anju@gmail.com" tabindex="4" name="email" id="email">
      </div>
        </div>
      <div class="col-sm-4">
        <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" autocomplete="off" class="form-control form-control-sm" placeholder="Phone" data-provide="tooltip" data-placement="top" data-original-title="Customers Phone Number Example:9988556677" tabindex="5" minlength="10" maxlength="10" onkeypress="return isNumberKey(event)" onchange="phonenumber(this);" name="phone" id="phone" value="">
        <span id="msgid"></span>
      </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group">
        <label for="phone">Company</label>
        <input type="text" autocomplete="off" class="form-control form-control-sm" placeholder="Company/firm" data-provide="tooltip" data-placement="top" data-original-title="Firm Name of customer" name="companyName" id="companyName">
        <span id="msgid"></span>
      </div>
        </div>
      </div>
      <!-- <div class="h-20px"></div> -->

      <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
      <label for="GSTIN">GSTIN</label>
      <input type="text" autocomplete="off" class="form-control form-control-sm"  placeholder="GSTIN"  data-provide="tooltip" data-placement="top" data-original-title="Customers GSTIN Number Example:22AAAAA0000A1Z5" maxlength="15" onchange="validateGSTIN();" tabindex="6" name="GSTIN" id="GSTIN" value="">
      <span id="msgid4"></span>
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
      <label for="phone">PAN</label>
      <input type="text" autocomplete="off" class="form-control form-control-sm"  placeholder="PAN" tabindex="7" onchange="ValidatePAN();" maxlength="10" name="PAN" data-provide="tooltip" data-placement="top" data-original-title="Customers PAN Number Example:AAAPL1234C" id="PAN" value="">
<span id="msgid1"></span>
</div>
    </div>
    </div>
      <!-- <div class="card">
              <h6 class="card-title"></h6>
              <div class="card-body"> -->

                  <div class="row">
                <div class="col-sm-4">
                      <div class="form-group">
                  <label  data-provide="tooltip" data-placement="top" data-original-title="The address to which you would like your order billed"  data-provide="tooltip" >Billing Address
                  </label>
                  <textarea name="name" autocomplete="off" rows="4" cols="30"   id="billaddr" name="billaddr"></textarea>
                </div>
              </div>
                  <div class="col-sm-8">
                    <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label  data-provide="tooltip" data-placement="top" data-original-title="Select Billing Country"  data-provide="tooltip" >Country
                    </label>
                    <!-- <title="Select Country" data-provide="tooltip" > -->

                        <span id="spancountry"></span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label  data-provide="tooltip" data-placement="top" data-original-title="Select Billing State"  data-provide="tooltip" >State
                    </label>

                        <span id="spanstate"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                  <label   data-provide="tooltip" data-placement="top" data-original-title="Select Billing City"  data-provide="tooltip" >City
                  </label>
                  <!-- <title="Select City" data-provide="tooltip" >City -->

                      <span id="spancity"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                  <label  data-provide="tooltip" data-placement="top" data-original-title="Select Billing Pincode"  data-provide="tooltip" >Pincode
                  </label>

                <input class="form-control form-control-sm" tabindex="11" id="bzip" type="text" minlength="6" maxlength="6" onkeypress="return isNumberKey(event)" data-provide="tooltip" data-placement="right" data-original-title="PIN code Example:411061" name="bzip" placeholder="PIN code">
                </div>
                  </div>
              </div>
                  </div>
                </div>

                <label for="saddr" data-provide="tooltip" data-placement="top" data-original-title="The address to which you would like your order shipped Example:22AAAAA0000A1Z5"  data-provide="tooltip" >Shipping Address
                </label>
                <!-- <div class="card-body"> -->
                  <div class="row">
                    <div class="col-sm-4">
                      <input type="checkbox" onclick="fun();" id="check1"  value=""> Same as Billing Address
                <textarea name="shipaddr" id="shipaddr"  rows="4" cols="30"></textarea>
              </div>
              <div class="col-sm-8">
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                  <label  data-provide="tooltip" data-placement="top" data-original-title="Select Shipping Country"  data-provide="tooltip" >Country
                  </label>

                      <span id="spanshippingcountry"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                  <label  data-provide="tooltip" data-placement="top" data-original-title="Select Shipping State"  data-provide="tooltip" >State
                  </label>

                      <span id="spanshippingstate"></span>
                  </div>
                </div>
              </div>
              <div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                <label  data-provide="tooltip" data-placement="top" data-original-title="Select Shipping City"  data-provide="tooltip" >City
                </label>

                    <span id="spanshippingcity"></span>
                </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label  data-provide="tooltip" data-placement="top" data-original-title="Select Shipping Pincode"  data-provide="tooltip" >Pincode
                    </label>
                <!-- <title="Pincode" data-provide="tooltip" >Pincode -->
              <input class="form-control form-control-sm" autocomplete="off" tabindex="15" id="szip"  type="text" minlength="6" maxlength="6" onkeypress="return isNumberKey(event)" name="szip" placeholder="PIN code">
              </div>
            </div>

            </div>
              </div>
            </div>

      <div class="modal-footer">
        <button type="reset" class="btn btn-bold btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-bold  btn-primary" id="addCustomer">Save changes</button>
      </div>
        </form>
    </div>
  </div>
    </div>
  </div>
