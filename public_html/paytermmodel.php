
<div class="modal modal-center fade" id="PaytermModal" tabindex="-1">
  <div class="modal-dialog" style="height: 333px;">
    <div class="modal-header">
    </div>
    <div class="modal-content" style="border: 2px solid gray;">
    <form data-provide="validation" data-disable="false" id="PaytermData">
      <div class="modal-body">
       <div class="form-group"><h5 >Add New Payterm</h5></div>
        <div class="form-group">
            <label for="PaytermName" class="require">Payterm Value</label>
            <input type="text" class="form-control form-control-sm" id="PaytermValue" name="PaytermValue" data-placement="bottom" data-provide="tooltip" title="Payterm Value Example :NET 30,NET 45" onkeypress="return isNumberInt(event);" required>
            <div class="invalid-feedback"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-bold btn-pure btn-primary" onclick="addpayterm();">Save and close</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="../js/PayTermModal.js"></script>
