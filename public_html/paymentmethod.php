<div class="modal modal-center fade" id="PaymentModal" tabindex="-1">
  <div class="modal-dialog" style="height: 453px;">
    <div class="modal-header">
    </div>
    <div class="modal-content" style="border: 2px solid gray;">
    <form data-provide="validation" data-disable="false" id="CustomerData" method="POST" >
      <div class="modal-body">
       <div class="form-group"><h5 >Add New Payment Method</h5></div>
        <div class="form-group">
            <label for="First Name" class="require">Payment Method</label>
            <input type="text" class="form-control form-control-sm" id="paymentmethodval" name="paymentmethod" data-placement="bottom" data-provide="tooltip" autocomplete="off" required>
            <div class="invalid-feedback"></div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal" onclick="clear_paymentmethod();">Close</button>
        <button type="button" class="btn btn-bold btn-pure btn-primary" onclick="addpaymethod();"   >Save and close</button>
      </div>
    </form>
    </div>
  </div>
</div>
