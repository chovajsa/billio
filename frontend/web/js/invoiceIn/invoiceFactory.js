app.factory('InvoicesIn', function ($resource) {
    var data = $resource(yiiApp.url + '/api/invoice-in/:id', {
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
        }
    });
    return data;
});

