$('#UnitData').on('submit',function(e){
    e.preventDefault();
    var UnitName  = document.getElementById('UnitName').value;
  if(UnitName == ""){
      $('#UnitName').focus();
  }
  else {
    $.ajax({
      url:'../src/AddNewUnit.php',
      type:'POST',
      data:({UnitName:UnitName}),
      dataType:'json',
      success:function(response){
        $('#modal-center .close').click();
      }
    })
  }
});
