app.factory('CostCentre', function ($resource) {
    var data =  $resource(yiiApp.url + '/api/cost-centre/:number', {
        number: '@number'
    }, {
        query: {
            isArray:false
        },
        getCostCentre: {
            method: 'GET',
            params: {
                number: 0
            }
        },
        createCostCentre: {
            method: 'POST',
            params: 0
        },
    });
    return data;
});