<?php
use common\components\helpers;
?>

<link href="<?=\yii\Helpers\Url::base();?>/css/invoice-print.min.css" rel="stylesheet" />

<!-- begin #page-loader 
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container">
	
	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<!--<ol class="breadcrumb hidden-print pull-right">
			<li><a href="javascript:;">Home</a></li>
			<li class="active">Invoice</li>
		</ol>-->
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<!--<h1 class="page-header hidden-print">Invoice <small>header small text goes here...</small></h1>
		<!-- end page-header -->
		
		<!-- begin invoice -->
		<div class="invoice">
			<div class="invoice-company">
				<span class="pull-right hidden-print">
				<!-- <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a> -->
				<a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
				</span>
				<?=$invoiceIn->supplier->companyName;?>
			</div>
			<div class="invoice-header">
				<div class="invoice-from">
					<small>from</small>
					<address class="m-t-5 m-b-5">
						<strong><?=$invoiceIn->supplier->companyName;?></strong><br />
						<?=$invoiceIn->supplier->address->street;?><br />
						<?=$invoiceIn->supplier->address->city;?> <?=$invoiceIn->supplier->address->zip;?>
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
					<div class="date m-t-5"><?=Helpers::formatDateFromDb($invoiceIn->date);?></div>
					<div class="invoice-detail">
						#<?=$invoiceIn->number;?><br />
						<?=$invoiceIn->costCentre->name;?>
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
									<?=$row->description;?>
								</td>
								<td><?=$row->amount;?></td>
								<td><?=$row->pcs;?></td>
								<td><?=$row->vat;?>%</td>
								<td><?=$row->amountTotal;?>€</td>
								<td><?=$row->amountTotalVat;?>€</td>
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
								<?=$invoiceIn->amount;?>€
							</div>
							<div class="sub-price">
								<i class="fa fa-plus"></i>
							</div>
							<div class="sub-price">
								<small>VAT</small>
								<?=$invoiceIn->vat;?>€
							</div>
						</div>
					</div>
					<div class="invoice-price-right">
						<small>TOTAL</small> <?=$invoiceIn->amountVat;?>€
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