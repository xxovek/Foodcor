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
        spansize();
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
