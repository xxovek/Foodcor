displayCustomers();
// spanresigrationtype();
spancountry();
spanshippingcountry();
// fetchsinglestate();
// fetchsinglecity();
displayAllCount();
function displayAllCount(){
  // alert("insideCount");
  $.ajax({
      url:'../src/FetchUsersCount.php',
      type:'POST',
      dataType:'json',
      success:function(response){

      $("#custCnt").html(response[0].Cnt);
      $("#suppCnt").html(response[1].Cnt);
      $("#empCnt").html(response[2].Cnt);
      $("#usersCnt").html(response[3].Cnt);
      }
  });

}
$("#spanstate").html('<select data-live-search="true" class="form-control form-control-sm " data-width="100%" data-provide="selectpicker"   id="bstate" name="bstate" title="Select State" ></select>');
$("#spancity").html('<select data-live-search="true" class="form-control form-control-sm " data-width="100%" data-provide="selectpicker"   id="bcity" name="bcity" title="Select City" >');
$("#spanshippingstate").html('<select data-live-search="true" class="form-control form-control-sm" data-width="100%" data-provide="selectpicker"   id="sstate" name="sstate" title="Select State" ></select>');
$("#spanshippingcity").html('<select data-live-search="true" class="form-control form-control-sm" data-width="100%" data-provide="selectpicker"   id="scity" name="scity" title="Select City" >');


$('#fname').on('keyup',function(){
  $('.invalidfeedback').html('');
});
$('#ctype').on('blur',function(){
  $('.invalidfeedback1').html('');
});
$('#email').on('keyup',function(){
  $('.invalidfeedback2').html('');
});
// spanptype();


function getPersonType()
{
var a = $("#ctype").val();
if(a == 1)
$("#titlepage").html("Customer Information");
else if(a == 2)
$("#titlepage").html("Supplier Information");
else
$("#titlepage").html("Employee Information");

}
function spancountry(){
  var getcountry ='<select title="Select Country" class="form-control form-control-sm" tabindex="8" title="Select Country" data-provide="selectpicker" data-width="100%" data-live-search="true" id="bcountry" onchange="spanstate(this.value);" name="bcountry" autocomplete="off">';

  $.ajax({
    url:'../src/fetch_country.php',
    type:'GET',
    success:function(response){
         getcountry +=response;
         getcountry +='</select>';
         $("#spancountry").html(getcountry);

    }
  });
}
function spanstate(country){

  var getstate ='<select title="Select State" class="form-control form-control-sm" tabindex="9" data-provide="selectpicker"  data-live-search="true" id="bstate"  onchange="spancity(this.value)" name="bstate" autocomplete="off">';
  $.ajax({
    url:'../src/fetch_state.php',
    type:'GET',
    data: ({
            user_id:country
          }),
    success:function(response){

         getstate +=response;
         getstate +='</select>';
         $("#spanstate").html(getstate);
    }
  });
}
function spancity(state)
{
  var getcity ='<select title="Select City" class="form-control form-control-sm" tabindex="10" data-provide="selectpicker"  data-live-search="true" id="bcity"  name="bcity" autocomplete="off">';

  $.ajax({
    url:'../src/fetch_city.php',
    type:'GET',
    data: ({
            user_id:state
        }),
    success:function(response){
         getcity +=response;
         getcity +='</select>';
         $("#spancity").html(getcity);
    }
  });
}

