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
		            <tr ng-repeat="invoice in myData.invoiceList | filter:filterText">
		                <td>
							<a href="#update/{{invoice.id}}">{{invoice.id}}</a>
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
		                    {{invoice.amount}}
						</td>
						<td>
							<button ng-click="delete(invoice.id)" class="btn btn-sm btn-danger">delete</button>
						</td>
					</tr>
				</tbody>
			</table>
			<ul class="pagination m-t-0 m-b-10">
				<li class="{{(invoiceListPaging.currentPage <= 1) ? 'disabled' : ''}}">
					<a href="javascript:;">«</a>
				</li>
				<li 
					ng-repeat="a in numberOfRepeats(invoiceListPaging.pageCount) track by $index"
					class="{{(invoiceListPaging.currentPage == $index) ? 'active' : ''}}"
				>
						<a href="javascript:;"  ng-click="updateIncoiceList($index+1)">{{$index+1}}</a>
				</li>
				<li class="{{(invoiceListPaging.currentPage == (invoiceListPaging.pageCount-1)) ? 'disabled' : ''}}"><a href="javascript:;">»</a></li>
			</ul>
		</div>
	</div>
</div> 