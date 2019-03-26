<div class="modal modal-center fade" id="ItemModal" tabindex="-1">
  <div class="modal-dialog" style="height: 453px;">
    <div class="modal-header">
        <input type="hidden" id="hiddenitemnameid"/>
    </div>
    <div class="modal-content" style="border: 2px solid gray;">
    <form data-provide="validation" data-disable="false" id="ItemData" method="POST" >
      <div class="modal-body">
       <div class="form-group"><h5 >Add New Item</h5></div>
        <div class="form-group">
            <label for="Item Name" class="require">Item Name</label>
            <input type="text" class="form-control form-control-sm" id="itemname" name="itemname" data-placement="bottom" data-provide="tooltip" autocomplete="off" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="Item Quantity" class="require">Item Quantity</label>
            <input type="text" class="form-control form-control-sm" id="itemquantity" name="itemquantity" data-placement="bottom" onkeypress="return isNumberInt(event);" data-provide="tooltip" autocomplete="off" required>
            <div class="invalid-feedback"></div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal" onclick="clear_items();">Close</button>
        <button type="button" class="btn btn-bold btn-pure btn-primary" onclick="additemsinfo();"   >Save and close</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="../js/invoicetable.min.js"></script>