function fetchsinglebstate(){

  var getstate ='<select title="Select State" class="form-control form-control-sm" tabindex="9" data-provide="selectpicker"  data-live-search="true" id="bstate"  onchange="spancity(this.value)" name="bstate" autocomplete="off">';
  $.ajax({
    url:'../src/fetch_single_state.php',
    type:'GET',

    success:function(response){

         getstate +=response;
         getstate +='</select>';
          // alert(getstate);
        $("#spanstate").html(getstate);
    }
  });
}
// kunal created
function fetchsinglebcity(){

  var getcity ='<select title="Select City" class="form-control form-control-sm" tabindex="10" data-provide="selectpicker"  data-live-search="true" id="bcity"  name="bcity" autocomplete="off">';
  $.ajax({
    url:'../src/fetch_single_city.php',
    type:'GET',

    success:function(response){

         getcity +=response;
         getcity +='</select>';
         // alert(getcity);
         $("#spancity").html(getcity);
    }
  });
}
//-------------------------------------
function spanshippingcountry()
{
  var getcountry1 ='<select title="Select Country" class="form-control form-control-sm" tabindex="12" title="Select Country" data-provide="selectpicker" data-width="100%" data-live-search="true" id="scountry" onchange="spanshippingstate(this.value);" name="scountry" autocomplete="off">';
  $.ajax({
    url:'../src/fetch_country.php',
    type:'GET',
    success:function(response){
         getcountry1 +=response;
         getcountry1+='</select>';
         $("#spanshippingcountry").html(getcountry1);
    }
  });
}
function spanshippingstate(country){
  var getstate1 ='<select title="Select State" class="form-control form-control-sm" tabindex="13" data-provide="selectpicker" data-width="100%" data-live-search="true" id="sstate"  onchange="spanshippingcity(this.value)" name="sstate" autocomplete="off">';

  $.ajax({
    url:'../src/fetch_state.php',
    type:'GET',
    data: ({
            user_id:country
        }),
    success:function(response){
         getstate1 +=response;
         getstate1 +='</select>';
         $("#spanshippingstate").html(getstate1);
    }
  });
}
function spanshippingcity(state){
  var getcity1 ='<select title="Select City" class="form-control form-control-sm" tabindex="14" data-provide="selectpicker" data-width="100%" data-live-search="true" id="scity"   name="scity" autocomplete="off">';

  $.ajax({
    url:'../src/fetch_city.php',
    type:'GET',
    data: ({
            user_id:state
        }),
    success:function(response){
         getcity1 +=response;
         getcity1 +='</select>';
         $("#spanshippingcity").html(getcity1);
    }
  });
}
// kunal created

function fetchsinglesstate(){

  var getstate ='<select title="Select State" class="form-control form-control-sm" tabindex="13" data-provide="selectpicker" data-width="100%" data-live-search="true" id="sstate"  onchange="spanshippingcity(this.value)" name="sstate" autocomplete="off">';
  $.ajax({
    url:'../src/fetch_single_state.php',
    type:'GET',

    success:function(response){

         getstate +=response;
         getstate +='</select>';
          // alert(getstate);
        $("#spanshippingstate").html(getstate);
    }
  });
}
// kunal created
function fetchsinglescity(){

  var getcity ='<select title="Select City" class="form-control form-control-sm" tabindex="14" data-provide="selectpicker" data-width="100%" data-live-search="true" id="scity"   name="scity" autocomplete="off">';
  $.ajax({
    url:'../src/fetch_single_city.php',
    type:'GET',

    success:function(response){

         getcity +=response;
         getcity +='</select>';
         // alert(getcity);
         $("#spanshippingcity").html(getcity);
    }
  });
}


// function spanresigrationtype(){
//   var getresigrationtype ='<select data-live-search="true" class="form-control form-control-sm" data-provide="selectpicker" id="ctype" name="ctype" title="select type" onchange="getPersonType();" required>';
//
//   $.ajax({
//     url:'../src/fetchregistrationtype.php',
//     type:'GET',
//     success:function(response){
//          getresigrationtype +=response;
//          getresigrationtype +='</select>';
//          $("#spanresigrationtype").html(getresigrationtype);
//         // $("#spanshippingcountry").html(getcountry);
//     }
//   });
// }

