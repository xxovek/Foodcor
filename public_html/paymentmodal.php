<div id="modal-payment"
     class="modal modal-fill fade animated fadeInDown"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="phiddenformid" />
        <input type="hidden" id="phiddenformtype" />
        <input type="hidden" id="phiddentransactionid" />
          <!-- <input type="hidden" id="remainamount" /> -->
        <input type="hidden" id="phiddenremainamount" />
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
                      <span id="setcustomer1"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <hr class="d-md-none">
                    <div class="form-group">
                      <label><strong>Email Address</strong></label>
                      <div class="input-group">

                      <input type="text" class="form-control" placeholder="Email address" title="Email address" aria-describedby="basic-addon2" id="paymentemailaddress">
                      <span class="input-group-addon" id="basic-addon2"><i class="ti-email"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>

              </div>
              <div class="col-md-6">
              <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6" style="text-align: right;">
                  <label><strong style="font-weight: bolder;">AMOUNT RECEIVED</strong></label>
                  <div class="form-group">
                    <h2>&#8377; <span id="displayamountreceived"></span></h2>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="row ">
              <div class="col-md-6">
                  <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input-normal"><strong>Billing address</strong></label>
                      <input type="hidden" id="phidecontactid"/>
                      <textarea class="form-control" id="pbillingaddress" rows="3" readonly></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="input-normal" class="require"><strong>Payment Date</strong></label>
                      <div class="input-group">
                      <input type="date" class="form-control"  id="paymentrcpdate" value="<?php echo date('Y-m-d'); ?>" >
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
            <div class="row ">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input-normal" class="require" ><strong>Payment Method</strong></label>
                      <span id="setpaymentmethod"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><strong>Reference no.</strong></label>
                      <input type="text" class="form-control" placeholder="Reference No" title="Reference No" aria-describedby="basic-addon2" id="paymentReferenceno">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group" class="require">
                      <label><strong>Deposit to</strong></label>
                      <span id="setdepositeto"></span>
                      <!-- <input type="text" class="form-control" placeholder="Email address" title="Email address" aria-describedby="basic-addon2" id="paymentemailaddress"> -->
                    </div>
                  </div>
                </div>



      </div>
      <div class="col-md-6">
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3" style="text-align: left;">
          <label><strong >AMOUNT RECEIVED</strong></label>
          <div class="form-group">
              <input type="text" class="form-control" id="amtreceivedpayment" onkeypress="return isNumberKey(event);" onchange="checkamountreceivedpay()" />
          </div>
        </div>
      </div>
      </div>

      </div>

      <div class="row">
          <div class="col-md-12">
            <table class="table  table-bordered table-striped table-hover table-condensed" id="paymentamountTbl">
            	<thead>
            		<tr>
            			<th class="text-center" style="width: 2%">
            			 NO
            			</th>
                  <th class="text-left" >
            				DESCRIPTION
            			</th>

                  <th class="text-center" style="width: 10%">
            				DUE DATE
            			</th>
                  <th class="text-center" style="width: 10%">
                    ORIGINAL AMOUNT
                  </th>
                  <th class="text-center" style="width: 10%">
                    OPEN BALANCE
                  </th>
                  <th class="text-center" style="width: 10%">
                    PAYMENT
                  </th>
            			<!-- <th class="text-center" style="width: 10%">
            				ACTION
            			</th> -->
            		</tr>
            	</thead>
            	<tbody id="paymentTblBody">
            	</tbody>
            </table>

      </div>
        </div>

        <div class="row" style="padding-top: 10px;">
            <div class="col-md-4">
              <div class="form-group">
                      <label for="textarea"><strong>Memo</strong></label>
                      <textarea class="form-control" id="memopayment" rows="4"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              </div>
            </div>
            <div class="col-md-2">
              <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <h6><strong>Amount To Apply</strong></h6>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <h6><strong> &#8377; <span id="spanamounttoapply"></span></strong></h6>
            </div>
          </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
            <h6><strong>Amount To Credit</strong></h6>
            </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <h6><strong> &#8377; <span id="spanamounttocredit"></span></strong></h6>
          </div>
        </div>
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

        <button type="button" class="btn btn-label btn-primary" onclick="savepaymentinvoice();">
          <label><i class="ti-check"></i></label>
           Submit
        </button>
      </div>
    </div>
  </div>
</div>
