<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {	
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");	
}
?>
<title>Iralytics</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h2 class="title">Iralytics Invoice</h2>
					<?php include('menu.php');?>	
				</div>		    		
			</div>
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h3>From,</h3>
					<?php echo $_SESSION['user']; ?><br>	
					<?php echo $_SESSION['address']; ?><br>	
					<?php echo $_SESSION['mobile']; ?><br>
					<?php echo $_SESSION['email']; ?><br>	
				</div>      		
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
					<h3>To,</h3>
					<div class="form-group">
						<input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"></textarea>
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem1">	
						<tr>
							<th width="16%">Country Of Origin</th>
							<th width="16%">Country Of Final Destination</th>
							<th width="16%">Pre-Carriage By</th>
							<th width="16%">Place Of Receipt</th>
							<th width="16%">Port Of Loading</th>
							<th width="16%">Port Of Discharge</th>
						</tr>							
						<tr>
							<!-- <td><input class="itemRow"></td> -->
							<td><input type="text" name="coo[]" id="coo_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="cod[]" id="cod_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="pcb[]" id="pcb_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="por[]" id="por_1" class="form-control" autocomplete="off"></td>			
							<td><input type="text" name="pol[]" id="pol_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="pod[]" id="pod_1" class="form-control" autocomplete="off"></td>			
						</tr>						
					</table>
				</div>
			</div>



			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem2">	
						<tr>
							<!-- <th width="2%"><input id="checkAll" class="formcontrol"></th> -->
							<th width="16%">Container No.</th>
							<th width="16%">Container Type</th>
							<th width="16%">Shipping Mark</th>
							<th width="16%">Total Pcs</th>
							<th width="16%">Total Net Weight</th>
							<th width="16%">Total Gross Weight</th>
						</tr>							
						<tr>
							<!-- <td><input class="itemRow"></td> -->
							<td><input type="text" name="cn[]" id="cn_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="ct[]" id="ct_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="sm[]" id="pcb_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="tp[]" id="tp_1" class="form-control" autocomplete="off"></td>			
							<td><input type="text" name="tnw[]" id="tnw_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="tgw[]" id="tgw_1" class="form-control" autocomplete="off"></td>			
						</tr>						
					</table>
				</div>
			</div>


			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="6%">Case No</th>
							<th width="6%">HSN Code</th>
							<th width="6%">Code No</th>
							<th width="8%">Description of Goods</th>
							<th width="6%">Quantity</th>
							<th width="6%">Peices</th>
							<th width="6%">Net Weight in Kgs</th>
							<th width="6%">Gross Weight in Kgs</th>
							<th width="6%">Currency</th>
							<th width="6%">Net Price</th>
							<th width="6%">Net Amount</th>
							<th width="6%">CGST</th>
							<th width="6%">SGST</th>
							<th width="6%">IGST</th>
							<th width="6%">Tax Amount</th>								
							<th width="6%">Total</th>
						</tr>							
						<tr>
							<td><input class="itemRow" type="checkbox"></td>
							<td><input type="text" name="caseNo[]" id="caseNo_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="hsnCode[]" id="hsnCode_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>			
							<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
							<td><select name="peices[]" id="peices">
								<option value="Sqft">Sqft</option>
								<option value="SqM">SqM</option>
							</select></td>

							<td><input type="number" name="netWt[]" id="netWt_1" class="form-control" autocomplete="off"></td>
							<td><input type="number" name="gWt[]" id="gWt_1" class="form-control" autocomplete="off"></td>

							<td><select name="curr[]" id="curr">
								<option value="inr">INR</option>
								<option value="usd">USD</option>
							</select></td>

							<td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
							<td><input type="number" name="netAmt[]" id="netAmt_1" class="form-control" autocomplete="off"></td>
							<td><input type="number" name="CGST[]" id="CGST" class="form-control" autocomplete="off"></td>
							<td><input type="number" name="SGST[]" id="SGST" class="form-control" autocomplete="off"></td>
							<td><input type="number" name="IGST[]" id="IGST" class="form-control" autocomplete="off"></td>
							<td><input type="number" name="taxAmt[]" id="taxAmt_1" class="form-control" autocomplete="off"></td>
							<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
						</tr>						
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
					<button class="btn btn-success" id="addRows" type="button">+ Add More</button>
				</div>
			</div>
			<div class="row">	
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<h3>Notes: </h3>
					<div class="form-group">
						<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
					</div>
					<br>
					<div class="form-group">
						<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
						<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">						
					</div>
					
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">
						<div class="form-group">
							<label>Subtotal: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency"></div>
								<input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
							</div>
						</div>

						<!-- <div class="form-group">
							<label>Amount in Words: &nbsp;</label>
							<div class="input-group">
							<div class="input-group-addon"></div>
								<input value="" type="text" class="form-control" name="aiw" id="aiw" placeholder="">			
							</div> -->

						 <div class="form-group">
							<label>Amount in Words: &nbsp;</label>
							<div class="input-group">
								<input value="" type="text" class="form-control" name="taxRate" id="taxRate" placeholder="Amount in words">
								<div class="input-group-addon"></div>
							</div>
						</div>
						<!--<div class="form-group">
							<label>Tax Amount: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
							</div>
						</div>							
						<div class="form-group">
							<label>Total: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Paid: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Due: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
							</div>
						</div> -->
					</span>
				</div>
			</div>
			<div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>	
<?php include('footer.php');?>