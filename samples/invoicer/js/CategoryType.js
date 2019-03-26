$('#CategoryData').on('submit',function(e){
    e.preventDefault();
    var CategoryName  = document.getElementById('CategoryName').value;
    alert(CategoryName);
  if(CategoryName == ""){
      $('#CategoryName').focus();
  }
  else {
    $.ajax({
      url:'../src/AddNewCategory.php',
      type:'POST',
      data:({CategoryName:CategoryName}),
      dataType:'json',
      success:function(response){
        alert(response);
        $('#CategoryTypeModal .close').click();
      }
    })
  }
});
