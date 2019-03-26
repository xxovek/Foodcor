
function addpayterm(){
  var PaytermValue  = document.getElementById('PaytermValue').value;
  // alert(PaytermValue);
  if(PaytermValue === ""){
      $('#PaytermValue').focus();
  }
  else {
    $.ajax({
      url:'../src/addNewPayterm.php',
      type:'POST',
      data:({PaytermValue:PaytermValue}),
      dataType:'json',
      success:function(response){
        // alert(response);
        if(response['msg']){
          $('#PaytermModal').modal('hide');
          getpayterms();
        }

      }
    })
  }
}

function getpayterms()
{
var payterm='';
  payterm+='<select  class="form-control" data-provide="selectpicker" data-live-search="true"  title="Choose a terms" onchange="addterms()" id="terms">';
    $.ajax({
        type: "POST",
        url: "../src/fetch_payterms.php",
        success: function(msg) {


          payterm+=msg;
          payterm+='<option data-icon="fa fa-edit" style="font-weight: bold;  padding: 5px;color: #797878;border: 2px solid #71bd71;"  value="at" >Add Terms</option>';
          payterm+='<option value=""></option>';
          payterm+='</select>';
          $("#setterms").html(payterm);
        }
    });
}
