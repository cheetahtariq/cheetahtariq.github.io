<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);		
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);
	$invoiceItems1 = $invoice->getInvoiceItems1($_GET['invoice_id']);
	$invoiceItems2 = $invoice->getInvoiceItems2($_GET['invoice_id']);		
}
$invoiceDate = date("d/M/Y", strtotime($invoiceValues['order_date']));
$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>EXPORT INVOICE CUM PACKING LIST</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="65%"><br>
	AAROHI Exporter<br>
	PLOT NO 36,1 FLOOR<br>
	3 CROSS STREET,KK NAGAR<br>
	MADHURAI-625020<br>
	TAMILNADU,INDIA
	<br> 
	<br>
	<br>
	<b>Consignee :</b><br>
	Name : '.$invoiceValues['order_receiver_name'].'<br> 
	Billing Address : '.$invoiceValues['order_receiver_address'].'<br>
	</td>
	<td width="35%">         
	Invoice No. : '.$invoiceValues['order_id'].'<br>
	Invoice Date : '.$invoiceDate.'<br>
	GSTIN Number : 33BBWPS0034E1ZP<br>
	IEC No. : 654XXXX<br>
	PAN No. : AMXXXXX<br>
	REX No. : INREXXX<br>
	</td>
	</tr>
	</table>
	<br>';
	$output .='<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Country Of Origin</th>
	<th align="left">Country Of Final Destination</th>
	<th align="left">Pre-Carriage By</th>
	<th align="left">Place Of Receipt</th>
	<th align="left">Port Of Loading</th>
	<th align="left">Port Of Discharge</th> 
	</tr>';
	$count = 0;   
foreach($invoiceItems1 as $invoiceItem1){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$invoiceItem1["coo"].'</td>
	<td align="left">'.$invoiceItem1["cod"].'</td>
	<td align="left">'.$invoiceItem1["pcb"].'</td>
	<td align="left">'.$invoiceItem1["por"].'</td>
	<td align="left">'.$invoiceItem1["pol"].'</td>
	<td align="left">'.$invoiceItem1["pod"].'</td>   
	</tr>';
}
$output .='<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Container No</th>
	<th align="left">Container Type</th>
	<th align="left">Shipping Mark</th>
	<th align="left">Total Pcs</th>
	<th align="left">Total Net Weight</th>
	<th align="left">Total Gross Weight</th> 
	</tr>';
	$count = 0;   
foreach($invoiceItems2 as $invoiceItem2){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$invoiceItem2["cn"].'</td>
	<td align="left">'.$invoiceItem2["ct"].'</td>
	<td align="left">'.$invoiceItem2["sm"].'</td>
	<td align="left">'.$invoiceItem2["tp"].'</td>
	<td align="left">'.$invoiceItem2["tnw"].'</td>
	<td align="left">'.$invoiceItem2["tgw"].'</td>   
	</tr>';
}
	$output .= '
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Sr No.</th>
	<th align="left">Case No.</th>
	<th align="left">HSN Code</th>
	<th align="left">Code No</th>
	<th align="left">Description Of Goods</th>
	<th align="left">Quantity</th>
	<th align="left">Net Weight in Kgs</th>
	<th align="left">Gross Weight in Kgs</th>
	<th align="left">Net Price</th>
	<th align="left">Net Amount</th>
	<th align="left">CGST</th>
	<th align="left">SGST</th>
	<th align="left">IGST</th>
	<th align="left">Tax Amount</th>
	<th align="left">Total</th> 
	</tr>';
$count = 0;   
foreach($invoiceItems as $invoiceItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["caseNo"].'</td>
	<td align="left">'.$invoiceItem["hsnCode"].'</td>
	<td align="left">'.$invoiceItem["item_code"].'</td>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].''.''.$invoiceItem["peices"].'</td>
	<td align="left">'.$invoiceItem["netWt"].'</td>
	<td align="left">'.$invoiceItem["gWt"].'</td>
	<td align="left">'.$invoiceItem["order_item_price"].''.''.$invoiceItem["curr"].'</td>
	<td align="left">'.$invoiceItem["netAmt"].''.''.$invoiceItem["curr"].'</td>
	<td align="left">'.$invoiceItem["CGST"].'</td>
	<td align="left">'.$invoiceItem["SGST"].'</td>
	<td align="left">'.$invoiceItem["IGST"].'</td>
	<td align="left">'.$invoiceItem["taxAmt"].'</td>
	<td align="left">'.$invoiceItem["order_item_final_amount"].''.''.$invoiceItem["curr"].'</td>
	</tr>';
}
$output .= '
	<tr>
	<td align="right" colspan="14"><b>Sub Total</b></td>
	<td align="left"><b>'.$invoiceValues['order_total_before_tax'].''.''.$invoiceItem["curr"].'</b></td>
	</tr>
	<tr>
	<td align="right" colspan="14"><b>Amount In Words :</b></td>
	<td align="left">'.$invoiceValues['order_tax_per'].'</td>
	</tr>';
	$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="65%"><br>
	BANKERS INFORMATION<br>
	BENEFICIARY NAME - AAROHI EXPORTS<br>
	BENEFICIARY BANK - AXIS BANK<br>
	BANK ADDRESS - MADHURAI<br>
	BENEFICIARY A/C NO. 916020039457691<br>
	SWIFT Code - AXISINBB109<br>
	IFSC Code - AXIS32XXXX<br>
	<b>FILE UNDER DRAWBACK SCHEME</b>
	<br> 
	<br>
	<br>
	Declaration:<br>
	<b>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct</b>
	</td>
	<td width="35%">         
	<b>Signature & Date FOR:AAROHI EXPORTS</b><br>
	<br><br><br><br>
	Auth Sign.
	</td>
	</tr>
	</table>
	<br>';
$output .= '
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>';
// create pdf of invoice	
$invoiceFileName = 'Invoice-'.$invoiceValues['order_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A3', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>   
   