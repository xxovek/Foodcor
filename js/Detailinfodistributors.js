
function showcompanydetail(param){
  $.ajax({
    url:'../src/companyDetails1.php',
    data:{companyId:param},
    success:function(response){
      // alert(response);
      var response = JSON.parse(response);
      var html ="";
      html +='<div class="col-lg-12">';
      html +='  <div class="card">';
      html +='    <h4 class="card-title"><strong>'+response['cName']+'</strong></h4>';
      html +='    <div class="row">';
      html +='    <div class="col-sm-12">';
      html +='      <div class="card-body">';
      html +='        <label>Address: </label> '+response['addr']+','+response['country']+','+response['state']+','+response['city'];
      html +='      </div>';
      html +='    </div>';
      html +='  </div>';
      html +='    <div class="row">';
      html +='    <div class="col-sm-4">';
      html +='      <div class="card-body">';
      html +='        <label>Contact Number :</label> '+response['phone'];
      html +='      </div>';
      html +='    </div>';
      html +='    <div class="col-sm-4">';
      html +='      <div class="card-body">';
      html +='      <label> City :</label> '+response['city'];
      html +='      </div>';
      html +='    </div>';
      html +='    <div class="col-sm-4">';
      html +='      <div class="card-body">';
      html +='      <label> Zipcode :</label> '+response['zip'];
      html +='      </div>';
      html +='    </div>';
      html +='  </div>';
      html +='  </div>';
      html +='</div>';
      $("#showcompanyinfo").html(html);
    }
  });
}


function displayMembers(param) {
    var tblData = ' ';
    $.ajax({
        type: "POST",
        url: "../src/fetchpersonmaster.php",
        data:{companyId:param},
        dataType: "json",
        success: function(response) {
            var count = response.length;

            if (count > 0) {
                for (var i = 0; i < count; i++) {
                    tblData  += '<tr><th scope="row">'+(i+1)+'</th>';
                    tblData  += '<td>'+response[i].CompanyName+'</td>';
                    tblData  += '<td>'+response[i].FirstName+' '+response[i].lastName+'</td>';
                    // tblData  += '<td>'+response[i].EmailId+'</td>';
                    tblData  += '<td>'+response[i].PersonType+'</td>';
                    tblData  += '<td><button class="btn btn-success" onclick="completemember('+response[i].PersonId+')"><i class="fa fa-eye"></i></button> </td>' ;
                    tblData  += '</tr>';
                }
                $('#tblmemberbody').html(tblData);
                var countTable = $('thead tr th').length;
                var arr = [];
                for (var i = 0; i < countTable; i++) {
                    arr.push(i);
                }
                $('#tblData1').DataTable({
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
function completemember(param){
  // alert(param);
  // window.location.href="Detailinfodistributors.php?id="+param+"";
}

function displayProductStock(param) {
  // alert(param);
    var tblData = ' ';
    $.ajax({
        type: "POST",
        url: "../src/displayProductDetail.php",
        data:{companyId:param},
        dataType: "json",
        success: function(response) {
            var count = response.length;
            // alert(count);
            if (count > 0) {
                for (var i = 0; i < count; i++) {
                    tblData  += '<tr><th scope="row">'+(i+1)+'</th>';
                    tblData  += '<td>'+response[i].ItemName+'</td>';
                    tblData  += '<td>'+response[i].Description+'</td>';
                   tblData  += '<td>'+response[i].price+'</td>';
                    tblData  += '<td>'+response[i].Quantity+'</td>';
                    tblData  += '<td><button class="btn btn-success" onclick="completemember1('+response[i].ItemId+')" ><i class="fa fa-eye" ></i></button> </td>' ;
                    tblData  += '</tr>';
                }
                $('#tblproductstockbody').html(tblData);
                var countTable = $('thead tr th').length;
                var arr = [];
                for (var i = 0; i < countTable; i++) {
                    arr.push(i);
                }
                $('#tblData2').DataTable({
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
//
function completemember1(param){
  // alert(param);
}  //
