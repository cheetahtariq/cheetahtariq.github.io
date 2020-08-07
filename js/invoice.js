 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
		htmlRows += '<td><input type="text" name="caseNo[]" id="caseNo_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="hsnCode[]" id="hsnCode_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="productCode[]" id="productCode_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>'; 
		htmlRows += '<td><select name="peices[]" id="peices'+count+'"><option value="Sqft">Sqft</option><option value="SqM">SqM</option></select></td>'; 		
		htmlRows += '<td><input type="number" name="netWt[]" id="netWt_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="gWt[]" id="gWt_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><select name="curr[]" id="curr'+count+'"><option value="inr">INR</option><option value="usd">USD</option></select></td>';
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="netAmt[]" id="netAmt_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="CGST[]" id="CGST'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="SGST[]" id="SGST'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="IGST[]" id="IGST'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="taxAmt[]" id="taxAmt_'+count+'" class="form-control" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=netWt_]", function(){
		calculateTotal();
	});	

	$(document).on('blur', "[id^=gwt_]", function(){
		calculateTotal();
	});	

	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	

	$(document).on('blur', "[id^=netAmt_]", function(){
		calculateTotal();
	});

	$(document).on('blur', "#CGST", function(){		
		calculateTotal();
	});

	$(document).on('blur', "#SGST", function(){		
		calculateTotal();
	});

	$(document).on('blur', "#IGST", function(){		
		calculateTotal();
	});

	$(document).on('blur', "[id^=taxAmt_]", function(){
		calculateTotal();
	});	

	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	
function calculateTotal(){
	var totalAmount = 0; 
	var gross;
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var taxAmount = $('#taxAmt_'+id).val();
		var net = $('#netWt_'+id).val();
		var cgst = $("#CGST").val();
		var sgst = $("#SGST").val();
		var igst = $("#IGST").val(); 
		var quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}

		gross=quantity*net;
		$('#gWt_'+id).val(gross);

		var total = price*quantity;
		$('#netAmt_'+id).val(parseFloat(total));


		taxAmount = total*((cgst+sgst+igst)/100);
		$('#taxAmt_'+id).val(taxAmount);

		totalAmount = total+taxAmount;	
		$('#total_'+id).val(parseFloat(totalAmount));		
	});
	$('#subTotal').val(parseFloat(totalAmount));	
	//var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();

	/*if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotal);		
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}*/

	


	function number2text(value) {
    var fraction = Math.round(frac(value)*100);
    var f_text  = "";

    //var cur=$("#curr option:selected").val();

    if($("#curr option:selected").val() == "inr")
    {
     if(fraction > 0) {
        f_text = "AND "+convert_number(fraction)+" PAISE";
     }

     return convert_number(value)+" RUPEE "+f_text+" ONLY";
	}

	else
	{
		if(fraction>0){
			f_text = "AND "+convert_number(fraction)+" cents";
		}
		return " USD "+convert_number(value)+f_text+" ONLY";
	}


}


function frac(f) {
    return f % 1;
}

function convert_number(number)
{
    if ((number < 0) || (number > 999999999)) 
    { 
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */ 
    number -= Gn * 10000000; 
    var kn = Math.floor(number / 100000);     /* lakhs */ 
    number -= kn * 100000; 
    var Hn = Math.floor(number / 1000);      /* thousand */ 
    number -= Hn * 1000; 
    var Dn = Math.floor(number / 100);       /* Tens (deca) */ 
    number = number % 100;               /* Ones */ 
    var tn= Math.floor(number / 10); 
    var one=Math.floor(number % 10); 
    var res = ""; 

    if (Gn>0) 
    { 
        res += (convert_number(Gn) + " CRORE"); 
    } 
    if (kn>0) 
    { 
            res += (((res=="") ? "" : " ") + 
            convert_number(kn) + " LAKH"); 
    } 
    if (Hn>0) 
    { 
        res += (((res=="") ? "" : " ") +
            convert_number(Hn) + " THOUSAND"); 
    } 

    if (Dn) 
    { 
        res += (((res=="") ? "" : " ") + 
            convert_number(Dn) + " HUNDRED"); 
    } 


    var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX","SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN","FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN","NINETEEN"); 
var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY","SEVENTY", "EIGHTY", "NINETY"); 

    if (tn>0 || one>0) 
    { 
        if (!(res=="")) 
        { 
            res += " AND "; 
        } 
        if (tn < 2) 
        { 
            res += ones[tn * 10 + one]; 
        } 
        else 
        { 

            res += tens[tn];
            if (one>0) 
            { 
                res += ("-" + ones[one]); 
            } 
        } 
    }

    if (res=="")
    { 
        res = "zero"; 
    } 
    return res;
}
$('#taxRate').val(number2text(subTotal));


}

 