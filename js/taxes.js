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
   var i=0,serverMethod="POST";
  var TaxId = document.getElementById('TaxId').value;
 var TaxName  = document.getElementById('TaxName').value;
 TaxName = TaxName.trim();
 var TaxDescription  = document.getElementById('TaxDescription').value;
 var TaxType  = document.getElementById('TaxType').value;
 var TaxPercent  = document.getElementById('TaxPercent').value;
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