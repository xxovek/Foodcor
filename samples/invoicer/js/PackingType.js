$('#PackingData').on('submit',function(e){
    e.preventDefault();
    var PackingTypeName  = document.getElementById('PackingTypeName').value;
  if(PackingTypeName == ""){
      $('#PackingTypeName').focus();
  }
  else {
    $.ajax({
      url:'../src/AddNewpacking.php',
      type:'POST',
      data:({PackingTypeName:PackingTypeName}),
      dataType:'json',
      success:function(response){
        $('#PackingType .close').click();
      }
    })
  }
});
