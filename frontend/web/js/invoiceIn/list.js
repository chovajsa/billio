app.controller('ListController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', function (scope, AI, SI, routeParams, modal, location) {

    scope.suppliers = [];
    
    scope.toDelete = null;

    scope.myData = {
        invoiceList: [],
        invoiceListState: 'open',
        invoiceListSort: 'created',
        invoiceListDirection: 'desc',
        invoiceListPage: 1
    };

    scope.setSuppliers = function () {
        SI.query({
            state: 'open',
            //labels: scope.myData.labels,
            sort: false,
            direction: 'asc'
        }, function (data) {
            scope.suppliers = data;
        });
    }

    scope.setInvoiceList = function () {

        var filters = {};
        if (location.path() == '/mine') {
           filters.createdBy = yiiApp.userId;
        }

        AI.query({
            // state: scope.myData.invoiceListState,
            //labels: scope.myData.labels,
            sort: scope.myData.invoiceListSort,
            direction: scope.myData.invoiceListDirection,
            filters:angular.toJson(filters)
        }, function (data) {
            scope.myData.invoiceList = data;
        });
    };

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


    // supplier modal
    var deleteModal = modal({scope: scope, template: yiiApp.url+'/template?route=invoiceIn/sure', show: false});
    scope.showDeleteModal  = function() {
        deleteModal.$promise.then(deleteModal.show);
    }
    scope.closeDeleteModal = function () {
        deleteModal.$promise.then(deleteModal.hide);   
    }

    scope.setInvoiceList();
    scope.setSuppliers();

    
}]);