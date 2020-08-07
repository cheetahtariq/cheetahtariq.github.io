<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName'] && !empty($_POST['invoiceId']) && $_POST['invoiceId']) {	
	$invoice->updateInvoice($_POST);	
	header("Location:invoice_list.php");	
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	$invoiceValues = $invoice->getInvoice($_GET['update_id']);		
	$invoiceItems1 = $invoice->getInvoiceItems1($_GET['update_id']);		
	$invoiceItems2 = $invoice->getInvoiceItems2($_GET['update_id']);
}
?>
<title>phpzag.com : Demo Build Invoice System with PHP & MySQL</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
    	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
	    	<div class="load-animate animated fadeInUp">
		    	<div class="row">
		    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		    			<h1 class="title">PHP Invoice System</h1>
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
							<input value="<?php echo $invoiceValues['order_receiver_name']; ?>" type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"><?php echo $invoiceValues['order_receiver_address']; ?></textarea>
						</div>
						
		      		</div>
		      	</div>

		      	
		      	<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="16%">Country Of Origin</th>
							<th width="16%">Country Of Final Destination</th>
							<th width="16%">Pre-Carriage By</th>
							<th width="16%">Place Of Receipt</th>
							<th width="16%">Port Of Loading</th>
							<th width="16%">Port Of Discharge</th>
						</tr>
						<?php 
							$count = 0;
							foreach($invoiceItems1 as $invoiceItem1){
								$count++;
							?>								
						<tr>
							<td><input class="itemRow" type="checkbox"></td>
							<td><input type="text" value="<?php echo $invoiceItem1["coo"]; ?>" name="coo[]" id="coo_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem1["cod"]; ?>" name="cod[]" id="cod_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem1["pcb"]; ?>"  name="pcb[]" id="pcb_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem1["por"]; ?>" name="por[]" id="por_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
							<td><input type="text" value="<?php echo $invoiceItem1["pol"]; ?>" name="pol[]" id="pol_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem1["pod"]; ?>" name="pod[]" id="pod_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
						</tr>						
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="16%">Container No.</th>
							<th width="16%">Container Type</th>
							<th width="16%">Shipping Mark</th>
							<th width="16%">Total Pcs</th>
							<th width="16%">Total Net Weight</th>
							<th width="16%">Total Gross Weight</th>
						</tr>	
						<?php 
							$count = 0;
							foreach($invoiceItems2 as $invoiceItem2){
								$count++;
							?>								
						<tr>
							<td><input class="itemRow" type="checkbox"></td>
							<td><input type="text" value="<?php echo $invoiceItem2["cn"]; ?>" name="cn[]" id="cn_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem2["ct"]; ?>" name="ct[]" id="ct_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem2["sm"]; ?>"  name="sm[]" id="sm_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem2["tp"]; ?>" name="tp[]" id="tp_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
							<td><input type="text" value="<?php echo $invoiceItem2["tnw"]; ?>" name="tnw[]" id="tnw_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $invoiceItem2["tgw"]; ?>" name="tgw[]" id="tgw_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
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
							<?php 
							$count = 0;
							foreach($invoiceItems as $invoiceItem){
								$count++;
							?>								
							<tr>
								<td><input class="itemRow" type="checkbox"></td>
								<td><input type="text" value="<?php echo $invoiceItem["item_code"]; ?>" name="caseNo[]" id="caseNo_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
								<td><input type="text" value="<?php echo $invoiceItem["hsnCode"]; ?>" name="hsnCode[]" id="hsnCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
								<td><input type="text" value="<?php echo $invoiceItem["item_code"]; ?>" name="productCode[]" id="productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
								<td><input type="text" value="<?php echo $invoiceItem["item_name"]; ?>" name="productName[]" id="productName_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
								<td><input type="number" value="<?php echo $invoiceItem["order_item_quantity"]; ?>" name="quantity[]" id="quantity_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>

								<td><select value="<?php echo $invoiceItem["peices"]; ?>" name="peices[]" id="peices_<?php echo $count; ?>" class="form-control" autocomplete="off">
									<option value="Sqft">Sqft</option>
									<option value="SqM">SqM</option>
								</select></td>

								<td><input type="number" value="<?php echo $invoiceItem["netWt"]; ?>" name="netWt[]" id="netWt_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

								<td><input type="number" value="<?php echo $invoiceItem["gWt"]; ?>" name="gWt[]" id="gWt_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

								<td><select value="<?php echo $invoiceItem["curr"]; ?>" name="curr[]" id="curr_<?php echo $count; ?>" class="form-control" autocomplete="off">
									<option value="inr">INR</option>
									<option value="usd">USD</option>
								</select></td>

								<td><input type="number" value="<?php echo $invoiceItem["order_item_price"]; ?>" name="price[]" id="price_<?php echo $count; ?>" class="form-control price" autocomplete="off"></td>

								<td><input type="number" value="<?php echo $invoiceItem["netAmt"]; ?>" name="netAmt[]" id="netAmt_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

								<td><input type="number" value="<?php echo $invoiceItem["CGST"]; ?>" name="CGST[]" id="CGST_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

								<td><input type="number" value="<?php echo $invoiceItem["SGST"]; ?>" name="SGST[]" id="SGST_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

								<td><input type="number" value="<?php echo $invoiceItem["IGST"]; ?>" name="IGST[]" id="IGST_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

								<td><input type="number" value="<?php echo $invoiceItem["taxAmt"]; ?>" name="taxAmt[]" id="taxAmt_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>

								<td><input type="number" value="<?php echo $invoiceItem["order_item_final_amount"]; ?>" name="total[]" id="total_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
								<input type="hidden" value="<?php echo $invoiceItem['order_item_id']; ?>" class="form-control" name="itemId[]">
							</tr>	
							<?php } ?>		
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
							<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"><?php echo $invoiceValues['note']; ?></textarea>
						</div>
						<br>
						<div class="form-group">
							<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
							<input type="hidden" value="<?php echo $invoiceValues['order_id']; ?>" class="form-control" name="invoiceId" id="invoiceId">
			      			<input data-loading-text="Updating Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">
			      		</div>
						
		      		</div>
		      		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<span class="form-inline">
							<div class="form-group">
								<label>Subtotal: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_total_before_tax']; ?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
								</div>
							</div>
							<div class="form-group">
								<label>Tax Rate: &nbsp;</label>
								<div class="input-group">
									<input value="<?php echo $invoiceValues['order_tax_per']; ?>" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
									<div class="input-group-addon">%</div>
								</div>
							</div>
							<div class="form-group">
								<label>Tax Amount: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_total_tax']; ?>" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
								</div>
							</div>							
							<div class="form-group">
								<label>Total: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_total_after_tax']; ?>" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Paid: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_amount_paid']; ?>" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Due: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $invoiceValues['order_total_amount_due']; ?>" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
								</div>
							</div>
						</span>
					</div>
		      	</div>
		      	<div class="clearfix"></div>		      	
	      	</div>
		</form>			
    </div>
</div>	
<?php include('footer.php');?>