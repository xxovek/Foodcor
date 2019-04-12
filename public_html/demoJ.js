$(document).ready(function(){
var i=$('tbody tr').length;
$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" data-type="productCode" name="itemNo[]" id="itemNo_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
	html += '<td><select class="form-control" id="itemName_'+i+'"><option value="1">Option 1</option><option value="2">Option 2</option></select></td>';
	html += '<td><input type="text" name="price[]" id="price_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><div class="input-group mb-2 mb-sm-0"><select  name="tax[]" id="tax_'+i+'" class="form-control changestax" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><option value="10">10%</option><option value="20">20%</option><div class="input-group-addon">%</div></div></td>';
	html += '<td><input type="text" name="total[]" id="total_'+i+'" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
	html += '</tr>';
	$('#tdata').append(html);
	i++;
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calc_total();
});


    var i=1;

	$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
	$('#tax').on('keyup change',function(){
		calc_total();
	});


});

function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var j=0;
			var qty = $(this).find('#price_'+i+'').val();
			var price = $(this).find('#quantity_'+i+'').val();
			var tax = $(this).find('#tax_'+i+'').val();
			var cal = ((qty*price)/100)*tax;
			var next = $(this).closest('tr').find('#tax_'+i+'').val();
			$(this).find('#total_'+i+'').val(cal+(qty*price));
			calc_total();
			
		}
    });
}

function calc_total()
{
	
	total=0;
	$('.totalLinePrice').each(function() {
				total += parseFloat($(this).val());	
    });
	$('#sub_total').val(total.toFixed(2));
	tax_sum=total/100*$('#tax').val();
	$('#tax_amount').val(tax_sum.toFixed(2));
	$('#total_amount').val((tax_sum+total).toFixed(2));
}

function tax_cal(){
	var tax = 0;
	$('.changestax').each(function() {
		tax  = parseFloat($(this).val());
		alert('curremt'+tax);
		var previousDate = $(this).prev().val();
		alert('prev'+previousDate);
		
});
}
function getProductDetails(i){
	$.ajax({
		url:'../src/fetch_itemnames.php',
		type:'GET',
		success:function(data){
			var itemspan= '';
			itemspan+='<select class="form-control" data-provide="selectpicker" data-live-search="true"  title="Choose a items">';
            itemspan+=data;
			itemspan+='</select>';
			$('#itemName_'+i+'').html(itemspan);
		}
	});
}