

app.factory('Supplier', function ($resource) {
    var data =  $resource(yiiApp.url + '/api/supplier/:number', {
        number: '@number'
    }, {
        query: {
            isArray:false
        },
        getSupplier: {
            method: 'GET',
            params: {
                number: 0
            }
        },
        createSupplier: {
            method: 'POST',
            params: 0
        },
    });
    return data;
});

