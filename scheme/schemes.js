$("#schemes").on("submit",function(e){
  alert("o")
  var from= $("#fromDate").val();
  var upto= $("#toDate").val();
  var scheme=$("#scheme").val();
  var item=$("#item").val();
  var onpurchase=$("#onpurchase").val();
  var freeqty=$("#freeqty").val();
  alert(scheme+from+upto+item+onpurchase+freeqty);
  e.preventDefault();

  $.ajax({
            url:"../src/schemes.php",
            method:"POST",
            dataType:'json',
            data:{scheme:scheme,from:from,upto:upto,item:item,onpurchase:onpurchase,freeqty:freeqty},
            success:function(response){
              alert(response.msg);
              window.location.reload();
            }
    });
});
