<div class="col-md-12 ui-sortable" ng-show="currentInvoice == null">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Order List</h4>
		</div>
	  
	    <div class="panel-body">
	    	<table class="table table-condensed table-hover table-row-active">
				<thead>
					<tr>
						<th>
							<a href="javascript:;" ng-click="setSort('number')">Number</a>
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
							Status
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr ng-repeat="order in orderList | filter:filterText">
		                <td ng-click="showOrder(order.id)" >
							<a href="#update/{{order.id}}">{{order.number}}</a>
		                </td>
		                <td ng-click="showOrder(order.id)" >
							{{order.supplier.address.name}}
						</td>
		                <td ng-click="showOrder(order.id)" >
		                    {{order.date | dateFromDb}}
						</td>
						<td ng-click="showOrder(order.id)" > 
							{{order.dueDate | dateFromDb}}
						</td>
						<td ng-click="showOrder(order.id)" >
		                    {{order.amount}}
						</td>
						<td ng-click="showOrder(order.id)" style="padding-top:15px">
							<span class="label label-{{order.approved ? 'success' : 'default'}}">{{order.approved ? 'approved' : 'pending'}}</span>
						</td>
						<td>
							<button ng-click="approve(order.id)" class="btn btn-sm btn-info">approve</button>
							<!-- <button ng-click="delete(order.id)" class="btn btn-sm btn-warning">deny</button> -->
							<button ng-click="delete(order.id)" class="btn btn-sm btn-danger">delete</button>
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
					<a href="javascript:;"  ng-click="updateIncoiceList($index+1)">{{$index+1}}</a>
				</li>
				<li>
					<a ng-click="updateIncoiceList(orderListPaging.pageCount)" href="javascript:;">»</a>
				</li>
			</ul>
		</div>
	</div>
</div> 