$("#myform").on('submit',function(e){
  e.preventDefault();
  var i=0;
  var pid = document.getElementById('personid').value;
  var ctype1=document.getElementById('ctype').value;
  var ctype = $("#ctype option:selected").text();
  var fname=document.getElementById('fname').value;
  var mname=document.getElementById('mname').value;
  var lname=document.getElementById('lname').value;
  var email=document.getElementById('email').value;
  var phone=document.getElementById('phone').value;
  var shipaddr=document.getElementById('shipaddr').value;
  var billaddr=document.getElementById('billaddr').value;
  var gstin=document.getElementById('GSTIN').value;
  var Pan=document.getElementById('PAN').value;
  var companyName = document.getElementById('companyName').value;
  var bcountry=$("#bcountry").val();
  var bstate=$("#bstate").val();
  var bcity=$("#bcity").val();
  var bzip=document.getElementById('bzip').value;
  var scountry=$("#scountry").val();
  var sstate=$("#sstate").val();
  var scity=$("#scity").val();
  var szip=document.getElementById('szip').value;
  if(fname === ""){
    $('#fname').focus();
    $('.invalidfeedback').html('<font color="#f96868">Customer Name is Required</font>');
    i=1;
  }
  if(ctype === ""){
    $('#ctype').focus();
    $('.invalidfeedback1').html('<font color="#f96868">Customer Type is Required</font>');
    i=1;
  }
  if(i===0){
    $.ajax({
        type: "POST",
        url: "../src/addCustomer.php",
        data: {pid:pid,ctype1:ctype1,ctype:ctype,
          fname:fname,mname:mname,lname:lname,
          email:email,phone:phone,companyName:companyName,
          bcountry:bcountry,bstate:bstate,bcity:bcity,bzip:bzip,
          scountry:scountry,sstate:sstate,scity:scity,szip:szip,
          gstin:gstin,Pan:Pan,shipaddr:shipaddr,billaddr:billaddr},
        dataType:'json',
        success: function(response) {
            app.toast(response.msg, {
              actionTitle: 'Success',
              // actionUrl: 'something',
              actionColor: 'success'
            });
            $('#myModal').modal('hide');

        }
    });
  }
});


function fun() {
if($("#check1").is(":checked"))
{
  var bcountry=$("#bcountry").val();
  var bstate=$("#bstate").val();
  var bcity=$("#bcity").val();
  var bzip=$("#bzip").val();
  var billaddr=$("#billaddr").val();
  $("#scountry").val(bcountry).trigger('change');
  setTimeout(function()
  {
  $("#sstate").val(bstate).trigger('change');
  },500);
  setTimeout(function()
  {
    $("#scity").val(bcity).trigger('change');
  },1000);
  // $("#scountry").append('<option value="'+bcountry1+'" selected>'+bcountry+'</option>').attr('disabled',true);
  // $("#sstate").append('<option value="'+bstate1+'" selected>'+bstate+'</option>').attr('disabled',true);
  // $("#scity").append('<option value="'+bcity1+'" selected>'+bcity+'</option>').attr('disabled',true);
  $("#szip").val(bzip).attr('disabled',true);
  $("#shipaddr").val(billaddr).attr('disabled',true);
}
else {
  $("#sstate").val("").trigger('change');
  // $("#scity").val("bcity").trigger('change');
  // $("#scountry").append('<option value="" selected></option>').attr('disabled',false);
  // $("#sstate").append('<option value="" selected></option>').attr('disabled',false);
  // $("#scity").append('<option value="" selected></option>').attr('disabled',false);
  $("#szip").val('').attr('disabled',false);
  $("#shipaddr").val('').attr('disabled',false);
}
}


function displayCustomers() {
  $.ajax({
      type: "POST",
      url: "../src/displayCustomers.php",
      dataType:"json",
      success: function(response) {
        // var response =JSON.parse(msg);
        var count= response.length;
        if(count > 0){
          for (var i = 0; i < count; i++) {
            var c_id = response[i].pid;

            $("#tabledata").append('<tr><th scope="row">'+(i + 1)+'</th><td>'
            +response[i].name+'</td><td>'
            +response[i].ptype+'</td><td>'
            +response[i].email+'</td><td><button class=" btn-link dropdown-toggle" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="customerEdit.php?pid='+response[i]['pid']+'">View</a><a class="dropdown-item" href="#" onClick="removecustomers(' + c_id + ');">Delete</a></div></td></tr>');

        }
        var countTable = $('thead tr th').length;
                var arr = [];
                for(var i=0;i<countTable;i++){
                  arr.push(i);
                }
                $('#example1').DataTable({
                  bPaginate: $('tbody tr').length>10,
                  order: [],
                  // "bInfo": false,
                  columnDefs: [ { orderable: false, targets: arr } ],
                  dom: 'Bfrtip',
                  buttons: ['copy', 'excel', 'pdf','print']
                });
        }
      else{

      }

      }
  });
}


