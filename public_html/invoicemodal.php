
<!-- modal -->
<div id="modal-invoice"
     class="modal modal-fill fade animated fadeInDown"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="hiddenformid" />
        <input type="hidden" id="hiddenformtype" />
        <input type="hidden" id="hiddentransactionid" />
        <input type="hidden" id="remainamount" />
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form data-provide="validation" id="invoiceform" >
        <div class="row ">
          <div class="col-md-6">
            <div class="row">


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input-normal" class="require"><strong>Customer Name</strong></label>
                      <span id="setcustomer"></span>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <hr class="d-md-none">

                    <div class="form-group">
                      <label><strong>Email Address</strong></label>
                      <div class="input-group">

                      <input type="text" class="form-control" placeholder="Email address" title="Email address" aria-describedby="basic-addon2" id="emailaddress">
                      <span class="input-group-addon" id="basic-addon2"><i class="ti-email"></i></span>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-4">

                  </div>
                </div>

                  <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input-normal"><strong>Billing address</strong></label>
                      <input type="hidden" id="hidecontactid"/>
                      <textarea class="form-control" id="billingaddress" rows="3"></textarea>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input-normal"><strong>Place Of Supply</strong></label>
                      <!-- <span id="setplacesupply"></span> -->
                      <select class="form-control" data-provide="selectpicker" data-live-search="true"  title="Choose Place Of Supply" id="placeofsupply">
                     <option value="Pune">Pune</option>
                        <option value="Dhule">Dhule</option>
                        <option value="Jalgoan">Jalgoan</option>
                      </select>

                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input-normal" class="require"><strong>Terms</strong></label>
                      <span id="setterms"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="input-normal" class="require"><strong>Invoice Date</strong></label>
                      <div class="input-group">
                      <input type="date" class="form-control"  id="invoicedate" value="<?php echo date('Y-m-d'); ?>" onchange="addterms()">
                      <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                      </div>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="require"><strong>Due Date</strong></label>
                        <div class="input-group">
                      <input type="date" class="form-control"  id="duedate" value="<?php echo date('Y-m-d'); ?>" readonly>
                      <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                      </span>
                  </div>
                  </div>
                  </div>


                </div>



      </div>
        <div class="col-md-6">
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
      <th class="text-center">
        <!-- <button id="addNewRow" class="btn btn-primary btn-sm">Add New Row</button> -->
        <button id="addNewRow" type="button" title="Add Items" class="btn btn-float btn-sm btn-primary"  data-provide="tooltip" data-placement="left" ><i class="ti-plus"></i></button>

      </th>
      </div>
      </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <table class="table  table-bordered table-striped table-hover table-condensed " id="DyanmicTable">
            	<thead>
            		<tr>
            			<th class="text-left" style="width: 5%">
            				#
            			</th>
                  <th class="text-left" style="width: 20%">
            				PRODUCT/SERVICE
            			</th>
                  <th class="text-left" style="width: 10%">
            				HSN/SAC
            			</th>
                  <th class="text-left" >
            				UNIT
            			</th>

                  <th class="text-left" style="width: 8%">
                    QTY
                  </th>
                  <th class="text-left" style="width: 8%">
                    B.QTY
                  </th>
                  <th class="text-left" style="width: 8%">
                    RATE
                  </th>
                  <th class="text-center" style="width: 8%">
                    DISCOUNT
                  </th>
            			<th class="text-center" style="width: 8%">
            				AMOUNT
            			</th>

            			<th class="text-center" style="width: 8%">
            				TAX
            			</th>
            		</tr>
            	</thead>
            	<tbody>
            	</tbody>
            </table>

      </div>
        </div>

        <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                      <label for="textarea"><strong>Message displayed on invoice</strong></label>
                      <textarea class="form-control" id="remark" rows="4"></textarea>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <table class="table table-responsive" id="GstTable">
                  <thead>
                    <tr>
                      <th ><strong>Subtotal</strong></th>
                      <th ><strong><span id="subtotal"></span></strong></th>
                    </tr>
                  </thead>
                  <tbody id="gsttaxtable">
                  </tbody>
                  <tfoot>
                    <tr id="hidediscount" style="display:none">
                      <th><strong>Discount(%)</strong></th>
                      <th>
                      <input type="text" class="form-control" value="0.00" placeholder="Discount" id="discount" onchange="setdiscount()" onkeypress="return isNumberKey(event);"></th>
                    </tr>
                    <tr>
                      <th><strong>Total</strong></th>
                      <th><span id="total"></span></th>
                    </tr>
                    <tr>
                      <th><strong>Final Total</strong></th>
                      <th><span id="finaltotal"></span></th>
                    </tr>
                    <tr>
                      <th><strong>Balance Due</strong></th>
                      <th><span id="balancedue"></span></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-label btn-info" data-dismiss="modal">
          <label><i class="ti-arrow-left"></i></label>
           close
         </button>

        <button type="button" class="btn btn-label btn-primary" onclick="saveinvoice();">
          <label><i class="ti-check"></i></label>
           Submit
        </button>
      </div>
    </div>
  </div>
</div>
