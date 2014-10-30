<!-- Advance Search -->
<div class="col-md-12 animate-show" ng-show="$rootScope.showAdvanceSearch == true">
	
	<div class="panel panel-success">
	
		<div class="panel-heading">
			<h4 class="panel-title">Advanced Search</h4>
		</div>
		
		<form class="form-horizontal">
			<div class="panel-body">
				
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Invoice Number</label>
						<div class="col-md-8 ui-sortable">
							<input type="text" class="form-control" placeholder="Invoice Number" ng-model="filters.number">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Amount</label>
						<div class="col-md-8 ui-sortable">
							<input type="text" class="form-control" placeholder="Amount" ng-model="filters.amount">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Date</label>
						<div class="col-md-8 ui-sortable">
							<input class="form-control datepicker" ng-model="filters.date" type="text" placeholder="Date">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Due Date</label>
						<div class="col-md-8 ui-sortable">
							<input class="form-control datepicker" ng-model="filters.dueDate" type="text" placeholder="Due Date">
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Cost Centre</label>
						<div class="col-md-8 ui-sortable">
							<input type="text" class="form-control" placeholder="Cost Centre" ng-model="filters.costCentre.name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Supplier's Name</label>
						<div class="col-md-8 ui-sortable">
							<input type="text" class="form-control" placeholder="Supplier's Name" ng-model="filters.supplier.name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Supplier's Surname</label>
						<div class="col-md-8 ui-sortable">
							<input type="text" class="form-control" placeholder="Supplier's Surname" ng-model="filters.supplier.surname">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label ui-sortable">Supplier's Company Name</label>
						<div class="col-md-8 ui-sortable">
							<input type="text" class="form-control" placeholder="Supplier's Company Name" ng-model="filters.supplier.companyName">
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<p class="text-right m-b-0">
						<button type="submit" class="btn btn-sm btn-success text-right" ng-click="filter()">
							<i class="fa fa-search"></i> Search 
						</button>
					</p>
				</div>
			</div>
			
			
		</form>
		
	</div>
	
</div>

<!-- Invoice List -->
<div class="col-md-12" class="hide-xs" ng-show="currentInvoice == null">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Invoice List</h4>
		</div>
	  
	    
	    <?php echo $this->render('_list', []); ?>
	    <?php echo $this->render('_listMobile', []); ?>

	</div>
</div>

<script type="text/javascript">
$(document).ready(function () {
	$('.datepicker').datepicker({
		format:"dd.mm.yyyy"
	});

	// $('#supplierId').select2();

})
</script>