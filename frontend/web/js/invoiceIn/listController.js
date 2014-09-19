app.controller('ListController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', function (scope, AI, SI, routeParams, modal, location) {

    scope.suppliers = [];
    
    scope.toDelete = [];

    invoiceList = [];
    invoiceListState = 'open';
    invoiceListSort = 'id';
    invoiceListDirection = 'desc';
    invoiceListPage = 1;
	
	// doSearch=false;
    
	// scope.$watch('searchText', function(newValue, oldValue) {
		// if(newValue != oldValue && typeof newValue !== 'undefined') {
			// //console.log(newValue);
			// scope.setInvoiceList();
		// }
	// });
	
	// scope.$watch('doSearch', function(newValue, oldValue) {
		// if(newValue != oldValue && newValue == true) {
			// console.log(scope.doSearch);
			// scope.setInvoiceList();
			// //scope.doSearch = false;
		// }
	// });
	
	if (routeParams.fulltext) {
        scope.searchText = routeParams.fulltext;
    }

    scope.select2Options = 
     {
        placeholder: "Search for a supplier",
        minimumInputLength: 1,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: yiiApp.url + '/api/supplier/',
            dataType: 'json',
            data: function (term, page) {
                return {
                    fulltext: term, // search term
                };
            },
            results: function(data, page ) {
                var newData = [];
                var items = data.items;

                for (var i in items) {
                    newData.push({
                        id: items[i].id,
                        text: items[i].name + " " + items[i].surname
                    });
                }
                
                return {results: newData};
            }
           
        }, 
      
    }

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

    scope.setInvoiceList = function () {

		var filters = {};
        if (location.path() == '/mine') {
           filters.createdBy = yiiApp.userId;
        }

        AI.query({
            // state: scope.invoiceListState,
            //labels: scope.labels,
            sort: scope.invoiceListSort,
            direction: scope.invoiceListDirection,
            // filters:angular.toJson(filters),
			page: scope.invoiceListPage,
            fulltext:scope.searchText
        }, function (data) {
            scope.invoiceList = data.items;
			scope.invoiceListLinks = data._links;
			scope.invoiceListPaging = data._meta;
			
			// if(scope.doSearch == true) scope.doSearch = false;
			// console.log(scope.doSearch);
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