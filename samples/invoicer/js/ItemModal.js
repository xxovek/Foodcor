//save the Item Details
$('#ItemForm').on('submit',function(e){
        e.preventDefault();
        var i=0;
        var ItemName         = document.getElementById('ItemName').value;
        var ItemSKU          = document.getElementById('ItemSKU').value;
        var ItemHSN          = document.getElementById('ItemHSN').value;
        var ItemUnit         = document.getElementById('ItemUnit').value;
        var ItemCategory     = document.getElementById('ItemCategory').value;;
        var ItemQuantity     = document.getElementById('ItemQuantity').value;
        var ItemReorderLabel = document.getElementById('ItemReorderLabel').value;
        var ItemSize         = document.getElementById('ItemSize').value;
        var ItemSizeQty      = document.getElementById('ItemSizeQty').value;
        var PackingTypeId    = document.getElementById('PackingTypeId').value;
        var ItemTax          = document.getElementById('ItemTax').value;
        var ItemPrice        = document.getElementById('ItemPrice').value;
        var ItemDescription  = document.getElementById('ItemDescription').value;

        if(ItemName == ""){
            $('#ItemName').focus();
            $('.invalidfeedback').html('<font color="#f96868">Product/Service Name is Required</font>');
            i=1;
        }
        if(ItemQuantity == ""){
            $('#ItemQuantity').focus();
            $('.invalidfeedback1').html('<font color="#f96868">Initial Quantity As on date Required</font>');
            i=1;
        }
      if(i==0){
          $.ajax({
            url:'./src/AddItemDetails.php',
            type:'POST',
            data:({
              ItemName:ItemName,
              ItemSKU:ItemSKU,
              ItemHSN:ItemHSN,
              ItemUnit:ItemUnit,
              ItemCategory:ItemCategory,
              ItemReorderLabel:ItemReorderLabel,
              ItemSize:ItemSize,
              ItemSizeQty:ItemSizeQty,
              ItemTax:ItemTax,
              ItemPrice:ItemPrice,
              ItemDescription:ItemDescription,
              PackingTypeId:PackingTypeId,
              ItemQuantity:ItemQuantity
            }),
            dataType:'json',
            success:function(response){
              $('#goback').click();
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
  //for model of add new unit
function UnitModal(param){
  if(param == 'add')
  $('#modal-center').modal('show');
}
function SizeModal(param){
  if(param == 'addSize')
  $('#SizeModal').modal('show');
}
function PackingType(param){
  if(param == 'Packing')
  $('#PackingType').modal('show');
}
function CategoryType(param){
  if(param == 'Category')
  $('#CategoryTypeModal').modal('show');
}
function TaxModal(param){
  if(param == 'Tax')
  $('#TaxModal').modal('show');
}
//for green line of input when user put some input
$('#ItemName').on('keyup',function(){
  $('.invalidfeedback').html('');
});
$('#ItemQuantity').on('keyup',function(){
  $('.invalidfeedback1').html('');
});
