<div class="col-md-4 ui-sortable">

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
		                    200,00 EUR {{invoice.amount}}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div> 