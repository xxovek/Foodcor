DisplayPurchaseReportTblData();
function DisplayPurchaseReportTblData(){
  var fromDate = "";
  var toDate = "";
  var tblData = ''
  var tfootData = '';
  var tQty = 0,total=0;
    $.ajax({
            url:"../src/displayPurchaseReport.php",
            method:"POST",
            dataType:"json",
            data:{fromDate:fromDate,toDate:toDate},
            success:function(response){
              var count = Object.keys(response).length;
              for (var i = 0; i < count; i++) {
                tblData  += '<tr><th scope="row">'+(i+1)+'</th>';
                tblData  += '<td>'+response[i].ProductName+'</td>';
                tblData  += '<td>'+response[i].Description+'</td>';
                tblData  += '<td>'+response[i].DateCreated+'</td>';
                tblData  += '<td>'+response[i].Quantity+'</td>';
                tblData  += '<td>'+response[i].Rate+'</td>';
                tblData  += '<td>'+response[i].Total+'</td>';
                tblData  += '<td>'+response[i].supplierName+'</td></tr>';
                tQty += parseInt(response[i].Quantity);
                total += parseFloat(response[i].Total);
              }
              tfootData += '<tr style="font-weight:bold"><td></td><td>Total</td><td></td><td></td><td>'+tQty.toFixed(2)+'</td><td></td><td>'+total.toFixed(2)+'</td><td></td></tr>';
              $('#tfootData').html(tfootData);
             $('#tblData').html(tblData);
             $('#allSalesTbl').DataTable({
                 searching: true,
                 retrieve: true,
                 bPaginate: $('tbody tr').length > 10,
                 order: [],
                 columnDefs: [{
                     orderable: false,
                     targets: [0, 1, 2, 3, 4, 5,6,7]
                 }],
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

function DisplayPurchaseReportTblDataOnclick(){
  var fromDate = document.getElementById('fromDate').value;
  var tfootData = '';
  var tQty = 0,total=0;
  var toDate = document.getElementById('toDate').value;
  var i=0;
  var tblData = '';
  if(fromDate == ""){
    $('#fromDate').focus();
    i=1;
  }
  else {
    var fromDate = moment(new Date(fromDate)).format("YYYY-MM-DD");
  }
  if(toDate == ""){
      $('#toDate').focus();
      i=1;
  }
  else{
      var toDate = moment(new Date(toDate)).format("YYYY-MM-DD");
  }
  if(i === 0){
    $('#allSalesTbldiv').hide();
    $.ajax({
            url:"../src/displayPurchaseReport.php",
            method:"POST",
            dataType:"json",
            data:{fromDate:fromDate,toDate:toDate},
            success:function(response){
              var count = Object.keys(response).length;
              if(response.msg === undefined){
                 $('#allSalesTbldiv').show();
                 $('#noDataDiv').hide();
                for (var i = 0; i < count; i++) {
                    tblData  += '<tr><th scope="row">'+(i+1)+'</th>';
                    tblData  += '<td>'+response[i].ProductName+'</td>';
                    tblData  += '<td>'+response[i].Description+'</td>';
                    tblData  += '<td>'+response[i].DateCreated+'</td>';
                    tblData  += '<td>'+response[i].Quantity+'</td>';
                    tblData  += '<td>'+response[i].Rate+'</td>';
                    tblData  += '<td>'+response[i].Total+'</td>';
                    tblData  += '<td>'+response[i].supplierName+'</td></tr>';
                    tQty += parseInt(response[i].Quantity);
                    total += parseFloat(response[i].Total);
                  }
              tfootData += '<tr style="font-weight:bold"><td></td><td>Total</td><td></td><td></td><td>'+tQty.toFixed(2)+'</td><td></td><td>'+total.toFixed(2)+'</td><td></td></tr>';
              $('#tfootData').html(tfootData);
             $('#tblData').html(tblData);
             $('#allSalesTbl').DataTable({
                 searching: true,
                 retrieve: true,
                 bPaginate: $('tbody tr').length > 10,
                 order: [],
                 columnDefs: [{
                     orderable: false,
                     targets: [0, 1, 2, 3, 4, 5,6,7]
                 }],
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
            else{
                var msg = response.msg;
                $('#noDataDiv').show();
                $('#noDataDiv').html(msg);
            }
          }
    });
}
}
