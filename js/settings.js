$("#tab3").trigger('reset');
fetchCompany();
fetchUser();
displaydocdetails();
displayAdminUsers();
function fetchCompany() {
$.ajax({
  url:'../src/companyDetails.php',
  dataType:'json',
  success:function(response){
    $("#cname").val(response.cName);
    $("#cphone").val(response.phone);
    $("#caddr").val(response.addr);
    $("#ccountry").append('<option value="'+response.country+'" selected>'+response.country+'</option>');
    $("#ccity").append('<option value="'+response.city+'" selected>'+response.city+'</option>');
    $("#czip").val(response.zip);
    $("#cid").val(response.cid);
    $("#cstate").append('<option value="'+response.state+'" selected>'+response.state+'</option>');
    $("#logo1").html('<img class="avatar avatar-xl" src="../public_html/assets/img/'+response.logo+'" alt="...">');
  }
});
}

function fetchUser() {
$.ajax({
  url:'../src/userDetails.php',
  dataType:'json',
  success:function(response){
    $("#uname").val(response.ufname);
    $("#ulname").val(response.ulname);
    $("#umname").val(response.umname);
    $("#uemail").val(response.uemail);
    $("#upwd").val(response.upwd);
    $("#uname1").html(response.ufname+' '+response.ulname);
  }
});
}


$("#btn").on('click',function()
{
  var ccin=$("#cinno").val();
var cpan=$("#PAN").val();
var cadhar=$("#companyadhar").val();
var cpassport=$("#companypassport").val();
var cgstin=$("#GSTIN").val();
$.ajax({
  url:'../src/addDocument.php',
  data:{ccin:ccin,cpan:cpan,cadhar:cadhar,cpassport:cpassport,cgstin:cgstin},
  success:function(data)
  {
    var response=JSON.parse(data);
    if(response['true']==true)
    {
    window.location.reload();
  }
    else
    alert("something went wrong");
  }
});
});

$("#compForm").on('submit',function(e){
e.preventDefault();
var cname=$("#cname").val();
var cid=$("#cid").val();
var caddr=$("#caddr").val();
var cphone=$("#cphone").val();
var ccountry=$("#ccountry option:selected").text();
var cstate=$("#cstate option:selected").text();
var ccity=$("#ccity option:selected").text();
var czip=$("#czip").val();
if(cphone=="")
{
$("#cphone").focus();
$("#msgid").html("<font color='red'>This field is required</font>");
}
else if(cname=="")
{
$("#cname").focus();
}
else if(caddr=="")
{
$("#caddr").focus();
}
else if(ccountry=="")
{
$("#ccountry").focus();
}
else if(cstate=="")
{
$("#cstate").focus();
}
else if(ccity=="")
{
$("#ccity").focus();
}
else if(czip=="" || czip.length<6)
{
$("#czip").focus();
}
else {
  $.ajax({
  url:'../src/addCompany.php',
  data: {cid:cid,cname:cname,caddr:caddr,cphone:cphone,ccountry:ccountry,cstate:cstate,ccity:ccity,czip:czip},
  success:function(data){
    var response=JSON.parse(data);
    if(response['true']==true)
    {
    window.location.reload();
  }
    else
    alert("something went wrong");
  }
});
}
});

$("#tab2").on('submit',function(event){
event.preventDefault();
var uname=$("#uname").val();
var umname=$("#umname").val();
var ulname=$("#ulname").val();
var uemail=$("#uemail").val();
// var upwd=$("#upwd").val();

if(uname=="")
{
$("#uname").focus();
}
else if(umname=="")
{
$("#umname").focus();
}
else if(ulname=="")
{
$("#ulname").focus();
}
else if(uemail=="")
{
$("#uemail").focus();
}
// else if(upwd=="" || upwd.length<2)
// {
// $("#upwd").focus();
// }
else {
$.ajax({
  url:'../src/addUser.php',
  data: {uname:uname,umname:umname,ulname:ulname,uemail:uemail},
  success:function(data){
    var response=JSON.parse(data);
    if(response['true']==true)
    {
    window.location.reload();
  }
    else
    alert("something went wrong");
  }
});
}
});

