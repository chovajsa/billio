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
<div class="col-md-12" ng-show="currentInvoice == null">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Invoice List</h4>
		</div>
	  
	    <div class="panel-body">
	    	<table class="table table-condensed table-hover table-row-active">
				<thead>
					<tr>
						<th>
							<a href="javascript:;" ng-click="setSort('number')">Invoice Number</a>
						</th>
						<td>
							Reference Number
						</td>
						<td>
							IBAN
						</td>
						<th>
							Supplier
						</th>
						<th>
							Date
						</th>
						<th>
							Due Date
						</th>

						<th>
							Amount
						</th>
						<th>
							Approved
						</th>
						<th>
							Paid
						</th>
						<th>
							Pay
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr 	ng-repeat="invoice in invoiceList">
		                <td ng-click="showInvoice(invoice.id)">
							<a href="#update/{{invoice.id}}">{{invoice.number}}</a>
		                </td>

		                <td ng-click="showInvoice(invoice.id)">
		                	{{invoice.referenceNumber}}
		                </td>

		                <td ng-click="showInvoice(invoice.id)">
		                	{{invoice.supplier.bankAccounts[0].iban}}
		                </td>
		                <td ng-click="showInvoice(invoice.id)">
							{{invoice.getFullSupplierName()}}
						</td>
				        <td ng-click="showInvoice(invoice.id)">
		                    {{invoice.date | dateFromDb}}
						</td ng-click="showInvoice(invoice.id)">
						<td ng-click="showInvoice(invoice.id)"> 
							{{invoice.dueDate | dateFromDb}}
						</td>
						<td ng-click="showInvoice(invoice.id)">
		                    {{invoice.amountVat | preciseRound}}
						</td>
						
						<td ng-click="showInvoice(invoice.id)">
							{{invoice.approvedBy ? '' : 'pending'}}
							<span ng-repeat="ab in invoice.approvedBy">
								<span class="label label-success">{{ab.userName}}</span>&nbsp;
							</span>
						</td>
						
						<td ng-click="showInvoice(invoice.id)">
							{{invoice.paid ? 'yes' : 'no'}}
						</td>
						
						<td>
							<?php if (Yii::$app->user->identity->canDo('pay')|| Yii::$app->user->identity->canDo('admin')) { ?>
								<input ng-show="canPay(invoiceList[$index])" type="checkbox" ng-model="invoiceList[$index].toPay">
							<?php } ?>
						</td>
						
						<td>
							<?php if (Yii::$app->user->identity->canDo('strongApprove') || Yii::$app->user->identity->canDo('lightApprove') || Yii::$app->user->identity->canDo('admin')) { ?>
								<button ng-show="!invoiceApprovedByUser(invoice,'<?=Yii::$app->user->identity->username;?>')" ng-click="approve(invoice.id)" class="btn btn-sm btn-success">approve</button>
								<button ng-show="invoiceApprovedByUser(invoice,'<?=Yii::$app->user->identity->username;?>')" ng-click="unapprove(invoice.id)" class="btn btn-sm btn-warning">unapprove</button>
							<?php } ?>
							
							<?php if (Yii::$app->user->identity->canDo('admin')) { ?>
								<button ng-click="delete(invoice.id)" class="btn btn-sm btn-danger">delete</button>
							<?php } ?>
						</td>
					
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td style="border-top:0" colspan="12">&nbsp;</td>
					</tr>
					<tr>
						<th colspan="6">
						</th>
						<th style="padding-top:15px">
							Payments total amount:		
						</th>
						<th style="padding-top:15px">
							{{toPayAmount | preciseRound}} 
						</th>
						<th>
							<button ng-disabled="!toPayAmount" ng-click="showPaymentsModal()" class="btn btn-sm btn-info">Generate payment file</button> 
						</th>
					</tr>
				</tfoot>
			</table>
			
			<ul class="pagination m-t-0 m-b-10">
				<li>
					<a href="javascript:;" ng-click="updateIncoiceList(1)">«</a>
				</li>
				<li 
					ng-repeat="a in numberOfRepeats(invoiceListPaging.pageCount) track by $index"
					class="{{(invoiceListPaging.currentPage == $index) ? 'active' : ''}}"
				>
					<a href="javascript:;"  ng-click="updateIncoiceList($index+1)">{{$index+1}}</a>
				</li>
				<li>
					<a ng-click="updateIncoiceList(invoiceListPaging.pageCount)" href="javascript:;">»</a>
				</li>
			</ul>
		</div>
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