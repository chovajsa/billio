app.controller('UpdateController', ['$scope', 'InvoicesIn', 'Supplier', 'CostCentre', '$routeParams', '$modal', '$location', '$controller', function (scope, AI, SI, costCentres, routeParams, modal, location, $controller) {

    $controller('ListController', {$scope:scope});

    scope.mode = 'update';
    scope.supplier = {};
    scope.counter = 0;
	scope.costCentres = [];

    scope.currentInvoice = {
        rows:[],
        supplier:false
    };
	
	console.log(location.path());
	
	//scope.currentInvoice.costCentreId = parseInt(scope.currentInvoice.costCentreId, 10); 

    scope.addRow = function() {
        if (scope.currentInvoice.rows === undefined) scope.currentInvoice.rows = [];
        scope.currentInvoice.rows.push({ id: null, amount:'0', pcs:'1', vat:yiiApp.defaultVat});
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
        
        params.supplierId = parseInt(params.supplier.id,10);
		params.costCentreId = parseInt(params.costCentreId,10);

        if (scope.mode == 'create') {
            AI.createInvoice(params, function (data) {
                scope.setInvoiceList();
                notify('success', 'Invoice added');
                
                $("html, body").animate({
                    scrollTop: 0
                }, 100);   

            });
        } else if (scope.mode == 'update') {

            params.toDelete = scope.toDelete;

            AI.updateInvoice(params, function (data) {
                scope.setInvoiceList();
                scope.setCurrentInvoice(params.id);
                notify('success', 'Ivoice updated');

                $("html, body").animate({
                    scrollTop: 0
                }, 100);   

            });
        }
    }


    scope.setCurrentInvoice = function (id) {
      
// potalto stary kod
		scope.mode = 'update';
		
		costCentres.get({}, function(costCentreData) {
			
			scope.costCentres = costCentreData.items;
			
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

				scope.currentInvoice = data;
				scope.currentInvoice.number = parseInt(scope.currentInvoice.number);
				scope.currentInvoice.referenceNumber = parseInt(scope.currentInvoice.referenceNumber);

				scope.currentInvoice.supplierId = parseInt(data.supplierId);
				scope.currentInvoice.costCentreId = parseInt(data.costCentreId);

				if (scope.currentInvoice.supplierId)
				scope.currentInvoice.supplier = {
					id: data.supplierId,
					name: data.supplier.name,
					text: data.supplier.name + data.supplier.surname
				}

				angular.element('#attachmentsFrame').attr('src', yiiApp.url+'/invoice-in/attachments?invoiceInId='+data.id);
			});
		});
    };

    scope.updateSupplier = function() {
        params = scope.supplier;
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
    var turl = yiiApp.url+'/template?route=supplier/form';

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

}]);