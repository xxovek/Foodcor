$('#TaxData').on('submit',function(e){
    e.preventDefault();
    var TaxType  = document.getElementById('TaxType').value;
    var TaxPercent  = document.getElementById('TaxPercent').value;
  if(TaxType == ""){
      $('#TaxType').focus();
  }
  else {
    $.ajax({
      url:'../src/AddNewTax.php',
      type:'POST',
      data:({TaxType:TaxType,TaxPercent:TaxPercent}),
      dataType:'json',
      success:function(response){
        $('#TaxModal .close').click();
      }
    })
  }
});
