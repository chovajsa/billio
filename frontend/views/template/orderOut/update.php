<?php 
	use yii\helpers\Url;
?>
<!-- small list -->
<div class="col-md-4 ui-sortable smallList">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Order List</h4>
		</div>
		  
	    <div class="panel-body">
	    	<table class="table table-condensed table-hover table-row-active">
				<thead>
					<tr>
						<th>
							Number
						</th>
						<th>
							Date
						</th>
						<th>
							Supplier
						</th>
						<th>
							Amount
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr ng-click="showOrder(order.id)" ng-repeat="order in orderList | filter:filterText">
		                <td>
							<a href="#update/{{order.id}}">{{order.number}}</a>
		                </td>
		                <td>
							{{order.date | dateFromDb}}
						</td>
		                <td>
		                    {{order.supplier.address.name}}
						</td>
						<td>
		                    {{order.amount}} &euro;
						</td>
					</tr>
				</tbody>
			</table>
			<ul class="pagination m-t-0 m-b-10">
				<li>
					<a href="javascript:;" ng-click="updateOrderList(1)">«</a>
				</li>
				<li 
					ng-repeat="a in numberOfRepeats(orderListPaging.pageCount) track by $index"
					class="{{(orderListPaging.currentPage == $index) ? 'active' : ''}}"
				>
					<a href="javascript:;"  ng-click="updateOrderList($index+1)">{{$index+1}}</a>
				</li>
				<li>
					<a ng-click="updateOrderList(orderListPaging.pageCount)" href="javascript:;">»</a>
				</li>
			</ul>
		</div>
	</div>
