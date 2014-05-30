<div ng-app="invoiceIn">

<div ng-controller="InvoiceInController">
<div class="row" style="margin-top:-14px">
    <div class="col-md-12 well well-sm">
        <button ng-click="newInvoice()" type="button" class="btn btn-default btn-xs">
          <span class="glyphicon glyphicon-plus"></span>
        </button>
    </div>
</div>

<div class="row">
	<div class="col-md-1">
		<ul class="nav nav-pills nav-stacked">
		  <li class="active"><a href="#">All</a></li>
		  <li><a href="#">Mine</a></li>
		  <li><a href="#">Pending</a></li>
		  <li><a href="#">Approved</a></li>
		  <li><a href="#">Disapproved</a></li>
		</ul>
	</div>

	<div class="col-md-2">
		<table class="table">
			<tbody>
                <tr ng-repeat="invoice in myData.invoiceList | filter:filterText">
                    <td>
						<a ng-click="setCurrentInvoice(invoice.id)">{{invoice.id}}</a>
                    </td>
                    <td>
                        {{invoice.supplier.name}}
					</td>
					<td>
                        {{invoice.amount}}
					</td>
				</tr>
			</tbody>
		</table>
	</div>


	<div class="col-md-9">
		

        <div class="well" ng-show="myData.currentInvoice != null"> <a ng-click="showAll()">&laquo Back</a>

				<form class="form-horizontal" role="form">
				<legend>
					New Invoice
				</legend>
				  
				  <div class="form-group">
				    <label for="supplierId" class="col-sm-2 control-label">Supplier</label>
				    <div class="col-sm-10">

				    	<select id="supplierId" required class="form-control" ng-model="myData.currentInvoice.supplierId" ng-options="supplier.id as supplier.address.name for supplier in suppliers">
				    		<option value=""> Please select </option>
				    	</select>
				    
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
				    <label for="dueDate" class="col-sm-2 control-label">dueDate</label>
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


				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button ng-click="update()" type="submit" class="btn btn-default">Save</button>
				    </div>
				  </div>
				</form>
				
        </div>
    </div>

</div>
</div>
</div>

