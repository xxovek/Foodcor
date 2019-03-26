DisplayInvoiceTblData();
function DisplayInvoiceTblData(){
    $("#purchaseTblBody").empty();
  var TotalRevenue = 0;
    $.ajax({
            url:"../src/displayInvoice.php",
            type:"POST",
            dataType:"json",
            data:{Ttype:2},
            success:function(response){
              var count = response.length;
              for (var i = 0; i < count; i++) {
                $("#purchaseTblBody").append('<tr><th scope="row">'+(i + 1)+'</th><td>'
                +response[i].InvoiceNumber+'</td><td>'
                +response[i].name+'</td><td>'
                +response[i].DateCreated+'</td><td>'
                +response[i].DueDate+'</td><td>'
                +response[i].Balance+'</td><td>'
                +response[i].Total+'</td><td>'
                +response[i].status+
                '</td><td><button class=" btn-link dropdown-toggle" type="button" data-toggle="dropdown">Edit</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="PrintInvoice('+response[i].TId+')">Print</a><a class="dropdown-item" href="#modal-invoice"  data-formid="2" data-formtype="U" data-transactionid="'+response[i].TId+'"  data-toggle="modal">Edit</a><a class="dropdown-item" href="#" onclick="EditInvoice('+response[i].TId+')">View</a><a class="dropdown-item" href="#" onclick="DeleteInvoice('+response[i].TId+')">Delete</a></div></td></tr>');
                // alert(response[i].Total);
                TotalRevenue +=parseFloat(response[i].Total);
              }
              // alert(TotalRevenue);
              $('#totalRevenue').html(TotalRevenue.toFixed(2));
              $('#totalOrders').html(count);
              $('#purchaseTbl').DataTable({
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
var formid = 2;
var r = confirm("Are You Sure To Remove This Purchase");
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
                  alert('Invoice Deleted successfull')
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert('Error While Delete Invoice')
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