</div> 
<!-- /small list -->
<div class="col-md-8 ui-sortable updateOrder">
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title" ng-show="mode == 'create'"> 
				New Order
			</h4>
			<h4 class="panel-title" ng-show="mode == 'update'"> 
				Update Order {{currentOrder.id}}
			</h4>
		</div>
		  
	    <div class="panel-body">
			<form class="form-horizontal" role="form" name="form" ng-submit="update(form.$valid)" novalidate>

				<div class="row" style="margin-right:-15px">
					<div class="col-sm-6">
					<ul class="media-list media-list-with-divider">
						<li class="media">
							<div class="media-body">
								<h4 class="media-heading">Created by : {{currentOrder.createdByUserName}} </h4>
								<p>
									<dl>
										<dt>Created on : 
										{{currentOrder.createdDate | euroDateFilter}} </dt>
									</dl>
								</p>
							</div>
						</li>
					</ul>
					</div>
					<div class="col-sm-6 text-right">
						<p>
							<!-- <a href="javascript:;" ng-click="delete(currentOrder.id)" class="btn btn-sm btn-danger">Delete</a> -->
					  		<button ng-click="delete(order.id)" class="btn btn-sm btn-info">approve</button>
							<button ng-click="delete(order.id)" class="btn btn-sm btn-warning">deny</button>
							<button ng-click="delete(order.id)" class="btn btn-sm btn-danger">delete</button>
					        <!-- <a href="javascript:;" class="btn btn-sm btn-primary m-r-5">Approve</a> -->
					        <!-- <a href="javascript:;" class="btn btn-sm btn-danger">Reject</a> -->
					    </p>
					</div>
				</div>
				
				<div class="form-group">
					<label for="supplierId" class="col-sm-2 control-label">Supplier</label>
					<div class="col-sm-10">
						<p class="input-group">
							<!-- <select id="supplierId" required class="form-control selectpicker nyaSelectpicker" data-style="btn-white" data-ajax-url="<?=Url::base();?>/api/supplier" data-live-search="true" data-ajax-search="true" data-size="10" ng-options="supplier.id as supplier.address.name for supplier in suppliers" ng-model="currentOrder.supplierId">
								
								<option value=""> Please select </option>
							</select> -->

							<input ui-select2="select2Options" ng-model="currentOrder.supplier" required class="form-control selectpicker bigdrop" data-style="btn-white" type="hidden" id="supplierId"/>

							<span class="input-group-btn add-on">
				  	  			<button type="button" class="btn btn-primary" ng-click="showModal()"><i class="fa fa-plus"></i></button>
						  	</span>
						</p>
					</div>
				</div>
	
				<div class="form-group">
					<label for="number" class="col-sm-2 control-label">Number</label>
					<div class="col-sm-10">
					  	<input id="number" name="number" required ng-model="currentOrder.number" class="form-control" type="number">
					  	
					  	<ul class="error-list" ng-show="(form.submitted || form.number.$dirty) && form.number.$invalid" style="display: block;">
					  		
				  			<li ng-show="form.number.$error.required" class="required"  style="display: list-item;">
					  			Please enter a valid number.
				  			</li>
			  			</ul>
				
					</div>
				</div>

				<div class="form-group">
					<label for="referenceNumber" class="col-sm-2 control-label">Reference Number</label>
					<div class="col-sm-10">

					  <input id="referenceNumber" name="referenceNumber" ng-model="currentOrder.referenceNumber" required class="form-control" type="number">

					  	<ul class="error-list" ng-show="(form.submitted || form.referenceNumber.$dirty) && form.referenceNumber.$invalid" style="display: block;">
				  			<li ng-show="form.referenceNumber.$error.required" class="required"  style="display: list-item;">
					  			Please enter a valid number.
				  			</li>
			  			</ul>

					</div>
				</div>

				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">Date</label>
					
					<div class="col-sm-10">
						<input class="form-control datepicker" required  ng-model="currentOrder.date" type="text" id="date" name="date"/>

						<ul class="error-list" ng-show="(form.submitted || form.date.$dirty) && form.date.$invalid" style="display: block;">
					  		
				  			<li ng-show="form.date.$error.required" class="required"  style="display: list-item;">
					  			Please enter a valid date.
				  			</li>
			  			</ul>
					</div>
				</div>
				  
				<div class="form-group">
					<label for="dueDate" class="col-sm-2 control-label">Due Date</label>
					<div class="col-sm-10 input-append">
					  <!-- <p class="input-group"> -->
					  	<input class="form-control datepicker" required ng-model="currentOrder.dueDate" type="text" id="dueDate" name="dueDate">
					  	<!-- <span class="input-group-btn add-on"> -->
					  	  <!-- <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button> -->
					  	<!-- </span> -->
					  <!-- </p> -->
					</div>
				</div>

			</form>
		</div>
	</div>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title"> Order Contents </h4>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="5%">
							#
						</th> 
						<th width="40%">
							Text
						</th>
						<th width="10%">
							Amount (Pcs)
						</th>
						<th width="10%">
							Amount (EUR)
						</th>
						<th width="10%">
							Amount Total
						</th>
						<th width="10%">
							VAT (%)
						</th>
						<th width="15%">
							Amount Total + VAT
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="row in currentOrder.rows">
						<td>
							{{$index + 1}}
							<input type="hidden" ng-model="currentOrder.rows[$index].id">
						</td> 
						<td>
							<input style="width:100%" ng-model="currentOrder.rows[$index].description" type="text">
						</td>
						<td>
							<input style="width:100%" ng-model="currentOrder.rows[$index].pcs" type="text">
						</td>
						<td>
							<input style="width:100%" ng-model="currentOrder.rows[$index].amount" type="text">
						</td>
						<td>
							{{preciseRound((row.amount*row.pcs), 2)}}
						</td>
						<td>
							<input style="width:100%" ng-model="currentOrder.rows[$index].vat" type="text">
						</td>
						<td>
							{{preciseRound(((row.amount*row.pcs)*(row.vat/100))+(row.amount*row.pcs), 2)}}
						</td>
						<td>
							<a href="javascript:void(0)" ng-click="unsetRow($index)">
							<span class="fa-stack fa-sm text-danger">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-minus fa-stack-1x fa-inverse"></i>
							</span>
							</a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="8">
							&nbsp;
						</th>
					</tr>
					<tr>
						<th colspan="4">
							&nbsp;
						</th>
						<th colspan="2">
							Total amount
						</th>
						<th>
							{{
							(currentOrder.rows.length == 0) ? '0.00' : preciseRound(getTotalAmountForOrder(), 2)
							}}
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
					<tr>
						<th colspan="4">
							&nbsp;
						</th>
						<th colspan="2">
							Total VAT
						</th>
						<th>
							{{
							(currentOrder.rows.length == 0) ? '0.00' : preciseRound(getTotalVatForOrder(), 2)
							}}
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
					<tr>
						<th colspan="4">
							&nbsp;
						</th>
						<th colspan="2">
							Total amount + VAT
						</th>
						<th>
							{{
							(currentOrder.rows.length == 0) ? '0.00' : preciseRound(getTotalAmountVatForOrder(), 2)
							}}
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</tfoot>
			</table>

			<p>
		        <a href="javascript:;" ng-click="addRow()" class="btn btn-sm btn-primary m-r-5"> <i class="fa fa-plus-circle"></i> Add row </a>
		    </p>
		</div>
	</div>

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title"> Attachments </h4>
		</div>

		<div class="panel-body">
			<!-- <iframe style="border:0; width:100%" id="attachmentsFrame" src=""></iframe> -->
		</div>
	</div>

	<div class="panel">
		<div class="panel-body">
			<input type="submit" ng-click="update()" class="btn btn-primary" value="Save">	
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
