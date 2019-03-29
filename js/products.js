function getAddFlag(){
  $.ajax({
    url:'../src/getAddProductFlag.php',
    type:'GET',
    dataType:'json',
    success:function(response){
      if(response.msg == 1){
        $('#ProductButton').show();
      }else{
        $('#ProductButton').hide();
      }
    }
  });
}
getAddFlag();
$("#qv-invoice-add").on("click", '[data-toggle="quickview"]', function() {
  $("#ItemUnit").val('');
  $("#ItemSize").val('');
document.getElementById("ItemForm").reset();
});

displayProducts();

  function displayLowStockItems(){
        $('#tblData tbody').empty();
      $.ajax({
        type:'GET',
        url:'../src/fetchProductDetails.php',
        dataType:'json',
        success:function(response){
            var count = Object.keys(response).length;
            var lowstkqty = 0,totitemsqty = 0;
            for(var i=0;i<count;i++){
             lowstkqty = parseInt(response[i].ReorderLabel);
             totitemsqty = parseInt(response[i].Quantity);
              if(totitemsqty < lowstkqty || totitemsqty < 1 ){
              $("#tblDatabody").append('<tr><td>'
              +response[i].ItemName+'</td><td>'
              +response[i].SKU+'</td><td>'+response[i].HSN+'</td><td>'
              +response[i].Description+'</td><td>'+response[i].price+'</td><td>'
              +response[i].Quantity+'</td><td style="color: #ff8000">'
              +response[i].ReorderLabel+'</td><td><button class=" btn-link dropdown-toggle" type="button" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="editProducts('
              +response[i].ItemId+')">View/Edit</a><a class="dropdown-item" href="#" onclick="removeProducts('+response[i].ItemId+')" >Delete</a></div></td></tr>');
              }

          }
          $('#tblData').DataTable({
            searching: true,
            retrieve: true,
            bPaginate: $('tbody tr').length>10,
            order: [],
            columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5,6,7] } ],
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf','print'],
            destroy: true
          });
        }
      });
}


function displayOutStockItems(){
    $('#tblData tbody').empty();
    // $("#tblData").load();
  $.ajax({
    type:'GET',
    url:'../src/fetchProductDetails.php',
    dataType:'json',
    success:function(response){
        var count = Object.keys(response).length;
        for(let i=0;i<count;i++){
          if(response[i].Quantity < 1){
            $('#tblDatabody').append('<tr><td>'+response[i].ItemName+'</td><td>'
            +response[i].SKU+'</td><td>'+response[i].HSN+'</td><td>'
            +response[i].Description+'</td><td >'+response[i].price+'</td><td style="color: #d52b1e">'
            +response[i].Quantity+'</td><td >'+response[i].ReorderLabel+'</td><td><button class=" btn-link dropdown-toggle" type="button" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="editProducts('
            +response[i].ItemId+')">View/Edit</a><a class="dropdown-item" href="#" onclick="removeProducts('+response[i].ItemId+')" >Delete</a></div></td></tr>');
          }
      }
      $('#tblData').DataTable({
        searching: true,
        retrieve: true,
        bPaginate: $('tbody tr').length>10,
        order: [],
        columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5,6,7] } ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf','print'],
        destroy: true
      });
      }
  });
}



function displayProducts(){
    $('#tblData tbody').empty();
  var tblData = '';
  $.ajax({
    type:'GET',
    url:'../src/fetchProductDetails.php',
    dataType:'json',
    success:function(response){
      var count = Object.keys(response).length;
      var lowstkqty = 0,totitemsqty = 0;
      var LowStkQty = 0;
      var OutStkQty = 0;
        if(count > 0){
          for(var i=0;i<count;i++){
            lowstkqty = parseInt(response[i].ReorderLabel);
            totitemsqty = parseInt(response[i].Quantity);

                  if(totitemsqty < lowstkqty || totitemsqty < 1 ){LowStkQty++;}

              if(response[i].Quantity < 1){OutStkQty ++;}

              $('#tblDatabody').append('<tr><td>'+response[i].ItemName+'</td><td>'
                          +response[i].SKU+'</td><td>'+response[i].HSN+'</td><td>'
                          +response[i].Description+'</td><td>'+response[i].price+'</td><td>'+response[i].Quantity+'</td><td>'+response[i].ReorderLabel+
                          '</td><td><button class="btn-link dropdown-toggle" type="button" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="editProducts('+response[i].ItemId+')">View/Edit</a><a class="dropdown-item" href="#" onclick="removeProducts('+response[i].ItemId+')" >Delete</a></div></td></tr>');
                        }
            $('#OutStkQty').html(OutStkQty);
            $('#LowStkQty').html(LowStkQty);
        }
        $('#tblData').DataTable({
          searching: true,
          retrieve: true,
          bPaginate: $('tbody tr').length>10,
          order: [],
          columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5,6,7] } ],
          dom: 'Bfrtip',
          buttons: ['copy','csv', 'excel', 'pdf'],
          destroy: true
        });
    }
  });
}

