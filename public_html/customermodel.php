<div class="modal modal-center fade" id="CustomerModal" tabindex="-1">
  <div class="modal-dialog" style="height: 453px;">
    <div class="modal-header">
    </div>
    <div class="modal-content" style="border: 2px solid gray;">
    <form data-provide="validation" data-disable="false" id="CustomerData" method="POST" >
      <div class="modal-body">
       <div class="form-group"><h5 >Add New Customer</h5></div>
        <div class="form-group">
            <label for="First Name" class="require">First Name</label>
            <input type="text" class="form-control form-control-sm" id="firstname" name="firstname" data-placement="bottom" data-provide="tooltip" autocomplete="off" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="Last Name" class="require">Last Name</label>
            <input type="text" class="form-control form-control-sm" id="lastname" name="lastname" data-placement="bottom" data-provide="tooltip" autocomplete="off" required>
            <div class="invalid-feedback"></div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal" onclick="clear_customer();">Close</button>
        <button type="button" class="btn btn-bold btn-pure btn-primary" onclick="addcustomerinfo();"   >Save and close</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="../js/CustomerModal.js"></script>
