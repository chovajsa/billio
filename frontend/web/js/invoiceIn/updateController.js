app.controller('UpdateController', ['$scope', 'InvoicesIn', 'Supplier', '$routeParams', '$modal', '$location', '$controller', function (scope, AI, SI, routeParams, modal, location, $controller) {

    $controller('ListController', {$scope:scope});

    scope.mode = 'update';
    scope.newSupplier = {};
    scope.counter = 0;

    scope.currentInvoice = {
        rows:[],
        supplier:false
    };

    scope.addRow = function() {
        if (scope.currentInvoice.rows === undefined) scope.currentInvoice.rows = [];
        scope.currentInvoice.rows.push({ id: null, amount:null, pcs:null}); 
    }
    
    scope.unsetRow = function(i) {
        
        if (scope.currentInvoice.rows[i].id) {
            scope.toDelete.push({id:scope.currentInvoice.rows[i].id});
        }

        scope.currentInvoice.rows.splice(i, 1);
    }

    scope.update = function() {
        // if (!valid) return;
        console.log(scope.form);
        scope.form.submitted = true;
        if (!scope.form.$valid) return false;

        var params =  jQuery.extend({}, scope.currentInvoice);
     
        var dateFields = ['date', 'dueDate'];

        for (var i in params) {
            for (var x in dateFields) {
                // if (dateFields[x] == )
                if (i == dateFields[x]) {
                    params[i] = convertDateToDb(params[i]);
                }
            }
        }
        
        params.supplierId = parseInt(params.supplier.id);

        if (scope.mode == 'create') {
            AI.createInvoice(params, function (data) {
                scope.setInvoiceList();
                notify('success', 'Invoice added');
            });
        } else if (scope.mode == 'update') {

            params.toDelete = scope.toDelete;

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

            // if (id) {
            //     var found = false;
            //     for (var i in scope.suppliers) {
            //         if (scope.suppliers[i].id == data.supplierId) {
            //             found = true;
            //         }
            //     }

            //     if (!found) {
            //         scope.suppliers.push({ id: data.supplierId, address: {name:data.supplier.address.name}}); 
            //     }
            // }

            scope.currentInvoice = data;
            scope.currentInvoice.number = parseInt(scope.currentInvoice.number);
            scope.currentInvoice.referenceNumber = parseInt(scope.currentInvoice.referenceNumber);

            scope.currentInvoice.supplierId = parseInt(data.supplierId);

            if (scope.currentInvoice.supplierId)
            scope.currentInvoice.supplier = {
                id: data.supplierId,
                name: data.supplier.address.name,
                text: data.supplier.address.name
            }

            angular.element('#attachmentsFrame').attr('src', yiiApp.url+'/invoice-in/attachments?invoiceInId='+data.id);
        });
    };

    scope.createSupplier = function() {
        params = scope.newSupplier;
        SI.createSupplier(params, function (data) {
            scope.setSuppliers();
            scope.closeModal();
            scope.currentInvoice.supplierId = parseInt(data.id);
            notify('success', 'Supplier added');
        });
    }


    if (routeParams.id) {
        scope.setCurrentInvoice(routeParams.id);
    }

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
		
        if (scope.currentInvoice.rows === undefined) scope.currentInvoice.rows = [];
		
        for(var i = 0; i < scope.currentInvoice.rows.length; i++){
			var row = scope.currentInvoice.rows[i];
			total += (row.amount * row.pcs);
		}

		return total;
	
	};
	
	scope.getTotalAmountVatForInvoice = function() {
		var total = 0;
		if (scope.currentInvoice.rows === undefined) scope.currentInvoice.rows = [];
		for(var i = 0; i < scope.currentInvoice.rows.length; i++){
			var row = scope.currentInvoice.rows[i];
			total += ((row.amount * row.pcs)*(row.vat/100))+(row.amount * row.pcs);
		}
        
		return total;
	
	};
	
	scope.getTotalVatForInvoice = function() {
	
		var total = 0;
		if (scope.currentInvoice.rows === undefined) scope.currentInvoice.rows = [];
		for(var i = 0; i < scope.currentInvoice.rows.length; i++){
			var row = scope.currentInvoice.rows[i];
			total += (row.amount * row.pcs)*(row.vat/100);
		}
        
		return total;
	
	};
	
	scope.preciseRound = function(num,decimals) {
	   var x = (Math.round(num * Math.pow(10, decimals)) / Math.pow(10, decimals)).toFixed(decimals);
       if (isNaN(x)) return "0.00";
	   return x;
    }

}]);