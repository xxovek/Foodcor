function cal_bal(param1) {
  var param= moment(new Date(param1)).format("YYYY-MM-DD");
  var item=$("#item").val();
  $.ajax({
            url:"../src/openingBal.php",
            method:"POST",
            dataType:"json",
            data:{fromDate:param,item:item},
            success:function(response){
            $("#O_bal").html("Opening Balance: "+response.O_BAL);
            $("#C_bal").html("");
            }
    });
}

function displayStockLedger(){
  var fromDate = document.getElementById('fromDate').value;
  var toDate = document.getElementById('toDate').value;
  var iname = document.getElementById('item').value;
  var res =$('#O_bal').html();
   var Obal = res.split(' ');
  var i=0;
  var tblData = '';
  if(iname==""){
    $('#item').focus();
    i=1;
  }
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
            url:"../src/displayStockLedger.php",
            method:"POST",
            dataType:"json",
            data:{fromDate:fromDate,toDate:toDate,item:iname,Obal:Obal[2]},
            success:function(response){
              var count = Object.keys(response).length;
            //  alert(response.msg);
              // alert(response);
              if(response.msg === undefined){
                 $('#allSalesTbldiv').show();
                 $('#noDataDiv').hide();
                for (var i = 0; i < count; i++) {
                    tblData  += '<tr class="text-center"><th style="width:5%"  scope="row">'+(i+1)+'</th>';
                    tblData  += '<td style="width:15%" >'+response[i].DateCreated+'</td>';
                    tblData  += '<td style="width:10%">'+response[i].Quantity+'</td>';
                    tblData  += '<td style="width:15%" >'+response[i].type+'</td>';
                    tblData  += '<td style="width:15%">'+response[i].tNo+'</td>';
                    tblData  += '<td style="width:10%">'+response[i].Rate+'</td>';
                    tblData  += '<td style="width:20%">'+response[i].supplierName+'</td>';
                    tblData  += '<td style="width:10%">'+response[i].stock+'</td></tr>';
                  }
                  $('#tblData').html(tblData);
                  $("#C_bal").html("Closing Balance: "+response[count-1].stock);
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
            else{
                var msg = response.msg;

                $('#noDataDiv').show();
                $('#noDataDiv').html(msg);
            }
          }
    });

}

}
