<div class="modal modal-center fade" id="TaxModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
          <form data-provide="validation" data-disable="false" id="TaxData">
      <div class="modal-header">
        <h5 class="modal-title">Add New Tax</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- <input type="hidden" id="TaxId"/> -->
        <div class="form-group">
            <label class="require" for="TaxName">Tax Name</label>
          <input type="text" onkeypress="return AlphaBets(event,this.value);" class="form-control form-control-sm" id="TaxName" tabindex="1" name="TaxName" data-placement="left" data-provide="tooltip" title="Enter Tax Name" required autocomplete="off">
            <div class="invalidTaxName"></div>
        </div>
        <div class="form-group">
            <label>Description</label>
          <textarea name="TaxDescription" class="form-control form-control-sm" rows="2" id="TaxDescription" tabindex="2" autocomplete="off"></textarea>
        </div>
        <div class="form-group">
            <label for="CategoryName" class="require">Tax Type</label>
          <select data-provide="selectpicker" class="form-control form-control-sm" id="TaxType"  name="TaxType"  title="select Tax Type" required>
            <option value="GST">GST</option>
            <option value="VAT">VAT</option>
            <option value="Service Tax">Service Tax</option>
            <option value="Swachh Bharat Cess">Swachh Bharat Cess</option>
            <option value="Krishi Kalyan Cess">Krishi Kalyan Cess</option>
            <option value="CST">CST</option>
          </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="CategoryName" class="require">Tax(%)</label><span id="taxavl" style="float:right"></span>
          <input type="text" class="form-control form-control-sm" id="TaxPercent" name="TaxPercent" onchange="checktaxaval()" onkeypress="return isNumberKey1(event);" data-placement="bottom" data-provide="tooltip" title="Example:18,5" required>
            <div class="invalid-feedback"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-bold btn-pure btn-primary">Save and close</button>
      </div>
    </form>
    </div>
  </div>
</div>
