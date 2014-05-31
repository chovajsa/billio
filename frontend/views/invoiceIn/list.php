<div class="col-md-12 ui-sortable" ng-show="myData.currentInvoice == null">

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
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr ng-repeat="invoice in myData.invoiceList | filter:filterText">
		                <td>
							<a ng-click="setCurrentInvoice(invoice.id)">{{invoice.id}}</a>
		                </td>
		                <td>
							1.5.2014
						</td>
		                <td>
		                    {{invoice.supplier.address.name}}
						</td>
						<td> 
							1.5.2014
						</td>
						<td>
		                    200,00 EUR {{invoice.amount}}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div> 