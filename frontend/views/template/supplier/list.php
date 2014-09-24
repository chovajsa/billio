<div class="col-md-12 ui-sortable" ng-show="currentInvoice == null">

	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Supplier List</h4>
		</div>
	  
	    <div class="panel-body">
	    	<table class="table table-condensed table-hover table-row-active">
				<thead>
					<tr>
						<th>
							Supplier
						</th>
						
						<th>
							Name
						</th>
						<th>
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody>
		            <tr ng-repeat="supplier in supplierList | filter:filterText">
						<td>
							{{supplier.companyName}}
						</td>
						<td>
							{{supplier.name}} {{supplier.surname}}
						</td>
						<td>
							<a ng-show="1" href="javascript:void(0)" ng-click="update(supplier.id)" class="btn btn-sm btn-info">update</a>
						</td>
					</tr>
				</tbody>
			</table>

			<ul class="pagination m-t-0 m-b-10">
				<li>
					<a href="javascript:;" ng-click="updateSupplierList(1)">«</a>
				</li>
				<li 
					ng-repeat="a in numberOfRepeats(supplierListPaging.pageCount) track by $index"
					class="{{(supplierListPaging.currentPage == $index) ? 'active' : ''}}"
				>
					<a href="javascript:;"  ng-click="updateSupplierList($index+1)">{{$index+1}}</a>
				</li>
				<li>
					<a ng-click="updateSupplierList(supplierListPaging.pageCount)" href="javascript:;">»</a>
				</li>
			</ul>
		</div>
	</div>
</div> 