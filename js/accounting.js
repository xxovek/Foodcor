
display();

function display(){
  $('#tblData tbody').empty();
var tblData = '';
$.ajax({
  type:'POST',
  url:'../src/fetchAccounting.php',
  dataType:'json',
  success:function(response){
    // alert(response)
    var count = Object.keys(response).length;
      if(count > 0){
        for(var i=0;i<count;i++){
            $('#tblDatabody').append('<tr><td class="text-center">'+(i + 1)+'</td><td>'
            +response[i].mainCategory+'</td><td>'
            +response[i].subCategory+'</td><td>'
            +response[i].TAX+'</td><td>'
            +response[i].BALANCE+
            '</td><td class="text-center"><button class="btn-link s" onclick="display1('+response[i].aid+');" type="button" >Account History</button></td></tr>');
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
function display1(param){
  $('#tbl').hide();
  $('#tblData1').show();

var tblData = '';
$.ajax({
  type:'POST',
  url:'../src/fetchAccountingHistory.php',
  dataType:'json',
  data:{aid:param},
  success:function(response){
    // alert(response)
    var count = Object.keys(response).length;
      if(count > 0){
        for(var i=0;i<count;i++){

            $('#tblDatabody1').append('<tr><td class="text-center">'+(i + 1)+'</td><td>'
            +response[i].DateCreated+'</td><td>'
            +response[i].InvoiceNumber+'</td><td>'
            +response[i].payee+'</td><td>'
            +response[i].TOTAL+
            '</td><td>'+response[i].DueDate+'</td><td>0</td></tr>');
          }
      }

      $('#tblData1').DataTable({
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
