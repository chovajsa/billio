app.controller('ListController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', function (scope, AI, SI, routeParams, modal, location) {

    scope.suppliers = [];
    
    scope.toDelete = [];

    invoiceList = [];
    invoiceListState = 'open';
    invoiceListSort = 'id';
    invoiceListDirection = 'desc';
    invoiceListPage = 1;
	
	if (routeParams.fulltext) {
		scope.searchText = routeParams.fulltext;
	}
	
	if (typeof filters == 'undefined') scope.filters = {};
	

    scope.setSuppliers = function () {
        SI.query({
            state: 'open',
            //labels: scope.labels,
            sort: false,
            direction: 'asc'
        }, function (data) {
            scope.suppliers = data.items;
        });
    }

    scope.setSort = function(sort) {
        var oldSort = angular.copy(scope.invoiceListSort);
        scope.invoiceListSort = sort;

        if (oldSort == sort) {
            scope.setDirection(scope.invoiceListDirection == 'desc' ? 'asc' : 'desc');
        } else {
            scope.setDirection('desc');
        }
    }

    scope.setDirection = function (direction) {
        scope.invoiceListDirection = direction;
        scope.setInvoiceList();
    };

    scope.approve = function(id) {
        AI.approveInvoice({
            id:id
        }, function(d){
            scope.setInvoiceList();
        });
    } 

    scope.unapprove = function(id) {
        AI.unapproveInvoice({
            id:id
        }, function(d) {
            scope.setInvoiceList(); 
        }); 
    }
	
	scope.filter = function() {
       location.url('filter/'+angular.toJson(scope.filters));
    }

    scope.setInvoiceList = function () {
		
		if (routeParams.filters && angular.equals({}, scope.filters)) {
			//console.log(routeParams.filters);
			scope.filters = JSON.parse(routeParams.filters);
			//console.log(JSON.stringify(filters));
		}
		
		if (location.path() == '/mine') {
           scope.filters.createdBy = yiiApp.userId;
        }
		
		if(typeof scope.filters.date != 'undefined' && filters.date != '') convertDateToDb(filters.date);
		if(typeof scope.filters.dueDate != 'undefined' && filters.dueDate != '') convertDateToDb(filters.dueDate);
		
		console.log(JSON.stringify(scope.filters));
		//$location.hash(angular.toJson(scope.filters));
		//location.hash(angular.toJson(scope.filters));
		//console.log(location.url());
		
		//location.url('filter/'+angular.toJson(scope.filters))

        AI.query({
            // state: scope.invoiceListState,
            //labels: scope.labels,
            sort: scope.invoiceListSort,
            direction: scope.invoiceListDirection,
            filters:angular.toJson(scope.filters),
			page: scope.invoiceListPage,
            fulltext:scope.searchText
        }, function (data) {
            scope.invoiceList = data.items;
			scope.invoiceListLinks = data._links;
			scope.invoiceListPaging = data._meta;
			//location.url('filter/'+angular.toJson(scope.filters))
        });
    };


    scope.invoiceApprovedByUser = function(invoice, name) {

        for (var i in invoice.approvedBy) {
            if (invoice.approvedBy[i].userName == name) return true;
        }
        return false;
    
    }

    scope.showInvoice = function(id) {
        location.path('/update/' + id);
    }

    scope.delete = function(id) {
        scope.toDelete = id;
        scope.showDeleteModal();
    }

    scope.deleteReal = function(id) {
        scope.toDelete = null;
        AI.deleteInvoice({
            id: id
        }, function (data) {
            scope.setInvoiceList();
            scope.closeDeleteModal();
        });
    }
	
	scope.updateIncoiceList = function (index) {
		scope.invoiceListPage = index;
		scope.setInvoiceList();
	}


    // delete modal
    var deleteModal = modal({scope: scope, template: yiiApp.url+'/template?route=invoiceIn/sure', show: false});
    scope.showDeleteModal  = function() {
        deleteModal.$promise.then(deleteModal.show);
    }
    scope.closeDeleteModal = function () {
        deleteModal.$promise.then(deleteModal.hide);   
    }

    scope.setInvoiceList();
    scope.setSuppliers();

    // returns number of elements in parameter for ng-repeat
	scope.numberOfRepeats = function(n) {
        return new Array(n);
    };
	
}]);