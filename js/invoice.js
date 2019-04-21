
function addcustomer1(){
  var customername = $("#customername").val();
    getplaceofsupply();
  if(customername===""){

  }
  else{
    $.ajax({
        type: "POST",
        url: "../src/fetchaddressinfobyid.php",
        data:{
          custid:parseInt(customername)
        },
        success: function(msg) {
           // alert(msg);
           var response = JSON.parse(msg);
           $("#hidecontactid").val(response['contactId']);
           $("#billingaddress").val(response['contactAddress']);
           $("#remainamount").val(response['RemainingAmount']);
        }
    });
  }
}
function getplaceofsupply()
{
    var customername = $("#customername").val();
    var placeofsupply='';
    $.ajax({
        type: "POST",
        url:"../src/fetchcityinfobyid.php",
        data:{
          custid:parseInt(customername)
        },
        success: function(msg) {
          // alert(msg);
          if(msg===""){

          }
          else {
          }
        }
    });
}
// function setcurrentdate(){
//   var t = new Date();
//   t.setDate(t.getDate());
//   var month = "0"+(t.getMonth()+1);
//   var date = "0"+t.getDate();
//   month = month.slice(-2);
//   date = date.slice(-2);
//   var date1 = date +"/"+month +"/"+t.getFullYear();
//   alert(date1);
//   var today = new Date();
//   alert(today);
//   document.getElementById("invoicedate").value = "2014-02-09";
//   // $("#invoicedate").val(date1);
//   $("#duedate").val(date1);
// }
function addDays(n){
    var invoicedate = document.getElementById('invoicedate').value;
    if(invoicedate===""){
    }
    else
    {
    var t = new Date(invoicedate);
    t.setDate(t.getDate() + parseInt(n));
    var month = "0"+(t.getMonth()+1);
    var date = "0"+t.getDate();
    month = month.slice(-2);
    date = date.slice(-2);
    var date1 = t.getFullYear() +"-"+month +"-"+date;
    // alert(typeof(date1));
   $('#duedate').val(date1);
    }
}
function addterms(){
  var param = $("#terms").val();
   // alert(param);
  if(param===""){
    param=0;
  }
  if(param==='at'){
     $('#PaytermModal').modal('show');
     $("#terms").val("");
  }
  else{
    addDays(param);
  }

}
function addcustomer(){
  var customername = $("#customername").val();
  if(customername==="#ac"){
    $('#CustomerModal').modal('show');
    $("#customername").val("");
  }
  else{

    addcustomer1();
  }
}



function isNumberInt(event) {
   var charCode = (window.event) ? event.keyCode  : event.which ;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function isNumberKey(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start === 0)) {
  eve.preventDefault();
}

