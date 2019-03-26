
displayTaxes();

function displayTaxes(){
  $('#tblData tbody').empty();
var tblData = '';
$.ajax({
  type:'GET',
  url:'../src/fetchAllTaxes.php',
  dataType:'json',
  success:function(response){
    var count = Object.keys(response).length;
      if(count > 0){
        for(var i=0;i<count;i++){

            $('#tblDatabody').append('<tr><td class="text-center">'+(i + 1)+'</td><td>'
            +response[i].TaxName+'</td><td>'
            +response[i].TaxType+'</td><td>'
            +response[i].TaxPercent+'</td><td>'
            +response[i].Description+
            '</td><td class="text-center"><button class="btn-link dropdown-toggle" type="button" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="editTaxes(\''+response[i].TaxId+'\',\''+response[i].TaxName+'\',\''+response[i].TaxType+'\',\''+response[i].TaxPercent+'\',\''+response[i].Description+'\')">View/Edit</a><a class="dropdown-item" href="#" onclick="removeTaxes('+response[i].TaxId+')" >Delete</a></div></td></tr>');                                                                                                                                                                  // functionname(\''+ response[i].TaxId +'\',\''+response[i]['IssuesDate']+'\')
          }
      }

      $('#tblData').DataTable({
        searching: true,
        retrieve: true,
        bPaginate: $('tbody tr').length>10,
        order: [],
        columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5] } ],
        dom: 'Bfrtip',
        buttons: ['copy','csv', 'excel', 'pdf'],
        destroy: true
      });
  }
});
}

function removeTaxes(TaxId){
// alert(TaxId);
var r = confirm('Are You sure To Remove This Tax Parmanetly');
if(r === true){
  $.ajax({
    type:'DELETE',
    url:'../src/removeTaxfromTbl.php',
    data:{TaxId:TaxId},
    dataType:'json',
    success:function(response){
      app.toast(response.msg, {
        actionTitle: 'Success',
        // actionUrl: 'something',
        actionColor: 'success',
        duration: 4000
      });
      displayTaxes();
    }
  });
}


}

$("#goback").on('click',function(){
  // document.getElementById('NewTaxForm').reset();
  $('#NewTaxForm')[0].reset();
});

function editTaxes(TaxId,TaxName,TaxType,TaxPercent,TaxDescription){
// alert(TaxDescription);

   $('#newTaxesFormBtn').click();
    document.getElementById('NewTaxForm').reset();
    $('#TaxId').val(TaxId);
    document.getElementById('TaxName').value = TaxName;
    document.getElementById('TaxDescription').value = TaxDescription;
    // document.getElementById('TaxType').value = TaxType;
    $('#TaxType').val(TaxType).trigger('change');
    document.getElementById('TaxPercent').value = TaxPercent;
}


$('#TaxName').on('keyup',function(){
  $('.invalidTaxName').html('');
});

$('#TaxType').on('change',function(){
  $('.invalid_TaxType').html('');
});
$('#TaxPercent').on('keyup',function(){
  $('.invalidTaxValue').html('');
});
function SaveTaxes(){
  // alert("insaveTax");
   var i=0,serverMethod="POST";
  var TaxId = document.getElementById('TaxId').value;
 var TaxName  = document.getElementById('TaxName').value;
 TaxName = TaxName.trim();
 var TaxDescription  = document.getElementById('TaxDescription').value;
 var TaxType  = document.getElementById('TaxType').value;
 var TaxPercent  = document.getElementById('TaxPercent').value;
 // if(TaxId != ""){
          // serverMethod = "POST";
        // }
 if(TaxName === ""){

             $('#TaxName').focus();
             $('.invalidTaxName').html('<font color="#f96868">Tax Name is Required</font>');
             i=1;
         }else {
           $('.invalidTaxName').html('');

         }
if(TaxType === ""){
   $('#TaxType').focus();
   $('.invalid_TaxType').html('<font color="#f96868">TaxType is Required</font>');
   i=1;
}else {
  $('.invalid_TaxType').html('');

}
if(TaxPercent === ""){
   $('#TaxPercent').focus();
   $('.invalidTaxValue').html('<font color="#f96868">Tax Percent is Required</font>');
   i=1;
}else {
  $('.invalidTaxValue').html('');
}
if(i === 0){
 $.ajax({
   url:'../src/addTaxesFormValues.php',
   type:serverMethod,
   // method:serverMethod,
   dataType:'json',
   data:({TaxId:TaxId,TaxType:TaxType,TaxPercent:TaxPercent,TaxName:TaxName,TaxDescription:TaxDescription}),
   success:function(response){
     $('#goback').click();
     app.toast(response.msg, {
       actionTitle: 'Success',
       // actionUrl: 'something',
       actionColor: 'success',
       duration: 4000
     });

     displayTaxes();
   },
   complete:function(){
     document.getElementById('NewTaxForm').reset();
   }
 })
}
}




