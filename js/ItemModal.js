//save the Item Details
spanunit();
spansize();
spancategory();
spcategory();
sptax();
function SaveItems(){
        // e.preventDefault();
        var i=0,serverMethod="POST";
        var ItemName         = document.getElementById('ItemName').value;
                    ItemName = ItemName.trim();
        var ItemSKU          = document.getElementById('ItemSKU').value;
        var ItemHSN          = document.getElementById('ItemHSN').value;
        var ItemUnit         = document.getElementById('ItemUnit').value;
        var ItemCategory     = document.getElementById('ItemCategory').value;;
        var ItemQuantity     = document.getElementById('ItemQuantity').value;
        var ItemReorderLabel = document.getElementById('ItemReorderLabel').value;
        var ItemSize         = document.getElementById('ItemSize').value;
        var ItemSizeQty      = document.getElementById('ItemSizeQty').value;
        var ItemSizeSubQty      = document.getElementById('ItemSizeSubQty').value;
        var PackingTypeId    = document.getElementById('PackingTypeId').value;
        var ItemTax          = document.getElementById('ItemTax').value;
        var ItemPrice        = document.getElementById('ItemPrice').value;
        var ItemDescription  = document.getElementById('ItemDescription').value;
        var SupplierId       = document.getElementById('SupplierId').value;
        var ItemId           = document.getElementById('ItemId').value;
        var ItemDetailId     = document.getElementById('ItemDetailId').value;
        if(ItemId != ""){
          serverMethod = 'PUT';
        }
        if(ItemName == ""){

            $('#ItemName').focus();
            $('.invalidfeedback').html('<font color="#f96868">Product/Service Name is Required</font>');
            i=1;
        }
        if(ItemQuantity == ""){
            $('#ItemQuantity').focus();
            $('.invalidfeedback1').html('<font color="#f96868">Initial Quantity on hand is required</font>');
            i=1;
        }
        if(ItemUnit == ""){

            $('#ItemUnit').focus();
            $('.invalidfeedback3').html('<font color="#f96868">Unit Value is Required</font>');
            i=1;
        }
        if(ItemSize == ""){

            $('#ItemSize').focus();
            $('.invalidfeedback4').html('<font color="#f96868">Size Value is Required</font>');
            i=1;
        }
      if(i==0){
          $.ajax({
            url:'../src/AddItemDetails.php',
            type:serverMethod,
            data:({
              ItemName:ItemName,
              ItemSKU:ItemSKU,
              ItemHSN:ItemHSN,
              ItemUnit:ItemUnit,
              ItemCategory:ItemCategory,
              ItemReorderLabel:ItemReorderLabel,
              ItemSize:ItemSize,
              ItemSizeQty:ItemSizeQty,
              ItemSizeSubQty:ItemSizeSubQty,
              ItemTax:ItemTax,
              ItemPrice:ItemPrice,
              ItemDescription:ItemDescription,
              PackingTypeId:PackingTypeId,
              ItemQuantity:ItemQuantity,ItemId:ItemId,
              ItemDetailId:ItemDetailId,SupplierId:SupplierId
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
              displayProducts();
            },
            complete:function(){
              document.getElementById('ItemForm').reset();
            }
          })
      }
  }

function spanunit(){
  var unit ='<select  title="Select Unit" data-live-search="true" data-provide="selectpicker" tabindex="4" data-width="100%" onchange="UnitModal(this.value);" id="ItemUnit" class="form-control form-control-sm" autocomplete="off">';
  $.ajax({
    url:'../src/getUnitNames.php',
    type:'GET',
    success:function(response){
         unit +=response;
         unit +='<option value=""></option></select>';
         $("#spanunit").html(unit);
    }
  });
}
function spansize(){
  var size ='<select title="Select Size" class="form-control form-control-sm" tabindex="5" data-provide="selectpicker" data-width="100%" data-live-search="true" id="ItemSize" onchange="SizeModal(this.value);" autocomplete="off">';
  $.ajax({
    url:'../src/getSizeValues.php',
    type:'GET',
    success:function(response){
         size +=response;
         size +='<option value=""></option></select>';
         $("#spansize").html(size);
    }
  });
}
function spancategory(){
  var category = '<select title="Select Packing" data-live-search="true" class="form-control form-control-sm" data-provide="selectpicker" tabindex="6" data-width="100%" id="PackingTypeId" onchange="PackingType(this.value);" autocomplete="off">';
  $.ajax({
    url:'../src/getPackingQuantity.php',
    type:'GET',
    success:function(response){
         category +=response;
         category +='<option value=""></option></select>';
         $("#spancategory").html(category);
    }
  });
}
function spcategory(){
  var category = '<select title="Select Category" data-live-search="true" data-provide="selectpicker" data-width="100%" tabindex="10" id="ItemCategory" name="ItemCategory" class="form-control form-control-sm" onchange="CategoryType(this.value);" autocomplete="off">';
  $.ajax({
    url:'../src/getCategory.php',
    type:'GET',
    success:function(response){
         category +=response;
         category +='<option value=""></option></select>';
         $("#spcategory").html(category);
    }
  });
}
function sptax(){
  var category = '<select title="Select Tax" data-live-search="true" data-provide="selectpicker" data-width="100%" tabindex="11" class="form-control form-control-sm" id="ItemTax" onchange="TaxModal(this.value);" autocomplete="off">';
  $.ajax({
    url:'../src/getTaxValues.php',
    type:'GET',
    success:function(response){
         category +=response;
         category +='<option value=""></option></select>';
         $("#sptax").html(category);
    }
  });
}
// function spansupplier(){
//   var supplier = '<select title="Select supplier" data-provide="selectpicker" class="form-control form-control-sm" data-width="100%" id="SupplierId" tabindex="14" autocomplete="off">';
//   $.ajax({
//     url:'../src/getSupplierNames.php',
//     type:'GET',
//     success:function(response){
//          supplier +=response;
//          supplier +='</select>';
//          $("#spansupplier").html(supplier);
//     }
//   });
// }
  //for model of add new unit
function UnitModal(param){
  if(param == 'add'){
      $('#modal-center').modal('show');
      $("#ItemUnit").val("");
  }
}
function SizeModal(param){
  if(param == 'addSize'){
    $('#SizeModal').modal('show');
    $('#ItemSize').val('');
  }
}
function PackingType(param){
  if(param == 'Packing'){
    $('#PackingType').modal('show');
    $('#PackingTypeId').val('');
  }

}
function CategoryType(param){
  if(param == 'Category'){
      $('#CategoryTypeModal').modal('show');
      $('#ItemCategory').val('');
  }

}
function TaxModal(param){
  if(param == 'Tax'){
      $('#TaxModal').modal('show');
      $('#ItemTax').val('');
  }
}
//for green line of input when user put some input
$('#ItemName').on('keyup',function(){
  $('.invalidfeedback').html('');
});

$('#ItemQuantity').on('keyup',function(){
  $('.invalidfeedback1').html('');
});
$('#asondate').on('blur',function(){
  $('.invalidfeedback2').html('');
});
$('#spanunit').on('change',function(){
  $('.invalidfeedback3').html('');
});
$('#spansize').on('change',function(){
  $('.invalidfeedback4').html('');
});
