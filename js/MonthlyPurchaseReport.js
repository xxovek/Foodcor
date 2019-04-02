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
                    tblData  += '<td>'+response[i].Total+'</td>';
                    tblData  += '<td>'+response[i].TotalBeforeTax+'</td>';
                    tblData  += '<td>'+response[i].CGST+'</td>';
                    tblData  += '<td>'+response[i].SGST+'</td>';
                    tblData  += '<td>'+response[i].TotalGST+'</td></tr>';
                  }
                  tfootData += '<tr><td></td><td></td><td></td><td>Total</td><td>'+invValue+'</td><td>'+taxableValue+'</td><td>'+CGST+'</td><td>'+ SGST+'</td><td>'+totalGst+'</td></tr>';
                  $('#tblData').html(tblData);
                  $('#tfootData').html(tfootData);
            }
    });
}
}

function DisplaySalesReportTblDataOnclick(){
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
                      tblData  += '<td>'+response[i].Total+'</td>';
                      tblData  += '<td>'+response[i].TotalBeforeTax+'</td>';
                      tblData  += '<td>'+response[i].CGST+'</td>';
                      tblData  += '<td>'+response[i].SGST+'</td>';
                      tblData  += '<td>'+response[i].TotalGST+'</td></tr>';
                    }
                    tfootData += '<tr><td></td><td></td><td></td><td>Total</td><td>'+invValue+'</td><td>'+taxableValue+'</td><td>'+CGST+'</td><td>'+ SGST+'</td><td>'+totalGst+'</td></tr>';
                    $('#tblData').html(tblData);
                    $('#tfootData').html(tfootData);
              }
      });
  }
  }