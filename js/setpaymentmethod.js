function addcustomerpayterm1(){
  var customername = $("#customername").val();
    // getplaceofsupply();
  if(customername===""){

  }
  else{
     displayPaymentTblData(customername);
    $.ajax({
        type: "POST",
        url: "../src/fetchaddressinfobyid.php",
        data:{
          custid:parseInt(customername)
        },
        success: function(msg) {

           var response = JSON.parse(msg);
           $("#phidecontactid").val(response['contactId']);
           $("#pbillingaddress").val(response['contactAddress']);
           $("#phiddenremainamount").val(response['RemainingAmount']);
        }
    });
  }
}
function addcustomerpayterm(){
  var customername = $("#customername").val();
  if(customername==="#ac"){
    // alert("modalopen");
    $('#CustomerModal').modal('show');
    $("#customername").val("");
  }
  else{
    // alert("modalelse");
    addcustomerpayterm1();
  }
}

function getpaymethodmethod()
{
var payterm='';
  payterm+='<select  class="form-control" data-provide="selectpicker" data-live-search="true"  title="Choose a terms" onchange="addpaymentmethod()" id="paymentmethod">';
    $.ajax({
        type: "POST",
        url: "../src/fetch_paymentmethod.php",
        success: function(msg) {


          payterm+=msg;
          payterm+='<option data-icon="fa fa-edit" style="font-weight: bold;  padding: 5px;color: #797878;border: 2px solid #71bd71;"  value="apm" >Add Payment Method</option>';
          payterm+='<option value=""></option>';
          payterm+='</select>';
          $("#setpaymentmethod").html(payterm);
        }
    });
}
function getdepositeto()
{
var payterm='';
  payterm+='<select  class="form-control" data-provide="selectpicker" data-live-search="true"  title="Choose a Deposit to" id="paymentdepositeto">';
    $.ajax({
        type: "POST",
        url: "../src/fetch_depositeto.php",
        success: function(msg) {
          // alert(msg);

          payterm+=msg;
          // payterm+='<option data-icon="fa fa-edit" style="font-weight: bold;  padding: 5px;color: #797878;border: 2px solid #71bd71;"  value="apm" >Add Payment Method</option>';
          payterm+='<option value=""></option>';
          payterm+='</select>';
          $("#setdepositeto").html(payterm);
          // $("#paymentdepositeto").val(23);
        }
    });
}

function addpaymentmethod()
{
  var paymentmethod = $("#paymentmethod").val();

  if(paymentmethod==='apm'){
     $('#PaymentModal').modal('show');
     $("#paymentmethod").val("");
  }
}


