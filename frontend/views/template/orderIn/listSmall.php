<div class="col-md-4 ui-sortable" ng-show="currentOrder != null">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Order List</h4>
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
		            <tr ng-repeat="order in orderList | filter:filterText">
		                <td>
							<a href="#update/{{order.id}}">{{order.id}}</a>
		                </td>
		                <td>
							{{order.date | dateFromDb}}
						</td>
		                <td>
		                    {{order.supplier.address.name}}
						</td>
						<td>
		                    {{order.amount | preciseRound}} EUR
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div> 