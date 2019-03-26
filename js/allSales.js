DisplayAllSalesTblData();

function DisplayAllSalesTblData(){
    $.ajax({
            url:"../src/displayAllSalesTblData.php",
            type:"POST",
            dataType:"json",
            success:function(response){
              for (var i = 0; i < response.length; i++) {
                $("#allSalesTblBody").append('<tr><th scope="row">'+(i + 1)+'</th><td>'
                +response[i].DateCreated+'</td><td>'
                +response[i].tranType+'</td><td>'
                +response[i].InvoiceNumber+'</td><td>'
                +response[i].name+'</td><td>'
                +response[i].DueDate+'</td><td>'
                +response[i].Balance+'</td><td>'
                +response[i].TotalBeforeTax+'</td><td>'
                +response[i].Tax+'</td><td>'
                +response[i].Total+'</td><td>'+response[i].status+'</td><td><button class=" btn-link dropdown-toggle" type="button" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="Print('+response[i].TId+')">Print</a><a class="dropdown-item" href="#" onclick="EditTransaction('+response[i].TId+')">View/Edit</a><a class="dropdown-item" href="#" onclick="Delete('+response[i].TId+')">Delete</a></div></td></tr>');
              }
  var countTable = $('thead tr th').length;
  var arr = [];
  for(var i=0;i<countTable;i++){
    arr.push(i);
  }
  $('#allSalesTbl').DataTable({
    bPaginate: $('tbody tr').length>10,
    order: [],
    columnDefs: [ { orderable: false, targets: arr } ],
    dom: 'Bfrtip',
    buttons: ['copy','csv', 'excel','pdf']
  });
            }

    });

}


function Delete(TransactionId){
alert(TransactionId);
}

function Print(tid){
  window.location.href="invoicePdf.php?tid="+tid;
}

function EditTransaction(tid){
  window.location.href="invoicePdfView.php?tid="+tid;
}
