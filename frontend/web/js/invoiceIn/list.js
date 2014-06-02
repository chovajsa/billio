app.controller('ListController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', function (scope, AI, SI, routeParams) {

    scope.suppliers = [];
    
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

    scope.setInvoiceList();
    scope.setSuppliers();

    
}]);