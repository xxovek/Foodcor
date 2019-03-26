$('#TaxData').on('submit',function(e){
    e.preventDefault();
    var serverMethod="POST";
    var TaxId = "";
    var TaxName  = document.getElementById('TaxName').value;
    var TaxDescription  = document.getElementById('TaxDescription').value;
    var TaxType  = document.getElementById('TaxType').value;
    var TaxPercent  = document.getElementById('TaxPercent').value;
    // if(TaxId != ""){
    //          serverMethod = "PUT";
    //        }
  if(TaxName == ""){
      $('#TaxName').focus();
  }else if(TaxType==""){
      $('#TaxType').focus();
  }else if(TaxPercent==""){
      $('#TaxPercent').focus();
  }
  else {
    $.ajax({
      url:'../src/addTaxesFormValues.php',
      type:serverMethod,
      data:({TaxId:TaxId,TaxType:TaxType,TaxPercent:TaxPercent,TaxName:TaxName,TaxDescription:TaxDescription}),
      dataType:'json',
      success:function(response){
        // document.getElementById('TaxData')[0].reset();

        $('#TaxModal .close').click();
        $("#TaxModal .modal-body input,textarea").val("");
        // document.getElementById('TaxType').trigger('change');
        $('#TaxType').val("").trigger('change');

        // $("#TaxData")[0].reset();

        sptax();
        app.toast(response.msg, {
          actionTitle: 'Success',
          // actionUrl: 'something',
          actionColor: 'success',
          duration: 4000
        });
      }
    })
  }
});

function additemtax(){
  var serverMethod="POST";
  var TaxId = "";
  var TaxName  = document.getElementById('TaxName').value;
  var TaxDescription  = document.getElementById('TaxDescription').value;
  var TaxType  = document.getElementById('TaxType').value;
  var TaxPercent  = document.getElementById('TaxPercent').value;
  var hiddenitemtax =$("#hiddenitemtax").val();

  if(TaxType == ""){
      $('#TaxType').focus();
  }
  else if(TaxPercent==""){
      $('#TaxPercent').focus();
  }
  else {
    $.ajax({
      url:'../src/addTaxesFormValues.php',
      type:serverMethod,
      data:({TaxId:TaxId,TaxType:TaxType,TaxPercent:TaxPercent,TaxName:TaxName,TaxDescription:TaxDescription}),
      dataType:'json',
      success:function(response){
        $('#TaxModal').modal('hide');
          $("#TaxModal .modal-body input,textarea").val("");
          $('#TaxType').val("").trigger('change');
         connectitemtax(hiddenitemtax);
      }
    })
  }
}

function checktaxaval(){
var TaxPercent  = parseFloat($('#TaxPercent').val());
// alert(TaxPercent);
if((TaxPercent>0.01) && (TaxPercent<100)){
    $("#taxavl").html("");
    $.ajax({
      url:'../src/fetchavltax.php',
      type:'POST',
      data:({TaxPercent:TaxPercent}),
      dataType:'json',
      success:function(response){
        if(response['count']>0){
            $("#taxavl").html("<font color='red'>Tax value is already exists</font>");
            $('#TaxPercent').val("");
        }
        else {
          $("#taxavl").html("");
        }
      }
    });
}
else
{
  $("#taxavl").html("<font color='red'>Tax value must be greater than 0.01 and less than 100</font>");
  $('#TaxPercent').val("");
}
}
