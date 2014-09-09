app.factory('OrdersOut', function ($resource) {
    var url = yiiApp.url + '/api/order-out/:id/:method';
    
    // console.log(this);

    var data = $resource(url, {
        id: '@id',
        method: '@method'
    }, {
        query: {
            isArray:false
        },
        getOrder: {
            method: 'GET',
            params: 0
        },
        createOrder: {
            method: 'POST',
            params: 0
        },

        updateOrder: {
            method: 'PUT',
            params: 0  
        },

        deleteOrder: {
            method: 'DELETE',
            params: 0    
        },
        approveOrder: {
            method: 'PUT',
            params: {
                method: 'approve'
            }
        },
        unapproveOrder: {
            method: 'PUT',
            params: {
                method: 'unapprove'
            }
        },

    });
    return data;
});

