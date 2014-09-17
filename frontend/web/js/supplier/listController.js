app.controller('ListController', ['$scope', 'Supplier', '$routeParams', '$modal', '$location', function (scope, SI, routeParams, modal, location) {

	scope.supplierList = [];

	
	scope.setSupplierList = function () {

        var filters = {};

        SI.query({
            // state: scope.invoiceListState,
            //labels: scope.labels,
            sort: scope.supplierListSort,
            direction: scope.supplierListDirection,
            filters:angular.toJson(filters),
			page: scope.supplierListPage,
        }, function (data) {
            scope.supplierList = data.items;
			scope.supplierListLinks = data._links;
			scope.supplierListPaging = data._meta;
        });
    };

    scope.setSupplierList();

}]);