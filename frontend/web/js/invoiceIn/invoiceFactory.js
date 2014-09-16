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
        }
    });

    return data;
});

