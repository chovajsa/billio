<div class="col-md-12 ui-sortable" ng-show="currentOrder == null">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Order List</h4>
		</div>
		  
	    <div class="panel-body">
	    	<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>
							<a href="javascript:;" ng-click="setSort('id')">Number</a>
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
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr ng-repeat="order in orderList | filter:filterText">
		                <td>
							<a href="#update/{{order.id}}">{{order.id}}</a>
		                </td>
		                <td>
							1.5.2014
						</td>
		                <td>
		                    {{order.supplier.address.name}}
						</td>
						<td> 
							1.5.2014
						</td>
						<td>
		                    {{order.amount | preciseRound}}
						</td>
						<td>
							<button ng-click="delete(order.id)" class="btn btn-sm btn-danger">delete</button>
						</td>
					</tr>
				</tbody>
			</table>
			<ul class="pagination m-t-0 m-b-10">
				<li>
					<a href="javascript:;" ng-click="updateIncoiceList(1)">«</a>
				</li>
				<li 
					ng-repeat="a in numberOfRepeats(orderListPaging.pageCount) track by $index"
					class="{{(orderListPaging.currentPage == $index) ? 'active' : ''}}"
				>
					<a href="javascript:;"  ng-click="updateIncoiceList($index+1)">{{$index+1}}</a>
				</li>
				<li>
					<a ng-click="updateIncoiceList(orderListPaging.pageCount)" href="javascript:;">»</a>
				</li>
			</ul>
		</div>
	</div>
</div> 