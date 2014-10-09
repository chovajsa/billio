var invoicePrototype = {
    getFullSupplierName: function() {
        return this.supplier.companyName ? this.supplier.companyName : this.supplier.name + ' '+this.supplier.surname;
    }    
}

app.factory('InvoicesIn', function ($resource) {
    var data = $resource(yiiApp.url + '/api/invoice-in/:id/:method', {
        id: '@id'
    }, {
        query: {
            isArray:false
        },
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
        },

        deleteInvoice: {
            method: 'DELETE',
            params: 0    
        },

        approveInvoice: {
            method: 'PUT',
            params: {
                method:'approve'
            }
        },

        unapproveInvoice: {
            method: 'PUT',
            params: {
                method:'unapprove'
            }
        },

        markAsPaid: {
            method: 'PUT',
            params: {
                method:'markAsPaid'
            }
        }
    });

    angular.extend(data.prototype, invoicePrototype);

    return data;

});