$("#tab4").on('submit',function(event){
event.preventDefault();
var adminuserid = $("#adminuserid").val();
var adminuname=$("#adminuname").val();
var adminumname=$("#adminumname").val();
var adminulname=$("#adminulname").val();
var adminuemail=$("#adminuemail").val();

var usercontactno=$("#usercontactno").val();

if(adminuname=="")
{
$("#adminuname").focus();
}
else if(adminumname=="")
{
$("#adminumname").focus();
}
else if(adminulname=="")
{
$("#adminulname").focus();
}
else if(adminuemail=="")
{
$("#adminuemail").focus();
}
else if(adminupwd=="" || adminupwd.length<8)
{
$("#adminupwd").focus();
}
else if(usercontactno=="")
{
$("#usercontactno").focus();
}

else {
$.ajax({
  url:'../src/adminAddUser.php',
  data: {adminuserid:adminuserid,adminuname:adminuname,adminumname:adminumname,adminulname:adminulname,adminuemail:adminuemail,usercontactno:usercontactno},
  success:function(data){
    var response=JSON.parse(data);
    if(response['true']==true)
    {
    window.location.reload();
  }
    else
    alert("something went wrong");
  }
});
}
});


function displaydocdetails()
{
  $.ajax({
    url:'../src/displaydocdetails.php',
    success:function(msg){
      var response =JSON.parse(msg);
          var count=Object.keys(response).length;
      for(var i=0;i<count;i++){
        if(response[i]['DocumentId'] == 1)
        {
          $("#PAN").val(response[i]['DocumentNumber']);
        }
        if(response[i]['DocumentId'] == 2)
        {
          $("#companyadhar").val(response[i]['DocumentNumber']);
        }
        if(response[i]['DocumentId'] == 3)
        {
          $("#companypassport").val(response[i]['DocumentNumber']);
        }  if(response[i]['DocumentId'] == 4)
          {
            $("#GSTIN").val(response[i]['DocumentNumber']);
          }
          if(response[i]['DocumentId'] == 5)
            {
              $("#cinno").val(response[i]['DocumentNumber']);
            }
      }
    }
  });
}
function displayAdminUsers() {
  $.ajax({
      type: "POST",
      url: "../src/displayAdminUsers.php",
      dataType:"json",
      success: function(response)
      {
        var count= response.length;
        if(count > 0){
          for (var i = 0; i < count; i++) {
            var c_id = response[i].pid;
            $("#usertabledata").append('<tr><th scope="row">'+(i + 1)+'</th><td>'
            +response[i].name+'</td><td>'
            +response[i].email+'</td><td>'
            +response[i].phone+'</td><td><button class=" btn-link dropdown-toggle" data-toggle="dropdown">Action</button><div class="dropdown-menu"><a class="dropdown-item" href="#" onclick="Editusers(' + c_id + ')">Edit</a><a class="dropdown-item" href="#" onClick="removeusers(' + c_id + ');">Delete</a></div></td></tr>');
        }
        $('#userdata').DataTable({
          searching: true,
          retrieve: true,
          bPaginate: $('tbody tr').length>10,
          order: [],
          columnDefs: [ { orderable: false, targets: [0,1,2,3,4] } ],
          dom: 'Bfrtip',
          buttons: ['copy','csv', 'excel', 'pdf'],
          destroy: true
        });
        }
      else{
      }
      }
  });
}

function removeusers(param)
{
var r = confirm("Are you sure to delete!");
        if (r==true) {
          $.ajax({
          url:"../src/deleteCustomer.php",
          method:"POST",
          data:({cid:param}),
          success:function(data)
          {
            $("#"+param).closest('tr').remove();
              window.location.reload();
          }
          });
        }
}

function Editusers(param)
{
  $("#usertable").hide();
  $("#companyinfotab").show();
  $("#companyinfo").show();
  $("#adminuserid").val(param);

$.ajax({
  url:'../src/fetchAdminUserDetails.php',
  dataType:'json',
  data: {pid:param},
  success:function(response){
    $("#adminuname").val(response.ufname);
    $("#adminumname").val(response.umname);
    $("#adminulname").val(response.ulname);
    $("#adminuemail").val(response.uemail);
    $("#usercontactno").val(response.ucontactno);
    $("#adminusername").html(response.ufname+' '+response.ulname);
  }
});
}

function checkUserEmailAvailabilityAdmin(param) {
  $.ajax({
    url: "../src/check_useremail_availablity.php",
    data: { user_email: param },
    type: "POST",
    dataType:'json',
    success: function (response) {
      if (response.msg == 1) {
        $("#adminuemail").val(' ');
        $("#adminuemail").focus();
        $("#check_uemail_availablity").html('Email Already Exists');
      }
      else{
        $("#check_uemail_availablity").html(' ');
      }
  //     $("#email-availability").html(response);
  //     setTimeout(function(){
  //   $("#email-availability").hide();
  // }, 3000);
    },
    error: function () { }
  });
}
function displayAdminUsersTable(param)
{
  if(param == 0)
  {
    $("#userstab").show();
  $("#tab4").show();
  $("#addusertab").show();
  }
  else if(param == 1){
  $("#userstab").hide();
  $("#tab4").hide();
  $("#addusertab").hide();
  }
}
