DisplayInvoiceTblData();
function DisplayInvoiceTblData(){
    $("#invoiceTblBody").empty();
    $('#tfootData').empty();
  var TotalRevenue = 0.00;
  var TotalBalance = 0.00;
  var tfootData = '';
    $.ajax({
            url:"../src/displayInvoice.php",
            type:"POST",
            dataType:"json",
            data:{Ttype:1},
            success:function(response){
              var count = response.length;
              for (var i = 0; i < count; i++) {

                $("#invoiceTblBody").append('<tr><th scope="row">'+(i + 1)+'</th><td>'
                +response[i].InvoiceNumber+'</td><td>'
                +response[i].name+'</td><td>'
                +response[i].DateCreated+'</td><td>'
                +response[i].DueDate+'</td><td>'
                +parseFloat(response[i].Balance).toFixed(2)+'</td><td>'
                +parseFloat(response[i].Total).toFixed(2)+'</td><td>'
                +response[i].status+
                '</td><td><button class=" btn-link dropdown-toggle" type="button" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="PrintInvoice('+response[i].TId+')">Print</a><a class="dropdown-item" href="#modal-invoice"  data-formid="1" data-formtype="U" data-transactionid="'+response[i].TId+'"  data-toggle="modal">Edit</a><a class="dropdown-item" href="#" onclick="EditInvoice('+response[i].TId+')">View</a><a class="dropdown-item" href="#" onclick="DeleteInvoice('+response[i].TId+')">Delete</a></div></td></tr>');
                TotalRevenue +=parseFloat(response[i].Total);
                TotalBalance +=parseFloat(response[i].Balance);
              }
              tfootData += '<tr style="font-weight:bold"><td></td><td></td><td></td><td></td><td>Total</td><td>'+TotalBalance.toFixed(2)+'</td><td>'+TotalRevenue.toFixed(2)+'</td><td></td><td></td></tr>';
              $('#tfootData').html(tfootData);
              $('#totalRevenue').html(TotalRevenue.toFixed(2));
              $('#totalOrders').html(count);
              $('#invoiceTbl').DataTable({
                searching: true,
                retrieve: true,
                bPaginate: $('tbody tr').length>10,
                order: [],
                columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5,6,7,8] } ],
                dom: 'Bfrtip',
                buttons: ['copy','csv', 'excel','pdf'],
                destroy: true
              });
              }
            });
}

function DeleteInvoice(TransactionId){
var formid = 1;
var r = confirm("Are You Sure To Remove This Invoice");
  if (r == true) {
    $.ajax({
          url: "../src/removetransactionmasterrecord.php",
          type: "POST",
          data: {
              transactionId:TransactionId,
              formid:formid
                },
          dataType: "json",
            success: function () {
                  alert('Invoice Deleted successfull');
                  DisplayInvoiceTblData();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert('Error While Delete Invoice');
                  DisplayInvoiceTblData();
                }
            });
  }
}

function PrintInvoice(TransactionId){
  window.location.href="invoicePdf.php?tid="+TransactionId;
}

function EditInvoice(TransactionId){
  window.location.href="invoicePdfView.php?tid="+TransactionId;
}