// this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
$('.filterme').keyup(function(eve) {
  if ($(this).val().indexOf('.') === 0) {
    $(this).val($(this).val().substring(1));
  }
});
    // this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
}
function clearmodalfields(){
  $('#customername').val("").trigger('change');
  $('#terms').val("").trigger('change');
  $('#placeofsupply').val("").trigger('change');
  $('#billingaddress').val("");
  $('#duedate').val("");
  $('#emailaddress').val("");
  $('#remark').val("");
  var rows = $('#DyanmicTable tbody tr').length;
  var i=0;
  $('#DyanmicTable tbody td:nth-child(1)').each(function () {
    var value = parseInt($(this).html());
    $("#rem"+value).remove();
    });
    $("#gsttaxtable").empty();
    $('#subtotal').text("");
    $('#total').text("");
    $('#finaltotal').text("");
    $('#balancedue').text("");
    $("#hidediscount").hide();
}
function savetransactiondetails(param,param1){
  $('#customername').val("").trigger('change');
  $('#terms').val("").trigger('change');
  $('#placeofsupply').val("").trigger('change');
  $('#billingaddress').val("");
  $('#duedate').val("");
  $('#emailaddress').val("");
  $('#remark').val("");

  $('#subtotal').text("");
  $('#total').text("");
  $('#finaltotal').text("");
  $('#balancedue').text("");
  $("#hidediscount").hide();
  var transactionId = param;
  var rows = $('#DyanmicTable tbody tr').length;
  var i=0;
  if(rows>0){
  $('#DyanmicTable tbody td:nth-child(1)').each(function () {
        i++;
        var value = parseInt($(this).html());

        var itemdetailid = $("#itemdetailid"+value).val();
        // var itemname = $('#itemname'+value).val();
        // var desc = $('#desc'+value).val();

        // var hsn = $('#hsn'+value).val();
        var qty = $('#qty'+value).val();
        var billingqty = $('#billingqty'+value).val();
        var rate = $('#rate'+value).val();
        var itemdiscount = $('#itemdiscount'+value).val();
        var itemunits = $("#itemunits"+value).val();
        var unitsubpackingqty = parseInt($("#unitsubpackingqty"+value).val());
        var unitpackingqty =parseInt($("#unitpackingqty"+value).val());
        var unitremainqty = parseInt($("#unitremainqty"+value).val());
        var hiddenqtyonhand   = parseInt($("#hiddenqtyonhand"+value).val());
        // var amount = $('#amount'+value).val();
        var tax = $('#tax'+value).val();
        // alert(tax);
        var formid = $("#hiddenformid").val();
        var formtype = $("#hiddenformtype").val();
        var htransactionid = $("#hiddentransactionid").val();

        $.ajax({
            async: false,
            type: "POST",
            url: "../src/savetransactiondetails.php",
            data:{
              formid:formid,
              formtype:formtype,
              hidetransactionid:htransactionid,
              transactionId:transactionId,
              itemdetailid:itemdetailid,
              // desc:desc,
              qty:qty,
              billingqty:billingqty,
              rate:rate,
              itemdiscount:itemdiscount,
              itemunits:itemunits,
              unitsubpackingqty:unitsubpackingqty,
              unitpackingqty:unitpackingqty,
              unitremainqty:unitremainqty,
              hiddenqtyonhand:hiddenqtyonhand,
              tax:tax
            },
            success: function(msg) {
               // alert(msg);
              // var response = JSON.parse(msg);
              // var count = Object.keys(response).length;
              // if(count>0){
              //    // alert("ID:"+response['ItemDetailId']);
              //    savetransactiondetails(response['ItemDetailId']);
              // }
            }
        });
        $("#rem"+value).remove();
        $("#cnewtax"+(tax*1000)).remove();
        $("#snewtax"+(tax*1000)).remove();
  });
}
if(i===rows){
  app.toast(param1, {
    actionTitle: 'Success',
    // actionUrl: 'something',
    actionColor: 'success'
  });
  $("#modal-invoice .close").click();
  DisplayInvoiceTblData();
  // $('#subtotal').text("");
  // $('#total').text("");
  // $('#balancedue').text("");
  // document.getElementById("invoiceform").reset();
  // $("#invoiceform").reset();
  // $("#invoiceform").trigger("reset");
  //window.location.reload();
}
}
function transactionmaster(){
  var formid = $("#hiddenformid").val();
  var formtype = $("#hiddenformtype").val();
  var transactionid = $("#hiddentransactionid").val();
  var  customername = $("#customername").val();
  var  emailaddress = $("#emailaddress").val();
  var billingaddress = $("#billingaddress").val();
  var  placeofsupply = $("#placeofsupply").val();
  var  terms = $("#terms").val();
  var  invoicedate = $("#invoicedate").val();
  var  duedate = $("#duedate").val();
  var  remark = $("#remark").val();
  var  discount = $("#discount").val();
  var contactid= $("#hidecontactid").val();
  var remainamount = parseFloat($("#remainamount").val());
  var finaltotal = parseFloat($("#finaltotal").text());
  
  if(contactid===""){
    contactid=0;
  }
  $.ajax({
      async: false,
      type: "POST",
      url: "../src/savetransactionmaster.php",
      data:{
        formid:formid,
        formtype:formtype,
        htransactionid:transactionid,
        personId:customername,
        contactId:contactid,
        discount:discount,
        datecreated:invoicedate,
        duedate:duedate,
        paytermval:terms,
        remainamount:remainamount,
        finaltotal:finaltotal,
        remark:remark
      },
      success: function(msg) {
        var response = JSON.parse(msg);
        var count = Object.keys(response).length;
        if(count>0){
           // alert("ID:"+response['ItemDetailId']);
           savetransactiondetails(response['ItemDetailId'],''+response['TransactionNumber']+'');
        }
      }
  });

}

function saveinvoice(){

var i=0;
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
var  terms = $("#terms").val();
if(terms==""){
 var param1="Please Select Payterms";
   app.toast(param1, {
    actionTitle: 'warning',
    // actionUrl: 'something',
    actionColor: 'warning'
  });

}
else {
var rows = $('#DyanmicTable tbody tr').length;
var j =0;
if(rows>0){
$('#DyanmicTable tbody td:nth-child(1)').each(function () {
      var value = parseInt($(this).html());
      i++;
      var itemname = $('#itemname'+value).val();
      var desc = $('#desc'+value).val();
      var hsn = $('#hsn'+value).val();
      var qty = $('#qty'+value).val();
      var billingqty = $('#billingqty'+value).val();
      var itemunits = $("#itemunits"+value).val();
      var rate = $('#rate'+value).val();
      var itemdiscount = $('#itemdiscount'+value).val();
      var amount = $('#amount'+value).val();
      var tax = $('#tax'+value).val();
      if(itemname==""||qty==""||rate==""||amount==""||itemdiscount==""||itemunits==""||tax==""){
         var param1="Please Check Table Row No"+value;
          j=1;
          app.toast(param1, {
            actionTitle: 'warning',
            // actionUrl: 'something',
            actionColor: 'warning'
          });
      }
      else{
          if(j==0){
        if(i==rows){

          transactionmaster();
        }
          }
      }
});
}
else{

  var param1="Please Select atleast 1 Product For Billing(Note:click on + icon)";
          app.toast(param1, {
            actionTitle: 'warning',
            // actionUrl: 'something',
            actionColor: 'warning'
          });
}
}
}

}
