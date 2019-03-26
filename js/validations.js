function isNumberKey(event)
{
   var charCode = (window.event) ? event.keyCode  : event.which ;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function phonenumber(inputtxt)
{
  if(inputtxt.value)
  {
  var phoneno2 = /^[0]?[789]\d{9}$/;
  if( inputtxt.value.match(phoneno2) )
        {
          $("#msgid").html(" ");
          return true;
        }
      else
        {
          $("#msgid").html("<font color='red'>Invalid Phone Number</font>");
          $("#phone").val("");
          $("#cphone").val("");
        return false;
        }
      }
    }




function alphanumeric()
{
var cinVal = $("#cinno").val();
if(cinVal)
{
 var letterNumber = /^[0-9a-zA-Z]{21}$/;
 if(letterNumber.test(cinVal))
  {
    $("#msgid").html(" ");
  }
else
  {
    $('#cinno').val('');
    $("#msgid5").html("<font color='red'>Invalid CIN Number</font>");

  }
  }
}

  function ValidatePAN()
  {
    var panVal = $('#PAN').val();
    if(panVal)
    {
    var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
    if(regpan.test(panVal))
    {
      $("#msgid1").html(" ");
      }
     else {
      $("#msgid1").html("<font color='red'>Invalid Pan Card number</font>");
      $('#PAN').val('');
      // $('#companypan').focus();
    }
  }
}

  $('[data-type="adhaar-number"]').keyup(function() {
    var value = $(this).val();
    value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
    $(this).val(value);
  });

  $('[data-type="adhaar-number"]').on("change, blur", function() {
    var value = $(this).val();
    var maxLength = $(this).attr("maxLength");
    if (value.length != maxLength) {
      $(this).addClass("highlight-error");
    } else {
      $(this).removeClass("highlight-error");
    }
  });



  function validatePASSPORT()
  {
     var passport = $("#companypassport").val();
     if(passport)
     {
          var regsaid = /^[A-PR-WYa-pr-wy][1-9]\d\s?\d{4}[1-9]$/;
          if(regsaid.test(passport) == false)
          {
            $("#msgid3").html("<font color='red'>Invalid Passport number</font>");
            $('#companypassport').val('');
            // $('#companypassport').focus();
          }
          else
          {
            $("#msgid3").html(" ");
          }
  }
}

  function validateGSTIN()
  {
    var gstinVal= $("#GSTIN").val();
    if(gstinVal)
    {
    var reggst =/^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;

  if(reggst.test(gstinVal)== false ){

    $("#msgid4").html("<font color='red'>GST Identification Number is not valid</font>");
    $('#GSTIN').val('');
    // $('#companygstin').focus();
  }
  else {
    $("#msgid4").html(" ");
  }
  }
}

function AlphaBets(e, t){

  var specialKeys = new Array();
specialKeys.push(8);
specialKeys.push(9);
specialKeys.push(46);
specialKeys.push(36);
specialKeys.push(35);
specialKeys.push(37);
specialKeys.push(39);

  var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
  var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (keyCode == 32) || (keyCode == 0) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
  return ret;

}
function isNumberKey1(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
  eve.preventDefault();
}
}