function CheckUserRole(){
  var retValue;
  $.ajax({
    type:'POST',
    url:'../src/checkuserRole.php',
    dataType:'json',
    data :"",
    async: false,
    success:function(response){
      // alert(response.msg);
      if(response.msg)
        retValue = response.msg;
      else
        retValue = response.msg;
    }
});
// alert(retValue);
return retValue;
}



function editProducts(productId){
  document.getElementById('ItemForm').reset();

  $.ajax({
    type:'GET',
    url:'../src/fetchProductForUpdate.php',
    data:{productId:productId},
    dataType:'json',
    success:function(response){
                $('#ItemId').val(response.ItemId);
                $('#ItemDetailId').val(response.itemDetailId);
                document.getElementById('ItemName').value = response.ItemName;
                document.getElementById('ItemSKU').value = response.SKU;
                document.getElementById('ItemHSN').value = response.HSN;
                $('#ItemUnit').val(response.Unit).trigger('change');
                $('#ItemCategory').val(response.CategoryId).trigger('change');
                document.getElementById('ItemQuantity').value = response.Quantity;
                document.getElementById('ItemReorderLabel').value = response.ReorderLabel;
                document.getElementById('ItemSize').value = response.sizeId;
                $('#ItemSize').val(response.sizeId).trigger('change');
                document.getElementById('ItemSizeQty').value = response.PackingQty;
                document.getElementById('ItemSizeSubQty').value = response.SubPacking;
                $('#PackingTypeId').val(response.PackingTypeId).trigger('change');
                $('#ItemTax').val(response.TaxId).trigger('change');
                document.getElementById('ItemPrice').value = response.price;
                document.getElementById('ItemDescription').value = response.Description;
                // document.getElementById('SupplierId').value = response.SupplierName;
                $('#SupplierId').val(response.SupplierName).trigger('change');
                $('#newproduct').click();

      var FunRetVal = CheckUserRole();
      // alert(FunRetVal);
      if(FunRetVal){
      
        $('#ItemName').prop('disabled', false);
        $('#ItemSKU').prop('disabled', false);
        $('#ItemHSN').prop('disabled', false);
        $('#ItemUnit').prop('disabled', false);
        $('#ItemCategory').prop('disabled', false);     
        $('#ItemSize').prop('disabled', false);
        $('#ItemSizeQty').prop('disabled', false);
        $('#ItemSizeSubQty').prop('disabled', false);
        $('#PackingTypeId').prop('disabled', false);
        $('#ItemTax').prop('disabled', false);
        $('#ItemPrice').prop('disabled', false);
        $('#ItemDescription').prop('disabled',false);
        $('#SupplierId').prop('disabled', false);
      }
      else{
        $('#ItemName').prop('disabled', true);
        $('#ItemSKU').prop('disabled', true);
        $('#ItemHSN').prop('disabled', true);
        $('#ItemUnit').prop('disabled', true);
        $('#ItemCategory').prop('disabled', true);     
        $('#ItemSize').prop('disabled', true);
        $('#ItemSizeQty').prop('disabled', true);
        $('#ItemSizeSubQty').prop('disabled', true);
        $('#PackingTypeId').prop('disabled', true);
        $('#ItemTax').prop('disabled', true);
        $('#ItemPrice').prop('disabled', true);
        $('#ItemDescription').prop('disabled',true);
        $('#SupplierId').prop('disabled', true);
      }

    }
  });
// debugger;
}

// function editProducts(productId){
//     document.getElementById('ItemForm').reset();
   
//   var FunRetVal = CheckUserRole();
//           if(FunRetVal){
//             alert(FunRetVal);
//             $.ajax({
//               type:'GET',
//               url:'../src/fetchProductForUpdate.php',
//               data:{productId:productId},
//               dataType:'json',
//               success:function(response){

//                 $('#ItemId').val(response.ItemId);
//                 $('#ItemDetailId').val(response.itemDetailId);
//                 document.getElementById('ItemName').value = response.ItemName;
//                 $('#ItemName').removeAttr('disabled', 'disabled');
//                 // document.getElementById('ItemName')
//                 document.getElementById('ItemSKU').value = response.SKU;
//                 $('#ItemSKU').removeAttr('disabled', 'disabled');
//                 document.getElementById('ItemHSN').value = response.HSN;
//                 $('#ItemHSN').removeAttr('disabled', 'disabled');

//                 $('#ItemUnit').val(response.Unit).trigger('change');
//                 $('#ItemUnit').removeAttr('disabled', 'disabled');

