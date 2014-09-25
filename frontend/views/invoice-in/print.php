<?php
use common\components\Helpers;
?>

<link href="<?=\yii\helpers\Url::base();?>/css/invoice-print.min.css" rel="stylesheet" />

<!-- begin #page-container -->
<div id="page-container">
	
	<!-- begin #content -->
	<div id="content" class="content">
		
		<!-- begin invoice -->
		<div class="invoice">
			<div class="invoice-company">
				<span class="pull-right hidden-print">
				<!-- <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a> -->
				<!-- <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a> -->
				</span>
				<?=isset($invoiceIn->supplier->companyName) ? $invoiceIn->supplier->companyName : '';?>
			</div>
			<div class="invoice-header">
				<div class="invoice-from">
					<small>from</small>
					<address class="m-t-5 m-b-5">
						<strong><?=isset($invoiceIn->supplier->companyName) ? $invoiceIn->supplier->companyName : '';?></strong><br />
						<?=isset($invoiceIn->supplier->address->street) ? $invoiceIn->supplier->address->street : '';?><br />
						<?=isset($invoiceIn->supplier->address->city) ? $invoiceIn->supplier->address->city : '';?> <?=isset($invoiceIn->supplier->address->zip) ? $invoiceIn->supplier->address->zip : '';?>
					</address>
				</div>
				<div class="invoice-to">
					<small>to</small>
					<address class="m-t-5 m-b-5">
						<strong>TRILA Finance s.r.o.</strong><br />
						Vajnorská 8/A<br />
						Bratislava 831 04
				</div>
				<div class="invoice-date">
					<small><!-- Invoice / July period --></small>
					<div class="date m-t-5"><?=isset($invoiceIn->date) ? Helpers::formatDateFromDb($invoiceIn->date) : '';?></div>
					<div class="invoice-detail">
						#<?=isset($invoiceIn->number) ? $invoiceIn->number : '';?><br />
						<?=isset($invoiceIn->costCentre->name) ? $invoiceIn->costCentre->name : '';?>
					</div>
				</div>
			</div>
			<div class="invoice-content">
				<div class="table-responsive">
					<table class="table table-invoice">
						<thead>
							<tr>
								<th>TASK DESCRIPTION</th>
								<th>AMOUNT</th>
								<th>PCS</th>
								<th>VAT</th>
								<th>LINE TOTAL</th>
								<th>LINE TOTAL + VAT</th>
							</tr>
						</thead>
						<tbody>
							
							<?php foreach($invoiceIn->rows as $row) { ?>
							<tr>
								<td>
									<?=isset($row->description) ? $row->description : '';?>
								</td>
								<td><?=isset($row->amount) ? $row->amount : '';?></td>
								<td><?=isset($row->pcs) ? $row->pcs : '';?></td>
								<td><?=isset($row->vat) ? $row->vat : '';?>%</td>
								<td><?=isset($row->amountTotal) ? $row->amountTotal : '';?>€</td>
								<td><?=isset($row->amountTotalVat) ? $row->amountTotalVat : '';?>€</td>
							</tr>
							<?php } ?>
							
						</tbody>
					</table>
				</div>
				<div class="invoice-price">
					<div class="invoice-price-left">
						<div class="invoice-price-row">
							<div class="sub-price">
								<small>SUBTOTAL</small>
								<?=isset($invoiceIn->amount) ? $invoiceIn->amount : '';?>€
							</div>
							<div class="sub-price">
								<i class="fa fa-plus"></i>
							</div>
							<div class="sub-price">
								<small>VAT</small>
								<?=isset($invoiceIn->vat) ? $invoiceIn->vat : '';?>€
							</div>
						</div>
					</div>
					<div class="invoice-price-right">
						<small>TOTAL</small> <?=isset($invoiceIn->amountVat) ? $invoiceIn->amountVat : '';?>€
					</div>
				</div>
			</div>
			<div class="invoice-note">
				
			</div>
			<div class="invoice-footer text-muted">
				<p class="text-center m-b-5">
					THANK YOU FOR YOUR BUSINESS
				</p>
				<p class="text-center">
					<span class="m-r-10"><i class="fa fa-globe"></i> trila.sk</span>
					<span class="m-r-10"><i class="fa fa-phone"></i> T: 02/321 868 68</span>
					<span class="m-r-10"><i class="fa fa-envelope"></i> info@trila.sk</span>
				</p>
			</div>
		</div>
		<!-- end invoice -->
	</div>
	<!-- end #content -->
	
</div>
<!-- end page container -->

<!-- formatting for print -->
<style>
	body {
		padding: 0 !important;
		margin: 0 !important;
	}
	.content {
		padding: 0 !important;
		margin: 0 !important;
	}
	.sidebar,
	.header {
		display: none !important;
	}
	.invoice-company {
		border-bottom: 1px solid #e2e7eb !important;
		margin-bottom: 20px !important;
	}
	.invoice .invoice-from, 
	.invoice .invoice-to {
		float: left !important;
		display: inline !important;
		width: 25% !important;
		margin: 0 !important;
	}
	.invoice .invoice-date {
		float: right !important;
		margin: 0 !important;
		width: 25% !important;
		display: inline !important;
		text-align: right !important;
	}
	.invoice-header {
		margin: 0 !important;
		padding: 0 !important;
	}
	.table-responsive {
		border: none !important;
		display: block !important;
		float: left !important;
		width: 100% !important;
		margin-top: 10px !important;
	}
	.invoice-price {
		margin-top: 20px !important;
		border: 1px solid #e2e7eb !important;
		float: left !important;
		width: 100% !important;
		display: block !important;
	}
	.invoice .invoice-price .invoice-price-left,
	.invoice .invoice-price .invoice-price-right {
		display: block !important;
		float: left !important;
		width: 75% !important;
	}
	.invoice .invoice-price .invoice-price-right {
		width: 25% !important;
	}
	.invoice-price .invoice-price-right {
		text-align: right !important;
		height: 90px !important;
		font-size: 32px !important;
	}
	.invoice-price .invoice-price-left .sub-price {
		float: left !important;
		display: block !important;
		margin-top: 5px;
	}
	.invoice-note,
	.invoice-footer {
		float: left !important;
		width: 100% !important;
	}
</style>

<script>
	
	window.onload = function() { window.print(); }

</script>
