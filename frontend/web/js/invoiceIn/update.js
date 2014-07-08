app.controller('UpdateController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', '$controller', function (scope, AI, SI, routeParams, modal, location, $controller) {

    $controller('ListController', {$scope:scope});

    scope.mode = 'update';
    scope.newSupplier = {};
    scope.counter = 0;

    scope.myData.currentInvoice = {
        rows:[]
    };

    scope.addRow = function() {
        if (scope.myData.currentInvoice.rows === undefined) scope.myData.currentInvoice.rows = [];
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

            angular.element('#attachmentsFrame').attr('src', yiiApp.url+'/invoice-in/attachments?invoiceInId='+data.id);
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

    scope.setCurrentInvoice(routeParams.id);
	scope.setCurrentInvoice;


    // supplier modal
    var turl = yiiApp.url+'/template?route=supplier/create';

    var supplierModal = modal({scope: scope, template: turl, show: false});

    scope.showModal  = function() {
        supplierModal.$promise.then(supplierModal.show);
    }

    scope.closeModal = function () {
        supplierModal.$promise.then(supplierModal.hide);   
    }
	
	scope.getTotalAmountForInvoice = function() {
	
		var total = 0;
		if (scope.myData.currentInvoice.rows === undefined) scope.myData.currentInvoice.rows = [];
		for(var i = 0; i < scope.myData.currentInvoice.rows.length; i++){
			var row = scope.myData.currentInvoice.rows[i];
			total += (row.amount * row.pcs);
		}
        
		return total;
	
	};
	
	scope.preciseRound = function(num,decimals) {
		return (Math.round(num * Math.pow(10, decimals)) / Math.pow(10, decimals)).toFixed(decimals);
	}

}]);