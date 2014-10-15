app.controller('ListController', ['$scope', 'Supplier', '$routeParams', '$modal', '$location', '$http', function (scope, SI, routeParams, modal, location, $http) {

	scope.supplierList = [];
    scope.supplier = {};
    scope.toDelete = [];

    scope.paymentTotalAmount = 0;
	
	if (routeParams.fulltext) {
        scope.searchText = routeParams.fulltext;
    }
	
	scope.setSupplierList = function () {

        var filters = {};

        SI.query({
            // state: scope.invoiceListState,
            //labels: scope.labels,
            sort: scope.supplierListSort,
            direction: scope.supplierListDirection,
            filters:angular.toJson(filters),
			page: scope.supplierListPage,
			fulltext: scope.searchText,
        }, function (data) {
            scope.supplierList = data.items;
			scope.supplierListLinks = data._links;
			scope.supplierListPaging = data._meta;
        });
    };

    scope.update = function(id) {
        SI.getSupplier({
            id: id  
        }, function (data) {
            scope.supplier = data;
            scope.supplier.vat = !!scope.supplier.vat;
            scope.showModal();
        });
    }

    scope.showCreateModal = function () {
        scope.supplier = {};
		scope.showModal();
    }

    scope.addRow = function() {
        if (scope.supplier.bankAccounts === undefined) scope.supplier.bankAccounts = [];
        scope.supplier.bankAccounts.push({ id: null, bankAccount:'', bankAccountCode:'' });
    }

    scope.unsetRow = function(i) {
        
        if (scope.supplier.bankAccounts[i].id) {
            scope.toDelete.push({id:scope.supplier.bankAccounts[i].id});
        }

        scope.supplier.bankAccounts.splice(i, 1);
    }

    scope.ibanize = function(i) {
        var bankAccount = scope.supplier.bankAccounts[i].bankAccount;
        var bankAccountCode = scope.supplier.bankAccounts[i].bankAccountCode;
        var bankAccountPrefix = scope.supplier.bankAccounts[i].bankAccountPrefix;

        $.get(yiiApp.url+'/api/invoice-in/get-iban',
            {bankAccount:bankAccount, bankAccountCode:bankAccountCode, bankAccountPrefix:bankAccountPrefix}
         , function(d) {
            if (!d.iban) {
                scope.supplier.bankAccounts[i].iban = '';
                $('#biban'+i).val('');
            } else {
                scope.supplier.bankAccounts[i].iban = d.iban;
                $('#biban'+i).val(d.iban);
            }
         }, 'json');
    }



    scope.updateSupplier = function() {
		
		// filters out a bankAccounts with empty values
		for(var bankAccount in scope.supplier.bankAccounts) {
			if (scope.supplier.bankAccounts[bankAccount].bankAccount == '' || scope.supplier.bankAccounts[bankAccount].bankAccountCode == '') {
				scope.unsetRow(bankAccount);
			}
		}
		
        params = scope.supplier;
		
        if (params.address == undefined) params.address = {};
        params.toDelete = scope.toDelete;
        if (params.id) {
            SI.updateSupplier(params, function (data) {
                scope.setSupplierList();
                scope.closeModal();
                scope.toDelete = [];
                notify('success', 'Supplier updated');
            });
        } else {
            SI.createSupplier(params, function (data) {
                scope.setSupplierList();
                scope.closeModal();
                scope.toDelete = [];
                notify('success', 'Supplier created'); 
            });
        }
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

    scope.setSupplierList();

}]);