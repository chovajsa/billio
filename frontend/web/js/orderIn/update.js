app.controller('UpdateController', ['$scope', 'OrdersIn', 'Supplier', '$routeParams', '$modal', '$location', '$controller', function (scope, AI, SI, routeParams, modal, location, $controller) {

    $controller('ListController', {$scope:scope});

    scope.mode = 'update';
    scope.newSupplier = {};
    scope.counter = 0;

    scope.currentOrder = {
        rows:[]
    };

    scope.addRow = function() {
        if (scope.currentOrder.rows === undefined) scope.currentOrder.rows = [];
        scope.currentOrder.rows.push({ id: null, amount:null, pcs:null}); 
    }
    
    scope.unsetRow = function(i) {
        
        if (scope.currentOrder.rows[i].id) {
            scope.toDelete.push({id:scope.currentOrder.rows[i].id});
        }

        scope.currentOrder.rows.splice(i, 1);
    }

    scope.update = function() {

        var params =  jQuery.extend({}, scope.currentOrder);
     
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
            AI.createOrder(params, function (data) {
                scope.setOrderList();
                notify('success', 'Order added');
            });
        } else if (scope.mode == 'update') {

            params.toDelete = scope.toDelete;

            AI.updateOrder(params, function (data) {
                scope.setOrderList();
                scope.setCurrentOrder(params.id);
                notify('success', 'Order updated');
            });
        }
    }

    scope.setCurrentOrder = function (id) {
        scope.mode = 'update';
        AI.getOrder({
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

            if (id) {
                var found = false;
                for (var i in scope.suppliers) {
                    if (scope.suppliers[i].id == data.supplierId) {
                        found = true;
                    }
                }

                if (!found) {
                    scope.suppliers.push({ id: data.supplierId, address: {name:data.supplier.address.name}}); 
                }
            }

            scope.currentOrder = data;
            scope.currentOrder.supplierId = parseInt(data.supplierId);

            angular.element('#attachmentsFrame').attr('src', yiiApp.url+'/order-in/attachments?orderInId='+data.id);
        });
    };

    scope.createSupplier = function() {
        params = scope.newSupplier;
        SI.createSupplier(params, function (data) {
            scope.setSuppliers();
            scope.closeModal();
            scope.currentOrder.supplierId = parseInt(data.id);
            notify('success', 'Supplier added');
        });
    }

    scope.setCurrentOrder(routeParams.id);
	scope.setCurrentOrder;


    // supplier modal
    var turl = yiiApp.url+'/template?route=supplier/create';

    var supplierModal = modal({scope: scope, template: turl, show: false});

    scope.showModal  = function() {
        supplierModal.$promise.then(supplierModal.show);
    }

    scope.closeModal = function () {
        supplierModal.$promise.then(supplierModal.hide);   
    }
	
	scope.getTotalAmountForOrder = function() {
	
		var total = 0;
		
        if (scope.currentOrder.rows === undefined) scope.currentOrder.rows = [];
		
        for(var i = 0; i < scope.currentOrder.rows.length; i++){
			var row = scope.currentOrder.rows[i];
			total += (row.amount * row.pcs);
		}

		return total;
	
	};
	
	scope.getTotalAmountVatForOrder = function() {
	
		var total = 0;
		if (scope.currentOrder.rows === undefined) scope.currentOrder.rows = [];
		for(var i = 0; i < scope.currentOrder.rows.length; i++){
			var row = scope.currentOrder.rows[i];
			total += ((row.amount * row.pcs)*(row.vat/100))+(row.amount * row.pcs);
		}
        
		return total;
	
	};
	
	scope.getTotalVatForOrder = function() {
	
		var total = 0;
		if (scope.currentOrder.rows === undefined) scope.currentOrder.rows = [];
		for(var i = 0; i < scope.currentOrder.rows.length; i++){
			var row = scope.currentOrder.rows[i];
			total += (row.amount * row.pcs)*(row.vat/100);
		}
        
		return total;
	
	};
	
	scope.preciseRound = function(num,decimals) {
		return (Math.round(num * Math.pow(10, decimals)) / Math.pow(10, decimals)).toFixed(decimals);
	}

}]);