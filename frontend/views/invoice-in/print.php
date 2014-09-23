	
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
				<!--<span class="pull-right hidden-print">
				<a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>
				<a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
				</span>-->
				Company Name, Inc
			</div>
			<div class="invoice-header">
				<div class="invoice-from">
					<small>from</small>
					<address class="m-t-5 m-b-5">
						<strong>Twitter, Inc.</strong><br />
						Street Address<br />
						City, Zip Code<br />
						Phone: (123) 456-7890<br />
						Fax: (123) 456-7890
					</address>
				</div>
				<div class="invoice-to">
					<small>to</small>
					<address class="m-t-5 m-b-5">
						<strong>Company Name</strong><br />
						Street Address<br />
						City, Zip Code<br />
						Phone: (123) 456-7890<br />
						Fax: (123) 456-7890
					</address>
				</div>
				<div class="invoice-date">
					<small>Invoice / July period</small>
					<div class="date m-t-5">August 3,2012</div>
					<div class="invoice-detail">
						#0000123DSS<br />
						Services Product
					</div>
				</div>
			</div>
			<div class="invoice-content">
				<div class="table-responsive">
					<table class="table table-invoice">
						<thead>
							<tr>
								<th>TASK DESCRIPTION</th>
								<th>RATE</th>
								<th>HOURS</th>
								<th>LINE TOTAL</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Website design &amp; development<br />
									<small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
								</td>
								<td>$50.00</td>
								<td>50</td>
								<td>$2,500.00</td>
							</tr>
							<tr>
								<td>
									Branding<br />
									<small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
								</td>
								<td>$50.00</td>
								<td>40</td>
								<td>$2,000.00</td>
							</tr>
							<tr>
								<td>
									Redesign Service<br />
									<small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id sagittis arcu.</small>
								</td>
								<td>$50.00</td>
								<td>50</td>
								<td>$2,500.00</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="invoice-price">
					<div class="invoice-price-left">
						<div class="invoice-price-row">
							<div class="sub-price">
								<small>SUBTOTAL</small>
								$4,500.00
							</div>
							<div class="sub-price">
								<i class="fa fa-plus"></i>
							</div>
							<div class="sub-price">
								<small>PAYPAL FEE (5.4%)</small>
								$108.00
							</div>
						</div>
					</div>
					<div class="invoice-price-right">
						<small>TOTAL</small> $4508.00
					</div>
				</div>
			</div>
			<div class="invoice-note">
				* Make all cheques payable to [Your Company Name]<br />
				* Payment is due within 30 days<br />
				* If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
			</div>
			<div class="invoice-footer text-muted">
				<p class="text-center m-b-5">
					THANK YOU FOR YOUR BUSINESS
				</p>
				<p class="text-center">
					<span class="m-r-10"><i class="fa fa-globe"></i> matiasgallipoli.com</span>
					<span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
					<span class="m-r-10"><i class="fa fa-envelope"></i> rtiemps@gmail.com</span>
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