<!-- Quickview - Add invoice -->
<div id="qv-invoice-add" class="quickview quickview-lg">
  <header class="quickview-header">
    <p class="quickview-title lead fw-400">Product Service Information</p>
    <span class="close"><i class="ti-close"></i></span>
  </header>
  <div class="quickview-body">
    <!-- <div class="quickview-block form-type-material"> -->
      <form data-provide="validation" data-disable="false" id="ItemForm">
      <div class="form-group row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-8">
            <label class="require" for="ItemName">Name</label>
        <input type="text" class="form-control form-control-sm" id="ItemName" name="ItemName" data-placement="left" data-provide="tooltip" title="Enter Product Name For Your Inventory Example:Thumsup,Parle" required>
          <div class="invalidfeedback"></div>
        </div>
      </div>
        <div class="row">
          <div class="col-sm-1">
          </div>
          <div class="col-sm-5">
              <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="ItemSKU" name="ItemSKU" data-placement="left" data-provide="tooltip" title="SKU(Stock Keeping Unit) that identifies a product and helps you track inventory.">
            <label>SKU</label>
          </div>
        </div>
          <div class="col-sm-5">
            <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="ItemHSN" name="ItemHSN" data-placement="right" data-provide="tooltip" title="HSN contains six digit uniform code">
            <label>HSN Code</label>
          </div>
        </div>
        <div class="col-sm-1">
        </div>
        </div>
      <h6 title="Measure this item as per standard unit(UQC) defined under the GST rule Example KGS-kilograms select the correct code from dropdown" data-provide="tooltip" data-placement="left">Unit</h6>
      <div class="form-group input-group align-items-center">
        <select title="Select Unit" data-provide="selectpicker" data-width="100%" onchange="openModel(this.value);" id="ItemUnit" class="form-control form-control-sm">
          <option>Website design</option>
          <option>PSD to HTML</option>
          <option>Website re-design</option>
          <option>UI Kit</option>
          <option>Full Package</option>
          <option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="1" id="add"> Add New Item </option>
        </select>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <h6 title="Select The Category" data-provide="tooltip" >Size Value</h6>
          <div class="form-group">
            <select title="Select Category" class="form-control form-control-sm" data-provide="selectpicker" data-width="100%" data-live-search="true" id="ItemSize">
              <option>Website design</option>
              <option>PSD to HTML</option>
              <option>Website re-design</option>
              <option>UI Kit</option>
              <option>Full Package</option>
              <option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="1" id="add2"> Add New Item </option>

            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <h6 title="Select The Category" data-provide="tooltip">Size Quantity</h6>
          <div class="form-group input-group align-items-center">
            <select title="Select Category" data-provide="selectpicker" data-width="100%" id="ItemSizeQty" >
              <option>Website design</option>
              <option>PSD to HTML</option>
              <option>Website re-design</option>
              <option>UI Kit</option>
              <option>Full Package</option>
              <option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="1" id="add3"> Add New Item </option>

            </select>
          </div>
        </div>
      </div>

        <div class="h-40px"></div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" class="form-control form-control-sm" id="ItemQuantity" required>
      <label class="require" for="ItemQuantity">Initial Quantity on Hand</label>
      <div class="invalidfeedback1"></div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="form-group">
    <input type="text" class="form-control form-control-sm" title="Low stock alert" data-provide="tooltip" id="ItemReorderLabel">
    <label>Low Stock Alert</label>
  </div>
  </div>
</div>
  <h6 title="Select The Category" data-provide="tooltip">Category</h6>
  <div class="form-group input-group align-items-center">
    <select title="Select Category" data-provide="selectpicker" data-width="100%" id="ItemCategory">
      <option>Website design</option>
      <option>PSD to HTML</option>
      <option>Website re-design</option>
      <option>UI Kit</option>
      <option>Full Package</option>
      <option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="1" id="add1"> Add New Item </option>
    </select>
  </div>
<h6 title="Select The Category" data-provide="tooltip">Tax</h6>
<div class="form-group input-group align-items-center">
  <select title="Select Category" data-provide="selectpicker" data-width="100%" class="form-control form-control-sm" id="ItemTax" >
    <option>Website design</option>
    <option>PSD to HTML</option>
    <option>Website re-design</option>
    <option>UI Kit</option>
    <option>Full Package</option>
    <option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="1" id="add4"> Add New Item </option>

  </select>
</div>
      <div class="form-group">
        <div class="input-group-input">
          <input type="text" class="form-control" id="ItemPrice">
          <label>Sales Price/Rate</label>
        </div>
      </div>
      <div class="form-group input-group">
        <div class="input-group-input">
        <textarea name="name" class="form-control" rows="2" id="ItemDescription"></textarea>
          <label>Description</label>
        </div>
      </div>
        <div class="h-40px"></div>
      <h6 title="Select The Suplier" data-provide="tooltip">Preferred Supplier</h6>
      <div class="form-group input-group align-items-center">
        <select title="Select supplier" data-provide="selectpicker" data-width="100%" id="ItemCategory">
          <option>Website design</option>
          <option>PSD to HTML</option>
          <option>Website re-design</option>
          <option>UI Kit</option>
          <option>Full Package</option>
          <option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="1" id="add1"> Add New Item </option>
        </select>
      </div>
      <footer class="p-12 text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview">Cancel</button>
        <button class="btn btn-flat btn-primary" type="submit" id="formData">Save and Close</button>
      </footer>
    </form>
  <!-- </div> -->
  </div>

</div>
<?php include 'UnitModal.php';?>
<!-- END Quickview - Add user -->
<script type="text/javascript" src="ItemModal.js"></script>
