<!-- Quickview - Add invoice -->
<div id="qv-invoice-add" class="quickview quickview-lg">
  <header class="quickview-header">
    <p class="quickview-title lead fw-400">Product Service Information</p>
    <span class="close"><i class="ti-close"></i></span>
  </header>
  <div class="quickview-body">
    <div class="quickview-block form-type-material">
      <form data-provide="validation" data-disable="false" id="ItemForm">
      <div class="form-group">
        <input type="text" class="form-control form-control-sm" id="ItemName" tabindex="1" name="ItemName" data-placement="left" data-provide="tooltip" title="Enter Product Name For Your Inventory Example:Thumsup,Parle" required>
          <label class="require" for="ItemName">Name</label>
          <div class="invalidfeedback"></div>
      </div>
        <div class="row">
          <div class="col-sm-6">
              <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="ItemSKU" tabindex="2" name="ItemSKU" data-placement="left" data-provide="tooltip" title="SKU(Stock Keeping Unit) that identifies a product and helps you track inventory.">
            <label>SKU</label>
          </div>
        </div>
          <div class="col-sm-6">
            <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="ItemHSN" tabindex="3" name="ItemHSN" data-placement="right" data-provide="tooltip" title="HSN contains six digit uniform code">
            <label>HSN Code</label>
          </div>
        </div>
        </div>
      <h6 title="Measure this item as per standard unit(UQC) defined under the GST rule Example KGS-kilograms select the correct code from dropdown" data-provide="tooltip" data-placement="left">Unit</h6>
      <div class="form-group input-group align-items-center">
        <select  title="Select Unit" data-provide="selectpicker" tabindex="4" data-width="100%" onchange="UnitModal(this.value);" id="ItemUnit" class="form-control form-control-sm">
        <?php include '../src/getUnitNames.php';?>
        </select>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <h6 title="Select Size" data-provide="tooltip" >Size Value</h6>
          <div class="form-group">
            <select title="Select Size" class="form-control form-control-sm" tabindex="5" data-provide="selectpicker" data-width="100%" data-live-search="true" id="ItemSize" onchange="SizeModal(this.value);">
              <?php include '../src/getSizeValues.php';?>  </select>
          </div>
        </div>
        <div class="col-sm-6">
          <h6 title="Select The Category" data-provide="tooltip">Packing Type</h6>
          <div class="form-group input-group align-items-center">
            <select title="Select Category" data-provide="selectpicker" tabindex="6" data-width="100%" id="PackingTypeId" onchange="PackingType(this.value);" >
                <?php include '../src/getPackingQuantity.php';?>  </select>
            </select>
          </div>
        </div>
      </div>

        <div class="h-40px"></div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" class="form-control form-control-sm" id="ItemQuantity" required tabindex="7">
      <label class="require" for="ItemQuantity">Initial Quantity on Hand</label>
      <div class="invalidfeedback1"></div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="form-group">
    <input type="text" class="form-control form-control-sm" title="Low stock alert" tabindex="8" data-provide="tooltip" id="ItemReorderLabel">
    <label>Low Stock Alert</label>
  </div>
  </div>
</div>
  <h6 title="Select The Category" data-provide="tooltip">Category</h6>
  <div class="form-group input-group align-items-center">
    <select title="Select Category" data-provide="selectpicker" data-width="100%" tabindex="9" id="ItemCategory" name="ItemCategory" onchange="CategoryType(this.value);">
  <?php include '../src/getCategory.php';?>
 </select>

  </div>
<h6 title="Select The Category" data-provide="tooltip">Tax</h6>
<div class="form-group input-group align-items-center">
  <select title="Select Category" data-provide="selectpicker" data-width="100%" tabindex="10" class="form-control form-control-sm" id="ItemTax" onchange="TaxModal(this.value);">
      <?php include '../src/getTaxValues.php';?>
    </select>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <div class="input-group-input">
        <input type="text" class="form-control" id="ItemPrice" data-placement="top" tabindex="11" data-provide="tooltip" title="Enter Sale Price Example:20.08">
        <label>Sales Price/Rate</label>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <div class="input-group-input">
        <input type="text" class="form-control" id="ItemSizeQty" data-placement="top" tabindex="12" data-provide="tooltip" title="Enter Number of Quantity available in Box,Caret Example:Thumsup caret Contain 24 Bottles Enter 24">
        <label>Packing Quantity</label>
      </div>
    </div>
  </div>

</div>

      <div class="form-group input-group">
        <div class="input-group-input">
        <textarea name="name" class="form-control" rows="2" id="ItemDescription" tabindex="13"></textarea>
          <label>Description</label>
        </div>
      </div>
        <div class="h-40px"></div>
      <h6 title="Select The Suplier" data-provide="tooltip">Preferred Supplier</h6>
      <div class="form-group input-group align-items-center">
        <select title="Select supplier" data-provide="selectpicker" data-width="100%" id="SupplierId" tabindex="14">
          <option>Website design</option>
          <option>PSD to HTML</option>
          <option>Website re-design</option>
          <option>UI Kit</option>
          <option>Full Package</option>
          <option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="1" id="add1"> Add New Item </option>
        </select>
      </div>
      <footer class="p-12 text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview" id="goback">Cancel</button>
        <button class="btn btn-flat btn-primary" type="submit" id="formData" onclick="SaveItems()">Save and Close</button>
      </footer>
    </form>
  </div>
  </div>

</div>
<?php include 'UnitModal.php';?>
<?php include 'SizeModal.php';?>
<?php include 'PackingModal.php';?>
<?php include 'categoryModal.php';?>
<?php include 'TaxModal.php';?>
<!-- END Quickview - Add user -->
<script type="text/javascript" src="../js/ItemModal.js"></script>
