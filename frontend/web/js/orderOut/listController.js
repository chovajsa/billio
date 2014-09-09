app.controller('ListController', ['$scope', 'OrdersOut', 'Supplier', '$routeParams', '$modal', '$location', function (scope, AI, SI, routeParams, modal, location) {

    scope.suppliers = [];
    
    scope.toDelete = [];

        
    orderList = [];
    orderListState = 'open';
    orderListSort = 'id';
    orderListDirection = 'desc';
    orderListPage = 1;
        

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
                        text: items[i].address.name + " " + items[i].address.surname
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
        var oldSort = angular.copy(scope.orderListSort);
        scope.orderListSort = sort;

        if (oldSort == sort) {
            scope.setDirection(scope.orderListDirection == 'desc' ? 'asc' : 'desc');
        } else {
            scope.setDirection('desc');
        }
    }

    scope.setDirection = function (direction) {
        scope.orderListDirection = direction;
        scope.setOrderList();
    };

    scope.setOrderList = function () {

        var filters = {};
        if (location.path() == '/mine') {
           filters.createdBy = yiiApp.userId;
        }

        AI.query({
            // state: scope.orderListState,
            //labels: scope.labels,
            sort: scope.orderListSort,
            direction: scope.orderListDirection,
            filters:angular.toJson(filters),
			page: scope.orderListPage,
        }, function (data) {
            scope.orderList = data.items;
			scope.orderListLinks = data._links;
			scope.orderListPaging = data._meta;
        });
    };

    scope.showOrder = function(id) {
        location.path('/update/' + id);
    }

    scope.approve = function(id) {
        AI.approveOrder({id:id}, function(data){
            scope.setOrderList();
        });
    }

    scope.delete = function(id) {
        scope.toDelete = id;
        scope.showDeleteModal();
    }

    scope.deleteReal = function(id) {
        scope.toDelete = null;
        AI.deleteOrder({
            id: id
        }, function (data) {
            scope.setOrderList();
            scope.closeDeleteModal();
        });
    }
	
	scope.updateOrderList = function (index) {
		scope.orderListPage = index;
		scope.setOrderList();
	}


    // supplier modal
    var deleteModal = modal({scope: scope, template: yiiApp.url+'/template?route=orderOut/sure', show: false});
    scope.showDeleteModal  = function() {
        deleteModal.$promise.then(deleteModal.show);
    }
    scope.closeDeleteModal = function () {
        deleteModal.$promise.then(deleteModal.hide);   
    }

    scope.setOrderList();
    scope.setSuppliers();

    // returns number of elements in parameter for ng-repeat
	scope.numberOfRepeats = function(n) {
        return new Array(n);
    };
	
}]);