<div ng-app="invoiceIn">

<div ng-controller="InvoiceInController">

	<?php echo $this->context->renderPartial('sidebar'); ?>

	<!-- begin #content -->
	<div id="content" class="content">

		<h1 class="page-header"> Incoming Invoices <!-- <small>header small text goes here...</small> --></h1>
		  
		<div class="row">
			<div class="col-md-4 ui-sortable">
				<form>
		            <div class="input-group m-b-15">
		                <input type="text" class="form-control input-sm input-white" placeholder="Search Invoices">
		                <span class="input-group-btn">
		                    <button class="btn btn-sm btn-inverse" type="button"><i class="fa fa-search"></i></button>
		                </span>
		            </div>
		        </form>
			</div>

			<div class="col-md-8 ui-sortable">
				<div class="email-btn-row hidden-xs">
		    	    <a href="#/new" class="btn btn-sm btn-success"><i class="fa fa-plus m-r-5"></i> New</a>

		    	    <a ng-click="filterAll()" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> All </a>
		    	    <a ng-click="filterMine()" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> Mine </a>
		    	    <a ng-click="filterPaid()" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> Paid </a>
		    	    <a ng-click="filterPaidNot()" class="btn btn-sm btn-inverse"><i class="fa m-r-5"></i> Paid not </a>

		    	</div>
			</div>
		</div>

		<div class="row">
			<?php echo $this->context->renderPartial('list'); ?>
			<?php echo $this->context->renderPartial('listSmall'); ?>
			<?php echo $this->context->renderPartial('update'); ?>
		</div>

	</div>

</div>
</div>
