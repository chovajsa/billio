app.controller('UpdateController', ['$scope', 'OrdersOut', 'Supplier', '$routeParams', '$modal', '$location', '$controller', function (scope, AI, SI, routeParams, modal, location, $controller) {

    $controller('ListController', {$scope:scope});

    scope.mode = 'update';
    scope.newSupplier = {};
    scope.counter = 0;

    scope.currentOrder = {
        rows:[],
        supplier:false
    };

    scope.addRow = function() {
        if (scope.currentOrder.rows === undefined) scope.currentOrder.rows = [];
        scope.currentOrder.rows.push({ id: null, amount:0, pcs:1, vat:yiiApp.defaultVat}); 
    }
    
    scope.unsetRow = function(i) {
        
        if (scope.currentOrder.rows[i].id) {
            scope.toDelete.push({id:scope.currentOrder.rows[i].id});
        }

        scope.currentOrder.rows.splice(i, 1);
    }

    scope.update = function() {
        // if (!valid) return;
        console.log(scope.form);
        scope.form.submitted = true;
        if (!scope.form.$valid) return false;

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
        
        params.supplierId = parseInt(params.supplier.id);

        if (scope.mode == 'create') {
            AI.createOrder(params, function (data) {
                scope.setOrderList();
                notify('success', 'Order added');
                
                $("html, body").animate({
                    scrollTop: 0
                }, 100);   

            });
        } else if (scope.mode == 'update') {

            params.toDelete = scope.toDelete;

            AI.updateOrder(params, function (data) {
                scope.setOrderList();
                scope.setCurrentOrder(params.id);
                notify('success', 'Ivoice updated');

                $("html, body").animate({
                    scrollTop: 0
                }, 100);   

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

            scope.currentOrder = data;
            scope.currentOrder.number = parseInt(scope.currentOrder.number);
            scope.currentOrder.referenceNumber = parseInt(scope.currentOrder.referenceNumber);

            scope.currentOrder.supplierId = parseInt(data.supplierId);

            if (scope.currentOrder.supplierId)
            scope.currentOrder.supplier = {
                id: data.supplierId,
                name: data.supplier.address.name,
                text: data.supplier.address.name
            }

            angular.element('#attachmentsFrame').attr('src', yiiApp.url+'/order-out/attachments?orderOutId='+data.id);
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


    if (routeParams.id) {
        scope.setCurrentOrder(routeParams.id);
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
	   var x = (Math.round(num * Math.pow(10, decimals)) / Math.pow(10, decimals)).toFixed(decimals);
       if (isNaN(x)) return "0.00";
	   return x;
    }

}]);