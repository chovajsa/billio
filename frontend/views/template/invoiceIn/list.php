<div class="col-md-12 ui-sortable" ng-show="currentInvoice == null">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Invoice List</h4>
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
							Approved
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr ng-repeat="invoice in invoiceList | filter:filterText">
		                <td ng-click="showInvoice(invoice.id)">
							<a href="#update/{{invoice.id}}">{{invoice.number}}</a>
		                </td>
		                <td ng-click="showInvoice(invoice.id)">
							{{invoice.supplier.address.name}}
						</td>
		                <td ng-click="showInvoice(invoice.id)">
		                    {{invoice.date | dateFromDb}}
						</td ng-click="showInvoice(invoice.id)">
						<td ng-click="showInvoice(invoice.id)"> 
							{{invoice.dueDate | dateFromDb}}
						</td>
						<td ng-click="showInvoice(invoice.id)">
		                    {{invoice.amount | preciseRound}}
						</td>
						<td ng-click="showInvoice(invoice.id)">
							{{invoice.approved ? 'approved' : 'pending'}}
						</td>
						<td>
							<button ng-click="approve(invoice.id)" class="btn btn-sm btn-success">approve</button>
							<button ng-click="unapprove(invoice.id)" class="btn btn-sm btn-warning">unapprove</button>
							
							<button ng-click="delete(invoice.id)" class="btn btn-sm btn-danger">delete</button>
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