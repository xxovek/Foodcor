DisplayInvoiceTblData();
function DisplayInvoiceTblData(){
    $("#purchaseTblBody").empty();
  var TotalRevenue = 0;
  var TotalBalance = 0;
  var tfootData = '';
    $.ajax({
            url:"../src/displayPurchaseForCustomer.php",
            type:"POST",
            dataType:"json",
            data:{Ttype:1},
            success:function(response){
              var count = response.length;
              for (var i = 0; i < count; i++) {
                  var btnData = '';
                  var status = isPersonExists(response[i].emailId);
                    if(status==1){
                        btnData = '</td><td><a class="dropdown-item" href="#modal-invoice"  data-formid="2" data-formtype="U" data-transactionid="'+response[i].TId+'"  data-toggle="modal">Accept</a></td></tr>';
                    }else{
                        btnData = '</td><td><button class="btn-link" type="button" onclick="AddSupplier('+response[i].companyId+',\'' + response[i].emailId + '\')">Add As Supplier</button></td></tr>';
                    }
                $("#purchaseTblBody").append('<tr><th scope="row">'+(i + 1)+'</th><td>'
                +response[i].InvoiceNumber+'</td><td>'
                +response[i].name+'</td><td>'
                +response[i].DateCreated+'</td><td>'
                +response[i].DueDate+'</td><td>'
                +parseFloat(response[i].Balance).toFixed(2)+'</td><td>'
                +parseFloat(response[i].Total).toFixed(2)+'</td><td>'
                +response[i].status+btnData);
                TotalRevenue +=parseFloat(response[i].Total);
                TotalBalance +=parseFloat(response[i].Balance);
              }
              tfootData += '<tr style="font-weight:bold"><td></td><td></td><td></td><td></td><td>Total</td><td>'+TotalBalance.toFixed(2)+'</td><td>'+TotalRevenue.toFixed(2)+'</td><td></td><td></td></tr>';
              $('#tfootData').html(tfootData);
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

function isPersonExists(EmailId){
    var sta1 = 0;
    $.ajax({
        type:'GET',
        url:'../src/getPersonExists.php',
        data:{EmailId:EmailId},
        dataType:'json',
        async: false,
        success:function(response){
            if(response.msg){
                sta1 = response.msg;
            }else{
                sta1 = response.msg;
            }
        }
    })
return sta1;
}

function AddSupplier(companyId,EmailId){
    $.ajax({
        type:'GET',
        url:'../src/AddSupplierPurchaseForm.php',
        data:{EmailId:EmailId,companyId:companyId},
        dataType:'json',
        success:function(response){
           app.toast(response.msg, {
            actionTitle: 'Success',
            // actionUrl: 'something',
            actionColor: 'success',
            duration: 4000
          });
          DisplayInvoiceTblData();
        }
    })
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
