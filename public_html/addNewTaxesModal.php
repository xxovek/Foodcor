<!-- Quickview - Add invoice -->
<div id="qv-Taxes-addDiv" class="quickview quickview-lg">
  <header class="quickview-header">
    <p class="quickview-title lead fw-400">Taxes Information</p>
    <span class="close" data-toggle="quickview"><i class="ti-close"></i></span>
  </header>
  <div class="quickview-body">
    <div style="padding:5px;">
      <form class="card" data-provide="validation" data-disable="false" id="NewTaxForm">
<div class="card-body">
    <input type="hidden" id="TaxId"/>

  <div class="form-group">
      <label class="require" for="TaxName">Tax Name</label>
    <input type="text" onkeypress="return AlphaBets(event,this.value);" class="form-control form-control-sm" id="TaxName" tabindex="1" name="TaxName" data-placement="left" data-provide="tooltip" title="Enter Tax Name" required autocomplete="off">
      <div class="invalidTaxName"></div>
  </div>
    <div class="h-30px"></div>

  <div class="form-group">
      <label>Description</label>
    <textarea name="TaxDescription" class="form-control form-control-sm" rows="2" id="TaxDescription" tabindex="2" autocomplete="off"></textarea>
  </div>
    <div class="h-30px"></div>

    <div class="form-group">
        <label for="CategoryName" class="require">Tax Type</label>
        <select data-provide="selectpicker" class="form-control form-control-sm" id="TaxType" name="TaxType"  required>
          <option value="">Select Tax Type</option>

          <option value="GST">GST</option>
          <option value="VAT">VAT</option>
          <option value="Service Tax">Service Tax</option>
          <option value="Swachh Bharat Cess">Swachh Bharat Cess</option>
          <option value="Krishi Kalyan Cess">Krishi Kalyan Cess</option>
          <option value="CST">CST</option>
        </select>
      <!-- <input type="text" class="form-control form-control-sm" id="TaxType" name="TaxType" data-placement="bottom" data-provide="tooltip" title="Example:VAT,GST" required> -->
        <div class="invalid_TaxType"></div>
    </div>


    <!-- <div class="h-30px"></div> -->
<!-- <div class="row"> -->
<!-- <div class="col-sm-4">
<div class="form-group">

    <input type="checkbox" onclick="fun();" id="check1"  value=""> Percent(%)
  </div>
  <div class="invalid-feedback"></div>
</div>
<div class="h-30px"></div>
<br>
<div class="col-sm-4">
<div class="form-group">

  <input type="checkbox" onclick="fun();" id="check1"  value="">  Non Percent
</div>
<div class="invalid-feedback"></div> -->
<!-- </div> -->


<div class="row">

</div>

<div class="form-group" id="TaxValueInputDiv">
<!-- <div class="flexbox">
<label class="custom-control custom-checkbox">
  <input  type="checkbox" class="custom-control-input require" tabindex="4" checked>
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Percent(%)</span>
</label>

</div> -->

  <label class="require" for="TaxPercent">Tax(%)</label>
<input type="text"  onkeypress="return isNumberKey1(event);"  class="form-control form-control-sm require" id="TaxPercent" tabindex="5" name="TaxPercent" data-placement="left" data-provide="tooltip" title="Enter Tax value in %" required autocomplete="off">
<div class="invalidTaxValue"></div>
</div>

<!-- <div class="h-30px"></div> -->
<!--
<div class="flexbox">
  <label class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" >
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">Percent(%)</span>
  </label>
</div> -->


        <div class="h-30px"></div>
</div>

<div class="row"></div>
<!-- <div class="h-60px"></div> -->
<div class="h-90px"></div>
<div class="h-90px"></div>
<div class="h-90px"></div>


      <footer class="card-footer text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview" id="goback">Cancel</button>
        <button class="btn btn-flat btn-primary" type="button" id="formData" onClick="SaveTaxes();">Save and Close</button>
      </footer>
    </form>
  </div>
  </div>
</div>

<!-- <script type="text/javascript" src="../js/TaxModal.js"></script> -->
<script type="text/javascript" src="../js/validations.js"></script>
