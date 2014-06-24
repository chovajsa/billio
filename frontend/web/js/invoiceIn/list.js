app.controller('ListController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', function (scope, AI, SI, routeParams, modal, location) {

    scope.suppliers = [];
    
    scope.toDelete = null;

    scope.myData = {
        
        invoiceListState: 'open',
        invoiceListSort: 'created',
        invoiceListDirection: 'desc',
        invoiceListPage: 1
    };

    if (scope.myData.invoiceList == undefined) {
        if (l.length > 0) {
            scope.myData.invoiceList = l;    
        }
        scope.myData.invoiceList = [];
    }

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

        if (scope.myData.invoiceList.length > 0) return;

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
            l = data;
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