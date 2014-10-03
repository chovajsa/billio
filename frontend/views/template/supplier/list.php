		<h1 class="page-header"> Suppliers <!-- <small>header small text goes here...</small> --></h1>

			<div class="alert alert-success fade in m-b-15" id="notify-success" style="display:none">
				<span class="msg"></span>
				<span data-dismiss="alert" class="close">×</span>
			</div>

			<div class="row">
				<div class="col-md-4 ui-sortable">
					<form>
			            <div class="input-group m-b-15">
			                <input type="text" class="form-control input-sm input-white" ng-model="searchText" placeholder="Search Suppliers" value="{{routeParams.fulltext}}">
			                <a class="input-group-btn" href="#/search/{{searchText}}">
								<span>
									<button class="btn btn-sm btn-inverse" type="submit"><i class="fa fa-search"></i></button>
								</span>
							</a>
			            </div>
			        </form>
				</div>

				<div class="col-md-8 ui-sortable">
					<div class="email-btn-row hidden-xs">

			    	    <a href="javascript:;" ng-click="showCreateModal()" class="btn btn-sm btn-primary"><i class="fa fa-plus m-r-5"></i> New</a>

			    	</div>
				</div>
			</div>

		  
		  	<div class="alert alert-success fade in m-b-15" id="notify-success" style="display:none">
				<span class="msg"></span>
				<span data-dismiss="alert" class="close">×</span>
			</div>

			<div class="row">

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
										<td ng-click="update(supplier.id)">
											{{supplier.companyName}}
										</td>
										<td ng-click="update(supplier.id)">
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
			</div>
