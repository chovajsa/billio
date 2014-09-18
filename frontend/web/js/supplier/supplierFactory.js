app.factory('Supplier', function ($resource) {
    var data =  $resource(yiiApp.url + '/api/supplier/:id', {
        id: '@id'
    }, {
        query: {
            isArray:false
        },
        getSupplier: {
            method: 'GET',
            params: {
            }
        },
        updateSupplier: {
            method: 'PUT',
            params: {

            }
        },
        createSupplier: {
            method: 'POST',
        },
    });
    return data;
});