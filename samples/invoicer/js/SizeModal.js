$('#SizeData').on('submit',function(e){
    e.preventDefault();
    var SizeValue  = document.getElementById('SizeValue').value;
  if(SizeValue == ""){
      $('#SizeValue').focus();
  }
  else {
    $.ajax({
      url:'../src/addNewSize.php',
      type:'POST',
      data:({SizeValue:SizeValue}),
      dataType:'json',
      success:function(response){
        $('#SizeModal .close').click();
      }
    })
  }
});
