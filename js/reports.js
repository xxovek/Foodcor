function DisplayOpeningClosingData() {
    // alert('ok');

    var fromDate = document.getElementById('fromDate').value;
    var toDate = document.getElementById('toDate').value;
    // var fromDate = moment(new Date(fdate)).format("YYYY-MM-DD");
    // var toDate = moment(new Date(tdate)).format("YYYY-MM-DD");

    var response = [];
    var tblData = '';
    // alert("fromDate"+fromDate + "toDate"+ toDate );
    var i = 0;
    if (fromDate === "") {
        // alert('ok');
        $('#fromDate').focus();
        i = 1;
    } else {
        // var fromDate = moment(new Date(fdate)).format("YYYY-MM-DD");
        var fromDate = moment(new Date(fromDate)).format("YYYY-MM-DD");

    }
    if (toDate === "") {
        // alert('ok');
        $('#toDate').focus();
        i = 1;
    } else {
        // var toDate = moment(new Date(tdate)).format("YYYY-MM-DD");
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
                }
                $('#tblData').html(tblData);

                $('#allSalesTbl').DataTable({
                    searching: true,
                    retrieve: true,
                    bPaginate: $('tbody tr').length > 10,
                    order: [],
                    columnDefs: [{
                        orderable: false,
                        targets: [0, 1, 2, 3, 4, 5]
                    }],
                    dom: 'Bfrtip',
                    buttons: ['copy', 'excel', 'pdf', 'print'],
                    destroy: true
                });
            }
        });

    }

}