//
// function SaveItems(){
//         // e.preventDefault();
//         var i=0,serverMethod="POST";
//         var ItemName         = document.getElementById('ItemName').value;
//                     ItemName = ItemName.trim();
//         var ItemSKU          = document.getElementById('ItemSKU').value;
//         var ItemHSN          = document.getElementById('ItemHSN').value;
//         var ItemUnit         = document.getElementById('ItemUnit').value;
//         var ItemCategory     = document.getElementById('ItemCategory').value;;
//         var ItemQuantity     = document.getElementById('ItemQuantity').value;
//         var ItemReorderLabel = document.getElementById('ItemReorderLabel').value;
//         var ItemSize         = document.getElementById('ItemSize').value;
//         var ItemSizeQty      = document.getElementById('ItemSizeQty').value;
//         var ItemSizeSubQty      = document.getElementById('ItemSizeSubQty').value;
//         var PackingTypeId    = document.getElementById('PackingTypeId').value;
//         var ItemTax          = document.getElementById('ItemTax').value;
//         var ItemPrice        = document.getElementById('ItemPrice').value;
//         var ItemDescription  = document.getElementById('ItemDescription').value;
//         var SupplierId       = document.getElementById('SupplierId').value;
//         var ItemId           = document.getElementById('ItemId').value;
//         var ItemDetailId     = document.getElementById('ItemDetailId').value;
//         if(ItemId != ""){
//           serverMethod = 'PUT';
//         }
//         if(ItemName == ""){
//
//             $('#ItemName').focus();
//             $('.invalidfeedback').html('<font color="#f96868">Product/Service Name is Required</font>');
//             i=1;
//         }
//         if(ItemQuantity == ""){
//             $('#ItemQuantity').focus();
//             $('.invalidfeedback1').html('<font color="#f96868">Initial Quantity on hand is required</font>');
//             i=1;
//         }
//         if(ItemUnit == ""){
//
//             $('#ItemUnit').focus();
//             $('.invalidfeedback3').html('<font color="#f96868">Unit Value is Required</font>');
//             i=1;
//         }
//         if(ItemSize == ""){
//
//             $('#ItemSize').focus();
//             $('.invalidfeedback4').html('<font color="#f96868">Size Value is Required</font>');
//             i=1;
//         }
//       if(i==0){
//           $.ajax({
//             url:'../src/AddItemDetails.php',
//             type:serverMethod,
//             data:({
//               ItemName:ItemName,
//               ItemSKU:ItemSKU,
//               ItemHSN:ItemHSN,
//               ItemUnit:ItemUnit,
//               ItemCategory:ItemCategory,
//               ItemReorderLabel:ItemReorderLabel,
//               ItemSize:ItemSize,
//               ItemSizeQty:ItemSizeQty,
//               ItemSizeSubQty:ItemSizeSubQty,
//               ItemTax:ItemTax,
//               ItemPrice:ItemPrice,
//               ItemDescription:ItemDescription,
//               PackingTypeId:PackingTypeId,
//               ItemQuantity:ItemQuantity,ItemId:ItemId,
//               ItemDetailId:ItemDetailId,SupplierId:SupplierId
//             }),
//             dataType:'json',
//             success:function(response){
//               $('#goback').click();
//               app.toast(response.msg, {
//                 actionTitle: 'Success',
//                 // actionUrl: 'something',
//                 actionColor: 'success',
//                 duration: 4000
//               });
//               displayProducts();
//             },
//             complete:function(){
//               document.getElementById('ItemForm').reset();
//             }
//           })
//       }
//   }
