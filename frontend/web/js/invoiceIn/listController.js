app.controller('ListController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', function (scope, AI, SI, routeParams, modal, location) {

    scope.suppliers = [];
    
    scope.toDelete = [];

    invoiceList = [];
    invoiceListState = 'open';
    invoiceListSort = 'id';
    invoiceListDirection = 'desc';
    invoiceListPage = 1;

    scope.toPayAmount = '0';

	
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
	
	scope.select2Options = {
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
                    var supname = items[i].companyName ? items[i].companyName : items[i].name + " " + items[i].surname;
                    newData.push({
                        id: items[i].id,
                        text: supname
                    });
                }

                return {results: newData};
            }

        },

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
	
	scope.creanUpFilters = function() {
		var dateFields = ['date', 'dueDate'];
		
		for(var name in scope.filters) {
			if(scope.filters[name] == '') {
				delete scope.filters[name];
			} else if(dateFields.indexOf(name) >= 0) {
				scope.filters[name] = convertDateToDb(scope.filters[name]);
			}
		}
	}
	
	scope.filter = function() {
		
		scope.creanUpFilters();
		
        location.url('filter/'+angular.toJson(scope.filters));
    }

    scope.setInvoiceList = function () {
		
		if (routeParams.filters && angular.equals({}, scope.filters)) {
			scope.filters = JSON.parse(routeParams.filters);
		}
		
		if (location.path() == '/mine') {
           scope.filters.createdBy = yiiApp.userId;
        }
		
        if (location.path() == '/paid') {
           scope.filters.paid = 'true';
        }
        if (location.path() == '/paid-not') {
           scope.filters.paid = 'false';
        }

		scope.creanUpFilters();
		
		// console.log(scope.filters);

        AI.query({
            // state: scope.invoiceListState,
            //labels: scope.labels,
            sort: scope.invoiceListSort,
            direction: scope.invoiceListDirection,
            filters:angular.toJson(scope.filters),
			page: scope.invoiceListPage,
            fulltext:scope.searchText
        }).$promise.then(function (data) {   
            
            for (var i in data.items) {
                angular.extend(data.items[i], invoicePrototype);
            }

            console.log(data.items);

            scope.invoiceList = data.items;
			scope.invoiceListLinks = data._links;
			scope.invoiceListPaging = data._meta;
			scope.filters.date = convertDateFromDb(scope.filters.date);
			scope.filters.dueDate = convertDateFromDb(scope.filters.dueDate);
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


    scope.getToPayAmount = function() {
        var amount = 0;
        for (var i in scope.invoiceList) {
            if (scope.invoiceList[i].toPay) {
                amount += parseFloat(scope.invoiceList[i].amountVat);
            }
        }
        return amount;
    }

    scope.$watch(function(scope) {
        scope.toPayAmount = scope.getToPayAmount();
    });


    // payments modal
    var paymentModal = modal({scope: scope, template: yiiApp.url+'/template?route=invoiceIn/payments', show: false});
    scope.showPaymentsModal  = function() {
        paymentModal.$promise.then(paymentModal.show);
    }
    scope.closePaymentsModal = function () {
        paymentModal.$promise.then(paymentModal.hide);   
    }

    scope.getPaymentList = function () {
        var list = [];

        for (var i in scope.invoiceList) {
            if (scope.invoiceList[i].toPay) {
                list.push(scope.invoiceList[i]);
            }
        }
        return list;
    }

    scope.markAsPaid = function () {
     
        if (!confirm('Really want to mark invoices as paid ?')) return;

        var list = scope.getPaymentList();

        AI.markAsPaid({list:list}, function () {

        })

        
    }

    // returns number of elements in parameter for ng-repeat
    scope.numberOfRepeats = function(n) {
        return new Array(n);
    };


}]);