//                 $('#ItemCategory').val(response.CategoryId).trigger('change');
//                 $('#ItemCategory').removeAttr('disabled', 'disabled');


//                 document.getElementById('ItemQuantity').value = response.Quantity;
//                 document.getElementById('ItemReorderLabel').value = response.ReorderLabel;
//                 document.getElementById('ItemSize').value = response.sizeId;
              
//                 $('#ItemSize').val(response.sizeId).trigger('change').removeAttr('disabled', 'disabled');
                
//                 document.getElementById('ItemSizeQty').value = response.PackingQty;
//                 $('#ItemSizeQty').removeAttr('disabled', 'disabled');

//                 document.getElementById('ItemSizeSubQty').value = response.SubPacking;
//                 $('#ItemSizeSubQty').removeAttr('disabled', 'disabled');

//                 $('#PackingTypeId').val(response.PackingTypeId).trigger('change');
//                 $('#PackingTypeId').removeAttr('disabled', 'disabled');
                
//                 $('#ItemTax').val(response.TaxId).trigger('change');
//                 $('#ItemTax').removeAttr('disabled', 'disabled');
//                 document.getElementById('ItemPrice').value = response.price;
//                 $('#ItemPrice').removeAttr('disabled', 'disabled');
//                 document.getElementById('ItemDescription').value = response.Description;
//                 $('#ItemDescription').removeAttr('disabled', 'disabled');

//                 // document.getElementById('SupplierId').value = response.SupplierName;
//                 $('#SupplierId').val(response.SupplierName).trigger('change');
//                 $('#SupplierId').removeAttr('disabled', 'disabled');
//                 $('#newproduct').click();
                
//               },
//             });

//           }else{ 
//             alert(FunRetVal);

//             $.ajax({
//               type:'GET',
//               url:'../src/fetchProductForUpdate.php',
//               data:{productId:productId},
//               dataType:'json',
//               success:function(response){
//                 $('#ItemId').val(response.ItemId);
//                 $('#ItemDetailId').val(response.itemDetailId);
//                 document.getElementById('ItemName').value = response.ItemName;
//                 $('#ItemName').attr('disabled', 'disabled');
//                 // document.getElementById('ItemName')
//                 document.getElementById('ItemSKU').value = response.SKU;
//                 $('#ItemSKU').attr('disabled', 'disabled');
//                 document.getElementById('ItemHSN').value = response.HSN;
//                 $('#ItemHSN').attr('disabled', 'disabled');

//                 $('#ItemUnit').val(response.Unit).trigger('change');
//                 $('#ItemUnit').attr('disabled', 'disabled');

//                 $('#ItemCategory').val(response.CategoryId).trigger('change');
//                 $('#ItemCategory').attr('disabled', 'disabled');


//                 document.getElementById('ItemQuantity').value = response.Quantity;
//                 document.getElementById('ItemReorderLabel').value = response.ReorderLabel;
//                 document.getElementById('ItemSize').value = response.sizeId;
              
//                 $('#ItemSize').val(response.sizeId).trigger('change').attr('disabled', 'disabled');
                
//                 document.getElementById('ItemSizeQty').value = response.PackingQty;
//                 $('#ItemSizeQty').attr('disabled', 'disabled');

//                 document.getElementById('ItemSizeSubQty').value = response.SubPacking;
//                 $('#ItemSizeSubQty').attr('disabled', 'disabled');

//                 $('#PackingTypeId').val(response.PackingTypeId).trigger('change');
//                 $('#PackingTypeId').attr('disabled', 'disabled');
                
//                 $('#ItemTax').val(response.TaxId).trigger('change');
//                 $('#ItemTax').attr('disabled', 'disabled');
//                 document.getElementById('ItemPrice').value = response.price;
//                 $('#ItemPrice').attr('disabled', 'disabled');
//                 document.getElementById('ItemDescription').value = response.Description;
//                 $('#ItemDescription').attr('disabled', 'disabled');

//                 // document.getElementById('SupplierId').value = response.SupplierName;
//                 $('#SupplierId').val(response.SupplierName).trigger('change');
//                 $('#SupplierId').attr('disabled', 'disabled');

//                 $('#newproduct').click();
//               },
//             });

//           }
  
//         }
    


function removeProducts(productId){
  var r = confirm('Are You sure To Remove This Product Parmanetly');
  if(r === true){
    $.ajax({
      type:'DELETE',
      url:'../src/removeProduct.php',
      data:{productId:productId},
      dataType:'json',
      success:function(response){
        app.toast(response.msg, {
          actionTitle: 'Success',
          // actionUrl: 'something',
          actionColor: 'success',
          duration: 4000
        });
        displayProducts();
      }
    });
  }
}
