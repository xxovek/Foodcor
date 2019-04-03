displaySuperStockages();
function displaySuperStockages() {
    var tblData = ' ';
    $.ajax({
        type: "POST",
        url: "../src/displaySuperStockage.php",
        dataType: "json",
        success: function(response) {
            var count = response.length;

            if (count > 0) {
                for (var i = 0; i < count; i++) {
                    tblData  += '<tr><th scope="row">'+(i+1)+'</th>';
                    tblData  += '<td>'+response[i].companyName+'</td>';
                    tblData  += '<td>'+response[i].PersonName+'</td>';
                    tblData  += '<td>'+response[i].Distributor+'</td>';
                    tblData  += '<td>'+response[i].Registered+'</td>';
                    tblData  += '<td><button class="btn btn-primary" onclick="completeinformation('+response[i].companyId+')">Detail</button> </td>' ;
                    tblData  += '</tr>';
                }
                $('#tblDatabody').html(tblData);
                var countTable = $('thead tr th').length;
                var arr = [];
                for (var i = 0; i < countTable; i++) {
                    arr.push(i);
                }
                $('#tblData').DataTable({
                    bPaginate: $('tbody tr').length > 10,
                    order: [],
                    columnDefs: [{
                        orderable: false,
                        targets: arr
                    }],
                    dom: 'Bfrtip',
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });
            } else {

            }

        }
    });
}

function completeinformation(param){

  window.location.href="Detailinfodistributors.php?id="+param+"";

}
