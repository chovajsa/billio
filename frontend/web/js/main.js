var app = angular.module('invoiceIn', ['ngResource','mgcrea.ngStrap']);

app.factory('InvoicesIn', function ($resource) {
    return $resource(yiiApp.url + '/api/invoiceIn/:id', {
        id: '@id'
    }, {
        getInvoice: {
            method: 'GET',
            params: {
                number: 0
            }
        },
        createInvoice: {
            method: 'POST',
            params: 0
        },

        updateInvoice: {
            method: 'PUT',
            params: 0  
        }
    })
});

app.factory('Supplier', function ($resource) {
    return $resource(yiiApp.url + '/api/supplier/:number', {
        number: '@number'
    }, {
        getSupplier: {
            method: 'GET',
            params: {
                number: 0
            }
        }
    })
});

app.controller('InvoiceInController', ['$scope', 'InvoicesIn', 'Supplier', function (scope, AI, SI) {


    scope.suppliers = [];
    
    scope.mode = 'create';

    scope.myData = {
        currentInvoice: null,

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

    scope.setCurrentInvoice = function (id) {
        scope.mode = 'update';
        AI.getInvoice({
            id: id  
        }, function (data) {
            scope.myData.currentInvoice = data;
            scope.myData.currentInvoice.supplierId = parseInt(data.supplierId);
        });
    };

    scope.showAll = function () {
        scope.myData.currentInvoice = null;
    };

    scope.newInvoice = function() {
        scope.mode = 'create';
        scope.myData.currentInvoice = {};
    }

    scope.setInvoiceList();
    scope.setSuppliers();

    window.scope = scope;
    
}]);