function displaytransactions(param) {
  $.ajax({
      type: "POST",
      url: "../src/displayTransactions.php",
      dataType:"json",
      data:{pid:param},
      success: function(response) {
        alert(response)
        // var response =JSON.parse(msg);
        var count= response.length;
        if(count > 0){
          for (var i = 0; i < count; i++) {
            var t_id = response[i].TId;
            $("#loadtransactions").append('<tr><th scope="row">'+(i + 1)+'</th><td>'
            +response[i].DateCreated+'</td><td>'
            +response[i].type+'</td><td>'
            +response[i].InvoiceNumber+'</td><td>'+response[i].DueDate+'</td><td>'+response[i].Balance+
            '</td><td>'+response[i].totalbefore+'</td><td>'+response[i].tax+'</td><td>'+response[i].Total+
            '</td><td>'+response[i].status+'</td><td><button class=" btn-link dropdown-toggle" data-toggle="dropdown">Action</button><div class="dropdown-menu"><a class="dropdown-item" href="invoicePdfView.php?tid='+
            t_id+'">View</a><a class="dropdown-item" href="invoicePdf.php?tid='+t_id+'">Print</a></div></td></tr>');

        }
        var countTable = $('thead tr th').length;
                var arr = [];
                for(var i=0;i<countTable;i++){
                  arr.push(i);
                }
                $('#example2').DataTable({
                  bPaginate: $('tbody tr').length>10,
                  order: [],
                  // "bInfo": false,
                  columnDefs: [ { orderable: false, targets: arr } ],
                  dom: 'Bfrtip',
                  buttons: ['copy', 'excel', 'pdf','print']
                });
        }
      else{

      }

      }
  });
}
function fetchCustomer(param) {
  fetchsinglebstate();
  fetchsinglebcity();
  fetchsinglesstate();
  fetchsinglescity();
  $.ajax({
      type: "POST",
      url: "../src/fetchCustomer.php",
      data: {pid:param},
      dataType:'json',
      success: function(response) {
        // alert(response.personTypeId);
        $('#ctype').val(response.personTypeId).trigger('change');
        // $("#ctype").val('<option value="'+response.ptype+'" selected>'+response.ptypename+'</option>');
        $("#cust").html(response.fname+' '+response.lname);
        $("#pname").html(response.fname);
        $("#pmname").html(response.mname);
        $("#plname").html(response.lname);
        $("#ptype").html(response.ptype);
        $("#pemail").html(response.email);
        $("#pphone").html(response.phone);
        $("#pgstin").html(response.gstin);
        $("#pPAN").html(response.Pan);
        $("#GSTIN").val(response.gstin);
        $("#PAN").val(response.Pan);
        $("#pbaddr").html(response.billaddress);
        $("#shipaddr").val(response.shipaddress);
        // alert(response.shipaddress);
        $("#psaddr").html(response.shipaddress);
        $("#fname").val(response.fname);
        $("#email").val(response.email);
        $("#phone").val(response.phone);
        $("#billaddr").val(response.billaddress);
        $("#mname").val(response.mname);
        $("#lname").val(response.lname);
        $("#bzip").val(response.bzip);
        $("#personid").val(response.pid);
        $("#szip").val(response.szip);
        $("#companyName").val(response.CompanyName);
        // alert(response.bcountryid);
        // alert(response.bstateid);
        // alert(response.bcityid);
        // alert(response.scountryid);
        // alert(response.sstateid);
        // alert(response.scityid);
        if(response.bcountryid==""){

        }
        else {
          $("#bcountry").val(response.bcountryid).trigger('change');
        }

        if(response.bstateid==""){

        }
        else
        {
          setTimeout(function()
          {
            $("#bstate").val(response.bstateid).trigger('change');
          },700);
        }

        if(response.bcityid==""){

        }
        else
        {

            setTimeout(function()
            {
            $("#bcity").val(response.bcityid).trigger('change');
          },1400);
        }
        if(response.scountryid==""){

        }
        else
        {

          $("#scountry").val(response.scountryid).trigger('change');
        }
        if(response.sstateid==""){

        }
        else
        {
          setTimeout(function()
          {
          $("#sstate").val(response.sstateid).trigger('change');
          },500);
        }
        if(response.scityid==""){

        }
        else
        {
          setTimeout(function()
          {
            $("#scity").val(response.scityid).trigger('change');
          },1000);
        }


  }
  });
}

function removecustomers(param)
{
  var r = confirm("Are you sure to delete!");
          if (r==true) {
            $.ajax({
            url:"../src/deleteCustomer.php",
            async: false,
            cache: false,
            method:"POST",
            data:({cid:param}),
            success:function(data)
            {
              $("#"+param).closest('tr').remove();
                window.location.reload();
            }
            });
          }
}
