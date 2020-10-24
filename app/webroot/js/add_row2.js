
$(document).ready(function(){

	$("#add_item_button").click(function(){

		//alert("suppose to add a new row");
		let number = $('.new_row').length + 1;
		let row = '<tr class="new_row"><td></td><td><textarea name="data['+number+'][description]" class="m-wrap  description required" rows="2" ></textarea></td>';
		row += '<td><input name="data['+number+'][quantity]" class=""></td><td><input name="data['+number+'][unit_price]"  class=""></td></tr>';
	 tableBody = $("table tbody"); 
	tableBody.append(row); 

		});

	
});
