<?php 
	use yii\helpers\Url;
?>
<!-- small list -->
<div class="col-md-4 ui-sortable smallList">
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Invoice List</h4>
		</div>
		  
	    <div class="panel-body">
	    	<table class="table table-condensed table-hover">
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
		            <tr ng-repeat="invoice in myData.invoiceList | filter:filterText">
		                <td>
							<a href="#update/{{invoice.id}}">{{invoice.id}}</a>
		                </td>
		                <td>
							{{invoice.date | dateFromDb}}
						</td>
		                <td>
		                    {{invoice.supplier.address.name}}
						</td>
						<td>
		                    {{invoice.amount}} &euro;
						</td>
					</tr>
				</tbody>
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
<!-- /small list -->
<div class="col-md-8 ui-sortable updateInvoice">
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title" ng-show="mode == 'create'"> 
				New Invocie
			</h4>
			<h4 class="panel-title" ng-show="mode == 'update'"> 
				Update Invocie {{myData.currentInvoice.id}}
			</h4>
		</div>
		  
	    <div class="panel-body">
			<form class="form-horizontal" role="form">

				<div class="row">
				<div class="col-sm-6">
				<ul class="media-list media-list-with-divider">
					<li class="media">
						<div class="media-body">
							<h4 class="media-heading">Created by : {{myData.currentInvoice.createdByUserName}} </h4>
							<p>
								<dl>
									<dt>Created on : 
									{{myData.currentInvoice.createdDate | euroDateFilter}} </dt>
								</dl>
							</p>
						</div>
					</li>
				</ul>
				</div>
					<div class="col-sm-6 text-right" style="padding-right:5px">
						<p>
							<a href="javascript:;" ng-click="delete(myData.currentInvoice.id)" class="btn btn-sm btn-danger">Delete</a>
					  		
					        <!-- <a href="javascript:;" class="btn btn-sm btn-primary m-r-5">Approve</a> -->
					        <!-- <a href="javascript:;" class="btn btn-sm btn-danger">Reject</a> -->
					    </p>
					</div>
				</div>
				
				<div class="form-group">
				<label for="supplierId" class="col-sm-2 control-label">Supplier</label>
					<div class="col-sm-10">
						<p class="input-group">
							<select id="supplierId" required class="form-control selectpicker nyaSelectpicker" data-style="btn-white" data-live-search="true" data-size="10" ng-model="myData.currentInvoice.supplierId" ng-options="supplier.id as supplier.address.name for supplier in suppliers">
								<option value=""> Please select </option>
							</select>
							<span class="input-group-btn add-on">
				  	  			<button type="button" class="btn btn-primary" ng-click="showModal()"><i class="fa fa-plus"></i></button>
						  	</span>
						</p>
					</div>
				</div>

				<div class="form-group">
					<label for="number" class="col-sm-2 control-label">Number</label>
					<div class="col-sm-10">
					  <input id="number" required ng-model="myData.currentInvoice.number" class="form-control" type="text">
					</div>
				</div>

				<div class="form-group">
					<label for="referenceNumber" class="col-sm-2 control-label">Reference Number</label>
					<div class="col-sm-10">
					  <input id="referenceNumber" ng-model="myData.currentInvoice.referenceNumber" required class="form-control" type="text">
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="col-sm-2 control-label">Date</label>
					
					<div class="col-sm-10 ui-append">
						<div class="input-group date">
						<input class="form-control datepicker" ng-model="myData.currentInvoice.date" type="text" id="date" name="input1"/>
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						</div>
					</div>
				</div>
				  
				<div class="form-group">
					<label for="dueDate" class="col-sm-2 control-label">Due Date</label>
					<div class="col-sm-10 input-append">
					  <!-- <p class="input-group"> -->
					  	<input class="form-control datepicker" ng-model="myData.currentInvoice.dueDate" type="text" id="dueDate" name="input1">
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
			<h4 class="panel-title"> Invoice Contents </h4>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="5%">
							#
						</th> 
						<th width="55%">
							Text
						</th>
						<th width="10%">
							Amount (Pcs)
						</th>
						<th width="15%">
							Amount (EUR)
						</th>
						<th width="15%">
							Amount Total
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="row in myData.currentInvoice.rows">
						<td>
							{{$index + 1}}
							<input type="hidden" ng-model="myData.currentInvoice.rows[$index].id">
						</td> 
						<td>
							<input style="width:100%" ng-model="myData.currentInvoice.rows[$index].description" type="text">
						</td>
						<td>
							<input style="width:100%" ng-model="myData.currentInvoice.rows[$index].pcs" type="text">
						</td>
						<td>
							<input style="width:100%" ng-model="myData.currentInvoice.rows[$index].amount" type="text">
						</td>
						<td>
							{{preciseRound((row.amount*row.pcs), 2)}}
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
						<th>
							&nbsp;
						</th> 
						<th>
							&nbsp;
						</th>
						<th>
							&nbsp;
						</th>
						<th>
							&nbsp;
						</th>
						<th>
							{{
							(myData.currentInvoice.rows.length == 0) ? '0.00' : preciseRound(getTotalAmountForInvoice(), 2)
							}}
						</th>
						<th>
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
			<input type="button" ng-click="update()" class="btn btn-primary" value="Save">	
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function () {
	$('.datepicker').datepicker({
		format:"dd.mm.yyyy"
	});
	$('.selectpicker').selectpicker({});
})
</script>
