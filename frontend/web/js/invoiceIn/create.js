app.controller('CreateController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', function (scope, AI, SI, routeParams) {

    scope.suppliers = [];
    
    scope.mode = 'create';

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
        AI.query({
            state: scope.myData.invoiceListState,
            //labels: scope.myData.labels,
            sort: scope.myData.invoiceListSort,
            direction: scope.myData.invoiceListDirection
        }, function (data) {
            scope.myData.invoiceList = data;
        });
    };

    scope.update = function() {
        if (scope.mode == 'create') {
            params = scope.myData.currentInvoice;
            AI.createInvoice(params, function (data) {
                scope.setInvoiceList();
            });
        } else if (scope.mode == 'update') {
            params = scope.myData.currentInvoice;
            AI.updateInvoice(params, function (data) {
                scope.setInvoiceList();
            });
        }
    }

    scope.setSuppliers();
    scope.setInvoiceList();
    
}]);