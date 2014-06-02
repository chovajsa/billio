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
