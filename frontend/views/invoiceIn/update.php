<?php
use yii\helpers\Url;
?>
<div class="col-md-8 ui-sortable" ng-show="myData.currentInvoice != null">
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
						<a class="pull-left" href="javascript:;">
						    <img src="assets/img/user-5.jpg" alt="" class="media-object media-object-sm rounded-corner">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Created by : Jozef Mrkva </h4>
							<p>
								<dl>
									<dt>Created on : 
									1.5.2014 16:54 </dt>
								</dl>
							</p>
						</div>
					</li>
				</ul>
				</div>
				<div class="col-sm-6 text-right">
					<p>
				        <a href="javascript:;" class="btn btn-sm btn-success m-r-5">Approve</a>
				        <a href="javascript:;" class="btn btn-sm btn-danger">Reject</a>
				    </p>
				</div>
				</div>
				
				<div class="form-group">
				<label for="supplierId" class="col-sm-2 control-label">Supplier</label>
					<div class="col-sm-10">
						<p class="input-group">
							<select id="supplierId" required class="form-control" ng-model="myData.currentInvoice.supplierId" ng-options="supplier.id as supplier.address.name for supplier in suppliers">
								<option value=""> Please select </option>
							</select>
							<span class="input-group-btn add-on">
					  	  		<button type="button" class="btn btn-success" data-animation="am-fade-and-scale" data-placement="center" bs-modal="modal" data-template="<?=Url::base();?>/templates/invoiceIn/test.php"><i class="fa fa-plus"></i></button>
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
					<div class="col-sm-10 input-append">
					  <p class="input-group">
					  	<input class="form-control" ng-model="myData.currentInvoice.date" type="text" id="date" name="input1"></input>
					  	<span class="input-group-btn add-on">
					  	  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
					  	</span>

					  	<!-- <span class="add-on">
					  	  <i data-time-icon="icon-time" data-date-icon="icon-calendar">xx</i>
					  	</span> -->
					  </p>
					</div>
				</div>
				  
				<div class="form-group">
					<label for="dueDate" class="col-sm-2 control-label">Due Date</label>
					<div class="col-sm-10 input-append">
					  <p class="input-group">
					  	<input class="form-control" ng-model="myData.currentInvoice.dueDate" bs-datepicker type="text" id="dueDate" name="input1"></input>
					  	<span class="input-group-btn add-on">
					  	  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
					  	</span>

					  	<!-- <span class="add-on">
					  	  <i data-time-icon="icon-time" data-date-icon="icon-calendar">xx</i>
					  	</span> -->
					  </p>
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
					<tr>
						<td>
							1
						</td> 
						<td>
							<input style="width:100%" type="text">
						</td>
						<td>
							<input style="width:100%" type="text">
						</td>
						<td>
							<input style="width:100%" type="text">
						</td>
						<td>
							<input style="width:100%" type="text">
						</td>
						<td>
							<a href="#">
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
							250,00 EUR
						</th>
						<th>
						</th>
					</tr>
				</tfoot>
			</table>

			<p>
		        <a href="javascript:;" class="btn btn-sm btn-success m-r-5"> <i class="fa fa-plus-circle"></i> Add row </a>
		    </p>
		</div>
	</div>
	<input type="button" ng-click="update()" class="btn btn-success" value="Save">	
</div>
