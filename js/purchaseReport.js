DisplayPurchaseReportTblData();

function DisplayPurchaseReportTblData(){
  var fromDate = "";
  var toDate = "";
  var tblData = ''

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
              }
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
                 dom: 'Bfrtip',
                 buttons: ['copy', 'excel', 'pdf', 'print'],
                 destroy: true
             });
            }
    });

}



function DisplayPurchaseReportTblDataOnclick(){

  var fromDate = document.getElementById('fromDate').value;

  var toDate = document.getElementById('toDate').value;
  var i=0;
  var tblData = '';
  if(fromDate == ""){
    $('#fromDate').focus();
    i=1;
  }
  else {
    // var fromDate = moment(new Date(fdate)).format("YYYY-MM-DD");
    var fromDate = moment(new Date(fromDate)).format("YYYY-MM-DD");

  }
  if(toDate == ""){
      $('#toDate').focus();
      i=1;
  }
  else{
      // var toDate = moment(new Date(tdate)).format("YYYY-MM-DD");
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
            //  alert(response.msg);
              // alert(count);
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
                  }
                  $('#tblData').html(tblData);
            }
            else{
                var msg = response.msg;
                // $('#allSalesTbl').attr('data-provide','datatables');
                $('#noDataDiv').show();
                $('#noDataDiv').html(msg);
            }
          }
    });

}

}
