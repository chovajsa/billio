app.controller('UpdateController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', function (scope, AI, SI, routeParams, modal, location) {

    scope.suppliers = [];
    scope.mode = 'update';
    scope.newSupplier = {};
    scope.counter = 0;

    scope.myData = {
        invoiceList: [],
        invoiceListState: 'open',
        invoiceListSort: 'created',
        invoiceListDirection: 'desc',
        invoiceListPage: 1,
        toDelete: []
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

    scope.addRow = function() {
        scope.myData.currentInvoice.rows.push({ id: null, amount:null, pcs:null}); 
    }
    
    scope.unsetRow = function(i) {
        
        if (scope.myData.currentInvoice.rows[i].id) {
            scope.myData.toDelete.push({id:scope.myData.currentInvoice.rows[i].id});
        }

        scope.myData.currentInvoice.rows.splice(i, 1);
    }

    scope.update = function() {

        var params =  jQuery.extend({}, scope.myData.currentInvoice);
     
        var dateFields = ['date', 'dueDate'];

        for (var i in params) {
            for (var x in dateFields) {
                // if (dateFields[x] == )
                if (i == dateFields[x]) {
                    params[i] = convertDateToDb(params[i]);
                }
            }
        }

        if (scope.mode == 'create') {
            AI.createInvoice(params, function (data) {
                scope.setInvoiceList();
                notify('success', 'Invoice added');
            });
        } else if (scope.mode == 'update') {

            params.toDelete = scope.myData.toDelete;

            AI.updateInvoice(params, function (data) {
                scope.setInvoiceList();
                scope.setCurrentInvoice(params.id);
                notify('success', 'Ivoice updated');
            });
        }
    }

    scope.setCurrentInvoice = function (id) {
        scope.mode = 'update';
        AI.getInvoice({
            id: id  
        }, function (data) {
            var dateFields = ['date', 'dueDate'];

            for (var i in data) {
                for (var x in dateFields) {
                    // if (dateFields[x] == )
                    if (i == dateFields[x]) {
                        data[i] = convertDateFromDb(data[i]);
                    }
                }
            }

            scope.myData.currentInvoice = data;
            scope.myData.currentInvoice.supplierId = parseInt(data.supplierId);

            angular.element('#attachmentsFrame').attr('src', yiiApp.url+'/invoiceIn/attachments?invoiceInId='+data.id);
        });
    };

    scope.createSupplier = function() {
        params = scope.newSupplier;
        SI.createSupplier(params, function (data) {
            scope.setSuppliers();
            scope.closeModal();
            scope.myData.currentInvoice.supplierId = parseInt(data.id);
            notify('success', 'Supplier added');
        });
    }

    scope.setSuppliers();
    scope.setInvoiceList();
    scope.setCurrentInvoice(routeParams.id);


    // supplier modal
    var turl = yiiApp.url+'/template?route=supplier/create';

    var supplierModal = modal({scope: scope, template: turl, show: false});

    scope.showModal  = function() {
        supplierModal.$promise.then(supplierModal.show);
    }

    scope.closeModal = function () {
        supplierModal.$promise.then(supplierModal.hide);   
    }

    // delete modal
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
            location.path('/');
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

}]);