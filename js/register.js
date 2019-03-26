$("#userreg").on('submit',function(e){
  e.preventDefault();
  var fname=$("#fname").val();
  var mname=$("#mname").val();
  var lname=$("#lname").val();
  var email=$("#email").val();
  var pwd=$("#pwd").val();
  var cname=$("#cname").val();
  var phone=$("#phone").val();
  if(fname=="")
  {
  $("#fname").focus();
  }
  else if(mname=="")
  {
  $("#mname").focus();
  }
  else if(lname=="")
  {
  $("#lname").focus();
  }
  else if(email=="")
  {
  $("#email").focus();
  }
  else if(pwd=="" || pwd.length<2)
  {
  $("#pwd").focus();
  }
  else if(cname=="")
  {
  $("#cname").focus();
  }
  else if(phone=="")
  {
  $("#phone").focus();
  }
  else {
  $.ajax({
    url:'../src/userRegistration.php',
    data:{fname:fname,mname:mname,lname:lname,email:email,phone:phone,pwd:pwd,cname:cname},
    success:function(data){
      var response=JSON.parse(data);
      if(response['true']===true)
      {
        $("#userreg").trigger('reset');
          // window.location.reload();
          window.location.href = 'login.php';
    }
      else
      alert("something went wrong");
    }
  });
}
});

function checkEmailAvailability(param) {
  $.ajax({
    url: "../src/check_email_availablity.php",
    data: { email: param },
    type: "POST",
    dataType:'json',
    success: function (response) {
      if (response.msg == 1) {
        $("#email").val('');
        $("#email-availability").html('<font color="red">Email Id Already Exists</font>');
          $("#email").focus();
      }
      else{
        $("#email-availability").html(' ');
      }
  //     $("#email-availability").html(response);
  //     setTimeout(function(){
  //   $("#email-availability").hide();
  // }, 3000);
    },
    error: function () { }
  });
}
function checkCompanyAvailability(param) {
  $.ajax({
    url: "../src/check_company_availablity.php",
    data: { company: param },
    type: "POST",
    dataType:'json',
    success: function (response) {
      if (response.msg == 1) {
        $("#cname").val(' ');
        $("#cname").focus();
        $("#cname-availability").html('<font color="red">Company Name Already Exists</font>');
      }
      else{
        $("#cname-availability").html(' ');
      }
  //     $("#email-availability").html(response);
  //     setTimeout(function(){
  //   $("#email-availability").hide();
  // }, 3000);
    },
    error: function () { }
  });
}
