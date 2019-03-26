<!-- Quickview - Add invoice -->
<div id="qv-invoice-add" class="quickview quickview-lg">
  <header class="quickview-header">
    <p class="quickview-title lead fw-400">Product Service Information</p>
    <span class="close" data-toggle="quickview"><i class="ti-close"></i></span>
  </header>
  <div class="quickview-body">
    <div style="padding:5px;">
      <form data-provide="validation" class="card" data-disable="false" id="ItemForm">
<div class="card-body">
      <input type="hidden" id="ItemId"/>
      <input type="hidden" id="ItemDetailId"/>
      <div class="form-group">
          <label class="require" for="ItemName">Name</label>
        <input type="text" class="form-control form-control-sm" id="ItemName" tabindex="1" name="ItemName" data-placement="left" data-provide="tooltip" title="Enter Product Name For Your Inventory Example:Thumsup,Parle" required autocomplete="off">
          <div class="invalidfeedback"></div>
      </div>
        <div class="row">
          <div class="col-sm-6">
              <div class="form-group">
                <label>SKU</label>
            <input type="text" class="form-control form-control-sm" id="ItemSKU" tabindex="2" name="ItemSKU" data-placement="left" data-provide="tooltip" title="SKU(Stock Keeping Unit) that identifies a product and helps you track inventory." autocomplete="off">

          </div>
        </div>
          <div class="col-sm-6">
            <div class="form-group">
                <label>HSN Code</label>
            <input type="text" class="form-control form-control-sm" id="ItemHSN" tabindex="3" name="ItemHSN" data-placement="right" data-provide="tooltip" title="HSN contains six digit uniform code" autocomplete="off">

          </div>
        </div>
        </div>
      <label title="Measure this item as per standard unit(UQC) defined under the GST rule Example KGS-kilograms select the correct code from dropdown" data-provide="tooltip" data-placement="left" class="require">Unit</label>
      <div class="form-group align-items-center">
        <span id="spanunit" ></span>
        <div class="invalidfeedback3"></div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label title="Select Size" data-provide="tooltip" class="require">Size Value</label>
          <div class="form-group">
              <span id="spansize"></span>
              <div class="invalidfeedback4"></div>
          </div>
        </div>
        <div class="col-sm-6">
          <h6 title="Select The Category" data-provide="tooltip">Packing Type</h6>
          <div class="form-group align-items-center">
            <span id="spancategory"></span>
          </div>
        </div>
      </div>

        <div class="h-40px"></div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
        <label class="require" for="ItemQuantity">Initial Quantity on Hand</label>
      <input type="text" class="form-control form-control-sm" id="ItemQuantity" required tabindex="7" autocomplete="off" onkeypress="isNumberKey(event)">

      <div class="invalidfeedback1"></div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="form-group">
        <label>Low Stock Alert</label>
    <input type="text" class="form-control form-control-sm" title="Low stock alert" tabindex="8" data-provide="tooltip" id="ItemReorderLabel" autocomplete="off">

  </div>
  </div>
</div>
<div class="row">
<div class="col-sm-6">
  <h6 title="Select The Category" data-provide="tooltip">Category</h6>
  <div class="form-group  align-items-center">
      <span id="spcategory"></span>
  </div>
</div>
<div class="col-sm-6">
  <h6 title="Select The Category" data-provide="tooltip">Tax</h6>
  <div class="form-group  align-items-center">
      <span id="sptax"></span>
  </div>
</div>
</div>


<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
          <label>Sales Price/Rate</label>
        <input type="text" class="form-control form-control-sm" id="ItemPrice" data-placement="top" tabindex="12" data-provide="tooltip" title="Enter Sale Price Example:20.08" autocomplete="off">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label>Packing Quantity</label>
        <input type="text" class="form-control form-control-sm" id="ItemSizeQty" data-placement="top" tabindex="13" data-provide="tooltip" title="Enter Number of Quantity available in Box,Caret Example:Thumsup caret Contain 24 Bottles Enter 24" autocomplete="off" required>
    </div>
  </div>

</div>
<div class="row">
  <div class="col-sm-6">
<div class="form-group ">
    <label>Sub Packing Quantity</label>
    <input type="text" class="form-control form-control-sm" id="ItemSizeSubQty" data-placement="top" tabindex="14" data-provide="tooltip" title="Enter Number of Quantity available in Sub Packing Example:Thumsup caret Contain 24 Bottles Enter 24" autocomplete="off" required>
    </div>
  </div>
  <div class="col-sm-6">
    <h6 title="Select The Suplier" data-provide="tooltip">Preferred Supplier</h6>
    <div class="form-group  align-items-center">
      <select title="Select supplier" data-provide="selectpicker" class="form-control form-control-sm" data-width="100%" id="SupplierId" tabindex="16" autocomplete="off">
        <?php include '../src/getSupplierNames.php';?>
        </select>
    </div>
  </div>
</div>
      <div class="form-group ">
          <label>Description</label>
        <textarea name="name" class="form-control form-control-sm" rows="2" id="ItemDescription" tabindex="15" autocomplete="off"></textarea>
      </div>
        <div class="h-40px"></div>
</div>
      <footer class="card-footer p-12 text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview" id="goback">Cancel</button>
        <button class="btn btn-flat btn-primary" type="button" id="formData" onClick="SaveItems();">Save and Close</button>
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
<script type="text/javascript" src="../js/CategoryType.js"></script>
<script type="text/javascript" src="../js/UnitModal.js"></script>
<script type="text/javascript" src="../js/SizeModal.js"></script>
<script type="text/javascript" src="../js/PackingType.js"></script>
<script type="text/javascript" src="../js/TaxModal.js"></script>
<script type="text/javascript" src="../js/validations.js"></script>
