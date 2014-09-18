app.controller('ListController', ['$scope', 'Supplier', '$routeParams', '$modal', '$location', function (scope, SI, routeParams, modal, location) {

	scope.supplierList = [];
    scope.supplier = {};
	
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

    scope.update = function(id) {
        SI.getSupplier({
            id: id  
        }, function (data) {
            scope.supplier = data;
            scope.supplier.vat = !!scope.supplier.vat;
            scope.showModal();
        });
    }

    scope.updateSupplier = function() {
        params = scope.supplier;
        SI.updateSupplier(params, function (data) {
            scope.setSupplierList();
            scope.closeModal();
            notify('success', 'Supplier updated');
        });
    }

        // supplier modal
    var turl = yiiApp.url+'/template?route=supplier/form';

    var supplierModal = modal({scope: scope, template: turl, show: false});

    scope.showModal  = function() {
        supplierModal.$promise.then(supplierModal.show);
    }

    scope.closeModal = function () {
        supplierModal.$promise.then(supplierModal.hide);   
    }


    scope.setSupplierList();

}]);