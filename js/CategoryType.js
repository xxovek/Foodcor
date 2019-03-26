$('#CategoryData').on('submit',function(e){
    e.preventDefault();
    var CategoryName  = document.getElementById('CategoryName').value;
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
        $('#CategoryTypeModal .close').click();
        spcategory();
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
