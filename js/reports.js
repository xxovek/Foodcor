function DisplayOpeningClosingData() {
    var fromDate = document.getElementById('fromDate').value;
    var toDate = document.getElementById('toDate').value;

    var response = [];
    var tblData = '';
    var tfootData = '';
    var  openB =0,purB=0,saleB=0,closeB=0;
    var i = 0;
    if (fromDate === "") {
        $('#fromDate').focus();
        i = 1;
    } else {
        var fromDate = moment(new Date(fromDate)).format("YYYY-MM-DD");
    }
    if (toDate === "") {
        $('#toDate').focus();
        i = 1;
    } else {
        var toDate = moment(new Date(toDate)).format("YYYY-MM-DD");
    }
    if (i === 0) {
        $.ajax({
            url: "../src/openingClosingReport.php",
            method: "POST",
            dataType: "json",
            data: {
                fromDate: fromDate,
                toDate: toDate
            },
            success: function(response) {
                var count = Object.keys(response).length;
                for (var i = 0; i < count; i++) {
                    tblData += '<tr><th scope="row">' + (i + 1) + '</th>';
                    tblData += '<td>' + response[i].ProductName + '</td>';
                    tblData += '<td>' + response[i].OpeningBal + '</td>';
                    tblData += '<td>' + response[i].PurchaseBal + '</td>';
                    tblData += '<td>' + response[i].Sale + '</td>';
                    tblData += '<td>' + response[i].ClosingBal + '</td></tr>';
                    openB += parseInt(response[i].OpeningBal);
                    purB += parseInt(response[i].PurchaseBal);
                    saleB += parseInt(response[i].Sale);
                    closeB += parseInt(response[i].ClosingBal);
                }
                $('#tblData').html(tblData);
                tfootData += '<tr style="font-weight:bold"><td></td><td>Total</td><td>'+openB.toFixed(2)+'</td><td>'+purB.toFixed(2)+'</td><td>'+saleB.toFixed(2)+'</td><td>'+closeB.toFixed(2)+'</td></tr>';
                $('#tfootData').html(tfootData);
                $('#allSalesTbl').DataTable({
                    searching: true,
                    retrieve: true,
                    bPaginate: $('tbody tr').length > 10,
                    order: [],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 2, 3, 4, 5]
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

}
