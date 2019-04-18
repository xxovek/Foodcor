function DisplayPurchaseReportTblDataOnclick(){
  var month = document.getElementById('month').value;
  var i=0;
  var tblData,tfootData = '';
  var invValue = 0.00;
  var taxableValue=0.00;
  var CGST=0.00;
  var SGST=0.00;
  var totalGst = 0.00;
  if(month == ""){
    $('#month').focus();
    i=1;
  }
if(i === 0){
    $('#allSalesTbldiv').hide();
    $.ajax({
            url:"../src/displayMonthlyPurchaseReport.php",
            method:"POST",
            dataType:"json",
            data:{month:month,TransactionType:2},
            success:function(response){
              var count = Object.keys(response).length;
                 $('#allSalesTbldiv').show();
                 $('#noDataDiv').hide();
                for (var i = 0; i < count; i++) {
                  invValue += parseFloat(response[i].Total);
                  taxableValue +=parseFloat(response[i].TotalBeforeTax);
                  CGST +=parseFloat(response[i].CGST);
                  SGST +=parseFloat(response[i].SGST);
                  totalGst +=parseFloat(response[i].TotalGST);
                    tblData  += '<tr><th scope="row">'+(i+1)+'</th>';
                    tblData  += '<td>'+response[i].InvoiceNumber+'</td>';
                    tblData  += '<td>'+response[i].DateCreated+'</td>';
                    tblData  += '<td>'+response[i].name+'</td>';
                    tblData  += '<td>'+parseFloat(response[i].Total).toFixed(2)+'</td>';
                    tblData  += '<td>'+parseFloat(response[i].TotalBeforeTax).toFixed(2)+'</td>';
                    tblData  += '<td>'+parseFloat(response[i].CGST).toFixed(2)+'</td>';
                    tblData  += '<td>'+parseFloat(response[i].SGST).toFixed(2)+'</td>';
                    tblData  += '<td>'+parseFloat(response[i].TotalGST).toFixed(2)+'</td></tr>';
                  }
                  tfootData += '<tr style="font-weight:bold"><td></td><td></td><td></td><td>Total</td><td>'+invValue.toFixed(2)+'</td><td>'+taxableValue.toFixed(2)+'</td><td>'+CGST.toFixed(2)+'</td><td>'+ SGST.toFixed(2)+'</td><td>'+totalGst.toFixed(2)+'</td></tr>';
                  $('#tblData').html(tblData);
                  $('#tfootData').html(tfootData);

                  $('#allSalesTbl').DataTable({
                    bPaginate: $('tbody tr').length > 10,
                      order: [],
                      columnDefs: [{
                          orderable: false,
                          targets: [0,1,2,3,4,5,6,7,8]
                      }],
                      searching: true,
                    retrieve: true,
                    destroy: true,
                      dom: 'Bfrtip',
                      buttons: [
                        { extend: 'copy', footer: true },
                        { extend: 'excel', footer: true },
                        { extend: 'csv', footer: true },
                        { extend: 'pdf', footer: true },
                        { extend: 'print', footer: true }
                    ]
                   
                });
            }
    });
}
}

function DisplaySalesReportTblDataOnclick(){
  $('#tblData').empty();
  $('#tfootData').empty();
    var month = document.getElementById('month').value;
    var i=0;
    var tblData,tfootData = '';
  var invValue = 0.00;
  var taxableValue=0.00;
  var CGST=0.00;
  var SGST=0.00;
  var totalGst = 0.00;
    if(month == ""){
      $('#month').focus();
      i=1;
    }
  if(i === 0){
      $('#allSalesTbldiv').hide();
      $.ajax({
              url:"../src/displayMonthlyPurchaseReport.php",
              method:"POST",
              dataType:"json",
              data:{month:month,TransactionType:1},
              success:function(response){
                var count = Object.keys(response).length;
                   $('#allSalesTbldiv').show();
                   $('#noDataDiv').hide();
                  for (var i = 0; i < count; i++) {
                    invValue += parseFloat(response[i].Total);
                    taxableValue +=parseFloat(response[i].TotalBeforeTax);
                    CGST +=parseFloat(response[i].CGST);
                    SGST +=parseFloat(response[i].SGST);
                    totalGst +=parseFloat(response[i].TotalGST);
                      tblData  += '<tr><th scope="row">'+(i+1)+'</th>';
                      tblData  += '<td>'+response[i].InvoiceNumber+'</td>';
                      tblData  += '<td>'+response[i].DateCreated+'</td>';
                      tblData  += '<td>'+response[i].name+'</td>';
                      tblData  += '<td>'+parseFloat(response[i].Total).toFixed(2)+'</td>';
                      tblData  += '<td>'+parseFloat(response[i].TotalBeforeTax).toFixed(2)+'</td>';
                      tblData  += '<td>'+parseFloat(response[i].CGST).toFixed(2)+'</td>';
                      tblData  += '<td>'+parseFloat(response[i].SGST).toFixed(2)+'</td>';
                      tblData  += '<td>'+parseFloat(response[i].TotalGST).toFixed(2)+'</td></tr>';
                    }
                    tfootData += '<tr style="font-weight:bold"><td></td><td></td><td></td><td>Total</td><td>'+invValue.toFixed(2)+'</td><td>'+taxableValue.toFixed(2)+'</td><td>'+CGST.toFixed(2)+'</td><td>'+ SGST.toFixed(2)+'</td><td>'+totalGst.toFixed(2)+'</td></tr>';
                    $('#tblData').html(tblData);
                    $('#tfootData').html(tfootData);
                    $('#allSalesTbl').DataTable({
                      bPaginate: $('tbody tr').length > 10,
                      order: [],
                      columnDefs: [{
                          orderable: false,
                          targets: [0,1,2,3,4,5,6,7,8]
                      }],
                    searching: true,
                    retrieve: true,
                    destroy: true,
                      dom: 'Bfrtip',
                      buttons: [
                        { extend: 'copy', footer: true },
                        { extend: 'excel', footer: true },
                        { extend: 'csv', footer: true },
                        { extend: 'pdf', footer: true },
                        { extend: 'print', footer: true }
                    ]
                  });
              }
      });
  }
  }