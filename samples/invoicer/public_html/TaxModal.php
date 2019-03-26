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
        <div class="form-group">
            <label for="CategoryName" class="require">Tax Type</label>
          <input type="text" class="form-control form-control-sm" id="TaxType" name="TaxType" data-placement="bottom" data-provide="tooltip" title="Example:VAT,GST" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="CategoryName" class="require">Tax(%)</label>
          <input type="text" class="form-control form-control-sm" id="TaxPercent" name="TaxPercent" data-placement="bottom" data-provide="tooltip" title="Example:18%,14%" required>
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
<script type="text/javascript" src="TaxModal.js"></script>