function addpaymethod(){
  var paymentmethod  = $("#paymentmethodval").val();
   // alert(paymentmethod);
  if(paymentmethod === ""){
      $('#paymentmethod').focus();
  }
  else {
    $.ajax({
      url:'../src/addNewPaymentmethod.php',
      type:'POST',
      data:({paymentmethod:paymentmethod}),
      dataType:'json',
      success:function(response){
        // alert(response);
        if(response['msg']){
          $('#PaymentModal').modal('hide');
          var param1 = "Payment Method "+response['paytype']+" Added successfully";
          app.toast(param1, {
            actionTitle: 'Success',
            // actionUrl: 'something',
            actionColor: 'success'
          });
          clear_paymentmethod();
          getpaymethodmethod();
        }

      }
    })
  }
}
function checkboxtrue(param){
  var hidepaymentamount = $("#hidepaymentamount"+param+"").val();
  var amtreceivedpayment= $("#amtreceivedpayment").val();
  var totsum =parseFloat(amtreceivedpayment)+parseFloat(hidepaymentamount);
  if(totsum<0){
    totsum = 0.0;
  }
  $("#displayamountreceived").html(totsum.toFixed(2));
  $("#amtreceivedpayment").val(totsum.toFixed(2));
  $("#spanamounttoapply").html(totsum.toFixed(2));
}
function checkboxfalse(param){
  var hidepaymentamount = $("#hidepaymentamount"+param+"").val();
  var amtreceivedpayment= $("#amtreceivedpayment").val();
  var totsum =parseFloat(amtreceivedpayment)-parseFloat(hidepaymentamount);
  if(totsum<0){
    totsum = 0.0;
  }
  var i=0,sum=0;
  var rows = $('#paymentTblBody tr').length;
  for(i=1;i<=rows;i++){
    var chechbxtrue = $("#paymenttranscheckbox"+i).prop("checked");
    if(chechbxtrue){
            sum = 1;
      }
  }
  // var spanamounttoapply = parseFloat($("#spanamounttoapply").text());
  //  if(spanamounttoapply===(parseFloat(amtreceivedpayment))){
  //    $("#spanamounttoapply").html("0.00");
  //  }else {
  //
  //  }
  if(sum===0){
      $("#spanamounttoapply").html("0.00");
  }
  else{
      $("#spanamounttoapply").html(totsum.toFixed(2));
  }

  $("#displayamountreceived").html(totsum.toFixed(2));
  $("#amtreceivedpayment").val(totsum.toFixed(2));

}
function paymentmodal(param){

  var chechbxtrue = $("#paymenttranscheckbox"+param).prop("checked");
  if(chechbxtrue){
        $("#paymentamount"+param).attr("readonly", false);
         checkboxtrue(param);
        // changepaymentamount(param);
    }
    else{
        checkboxfalse(param);
        $("#paymentamount"+param).attr("readonly", true);
          // changepaymentamount(param);
    }
}
function changepaymentamount(param){
  var hidepaymentamount = $("#hidepaymentamount"+param+"").val();
  // alert(hidepaymentamount);
  var paymentamount = $("#paymentamount"+param+"").val();

  if(paymentamount==""){
    paymentamount=0.00;
  }

  var amtreceivedpayment= $("#amtreceivedpayment").val();
  var totsum =parseFloat(amtreceivedpayment)-parseFloat(hidepaymentamount)+parseFloat(paymentamount);
  $("#displayamountreceived").html(totsum.toFixed(2));
  $("#amtreceivedpayment").val(totsum.toFixed(2));
  $("#hidepaymentamount"+param+"").val(paymentamount);
}
function checkamountreceivedpay(){
        // var rows = $('#paymentTblBody tr').length;
        $("#spanamounttocredit").html("0.00");
        var amtreceivedpayment = $("#amtreceivedpayment").val();
        // alert(amtreceivedpayment);
        if(amtreceivedpayment==""){
          amtreceivedpayment=0;
        }
        $("#displayamountreceived").html(amtreceivedpayment);
        var spanamounttoapply= parseFloat($("#spanamounttoapply").text());
        // alert(spanamounttoapply);
        if(parseFloat(amtreceivedpayment)>spanamounttoapply){
          var amountincredit = parseFloat(amtreceivedpayment)-spanamounttoapply;
          $("#spanamounttocredit").html(amountincredit.toFixed(2));
        }
        else {
           $("#spanamounttocredit").html("0.00");
        }
        // var i=0;
        // var sum =0;
        // for(i=1;i<=rows;i++){
        //   var chechbxtrue = $("#paymenttranscheckbox"+i).prop("checked");
        //   if(chechbxtrue){
        //         var checkval =$("#paymentamount"+i).val();
        //         sum = sum + parseFloat(checkval);
        //     }
        // }
        // if(sum > amtreceivedpayment){
        //   var param1="Please Enter More Amount";
        //     app.toast(param1, {
        //      actionTitle: 'warning',
        //      // actionUrl: 'something',
        //      actionColor: 'warning'
        //    });
        //     $("#amtreceivedpayment").val();
        // }
        // else {
             // var amountincredit = parseFloat(amtreceivedpayment);
             // $("#spanamounttocredit").html(amountincredit.toFixed(2));
        // }
}
function displayPaymentTblData(param){
    $("#paymentTblBody").empty();
    var  tbl = '';
    $.ajax({
            url:"../src/displayPaymentReceipt.php",
            type:"POST",
            dataType:"json",
            data:{custid:parseInt(param)},

            success:function(response){
             // alert(response);
              // var response = JSON.parse(response);
              var count = response.length;
              var j =0;
              var totsum  = 0.00;
              for (var i = 0; i < count; i++) {
                 j = i +1;
                 tbl += '<tr>';
                 // <input type="checkbox" name="paymentcheckbox" checked id="paymenttranscheckbox'+j+'"  value="'+response[i].TId+'" onclick="paymentmodal('+j+')"/>
                 tbl += '<td class="text-center" style="width: 2%"><input type="hidden" id="paymentransactionid'+j+'" value="'+response[i].TId+'"/>'+j+'</td>';
                 tbl += '<td class="text-left">Invoice #'+response[i].InvoiceNumber+'</td>';

                 tbl += '<td class="text-center" style="width: 10%"><span id="paymentduedate'+j+'"></span>'+response[i].DueDate+'</td>';
                 tbl += '<td class="text-center" style="width: 10%"><span id="paymentoriginalamt'+j+'"></span>'+response[i].Total+'</td>';
                 tbl += '<td class="text-center" style="width: 10%"><input type="hidden" id="paymentopenbal'+j+'" value="'+response[i].RemainingAmount+'"/>'+response[i].RemainingAmount+'</td>';
                 tbl += '<td class="text-center" style="width: 10%"><input type="hidden" id="hidepaymentamount'+j+'" value="'+response[i].RemainingAmount+'"/><input type="text" class="form-control form-control-sm" id="paymentamount'+j+'" style="padding-top: 4px;padding-bottom: 3px;padding-right: 0px;padding-left: 0px;text-align: center;font-size:initial;" value="'+response[i].RemainingAmount+'" onchange="changepaymentamount('+j+')" onkeypress="return isNumberKey(event);" readonly/></td>';
                 tbl += '</tr>';
                 totsum = totsum + parseFloat(response[i].RemainingAmount);
              }

              $("#amtreceivedpayment").val(totsum);
              $("#displayamountreceived").html(totsum);
              $("#spanamounttoapply").html(totsum);
              $("#spanamounttocredit").html("0.00");
              $("#paymentTblBody").html(tbl);
              // if ($.fn.DataTable.isDataTable("#paymentamountTbl") && count==0) {
              //   $('#paymentamountTbl').DataTable().clear().destroy();
              //   }

               $('#paymentamountTbl').DataTable({
                 searching: true,
                 retrieve: true,
                 "bPaginate": false,
                 // "bLengthChange": false,
                 // "bFilter": true,
                 "bInfo": false,
    // "             bAutoWidth": false
                 // bPaginate: $('tbody tr').length>10,
                 order: [],
                 columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5] } ],
                 dom: 'Bfrtip',
                 buttons: [],
                 destroy: true
               });

             }
            });
}
function clear_paymentmethod()
{
$("#paymentmethod").val('');

}
function savepaymentinvoice(){
  var customername = $("#customername").val();
  if(customername===""){
    var param1="Please Select Customer Name";
      app.toast(param1, {
       actionTitle: 'warning',
       // actionUrl: 'something',
       actionColor: 'warning'
     });
  }
  else{
    var amtreceivedpayment = $("#amtreceivedpayment").val();
    if(parseFloat(amtreceivedpayment)>0){
      var rows = $('#paymentTblBody tr').length;
    // alert(rows);

      // $.each($("input[name='paymentcheckbox']:checked"), function(){
      // transactionidarray.push($(this).val());
      // });

     // alert(transactionidarray);
      var transactionidarray = [];
      transactionidarray.push(0);
      var amountpaymentarray = [];
      amountpaymentarray.push(0);
      var paymentopenbalarray = [];
      paymentopenbalarray.push(0);
      for(i=1;i<=rows;i++){
        // var chechbxtrue = $("#paymenttranscheckbox"+i).prop("checked");
        // if(chechbxtrue){

              var paymentransactionid =$("#paymentransactionid"+i).val();
              var checkval =$("#paymentamount"+i).val();
              var paymentopenbal = parseFloat($("#paymentopenbal"+i).val());
              // alert(paymentopenbal);
              amountpaymentarray.push(checkval);
              paymentopenbalarray.push(paymentopenbal);
              transactionidarray.push(paymentransactionid);
          // }
      }
      // alert(amountpaymentarray);
      var phiddenformid = $("#phiddenformid").val();
      var phiddenformtype = $("#phiddenformtype").val();
      var phiddentransactionid = $("#phiddentransactionid").val();
      var paymentemailaddress = $("#paymentemailaddress").val();
      var paymentrcpdate = $("#paymentrcpdate").val();
      var paymentmethod = $("#paymentmethod").val();
      if(paymentmethod==""){
        paymentmethod = 0;
      }
      var paymentReferenceno = $("#paymentReferenceno").val();
      var paymentdepositeto = $("#paymentdepositeto").val();
      var memopayment = $("#memopayment").val();
      var phidecontactid = $("#phidecontactid").val();
      var spanamounttoapply = parseFloat($("#spanamounttoapply").text());
      var spanamounttocredit  = parseFloat($("#spanamounttocredit").text());
      $.ajax({
          async: false,
          type: "POST",
          url: "../src/savepaymenttransactionmaster.php",
          data:{
            formid:phiddenformid,
            formtype:phiddenformtype,
            htransactionid:phiddentransactionid,
            customername:customername,
            transactionidarray:transactionidarray,
            amountpaymentarray:amountpaymentarray,
            paymentopenbalarray:paymentopenbalarray,
            amtreceivedpayment:amtreceivedpayment,
            paymentemailaddress:paymentemailaddress,
            paymentrcpdate:paymentrcpdate,
            paymentmethod:paymentmethod,
            paymentReferenceno:paymentReferenceno,
            paymentdepositeto:paymentdepositeto,
            phidecontactid:phidecontactid,
            spanamounttoapply:spanamounttoapply,
            spanamounttocredit:spanamounttocredit,
            memopayment:memopayment
          },
          success: function(msg) {
          // alert(msg);
            var response = JSON.parse(msg);

            if(response['msg']){
              // alert(response['msg']);
              var param1="Payment Receipt "+response['ItemDetailId']+" Generated successfully";
              app.toast(param1, {
                actionTitle: 'Success',
                // actionUrl: 'something',
                actionColor: 'success'
              });
                $("#modal-payment .close").click();
            }
          }
      });
    }
    else {
      var param1="Please Enter Amount Recieved";
        app.toast(param1, {
         actionTitle: 'warning',
         // actionUrl: 'something',
         actionColor: 'warning'
       });
    }

  }
}
